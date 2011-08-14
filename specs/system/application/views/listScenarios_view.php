<?php
/*
 * Created on 03/05/2010
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
<? echo htmlHeader('Scenarios'); ?>

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

	<div class="span-12"><h2><img src="<?=base_url()?>www/images/scenario.jpg"/ style="vertical-align:middle;"> Liste des scénarios</h2></div>
	<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>

	<table class="visible">
		<tr style="background: #b2b2ff;">
			<th>CDU</th>
			<th>Libellé</th>
			<th>Type</th>
			<th>Résultat</th>
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($scenarios as $scenario):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><span class="ss_sprite ss_cog">&nbsp;</span> <a title="Modifier ce scenario" href="<?=base_url()?>index.php/editcdu/index/<?=$scenario->cduidcdu?>"><?=$scenario->getCdu($this->db)->cdulbtit ?></a></td>
			<td valign="top"><span class="ss_sprite ss_flag_blue">&nbsp;</span> <a title="Modifier ce scenario" href="<?=base_url()?>index.php/editscenario/index/<?=$scenario->scnidscn?>"><?=$scenario->scnlbscn?></a></td>
			<td valign="top"><?=$scenario->scntyscn?></td>
			<td valign="top"><?=$scenario->scnlbres?></td>
			<td valign="top">
				<a href="#" title="Supprimer ce scénario" onclick="if(confirm('Désirez vous supprimer ce scénario [<?=$scenario->scnlbscn?>] ?')){location.href='<?=base_url()?>index.php/listscenarios/delete/<?=$scenario->scnidscn?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>

<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter un scénario</legend>
<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listscenarios/add', $attributes_info, $fields_info );
?>
	<table>
		<tr>
			<td style="vertical-align:top; width: 80px;"><label for="cdu">CDU</label> : </td>
			<td>
				<select id="cdu" name="cdu">
					<?php foreach( $cdus as $cdu):?>
					<option value="<?=$cdu->cduidcdu?>"><?= $cdu->cdulbtit ?></option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top; width: 80px;"><label for="label">Libellé</label> : </td>
			<td><input type="text" name="label" id="label"></td>
		</tr>
		<tr>
			<td style="vertical-align:top"><label for="type">Type</label> : </td>
			<td>
				<select name="type" id="type">
					<option value="NOMINAL">Nominal</option>
					<option value="ALTERNAITF">Alternatif</option>
					<option value="EXCEPTION">Exception</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top"><label for="result">Résultat</label> : </td>
			<td><textarea rows="3" cols="20" style="width: 100%; height: 60px;" name="result" id="result" class="editor_detail"></textarea></td>
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
