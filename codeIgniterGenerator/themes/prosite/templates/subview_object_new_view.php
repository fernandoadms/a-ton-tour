<?php
?>

<!-- Ajouter un item -->
<fieldset>
	<legend><a name="new"></a><img src="<?=base_url()?>www/img/plus_16.png"> Ajouter un %(Name)</legend>

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
				<button onclick="document.forms['AddForm'].sumbit()" class="form-submit">Ajouter</button>
			</td>
		</tr>
	</table>
	%(javascriptCodeForControls)

<?
echo form_close('');
?>
</fieldset>
<!-- /Ajouter un item  -->

