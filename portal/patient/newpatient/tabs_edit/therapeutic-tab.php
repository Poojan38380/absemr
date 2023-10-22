<input type="hidden" name="id" value="<?php echo $therapeutic['id'] ?>">
<div class="row">
    <label>What is your primary means of finical support?</label></br>
    <?php echo selectedRadioButtons('therap_support_list', 'therapSupportList', $therapeutic['therapSupportList'], true) ?>
</div>

