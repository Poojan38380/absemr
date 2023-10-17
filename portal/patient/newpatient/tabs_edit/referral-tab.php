<input type="hidden" name="id" value="<?php echo $referral['id'] ?>">
<div class="row" style="margin-bottom: 1rem;">
    <label>
        <h2>Client Information</h2></br>
        This information is held in strict confidence and is protected under federal HIPAA laws and will be used only for clinical purposes. Please complete it as accurately and as detailed as possible. If you have any questions please call our office at 1800-574-9ABS and speak to an on-call administrator. Thank you
    </label>
</div>

<div class="row">
    <label>What is your ethnicity? <span style="color:red">*</span> : </label>
    <?= selectedRadioButtons('Ethnicity', 'ethnicity', $referral['ethnicity'] ?? '') ?>
</div>

<div class="row"><label>What is your religion? <span style="color:red">*</span> : </label>
    <?= selectedRadioButtons('Religion', 'religion', $referral['religion'] ?? '') ?>
</div>

<!--<div class="row">
    <label>Please provide your best phone number :<span style="color:red">*</span></label><br>
    <input type="text" class="form-control" name="ph_no1" required style="width:50%">
</div>
<div class="row">
    <label>Phone Number 2 : </label><br>
    <input type="text" class="form-control" name="ph_no2" style="width:50%">
</div>
<div class="row">
    <label>Address <span style="color:red">*</span></label>
    <input type="text" class="form-control" name="adr1" placeholder="Address1" required style="width:50%"></br>
    <input type="text" class="form-control" name="Adr2" placeholder="Address2" style="width:50%"></br>
    <input type="text" class="form-control" name="city" placeholder="City" style="width:50%"></br>
    <input type="text" class="form-control" name="state" placeholder="State" style="width:50%"></br>
    <input type="text" class="form-control" name="zip" placeholder="Zip/Postal code" style="width:50%">
</div>
-->
<div class="row"><label>What type of living environment do you reside in?</label>
    <?= selectedDropdown('living_environment', 'living_environment', $referral['living_environment'] ?? '') ?>
</div>
<?php if ($referral['living_environment'] == 'Shelter') { ?>
<div class="row">
    <h4>Shelter Name:</h4>
    <?php echo $referral['shelter_name'] ?>
</div>
<?php } ?>


<div class="row" name="aptnumber" style="display:none">
    <label>What is your apartment number?<span style="color:red">*</span></label>
    <input type="text" name="apt_number" class="form-control" value="<?php echo $referral['apt_number'] ?>" style="width:50%">
</div>
<?php if ($referral['living_environment'] == 'apartment') { ?>
    <div class="row" name="aptnumber" style="display:block">
        <label>What is your apartment number?<span style="color:red">*</span></label>
        <input type="text" name="apt_number" class="form-control" value="<?php echo $referral['apt_number'] ?>" style="width:50%">
    </div>
<?php } ?>

<div class="row" name="quaHouse" style="display:none">
    <label>Name of three quarter house or program<span style="color:red">*</span></label>
    <input type="text" name="qua_house" class="form-control" style="width:50%" value="<?php echo $referral['qua_house'] ?>">
</div>

<?php if ($referral['living_environment'] == '3_quater') { ?>
    <div class="row" name="quaHouse" style="display:block">
        <label>Name of three quarter house or program<span style="color:red">*</span></label>
        <input type="text" name="qua_house" class="form-control" style="width:50%" value="<?php echo $referral['qua_house'] ?>">
    </div>
<?php } ?>

<div class="row" name="halfHouse" style="display:none">
    <label>Name of halfway house or program<span style="color:red">*</span></label>
    <input type="text" name="half_house" class="form-control" style="width:50%" value="<?php echo $referral['half_house'] ?>">
</div>

<?php if ($referral['living_environment'] == 'half_way') { ?>
    <div class="row" name="halfHouse" style="display:block">
        <label>Name of halfway house or program<span style="color:red">*</span></label>
        <input type="text" name="half_house" class="form-control" style="width:50%" value="<?php echo $referral['half_house'] ?>">
    </div>
<?php } ?>

