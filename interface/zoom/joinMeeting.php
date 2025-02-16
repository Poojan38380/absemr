<?php

require("../globals.php");
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

function getEncodedSecret()
{
    try {
        $clientId = "hQ77av7T_qhcOy_pR0g4A";
        $clientSecret = "qn4XedDIaxxoUgiWUZ87hYOuPiaHalmC";

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

function initiateOauthService()
{
    try {
        $zoomSecret = getEncodedSecret();
        $baseUrl = 'https://zoom.us/oauth/token';

        // Data for the POST request
        $postData = http_build_query([
            "grant_type" => "account_credentials",
            "account_id" => "Z7qOzYSZSb6Bd3Y5cZz_TA"
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
        if ($httpCode !== 200) {
            sendErrorResponse(
                "OAuth Request Failed",
                "HTTP Code: $httpCode, Response: " . $response,
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

    // Check if meeting has already started
    if ($event['meeting_started'] && $event['paid']) {
        $patientData = sqlQuery("SELECT * FROM patient_data WHERE id = ?", [$event['pc_pid']]);
        $name = $patientData['fname'] . ' ' . $patientData['lname'];
        $response = [
            'status' => 'success',
            'message' => 'Meeting already exists.',
            'data' => [
                'meeting_id' => $event['meeting_id'],
                'password' => $event['password'],
                'name' => $name,
            ]
        ];

        echo json_encode($response);
        http_response_code(200);
        exit;
    } else if (!$event['paid']) {
        $response = [
            'status' => 'success',
            'message' => 'You need to pay before you can join this meeting.',
        ];

        echo json_encode($response);
        http_response_code(200);
        exit;
    }

} catch (Exception $e) {
    // Send error response for any unexpected errors
    sendErrorResponse("Unexpected Error", $e->getMessage(), 500);
}
?>