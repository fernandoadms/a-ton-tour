<?php
/*
 * Created on 05/04/2010
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
<? echo htmlHeader('Règles de Gestion'); ?>

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


	<div class="span-12"><h2><img src="<?=base_url()?>www/images/rdg.jpg" style="vertical-align:middle;"/> Liste des règles de gestion</h2></div>
	<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>

	<table class="visible">
		<tr class="header">
			<th>Projet</th>
			<th>Numéro</th>
			<th>Type</th>
			<th>Enoncé</th>
			<th>Date de création</th>
			<th>Schémas</th>
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($rdgs as $rdg):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td><? if($rdg->prjidprj == null) {?>
				<i>aucun</i>
				<?} else { ?>
				<span class="ss_sprite ss_chart_organisation"> &nbsp;
				<a href="<?=base_url()?>index.php/editproject/index/<?=$rdg->prjidprj?>"><?= $rdg->prjlbtit ?></a></span>
				<?} ?>
			</td>
			<td valign="top"><span class="ss_sprite ss_script"> &nbsp; </span> <a title="Modifier cette règle" href="<?=base_url()?>index.php/editrdg/index/<?=$rdg->rdgidrdg?>"><?=$rdg->rdgnurdg?></a></td>
			<td valign="top"><?=$rdg->getLabelType()?></td>
			<td valign="top"><?=$rdg->rdglbeno?></td>
			<td valign="top"><?=$rdg->rdgdtcre?></td>
			<td valign="top">
				<?php foreach($rdg->getSchemas($this->db) as $schema): ?>
					<span title="Schema '<?= $schema->schlbtit ?>'" class="ss_sprite ss_layout" 
						style="cursor: hand; cursor: pointer;"
						onclick="document.location.href='<?=base_url()?>/index.php/editschema/index/<?= $schema->schidsch ?>'">
					&nbsp;
					</span>
				<?php endforeach;?>
			</td>
			<td valign="top">
				<a href="#" title="Supprimer cette règle" onclick="if(confirm('Désirez vous supprimer cette règle [<?=$rdg->rdgnurdg?>] ?')){location.href='<?=base_url()?>index.php/listrdgs/delete/<?=$rdg->rdgidrdg?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>
<hr>
<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter une règle de gestion</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listrdgs/add', $attributes_info, $fields_info );
?>
	<table>
		<tr>
			<td><label for="project">Projet</label> : </td>
			<td>
				<select id="project" name="project">
					<?php foreach( $projects as $project):?>
					<option value="<?=$project->prjidprj?>"><?= $project->prjlbtit ?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td><label for="number">Numéro</label> : </td>
			<td><input type="text" name="number" id="number"></td>
		</tr>
		<tr>
			<td><label for="type">Type</label> : </td>
			<td><select name="type" id="type">
				<option value="F">Fonctionnelle</option>
				<option value="T">Technique</option>
			</select>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top"><label for="anounce">Enoncé</label> : </td>
			<td><textarea style="width: 100%; height: 80px;" name="anounce" id="anounce" class="editor_detail"></textarea></td>
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