<div class="row" name="residentTreatmentPgm" style="display:none">
    <label>Name of Residential Treatment Program ?<span style="color:red">*</span></label>
    <input type="text" name="resident_treat_pgm" class="form-control" style="width:50%" value="<?php echo $referral['resident_treat_pgm'] ?>">
</div>


<div class="row" name="shelterName" style="display:none">
    <label>Name of Shelter<span style="color:red">*</span></label>
    <input type="text" name="shelter_name" class="form-control" style="width:50%" value="<?php echo $referral['shelter_name'] ?>">
</div>

<?php if ($referral['living_environment'] == 'shelter') { ?>
    <div class="row" name="shelterName" style="display:block">
        <label>Name of Shelter<span style="color:red">*</span></label>
        <input type="text" name="shelter_name" class="form-control" style="width:50%" value="<?php echo $referral['shelter_name'] ?>">
    </div>
<?php } ?>


<div class="row">
    <span style="color:red">
        <h4>Payment Information</h4>
    </span>
</div>
<div class="row">
    <label>How do you intend to pay for your therapy?<span style="color:red">*</span></label><br>
    <?= selectedRadioButtons('payment_info', 'payment_ifo', $referral['payment_ifo'] ?? '') ?>
</div>
<div class="row" name="insuranceComDiv" style="display:none">
    <label>Insurance Company</label><br><select name="insurance_comapny" class="form-control" style="width:50%;">
        <option value="">--Select Insurance Company--</option>
        <?php
        $getComapnies = sqlStatement("select id, name from insurance_companies");
        while ($row = sqlFetchArray($getComapnies)) { ?>
            <option value="<?= $row['id'] ?>"> <?= $row['name'] ?></option>
        <?php } ?>
    </select><br>
    <label>insuranceID</label><br>
    <input type="text" class="form-control" style="width:50%" name="insuranceID">
</div>

<div class="row" name="eapDiv" style="display: none;">
    <label>Name of the EAP program <span style="color: red;"> * </span></label>
    <?= generateRadioButtons('eap_pgms_rad', 'eap_pgms') ?>

    <label>Name of the EAP program <span style="color:red;"> * </span></label>
    <?php
    $getEthnicity = sqlStatement("select * from list_options where list_id = ? and activity = 1 order by seq asc", ["eap_pgms"]);
    while ($row = sqlFetchArray($getEthnicity)) { ?>
        <label><?= $row['title'] ?></label>
        <input type="text" name="<?= $row['option_id'] ?>" style="width:50%" class="form-control"></br>
    <?php } ?>
</div>
<?php if ($referral['payment_ifo'] == 'med_insu') { ?>
    <div class="row" name="insuranceComDiv" style="display:block">
        <label>Insurance Company</label><br>
        <select name="insurance_comapny" class="form-control" style="width:50%;">
            <?php
            $getComapnies = sqlStatement("select id, name from insurance_companies where id =" . $referral['insurance_comapny']);
            while ($row = sqlFetchArray($getComapnies)) {
                $optionId = $row['row_id'];
                $selected = ""; // Initialize selected as empty string
                if ($optionId == $_POST['insurance_comapny']) {
                    $selected = "selected"; // Set selected to "selected" if it matches the POST value

                } ?>
                <option value="<?= $row['id'] ?>" <?= $selected ?>><?= $row['name'] ?></option>
            <?php } ?>
        </select><br>
        <label>insuranceID</label><br>
        <input type="text" class="form-control" style="width:50%" name="insuranceID" value="<?php echo $referral['insuranceID'] ?>">
    </div>
<?php } ?>
<?php if ($referral['payment_ifo'] == 'Eap') { ?>
    <div class="row" name="eapDiv" style="display: block;">
        <label>Name of the EAP program <span style="color: red;"> * </span></label>
        <?= selectedRadioButtons('eap_pgms_rad', 'eap_pgms', $referral['eap_pgms'] ?? '') ?>

        <label>Name of the EAP program <span style="color:red;"> * </span></label>
        <?php
        $getEthnicity = sqlStatement("select * from list_options where list_id = ? and activity = 1 order by seq asc", ["eap_pgms"]);
        while ($row = sqlFetchArray($getEthnicity)) { ?>
            <label><?= $row['title'] ?></label>
            <input type="text" name="<?= $row['option_id'] ?>" style="width:50%" class="form-control"></br>
        <?php } ?>
    </div>
<?php } ?>

