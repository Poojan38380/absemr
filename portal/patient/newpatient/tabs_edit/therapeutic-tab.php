<input type="hidden" name="id" value="<?php echo $therapeutic['id'] ?>">
<div class="row">
    <label>What is your primary means of finical support?</label></br>
    <?php echo selectedRadioButtons('therap_support_list', 'therapSupportList', $therapeutic['therapSupportList'], true) ?>
</div>
<?php if ($therapeutic['therapSupportList'] == 'employeement') { ?>
    <div class="row" name="employeementDiv" style="display:block"></br>
        <label>Career/Industry and Where do you work?<span style="color:red"> * </span></label></br>
        <input type="text" style="width:50%" name="career" value="<?php echo $therapeutic['career'] ?>" class="form-control"></br>
        <label>Job Position <span style="color:red"> * </span></label></br>
        <input type="text" style="width:50%" name="work_position" value="<?php echo $therapeutic['work_position'] ?>" class="form-control" ></br>

        <label>Are you satisfied with your current work experience?<span style="color:red"> * </span></label></br>
        <input type="radio" name="work_exp" value="yes" <?php echo ($therapeutic['work_exp'] == 'yes') ?  "checked" : ""; ?> >Yes</br>
        <input type="radio" name="work_exp" value="no" <?php echo ($therapeutic['work_exp'] == 'no') ?  "checked" : ""; ?> >No</br>

        <label>How long have you worked there? <span style="color:red"> * </span></label></br>
        <select name="how_long" class="form-control" value="<?php echo $therapeutic['how_long'] ?>" style="width:50%">
            <option value="less_1" <?php echo ($therapeutic['how_long'] == 'less_1') ?  "selected" : ""; ?> >Less than 1 year</option>
            <option value="1_3" <?php echo ($therapeutic['how_long'] == '1_3') ?  "selected" : ""; ?> >1 - 3 years</option>
            <option value="3_5" <?php echo ($therapeutic['how_long'] == '3_5') ?  "selected" : ""; ?> >3 - 5 years</option>
            <option value="more_5" <?php echo ($therapeutic['how_long'] == 'more_5') ?  "selected" : ""; ?> >More than 5 years</option>
        </select></br>
    </div>
<?php } ?>
<?php if ($therapeutic['therapSupportList'] == 'unemployeement') { ?>
    <div class="row" style="display:block" name="unemployeementDiv">
        <label>How long have you been unemployed? <span style="color:red"> * </span></label></br>
        <input type="text" style="width:50%" name="how_long_unemployeed" value="<?php echo $therapeutic['how_long_unemployeed'] ?>" class="form-control" ></br>
        <label>Reason for unemployment <span style="color:red"> * </span></label></br>
        <textarea name="reason_unemployee" class="form-control"><?php echo $therapeutic['reason_unemployee'] ?></textarea>
    </div>
<?php } ?>

<?php if ($therapeutic['therapSupportList'] == 'pub_assistance') { ?>
    <div class="row" style="display:block" name="publicAssistanceDiv">
        <label>How long have you been receiving assistance? <span style="color:red"> * </span></label></br>
        <input type="text" style="width:50%" name="receiving_assistance" value="<?php echo $therapeutic['receiving_assistance'] ?>" class="form-control" ></br>
    </div>
<?php } ?>

<?php if ($therapeutic['therapSupportList'] == 'ssi_ssd') { ?>
    <div class="row" style="display:block" name="ssi_ssd_div">
        <label>What is your disability? <span style="color:red"> * </span></label></br>
        <input type="text" style="width:50%" name="ssi_ssd" class="form-control" value="<?php echo $therapeutic['ssi_ssd'] ?>" ></br>
    </div>
<?php } ?>
<?php if ($therapeutic['therapSupportList'] == 'fam_support') { ?>
    <div class="row" style="display:block" name="family_sup_div">
        <label>Who in your family do you receive support from? <span style="color:red"> * </span></label></br>
        <input type="text" style="width:50%" name="family_support" class="form-control" value="<?php echo $therapeutic['family_support'] ?>" ></br>
    </div>
<?php } ?>

<div class="row">
    <label>Education Level</label></br>
    <?php echo selectedRadioButtons('education_list', 'education_level_list', $therapeutic['education_level_list'], true) ?>
</div>


<?php if ($therapeutic['education_level_list'] == 'college') { ?>
    <div class="row" name="college_list_div" style="display:block">
        <?php echo selectedDropdown('college_list', 'college_list', $therapeutic['college_list'], true) ?>
        </select>
    </div>
<?php } ?>

<div class="row">
    <label>Family Composition</label></br>
    <label>Which best describes your relationship status?<span style="color:red"> * </span></label></br>
    <?php echo selectedRadioButtons('fam_relationship_list', 'fam_relationship_list', $therapeutic['fam_relationship_list'], true) ?>
