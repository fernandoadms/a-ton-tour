<?php
/*
 * Created on 21/05/2010
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
<? echo htmlHeader('Cas d\'utilisation'); ?>

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


	<div class="span-12"><h2><img src="<?=base_url()?>www/images/cdu.png"/ style="vertical-align:middle;"> Liste des cas d'utilisation</h2></div>
	<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>

	<table class="visible">
		<tr class="header">
			<th>Projet</th>
			<th>Titre</th>
			<th>Numéro</th>
			<th>Description</th>
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($cdus as $cdu):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td><? if($cdu->prjidprj == null) {?>
				<i>aucun</i>
				<?} else { ?>
				<span class="ss_sprite ss_chart_organisation"> &nbsp;
				<a href="<?=base_url()?>index.php/editproject/index/<?=$cdu->prjidprj?>"><?= $cdu->prjlbtit ?></a></span>
				<?} ?>
			</td>
			<td valign="top"><span class="ss_sprite ss_cog">&nbsp;</span> <a title="Modifier ce cas d'utilisation" href="<?=base_url()?>index.php/editcdu/index/<?=$cdu->cduidcdu?>"><?=$cdu->cdulbtit?></a></td>
			<td valign="top"><?=$cdu->cdulbnum?></td>
			<td valign="top"><?=$cdu->cdulbdes?></td>
			<td valign="top">
				<a href="#" title="Supprimer ce cas d'utilisation" onclick="if(confirm('Désirez vous supprimer ce cas d\'utilisation [<?=$cdu->cdulbtit?>] ?')){location.href='<?=base_url()?>index.php/listcdus/delete/<?=$cdu->cduidcdu?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>
<hr>
<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter un cas d'utilisation</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listcdus/add', $attributes_info, $fields_info );
?>
	<table>
		<tr>
			<td><label for="projet">Projet</label> : </td>
			<td>
				<select id="projet" name="projet">
					<?php foreach( $projects as $project):?>
					<option value="<?=$project->prjidprj?>"><?= $project->prjlbtit ?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td><label for="titre">Titre</label> : </td>
			<td><input type="text" name="titre" id="titre"></td>
		</tr>
		<tr>
			<td><label for="numero">Numéro</label> : </td>
			<td><input type="text" name="numero" id="numero"></td>
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
