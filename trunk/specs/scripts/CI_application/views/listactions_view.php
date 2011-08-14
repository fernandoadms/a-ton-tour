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
<? echo htmlHeader('Action'); ?>

</head>
<body>

<div class="container">  
	<div id="header">
		<div class="span-18">
			<img src="<?=base_url() . "www/images/logo.png"?>" style="vertical-align:middle;">
		</div>
		<div class="column span-5 last" id="identification">
			Utilisateur <i><?= $this->session->userdata('user_name'); ?></i> <!-- <?= $this->session->userdata('user_id') ?> --> &nbsp;
			<a href="<?=base_url()?>index.php/welcome/logout" title="Logout"><span class="ss_sprite ss_exclamation "></span></a>
		</div>
		<div class="span-24">
			<?= htmlNavigation( $this->session->userdata('user_id') == 0 ) ?>
		</div>
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/action.png" style="vertical-align:middle;"> Liste des actions</h2></div>
		<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>
	
	</div>
	
	<div class="prepend-1 append-1">

	<table class="visible">
		<tr class="header">
			<th>identifiant</th>
			<th>proprietaire</th>
			<th>titre</th>
			<th>priorite</th>
			<th>dtCreation</th>
			<th>dtDemarrage</th>
			<th>dtEcheanceIni</th>
			<th>dtEcheancePrevue</th>
			<th>dtEcheanceReelle</th>
			<th>cacher</th>
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($actions as $action):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><a title="Modifier ce Action" href="<?=base_url()?>index.php/editaction/index/<?=$action->actidact?>"><?=$action->actidact?></a></td>
			<td valign="top"><?=$action->actidpro?></td> 
			<td valign="top"><?=$action->actlbtit?></td> 
			<td valign="top"><?=$action->actnupri?></td> 
			<td valign="top"><?=$action->actdtcre?></td> 
			<td valign="top"><?=$action->actdtdem?></td> 
			<td valign="top"><?=$action->actdteci?></td> 
			<td valign="top"><?=$action->actdtecp?></td> 
			<td valign="top"><?=$action->actdtecr?></td> 
			<td valign="top"><?=$action->actfgcac?></td> 
			<td valign="top">
				<a href="#" title="Supprimer ce Action" onclick="if(confirm('Desirez vous supprimer ce Action ?')){location.href='<?=base_url()?>index.php/listactions/delete/<?=$action->actidact?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>
<hr>
<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter un Action</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listactions/add', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifiant de l'action" for="identifiant">* identifiant</label> : </td><td><input type="text" name="identifiant" id="identifiant" ></td></tr>
-->
		<tr><td><label title="Identifiant du proprietaire" for="proprietaire">* proprietaire</label> : </td><td><input type="text" name="proprietaire" id="proprietaire" ></td></tr>
		<tr><td><label title="Titre de l'action" for="titre">* titre</label> : </td><td><input type="text" name="titre" id="titre" ></td></tr>
		<tr><td><label title="Priorité de l'action : 1 (très prioritaire) à 5 (non prioritaire)" for="priorite">priorite</label> : </td><td><input type="text" name="priorite" id="priorite" ></td></tr>
		<tr><td><label title="Date de création (ou de détection) de l'action" for="dtCreation">* dtCreation</label> : </td><td><input type="text" name="dtCreation" id="dtCreation" size="8" maxlength="10"> <span id="btn_dtCreation" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Date de prise en compte de l'action (commencée le)" for="dtDemarrage">dtDemarrage</label> : </td><td><input type="text" name="dtDemarrage" id="dtDemarrage" size="8" maxlength="10"> <span id="btn_dtDemarrage" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Date d'échéance initiale de l'action (doit être terminée pour le)" for="dtEcheanceIni">dtEcheanceIni</label> : </td><td><input type="text" name="dtEcheanceIni" id="dtEcheanceIni" size="8" maxlength="10"> <span id="btn_dtEcheanceIni" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Date d'échéance prévue de l'action (devrait être terminée le)" for="dtEcheancePrevue">dtEcheancePrevue</label> : </td><td><input type="text" name="dtEcheancePrevue" id="dtEcheancePrevue" size="8" maxlength="10"> <span id="btn_dtEcheancePrevue" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Date d'échéance réelle de l'action (terminée le)" for="dtEcheanceReelle">dtEcheanceReelle</label> : </td><td><input type="text" name="dtEcheanceReelle" id="dtEcheanceReelle" size="8" maxlength="10"> <span id="btn_dtEcheanceReelle" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Flag action cachée (Oui ou Non)" for="cacher">cacher</label> : </td><td><input type="text" name="cacher" id="cacher" ></td></tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['AddForm'].sumbit()">
					<span class="ss_sprite ss_add"> &nbsp; </span> Ajouter
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
