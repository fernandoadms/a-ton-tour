<?php
/*
 * Created on 06/04/2010
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
<? echo htmlHeader('Editer une règle de gestion'); ?>

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
<h2><img src="<?=base_url()?>www/images/rdg.jpg"/ style="vertical-align:middle;"> Règles de gestion "<?= $rdg->rdgnurdg ?>"</h2>

<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('rdgidrdg' => $rdg->rdgidrdg);
echo form_open_multipart('editrdg/save', $attributes_info, $fields_info );
?>
	<fieldset>
	<table>
	
		<tr>
			<td nowrap><label for="project">Projet</label> : </td>
			<td>
				<?php if(isset($projects)){ ?>
				<select name="project" id="project">
					<?php foreach($projects as $project): ?>
						<option value="<?= $project->prjidprj ?>" <?= ($rdg->prjidprj == $project->prjidprj)?("selected"):("") ?>><?= $project->prjlbtit ?></option>
					<?php endforeach; ?>
				</select>
				<?php }else{ ?>
					<span id="project"><input type="hidden" name="masterProject" value="<?= $project->prjidprj ?>"><?= $project->prjlbtit ?></span>
				<?php }?>
			</td>
		</tr>
		<tr>
			<td nowrap><label for="number">Numéro</label> : </td>
			<td><input type="text" name="number" id="number" value="<?= $rdg->rdgnurdg ?>"></td>
		</tr>
		<tr>
			<td nowrap><label for="type">Type</label> : </td>
			<td><select name="type" id="type">
				<option value="F" <?= ($rdg->rdgtyrdg == 'F')?("selected"):("") ?>>Fonctionnelle</option>
				<option value="T" <?= ($rdg->rdgtyrdg == 'T')?("selected"):("") ?>>Technique</option>
			</select>
			</td>
		</tr>
		<tr>
			<td nowrap style="vertical-align:top;"><label for="anounce">Enoncé</label> : </td>
			<td><textarea rows="3" cols="20" style="width: 100%; heighprjlbtitt: 200px;" name="anounce" id="anounce" class="editor_detail"><?= $rdg->rdglbeno ?></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['EditForm'].sumbit()">
					<span class="ss_sprite ss_accept"> &nbsp; </span> Enregistrer
				</button>
				<?php if( !isset($projects)){ ?>
				&nbsp;
				<button onclick="document.location.href='<?=base_url()?>index.php/editproject/index/<?= $project->prjidprj?>';return false;">
					<span class="ss_sprite ss_control_rewind"> &nbsp; </span> Retour au projet
				</button>
				<?php } ?>
			</td>
		</tr>
	</table>
<?
echo form_close('');
?>
	</fieldset>
	
	<h3>Schémas</h3>
	<table class="visible">
		<tr class="header">
			<th>Titre</th>
			<th>Image</th>
			<th>Supprimer</th>
		</tr>
	
	<?php $even = true;
	foreach($rdg->getSchemas($this->db) as $schema): ?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td>
				<a title="Schema '<?= $schema->schlbtit ?>'" href="<?=base_url()?>/index.php/editschema/index/<?= $schema->schidsch ?>"><?= $schema->schlbtit ?></a>
			</td>
			<td>
				<a href="<?=base_url() . $schema->getImageFileURL()?>"><img width="100" src="<?=base_url() . $schema->getImageFileURL()?>"></a>
			</td>
			<td>
				<a href="<?=base_url()?>index.php/editrdg/deleteschema/<?=$rdg->rdgidrdg?>/<?= $schema->schidsch ?><?= isset($projects)?(""):("/".$project->prjidprj) ?>" 
					title="Supprimer ce schéma">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
		</tr>
	<?php  $even = !$even;
	endforeach;?>
	</table>
	<hr>
	<button onclick="document.location.href='<?=base_url()?>index.php/selectschema/index/<?= $rdg->rdgidrdg ?><?= isset($projects)?(""):("/".$project->prjidprj) ?>'">
		<span class="ss_sprite ss_add"> &nbsp; </span> Ajouter un schéma
	</button>
</div>
</div>

</body>
</html>

