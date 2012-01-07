<?php
?>

  	<!-- Liste des items -->
	<table class="data">
		<tr>
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
			<td valign="top" align="center">
				<a href="#" title="Supprimer ce %(Name)" onclick="if(confirm('Desirez vous supprimer ce %(Name) ?')){location.href='<?=base_url()?>index.php/list%(name_lower)s/delete/<?=$%(name_lower)->%(keyVariable)?>'}">
				<img src="<?=base_url()?>www/img/delete_16.png"></a>
			</td>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
	</table><!-- Liste des items -->
	
	<!-- Pagination -->
	<table class="pagination">
		<tr>
			<?php echo $pagination->create_links() ?>
		</tr>
	</table>
	<!-- /Pagination -->
	