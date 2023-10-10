<?php

/**
 *
 * form submit functionality
 * */
#!/usr/bin/php
use OpenEMR\Services\SocialHistoryService;

$_SERVER['HTTP_HOST'] = 'localhost';
$_GET['site'] = 'default';
$ignoreAuth = true;
include_once('../../../interface/globals.php');
include_once("../../../library/sql.inc");
include_once(__DIR__ . '/../../../library/api.inc');

if (isset($_POST['updateReferralTab'])) {
    foreach ($_POST as $key => $value) {
        if (is_array($_POST[$key])) {
            $_POST[$key]  = implode('|', $_POST[$key]);
        }
    }

    unset($_POST['updateReferralTab']);
    foreach ($_POST as $key => $value) {
        if ($key != 'id' || $value != '') {
            $sql = "UPDATE `patient_referral_form` SET " . $key . " = ? where id = ?";
            sqlStatement($sql, [$value, $_POST['id']]);
        }
    }
}

if (isset($_POST['updateTherapeuticTab'])) {
    foreach ($_POST as $key => $value) {
        if (is_array($_POST[$key])) {
            $_POST[$key]  = implode('|', $_POST[$key]);
        }
    }

    unset($_POST['updateTherapeuticTab']);
    foreach ($_POST as $key => $value) {
        if ($key != 'id' || $value != '') {
            $sql = "UPDATE `patient_therapeutic_form` SET " . $key . " = ? where id = ?";
            sqlStatement($sql, [$value, $_POST['id']]);
        }
    }
}
