<?php

/**
 *
 * form submit functionality
 * */
#!/usr/bin/php
$_SERVER['HTTP_HOST'] = 'localhost';
$_GET['site'] = 'default';
$ignoreAuth = true;
include_once('../../../interface/globals.php');
include_once("../../../library/sql.inc");


//include_once(__DIR__.'/../../../src/Services/SocialHistoryService.php');
//echo __DIR__.'/../../../Src/Services/SocialHistoryService.php';
use OpenEMR\Services\SocialHistoryService;

include_once(__DIR__ . '/../../../library/api.inc');

if (isset($_POST['referralTab'])) {
    foreach ($_POST as $key => $value) {
        if (is_array($_POST[$key])) {
            $_POST[$key]  = implode('|', $_POST[$key]);
        }
    }
    //changingOfValues();
    unset($_POST['referralTab']);
    //file_put_contents('/var/www/html/traps/referral.txt', print_r($_POST, true)); die;
    formSubmit('patient_referral_form', $_POST, '');
}



if (isset($_POST['therapeuticTab'])) {
    foreach ($_POST as $key => $value) {
        if (is_array($_POST[$key])) {
            $_POST[$key]  = implode('|', $_POST[$key]);
        }
    }

    print_r($_POST);
    //changingOfValues();
    unset($_POST['therapeuticTab']);
    formSubmit('patient_therapeutic_form', $_POST, '');
}

// if (isset($_POST['noticePracticeTab'])) {
//     foreach ($_POST as $key => $value) {
//         if (is_array($_POST[$key])) {
//             $_POST[$key]  = implode('|', $_POST[$key]);
//         }
//     }
//     //changingOfValues();
//     unset($_POST['noticePracticeTab']);
//     formSubmit('patient_notice_form', $_POST, '');
// }

if (isset($_POST['noticePracticeTab'])) {

    foreach ($_POST as $key => $value) {
        if (is_array($_POST[$key])) {
            $_POST[$key]  = implode('|', $_POST[$key]);
        }
    }
    unset($_POST['noticePracticeTab']);

    //$reponse =  formSubmit('patient_notice_form', $_POST, '');
    formSubmit('patient_notice_form', $_POST, '');
    // print_r($reponse);

    // return $_POST;
}

if (isset($_POST['releaseTab'])) {

    foreach ($_POST as $key => $value) {
        if (is_array($_POST[$key])) {
            $_POST[$key]  = implode('|', $_POST[$key]);
        }
    }
    unset($_POST['releaseTab']);

    //$reponse =  formSubmit('patient_notice_form', $_POST, '');
    formSubmit('patient_release_form', $_POST, '');
    // print_r($reponse);

    // return $_POST;
}

if (isset($_POST['updateReferralTab'])) {


    foreach ($_POST as $key => $value) {
        if (is_array($_POST[$key])) {
            $_POST[$key]  = implode('|', $_POST[$key]);
        }
    }
    //changingOfValues();
    unset($_POST['updateReferralTab']);
    formUpdate('patient_referral_form', $_POST, '');
}
