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
		<img src="<?=base_url() . "www/images/logo.png"?>" style="vertical-align:middle;">
		<?= htmlNavigation( $this->session->userdata('user_id') == 0 ) ?>
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/%(name_lower).png" style="vertical-align:middle;"> %(Name) </h2></div>
	</div>
	
	<div class="prepend-1 append-1">
	
	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('%(obNameKeyVariable)' => $%(name_lower)->%(keyVariable));
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
