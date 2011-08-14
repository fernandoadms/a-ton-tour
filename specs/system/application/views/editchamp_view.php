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
<? echo htmlHeader('Editer un champ'); ?>

</head>
<body>


<div class="container">  
	<div class="prepend column span-15">
		<h1><img src="<?=base_url()?>www/images/logo.jpg"/ style="vertical-align:middle;"> Specs</h1>
	</div>
	<div class="column span-5 last">
		Utilisateur <i><?= $this->session->userdata('user_name'); ?></i> &nbsp;
		<a href="<?=base_url()?>index.php/welcome/logout" title="Logout"><span class="ss_sprite ss_exclamation "></span></a>
	</div>
	
	<div class="column span-24">
		<hr>

	<div class="span-20"><h2><img src="<?=base_url()?>www/images/champ.png" style="vertical-align:middle;" /> Champ "<?=$champ->chplbnom?>"
	<font size="-1">de l'objet "<?= $objet->objlblib ?>"</font></h2></div>
	<div class="span-7 last" style="float: right;"><?= $this->session->flashdata('message');?></div>
	<div class="span-20">
	
	<fieldset>

<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('identifiant' => $champ->chpidchp, 'idObjet' => $champ->objidobj, 'prjidprj' => $objet->prjidprj);
echo form_open_multipart('editchamp/save', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifiant" for="identifiant">* identifiant</label> : </td><td><input type="hidden" id="identifiant" value="<?= $champ->chpidchp ?>" </td></tr>
-->
		<tr>
			<td nowrap><label title="Libellé affiché à l'écran" for="Nom">* Libellé</label> : </td>
			<td><input type="text" name="Nom" id="Nom" value="<?= $champ->chplbnom ?>" ></td>
		</tr>
		<tr>
			<td nowrap><label title="Champ SQL qui sera préfixé par le trigramme de l’objet" for="code">* Champ SQL</label> : </td>
			<td><input type="text" name="code" id="code" value="<?= $champ->chplbcde ?>" ></td>
		</tr>
		<tr>
			<td nowrap><label title="Donnée non obligatoire" for="peutEtreNull">Peut être vide</label> : </td>
			<td>
				<input type="checkbox" name="peutEtreNull" id="peutEtreNull" value="O" 
				<?php if($champ->chpfgnul == 'O' ) { echo "checked";}?>
				></td>
		</tr>
		<tr>
			<td nowrap><label title="Type du champ SQL : int, varchar(255), date, etc..." for="type">* Type du champ SQL</label> : </td>
			<td><input type="text" name="type" id="type" value="<?= $champ->chpcdtyp ?>" ></td>
		</tr>
		<tr>
			<td nowrap><label title="Infobulle qui apparait dans les écrans et commentaire du champ SQL" for="description">* Description</label> : </td>
			<td><textarea style="width: 100%; height: 80px;" name="description" id="description" class="editor_detail"><?= $champ->chplbdes ?></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['EditForm'].sumbit()">
					<span class="ss_sprite ss_accept"> &nbsp; </span> Enregistrer
				</button>
				&nbsp;
				<button onclick="document.location.href='<?=base_url()?>index.php/editobjet/index/<?=$champ->objidobj ?>/<?=$objet->prjidprj?>#chp_<?=$champ->chpidchp?>';return false;">
					<span class="ss_sprite ss_control_rewind"> &nbsp; </span> Annuler
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
</div>

</body>
</html>
