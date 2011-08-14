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
<? echo htmlHeader('Editer un %(Name)'); ?>

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
		</div>
		<div class="span-12"><h2><img src="<?=base_url()?>www/img/%(name_lower).png" style="vertical-align:middle;"> %(Name) </h2></div>
		<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>
	
	</div>

	<div class="prepend-1 append-1">
	
	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('%(keyVariable)' => $%(name_lower)->%(keyVariable));
echo form_open_multipart('edit%(name_lower)/save', $attributes_info, $fields_info );
?>
	<table>
		%(listOfVariablesForEditing)
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['EditForm'].sumbit()">
					<span class="ss_sprite ss_accept"> &nbsp; </span> Enregistrer
				</button>
				<button onclick="document.location.href='<?=base_url()?>index.php/list%(name_lower)s';return false;">
					<span class="ss_sprite ss_control_rewind"> &nbsp; </span> Retour
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
