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
<? echo htmlHeader('Selection d\'une règle de gestion'); ?>

<script>
function annule(){
	document.location.href="<?=base_url()?>index.php/editcdu/index/<?= $cdu->cduidcdu ?><?= isset($prjidprj)?("/".$prjidprj):("") ?>";
}
function termine(){
	document.forms["selectRdg"].submit();
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

	<h2>Sélection d'une règle de gestion</h2>

<?
$attributes_info = array('name' => 'selectRdg');
$fields_info = array('cduidcdu' => $cdu->cduidcdu, 'prjidprj' => $prjidprj);
echo form_open_multipart('selectrdg/save', $attributes_info, $fields_info );
?>

	<table style="border: 1px solid #b2b2ff; border-collapse: collapse;">
		<tr style="background: #b2b2ff;">
			<th></th>
			<th>Numéro</th>
			<th>Type</th>
			<th>Enoncé</th>
			<th>Date de création</th>
			<th>Schémas</th>
		</tr>
	<?php
	$even = true;
	foreach($rdgs as $rdg):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><?= form_checkbox('selectionRdgidrdg[]', /*value*/$rdg->rdgidrdg, /*checked*/ $cdu->includesRdg($this->db, $rdg->rdgidrdg)) ?></td>
			<td valign="top"><span class="ss_sprite ss_script"> &nbsp; </span> <?=$rdg->rdgnurdg?></td>
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
