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
<? echo htmlHeader('Editer un Action'); ?>

</head>
<body>


<div class="container">
	<div id="header">
		<img src="<?=base_url() . "www/images/logo.png"?>" style="vertical-align:middle;">
		<?= htmlNavigation( $this->session->userdata('user_id') == 0 ) ?>
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/action.png" style="vertical-align:middle;"> Action </h2></div>
	</div>
	
	<div class="prepend-1 append-1">
	
	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('identifiant' => $action->actidact);
echo form_open_multipart('editaction/save', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifiant de l'action" for="identifiant">* identifiant</label> : </td><td><input type="hidden" id="identifiant" value="<?= $action->actidact ?>" </td></tr>
-->
		<tr><td><label title="Identifiant du proprietaire" for="proprietaire">* proprietaire</label> : </td><td><input type="text" name="proprietaire" id="proprietaire" value="<?= $action->actidpro ?>" ></td></tr>
		<tr><td><label title="Titre de l'action" for="titre">* titre</label> : </td><td><input type="text" name="titre" id="titre" value="<?= $action->actlbtit ?>" ></td></tr>
		<tr><td><label title="Priorité de l'action : 1 (très prioritaire) à 5 (non prioritaire)" for="priorite">priorite</label> : </td><td><input type="text" name="priorite" id="priorite" value="<?= $action->actnupri ?>" ></td></tr>
		<tr><td><label title="Date de création (ou de détection) de l'action" for="dtCreation">* dtCreation</label> : </td><td><input type="text" name="dtCreation" id="dtCreation" value="<?= $action->actdtcre ?>" size="8" maxlength="10"> <span id="btn_dtCreation" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Date de prise en compte de l'action (commencée le)" for="dtDemarrage">dtDemarrage</label> : </td><td><input type="text" name="dtDemarrage" id="dtDemarrage" value="<?= $action->actdtdem ?>" size="8" maxlength="10"> <span id="btn_dtDemarrage" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Date d'échéance initiale de l'action (doit être terminée pour le)" for="dtEcheanceIni">dtEcheanceIni</label> : </td><td><input type="text" name="dtEcheanceIni" id="dtEcheanceIni" value="<?= $action->actdteci ?>" size="8" maxlength="10"> <span id="btn_dtEcheanceIni" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Date d'échéance prévue de l'action (devrait être terminée le)" for="dtEcheancePrevue">dtEcheancePrevue</label> : </td><td><input type="text" name="dtEcheancePrevue" id="dtEcheancePrevue" value="<?= $action->actdtecp ?>" size="8" maxlength="10"> <span id="btn_dtEcheancePrevue" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Date d'échéance réelle de l'action (terminée le)" for="dtEcheanceReelle">dtEcheanceReelle</label> : </td><td><input type="text" name="dtEcheanceReelle" id="dtEcheanceReelle" value="<?= $action->actdtecr ?>" size="8" maxlength="10"> <span id="btn_dtEcheanceReelle" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Flag action cachée (Oui ou Non)" for="cacher">cacher</label> : </td><td><input type="text" name="cacher" id="cacher" value="<?= $action->actfgcac ?>" ></td></tr>
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
	cal.manageFields("btn_dtCreation", "dtCreation", "%d/%m/%Y");
	cal.manageFields("btn_dtDemarrage", "dtDemarrage", "%d/%m/%Y");
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
