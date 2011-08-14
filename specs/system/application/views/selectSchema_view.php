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
<? echo htmlHeader('Sélection d\'un schémas'); ?>

<script>
function annule(){
	document.location.href="<?=base_url()?>index.php/editrdg/index/<?= $rdg->rdgidrdg ?><?= !isset($project)?(""):("/".$project->prjidprj) ?>";
}
function termine(){
	document.forms["selectSchema"].submit();
}
</script>
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

	<h2>Sélection d'un schéma</h2>

<?
$attributes_info = array('name' => 'selectSchema');
$fields_info = array('rdgidrdg' => $rdg->rdgidrdg, 'prjidprj' => $prjidprj);
echo form_open_multipart('selectschema/save', $attributes_info, $fields_info );
?>

	<table style="border: 1px solid #b2b2ff; border-collapse: collapse;">
		<tr style="background: #b2b2ff;">
			<th></th>
			<th>Titre</th>
			<th>Image</th>
			<th>Description</th>
			<th>Date de création</th>
		</tr>
	<?php
	$even = true;
	foreach($schemas as $schema):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><?= form_checkbox('selectionSchidsch[]', /*value*/$schema->schidsch, /*checked*/ $rdg->includesSchema($this->db, $schema->schidsch)) ?></td>
			<td valign="top"><?=$schema->schlbtit?></td>
			<td valign="top"><? if($schema->schlbimg != null){
				?><a title="Visualiser l'image" href="<?=base_url() . $schema->getImageFileURL()?>"><img height="32" src="<?=base_url() . $schema->getImageFileURL()?>"></a><?}?></td>
			<td valign="top"><?=$schema->schlbdes?></td>
			<td valign="top"><?=$schema->schdtcre?></td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>

<table>
	<tr>
		<td style="text-align:center"><?= form_button('btnTermine','<span class="ss_sprite ss_accept"> &nbsp; </span> Terminé','onclick="termine()"') ?></td>
		<td style="text-align:center"><?= form_button('btnAnnule','<span class="ss_sprite ss_cancel"> &nbsp; </span> Annuler','onclick="annule()"') ?></td>
	</tr>
</table>
		
<?
echo form_close('');
?>
	</div>

</div>

</body>
</html>
