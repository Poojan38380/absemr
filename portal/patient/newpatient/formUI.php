<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$_SERVER['HTTP_HOST'] = 'localhost';
$_GET['site'] = 'default';
$ignoreAuth = true;

include_once('../../../interface/globals.php');
include_once("../../../library/sql.inc");

function referralTab($pid)
{
    require_once('./tabs/referral-tab.php');
}

function referralTabSaved($pid)
{
    $referralCount = sqlQuery("select count(*) as count from patient_referral_form where pid = ?", [$pid]);
    if ($referralCount['count']) return true;
    return false;
}

function referralTabEdit($pid)
{
    $referral = sqlQuery("select * from patient_referral_form where pid = ?", [$pid]);
    require_once('./tabs_edit/referral-tab.php');
}
function therapeuticTab($pid)
{
    require_once('./tabs/therapeutic-tab.php');
}
function therapeuticTabSaved($pid)
{
    $therapeuticCount = sqlQuery("select count(*) as count from patient_therapeutic_form where pid = ?", [$pid]);
    if ($therapeuticCount['count']) return true;
    return false;
}
function therapeuticTabEdit($pid)
{
    $therapeutic = sqlQuery("select * from patient_therapeutic_form where pid = ?", [$pid]);
    require_once('./tabs_edit/therapeutic-tab.php');
}
function medicalHistoryTab($pid)
{
    require_once('./tabs/medical-history-tab.php');
    $onsite_doc = sqlQuery("select * from onsite_documents where pid = ?", [$pid]);
}

function noticePracticeTab($pid)
{
    $patient = sqlQuery("select concat(fname,' ', lname) as name from patient_data where pid = ?", [$pid]);
    $onsite_signature = sqlQuery("select type,user,sig_image as sign from onsite_signatures where pid = ?", [$pid]);
    require_once('./tabs/notice-practice-tab.php');
}
function noticePracticeTabSaved($pid)
{
    $referralCount = sqlQuery("select count(*) as count from patient_notice_form where pid = ?", [$pid]);
    if ($referralCount['count']) {
        return true;
    }
    return false;
}
function noticePracticeTabEdit($pid)
{
    $patient = sqlQuery("select concat(fname,' ', lname) as name from patient_data where pid = ?", [$pid]);
    $onsite_signature = sqlQuery("select type,user,sig_image as sign from onsite_signatures where pid = ?", [$pid]);
     $referral = sqlQuery("select * from patient_notice_form where pid = ?", [$pid]);
     var_dump($referral); //This shows the informed consent release form. but if I remove this line, neither of the forms show up.
    require_once('./tabs_edit/notice-practice-tab.php');
}
function releaseTab($pid)
{
    $patient = sqlQuery("select fname, lname from patient_data where pid = ?", [$pid]);
    $onsite_signature = sqlQuery("select type,user,sig_image as sign from onsite_signatures where pid = ?", [$pid]);
    require_once('./tabs/release-tab.php');
}
function releaseTabSaved($pid)
{
    $referralCount = sqlQuery("select count(*) as count from patient_release_form where pid = ?", [$pid]);
    if ($referralCount['count']) return true;
    return false;
}
function releaseTabEdit($pid)
{
    $patient = sqlQuery("select fname, lname from patient_data where pid = ?", [$pid]);
    $onsite_signature = sqlQuery("select type,user,sig_image as sign from onsite_signatures where pid = ?", [$pid]);
    $referral = sqlQuery("select * from patient_release_form where pid = ?", [$pid]);
    require_once('./tabs_edit/release-tab.php');
}

function generateDropdown($list_id = '', $name = '')
{
    $getList = sqlStatement("select * from list_options where list_id = ? and activity = 1 order by seq asc", [$list_id]);
    $drop = '<select name="' . $name . '" class="form-control" style="width:50%">';
    $drop .= '<option value="">--Select--</option>';
    while ($row = sqlFetchArray($getList)) {
        $drop .= sprintf('<option value="%s">%s</option>', $row['option_id'], $row['title']);
    }
    $drop .= '</select>';
    return $drop;
}

function selectedDropdown($list_id = '', $name = '', $selected_value = '', $disabled = false)
{
    $getList = sqlStatement("select * from list_options where list_id=? and activity=1 order by seq asc", [$list_id]);
    $dropdown = '<select name="' . $name . '" class="form-control" style="width:50%">';

    while ($row = sqlFetchArray($getList)) {
        $optionId = $row['option_id'];
        $isSelected = ($optionId == $selected_value) ? 'selected' : '';
        $isDisabled = $disabled ? 'disabled' : '';

        $dropdown .= sprintf(
            '<option value="%s" %s %s>%s</option>',
            $optionId,
            $isSelected,
            $isDisabled,
            $row['title']
        );
    }

    $dropdown .= '</select>';
    return $dropdown;
}
function selectedInsuranceCompany($selected_value = '', $disabled = false)
{

    $getComapnies = sqlStatement("select id, name from insurance_companies");
    $dropdown = '<select name="insurance_comapny" class="form-control" style="width:50%;">';
    while ($row = sqlFetchArray($getComapnies)) {
        $optionId = $row['id'];
        $isSelected = ($optionId == $selected_value) ? 'selected' : '';
        $isDisabled = $disabled ? 'disabled' : '';

        $dropdown .= sprintf(
            '<option value="%s" %s %s>%s</option>',
            $optionId,
            $isSelected,
            $isDisabled,
            $row['name']
        );
    }

    $dropdown .= '</select>';
    return $dropdown;
}
function generateRadioButtons($list_id = '', $name = '')
{
    $getList = sqlStatement("select * from list_options where list_id=? and activity=1 order by seq asc", [$list_id]);
    $radio = '';
    while ($row = sqlFetchArray($getList)) {
        $radio .= sprintf('<div class="radio"><label><input type="radio" name="%s" value="%s"> %s</label></div>', $name, $row['option_id'], $row['title']);
    }
    return $radio;
}

