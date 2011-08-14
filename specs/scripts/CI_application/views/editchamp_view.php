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
<? echo htmlHeader('Editer un Champ'); ?>

</head>
<body>


<div class="container">
	<div id="header">
		<img src="<?=base_url() . "www/images/logo.png"?>" style="vertical-align:middle;">
		<?= htmlNavigation( $this->session->userdata('user_id') == 0 ) ?>
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/champ.png" style="vertical-align:middle;"> Champ </h2></div>
	</div>
	
	<div class="prepend-1 append-1">
	
	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('identifiant' => $champ->chpidchp);
echo form_open_multipart('editchamp/save', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifiant" for="identifiant">* identifiant</label> : </td><td><input type="hidden" id="identifiant" value="<?= $champ->chpidchp ?>" </td></tr>
-->
		<tr><td><label title="Code / identifiant SQL" for="code">* code</label> : </td><td><input type="text" name="code" id="code" value="<?= $champ->chplbcde ?>" ></td></tr>
		<tr><td><label title="Nom" for="Nom">* Nom</label> : </td><td><input type="text" name="Nom" id="Nom" value="<?= $champ->chplbnom ?>" ></td></tr>
		<tr><td><label title="Flag "peut être NULL"" for="peutEtreNull">peutEtreNull</label> : </td><td><input type="text" name="peutEtreNull" id="peutEtreNull" value="<?= $champ->chpfgnul ?>" ></td></tr>
		<tr><td><label title="Flag "est une clé"" for="estCle">* estCle</label> : </td><td><input type="text" name="estCle" id="estCle" value="<?= $champ->chpfgcle ?>" ></td></tr>
		<tr><td><label title="Type" for="type">* type</label> : </td><td><input type="text" name="type" id="type" value="<?= $champ->chpcdtyp ?>" ></td></tr>
		<tr><td><label title="Description" for="description">* description</label> : </td><td><input type="text" name="description" id="description" value="<?= $champ->chplbdes ?>" ></td></tr>
		<tr><td><label title="Identifiant de l'objet" for="idObjet">* idObjet</label> : </td><td><input type="text" name="idObjet" id="idObjet" value="<?= $champ->objidobj ?>" ></td></tr>
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
