<?php
require("../../globals.php");

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

header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorResponse("Method Not Allowed", "Only POST requests are permitted.", 405);
}
$rawInput = file_get_contents('php://input');
if (empty($rawInput)) {
    sendErrorResponse("Empty Request Body", "No data was sent in the request.");
}

$data = json_decode($rawInput, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    sendErrorResponse("Invalid JSON", "The request body could not be parsed as JSON. " . json_last_error_msg());
}


$requiredFields = [];
$missingFields = [];
foreach ($requiredFields as $field) {
    if (!isset($data[$field]) || empty($data[$field])) {
        $missingFields[] = $field;
    }
}
if (!empty($missingFields)) {
    sendErrorResponse(
        "Missing Required Fields",
        "The following required fields are missing: " . implode(', ', $missingFields)
    );
}

// Sanitize input
$type = htmlspecialchars($data['type']);
$amount = htmlspecialchars($data['amount']);
$description = htmlspecialchars($data['description']);

// Handle Add
try {

    $balanceQuery = sqlStatement(
        "SELECT balance from patient_balance_sheet where pid = $pid order by id desc limit 1",
        []
    );
    $balance = sqlFetchArray($balanceQuery);
    $newBalance = $type === 'CREDIT' ? $balance['balance'] + $amount : $balance['balance'] - $amount;

    // Prepare SQL to insert new record
    $sql = "INSERT INTO patient_balance_sheet (type, amount, description, balance, pid) VALUES (?, ?, ?, ?, ?)";
    $result = sqlQuery($sql, [$type, $amount, $description, $newBalance, $pid]);

    // Send success response
    $response = [
        'status' => 'success',
        'message' => 'Record added successfully',
        'type' => $type,
        'amount' => $amount,
        'description' => $description,
        'balance' => $balance,
    ];
    http_response_code(201);
    echo json_encode($response);

} catch (Exception $e) {
    // Handle database errors
    sendErrorResponse(
        "Database Error",
        "Failed to insert record: " . $e->getMessage(),
        500
    );
}
?>