function selectedRadioButtons($list_id = '', $name = '', $selected_value = '')
{
    $getList = sqlStatement("select * from list_options where list_id=? and activity=1 order by seq asc", [$list_id]);
    $radio = '';

    while ($row = sqlFetchArray($getList)) {
        $isChecked = ($row['option_id'] == $selected_value) ? 'checked' : '';
        // $isDisabled = $disabled ? 'disabled' : '';
        $radio .= sprintf(
            '<div class="radio"><label><input type="radio" name="%s" value="%s" %s> %s</label></div>',
            $name,
            $row['option_id'],
            $isChecked,
            $row['title']
        );
    }

    return $radio;
}

function selectedCheckboxes($list_id = '', $name = '', $selected_values = '')
{
    //because it is a string when it comes in. the string is the exploded into an array
    $selected_value = explode('|', $selected_values);
    $getList = sqlStatement("select * from list_options where list_id = ? and activity = 1 order by seq asc", [$list_id]);
    $checkboxes = '';

    while ($row = sqlFetchArray($getList)) {
        $valueSelected = array_search($row['option_id'], $selected_value);
        $isChecked = ($valueSelected !== false) ? 'checked' : '';

        $checkboxes .= sprintf(
            '<div class="checkbox"><label><input type="checkbox" name="%s[]" value="%s" %s> %s</label></div>',
            $name,
            $row['option_id'],
            $isChecked,
            $row['title']
        );
    }
    return $checkboxes;
}
function generateCheckBox($list_id = '', $name = '')
{
    $getList = sqlStatement("select * from list_options where list_id = ? and activity = 1 order by seq asc", [$list_id]);
    $check = '';
    while ($row = sqlFetchArray($getList)) {
        $check .= sprintf('<div class="checkbox"><label><input type="checkbox" name="%s[]" value="%s"> %s</label></div>', $name, $row['option_id'], $row['title']);
    }
    return $check;
}
function selectedCheckBox($list_id = '', $name = '', $selected_values = '', $disabled = false)
{
    $selected_value = explode('|', $selected_values);
    $getList = sqlStatement("select * from list_options where list_id = ? and activity = 1 order by seq asc", [$list_id]);
    $check = '';
    while ($row = sqlFetchArray($getList)) {
        $valueSelected = array_search($row['option_id'], $selected_value);
        $isChecked = ($valueSelected !== false) ? 'checked' : '';
        $check .= sprintf(
            '<div class="radio"><label><input type="checkbox" name="%s" value="%s" %s %s> %s</label></div>',
            $name,
            $row['option_id'],
            $isChecked,
            false,
            $row['title']
        );
    }
    return $check;
}


function getChildrenOptionList()
{
    $count = ($_POST['count'] == 6) ? 5 : $_POST['count'];
    $countArr = ['1' => 'first', '2' => 'second', '3' => 'third', '4' => 'fourth', '5' => 'fifth'];
    $html = '';
    if ($count > 0)
        for ($i = 1; $i <= $count; $i++) {
            $html .= '<label>' . ucfirst($countArr[$i]) . ' Child\'s Name <span style = "color:red"> * </span></label><br>';
            $html .= '<input type = "text" class = "form-control" name = "' . $countArr[$i] . '_name" style = "width:50%"></br>';
            $html .= '<label>' . ucfirst($countArr[$i]) . ' Child\'s Age <span style = "color:red"> * </span></label></br>';
            $html .= '<input type = "text" class = "form-control" name = "' . $countArr[$i] . '_age" style = "width:50%"></br>';
            $html .= '<label>Is the ' . $countArr[$i] . ' child male or female?<span style = "color:red"> * </span></label></br>';
            $html .= '<input type = "radio" value = "' . $countArr[$i] . '_male" name = "' . $countArr[$i] . '_gender"> Male</br>';
            $html .= '<input type = "radio" value = "' . $countArr[$i] . '_female" name = "' . $countArr[$i] . '_gender"> Female</br>';
            $html .= '<label>Who has custody of the ' . $countArr[$i] . ' child?<span style = "color:red"> * </span></label></br>';
            $getCustodyList = sqlStatement("select * from list_options where list_id = ? and activity = 1 order by seq asc", ['custody_list']);
            while ($row = sqlFetchArray($getCustodyList)) {
                $html .= '<input type = "radio" name = "' . $countArr[$i] . '_custody" value = "' . $countArr[$i] . '_' . $row['option_id'] . '">' . $row['title'] . '</br>';
            }
        }
    return $html;
}
