<?php
require("../globals.php");

// Enable error reporting for debugging
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);

use OpenEMR\Services\UserService;
$userService = new UserService();
$user = $userService->getCurrentlyLoggedInUser();

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');
    // Retrieve input data from POST
    $rawInput = file_get_contents('php://input');
    if (empty($rawInput)) {
        sendErrorResponse("Empty Request Body", "No data was sent in the request.");
    }

    $data = json_decode($rawInput, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        sendErrorResponse("Invalid JSON", "The request body could not be parsed as JSON. " . json_last_error_msg());
    }

    // Sanitize input
    $value = trim(htmlspecialchars($data['value']));

    try {
        $updateQuery = "UPDATE other_configs SET 
    value = ? 
    WHERE name = 'processingFee'";

        $updateResult = sqlQuery($updateQuery, [
            $value
        ]);

        $response = [
            'status' => 'success',
            'message' => 'Config Updated Successfully.',
        ];

        // Send the JSON response
        http_response_code(201);
        echo json_encode($response);
    } catch (Exception $e) {
        sendErrorResponse("Error Updating Config", $e->getMessage(), 500);
    }

} else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $configValue = sqlQuery("SELECT * FROM other_configs WHERE name = ?;", ['processingFee']);

    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Processing Fees</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
    
            h1 {
                text-align: center;
                color: #333;
            }
    
            form {
                background-color: #fff;
                padding: 20px 30px;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 400px;
            }
    
            label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
                color: #555;
            }
    
            input {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 4px;
                font-size: 14px;
            }
    
            input:focus {
                border-color: #007BFF;
                outline: none;
                box-shadow: 0 0 4px rgba(0, 123, 255, 0.5);
            }
    
            button {
                width: 100%;
                padding: 10px;
                background-color: #007BFF;
                color: white;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
            }
    
            button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <form id="zoomCredentialsForm">
            <h1>Processing Fees Form</h1>
        <label for="value">Processing Fee:</label>
        <input type="text" id="value" name="value" placeholder="Enter Processing Fee" required value = "' . $configValue['value'] . '">

        <button type="submit">Submit</button>
        </form>
    
        <script>
            document.getElementById("zoomCredentialsForm").addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent default form submission
    
                const formData = new FormData(this);
                const data = {
                    value: formData.get("value"),
                };
    
                fetch("processingFee.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                })
                .catch(error => {
                    alert("Error: " + error);
                });
            });
        </script>
    </body>
    </html>
    ';

}