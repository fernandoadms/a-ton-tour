%[kind : views]
%[file : list%%(self.obName.lower())%%s_view.php] 
%[path : views/%%(self.obName.lower())%%]
<?php
/*
 * Created by generator
 *
 */

$this->load->helper('form');
$this->load->helper('url');
$this->load->helper('template');
$this->load->helper('views');

if($this->session->userdata('user_name') == "") {
	redirect('welcome/index');
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head><!-- Liste des %%(self.displayName)%%s -->
<?php echo htmlHeader($this->lang->line('%%(self.obName.lower())%%.form.list.title')); ?>

</head>
<body>

	<?= htmlNavigation("%%(self.obName.lower())%%","list", $this->session); ?>
	
	<div class="container">

		<h2><?= $this->lang->line('%%(self.obName.lower())%%.form.list.title') ?></h2>
			<?php
				$msg = $this->session->flashdata('msg_info');    if($msg != ""){echo formatInfo($msg);} 
				$msg = $this->session->flashdata('msg_confirm'); if($msg != ""){echo formatConfirm($msg);}
				$msg = $this->session->flashdata('msg_warn');    if($msg != ""){echo formatWarn($msg);}
				$msg = $this->session->flashdata('msg_error');   if($msg != ""){echo formatError($msg);}
			?>
		
		<table class="table table-striped table-bordered table-condensed">
			<thead>
				<tr>
		<!-- table header auto-generated : -->
			%%
RETURN = self.dbAndObVariablesList("""<th class=\"sortable\">
						<a href="<?=base_url()?>index.php/%(obName)s/list%(obName)ss/index/(dbVar)s/<?= ($orderBy == '(dbVar)s'&& $asc == 'asc')?('desc'):('asc') ?>"
						<?php if($orderBy == '(dbVar)s'&& $asc == 'asc') {?>
							class=" sortAsc"
						<?php }else if($orderBy == '(dbVar)s'&& $asc == 'desc') {?>
							class=" sortDesc"
						<?php }?>
						><?= $this->lang->line('%(obName)s.form.(dbVar)s.label') ?></a></th>""" % {'obName':self.obName.lower()}, 'dbVar', 'obVar', 3, False)
%%
					<th><?= $this->lang->line('object.tableheader.actions') ?></th>
				</tr>
			</thead>
			<tbody>
<?php
$even = false;
%%allAttributes = "" 
for field in self.fields:
	if field.dbName != self.keyFields[0].dbName:
		if field.sqlType.upper()[0:4] == "ENUM":
			enumTypes = field.sqlType[5:-1]
			for enum in enumTypes.split(','):
				valueAndText = enum.replace('"','').replace("'","").split(':')
				attributeCode = "\"%(value)s\"=>\"%(text)s\"" % {'value': valueAndText[0].strip(), 
					'text': valueAndText[1].strip()}
				if allAttributes != "":
					allAttributes += ", " + attributeCode
				else:
					allAttributes = attributeCode
			 
allEnums = "$enum_%(dbName)s = array(%(allAttributes)s);" % {'dbName' : field.dbName, 'allAttributes' : allAttributes }
RETURN = allEnums
%%
foreach($%%(self.obName.lower())%%s as $%%(self.obName.lower())%%):
%%allAttributesCode = ""

for field in self.fields:
	attributeCode = ""
	if field.referencedObject and field.access == "ajax" :
		attributeCode = """
	$%(dbName)s_text = %(referencedObject)s_model::get%(referencedObject)s($this->db, $%(structureObName)s->%(dbName)s);
""" % {
		'structureObName' : self.obName.lower(),
		'referencedObject': field.referencedObject.obName,
		'dbName' : field.dbName
		}
	allAttributesCode += attributeCode
RETURN = allAttributesCode
%%
?>
	<tr>
%%allAttributesCode = ""

for field in self.fields:
	if field.dbName != self.keyFields[0].dbName:
		attributeCode = """
				<td valign="top">"""
		if field.referencedObject and field.access == "default":
			# si pas de lien, le champ vaut 0 (et la sequence commence à 1)
			attributeCode += """<?=($%(structureObName)s->%(dbName)s == 0)?(""):($%(referencedObject)sCollection[$%(structureObName)s->%(dbName)s]->%(display)s)?>
			""" % { 'display' : field.display, 
					'referencedObject' : field.referencedObject.obName.lower(),
					'structureObName' : self.obName.lower(),
					'dbName' : field.dbName}
		elif field.referencedObject and field.access == 'ajax':
			attributeCode += """<?=$%(dbName)s_text->%(display)s?>""" % {
					'display' : field.display, 
					'dbName' : field.dbName }
		elif field.sqlType.upper()[0:4] == "FLAG":
			label = field.sqlType[5:-1].replace('"','').replace("'","")
			attributeCode += """<?= ($%(structureObName)s->%(dbName)s == "O")?("%(label)s"):("")?>""" % {'label' : label,
				'structureObName' : self.obName.lower(),
				'dbName' : field.dbName}
		elif field.sqlType.upper()[0:4] == "ENUM":
			attributeCode += """<?=$enum_%(dbName)s[$%(structureObName)s->%(dbName)s]?>""" % {
				'structureObName' : self.obName.lower(),
				'dbName' : field.dbName}
		elif field.sqlType.upper()[0:4] == "FILE":
			attributeCode += """<a href="<?=base_url()?>/www/uploads/<?=$%(structureObName)s->%(dbName)s?>" class="downloadFile">
				<?=$%(structureObName)s->%(dbName)s?></a>""" % {
				'structureObName' : self.obName.lower(),
				'dbName' : field.dbName}
		elif field.sqlType.upper()[0:8] == "PASSWORD":
			attributeCode += """<input type="hidden" name="%(dbName)s" id="%(dbName)s" value="<?=$%(structureObName)s->%(dbName)s?>">
			<span title="<?=$%(structureObName)s->%(dbName)s?>">&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;&#9733;</span>
			""" % {
				'structureObName' : self.obName.lower(),
				'dbName' : field.dbName}
		else:
			attributeCode += """<?=$%(structureObName)s->%(dbName)s?>""" % {
				'structureObName' : self.obName.lower(),
				'dbName' : field.dbName}
			 
		allAttributesCode += attributeCode + "</td>"
	
RETURN = allAttributesCode
%%
					<td><a href="<?=base_url()?>index.php/%%(self.obName.lower())%%/edit%%(self.obName.lower())%%/index/<?=$%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%?>" title="<?= $this->lang->line('form.button.edit') ?>"><i class="icon-pencil"> </i></a>
						<a href="<?=base_url()?>index.php/%%(self.obName.lower())%%/list%%(self.obName.lower())%%s/delete/<?=$%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%?>" title="<?= $this->lang->line('form.button.delete') ?>"><i class="icon-trash"> </i></a></td>
				</tr>
<?php 
$even = !$even; 
endforeach; ?>

			</tbody>
		</table>
	
		<div class="pagination">
			<ul>
			<?php if(isset($pagination)){ echo $pagination->create_links(); } ?>
			</ul>
		</div><!-- .pagination -->
		
		<a href="<?=base_url()?>index.php/%%(self.obName.lower())%%/create%%(self.obName.lower())%%/index" class="btn btn-primary"><?= $this->lang->line('%%(self.obName.lower())%%.form.create.title') ?></a>
	</div><!-- .container -->
	
<?php echo bodyFooter(); ?>

<script src="<?= base_url() ?>www/js/views/%%(self.obName.lower())%%/list%%(self.obName.lower())%%s.js"></script>


</body>
</html>