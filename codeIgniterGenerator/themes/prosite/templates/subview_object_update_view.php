%[kind : subViews]
%[file : %%(self.obName.lower())%%_update_view.php]
%[path : views/subviews]
<?php
?>

<!-- Edition d'un objet -->
<fieldset>
	<legend><a name="new"></a>Editer un %%(self.obName)%%</legend>

<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('%%(self.keyFields[0].dbName)%%' => $%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%);
echo form_open_multipart('edit%%(self.obName.lower())%%/save', $attributes_info, $fields_info );
?>
	<table>
		%%
allAttributesCode = ""

for field in self.fields:
	attributeCode = ""
	attributeCode += """<tr>
			<td nowrap><label title="%(desc)s" for="%(dbName)s">""" % { 'dbName' : field.dbName, 'desc' : field.description }

	if not field.nullable:
		attributeCode += "* "

	attributeCode += """%(obName)s</label> : &nbsp; </td>
		<td>""" % { 'obName' : field.obName }
	if field.isKey:
		attributeCode += """<input type="hidden" id="%(dbName)s" value="<?= $%(structureObName)s->%(dbName)s ?>" """ % { 'dbName' : field.dbName, 'structureObName' : self.obName.lower() }
	else:
		if field.referencedObject:
			attributeCode += """<select name="%(dbName)s" id="%(dbName)s"> """ % { 'dbName' : field.dbName }
			if field.nullable:
				attributeCode += """<option value=""></option>"""
			attributeCode += """
						<?php foreach ($%(referencedObject)sCollection as $%(referencedObject)s): ?>
						<option value="<?= $%(referencedObject)s->%(keyReference)s ?>" <?= ($%(referencedObject)s->%(keyReference)s == $%(structureObName)s->%(dbName)s)?("selected"):("")?>><?= $%(referencedObject)s->%(display)s ?> </option>
						<?php endforeach;?>
					</select>
			""" % { 'display' : field.display, 
					'keyReference' : field.referencedObject.keyFields[0].dbName, 
					'referencedObject' : field.referencedObject.obName.lower(), 
					'structureObName' : self.obName.lower(),
					'dbName' : field.dbName }
					
		elif field.sqlType.upper() == "DATE":
			attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" value="<?= $%(structureObName)s->%(dbName)s ?>" size="8" maxlength="10"> <span id="btn_%(dbName)s" class="ss_sprite ss_calendar">&nbsp;</span> """ % { 'dbName' : field.dbName, 'structureObName' : self.obName.lower() }
		elif field.sqlType.upper() == "TEXT":
			attributeCode += """<textarea name="%(dbName)s" id="%(dbName)s"><?= $%(structureObName)s->%(dbName)s ?></textarea>""" % { 'dbName' : field.dbName, 'structureObName' : self.obName.lower() }
		else:
			attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" value="<?= $%(structureObName)s->%(dbName)s ?>" >""" % { 'dbName' : field.dbName, 'structureObName' : self.obName.lower() }

	attributeCode += """</td>
		</tr>"""

	if field.autoincrement:
		attributeCode = "<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE - " + attributeCode + " -->"

	# ajouter le nouvel attribut, avec indentation si ce n'est pas le premier
	if allAttributesCode != "":
		allAttributesCode += "\n\t\t" 
	allAttributesCode += attributeCode


RETURN = allAttributesCode 
%%
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['EditForm'].sumbit()" class="form-submit">
					Enregistrer
				</button>
				<button onclick="document.location.href='<?=base_url()?>index.php/list%%(self.obName.lower())%%s';return false;" class="form-back">
					Retour
				</button>
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
		jsCode += """	cal.manageFields("btn_%(dbName)s", "%(dbName)s", "%"+"%d/%"+"%m/%"+"%Y");
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
<!-- /Edition d'un objet -->

	