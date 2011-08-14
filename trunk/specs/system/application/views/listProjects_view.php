<?php
/*
 * Created on 20/04/2010
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
<? echo htmlHeader('Projets'); ?>

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


	<div class="span-12"><h2><img src="<?=base_url()?>www/images/projet.jpg"/ style="vertical-align:middle;"> Liste des projets</h2></div>
	<div class="span-7 last" style="float: right;"><?= $this->session->flashdata('message');?></div>

	<table class="visible">
		<tr class="header">
			<th>Titre</th>
			<th>Description</th>
			<? if($this->session->userdata('user_id') == 0 ){?>
			<th>Supprimer</th>
			<?} ?>
		</tr>
	<?php
	$even = true;
	foreach($projects as $project):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><a title="Modifier ce projet" href="<?=base_url()?>index.php/editproject/index/<?=$project->prjidprj?>"><?=$project->prjlbtit?></a></td>
			<td valign="top"><?=$project->prjlbdes?></td>
			<? if($this->session->userdata('user_id') == 0 ){?>
			<td valign="top">
				<a href="#" title="Supprimer ce projet" onclick="if(confirm('Désirez vous supprimer ce projet [<?=$project->prjlbtit?>] ?')){location.href='<?=base_url()?>index.php/listprojects/delete/<?=$project->prjidprj?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
			<?} ?>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>
<hr>
<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter un projet</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listprojects/add', $attributes_info, $fields_info );
?>
	<table>
		<tr>
			<td><label for="title">Titre</label> : </td>
			<td><input type="text" name="title" id="title"></td>
		</tr>
		<tr>
			<td style="vertical-align:top"><label for="description">Description</label> : </td>
			<td><textarea style="width: 100%; height: 80px;" name="description" id="description" class="editor_detail"></textarea></td>
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
