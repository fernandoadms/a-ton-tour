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
<? echo htmlHeader('Editer un Objet'); ?>

</head>
<body>


<div class="container">
	<div id="header">
		<img src="<?=base_url() . "www/images/logo.png"?>" style="vertical-align:middle;">
		<?= htmlNavigation( $this->session->userdata('user_id') == 0 ) ?>
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/objet.png" style="vertical-align:middle;"> Objet </h2></div>
	</div>
	
	<div class="prepend-1 append-1">
	
	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('identifiant' => $objet->objidobj);
echo form_open_multipart('editobjet/save', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifiant" for="identifiant">* identifiant</label> : </td><td><input type="hidden" id="identifiant" value="<?= $objet->objidobj ?>" </td></tr>
-->
		<tr><td><label title="Trigramme" for="trigramme">* trigramme</label> : </td><td><input type="text" name="trigramme" id="trigramme" value="<?= $objet->objcdtri ?>" ></td></tr>
		<tr><td><label title="Identifiant du projet" for="projet">* projet</label> : </td><td><input type="text" name="projet" id="projet" value="<?= $objet->prjidprj ?>" ></td></tr>
		<tr><td><label title="Libellé" for="libelle">* libelle</label> : </td><td><input type="text" name="libelle" id="libelle" value="<?= $objet->objlblib ?>" ></td></tr>
		<tr><td><label title="Code" for="code">code</label> : </td><td><input type="text" name="code" id="code" value="<?= $objet->objlbcde ?>" ></td></tr>
		<tr><td><label title="Description" for="description">* description</label> : </td><td><input type="text" name="description" id="description" value="<?= $objet->objlbdes ?>" ></td></tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['EditForm'].sumbit()">
					<span class="ss_sprite ss_accept"> &nbsp; </span> Enregistrer
				</button>
			</td>
		</tr>
	</table>
	
    //]]></script>
<?
echo form_close('');
?>
	</fieldset>
	</div>
</div>

</body>
</html>
