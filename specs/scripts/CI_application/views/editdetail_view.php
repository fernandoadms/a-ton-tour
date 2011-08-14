<?php
/*
 * Created by generator
 *
 */

$this->load->helper('form');
$this->load->helper('url');
$this->load->helper('template');
?>

<html>
<head>
<? echo htmlHeader('Editer un Detail'); ?>

</head>
<body>


<div class="container">
	<div id="header">
		<img src="<?=base_url() . "www/images/logo.png"?>" style="vertical-align:middle;">
		<?= htmlNavigation( $this->session->userdata('user_id') == 0 ) ?>
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/detail.png" style="vertical-align:middle;"> Detail </h2></div>
	</div>
	
	<div class="prepend-1 append-1">
	
	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('identifiant' => $detail->detiddet);
echo form_open_multipart('editdetail/save', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifant du détail" for="identifiant">* identifiant</label> : </td><td><input type="hidden" id="identifiant" value="<?= $detail->detiddet ?>" </td></tr>
-->
		<tr><td><label title="Texte de la description du détail de l'action" for="texte">* texte</label> : </td><td><input type="text" name="texte" id="texte" value="<?= $detail->detlbdes ?>" ></td></tr>
		<tr><td><label title="Identifiant de l'action" for="identifiantAction">* identifiantAction</label> : </td><td><input type="text" name="identifiantAction" id="identifiantAction" value="<?= $detail->actidact ?>" ></td></tr>
		<tr><td><label title="Identifiant de l'utilisateur responsable" for="identifiantUserResponsable">identifiantUserResponsable</label> : </td><td><input type="text" name="identifiantUserResponsable" id="identifiantUserResponsable" value="<?= $detail->usridres ?>" ></td></tr>
		<tr><td><label title="Date d'échéance (doit être terminée pour le)" for="dtEcheanceIni">dtEcheanceIni</label> : </td><td><input type="text" name="dtEcheanceIni" id="dtEcheanceIni" value="<?= $detail->detdteci ?>" size="8" maxlength="10"> <span id="btn_dtEcheanceIni" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Date d'échéance prévue (devrait être terminée le)" for="dtEcheancePrevue">dtEcheancePrevue</label> : </td><td><input type="text" name="dtEcheancePrevue" id="dtEcheancePrevue" value="<?= $detail->detdtecp ?>" size="8" maxlength="10"> <span id="btn_dtEcheancePrevue" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Date d'échéance réelle (terminée le)" for="dtEcheanceReelle">dtEcheanceReelle</label> : </td><td><input type="text" name="dtEcheanceReelle" id="dtEcheanceReelle" value="<?= $detail->detdtecr ?>" size="8" maxlength="10"> <span id="btn_dtEcheanceReelle" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Code état du détail" for="codeEtat">codeEtat</label> : </td><td><input type="text" name="codeEtat" id="codeEtat" value="<?= $detail->etacdeta ?>" ></td></tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['EditForm'].sumbit()">
					<span class="ss_sprite ss_accept"> &nbsp; </span> Enregistrer
				</button>
			</td>
		</tr>
	</table>
	<script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
	cal.manageFields("btn_dtEcheanceIni", "dtEcheanceIni", "%d/%m/%Y");
	cal.manageFields("btn_dtEcheancePrevue", "dtEcheancePrevue", "%d/%m/%Y");
	cal.manageFields("btn_dtEcheanceReelle", "dtEcheanceReelle", "%d/%m/%Y");

    //]]></script>
<?
echo form_close('');
?>
	</fieldset>
	</div>
</div>

</body>
</html>
