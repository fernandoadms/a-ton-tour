%[kind : subViews]
%[file : %%(self.obName.lower())%%s_all_view.php]
%[path : views/subviews]
<?php
?>

  	<!-- Liste des items -->
	<table class="data">
		<tr>
			%%
RETURN = self.dbAndObVariablesList("""<th>(obVar)s
			<span style="float: right;">
				<a href="<?=base_url()?>index.php/list%ss/index/(dbVar)s/<?= ($orderBy == '(dbVar)s'&& $asc == 'asc')?('desc'):('asc') ?>">
				<?php if($orderBy == '(dbVar)s'&& $asc == 'asc') {?>
					<img src="<?=base_url()?>www/img/sortAsc.png">
				<?php }else if($orderBy == '(dbVar)s'&& $asc == 'desc') {?>
					<img src="<?=base_url()?>www/img/sortDesc.png">
				<?php } else{?>
					<img src="<?=base_url()?>www/img/sortable.png">
				<?php }?>
				</a>
			</span></th>""" % self.obName.lower(), 'dbVar', 'obVar', 3, True)
%%
			<th>Supprimer</th>
		</tr>
	<?php
	$even = true;
	foreach($%%(self.obName.lower())%%s as $%%(self.obName.lower())%%):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><a title="Modifier ce %%(self.obName)%%" href="<?=base_url()?>index.php/edit%%(self.obName.lower())%%/index/<?=$%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%?>"><?=$%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%?></a></td>
			%%allAttributesCode = ""

for field in self.fields:
	if field.dbName != self.keyFields[0].dbName:
		attributeCode = """
				<td valign="top">"""
		if field.referencedObject:
			attributeCode += """<?=$%(referencedObject)sCollection[$%(structureObName)s->%(dbName)s]->%(display)s?>
			""" % { 'display' : field.display, 
					'referencedObject' : field.referencedObject.obName.lower(),
					'structureObName' : self.obName.lower(),
					'dbName' : field.dbName}
		else:
			attributeCode += """<?=$%(structureObName)s->%(dbName)s?>""" % {
				'structureObName' : self.obName.lower(),
				'dbName' : field.dbName}
			 
		allAttributesCode += attributeCode + "</td>"
	
RETURN = allAttributesCode
			%%
			<td valign="top" align="center">
				<a href="#" title="Supprimer ce %%(self.obName)%%" onclick="if(confirm('Desirez vous supprimer ce %%(self.obName)%% ?')){location.href='<?=base_url()?>index.php/list%%(self.obName.lower())%%s/delete/<?=$%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%?>'}">
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
	