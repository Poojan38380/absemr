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
