<?php
/*
 * Created by generator
 *
 */

$this->load->helper('form');
$this->load->helper('url');
$this->load->helper('template');

if($this->session->userdata('user_id') == null) {
	redirect('welcome/index');
}
?>

<html>
<head>
<? echo htmlHeader('Editer un objet'); ?>

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

	<div class="span-12"><h2><img src="<?=base_url()?>www/images/objet.jpg" style="vertical-align:middle;" /> Objet "<?=$objet->objlblib?>"</h2></div>
	<div class="span-7 last" style="float: right;"><?= $this->session->flashdata('message');?></div>
	<div class="span-20">
	
	<fieldset>

<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('identifiant' => $objet->objidobj, 'projet' => $objet->prjidprj);
echo form_open_multipart('editobjet/save', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifiant" for="identifiant">* identifiant</label> : </td><td><input type="hidden" id="identifiant" value="<?= $objet->objidobj ?>" </td></tr>
-->
		<tr>
			<td><label title="Libellé" for="libelle">* libelle</label> : </td>
			<td><input type="text" name="libelle" id="libelle" value="<?= $objet->objlblib ?>" ></td>
			
			<td><label title="Code" for="code">code</label> : </td>
			<td><input type="text" name="code" id="code" value="<?= $objet->objlbcde ?>" ></td>
			
			<td><label title="Trigramme" for="trigramme">* trigramme</label> : </td>
			<td><input type="text" name="trigramme" id="trigramme" value="<?= $objet->objcdtri ?>" ></td>
		</tr>
		<tr><td style="vertical-align: top;" nowrap><label title="Description" for="description">* description</label> : </td>
			<td colspan="5">
				<textarea style="width: 100%; height: 80px;" name="description" id="description" class="editor_detail"><?= $objet->objlbdes ?></textarea>
			</td></tr>
		<tr>
			<td></td>
			<td colspan="5">
				<div style="width: 100%;">
					<span>
						<button onclick="document.forms['EditForm'].sumbit()">
							<span class="ss_sprite ss_accept"> &nbsp; </span> Enregistrer
						</button>
						<button onclick="document.location.href='<?=base_url()?>index.php/editproject/index/<?= $objet->prjidprj .'#obj_'.$objet->objidobj?>';return false;">
							<span class="ss_sprite ss_control_rewind"> &nbsp; </span> Retour au projet
						</button>
					</span>
					<span style="float: right;">
						<button onclick="document.location.href='<?=base_url()?>index.php/editobjet/delete/<?= $objet->objidobj?>';return false;">
							<span class="ss_sprite ss_delete"> &nbsp; </span> Supprimer cet objet
						</button>
					</span>
				</div>
			</td>
		</tr>
	</table>
	
<?
echo form_close('');
?>
<button onclick="document.location.href='<?=base_url()?>index.php/editobjet/export/<?= $objet->objidobj?>';return false;">
	<span class="ss_sprite ss_script_code"> &nbsp; </span> Export XML
</button>
 
	</fieldset>
	</div>
	<div class="span-20">
		<h3><img src="<?=base_url()?>www/images/champ.png"/ style="vertical-align:middle;">Champs</h3>
		<table class="visible">
			<tr class="header">
				<th title="Libellé affiché à l'écran">Libellé</th>
				<th title="Champ SQL qui sera préfixé par le trigramme de l’objet">Nom du champ SQL</th>
				<th title="Donnée non obligatoire">Peut être vide</th>
				<th title="Type du champ SQL : int, varchar(255), date, etc...">Type du champ SQL</th>
				<th title="Infobulle qui apparait dans les écrans et commentaire du champ SQL" width="200">Description</th>
				<th>Supprimer</th>
			</tr>
			<?php $even = true;
			foreach($objet->getAllChamps($this->db) as $champ): ?>
			<tr <?=($even)?('class="even"'):('')?>>
				<td valign="top" nowrap><span class="ss_sprite ss_tag_blue">&nbsp;</span> <a name="chp_<?=$champ->chpidchp?>" title="Modifier ce champ" href="<?=base_url()?>index.php/editchamp/index/<?=$champ->chpidchp?>"><?=$champ->chplbnom?></a></td>
				<td valign="top"><?=$objet->objcdtri . $champ->chplbcde?></td> 
				<td valign="top"><?= ($champ->chpfgnul == 'O')?("Oui"):("Non")?></td> 
				<td valign="top"><?=$champ->chpcdtyp?></td> 
				<td valign="top"><?=$champ->chplbdes?></td>
				<td valign="top">
					<a href="#" title="Supprimer ce champ" onclick="if(confirm('Desirez vous supprimer ce champ ?')){location.href='<?=base_url()?>index.php/editobjet/deleteChamp/<?=$champ->chpidchp?>/<?=$objet->objidobj?>/<?=$objet->prjidprj?>'}">
					<img src="<?=base_url()?>www/images/delete_16.png"></a>
				</td>
			</tr>
			<?php  $even = !$even;
			endforeach; ?>
			<tr>
				<td colspan="7"></td>
			</tr>
<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array('idObjet'=> $objet->objidobj, 'projet' => $objet->prjidprj);
echo form_open_multipart('editobjet/addChamp', $attributes_info, $fields_info );
?>
			<tr>
				<td><input type="text" name="nom" id="nom" ></td>
				<td nowrap><?=$objet->objcdtri ?><input type="text" name="code" id="code" size="8"></td>
				<td><input type="checkbox" name="peutEtreNull" id="peutEtreNull" value="O"></td>
				<td><input type="text" name="type" id="type" size="10"></td>
				<td colspan="2"><input type="text" name="description" id="description" ></td>
			</tr>

<?
echo form_close('');
?>
		</table>
		<button onclick="document.forms['AddForm'].submit()">
					<span class="ss_sprite ss_add"> &nbsp; </span> Ajouter ce nouveau champ
		</button>
	</div>

</div>
</div>
</body>
</html>
