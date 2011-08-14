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
<? echo htmlHeader('%(Name)'); ?>

</head>
<body>

<div class="container">  
	<div id="header">
		<div class="span-18">
			<img src="<?=base_url() . "www/img/logo.png"?>" style="vertical-align:middle;">
		</div>
		<div class="column span-5 last" id="identification">
			Utilisateur <i><?= $this->session->userdata('user_name'); ?></i> <!-- <?= $this->session->userdata('user_id') ?> --> &nbsp;
			<a href="<?=base_url()?>index.php/welcome/logout" title="Logout"><span class="ss_sprite ss_exclamation "></span></a>
		</div>
		<div class="span-24">
			<?= htmlNavigation( $this->session->userdata('user_id') == 0 ) ?>
		</div>
		<div class="span-12"><h2><img src="<?=base_url()?>www/img/%(name_lower).png" style="vertical-align:middle;"> Liste des %(name_lower)s</h2></div>
		<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>
	
	</div>
	
	<div class="prepend-1 append-1">

	<table class="visible">
		<tr class="header">
			%(listOfVariablesForTableHeader)
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($%(name_lower)s as $%(name_lower)):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><a title="Modifier ce %(Name)" href="<?=base_url()?>index.php/edit%(name_lower)/index/<?=$%(name_lower)->%(keyVariable)?>"><?=$%(name_lower)->%(keyVariable)?></a></td>
			%(listOfVariablesForTableBody)
			<td valign="top">
				<a href="#" title="Supprimer ce %(Name)" onclick="if(confirm('Desirez vous supprimer ce %(Name) ?')){location.href='<?=base_url()?>index.php/list%(name_lower)s/delete/<?=$%(name_lower)->%(keyVariable)?>'}">
				<img src="<?=base_url()?>www/img/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>
<hr>
<fieldset>
	<legend><img src="<?=base_url()?>www/img/plus_16.png"> Ajouter un %(Name)</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('list%(name_lower)s/add', $attributes_info, $fields_info );
?>
	<table>
		%(listOfVariablesForAdding)
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['AddForm'].sumbit()">
					<span class="ss_sprite ss_add"> &nbsp; </span> Ajouter
				</button>
			</td>
		</tr>
	</table>
	%(javascriptCodeForControls)

<?
echo form_close('');
?>
</fieldset>
	</div>
</div>

</body>
</html>
