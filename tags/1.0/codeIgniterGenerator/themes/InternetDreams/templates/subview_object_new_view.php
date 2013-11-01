%[kind : subViews]
%[file : %%(self.obName.lower())%%_new_view.php]
%[path : views/subviews]
<?php
?>

<!-- Ajouter un item -->


	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Ajouter un %%(self.displayName.lower())%%</h1>
	</div>
	<!-- end page-heading -->
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="<?=base_url()?>www/images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="<?=base_url()?>www/images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('list%%(self.obName.lower())%%s/add', $attributes_info, $fields_info );
?>
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<!-- list of variables - auto-generated : -->
%%allAttributesCode = ""

for field in self.fields:
	attributeCode = ""
	if field.autoincrement:
		## ne pas presenter les champs auto-increment
		attributeCode = "<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE -->"
		continue
		
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
					<?php foreach ($%(referencedObject)sCollection as $%(referencedObject)s): ?>
					<option value="<?= $%(referencedObject)s->%(keyReference)s ?>"><?= $%(referencedObject)s->%(display)s ?> </option>
					<?php endforeach;?>
				</select>
		""" % { 'display' : field.display, 
				'keyReference' : field.referencedObject.keyFields[0].dbName, 
				'referencedObject' : field.referencedObject.obName.lower() }
				
	elif field.sqlType.upper()[0:4] == "DATE":
		attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" size="8" maxlength="10" class="%(cssClass)s"> <img src="<?=base_url()?>www/images/forms/icon_calendar.jpg" alt="" id="btn_%(dbName)s">""" % { 'dbName' : field.dbName, 'cssClass' : cssClass}
		
	elif field.sqlType.upper()[0:8] == "PASSWORD":
		attributeCode += """<input type="password" name="%(dbName)s" id="%(dbName)s" class="%(cssClass)s">""" % { 'dbName' : field.dbName, 'cssClass' : cssClass}
		
	elif field.sqlType.upper()[0:4] == "TEXT":
		attributeCode += """<textarea name="%(dbName)s" id="%(dbName)s" class="form-textarea"></textarea>""" % { 'dbName' : field.dbName }
		
	elif field.sqlType.upper()[0:4] == "FILE":
		attributeCode += """<input type="file" class="file_1" name="%(dbName)s_file" id="%(dbName)s_file">
		</td>
		<td>
			<div class="bubble-left"></div>
			<div class="bubble-inner">2Mo max / fichier</div>
			<div class="bubble-right"></div>
		""" % { 'dbName' : field.dbName}

	elif field.sqlType.upper()[0:4] == "FLAG":
		label = field.sqlType[5:-1].replace('"','').replace("'","")
		attributeCode += """<input type="checkbox" name="%(dbName)s" id="%(dbName)s" value="O"/> &nbsp; %(label)s""" % { 'dbName' : field.dbName, 'label': label.strip() }
		
	elif field.sqlType.upper()[0:4] == "ENUM":
		attributeCode += """<select name="%(dbName)s" id="%(dbName)s" class="styledselect_form_1">""" % { 'dbName' : field.dbName }
		enumTypes = field.sqlType[5:-1]
		for enum in enumTypes.split(','):
			valueAndText = enum.replace('"','').replace("'","").split(':')
			attributeCode += """<option value="%(value)s">%(text)s</option>""" % {'value': valueAndText[0].strip(), 'text': valueAndText[1].strip()}
		attributeCode += "</select>"

	else:
		attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" class="%(cssClass)s" """ % { 'dbName' : field.dbName, 'cssClass' : cssClass}
		if field.getAttribute("check") :
			attributeCode += """onblur="checkField(this,%(regexp)s)" """ % {'regexp' : field.getAttribute("check")}
			attributeCode += """><div id="%(dbName)sMessage" style="display:none;float: right;">
				<div class="error-left"></div>
				<div class="error-inner"><img src="<?=base_url()?>www/images/glyphs/close.png" align="absmiddle"> &nbsp; Erreur de format</div>
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

RETURN = allAttributesCode
%%
		<tr>
			<td></td>
			<td>
				<input type="submit" value="" class="form-submit" />
			</td>
		</tr>
	</table>
	%%jsCode = ""
hasDate = False
for field in self.fields:
	if field.sqlType.upper()[0:4] == "DATE":
		hasDate = True
		if jsCode == "":
			jsCode = """<script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide(); },
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
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>

<!-- /Ajouter un item  -->