<div class="row">
    <label>
        <?php echo xlt('Who Referred You to ABS? Please include all involved agencies with all contact
        information, including phone numbers and emails. If you where referred by a court
        please also include attorney information. If you have more then one case please let
        us know now to help you') ?>.
    </label>
    <?= selectedCheckboxes('refsource', 'Who_Referred_You_to_ABS_', $referral['Who_Referred_You_to_ABS_'] ?? '') ?>

</div>

<!-- Lawyer div -->

    <div class="row" name="lawyerDiv" style="display:block">
        <label>Who represents you? <span style="color:red">*</span></label>
        <?php //var_dump($referral['lawyerDiv_info'] ?? '') ?>
        <?= selectedCheckboxes('lawyerDiv', 'lawyerDiv_info', $referral['lawyerDiv_info'] ?? '') ?>

        <label>What type of case is this <span style="color:red">*</span></label>
        <?= selectedRadioButtons('caseType', 'caseType_info', $referral['caseType_info'] ?? '') ?>

        <label>Attorney's Name</label><span style="color:red">*</span></br>
        <input type="text" name="lawyer_attroney_name" class="form-control" style="width:50%" value="<?php echo $referral['lawyer_attroney_name'] ?>"></br>

        <label>Attorney's Phone Number</label><span style="color:red">*</span></br>
        <input type="text" name="lawyer_attroney_phone" class="form-control" style="width:50%" value="<?php echo $referral['lawyer_attroney_phone'] ?>"></br>

        <label>Attorney's Email</label><span style="color:red">*</span></br>
        <input type="text" name="lawyer_attroney_email" class="form-control" style="width:50%" value="<?php echo $referral['lawyer_attroney_email'] ?>"></br>
    </div>


<!-- Childwelfare div -->

    <div class="row" name="childwelfareDiv" style="display:block">
        <label>Which Child Welfare Office?<span style="color:red">*</span></label>
        <?= selectedRadioButtons('child_welfare', 'childwelfare', $referral['childwelfare'] ?? '') ?>

        <label>Child Welfare Worker's Name<span style="color:red">*</span></label>
        <input type="text" name="welfare_worker_name" class="form-control" style="width:50%" value="<?php echo $referral['welfare_worker_name'] ?>"></br>

        <label>Child Welfare Worker's Phone Number<span style="color:red">*</span></label>
        <input type="text" name="welfare_worker_ph" class="form-control" style="width:50%" value="<?php echo $referral['welfare_worker_ph'] ?>"></br>

        <label>Child Welfare Worker's Email<span style="color:red">*</span></label>
        <input type="text" name="welfare_worker_email" class="form-control" style="width:50%" value="<?php echo $referral['welfare_worker_email'] ?>"></br>
    </div>


<!-- Court -->
<div class="row" name="courtDiv" style="display:block">
        <label>
            Where is your court case? <span style="color:red">*</span>
        </label>
        <?= selectedRadioButtons('Intake_courts', 'countyName', $referral['countyName'] ?? '') ?>
        <div class="radio">
            <label>
                <input type="radio" name="countyName" value="Other" <?php echo ($referral['countyName'] == 'Other') ?  "checked" : ""; ?>> Other
            </label>
        </div>

        <?php
        $county_courts = [
            'Kingscounty' => 'Intake_kings_court',
            'richmondcount' => 'Intake_richmond_court',
            'newyorkcounty' => 'Intake_newyork_court',
            'Queens County' => 'Intake_Queens_Court',
            'Bronx County' => 'Intak_Bronx_Court',
            'Nassau County' => 'Intake_Nassau_Court',
            'Suffolk County' => 'Intake_Suffolk_County_Court',
            'Westchester County' => 'westchester_court_list',
            'Rockland County' => 'Intake_Rockland_County_Court',
            'Hudson County' => 'Intake_Hudson_County_Court',
            'Essex County' => 'Intak_Essex_County_Court',
            'Bergen County' => 'Intake_Bergen_County_Court',
            'Union County' => 'Intake_Union_Courts',
        ];
        ?>


    <div class="county_courts" name="<?= $county ?>" style="display: none;">
        <label>Select your county court</label>
        <?= selectedRadioButtons($court, 'courtName') ?>
        <div class="radio">
            <label>
                <input type="radio" name="courtName" value="Other" <?php echo ($referral['courtName'] == 'Other') ?  "checked" : ""; ?>> Other
            </label>
            <input type="text" style="width: 100px" name="otherCourtName" value="<?php echo $referral['otherCourtName'] ?>">
        </div>
    </div>


    <div class="county_courts" name="Other" style="display:none">
        <label>Enter the exact name of the referring court: </label>
        <input type="text" style="width: 100px" name="courtName" value="<?php echo $referral['courtName'] ?>">
    </div>

</div>

<!-- DMV -->

<div class="row" name="DMVDiv" style="display:block">
    <label>Which DMV?</label>
    <?= selectedRadioButtons('dmv', 'dmv', $referral['dmv'] ?? '') ?>
</div>

<!-- Probation -->
<div class="row" name="probationDiv" style="display:block">
    <label>Which department of Probation referred you?<span style="color:red">*</span></label>
    <?= selectedRadioButtons('Intake_Probation', 'prob_courtCase', $referral['prob_courtCase']) ?>

    <label>Probation Officer's Name<span style="color:red">*</span></label>
    <input type="text" name="prob_offc_name" class="form-control" style="width:50%" value="<?php echo $referral['prob_offc_name'] ?>"></br>

    <label>Probation Officer's Phone Number<span style="color:red">*</span></label>
    <input type="text" name="prob_offc_ph" class="form-control" style="width:50%" value="<?php echo $referral['prob_offc_ph'] ?>"></br>

    <label>Probation Officer's Email<span style="color:red">*</span></label>
    <input type="text" name="prob_offc_email" class="form-control" style="width:50%" value="<?php echo $referral['prob_offc_email'] ?>"></br>
</div>

<div class="row" name="doctorDiv" style="display:block">
    <label>Doctor's Name<span style="color:red">*</span></label>
    <input type="text" name="doc_name" class="form-control" style="width:50%" value="<?php echo $referral['doc_name'] ?>"></br>

    <label>Doctor's Phone Number<span style="color:red">*</span></label>
    <input type="text" name="doc_phone" class="form-control" style="width:50%" value="<?php echo $referral['doc_phone'] ?>"></br>

    <label>Doctor's Email<span style="color:red">*</span></label>
    <input type="text" name="doc_email" class="form-control" style="width:50%" value="<?php echo $referral['doc_email'] ?>"></br>
</div>

<div class="row" name="hospitalDiv" style="display:block">
    <label>What is the name of the Hospital<span style="color:red">*</span></label>
    <input type="text" name="hospital_name" class="form-control" style="width:50%" value="<?php echo $referral['hospital_name'] ?>"></br>
</div>

<div class="row" name="paroleDiv" style="display:block">
    <label>Parole Officer's Name<span style="color:red">*</span></label>
    <input type="text" name="parole_offc_name" class="form-control" style="width:50%" value="<?php echo $referral['parole_offc_name'] ?>"></br>

    <label>Parole Officer's Phone Number<span style="color:red">*</span></label>
    <input type="text" name="parole_offc_ph" class="form-control" style="width:50%" value="<?php echo $referral['parole_offc_ph'] ?>"></br>


    <label>Parole Officer's Email<span style="color:red">*</span></label>
    <input type="text" name="parole_offc_email" class="form-control" style="width:50%" value="<?php echo $referral['parole_offc_email'] ?>"></br>
</div>

<div class="row" name="socialWorkerDiv" style="display:block">
    <label>Social Worker's Name<span style="color:red">*</span></label>
    <input type="text" name="social_worker_name" class="form-control" style="width:50%" value="<?php echo $referral['social_worker_name'] ?>"></br>

    <label>Social Worker's Phone Number<span style="color:red">*</span></label>
    <input type="text" name="social_worker_ph" class="form-control" style="width:50%" value="<?php echo $referral['social_worker_ph'] ?>"></br>

    <label>Social Worker's Email<span style="color:red">*</span></label>
    <input type="text" name="social_worker_email" class="form-control" style="width:50%" value="<?php echo $referral['social_worker_email'] ?>"></br>
</div>

