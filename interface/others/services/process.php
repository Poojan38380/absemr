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


$requiredFields = [
    'cpt4code',
    'category'
];
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

// Handle Add
if ($add) {
    try {
        // Prepare SQL to insert new record
        $sql = "INSERT INTO cpt_category_mapping (cpt4code, category) VALUES (?, ?)";
        $result = sqlQuery($sql, [$cpt4code, $category]);
    
        // Get the last inserted ID (assuming sqlQuery returns the last insert ID)
        $newId = sqlQuery("SELECT LAST_INSERT_ID() as id", ['id']);
    
        // Send success response
        sendSuccessResponse([
            'status' => 'success',
            'id' => $newId,
            'cpt4code' => $cpt4code,
            'category' => $category
        ], 'Category mapping added successfully', 201);
    
    } catch (Exception $e) {
        // Handle database errors
        sendErrorResponse(
            "Database Error", 
            "Failed to insert record: " . $e->getMessage(), 
            500
        );
    }
} else if($update){
    try {
        // Prepare SQL to insert new record
        $sql = "UPDATE cpt_category_mapping SET cpt4code = '$cpt4code', category = '$category' WHERE id= $id";
        $result = sqlQuery($sql, []);
        // Get the last inserted ID (assuming sqlQuery returns the last insert ID)
        $newId = sqlQuery("SELECT LAST_INSERT_ID() as id", ['id']);
    
        // Send success response
        sendSuccessResponse([
            'status' => 'success',
            'id' => $newId,
            'cpt4code' => $cpt4code,
            'category' => $category
        ], 'Category mapping added successfully', 201);
    
    } catch (Exception $e) {
        // Handle database errors
        sendErrorResponse(
            "Database Error", 
            "Failed to insert record: " . $e->getMessage(), 
            500
        );
    }
}

// Handle Edit (Fetch for editing)
if (isset($_GET['edit'])) {
    $edit_id = $conn->real_escape_string($_GET['edit']);
    $edit_result = $conn->query("SELECT * FROM cpt_category_mapping WHERE id = '$edit_id'");
    $edit_row = $edit_result->fetch_assoc();

    // Include index.php to show the form with existing data
    include 'index.php';
    exit();
}

// Handle Update
if (isset($_POST['update'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $cpt4code = $conn->real_escape_string($_POST['cpt4code']);
    $category = $conn->real_escape_string($_POST['category']);

    $sql = "UPDATE cpt_category_mapping 
            SET cpt4code = '$cpt4code', 
                category = '$category' 
            WHERE id = '$id'";

    if ($conn->query($sql)) {
        header("Location: index.php?msg=updated");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $delete_id = $conn->real_escape_string($_GET['delete']);

    $sql = "DELETE FROM cpt_category_mapping WHERE id = '$delete_id'";

    if ($conn->query($sql)) {
        header("Location: index.php?msg=deleted");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>