</div>
<?php if ($therapeutic['fam_relationship_list'] == 'Divorced' || $therapeutic['fam_relationship_list'] == 'Widowed') { ?>
    <div class="row" name="DivorcedDiv" style="display:block">
        <label>How many times have you been married?</label></br>
        <input type="text" name="how_many_married" value="<?php echo $therapeutic['how_many_married'] ?>" class="form-control" style="width:50%" ></br>
        <label>What are your ex partner('s) name(s)<span style="color:red"> * </span></label></br>
        <input type="text" name="ex_partner_name" value="<?php echo $therapeutic['ex_partner_name'] ?>" class="form-control" style="width:50%" ></br>
    </div>
<?php } ?>

<?php if ($therapeutic['fam_relationship_list'] == 'currently_married') { ?>
    <div class="row" name="currentMarriedDiv" style="display:block">
        <label>What is your spouse's name?<span style="color:red"> * </span></label></br>
        <input type="text" name="spouse_name" class="form-control" value="<?php echo $therapeutic['spouse_name'] ?>" style="width:50%" ></br>
    </div>
<?php } ?>

<?php if ($therapeutic['fam_relationship_list'] == 'single_never_married') { ?>
    <div class="row" name="lastRelationShipDiv" style="display:block">
        <label>When was your last relationship?<span style="color:red"> * </span></label></br>
        <input type="text" name="last_relationship" value="<?php echo $therapeutic['last_relationship'] ?>" class="form-control" style="width:50%" ></br>
    </div>
<?php } ?>

<div class="row">
    <label>Household Members</label></br>
    <label>Who do you live with?<span style="color:red"> * </span></label><br>
    <?php echo selectedCheckBox('who_live_with', 'who_live_with', $therapeutic['who_live_with'], false) ?>
</div>

<div class="row">
    <label>Children</label></br>
    <label>How many children/step children do you have in total?<span style="color:red"> * </span></label><br>
    <?php echo selectedDropdown('how_many_children', 'how_many_children', $therapeutic['how_many_children'], false) ?>
    </select>
</div>
<!-- family composition -->
<div class="row">
    <label>Family Composition</label></br>
    <label>Is a member of your family supportive of your recovery/treatment? <span style="color:red"> * </span></label></br>
    <input type="radio" name="fam_support_recovery" value="yes" <?php echo ($therapeutic['fam_support_recovery'] == 'yes') ?  "checked" : ""; ?> > Yes</br>
    <input type="radio" name="fam_support_recovery" value="no" <?php echo ($therapeutic['fam_support_recovery'] == 'no') ?  "checked" : ""; ?> > No</br>


    <?php if ($therapeutic['fam_support_recovery'] == 'yes') { ?>
        <div class="row" name="fam_support_recovery_div" style="display:block">
            <label>Would your family members be willing to participate in your treatment? <span style="color:red"> * </span></label></br>
            <input type="radio" name="fam_mem_willing_part" value="yes" <?php echo ($therapeutic['fam_mem_willing_part'] == 'yes') ?  "checked" : ""; ?> > Yes</br>
            <input type="radio" name="fam_mem_willing_part" value="no" <?php echo ($therapeutic['fam_mem_willing_part'] == 'no') ?  "checked" : ""; ?> > No</br>
        </div>
    <?php } ?>

    <?php if ($therapeutic['fam_mem_willing_part'] == 'yes') { ?>
        <div class="row" name="fam_mem_willing_part_div" style="display:block">
            <label>What is the name of the family member that will participate in your treatment?<span style="color:red"> * </span></label></br>
            <input type="text" name="fam_mem_part_name" class="form-control" style="width:50%" value="<?php echo $therapeutic['fam_mem_part_name'] ?>" ></br>
            <label>What is their relationship to you?<span style="color:red"> * </span></label></br>
            <input type="text" name="fam_mem_part_relation" class="form-control" style="width:50%" value="<?php echo $therapeutic['fam_mem_part_relation'] ?>" ></br>
            <label>What is their phone number?<span style="color:red"> * </span></label></br>
            <input type="text" name="fam_mem_part_ph" class="form-control" style="width:50%" value="<?php echo $therapeutic['fam_mem_part_ph'] ?>" ></br>
        </div>
    <?php } ?>
    <div class="row">
        <label>Family Composition</label></br>
        <label>Is there any family history of substance abuse or mental illness?<span style="color:red"> * </span></label></br>
        <input type="radio" name="fam_sub_abuse" value="yes" <?php echo ($therapeutic['fam_sub_abuse'] == 'yes') ?  "checked" : ""; ?> > Yes</br>
        <input type="radio" name="fam_sub_abuse" value="no" <?php echo ($therapeutic['fam_sub_abuse'] == 'no') ?  "checked" : ""; ?> > No</br>
    </div>

    <?php if ($therapeutic['fam_sub_abuse'] == 'yes') { ?>
        <div class="row" style="display:block" name="fam_sub_abuse_div">
            <label>Please explain the family history of substance abuse or mental illness<span style="color:red"> * </span></label></br>
            <textarea name="sub_abuse_explanation" class="form-control" ><?php echo $therapeutic['sub_abuse_explanation'] ?></textarea></br>
        </div>
    <?php } ?>


    <div class="row">
        <label>Primary care doctor</label></br>
        <label>Do you have a primary care doctor?<span style="color:red"> * </span></label></br>
        <input type="radio" name="primary_care_doc" value="yes" <?php echo ($therapeutic['primary_care_doc'] == 'yes') ?  "checked" : ""; ?> > Yes</br>
        <input type="radio" name="primary_care_doc" value="no" <?php echo ($therapeutic['primary_care_doc'] == 'no') ?  "checked" : ""; ?> > No</br>
    </div>

    <?php if ($therapeutic['primary_care_doc'] == 'yes') { ?>
        <div class="row" name="primary_care_doc_div" style="display:block">
            <label>What is your primary care Doctor's Name?<span style="color:red"> * </span></label></br>
            <input type="text" name="pri_doc_name" value="<?php echo $therapeutic['pri_doc_name'] ?>" class="form-control" style="width:50%" ></br>
            <label>What is your primary care doctor's phone number?</label></br>
            <input type="text" name="pri_doc_ph" value="<?php echo $therapeutic['pri_doc_ph'] ?>" class="form-control" style="width:50%" ></br>
        </div>
    <?php } ?>

    <div class="row">
        <label>Physical Health</label></br>
        <label>What do you consider your current health? (Including physical and mental health)<span style="color:red"> * </span></label></br>
        <input type="radio" name="curr_health" value="good" <?php echo ($therapeutic['curr_health'] == 'good') ?  "checked" : ""; ?> > Good</br>
        <input type="radio" name="curr_health" value="fair" <?php echo ($therapeutic['curr_health'] == 'fair') ?  "checked" : ""; ?> > Fair</br>
        <input type="radio" name="curr_health" value="poor" <?php echo ($therapeutic['curr_health'] == 'poor') ?  "checked" : ""; ?> > Poor</br>
    </div>

    <?php if ($therapeutic['curr_health'] == 'good') { ?>
        <div class="row" name="curr_health_good_div" style="display:block">
            <label>Please list any past medical conditions, procedures, surgeries or injuries you have had.</label></br>
            <textarea name="surgeries_details" class="form-control" ><?php echo $therapeutic['surgeries_details'] ?></textarea></br>
        </div>
    <?php } ?>
    <?php if ($therapeutic['curr_pres_med'] == 'yes') { ?>
        <div name="curr_pre_med_div" style="display:block">
            <label>Please list the doctor-prescribed medications as well as dosages<span style="color:red"> * </span></label></br>
            <textarea name="curr_pre_med_details" class="form-control" ><?php echo $therapeutic['curr_pre_med_details'] ?></textarea></br>
        </div>

        <label>Do you take your medication as prescribed?<span style="color:red"> * </span></label></br>
        <input type="radio" name="do_you_take_med_as_pres" value="yes" <?php echo ($therapeutic['do_you_take_med_as_pres'] == 'yes') ?  "checked" : ""; ?> > Yes</br>
        <input type="radio" name="do_you_take_med_as_pres" value="no" <?php echo ($therapeutic['do_you_take_med_as_pres'] == 'no') ?  "checked" : ""; ?> > No</br>
    <?php } ?>
    <?php if ($therapeutic['do_you_take_med_as_pres'] == 'no') { ?>
        <div name="do_you_take_med_as_pres_div" style="display:block">
            <label>Please explain why you don't take your medications as prescribed<span style="color:red"> * </span></label></br>
            <textarea name="do_you_take_med_as_pres_details" class="form-control" ></textarea></br>
        </div>
    <?php } ?>

    <label>Have you had any recent hospitalization?<span style="color:red"> * </span></label></br>
    <input type="radio" name="recent_hospitalization" value="yes" <?php echo ($therapeutic['recent_hospitalization'] == 'yes') ?  "checked" : ""; ?> > Yes</br>
    <input type="radio" name="recent_hospitalization" value="no" <?php echo ($therapeutic['recent_hospitalization'] == 'no') ?  "checked" : ""; ?> > No</br>

    <?php if ($therapeutic['recent_hospitalization'] == 'yes') { ?>
        <div class="row" style="display:block" name="recent_hospitalizationDiv">
            <label>What where you treated for during your last hospitalization?</label></br>
            <textarea name="other_health_concern_details" class="form-control" ></textarea></br>
        </div>
    <?php } ?>
</div>
<?php //} ?>
<div class="row">
    <label>Reason for Referral to ABS</label></br>

    <!-- <label>What ABS program(s) are you interested in or being referred to?</label></br>
    <?php echo selectedCheckBox('being_referred_to', 'being_referred_to') ?> -->

</div>

<div class="row">
    <label>What are the reasons you are being referred for services & what ABS program(s) are you interested in enrolling in?</label></br>
    <?php echo selectedCheckBox('being_referred_for_services', 'being_referred_for_service', $therapeutic['being_referred_for_service'], true) ?>
</div>
