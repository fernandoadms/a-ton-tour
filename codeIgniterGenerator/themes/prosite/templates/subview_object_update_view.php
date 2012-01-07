<?php
?>

<!-- Edition d'un objet -->
<fieldset>
	<legend><a name="new"></a>Editer un %(Name)</legend>

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
				<button onclick="document.forms['EditForm'].sumbit()" class="form-submit">
					Enregistrer
				</button>
				<button onclick="document.location.href='<?=base_url()?>index.php/list%(name_lower)s';return false;" class="form-back">
					Retour
				</button>
			</td>
		</tr>
	</table>
	%(javascriptCodeForControls)
<?
echo form_close('');
?>
</fieldset>
<!-- /Edition d'un objet -->

	