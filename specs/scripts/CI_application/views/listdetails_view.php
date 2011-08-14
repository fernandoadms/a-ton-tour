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
<? echo htmlHeader('Detail'); ?>

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
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/detail.png" style="vertical-align:middle;"> Liste des details</h2></div>
		<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>
	
	</div>
	
	<div class="prepend-1 append-1">

	<table class="visible">
		<tr class="header">
			<th>identifiant</th>
			<th>texte</th>
			<th>identifiantAction</th>
			<th>identifiantUserResponsable</th>
			<th>dtEcheanceIni</th>
			<th>dtEcheancePrevue</th>
			<th>dtEcheanceReelle</th>
			<th>codeEtat</th>
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($details as $detail):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><a title="Modifier ce Detail" href="<?=base_url()?>index.php/editdetail/index/<?=$detail->detiddet?>"><?=$detail->detiddet?></a></td>
			<td valign="top"><?=$detail->detlbdes?></td> 
			<td valign="top"><?=$detail->actidact?></td> 
			<td valign="top"><?=$detail->usridres?></td> 
			<td valign="top"><?=$detail->detdteci?></td> 
			<td valign="top"><?=$detail->detdtecp?></td> 
			<td valign="top"><?=$detail->detdtecr?></td> 
			<td valign="top"><?=$detail->etacdeta?></td> 
			<td valign="top">
				<a href="#" title="Supprimer ce Detail" onclick="if(confirm('Desirez vous supprimer ce Detail ?')){location.href='<?=base_url()?>index.php/listdetails/delete/<?=$detail->detiddet?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>
<hr>
<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter un Detail</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listdetails/add', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifant du détail" for="identifiant">* identifiant</label> : </td><td><input type="text" name="identifiant" id="identifiant" ></td></tr>
-->
		<tr><td><label title="Texte de la description du détail de l'action" for="texte">* texte</label> : </td><td><input type="text" name="texte" id="texte" ></td></tr>
		<tr><td><label title="Identifiant de l'action" for="identifiantAction">* identifiantAction</label> : </td><td><input type="text" name="identifiantAction" id="identifiantAction" ></td></tr>
		<tr><td><label title="Identifiant de l'utilisateur responsable" for="identifiantUserResponsable">identifiantUserResponsable</label> : </td><td><input type="text" name="identifiantUserResponsable" id="identifiantUserResponsable" ></td></tr>
		<tr><td><label title="Date d'échéance (doit être terminée pour le)" for="dtEcheanceIni">dtEcheanceIni</label> : </td><td><input type="text" name="dtEcheanceIni" id="dtEcheanceIni" size="8" maxlength="10"> <span id="btn_dtEcheanceIni" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Date d'échéance prévue (devrait être terminée le)" for="dtEcheancePrevue">dtEcheancePrevue</label> : </td><td><input type="text" name="dtEcheancePrevue" id="dtEcheancePrevue" size="8" maxlength="10"> <span id="btn_dtEcheancePrevue" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Date d'échéance réelle (terminée le)" for="dtEcheanceReelle">dtEcheanceReelle</label> : </td><td><input type="text" name="dtEcheanceReelle" id="dtEcheanceReelle" size="8" maxlength="10"> <span id="btn_dtEcheanceReelle" class="ss_sprite ss_calendar">&nbsp;</span></td></tr>
		<tr><td><label title="Code état du détail" for="codeEtat">codeEtat</label> : </td><td><input type="text" name="codeEtat" id="codeEtat" ></td></tr>
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
