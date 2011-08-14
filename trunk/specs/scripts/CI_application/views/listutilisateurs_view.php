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
<? echo htmlHeader('Utilisateur'); ?>

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
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/utilisateur.png" style="vertical-align:middle;"> Liste des utilisateurs</h2></div>
		<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>
	
	</div>
	
	<div class="prepend-1 append-1">

	<table class="visible">
		<tr class="header">
			<th>identifiant</th>
			<th>codeUser</th>
			<th>nom</th>
			<th>prenom</th>
			<th>service</th>
			<th>responsable</th>
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($utilisateurs as $utilisateur):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><a title="Modifier ce Utilisateur" href="<?=base_url()?>index.php/editutilisateur/index/<?=$utilisateur->usridusr?>"><?=$utilisateur->usridusr?></a></td>
			<td valign="top"><?=$utilisateur->usrcdusr?></td> 
			<td valign="top"><?=$utilisateur->usrlbnom?></td> 
			<td valign="top"><?=$utilisateur->usrlbprn?></td> 
			<td valign="top"><?=$utilisateur->usridser?></td> 
			<td valign="top"><?=$utilisateur->usridres?></td> 
			<td valign="top">
				<a href="#" title="Supprimer ce Utilisateur" onclick="if(confirm('Desirez vous supprimer ce Utilisateur ?')){location.href='<?=base_url()?>index.php/listutilisateurs/delete/<?=$utilisateur->usridusr?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>
<hr>
<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter un Utilisateur</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listutilisateurs/add', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifant de l'utilisateur" for="identifiant">* identifiant</label> : </td><td><input type="text" name="identifiant" id="identifiant"></td></tr>
-->
		<tr><td><label title="Code de l'utilisateur (nom court)" for="codeUser">codeUser</label> : </td><td><input type="text" name="codeUser" id="codeUser"></td></tr>
		<tr><td><label title="Nom de l'utilisateur" for="nom">nom</label> : </td><td><input type="text" name="nom" id="nom"></td></tr>
		<tr><td><label title="Prénom de l'utilisateur" for="prenom">prenom</label> : </td><td><input type="text" name="prenom" id="prenom"></td></tr>
		<tr><td><label title="Identifiant du service de l'utilisateur" for="service">service</label> : </td><td><input type="text" name="service" id="service"></td></tr>
		<tr><td><label title="Identifiant du responsable de l'utilisateur" for="responsable">responsable</label> : </td><td><input type="text" name="responsable" id="responsable"></td></tr>
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
