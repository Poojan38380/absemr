<?php

require("../globals.php");
// Enable error reporting for debugging
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);
require_once("$srcdir/FeeSheetHtml.class.php");
use OpenEMR\Billing\BillingUtilities;

$PriceCodes = [
    '16' => '90832', //30 minutes
    '17' => '90834', //45 minutes
    '10' => '90837', //60 minutes
    '15' => '90853', //Group Therapy,
    '12' => '90791', //Intake Evalutation / Pyschotherapy dignostics sessions
    '18' => '90839', //Psychotherapy Crisis
    '5' => '90847', //Family Therapy
    '9' => '90846', //Family Therapy without patient
    '19' => '99404', //EAP
];

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

// List of required fields
$requiredFields = [
    'eid',
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
$eid = htmlspecialchars($data['eid']);

try {

    $event = sqlQuery("SELECT * FROM openemr_postcalendar_events WHERE pc_eid = ?", [$eid]);
    $tracker = sqlQuery("SELECT * FROM encounter_tracker WHERE eid = ? ", $eid);
    if($tracker === false){
        sendErrorResponse("Corresponding Encounter does not exists", "Corresponding Encounter does not exists", 400);
    }
    $encounter = $tracker['encounter'];
    if($event['pc_pid'] === '0' && $event['pc_gid'] !=='0'){
        sendErrorResponse("Feature not ready for group events", "Feature not ready for group events", 400);
    }
    $pid = $event['pc_pid'];
    $getPriceLevelQuery = sqlQuery("SELECT price_level FROM patient_data " .
        "WHERE pid = ?", [$pid]);

    $price_level = $getPriceLevelQuery['price_level'];
    if (empty($price_level)) {
        sendErrorResponse("Price Level Not Found", 404);
    }
 
    $category_id = $event['pc_catid'];
    $code = $PriceCodes[$category_id];
    $codeDetails = sqlQuery("select * from  codes where code = ? && superbill = 'Telemedicine'", [$code]);
    $priceData = sqlQuery("select p.pr_price, c.modifier, c.code from codes c left join prices p on p.pr_id = c.id where c.code = ? and p.pr_level = ?", [$code, $price_level]);
    if($priceData === false){
        $priceData = sqlQuery("select p.pr_price, c.modifier, c.code from codes c left join prices p on p.pr_id = c.id where c.code = ? and p.pr_level = ?", [$code, 'standard']);
    }
    $price = $priceData['pr_price'];
    $code_type = "CPT4";
    $units = "1";

    $billresult = BillingUtilities::getBillingByEncounter($pid, $encounter, "*");
    // Convert $billresult to an array and add 'del' => '1'
    $bill = array_map(function ($item) {
        $item = (array) $item;
        $item['del'] = '1';
        return $item;
    }, $billresult);

    // Append the additional array to $bill
    $bill[] = [
        'code_type' => $code_type,
        'code' => $code,
        'billed' => "",
        'mod' => "",
        'pricelevel' => $price_level,
        'price' => $price,
        'units' => $units,
        'justify' => '',
        'provid' => "",
        'notecodes' => ''
    ];


    $fs = new FeeSheetHtml($pid, $encounter);

    $fs->save(
        $bill,
        $_POST['prod'],
    );


    $response = [
        'success' => true,
        'message' => 'Fee Sheet Synced Successfully',
        'data' => [
            'price_level' => $price_level,
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