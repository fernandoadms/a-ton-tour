%[kind : views]
%[file : edit%%(self.obName.lower())%%_view.php]
%[path : views]
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
<head>
<?php echo htmlHeader( $this->lang->line('%%(self.obName.lower())%%.form.edit.title') ); ?>

</head>
<body>

	<?= htmlNavigation("%%(self.obName.lower())%%","edit", $this->session); ?>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h1 id="navbar"><?= $this->lang->line('%%(self.obName.lower())%%.form.edit.title') ?></h1>
				</div>
			</div>
		</div>
	
			<?php
				$msg = $this->session->flashdata('msg_info');    if($msg != ""){echo formatInfo($msg);} 
				$msg = $this->session->flashdata('msg_confirm'); if($msg != ""){echo formatConfirm($msg);}
				$msg = $this->session->flashdata('msg_warn');    if($msg != ""){echo formatWarn($msg);}
				$msg = $this->session->flashdata('msg_error');   if($msg != ""){echo formatError($msg);}
			?>
			
		<div class="row">
			<div class="col-lg-12">
				<div class="well">
<?php
$attributes_info = array('name' => 'EditForm', 'class' => 'form-horizontal');
$fields_info = array('%%(self.keyFields[0].dbName)%%' => $%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%);
echo form_open_multipart('edit%%(self.obName.lower())%%/save', $attributes_info, $fields_info );
?>

			<fieldset>
	<!-- list of variables - auto-generated : -->
%%allAttributesCode = ""

