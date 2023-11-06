<input type="hidden" name="id" value="<?php echo $therapeutic['id'] ?? '' ?>">
<div class="row">
    <label>What is your primary means of finical support?</label></br>
    <?php echo selectedRadioButtons('therap_support_list', 'therapSupportList', $therapeutic['therapSupportList'] ?? '', true) ?>
</div>

<div class="row" name="employeementDiv" style="display:none"></br>
    <label>Career/Industry and Where do you work?<span style="color:red"> * </span></label></br>
    <input type="text" style="width:50%" name="career" value="<?php echo $therapeutic['career'] ?? '' ?>" class="form-control"></br>
    <label>Job Position <span style="color:red"> * </span></label></br>
    <input type="text" style="width:50%" name="work_position" value="<?php echo $therapeutic['work_position'] ?? '' ?>" class="form-control" ></br>

    <label>Are you satisfied with your current work experience?<span style="color:red"> * </span></label></br>
    <input type="radio" name="work_exp" value="yes" <?php echo ($therapeutic['work_exp'] ?? '' == 'yes') ?  "checked" : ""; ?> >Yes</br>
    <input type="radio" name="work_exp" value="no" <?php echo ($therapeutic['work_exp'] ?? '' == 'no') ?  "checked" : ""; ?> >No</br>

    <label>How long have you worked there? <span style="color:red"> * </span></label></br>
    <select name="how_long" class="form-control" value="<?php echo $therapeutic['how_long'] ?? '' ?>" style="width:50%">
        <option value="less_1" <?php echo ($therapeutic['how_long'] ?? '' == 'less_1') ?  "selected" : ""; ?> >Less than 1 year</option>
        <option value="1_3" <?php echo ($therapeutic['how_long'] ?? '' == '1_3') ?  "selected" : ""; ?> >1 - 3 years</option>
        <option value="3_5" <?php echo ($therapeutic['how_long']  ?? ''== '3_5') ?  "selected" : ""; ?> >3 - 5 years</option>
        <option value="more_5" <?php echo ($therapeutic['how_long'] ?? '' == 'more_5') ?  "selected" : ""; ?> >More than 5 years</option>
    </select></br>
</div>


    <div class="row" style="display:none" name="unemployeementDiv">
        <label>How long have you been unemployed? <span style="color:red"> * </span></label></br>
        <input type="text" style="width:50%" name="how_long_unemployeed" value="<?php echo $therapeutic['how_long_unemployeed'] ?? '' ?>" class="form-control" ></br>
        <label>Reason for unemployment <span style="color:red"> * </span></label></br>
        <textarea name="reason_unemployee" class="form-control"><?php echo $therapeutic['reason_unemployee'] ?? '' ?></textarea>
    </div>



    <div class="row" style="display:none" name="publicAssistanceDiv">
        <label>How long have you been receiving assistance? <span style="color:red"> * </span></label></br>
        <input type="text" style="width:50%" name="receiving_assistance" value="<?php echo $therapeutic['receiving_assistance'] ?? '' ?>" class="form-control" ></br>
    </div>



    <div class="row" style="display:none" name="ssi_ssd_div">
        <label>What is your disability? <span style="color:red"> * </span></label></br>
        <input type="text" style="width:50%" name="ssi_ssd" class="form-control" value="<?php echo $therapeutic['ssi_ssd'] ?? '' ?>" ></br>
    </div>


    <div class="row" style="display:none" name="family_sup_div">
        <label>Who in your family do you receive support from? <span style="color:red"> * </span></label></br>
        <input type="text" style="width:50%" name="family_support" class="form-control" value="<?php echo $therapeutic['family_support'] ?? '' ?>" ></br>
    </div>

<div class="row">
    <label>Education Level</label></br>
    <?php echo selectedRadioButtons('education_list', 'education_level_list', $therapeutic['education_level_list'] ?? '', true) ?>
</div>

<div class="row" name="college_list_div" style="display:none">
    <?php echo selectedDropdown('college_list', 'college_list', $therapeutic['college_list'] ?? '', false) ?>
    </select>
</div>

<div class="row">
    <label>Family Composition</label></br>
    <label>Which best describes your relationship status?<span style="color:red"> * </span></label></br>
    <?php echo selectedRadioButtons('fam_relationship_list', 'fam_relationship_list', $therapeutic['fam_relationship_list'] ?? '', true) ?>
</div>

