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
<? echo htmlHeader('Editer un Utilisateur'); ?>

</head>
<body>


<div class="container">
	<div id="header">
		<img src="<?=base_url() . "www/images/logo.png"?>" style="vertical-align:middle;">
		<?= htmlNavigation( $this->session->userdata('user_id') == 0 ) ?>
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/utilisateur.png" style="vertical-align:middle;"> Utilisateur </h2></div>
	</div>
	
	<div class="prepend-1 append-1">
	
	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('usridusr' => $utilisateur->usridusr);
echo form_open_multipart('editutilisateur/save', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifant de l'utilisateur" for="identifiant">* identifiant</label> : </td><td><input type="hidden" name="identifiant" id="identifiant" value="<?= $utilisateur->usridusr ?>"><?= $utilisateur->usridusr ?></td></tr>
-->
		<tr><td><label title="Code de l'utilisateur (nom court)" for="codeUser">codeUser</label> : </td><td><input type="text" name="codeUser" id="codeUser" value="<?= $utilisateur->usrcdusr ?>"></td></tr>
		<tr><td><label title="Nom de l'utilisateur" for="nom">nom</label> : </td><td><input type="text" name="nom" id="nom" value="<?= $utilisateur->usrlbnom ?>"></td></tr>
		<tr><td><label title="Prénom de l'utilisateur" for="prenom">prenom</label> : </td><td><input type="text" name="prenom" id="prenom" value="<?= $utilisateur->usrlbprn ?>"></td></tr>
		<tr><td><label title="Identifiant du service de l'utilisateur" for="service">service</label> : </td><td><input type="text" name="service" id="service" value="<?= $utilisateur->usridser ?>"></td></tr>
		<tr><td><label title="Identifiant du responsable de l'utilisateur" for="responsable">responsable</label> : </td><td><input type="text" name="responsable" id="responsable" value="<?= $utilisateur->usridres ?>"></td></tr>
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
