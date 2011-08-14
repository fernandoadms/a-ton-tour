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
<? echo htmlHeader('Login'); ?>

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
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/login.png" style="vertical-align:middle;"> Liste des logins</h2></div>
		<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>
	
	</div>
	
	<div class="prepend-1 append-1">

	<table class="visible">
		<tr class="header">
			<th>identifiant</th>
			<th>utilisateur</th>
			<th>login</th>
			<th>password</th>
			<th>profil</th>
			<th>flagArchive</th>
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($logins as $login):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><a title="Modifier ce Login" href="<?=base_url()?>index.php/editlogin/index/<?=$login->lgnidlgn?>"><?=$login->lgnidlgn?></a></td>
			<td valign="top"><?=$login->lgnidusr?></td> 
			<td valign="top"><?=$login->lgnlblgn?></td> 
			<td valign="top"><?=$login->lgnlbpwd?></td> 
			<td valign="top"><?=$login->lgncdprf?></td> 
			<td valign="top"><?=$login->lgnfgarc?></td> 
			<td valign="top">
				<a href="#" title="Supprimer ce Login" onclick="if(confirm('Desirez vous supprimer ce Login ?')){location.href='<?=base_url()?>index.php/listlogins/delete/<?=$login->lgnidlgn?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>
<hr>
<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter un Login</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listlogins/add', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifiant du login" for="identifiant">* identifiant</label> : </td><td><input type="text" name="identifiant" id="identifiant"></td></tr>
-->
		<tr><td><label title="Identifiant de l'utilisateur" for="utilisateur">utilisateur</label> : </td><td><input type="text" name="utilisateur" id="utilisateur"></td></tr>
		<tr><td><label title="Login de connexion" for="login">* login</label> : </td><td><input type="text" name="login" id="login"></td></tr>
		<tr><td><label title="Mot de passe" for="password">* password</label> : </td><td><input type="text" name="password" id="password"></td></tr>
		<tr><td><label title="Profil de connexion" for="profil">profil</label> : </td><td><input type="text" name="profil" id="profil"></td></tr>
		<tr><td><label title="Flag d'archivage : 1: archivé" for="flagArchive">flagArchive</label> : </td><td><input type="text" name="flagArchive" id="flagArchive"></td></tr>
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