for field in self.fields:
	attributeCode = ""
	if field.autoincrement:
		## ne pas presenter les champs auto-increment
		attributeCode = "<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE - " + attributeCode + " -->"
		continue
	
	valueCode = "<?= $%(structureObName)s->%(dbName)s ?>" % { 'structureObName': self.obName.lower(), 'dbName' : field.dbName }
	
	attributeCode += """<div class="form-group">
	<label class="col-lg-4 control-label" for="%(dbName)s">""" % { 'dbName' : field.dbName }

	if not field.nullable:
		attributeCode += "* "

	attributeCode += """<?= $this->lang->line('%(objectObName)s.form.%(dbName)s.label') ?> :</label>
	<div class="col-lg-8">""" % { 'dbName' : field.dbName, 'objectObName' : self.obName.lower() }

	cssClass = "inp-form"

			
	if field.referencedObject:
		attributeCode += """<select name="%(dbName)s" id="%(dbName)s" class="form-control"> """ % { 'dbName' : field.dbName }
		if field.nullable:
			attributeCode += """<option value=""></option>"""
		attributeCode += """
					<?php foreach ($%(referencedObject)sCollection as $%(referencedObject)sElt): ?>
					<option value="<?= $%(referencedObject)sElt->%(keyReference)s ?>" <?= ($%(referencedObject)sElt->%(keyReference)s == $%(structureObName)s->%(dbName)s)?("selected"):("")?>><?= $%(referencedObject)sElt->%(display)s ?> </option>
					<?php endforeach;?>
				</select>
		""" % { 'display' : field.display, 
				'keyReference' : field.referencedObject.keyFields[0].dbName, 
				'referencedObject' : field.referencedObject.obName.lower(), 
				'structureObName' : self.obName.lower(),
				'dbName' : field.dbName}
				
	elif field.sqlType.upper()[0:4] == "DATE":
		dateFormat = field.sqlType[5:-1]
		attributeCode += """<div data-date-format="%(dateFormat)s" id="datepicker_%(dbName)s"
			class="input-append date input-group"><input type="text" name="%(dbName)s" id="%(dbName)s" size="8" maxlength="10" value="%(valueCode)s" class="form-control"> 
			<span class="input-group-addon add-on"><i class="icon-calendar"></i></span>
		</div>""" % { 'dbName' : field.dbName, 'valueCode' : valueCode, 'dateFormat' : dateFormat}
		
	elif field.sqlType.upper()[0:8] == "PASSWORD":
		attributeCode += """<div class="input-group">
								<span class="input-group-addon add-on"><i class="icon-key"></i></span> <input
									type="password" placeholder="Password" name="%(dbName)s" id="%(dbName)s" value="%(valueCode)s" class="form-control">
							</div>""" % { 'dbName' : field.dbName, 'valueCode' : valueCode}
		
	elif field.sqlType.upper()[0:4] == "TEXT":
		attributeCode += """<textarea name="%(dbName)s" id="%(dbName)s" class="form-control">%(valueCode)s</textarea>""" % { 'dbName' : field.dbName, 'valueCode' : valueCode}
		
	elif field.sqlType.upper()[0:4] == "FILE":
		attributeCode += """<input class="form-control input-file" id="%(dbName)s_file" name="%(dbName)s_file" type="file">
		<input type="hidden" name="%(dbName)s" id="%(dbName)s" value="%(valueCode)s">
		<?php if($%(structureObName)s->%(dbName)s != "") { ?>
			<div class="span4"><a href="<?=base_url()?>www/uploads/%(valueCode)s" ><i class="icon-file"></i> Download</a></div>
			<div class="span2"><a href="#" onclick='$("%(dbName)s").val("")' class="btn"><i class="icon-trash"></i> Delete</a></div>
			<?php } ?>
		""" % { 'dbName' : field.dbName, 
				'valueCode' : valueCode,
				'structureObName': self.obName.lower()
		}

	elif field.sqlType.upper()[0:4] == "FLAG":
		label = field.sqlType[5:-1].strip('"').strip("'")
		attributeCode += """<div class="checkbox"><label> <input name="%(dbName)s" id="%(dbName)s" value="O" type="checkbox"
		<?= ($%(structureObName)s->%(dbName)s == "O")?("checked"):("")?>> %(label)s
							</label></div>""" % { 'dbName' : field.dbName, 
				'label': label.strip(), 
				'structureObName' : self.obName.lower(), }
		
	elif field.sqlType.upper()[0:4] == "ENUM":
		attributeCode += """<select name="%(dbName)s" id="%(dbName)s"class="form-control">""" % { 'dbName' : field.dbName }
		enumTypes = field.sqlType[5:-1]
		for enum in enumTypes.split(','):
			valueAndText = enum.replace('"','').replace("'","").split(':')
			attributeCode += """<option value="%(value)s" <?= ($%(structureObName)s->%(dbName)s == "%(value)s")?("selected"):("")?> >%(text)s</option>""" % {'value': valueAndText[0].strip(), 
				'text': valueAndText[1].strip(), 
				'structureObName' : self.obName.lower(),
				'dbName' : field.dbName }
		attributeCode += """</select>"""

	else:
		# for string, int, ...
		attributeCode += """<input class="input-xlarge valtype form-control" type="text" name="%(dbName)s" id="%(dbName)s" value="%(valueCode)s" """ % { 'dbName' : field.dbName, 
					'valueCode' : valueCode}
		if field.getAttribute("check") and field.getAttribute("check") != "" :
			attributeCode += """onblur="checkField(this,%(regexp)s)" """ % {'regexp' : field.getAttribute("check")}
			attributeCode += """>""" % {'dbName' : field.dbName}
		else:
			attributeCode += ">"
			
	attributeCode += """
		<p class="help-block valtype"><?= $this->lang->line('%(objectObName)s.form.%(dbName)s.description')?></p>
	</div>
	</div>""" % {'dbName' : field.dbName, 'objectObName' : self.obName.lower() }
	

	# ajouter le nouvel attribut, avec indentation si ce n'est pas le premier
	if allAttributesCode != "":
		allAttributesCode += "\n\t" 
	allAttributesCode += attributeCode

RETURN =  allAttributesCode
%%

			<div class="form-group">
				<div class="col-lg-8 col-lg-offset-4">
					<button class="btn btn-default" onclick="document.location.href='<?=base_url()?>index.php/list%%(self.obName.lower())%%s/index'; return false;"><?= $this->lang->line('form.button.cancel') ?></button>
					<button class="btn btn-primary" type="submit"><?= $this->lang->line('form.button.save') ?></button>
				</div>
			</div>
			
			</fieldset>

<?php
echo form_close('');
?>

			</div> <!-- .well -->
		</div> <!-- .row-->
	</div> <!-- .container -->

<?php echo bodyFooter(); ?>

%%
jsCode = ""
hasDate = False
for field in self.fields:
	if field.sqlType.upper()[0:4] == "DATE":
		hasDate = True
		if jsCode == "":
			jsCode = """<script type="text/javascript">
"""
		jsCode += """$('#datepicker_%(dbName)s').datepicker();
""" % { 'dbName' : field.dbName }

if hasDate:
	jsCode += """</script>"""
RETURN = jsCode
%%


</body>
</html>