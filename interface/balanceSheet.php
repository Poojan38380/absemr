<?php

require_once(__DIR__ . "/globals.php");

function createBalanceSheetEntry($pid, $eid, $status, $refund, $noneStatus)
{
    if($noneStatus){
        return;
    }
    $url = "http://localhost:8000/patientBalance/calculateBalance";

    $postData = json_encode([
        "pid" => $pid,
        "eid" => $eid,
        "status" => $status
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (isset($data['success']) && $data['success'] === true) {
        if (isset($data['data']['balanceSheetUpdateRequired']) && $data['data']['balanceSheetUpdateRequired'] === true) {
            $amount = floatval($data['data']['amount']);
            $description = $data['data']['description'] ?? "Balance Sheet Entry";
            $type = $data['data']['type']; // assuming default type is credit
            $balance = sqlQuery("SELECT balance FROM patient_balance_sheet WHERE pid = ? ORDER BY id DESC LIMIT 1", array($pid));
            $balance = $balance ? floatval($balance['balance']) : 0.0;
            $balance = ($type === 'CREDIT') ? $balance + $amount : $balance - $amount;
            $balance = number_format($balance, 2, '.', '');

            $sql = "INSERT INTO patient_balance_sheet (pid, description, type, amount, balance) VALUES (?, ?, ?, ?, ?)";
            $binds = array($pid, $description, $type, $amount, $balance);
            $balanceSheetEntry = sqlQuery($sql, $binds);
        }
    } else {
        error_log("Failed to retrieve balance from API for pid=$pid eid=$eid");
    }

    $url = "http://localhost:8000/refund/calculate";

    $postData = json_encode([
        "pid" => $pid,
        "eid" => $eid,
        "refund" => $refund
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (isset($data['success']) && $data['success'] === true) {
        if (isset($data['data']['balanceSheetUpdateRequired']) && $data['data']['balanceSheetUpdateRequired'] === true) {
            $amount = floatval($data['data']['amount']);
            $description = $data['data']['description'] ?? "Balance Sheet Entry";
            $type = $data['data']['type']; // assuming default type is credit
            $balance = sqlQuery("SELECT balance FROM patient_balance_sheet WHERE pid = ? ORDER BY id DESC LIMIT 1", array($pid));
            $balance = $balance ? floatval($balance['balance']) : 0.0;
            $balance = ($type === 'CREDIT') ? $balance + $amount : $balance - $amount;
            $balance = number_format($balance, 2, '.', '');

            $sql = "INSERT INTO patient_balance_sheet (pid, description, type, amount, balance) VALUES (?, ?, ?, ?, ?)";
            $binds = array($pid, $description, $type, $amount, $balance);
            $balanceSheetEntry = sqlQuery($sql, $binds);
        }
    } else {
        error_log("Failed to retrieve balance from API for pid=$pid eid=$eid");
    }

}

function createBalanceSheetEntryByEncounter($pid, $encounter, $status)
{
    $sql = "SELECT eid FROM encounter_tracker WHERE encounter = ?";
    $res = sqlQuery($sql, array($encounter));

    if ($res && isset($res['eid'])) {
        $eid = $res['eid'];
        createBalanceSheetEntry($pid, $eid, $status);
    } else {
        error_log("Encounter $encounter not found in encounter_tracker table.");
    }
}

