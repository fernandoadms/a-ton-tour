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
<? echo htmlHeader('Editer un Login'); ?>

</head>
<body>


<div class="container">
	<div id="header">
		<img src="<?=base_url() . "www/images/logo.png"?>" style="vertical-align:middle;">
		<?= htmlNavigation( $this->session->userdata('user_id') == 0 ) ?>
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/login.png" style="vertical-align:middle;"> Login </h2></div>
	</div>
	
	<div class="prepend-1 append-1">
	
	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('lgnidlgn' => $login->lgnidlgn);
echo form_open_multipart('editlogin/save', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifiant du login" for="identifiant">* identifiant</label> : </td><td><input type="hidden" name="identifiant" id="identifiant" value="<?= $login->lgnidlgn ?>"><?= $login->lgnidlgn ?></td></tr>
-->
		<tr><td><label title="Identifiant de l'utilisateur" for="utilisateur">utilisateur</label> : </td><td><input type="text" name="utilisateur" id="utilisateur" value="<?= $login->lgnidusr ?>"></td></tr>
		<tr><td><label title="Login de connexion" for="login">* login</label> : </td><td><input type="text" name="login" id="login" value="<?= $login->lgnlblgn ?>"></td></tr>
		<tr><td><label title="Mot de passe" for="password">* password</label> : </td><td><input type="text" name="password" id="password" value="<?= $login->lgnlbpwd ?>"></td></tr>
		<tr><td><label title="Profil de connexion" for="profil">profil</label> : </td><td><input type="text" name="profil" id="profil" value="<?= $login->lgncdprf ?>"></td></tr>
		<tr><td><label title="Flag d'archivage : 1: archivé" for="flagArchive">flagArchive</label> : </td><td><input type="text" name="flagArchive" id="flagArchive" value="<?= $login->lgnfgarc ?>"></td></tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['EditForm'].sumbit()">
					<span class="ss_sprite ss_accept"> &nbsp; </span> Enregistrer
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
