<?php

require("../globals.php");
// Enable error reporting for debugging
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);

use OpenEMR\Services\UserService;
$userService = new UserService();
$user = $userService->getCurrentlyLoggedInUser();

$client_id = $user['client_id'];
$client_secret = $user['client_secret'];
$zoom_account_id = $user['zoom_account_id'];

// Function to send error response
function sendErrorResponse($message, $details = null, $httpCode = 400)
{
    header('Content-Type: application/json');
    http_response_code($httpCode);
    echo json_encode([
        'status' => 'error',
        'message' => $message,
        'details' => $details,
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    exit;
}

function getEncodedSecret($client_id, $client_secret)
{
    try {
        $clientId = $client_id;
        $clientSecret = $client_secret;

        if (empty($clientId) || empty($clientSecret)) {
            sendErrorResponse("Missing Zoom credentials", "Client ID or Secret is empty");
        }

        // Concatenate clientId and clientSecret with a colon
        $combined = $clientId . ':' . $clientSecret;

        // Encode the combined string in Base64
        return base64_encode($combined);
    } catch (Exception $e) {
        sendErrorResponse("Secret Encoding Error", $e->getMessage());
    }
}

$zoomCreds = ['client_id', 'client_secret', 'zoom_account_id'];
$missingCreds = [];

foreach ($zoomCreds as $field) {
    if (!isset($user[$field]) || empty($user[$field])) {
        $missingCreds[] = $field;
    }
}

if (!empty($missingCreds)) {
    sendErrorResponse(
        "Missing Zoom Credentials"
    );
}

function initiateOauthService($client_id, $client_secret, $zoom_account_id)
{
    try {
        $zoomSecret = getEncodedSecret($client_id, $client_secret);
        $baseUrl = 'https://zoom.us/oauth/token';

        // Data for the POST request
        $postData = http_build_query([
            "grant_type" => "account_credentials",
            "account_id" => $zoom_account_id,
        ]);

        // Validate account ID
        // if (empty(getenv('ZOOM_ACCOUNT_ID'))) {
        //     sendErrorResponse("Zoom Account ID is missing", "No account ID found in environment");
        // }

        // Set up the cURL request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $baseUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . $zoomSecret,
            'Content-Type: application/x-www-form-urlencoded'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the request
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);

        // Check for cURL errors
        if ($curlError) {
            sendErrorResponse("cURL Error", $curlError, 500);
        }

        // Check for HTTP errors
        if ($httpCode !== 200 && $httpCode !== 201) {
            $decodedResponse = json_decode($response, true);
            $errorMessage = "HTTP Code: $httpCode";

            if (json_last_error() === JSON_ERROR_NONE && isset($decodedResponse['reason'])) {
                $errorMessage .= ", Reason: " . $decodedResponse['reason'];
            } else {
                $errorMessage .= ", Response: " . $response;
            }

            sendErrorResponse(
                "OAuth Request Failed",
                $errorMessage,
                $httpCode
            );
        }


        curl_close($ch);

        // Decode and return the response
        $decodedResponse = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            sendErrorResponse("JSON Decode Error", json_last_error_msg(), 500);
        }

        return $decodedResponse;

    } catch (Exception $e) {
        sendErrorResponse("OAuth Service Error", $e->getMessage(), 500);
    }
}

// Set the content type to JSON
header('Content-Type: application/json');

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorResponse("Method Not Allowed", "Only POST requests are permitted.", 405);
}

// Retrieve input data from POST
$rawInput = file_get_contents('php://input');
if (empty($rawInput)) {
    sendErrorResponse("Empty Request Body", "No data was sent in the request.");
}

$data = json_decode($rawInput, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    sendErrorResponse("Invalid JSON", "The request body could not be parsed as JSON. " . json_last_error_msg());
}

// List of required fields
$requiredFields = [
    'pcEid',
];

// Check for missing fields
$missingFields = [];
foreach ($requiredFields as $field) {
    if (!isset($data[$field]) || empty($data[$field])) {
        $missingFields[] = $field;
    }
}

