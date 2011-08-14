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
<? echo htmlHeader('Objet'); ?>

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
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/objet.png" style="vertical-align:middle;"> Liste des objets</h2></div>
		<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>
	
	</div>
	
	<div class="prepend-1 append-1">

	<table class="visible">
		<tr class="header">
			<th>identifiant</th>
			<th>trigramme</th>
			<th>projet</th>
			<th>libelle</th>
			<th>code</th>
			<th>description</th>
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($objets as $objet):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><a title="Modifier ce Objet" href="<?=base_url()?>index.php/editobjet/index/<?=$objet->objidobj?>"><?=$objet->objidobj?></a></td>
			<td valign="top"><?=$objet->objcdtri?></td> 
			<td valign="top"><?=$objet->prjidprj?></td> 
			<td valign="top"><?=$objet->objlblib?></td> 
			<td valign="top"><?=$objet->objlbcde?></td> 
			<td valign="top"><?=$objet->objlbdes?></td> 
			<td valign="top">
				<a href="#" title="Supprimer ce Objet" onclick="if(confirm('Desirez vous supprimer ce Objet ?')){location.href='<?=base_url()?>index.php/listobjets/delete/<?=$objet->objidobj?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>
<hr>
<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter un Objet</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listobjets/add', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifiant" for="identifiant">* identifiant</label> : </td><td><input type="text" name="identifiant" id="identifiant" ></td></tr>
-->
		<tr><td><label title="Trigramme" for="trigramme">* trigramme</label> : </td><td><input type="text" name="trigramme" id="trigramme" ></td></tr>
		<tr><td><label title="Identifiant du projet" for="projet">* projet</label> : </td><td><input type="text" name="projet" id="projet" ></td></tr>
		<tr><td><label title="Libellé" for="libelle">* libelle</label> : </td><td><input type="text" name="libelle" id="libelle" ></td></tr>
		<tr><td><label title="Code" for="code">code</label> : </td><td><input type="text" name="code" id="code" ></td></tr>
		<tr><td><label title="Description" for="description">* description</label> : </td><td><input type="text" name="description" id="description" ></td></tr>
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
