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
<? echo htmlHeader('Editer un schema'); ?>

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
	<h2><img src="<?=base_url()?>www/images/schema.png" style="vertical-align:middle;" /> Schéma "<?=$schema->schlbtit?>"</h2>

	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('schidsch' => $schema->schidsch);
echo form_open_multipart('editschema/save', $attributes_info, $fields_info );
?>
	<table>
		<tr>
			<th style="vertical-align:top;" nowrap><label for="title">Titre</label> :</th>
			<td colspan="3"><input style="width:100%" type="text" name="title" id="title" value="<?= $schema->schlbtit ?>"></td>
		</tr>
		<tr>
			<th style="vertical-align:top;" nowrap><label for="description">Description</label> : </th>
			<td colspan="3"><textarea class="editor_detail" rows="3" cols="20" style="width: 100%; height: 100px;" name="description" id="description"><?= $schema->schlbdes ?></textarea></td>
		</tr>
		<tr>
			<th valign="top" nowrap><label for="image">Image</label> : </th>
			<td><? if($schema->schlbimg != null){
				?><?} else { ?>
					<i>aucune image</i>
				<?}?>
			</td>
			<td style="vertical-align:top;" nowrap>
				Changer l'image: <br>
				<input type="file" name="image" id="image">
			</td>
			<td rowspan="2">
				<a title="Visualiser l'image" href="<?=base_url() . $schema->getImageFileURL()?>"><img width="250" src="<?=base_url() . $schema->getImageFileURL()?>"></a>
			</td>
		</tr>
		<tr>
			<th style="vertical-align:top;" nowrap><label for="source">Source</label> : </th>
			<td width="20" nowrap><? if($schema->schlbsrc != null){
				?><a title="Telecharger la source" href="<?=base_url() . $schema->getSourceFileURL()?>"><img src="<?=base_url()?>www/images/pack_16.png"></a><?} else { ?>
					<i>aucune source</i>
				<?}?>
			</td>
			<td valign="top" nowrap>
				Changer la source: <br>
				<input type="file" name="source" id="source">
			</td>
		</tr>
		<tr>
			<td colspan="4"><hr>
			</td>
		</tr>
		<tr>
			<td valign="top"></td>
			<td colspan="3">
				<button onclick="document.forms['EditForm'].sumbit()">
					<span class="ss_sprite ss_accept"> &nbsp; </span> Enregistrer
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