// If there are missing fields, return an error
if (!empty($missingFields)) {
    sendErrorResponse(
        "Missing Required Fields",
        "The following required fields are missing: " . implode(', ', $missingFields)
    );
}

// Sanitize input
$pcEid = htmlspecialchars($data['pcEid']);

try {
    // Fetch event (add error handling for database query)
    $event = sqlQuery("SELECT * FROM openemr_postcalendar_events WHERE pc_eid = ?", [$pcEid]);

    if (empty($event)) {
        sendErrorResponse("Event Not Found", "No event found with the given ID: $pcEid", 404);
    }

    $userInfo = sqlQuery("SELECT * from users WHERE id = ?", [$event['pc_aid']]);

    // Check if meeting has already started
    if ($event['meeting_started']) {
        $response = [
            'status' => 'success',
            'message' => 'Meeting already exists.',
            'data' => [
                'meeting_id' => $event['meeting_id'],
                'password' => $event['password'],
                'fname' => $userInfo['fname'],
                'lname' => $userInfo['lname'],
            ]
        ];

        http_response_code(200);
        echo json_encode($response);
        exit;
    }

    // Get OAuth token
    $token_response = initiateOauthService($client_id, $client_secret, $zoom_account_id);

    // Validate token response
    if (empty($token_response['access_token'])) {
        sendErrorResponse("Token Error", "Failed to obtain access token", 401);
    }
    $access_token = $token_response['access_token'];

    // Validate event details before creating Zoom meeting
    if (empty($event['pc_title']) || empty($event['pc_duration'])) {
        sendErrorResponse("Invalid Event Details", "Missing event title or duration", 400);
    }

    // API endpoint URL
    $apiUrl = "https://api.zoom.us/v2/users/me/meetings";

    // Prepare meeting data
    $postData = [
        "agenda" => $event['pc_title'],
        "default_password" => false,
        "duration" => max(5, intval($event['pc_duration'] / 60)), // Ensure minimum 5 minutes
        "password" => substr($event['pc_title'] . $event['pc_eid'], 0, 10), // Truncate password
        "pre_schedule" => false,
        "schedule_for" => "yuvrajsingh08cs@gmail.com",
        "start_time" => date('Y-m-d\TH:i:s', time()),
        "timezone" => date_default_timezone_get(),
        "type" => 2
    ];

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
        "Authorization: Bearer $access_token"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the request and capture response
    $zoomResponse = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);

    // Check for cURL errors
    if ($curlError) {
        sendErrorResponse("cURL Error", $curlError, 500);
    }

    // Check HTTP response
    if ($httpCode !== 200 && $httpCode !== 201) {
        sendErrorResponse(
            "Zoom API Request Failed",
            "HTTP Code: $httpCode, Response: " . $zoomResponse,
            $httpCode
        );
    }

    // Parse Zoom response
    $zoomData = json_decode($zoomResponse, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        sendErrorResponse("Zoom Response Parse Error", json_last_error_msg(), 500);
    }

    // Extract required meeting details
    $meeting_id = $zoomData['id'] ?? '';
    $password = $zoomData['password'] ?? '';

    // Validate extracted details
    if (empty($meeting_id)) {
        sendErrorResponse(
            "Incomplete Meeting Details",
            "Missing critical meeting details from Zoom response",
            500
        );
    }

    // Update database with meeting details
    $updateQuery = "UPDATE openemr_postcalendar_events SET 
        meeting_started = 1, 
        meeting_id = ?, 
        password = ? 
        WHERE pc_eid = ?";

    $updateResult = sqlQuery($updateQuery, [
        $meeting_id,
        $password,
        $pcEid
    ]);

    // Prepare successful response
    $response = [
        'status' => 'success',
        'message' => 'Meeting created successfully.',
        'data' => [
            'meeting_id' => $meeting_id,
            'password' => $password,
            'fname' => $userInfo['fname'],
            'lname' => $userInfo['lname'],
        ]
    ];

    // Send the JSON response
    http_response_code(200);
    echo json_encode($response);

} catch (Exception $e) {
    // Send error response for any unexpected errors
    sendErrorResponse("Unexpected Error", $e->getMessage(), 500);
}
?>