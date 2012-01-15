%[kind : subViews]
%[file : %%(self.obName.lower())%%_new_view.php]
%[path : views/subviews]
<?php
?>

<!-- Ajouter un item -->
<fieldset>
	<legend><a name="new"></a><img src="<?=base_url()?>www/img/plus_16.png"> Ajouter un %%%%(self.obName)%%</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('list%%(self.obName.lower())%%s/add', $attributes_info, $fields_info );
?>
	<table>
		%%
allAttributesCode = ""

for field in self.fields:
	attributeCode = ""
	if field.autoincrement:
		attributeCode = "<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE\n"
	attributeCode += """<tr><td nowrap><label title="%(desc)s" for="%(dbName)s">""" % { 'dbName' : field.dbName, 'desc' : field.description }

	if not field.nullable:
		attributeCode += "* "

	attributeCode += """%(obName)s :</label> </td>
		<td>
			""" % { 'obName' : field.obName }

	if field.sqlType.upper() == "DATE":
		attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" size="8" maxlength="10"> <span id="btn_%(dbName)s" class="calendar">&nbsp;</span>""" % { 'dbName' : field.dbName }
	elif field.sqlType.upper() == "TEXT":
		attributeCode += """<textarea name="%(dbName)s" id="%(dbName)s" class="editor_detail"></textarea>""" % { 'dbName' : field.dbName }
	else:
		attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" >""" % { 'dbName' : field.dbName }

	attributeCode += """
		</td>
	</tr>"""

	if field.autoincrement:
		attributeCode += "\n-->"

	# ajouter le nouvel attribut, avec indentation si ce n'est pas le premier
	if allAttributesCode != "":
		allAttributesCode += "\n\t\t" 
	allAttributesCode += attributeCode

RETURN =  allAttributesCode
%%
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['AddForm'].sumbit()" class="form-submit">Ajouter</button>
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
		jsCode += """	cal.manageFields("btn_%(dbName)s", "%(dbName)s", "%%d/%%m/%%Y");
""" % { 'dbName' : field.dbName }

if hasDate:
	jsCode += """
    //]]></script>"""
RETURN = jsCode
%%

<?
echo form_close('');
?>
</fieldset>
<!-- /Ajouter un item  -->

