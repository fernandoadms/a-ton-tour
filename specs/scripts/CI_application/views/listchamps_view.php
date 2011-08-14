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
<? echo htmlHeader('Champ'); ?>

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
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/champ.png" style="vertical-align:middle;"> Liste des champs</h2></div>
		<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>
	
	</div>
	
	<div class="prepend-1 append-1">

	<table class="visible">
		<tr class="header">
			<th>identifiant</th>
			<th>code</th>
			<th>Nom</th>
			<th>peutEtreNull</th>
			<th>estCle</th>
			<th>type</th>
			<th>description</th>
			<th>idObjet</th>
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($champs as $champ):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><a title="Modifier ce Champ" href="<?=base_url()?>index.php/editchamp/index/<?=$champ->chpidchp?>"><?=$champ->chpidchp?></a></td>
			<td valign="top"><?=$champ->chplbcde?></td> 
			<td valign="top"><?=$champ->chplbnom?></td> 
			<td valign="top"><?=$champ->chpfgnul?></td> 
			<td valign="top"><?=$champ->chpfgcle?></td> 
			<td valign="top"><?=$champ->chpcdtyp?></td> 
			<td valign="top"><?=$champ->chplbdes?></td> 
			<td valign="top"><?=$champ->objidobj?></td> 
			<td valign="top">
				<a href="#" title="Supprimer ce Champ" onclick="if(confirm('Desirez vous supprimer ce Champ ?')){location.href='<?=base_url()?>index.php/listchamps/delete/<?=$champ->chpidchp?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>
<hr>
<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter un Champ</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listchamps/add', $attributes_info, $fields_info );
?>
	<table>
		<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE
<tr><td><label title="Identifiant" for="identifiant">* identifiant</label> : </td><td><input type="text" name="identifiant" id="identifiant" ></td></tr>
-->
		<tr><td><label title="Code / identifiant SQL" for="code">* code</label> : </td><td><input type="text" name="code" id="code" ></td></tr>
		<tr><td><label title="Nom" for="Nom">* Nom</label> : </td><td><input type="text" name="Nom" id="Nom" ></td></tr>
		<tr><td><label title="Flag "peut être NULL"" for="peutEtreNull">peutEtreNull</label> : </td><td><input type="text" name="peutEtreNull" id="peutEtreNull" ></td></tr>
		<tr><td><label title="Flag "est une clé"" for="estCle">* estCle</label> : </td><td><input type="text" name="estCle" id="estCle" ></td></tr>
		<tr><td><label title="Type" for="type">* type</label> : </td><td><input type="text" name="type" id="type" ></td></tr>
		<tr><td><label title="Description" for="description">* description</label> : </td><td><input type="text" name="description" id="description" ></td></tr>
		<tr><td><label title="Identifiant de l'objet" for="idObjet">* idObjet</label> : </td><td><input type="text" name="idObjet" id="idObjet" ></td></tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['AddForm'].sumbit()">
					<span class="ss_sprite ss_add"> &nbsp; </span> Ajouter
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
