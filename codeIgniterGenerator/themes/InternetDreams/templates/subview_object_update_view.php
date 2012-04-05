%[kind : subViews]
%[file : %%(self.obName.lower())%%_update_view.php]
%[path : views/subviews]


<!--  start table-content  -->
<div id="table-content">
	<!-- start id-form -->
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">

<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('%%(self.keyFields[0].dbName)%%' => $%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%);
echo form_open_multipart('edit%%(self.obName.lower())%%/save', $attributes_info, $fields_info );
?>
<!-- list of variables - auto-generated : -->
%%allAttributesCode = ""

for field in self.fields:
	attributeCode = ""
	if field.autoincrement:
		## ne pas presenter les champs auto-increment
		attributeCode = "<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE - " + attributeCode + " -->"
		continue
	
	valueCode = "<?= $%(structureObName)s->%(dbName)s ?>" % { 'structureObName': self.obName.lower(), 'dbName' : field.dbName }
	
	attributeCode += """<tr><td nowrap style="vertical-align: top; padding-top: 6px;"><label title="%(desc)s" for="%(dbName)s">""" % { 'dbName' : field.dbName, 'desc' : field.description }

	if not field.nullable:
		attributeCode += "* "

	attributeCode += """%(obName)s :</label> </td>
		<td>
			""" % { 'obName' : field.obName }

	cssClass = "inp-form"

			
	if field.referencedObject:
		attributeCode += """<select class="styledselect_form_1" name="%(dbName)s" id="%(dbName)s"> """ % { 'dbName' : field.dbName }
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
				'dbName' : field.dbName }
				
	elif field.sqlType.upper()[0:4] == "DATE":
		attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" size="8" maxlength="10" class="%(cssClass)s" value="%(valueCode)s"> <img src="<?=base_url()?>www/images/forms/icon_calendar.jpg" alt="" id="btn_%(dbName)s">""" % { 'dbName' : field.dbName, 'cssClass' : cssClass, 'valueCode' : valueCode}
		
	elif field.sqlType.upper()[0:4] == "TEXT":
		attributeCode += """<textarea name="%(dbName)s" id="%(dbName)s" class="form-textarea">%(valueCode)s</textarea>""" % { 'dbName' : field.dbName, 'valueCode' : valueCode }
		
	elif field.sqlType.upper()[0:4] == "FILE":
		attributeCode += """<a href="<?=base_url()?>/www/uploads/%(valueCode)s" 
			class="downloadFile">%(valueCode)s</a> <a href="#" title="Supprimer ce fichier">[X]</a><br><br>
			<input type="file" class="file_1" name="%(dbName)s_file" id="%(dbName)s_file">
		</td>
		<td>
			<div class="bubble-left"></div>
			<div class="bubble-inner">JPEG, GIF 5MB max / image</div>
			<div class="bubble-right"></div>
		""" % { 'dbName' : field.dbName, 
				'valueCode' : valueCode
		}

	elif field.sqlType.upper()[0:4] == "FLAG":
		label = field.sqlType[5:-1].strip('"').strip("'")
		attributeCode += """<input type="checkbox" name="%(dbName)s" id="%(dbName)s" value="O" <?= ($%(structureObName)s->%(dbName)s == "O")?("checked"):("")?> /> &nbsp; %(label)s
		""" % { 'dbName' : field.dbName, 
				'label': label.strip(), 
				'structureObName' : self.obName.lower(), }
		
	elif field.sqlType.upper()[0:4] == "ENUM":
		attributeCode += """<select name="%(dbName)s" id="%(dbName)s" class="styledselect_form_1">""" % { 'dbName' : field.dbName }
		enumTypes = field.sqlType[5:-1]
		for enum in enumTypes.split(','):
			valueAndText = enum.replace('"','').replace("'","").split(':')
			attributeCode += """<option value="%(value)s" <?= ($%(structureObName)s->%(dbName)s == "%(value)s")?("selected"):("")?> >%(text)s</option>""" % {'value': valueAndText[0].strip(), 
				'text': valueAndText[1].strip(), 
				'structureObName' : self.obName.lower(),
				'dbName' : field.dbName }
		attributeCode += "</select>"

	else:
		# for string, int, ...
		attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" class="%(cssClass)s" value="%(valueCode)s" """ % { 'dbName' : field.dbName, 
					'cssClass' : cssClass, 
					'valueCode' : valueCode}
		if field.getAttribute("check") and field.getAttribute("check") != "" :
			attributeCode += """onblur="checkField(this,%(regexp)s)" """ % {'regexp' : field.getAttribute("check")}
			attributeCode += """><div id="%(dbName)sMessage" style="display:none;float: right;">
				<div class="bubble-left"></div>
				<div class="bubble-inner">Erreur de saisie sur ce champ</div>
				<div class="bubble-right"></div>
			</div>""" % {'dbName' : field.dbName}
		else:
			attributeCode += ">"
			
	attributeCode += """
		</td>
	</tr>"""


	# ajouter le nouvel attribut, avec indentation si ce n'est pas le premier
	if allAttributesCode != "":
		allAttributesCode += "\n\t" 
	allAttributesCode += attributeCode

RETURN =  allAttributesCode
%%
		<tr>
			<td></td>
			<td>
				<input type="submit" value="" class="form-submit" />
				<input type="button" value="" class="form-retour"
					onclick="document.location.href='<?=base_url()?>index.php/list%%(self.obName.lower())%%s';return false;" />
			</td>
		</tr>
	</table>
%%
jsCode = ""
hasDate = False
for field in self.fields:
	if field.sqlType.upper() == "DATE":
		hasDate = True
		if jsCode == "":
			jsCode = """<script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
"""
		jsCode += """	cal.manageFields("btn_%(dbName)s", "%(dbName)s", "%(dateFormat)s");
""" % { 'dbName' : field.dbName, 'dateFormat' : '%d/%m/%Y' }

if hasDate:
	jsCode += """
    //]]></script>"""
RETURN = jsCode
%%
<?
echo form_close('');
?>

</div>


	