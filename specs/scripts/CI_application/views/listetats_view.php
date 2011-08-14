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
<? echo htmlHeader('Etat'); ?>

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
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/etat.png" style="vertical-align:middle;"> Liste des etats</h2></div>
		<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>
	
	</div>
	
	<div class="prepend-1 append-1">

	<table class="visible">
		<tr class="header">
			<th>code</th>
			<th>libelle</th>
			<th>codeActivite</th>
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($etats as $etat):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><a title="Modifier ce Etat" href="<?=base_url()?>index.php/editetat/index/<?=$etat->etacdeta?>"><?=$etat->etacdeta?></a></td>
			<td valign="top"><?=$etat->etalbeta?></td> 
			<td valign="top"><?=$etat->etacdact?></td> 
			<td valign="top">
				<a href="#" title="Supprimer ce Etat" onclick="if(confirm('Desirez vous supprimer ce Etat ?')){location.href='<?=base_url()?>index.php/listetats/delete/<?=$etat->etacdeta?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>
<hr>
<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter un Etat</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listetats/add', $attributes_info, $fields_info );
?>
	<table>
		<tr><td><label title="Code de l'état" for="code">* code</label> : </td><td><input type="text" name="code" id="code"></td></tr>
		<tr><td><label title="Libellé de l'état" for="libelle">* libelle</label> : </td><td><input type="text" name="libelle" id="libelle"></td></tr>
		<tr><td><label title="Activité : R : actif (running) / P : en pause (pause) / T : terminée (terminated) / L : repoussée à plus tard (later) / C : abandonné (canceled)" for="codeActivite">* codeActivite</label> : </td><td><input type="text" name="codeActivite" id="codeActivite"></td></tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['AddForm'].sumbit()">
					<span class="ss_sprite ss_add"> &nbsp; </span> Ajouter
				</button>
			</td>
		</tr>
	</table>

<?
echo form_close('');
?>
</fieldset>
	</div>
</div>

</body>
</html>
