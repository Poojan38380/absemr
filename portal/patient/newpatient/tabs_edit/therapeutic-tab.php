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
