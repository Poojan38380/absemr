<?php /* Smarty version 2.6.33, created on 2022-09-14 19:29:49
         compiled from /var/www/html/absemr/templates/documents/general_view.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'dispatchPatientDocumentEvent', '/var/www/html/absemr/templates/documents/general_view.html', 15, false),array('function', 'xlj', '/var/www/html/absemr/templates/documents/general_view.html', 40, false),array('function', 'xlt', '/var/www/html/absemr/templates/documents/general_view.html', 107, false),array('function', 'xla', '/var/www/html/absemr/templates/documents/general_view.html', 113, false),array('modifier', 'js_url', '/var/www/html/absemr/templates/documents/general_view.html', 28, false),array('modifier', 'js_escape', '/var/www/html/absemr/templates/documents/general_view.html', 35, false),array('modifier', 'text', '/var/www/html/absemr/templates/documents/general_view.html', 105, false),array('modifier', 'attr', '/var/www/html/absemr/templates/documents/general_view.html', 114, false),array('modifier', 'attr_js', '/var/www/html/absemr/templates/documents/general_view.html', 115, false),array('modifier', 'attr_url', '/var/www/html/absemr/templates/documents/general_view.html', 164, false),)), $this); ?>

<script>

 <?php echo smarty_function_dispatchPatientDocumentEvent(array('event' => 'javascript_ready_fax_dialog'), $this);?>


 function popoutcontent(othis) <?php echo '{'; ?>

    let popsrc = $(othis).parents('body').find('#DocContents iframe').attr("src");
    let wname = '_' + Math.random().toString(36).substr(2, 6);
    let opt = "menubar=no,location=no,resizable=yes,scrollbars=yes,status=no";
    window.open(popsrc,wname, opt);

    return false;
 <?php echo '}'; ?>


 // Process click on Delete link.
 function deleteme(docid) <?php echo '{'; ?>

  dlgopen('interface/patient_file/deleter.php?document=' + encodeURIComponent(docid) + '&csrf_token_form=' + <?php echo ((is_array($_tmp=$this->_tpl_vars['csrf_token_form'])) ? $this->_run_mod_handler('js_url', true, $_tmp) : js_url($_tmp)); ?>
, '_blank', 500, 450);
  return false;
 <?php echo '}'; ?>


 // Called by the deleter.php window on a successful delete.
 function imdeleted() <?php echo '{'; ?>

  top.restoreSession();
  window.location.href=<?php echo ((is_array($_tmp=$this->_tpl_vars['REFRESH_ACTION'])) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
;
 <?php echo '}'; ?>


 // Called to show patient notes related to this document in the "other" frame.
 function showpnotes(docid) <?php echo '{'; ?>

     let btnClose = <?php echo smarty_function_xlj(array('t' => 'Done'), $this);?>
<?php echo ';
     let url = top.webroot_url + \'/interface/patient_file/summary/pnotes.php?docid=\' + encodeURIComponent(docid);
     dlgopen(url, \'pno1\', \'modal-xl\', 500, \'\', \'\', {
         buttons: [
             {text: btnClose, close: true, style: \'default btn-sm\'}
         ]
     });
     return false;
 }'; ?>


 function submitNonEmpty( e ) <?php echo '{'; ?>

	if ( e.elements['passphrase'].value.length == 0 ) <?php echo '{'; ?>

		alert( <?php echo smarty_function_xlj(array('t' => 'You must enter a pass phrase to encrypt the document'), $this);?>
 );
	<?php echo '}'; ?>
 else <?php echo '{'; ?>

		e.submit();
	<?php echo '}'; ?>

 <?php echo '}'; ?>


// For tagging it with an encounter
function tagUpdate() <?php echo '{'; ?>

	var f = document.forms['document_tag'];
	if (f.encounter_check.checked) <?php echo '{'; ?>

		if(f.visit_category_id.value==0) <?php echo '{'; ?>

			alert(<?php echo smarty_function_xlj(array('t' => 'Please select visit category'), $this);?>
 );
			return false;
		<?php echo '}'; ?>

	<?php echo '}'; ?>
 else if (f.encounter_id.value == 0 ) <?php echo '{'; ?>

		alert(<?php echo smarty_function_xlj(array('t' => 'Please select encounter'), $this);?>
);
		return false;
	<?php echo '}'; ?>

	//top.restoreSession();
	document.forms['document_tag'].submit();
<?php echo '}'; ?>


// For new or existing encounter
function set_checkbox() <?php echo '{'; ?>

	var f = document.forms['document_tag'];
	if (f.encounter_check.checked) <?php echo '{'; ?>

		f.encounter_id.disabled = true;
		f.visit_category_id.disabled = false;
		$('.hide_clear').attr('href','javascript:void(0);');
	<?php echo '}'; ?>
 else <?php echo '{'; ?>

		f.encounter_id.disabled = false;
		f.visit_category_id.disabled = true;
		f.visit_category_id.value = 0;
		$('.hide_clear').attr('href','<?php echo $this->_tpl_vars['clear_encounter_tag']; ?>
');
	<?php echo '}'; ?>

<?php echo '}'; ?>


// For tagging it with any procedure
function tagProcedure() <?php echo '{'; ?>

	var f = document.forms['procedure_tag'];
	if(f.image_procedure_id.value == 0 ) <?php echo '{'; ?>

		alert(<?php echo smarty_function_xlj(array('t' => 'Please select procedure'), $this);?>
);
		return false;
	<?php echo '}'; ?>

	f.procedure_code.value = f.image_procedure_id.options[f.image_procedure_id.selectedIndex].getAttribute('data-code');
	document.forms['procedure_tag'].submit();
<?php echo '}'; ?>

</script>

<table class="w-100 align-top">
    <tr>
        <td>
            <div style="margin-bottom: 6px; padding-bottom: 6px; border-bottom: 3px solid var(--gray);">
            <h4><?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_name())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

              <div class="btn-group btn-toggle">
                <button class="btn btn-sm btn-secondary properties"><?php echo smarty_function_xlt(array('t' => 'Properties'), $this);?>
</button>
                <button class="btn btn-sm btn-primary active"><?php echo smarty_function_xlt(array('t' => 'Contents'), $this);?>
</button>
              </div>
            <span class="float-right">
            <script>var file = <?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_url())) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
;var mime = <?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_mimetype())) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
;</script>
            <?php echo smarty_function_dispatchPatientDocumentEvent(array('event' => 'actions_render_fax_anchor'), $this);?>

            <a class="btn btn-primary" href='' onclick='return popoutcontent(this)' title="<?php echo smarty_function_xla(array('t' => 'Pop Out Full Screen.'), $this);?>
"><?php echo smarty_function_xlt(array('t' => 'Pop Out'), $this);?>
</a>
            <a class="btn btn-primary" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['web_path'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" title="<?php echo smarty_function_xla(array('t' => 'Original file'), $this);?>
" onclick="top.restoreSession()"><?php echo smarty_function_xlt(array('t' => 'Download'), $this);?>
</a>
            <a class="btn btn-primary" href='' onclick='return showpnotes(<?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_id())) ? $this->_run_mod_handler('attr_js', true, $_tmp) : attr_js($_tmp)); ?>
)'><?php echo smarty_function_xlt(array('t' => 'Show Notes'), $this);?>
</a>
            <?php echo $this->_tpl_vars['delete_string']; ?>

            </span>
            </h4>
            </div>
        </td>
    </tr>
    <tr id="DocProperties" style="display: none;">
		<td class="align-top">
			<?php if (! $this->_tpl_vars['hide_encryption']): ?>
			<div class="mb-2">
        <form class="form-inline w-100" method="post" name="document_encrypt" action="<?php echo ((is_array($_tmp=$this->_tpl_vars['web_path'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onsubmit="return top.restoreSession()">
          <div class="form-group">
            <label class="lead font-weight-bold mr-1" for='passphrase'><?php echo smarty_function_xlt(array('t' => 'Encryption Pass Phrase'), $this);?>
:</label>
            <input class="form-control" title="<?php echo smarty_function_xla(array('t' => 'Supports TripleDES encryption/decryption only.'), $this);?>
 <?php echo smarty_function_xla(array('t' => 'Leaving the pass phrase blank will not encrypt the document'), $this);?>
" type='text' size='20' name='passphrase' id='passphrase' value='' />
            <input type="hidden" name="encrypted" value="true" />
          </div>
          <button type="button" class="btn btn-primary" onclick="submitNonEmpty(document.forms['document_encrypt']);"><?php echo smarty_function_xlt(array('t' => 'download encrypted file'), $this);?>
</button>
        </form>
      </div>
      <?php endif; ?>
	  <div class="mb-2">
        <form class="form-inline" method="post" name="document_validate" action="<?php echo ((is_array($_tmp=$this->_tpl_vars['VALIDATE_ACTION'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onsubmit="return top.restoreSession()">
          <label class="font-weight-bolder"><?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_hash_algo_title())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
 <?php echo smarty_function_xlt(array('t' => 'Hash'), $this);?>
:</label>
            <p class="d-none"><small><?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_hash())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</small></p>
          <a class="btn btn-primary btn-sm" href="javascript:;" onclick="document.forms['document_validate'].submit();"><?php echo smarty_function_xlt(array('t' => 'Validate'), $this);?>
</a>
        </form>
      </div>
      <div class="mb-2">
        <form method="post" name="document_update" action="<?php echo ((is_array($_tmp=$this->_tpl_vars['UPDATE_ACTION'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onsubmit="return top.restoreSession()">
          <div class="form-group">
            <label for="docname"><?php echo smarty_function_xlt(array('t' => 'Rename'), $this);?>
:</label>
            <input type='text' class="form-control" size='20' name='docname' id='docname' value='<?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_name())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
'/>
          </div>
          <div class="form-group">
            <label for="docdate"><?php echo smarty_function_xlt(array('t' => 'Date'), $this);?>
:</label>
            <input type='text' size='10' class='form-control datepicker' name='docdate' id='docdate' value='<?php echo ((is_array($_tmp=$this->_tpl_vars['DOCDATE'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
' title="<?php echo smarty_function_xla(array('t' => 'yyyy-mm-dd document date'), $this);?>
" />
          </div>
          <div class="form-group">
            <select name="issue_id" class="form-control"><?php echo $this->_tpl_vars['ISSUES_LIST']; ?>
</select>
          </div>
          <button class="btn btn-primary btn-sm" onclick="document.forms['document_update'].submit();"><?php echo smarty_function_xlt(array('t' => 'Update'), $this);?>
</button>
        </form>
      </div>
      <div class="mb-2">
        <form class="form-inline" method="post" name="document_move" action="<?php echo ((is_array($_tmp=$this->_tpl_vars['MOVE_ACTION'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onsubmit="return top.restoreSession()">
          <div class="input-group">
            <select class="form-control mr-1" name="new_category_id"><?php echo $this->_tpl_vars['tree_html_listbox']; ?>
</select>
              <label><?php echo smarty_function_xlt(array('t' => 'Move to Patient PID'), $this);?>
</label><input class="ml-1" type="text" class="form-control" name="new_patient_id" size="4" />
            <a class="btn btn-search btn-secondary" href="javascript:<?php echo '{}'; ?>
" onclick="top.restoreSession();var URL='controller.php?patient_finder&find&form_id=<?php echo ((is_array($_tmp="document_move['new_patient_id']")) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
&form_name=<?php echo ((is_array($_tmp="document_move['new_patient_name']")) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
'; window.open(URL, 'document_move', 'toolbar=0,scrollbars=1,location=0,statusbar=1,menubar=0,resizable=1,width=450,height=400,left=425,top=250');"></a>
              <input type="hidden" name="new_patient_name" value="" />
          </div>
          <button class="btn btn-primary ml-1" onclick="document.forms['document_move'].submit();"><?php echo smarty_function_xlt(array('t' => 'Move'), $this);?>
</button>
        </form>
      </div>
		<div class="mb-2">
        <form class="form-inline" method="post" name="document_tag" id="document_tag" action="<?php echo ((is_array($_tmp=$this->_tpl_vars['TAG_ACTION'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onsubmit="return top.restoreSession()">
          <label class="font-weight-bold mr-1"><?php echo smarty_function_xlt(array('t' => 'Tag to Encounter'), $this);?>
</label>
          <div class="input-group">
            <select class="form-control" id="encounter_id"  name="encounter_id"><?php echo $this->_tpl_vars['ENC_LIST']; ?>
</select>&nbsp;
            <a href="<?php echo $this->_tpl_vars['clear_encounter_tag']; ?>
" class="btn btn-danger hide_clear"><?php echo smarty_function_xlt(array('t' => 'clear'), $this);?>
</a>&nbsp;&nbsp;
            <input type="checkbox" name="encounter_check" id="encounter_check" onclick='set_checkbox(this)'/>
            <label for="encounter_check" class="font-weight-bold"><?php echo smarty_function_xlt(array('t' => 'Create Encounter'), $this);?>
</label>&nbsp;&nbsp;
              <label class="font-weight-bold mr-1"><?php echo smarty_function_xlt(array('t' => 'Visit Category'), $this);?>
</label><select class="form-control" id="visit_category_id" name="visit_category_id"  disabled><?php echo $this->_tpl_vars['VISIT_CATEGORY_LIST']; ?>
</select>&nbsp;
          </div>
          <button class="btn btn-primary" onclick="tagUpdate();"><?php echo smarty_function_xlt(array('t' => 'submit'), $this);?>
</button>
        </form>
      </div>
      <div class="mb-2">
        <form class="form-inline" method="post" name="procedure_tag" id="procedure_tag" action="<?php echo ((is_array($_tmp=$this->_tpl_vars['PROCEDURE_TAG_ACTION'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onsubmit="return top.restoreSession()">
          <input type='hidden' name='procedure_code' value='' />
          <label class="font-weight-bold mr-1"><?php echo smarty_function_xlt(array('t' => 'Tag to Procedure'), $this);?>
</label>
          <div class="input-group w-50">
              <select class="form-control ml-1" id="image_procedure_id" name="image_procedure_id"><?php echo $this->_tpl_vars['TAG_PROCEDURE_LIST']; ?>
</select>
              <div class="btn-group">
                <a class="btn btn-primary btn-sm" href="javascript:;" onclick="tagProcedure();"><?php echo smarty_function_xlt(array('t' => 'Submit'), $this);?>
</a>
                <a class="btn btn-danger btn-sm" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['clear_procedure_tag'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"><?php echo smarty_function_xlt(array('t' => 'Clear'), $this);?>
</a>
              </div>
          </div>
        </form>
      </div>
      <form name="notes" method="post" action="<?php echo ((is_array($_tmp=$this->_tpl_vars['NOTE_ACTION'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onsubmit="return top.restoreSession()">
        <div class="text">
          <div>
            <div class="float-left mt-2 mr-1">
              <strong><?php echo smarty_function_xlt(array('t' => 'Notes'), $this);?>
</strong>
            </div>
            <div class="float-none form-inline">
              <a class="btn btn-primary btn-sm" href="javascript:;" onclick="document.notes.identifier.value='no';document.forms['notes'].submit();"><?php echo smarty_function_xlt(array('t' => 'Add Note'), $this);?>
</a>
              &nbsp;&nbsp;&nbsp;<strong><?php echo smarty_function_xlt(array('t' => 'Email'), $this);?>
</strong>&nbsp;
              <input type="text" class="form-control" size="25" name="provide_email" id="provide_email" />
              <input type="hidden" name="identifier" id="identifier" />
              <a class="btn btn-primary btn-sm" href="javascript:;" onclick="javascript:document.notes.identifier.value='yes';document.forms['notes'].submit();"><?php echo smarty_function_xlt(array('t' => 'Send'), $this);?>
</a>
            </div>
            <div>
              <textarea cols="53" rows="8" wrap="virtual" name="note" class="form-control w-100"></textarea><br />
              <input type="hidden" name="process" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['PROCESS'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
              <input type="hidden" name="foreign_id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_id())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />

              <?php if ($this->_tpl_vars['notes']): ?>
              <div class="mt-1">
                <?php $_from = $this->_tpl_vars['notes']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }$this->_foreach['note_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['note_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['note']):
        $this->_foreach['note_loop']['iteration']++;
?>
                <div>
                  <?php echo smarty_function_xlt(array('t' => 'Note'), $this);?>
 #<?php echo ((is_array($_tmp=$this->_tpl_vars['note']->get_id())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

                  <?php echo smarty_function_xlt(array('t' => 'Date:'), $this);?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['note']->get_date())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

                  <?php echo ((is_array($_tmp=$this->_tpl_vars['note']->get_note())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

                  <?php if ($this->_tpl_vars['note']->get_owner()): ?>
                    &nbsp;-<?php echo ((is_array($_tmp=$this->_tpl_vars['note']->getOwnerName())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

                  <?php endif; ?>
                </div>
                <?php endforeach; endif; unset($_from); ?>
              <?php endif; ?>
              </div>
            </div>
          </div>
        </form>
        <h4><?php echo smarty_function_xlt(array('t' => 'Contents'), $this);?>
</h4>
		</td>
	</tr>
	<tr id="DocContents" class="h-100">
		<td>
      <?php if ($this->_tpl_vars['file']->get_mimetype() == "image/tiff" || $this->_tpl_vars['file']->get_mimetype() == "text/plain"): ?>
			<embed  style="height:84vh; border: 0px" type="<?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_mimetype())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['web_path'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
as_file=false"></embed>
			<?php elseif ($this->_tpl_vars['file']->get_mimetype() == "image/png" || $this->_tpl_vars['file']->get_mimetype() == "image/jpg" || $this->_tpl_vars['file']->get_mimetype() == "image/jpeg" || $this->_tpl_vars['file']->get_mimetype() == "image/gif" || $this->_tpl_vars['file']->get_mimetype() == "application/pdf"): ?>
			<iframe style="height:84vh; border: 0px" type="<?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_mimetype())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['web_path'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
as_file=false"></iframe>
      <?php elseif ($this->_tpl_vars['file']->get_mimetype() == "application/dicom" || $this->_tpl_vars['file']->get_mimetype() == "application/dicom+zip"): ?>
      <iframe style="height:84vh; border: 0px" type="<?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_mimetype())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" src="<?php echo $this->_tpl_vars['webroot']; ?>
/library/dicom_frame.php?web_path=<?php echo ((is_array($_tmp=$this->_tpl_vars['web_path'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
as_file=false"></iframe>
      <?php elseif ($this->_tpl_vars['file']->get_mimetype() == "audio/ogg" || $this->_tpl_vars['file']->get_mimetype() == "audio/wav" || $this->_tpl_vars['file']->get_mimetype() == "audio/mpeg"): ?>
      <audio class="w-100" preload="metadata" controls="true" type="<?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_mimetype())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['web_path'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
as_file=false"><?php echo smarty_function_xlt(array('t' => 'Your browser does not support HTML5 audio'), $this);?>
</audio>
      <?php elseif ($this->_tpl_vars['file']->get_ccr_type($this->_tpl_vars['file']->get_id()) != 'CCR' && $this->_tpl_vars['file']->get_ccr_type($this->_tpl_vars['file']->get_id()) != 'CCD'): ?>
      <iframe style="height:84vh; border: 0px" type="<?php echo ((is_array($_tmp=$this->_tpl_vars['file']->get_mimetype())) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['web_path'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
as_file=true"></iframe>
			<?php endif; ?>
		</td>
	</tr>
</table>
<script>
<?php echo '
$(\'.btn-toggle\').click(function() {
    $(this).find(\'.btn\').toggleClass(\'active\');

    if ($(this).find(\'.btn-primary\').length > 0) {
        $(this).find(\'.btn\').toggleClass(\'btn-primary\');
    }

    $(this).find(\'.btn\').toggleClass(\'btn-secondary\');
    var show_prop = ($(this).find(\'.properties.active\').length > 0 ? \'block\':\'none\');
    $("#DocProperties").css(\'display\', show_prop);
});
'; ?>

</script>