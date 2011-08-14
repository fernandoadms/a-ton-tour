<?php
/*
 * Created on 03/04/2010
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
<? echo htmlHeader('Schemas'); ?>

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

<?= htmlNavigation( $this->session->userdata('user_id') == 0 ) ?>

	<div class="span-12"><h2><img src="<?=base_url()?>www/images/schema.png" style="vertical-align:middle;"/> Liste des schémas</h2></div>
	<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>

	<table class="visible">
		<tr style="background: #b2b2ff;">
			<th>Titre</th>
			<th>Version</th>
			<th>Description</th>
			<th>Date de création</th>
			<th>Image</th>
			<th>Source</th>
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($schemas as $schema):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top">
			<span class="ss_sprite ss_layout">&nbsp;</span>
			<a title="Modifier ce schéma" href="<?=base_url()?>index.php/editschema/index/<?=$schema->schidsch?>"><?=$schema->schlbtit?></a></td>
			<td valign="top"><?=$schema->schnuver?></td>
			<td valign="top"><?=$schema->schlbdes?></td>
			<td valign="top"><?=$schema->schdtcre?></td>
			<td valign="top"><? if($schema->schlbimg != null){
				?><span title="Visualiser l'image" class="ss_sprite ss_images" 
						style="cursor: hand; cursor: pointer;"
						onclick="document.location.href='<?=base_url() . $schema->getImageFileURL()?>'">
						&nbsp;
				</span><?}?></td>
			<td valign="top"><? if($schema->schlbsrc != null){
				?><span title="Télécharger la source" class="ss_sprite ss_package" 
						style="cursor: hand; cursor: pointer;"
						onclick="document.location.href='<?=base_url() . $schema->getSourceFileURL()?>'">
						&nbsp;
				</span><?}?></td>
			<td valign="top">
				<a href="#" title="Supprimer ce schéma" onclick="if(confirm('Désirez vous supprimer le schéma [<?=$schema->schlbtit?>] ?')){location.href='<?=base_url()?>index.php/listschemas/delete/<?=$schema->schidsch?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>

<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter un schéma</legend>
<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listschemas/add', $attributes_info, $fields_info );
?>
	<table>
		<tr>
			<td><label for="title">Titre</label> : </td>
			<td><input type="text" name="title" id="title"></td>
		</tr>
		<tr>
			<td style="vertical-align:top"><label for="description">Description</label> : </td>
			<td><textarea rows="3" cols="20" style="width: auto; height: 50px;" name="description" id="description" class="editor_detail"></textarea></td>
		</tr>
		<tr>
			<td><label for="image">Image</label> : </td>
			<td><input type="file" name="image" id="image"></td>
		</tr>
		<tr>
			<td><label for="source">Source</label> : </td>
			<td><input type="file" name="source" id="source"></td>
		</tr>
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
