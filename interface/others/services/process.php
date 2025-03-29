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
$cpt4code = htmlspecialchars($data['cpt4code']);
$category = htmlspecialchars($data['category']);
$id = isset($data['id']) ? $data['id'] : false;
$add = isset($data['add']) ? 'add' : false;
$update = isset($data['update']) ? 'update' : false;
$delete = isset($data['delete']) ? 'delete' : false;

// Handle Add
if ($add) {
    try {
        // Prepare SQL to insert new record
        $sql = "INSERT INTO cpt_category_mapping (cpt4code, category) VALUES (?, ?)";
        $result = sqlQuery($sql, [$cpt4code, $category]);

        // Get the last inserted ID (assuming sqlQuery returns the last insert ID)
        $newId = sqlQuery("SELECT LAST_INSERT_ID() as id", ['id']);

        // Send success response
        $response = [
            'status' => 'success',
            'message' => 'Record added successfully',
            'id' => $newId,
            'cpt4code' => $cpt4code,
            'category' => $category
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
} else if ($update) {
    try {
        // Prepare SQL to insert new record
        $sql = "UPDATE cpt_category_mapping SET cpt4code = '$cpt4code', category = '$category' WHERE id= $id";
        $result = sqlQuery($sql, []);
        // Get the last inserted ID (assuming sqlQuery returns the last insert ID)
        $updatedData = sqlQuery("SELECT * from cpt_category_mapping where id = ?", [$id]);

        // Send success response
        $response = [
            'status' => 'success',
            'message' => 'Record updated successfully',
            'id' => $updatedData['id'],
            'cpt4code' => $updatedData['cpt4code'],
            'category' => $updatedData['category']
        ];

        http_response_code(200);
        echo json_encode($response);


    } catch (Exception $e) {
        // Handle database errors
        sendErrorResponse(
            "Database Error",
            "Failed to insert record: " . $e->getMessage(),
            500
        );
    }
} else if ($delete) {
    try {
        // Prepare SQL to insert new record
        $sql = "DELETE FROM cpt_category_mapping WHERE id= $id";
        $result = sqlQuery($sql, []);

        // Send success response
        $response = [
            'status' => 'success',
            'message' => 'Record deleted successfully',
            'id' => $newId,
            'cpt4code' => $cpt4code,
            'category' => $category
        ];

        http_response_code(200);
        echo json_encode($response);

    } catch (Exception $e) {
        // Handle database errors
        sendErrorResponse(
            "Database Error",
            "Failed to insert record: " . $e->getMessage(),
            500
        );
    }
}

?>