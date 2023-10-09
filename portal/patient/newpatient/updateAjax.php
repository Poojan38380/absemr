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
    //changingOfValues();
    unset($_POST['updateReferralTab']);
    foreach ($_POST as $key => $value) {
        $sql = "UPDATE `patient_referral_form` SET ? = ? where id = ?";
        if (!$_POST['id']) {
            sqlStatement($sql, [$key, $value, $_POST['id']]);
        }
    }
}