<div class="row" name="DivorcedDiv" style="display:none">
    <label>How many times have you been married?</label></br>
    <input type="text" name="how_many_married" value="<?php echo $therapeutic['how_many_married'] ?? '' ?>" class="form-control" style="width:50%" ></br>
    <label>What are your ex partner('s) name(s)<span style="color:red"> * </span></label></br>
    <input type="text" name="ex_partner_name" value="<?php echo $therapeutic['ex_partner_name'] ?? '' ?>" class="form-control" style="width:50%" ></br>
</div>

    <div class="row" name="currentMarriedDiv" style="display:none">
        <label>What is your spouse's name?<span style="color:red"> * </span></label></br>
        <input type="text" name="spouse_name" class="form-control" value="<?php echo $therapeutic['spouse_name'] ?? '' ?>" style="width:50%" ></br>
    </div>

    <div class="row" name="lastRelationShipDiv" style="display:none">
        <label>When was your last relationship?<span style="color:red"> * </span></label></br>
        <input type="text" name="last_relationship" value="<?php echo $therapeutic['last_relationship'] ?? '' ?>" class="form-control" style="width:50%" ></br>
    </div>

<div class="row">
    <label>Household Members</label></br>
    <label>Who do you live with?<span style="color:red"> * </span></label><br>
    <?php echo selectedCheckBox('who_live_with', 'who_live_with', $therapeutic['who_live_with'] ?? '', false) ?>
</div>

<div class="row">
    <h4>Children</h4>
    <label>How many children/step children do you have in total?<span style="color:red"> * </span></label><br>
    <?php echo selectedDropdown('how_many_children', 'how_many_children', $therapeutic['how_many_children'] ?? '', false) ?>
    </select>
</div>
<div class="row" name="childrens_names_ages" style="display: none">
    <label><?php xlt('What are the names and ages of your children') ?></label>
    <input type="text" name="all_my_children" value="<?php echo $therapeutic['all_my_children'] ?? '' ?>" class="form-control" style="width:50%" >

</div>
<!-- family composition -->
<div class="row">
    <label>Is a member of your family supportive of your recovery/treatment? <span style="color:red"> * </span></label></br>
    <input type="radio" name="fam_support_recovery" value="yes" <?php echo ($therapeutic['fam_support_recovery'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
    <input type="radio" name="fam_support_recovery" value="no" <?php echo ($therapeutic['fam_support_recovery'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>
</div>
    <div class="row" name="fam_support_recovery_div" style="display:none">
        <label>Would your family members be willing to participate in your treatment? <span style="color:red"> * </span></label></br>
        <input type="radio" name="fam_mem_willing_part" value="yes" <?php echo ($therapeutic['fam_mem_willing_part'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
        <input type="radio" name="fam_mem_willing_part" value="no" <?php echo ($therapeutic['fam_mem_willing_part'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>
    </div>

    <div class="row" name="fam_mem_willing_part_div" style="display:none">
        <label>What is the name of the family member that will participate in your treatment?<span style="color:red"> * </span></label></br>
        <input type="text" name="fam_mem_part_name" class="form-control" style="width:50%" value="<?php echo $therapeutic['fam_mem_part_name'] ?? '' ?>" ></br>
        <label>What is their relationship to you?<span style="color:red"> * </span></label></br>
        <input type="text" name="fam_mem_part_relation" class="form-control" style="width:50%" value="<?php echo $therapeutic['fam_mem_part_relation'] ?? '' ?>" ></br>
        <label>What is their phone number?<span style="color:red"> * </span></label></br>
        <input type="text" name="fam_mem_part_ph" class="form-control" style="width:50%" value="<?php echo $therapeutic['fam_mem_part_ph'] ?? '' ?>" ></br>
    </div>

    <div class="row">
        <label>Family Composition</label></br>
        <label>Is there any family history of substance abuse or mental illness?<span style="color:red"> * </span></label></br>
        <input type="radio" name="fam_sub_abuse" value="yes" <?php echo ($therapeutic['fam_sub_abuse'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
        <input type="radio" name="fam_sub_abuse" value="no" <?php echo ($therapeutic['fam_sub_abuse'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>
    </div>

    <div class="row" style="display:none" name="fam_sub_abuse_div">
        <label>Please explain the family history of substance abuse or mental illness<span style="color:red"> * </span></label></br>
        <textarea name="sub_abuse_explanation" class="form-control" ><?php echo $therapeutic['sub_abuse_explanation'] ?? '' ?></textarea></br>
    </div>

    <div class="row">
        <label>Primary care doctor</label></br>
        <label>Do you have a primary care doctor?<span style="color:red"> * </span></label></br>
        <input type="radio" name="primary_care_doc" value="yes" <?php echo ($therapeutic['primary_care_doc'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
        <input type="radio" name="primary_care_doc" value="no" <?php echo ($therapeutic['primary_care_doc'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>
    </div>

    <div class="row" name="primary_care_doc_div" style="display:none">
        <label>What is your primary care Doctor's Name?<span style="color:red"> * </span></label></br>
        <input type="text" name="pri_doc_name" value="<?php echo $therapeutic['pri_doc_name'] ?? '' ?>" class="form-control" style="width:50%" ></br>
        <label>What is your primary care doctor's phone number?</label></br>
        <input type="text" name="pri_doc_ph" value="<?php echo $therapeutic['pri_doc_ph'] ?? '' ?>" class="form-control" style="width:50%" ></br>
    </div>

    <div class="row">
        <label>Physical Health</label></br>
        <label>What do you consider your current health? (Including physical and mental health)<span style="color:red"> * </span></label></br>
        <input type="radio" name="curr_health" value="good" <?php echo ($therapeutic['curr_health'] ?? '' == 'good') ?  "checked" : ""; ?> > Good</br>
        <input type="radio" name="curr_health" value="fair" <?php echo ($therapeutic['curr_health'] ?? '' == 'fair') ?  "checked" : ""; ?> > Fair</br>
        <input type="radio" name="curr_health" value="poor" <?php echo ($therapeutic['curr_health'] ?? '' == 'poor') ?  "checked" : ""; ?> > Poor</br>
    </div>

    <div class="row" name="curr_health_good_div" style="display:none">
        <label>Please list any past medical conditions, procedures, surgeries or injuries you have had.</label></br>
        <textarea name="surgeries_details" class="form-control" ><?php echo $therapeutic['surgeries_details'] ?? '' ?></textarea></br>
    </div>

    <div class="row" name="curr_health_good_div" style="display:none">
        <label>Please list any past medical conditions, procedures, surgeries or injuries you have had.</label></br>
        <textarea name="surgeries_details" class="form-control" ><?php echo $therapeutic['surgeries_details'] ?? '' ?></textarea></br>
    </div>

    <div class="row" name="curr_health_fair_div" style="display:none">
        <label>What are your current medical conditions that you are aware of?<span style="color:red"> * </span></label></br>
        <textarea name="med_condition_details" class="form-control" ><?php echo $therapeutic['med_condition_details'] ?? '' ?></textarea></br>
        <label>Are you currently prescribed medications from a doctor?<span style="color:red"> * </span></label></br>
        <input type="radio" name="curr_pres_med" value="yes" <?php echo ($therapeutic['curr_pres_med'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
        <input type="radio" name="curr_pres_med" value="no" <?php echo ($therapeutic['curr_pres_med'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>

    <div name="curr_pre_med_div" style="display:none">
        <label>Please list the doctor-prescribed medications as well as dosages<span style="color:red"> * </span></label></br>
        <textarea name="curr_pre_med_details" class="form-control" ><?php echo $therapeutic['curr_pre_med_details'] ?? '' ?></textarea></br>
        <label>Do you take your medication as prescribed?<span style="color:red"> * </span></label></br>
        <input type="radio" name="do_you_take_med_as_pres" value="yes"> Yes</br>
        <input type="radio" name="do_you_take_med_as_pres" value="no"> No</br>

        <div name="do_you_take_med_as_pres_div" style="display:none">
            <label>Please explain why you don't take your medications as prescribed<span style="color:red"> * </span></label></br>
            <textarea name="do_you_take_med_as_pres_details" class="form-control"></textarea></br>
        </div>
    </div>

    <label>Have you had any recent hospitalization?<span style="color:red"> * </span></label></br>
    <input type="radio" name="recent_hospitalization" value="yes" <?php echo ($therapeutic['recent_hospitalization'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
    <input type="radio" name="recent_hospitalization" value="no" <?php echo ($therapeutic['recent_hospitalization'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>
    <div class="row" style="display:none" name="recent_hospitalizationDiv">
        <label>What where you treated for during your last hospitalization?</label></br>
        <textarea name="other_health_concern_details" class="form-control" ></textarea></br>
    </div>
  </div>

<div class="row">
    <h4 style="padding: 10px"><?php print xlt("Reason for Referral to ABS") ?></h4>

    <label>What ABS program(s) are you interested in or being referred to?</label></br>
    <?php echo selectedCheckBox('being_referred_to', 'being_referred_to', $therapeutic['being_referred_to'] ?? '', false) ?>

</div>

<div class="row">
    <label>What are the reasons you are being referred for services & what ABS program(s) are you interested in enrolling in?</label></br>
    <?php echo selectedCheckBox('being_referred_for_service', 'being_referred_for_service', $therapeutic['being_referred_for_service'] ?? '', false) ?>
</div>

<div class="row" name="being_rf_for_services_anger_mgmt_div" style="display:none">
    <label>When was the last time you were in an argument or domestic dispute?<span style="color:red"> * </span></label></br>
    <?php echo selectedRadioButtons('argument_domestic_dispute_list', 'anger_mgmt_time_list', $therapeutic['anger_mgmt_time_list'] ?? '', true) ?>
    <label>Were you ever in a physical confrontation or fight?<span style="color:red"> * </span></label><br>
    <input type="radio" name="physical_confrontation" value="yes" <?php echo ($therapeutic['physical_confrontation'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
    <input type="radio" name="physical_confrontation" value="no" <?php echo ($therapeutic['physical_confrontation'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>

    <div name="physical_confrontationDiv" style="display:none">
        <label>Who were you fighting with?<span style="color:red"> * </span></label><br>
        <?php echo selectedRadioButtons('fighting_with', 'fighting_with', $therapeutic['fighting_with'] ?? '', true) ?>
    </div>

    <label>Have you ever physically hurt or injured someone?<span style="color:red"> * </span></label><br>
    <input type="radio" name="physically_hurt" value="yes" <?php echo ($therapeutic['physically_hurt'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
    <input type="radio" name="physically_hurt" value="no" <?php echo ($therapeutic['physically_hurt'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>
    <div name="injuriesSustainDiv" style="display:none">
        <label>What injuries did they sustain?<span style="color:red"> * </span></label><br>
        <textarea name="injurySusDetail" class="form-control" > <?php echo $therapeutic['physically_hurt'] ?? '' ?></textarea>
    </div>
    <label>Were you ever arrested for a violent crime?<span style="color:red"> * </span></label><br>
    <input type="radio" name="arrested_violent_crime" value="yes" <?php echo ($therapeutic['physically_hurt'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
    <input type="radio" name="arrested_violent_crime" value="no" <?php echo ($therapeutic['physically_hurt'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>
    <label>Has impulsive anger or aggression caused you other problems in your life? <span style="color:red"> * </span></label><br>
    <?php echo selectedRadioButtons('anger_or_agression_caused', 'anger_or_agression_caused', $therapeutic['anger_or_agression_caused'] ?? '', true) ?>
</div>

<!-- Alcohol div -->
    <div class="row" style="display:none" name="alcohol_drug_abuse_div">
        <label>How often do you have a drink containing alcohol?</label></br>
        <?php echo selectedRadioButtons('drug_consumption_duration', 'dring_contain_alc', $therapeutic['dring_contain_alc'] ?? '', true) ?>

        <label>How many standard drinks containing alcohol do you have on a typical day when drinking?</label></br>
        <?php echo selectedRadioButtons('std_drink_contain_alcohol', 'when_drink_drings', $therapeutic['when_drink_drings'] ?? '', true) ?>

        <label>How often do you have six or more drinks on one occasion</label></br>
        <?php echo selectedRadioButtons('how_often_drink', 'occasional_drinks', $therapeutic['occasional_drinks'] ?? '', true) ?>

        <label>During the past year, how often have you found that you were not able to stop drinking once you had started?</label></br>
        <?php echo selectedRadioButtons('how_often_drink', 'how_often_stop_drink', $therapeutic['how_often_stop_drink'] ?? '', true) ?>

        <label>During the past year, how often have you failed to do what was normally expected of you because of drinking?</label></br>
        <?php echo selectedRadioButtons('how_often_drink', 'how_often_failed_stop_drink', $therapeutic['how_often_failed_stop_drink'] ?? '', true) ?>

        <label>During the past year, how often have you needed a drink in the morning to get yourself going after a heavy drinking session?</label></br>
        <?php echo selectedRadioButtons('how_often_drink', 'how_often_need_drink', $therapeutic['how_often_need_drink'] ?? '', true) ?>

        <label>During the past year, how often have you had a feeling of guilt or remorse after drinking?</label></br>
        <?php echo selectedRadioButtons('how_often_drink', 'remorse_after_drink', $therapeutic['remorse_after_drink'] ?? '', true) ?>

        <label>During the past year, how often have you been unable to remember what happened the night before because you had been drinking?</label></br>
        <?php echo selectedRadioButtons('how_often_drink', 'unable_remember_night_session', $therapeutic['unable_remember_night_session'] ?? '', true) ?>

        <label>Have you or someone else been injured as a result of your drinking?</label></br>
        <input type="radio" name="injured_result_drink" value="no" <?php echo ($therapeutic['injured_result_drink'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>
        <input type="radio" name="injured_result_drink" value="yes_not_in_past_year" <?php echo ($therapeutic['injured_result_drink'] ?? '' == 'yes_not_in_past_year') ?  "checked" : ""; ?> > Yes, but not in the past year</br>
        <input type="radio" name="injured_result_drink" value="yes_during_year" <?php echo ($therapeutic['injured_result_drink'] ?? '' == 'yes_during_year') ?  "checked" : ""; ?> > Yes, during the past year</br>

        <label>Has a relative or friend, doctor or other health worker beeen concerned about your drinking or suggested you cut down?</label></br>
        <input type="radio" name="concerned_about_drink" value="no" <?php echo ($therapeutic['concerned_about_drink'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>
        <input type="radio" name="concerned_about_drink" value="yes_not_in_past_year" <?php echo ($therapeutic['concerned_about_drink'] ?? '' == 'yes_not_in_past_year') ?  "checked" : ""; ?> > Yes, but not in the past year</br>
        <input type="radio" name="concerned_about_drink" value="yes_during_year" <?php echo ($therapeutic['concerned_about_drink'] ?? '' == 'yes_during_year') ?  "checked" : ""; ?> > Yes, during the past year</br>

        <label>What are your drugs of choice? Please list all.</label></br>
        <?php echo selectedCheckBox('drug_choices', 'drugs_of_chioces', $therapeutic['drugs_of_chioces'] ?? '', true) ?>

        <label>How old were you the first time you used?</label></br>
        <input type="text" name="first_time_used" value="<?php echo $therapeutic['first_time_used'] ?? '' ?>" class="form-control" style="width:50%" ></br>

        <label>How much did you use at the height of your usage?</label></br>
        <input type="text" name="height_of_usage" value="<?php echo $therapeutic['height_of_usage'] ?? '' ?>" class="form-control" style="width:50%" ></br>

        <label>Have you ever been in alcohol or drug treatment before?</label></br>
        <input type="radio" name="ever_been_in_alcohol" value="yes" <?php echo ($therapeutic['ever_been_in_alcohol'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
        <input type="radio" name="ever_been_in_alcohol" value="no" <?php echo ($therapeutic['ever_been_in_alcohol'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>
    </div>


    <div class="row" style="display:none" name="dwi_dui_div">
        <label>How many drinking and driving offenses have you had?</label></br>
        <input type="text" name="how_drink_drive_offence" class="form-control" style="width:50%" value="<?php echo $therapeutic['how_drink_drive_offence'] ?? '' ?> " ></br>

        <label>Have you ever been in drug treatment before?</label></br>
        <input type="radio" name="drug_treat_before_ever" value="yes" <?php echo ($therapeutic['drug_treat_before_ever'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
        <input type="radio" name="drug_treat_before_ever" value="no" <?php echo ($therapeutic['drug_treat_before_ever'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>
    </div>

    <div class="row" style="display:none" name="gam_pblm_div">
        <label>Gambling - Please check all that apply</label><span style="color:red"> * </span></br>
        <?php echo selectedCheckBox('gam_pblm_list', 'gamList', $therapeutic['gamList'] ?? '', true) ?>
    </div>

    <div class="row" style="display:none" name="sex_behav_div">
        <label>Are you currently sexually active? </label><span style="color:red">*</span></br>
        <input type="radio" name="sex_active" value="yes" <?php echo ($therapeutic['sex_active'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
        <input type="radio" name="sex_active" value="no" <?php echo ($therapeutic['sex_active'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>

        <label>What is your sexual preference</label><span style="color:red">*</span></br>
        <?php echo selectedRadioButtons('sexual_orientation', 'sex_preference', $therapeutic['sex_preference'] ?? '', true) ?>

        <label>Are you satisfied with your sexual identity?</label><span style="color:red">*</span></br>
        <input type="radio" name="satisfied_sex_identity" value="yes" <?php echo ($therapeutic['satisfied_sex_identity'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
        <input type="radio" name="satisfied_sex_identity" value="no" <?php echo ($therapeutic['satisfied_sex_identity'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>

        <label>Have you ever been charged with a sex crime?</label><span style="color:red">*</span></br>
        <input type="radio" name="charged_sex_crime" value="yes" <?php echo ($therapeutic['charged_sex_crime'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes</br>
        <input type="radio" name="charged_sex_crime" value="no" <?php echo ($therapeutic['charged_sex_crime'] ?? '' == 'no') ?  "checked" : ""; ?> > No</br>

        <label>Have you ever had any other problems in your life as a result of impulsive sexual behavior such as the following?</label></br>
        <?php echo selectedCheckBox('impulsive_sex_behave', 'impulsive_sex_behave', $therapeutic['impulsive_sex_behave'] ?? '', false) ?>
    </div>


    <div class="row" style="display:none" name="domestic_violence_div"></br>
        <label>When was the last time you were in an argument or domestic dispute?<span style="color:red"> * </span></label></br>
        <?php echo selectedRadioButtons('argument_domestic_dispute_list', 'domestic_violence', $therapeutic['domestic_violence'] ?? '', true) ?>

        <label>Were you ever in a physical confrontation or fight?<span style="color:red"> * </span></label></br>
        <input type="radio" name="phy_confrintation" value="yes" <?php echo ($therapeutic['phy_confrintation'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes </br>
        <input type="radio" name="phy_confrintation" value="no" <?php echo ($therapeutic['phy_confrintation'] ?? '' == 'no') ?  "checked" : ""; ?> > No </br>

        <label>Have you ever physically hurt or injured someone?<span style="color:red"> * </span></label></br>
        <input type="radio" name="phy_hurt" value="yes" <?php echo ($therapeutic['phy_hurt'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes </br>
        <input type="radio" name="phy_hurt" value="no" <?php echo ($therapeutic['phy_hurt'] ?? '' == 'no') ?  "checked" : ""; ?> > No </br>

        <label>Were you ever arrested for a violent crime?<span style="color:red"> * </span></label></br>
        <input type="radio" name="ever_arrested_violent_crime" value="yes" <?php echo ($therapeutic['ever_arrested_violent_crime'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes </br>
        <input type="radio" name="ever_arrested_violent_crime" value="no" <?php echo ($therapeutic['ever_arrested_violent_crime'] ?? '' == 'no') ?  "checked" : ""; ?> > No </br>

        <label>Has impulsive anger or aggression caused you other problems in your life?<span style="color:red"> * </span></label></br>
        <?php echo selectedCheckBox('domestic_violence_list', 'domestic_violence_list', $therapeutic['domestic_violence_list'] ?? '', false) ?>
    </div>

    <div class="row" style="display:none" name="parenting_issues_div"></br>
        <label>Please explain the parenting issues</label></br>
        <textarea class="form-control" name="explain_parenting_issue"><?php echo $therapeutic['explain_parenting_issue'] ?? '' ?></textarea></br>
    </div>

    <div class="row" style="display:none" name="non_chemical_addiction_div"></br>
        <label>Please explain your non-chemical addiction</label></br>
        <textarea class="form-control" name="non_chemical_addiction"><?php echo $therapeutic['non_chemical_addiction'] ?? '' ?></textarea></br>
    </div>


<div class="row">
    <h4>Suicidal Thoughts</h4>
    <label>Have you ever had any suicidal thinking or thoughts of hurting/killing yourself?<span style="color:red"> * </span></label></br>
    <?php echo selectedRadioButtons('Intake_suicide', 'Intake_suicide', $therapeutic['Intake_suicide'] ?? '', true) ?>
</div>


    <div class="row" style="display:none" name="last_attempt_explanation_div">
        <label>Please explain the method and when the last attempt was<span style="color:red"> * </span></label></br>
        <textarea class="form-control"></textarea></br>
    </div>


    <div class="row" style="display:none" name="felt_inclined_div">
        <label>When was the last time you felt inclined to harm yourself?<span style="color:red"> * </span></label></br>
        <div class="radio">
            <label>
                <input type="radio" name="felt_inclined_harm" value="today" <?php echo ($therapeutic['felt_inclined_harm'] ?? '' == 'today') ?  "checked" : ""; ?> > Today
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="felt_inclined_harm" value="past_2_weeks" <?php echo ($therapeutic['felt_inclined_harm'] ?? '' == 'past_2_weeks') ?  "checked" : ""; ?> > Within the past 2 weeks
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="felt_inclined_harm" value="past_12_month" <?php echo ($therapeutic['felt_inclined_harm'] ?? '' == 'past_12_month') ?  "checked" : ""; ?> > Within the past 12 months
            </label>
        </div>
    </div>

    <div class="row" style="display:none" name="felt_inclined_div">
        <label>When was the last time you felt inclined to harm yourself?<span style="color:red"> * </span></label></br>
        <div class="radio">
            <label>
                <input type="radio" name="felt_inclined_harm" value="today" <?php echo ($therapeutic['felt_inclined_harm'] ?? '' == 'today') ?  "checked" : ""; ?> > Today
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="felt_inclined_harm" value="past_2_weeks" <?php echo ($therapeutic['felt_inclined_harm'] ?? '' == 'past_2_weeks') ?  "checked" : ""; ?> > Within the past 2 weeks
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="felt_inclined_harm" value="past_12_month" <?php echo ($therapeutic['felt_inclined_harm'] ?? '' == 'past_12_month') ?  "checked" : ""; ?> > Within the past 12 months
            </label>
        </div>
    </div>

    <div class="row" style="display:none" name="feelings_explanation_div">
        <label>Please explain the best you can the thoughts and feelings you were or are having.<span style="color:red"> * </span></label></br>
        <textarea class="form-control"></textarea></br>
    </div>


<div class="row">
    <h4>Legal History</h4>
    <label>Have you ever been arrested?<span style="color:red"> * </span></label></br>
    <div class="radio">
        <label>
            <input type="radio" name="arrested_ever" value="yes" <?php echo ($therapeutic['arrested_ever'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="arrested_ever" value="no" <?php echo ($therapeutic['arrested_ever'] ?? '' == 'no') ?  "checked" : ""; ?> > No
        </label>
    </div>
</div>

    <div class="row" style="display:none" name="arrested_ever_yes_div">
        <label>How many times have you been arrested?<span style="color:red"> * </span></label></br>
        <?php echo selectedDropdown('how_many_arrest', 'how_many_arrest', $therapeutic['how_many_arrest'] ?? '', false) ?>
    </div>


    <div class="row" style="display:none" name="arrested_explanation_div">
        <label>Please explain the best you can. What charges were you arrested for? What year did the charges occur? What was the outcome of the charges?<span style="color:red"> * </span></label></br>
        <textarea class="form-control"></textarea></br>
    </div>

    <div class="row" style="display:none" name="monitoring_agency_div">
        <label>Are you being supervised or monitored by any monitoring agency such as: Parole, Probation or other monitoring program?<span style="color:red"> * </span></label></br>
        <div class="radio">
            <label>
                <input type="radio" name="monitor_agency" value="yes" <?php echo ($therapeutic['monitor_agency'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="monitor_agency" value="no" <?php echo ($therapeutic['monitor_agency'] ?? '' == 'no') ?  "checked" : ""; ?> > No
            </label>
        </div>
    </div>


        <div class="row" style="display:none" name="sentence_length_div">
            <label>How long is your sentence to supervision?<span style="color:red"> * </span></label></br>
            <?php echo selectedDropdown('How_long_is_your_sentence_to_supervision_', 'sentence_length', $therapeutic['sentence_length'] ?? '', false) ?>
        </div>


    <div class="row" style="display:none" name="incarceration_div">
        <label>Have you ever been incarcerated?<span style="color:red"> * </span></label></br>
        <div class="radio">
            <label>
                <input type="radio" name="incarcerated" value="yes" <?php echo ($therapeutic['incarcerated'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="incarcerated" value="no" <?php echo ($therapeutic['incarcerated'] == 'no') ?  "checked" : ""; ?> > No
            </label>
        </div>
    </div>


        <div class="row" style="display:none" name="incarcerated_length_div">
            <label>If yes how many times incarcerated?<span style="color:red"> * </span></label></br>
            <?php echo selectedDropdown('how_many_arrest', 'incarcerated_length', $therapeutic['incarcerated_length'] ?? '', false) ?>
        </div>


        <div class="row" style="display:none" name="incarcerated_years_div">
            <label>How long, in total, have you spent incarcerated?<span style="color:red"> * </span></label></br>
            <?php echo selectedDropdown('How_long_is_your_sentence_to_supervision_', 'incarcerated_years', $therapeutic['incarcerated_years'] ?? '', false) ?>
        </div>


    <div class="row" style="display:none" name="protection_orders_div">
        <label>Are there any orders of protection against you?<span style="color:red"> * </span></label></br>
        <div class="radio">
            <label>
                <input type="radio" name="protection_orders" value="yes" <?php echo ($therapeutic['protection_orders'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="protection_orders" value="no" <?php echo ($therapeutic['protection_orders'] ?? '' == 'no') ?  "checked" : ""; ?> > No
            </label>
        </div>
    </div>

    <div class="row" style="display:none" name="state_registry_div">
        <label>Are you listed on any state registry?<span style="color:red"> * </span></label></br>
        <div class="radio">
            <label>
                <input type="radio" name="state_registry" value="yes" <?php echo ($therapeutic['state_registry'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="state_registry" value="no" <?php echo ($therapeutic['state_registry'] ?? '' == 'no') ?  "checked" : ""; ?> > No
            </label>
        </div>
    </div>


        <div class="row" style="display:none" name="state_registry_list_div">
            <label>If yes, which state registry?<span style="color:red"> * </span></label></br>
            <?php echo selectedDropdown('State_Registry', 'state_registry_list', $therapeutic['state_registry_list'] ?? '', false) ?>
        </div>



        <div class="row" style="display:none" name="sex_offender_div">
            <label>If sex offender registry, choose level:<span style="color:red"> * </span></label></br>
            <?php echo selectedDropdown('Sex_Offender', 'sex_offender', $therapeutic['sex_offender'] ?? '', false) ?>
        </div>



<div class="row">
    <h4>Trauma History</h4>
    <label>Have you ever experienced sexual/verbal/physical abuse and/or trauma?<span style="color:red"> * </span></label></br>
    <div class="radio">
        <label>
            <input type="radio" name="exp_ver_phy_abuse" value="yes" <?php echo ($therapeutic['exp_ver_phy_abuse'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="exp_ver_phy_abuse" value="no" <?php echo ($therapeutic['exp_ver_phy_abuse'] ?? '' == 'no') ?  "checked" : ""; ?> > No
        </label>
    </div>
</div>


    <div class="row" style="display:none" name="victimDiv">
        <label>What were you a victim of?<span style="color:red"> * </span></label></br>
        <?php echo selectedCheckBox('Intake_Victim', 'Intake_Victim', $therapeutic['Intake_Victim'] ?? '', true) ?>

        <label>Please explain anything checked above.</label></br>
        <textarea class="form-control" name="explain_victim" ><?php echo $therapeutic['explain_victim'] ?? '' ?></textarea>
    </div>


<div class="row">
    <h4>Mental Health</h4>
    <label>Have you ever received psychotherapy or mental health treatment before?<span style="color:red"> * </span></label>
    <div class="radio">
        <label>
            <input type="radio" name="mental_health_treat" value="yes" <?php echo ($therapeutic['mental_health_treat'] ?? '' == 'yes') ?  "checked" : ""; ?> > Yes
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="mental_health_treat" value="no" <?php echo ($therapeutic['mental_health_treat'] ?? '' == 'no') ?  "checked" : ""; ?> > No
        </label>
    </div>
</div>


    <div class="row" style="display:none" name="mentalHealthYesDiv">
        <label>What mental health conditions were you treated for previously?<span style="color:red"> * </span></label></br>
        <input type="text" class="form-control" name="mentalHealthCondition" value="<?php echo $therapeutic['mentalHealthCondition'] ?? '' ?>"></br>

        <label>What kind of mental health treatment did you undergo?<span style="color:red"> * </span></label></br>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="mentalHealthTreatment[]" value="inpatient" <?php echo ($therapeutic['mentalHealthTreatment'] ?? '' === 'inpatient') ?  "checked" : ""; ?> > Inpatient
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="mentalHealthTreatment[]" value="outpatient" <?php echo ($therapeutic['mentalHealthTreatment'] ?? '' === 'outpatient') ?  "checked" : ""; ?> > Outpatient
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="mentalHealthTreatment[]" value="partialHospitaliation" <?php echo ($therapeutic['mentalHealthTreatment'] ?? '' === 'partialHospitaliation') ?  "checked" : ""; ?> > Partial hospitalization
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="mentalHealthTreatment[]" value="dayTreatment" <?php echo ($therapeutic['mentalHealthTreatment'] ?? '' === 'dayTreatment') ?  "checked" : ""; ?> > Day treatment
            </label>
        </div>
    </div>



    <div class="row" style="display:none" name="inPatientDiv">
        <label>How many times were you hospitalized for mental health? When was the last inpatient hospitalization? What was the condition you were treated for? Please explain the treatment?</label>
        <textarea class="form-control" name="inpatient_treatment_consist" ><?php echo $therapeutic['inpatient_treatment_consist'] ?? '' ?></textarea></br>
    </div>

    <div class="row" style="display:none" name="outPatientDiv">
        <label>About when was your last outpatient treatment episode?</label></br>
        <input type="text" class="form-control datepicker" name="date_treat_outputpatient" style="width:50%" value="<?php echo $therapeutic['date_treat_outputpatient'] ?>" ></br>

        <label>What type of outpatient treatment did you receive?</label></br>
        <div class="checkbox">
            <?php
            $whichChecked = explode("|", $therapeutic['outpatient_treatment']);

            ?>
            <label>
                <input type="checkbox" name="outpatient_treatment[]" value="Psychotherapy" <?php echo ($whichChecked[0] == 'Psychotherapy') ?  "checked" : ""; ?> > Psychotherapy
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="outpatient_treatment[]" value="family_therapy"
                    <?php
                    $familyTherapy = array_search('family_therapy', $whichChecked);
                    echo ($familyTherapy !== false ) ?  "checked" : "";
                    ?> > Family Therapy
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="outpatient_treatment[]" value="medication"
                    <?php
                    $receivedMedication = array_search('medication', $whichChecked);
                    echo ($receivedMedication !== false) ?  "checked" : "";
                    ?> > Medication
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="outpatient_treatment[]" value="other"
                    <?php
                    $other = array_search('other', $whichChecked);
                    echo ($other !== false) ?  "checked" : "";
                    ?> > Other
            </label>
        </div>
        <label>Who was your outpatient therapist/doctor?</label></br>
        <input type="text" value="" name="therapist_doc" class="form-control" style="width:50%" value="<?php echo $therapeutic['therapist_doc'] ?? '' ?>" ></br>

        <label>Current and past medication use including dosage? When was the last time you took the prescribed medication?</label></br>
        <textarea class="form-control" name="prescribed_medication" ><?php echo $therapeutic['prescribed_medication'] ?? '' ?></textarea>
    </div>



    <div class="row" style="display:none" name="partialHospitalDiv">
        <label>Partial Hospitalization - Name of program, date of last treatment?</label></br>
        <input type="text" class="form-control datepicker" name="name_pgm_last_treat" style="width:50%" value="<?php echo $therapeutic['name_pgm_last_treat'] ?? '' ?>" ></br>
    </div>



    <div class="row" style="display:none" name="dayTreatmentDiv">
        <label>Name of day treatment program, date of last treatment?</label></br>
        <input type="text" class="form-control datepicker" name="day_treat_name" style="width:50%" value="<?php echo $therapeutic['day_treat_name'] ?? '' ?>" ></br>
    </div>



    <div class="row" style="display:none" name="mentalHealthNoDiv" class="mb-3">
        <label>Please explain what your current primary mental health concerns are and what is motivation to seek help?</label></br>
        <textarea name="explain_primary_mentalHealth" class="form-control" ><?php echo $therapeutic['explain_primary_mentalHealth'] ?? '' ?></textarea>
    </div>

