#!/usr/bin/env python

from xml.dom.minidom import *

class Field:
	def __init__(self, dbName= "", obName = "", isKey = False):
		self.dbName = dbName
		self.obName = obName
		self.isKey = isKey
		self.nullable = True
		self.sqlType = "no_type"
		self.description = "";
		self.autoincrement = False
	
	def sysout(self):
		if self.isKey :
			print " > %s : %s" % (self.dbName, self.obName)
		else :
			print " - %s : %s" % (self.dbName, self.obName)
			
		
class CIObject:
	def __init__(self, dbTableName = "", obName = ""):
		self.dbTableName = dbTableName
		self.obName = obName
		self.description = ""
		self.fields = []
		self.keyFields = []
		self.nonKeyFields = []

	def fromXML(self, aFilename):
		doc = parse(aFilename)
		objectDef = doc.getElementsByTagName("object")[0]
		self.dbTableName = objectDef.getAttribute("shortName")
		self.obName = objectDef.getAttribute("name")
		descriptionDef = objectDef.getElementsByTagName("description")[0]
		self.description = descriptionDef.firstChild.data

		for attributeTag in objectDef.getElementsByTagName("attribute"):
			aField = Field()
			aField.dbName = attributeTag.getAttribute("id")
			aField.obName = attributeTag.getAttribute("name")
			aField.sqlType = attributeTag.getAttribute("type")
			if attributeTag.getAttribute("nullable") != "":
				aField.nullable = (attributeTag.getAttribute("nullable") == "YES")
			if attributeTag.getAttribute("isKey") != "":
				aField.isKey = (attributeTag.getAttribute("isKey") == "YES")
			if attributeTag.getAttribute("autoincrement") != "":
				aField.autoincrement = (attributeTag.getAttribute("autoincrement") == "YES")

			descriptionDef = attributeTag.getElementsByTagName("description")[0]
			aField.description = descriptionDef.firstChild.data
			self.addFieldObject(aField)
			
		
	def addFieldObject(self, aField):
		self.fields.append(aField)
		if aField.isKey :
			self.keyFields.append(aField)
		else :
			self.nonKeyFields.append(aField)

	def addField(self, dbName, obName, isKey = False):
		self.addFieldObject(Field(dbName, obName, isKey ))
		
	def sysout(self):
		print "%s (%s):" % (self.obName, self.dbTableName)
		for field in self.keyFields:
			field.sysout()
		for field in self.nonKeyFields:
			field.sysout()			
		
	""" replace de maniere generique le texte template avec les donnees de la structure d'objet
	"""	
	def dbAndObVariablesList(self, template, dbName, obName, indent=1, includesKey=True):
		variables = ""
		if includesKey :
			variables = template.replace("(%s)s" % dbName, self.keyFields[0].dbName)
			variables = variables.replace("(%s)s" % obName, self.keyFields[0].obName)
	
		prefix = ", "
		if indent > 0 :
			prefix = "\n" + ("\t"*indent)
			 
		for variable in self.nonKeyFields:
			variableDeclaration = "";
		
			variableDeclaration = template.replace("(%s)s" % dbName, variable.dbName)
			variableDeclaration = variableDeclaration.replace("(%s)s" % obName, variable.obName)
	
			if variables != "" :
				variables += prefix
			variables += variableDeclaration
		return variables
	

	def createSQLTableScript(self, databaseName):
		content = "CREATE TABLE `%(databaseName)s`.`%(object)s` (\n" % { 'databaseName': databaseName, 'object' : self.dbTableName }
		allAttributesCode = ""

		for field in self.fields:
			if allAttributesCode != "":
				allAttributesCode += ", \n"

			attributeCode = "\t`%(dbName)s` %(sqlType)s " % { 'dbName' : field.dbName,
				  'sqlType' : field.sqlType
				}
			if not field.nullable:
				attributeCode += "NOT NULL "
			if field.autoincrement:
				attributeCode += "AUTO_INCREMENT "
			if field.isKey:
				attributeCode += "PRIMARY KEY "
			attributeCode += "COMMENT '%(desc)s'" % { 'desc' : field.description }
			allAttributesCode += attributeCode

		content += allAttributesCode + "\n);\n"
		return content


	def dbVariablesList(self, template, variableName, typeName="", descrName="", indent=1, includesKey=True, suffix=""):
		variables = ""
		variableDeclaration = template
		if includesKey :
			variableDeclaration = variableDeclaration.replace("(%s)s" % variableName, self.keyFields[0].dbName)
			if typeName != "":
				variableDeclaration = variableDeclaration.replace("(%s)s" % typeName, self.keyFields[0].sqlType)
			if descrName != "" :
				description = self.keyFields[0].description.replace("'", "\\'");
				variableDeclaration = variableDeclaration.replace("(%s)s" % descrName, description)
			variables += variableDeclaration + suffix
	
		prefix = ", "
		if indent > 0 :
			prefix = "\n" + ("\t"*indent)
			 
		for variable in self.nonKeyFields:
			if variables != "":
				variables += prefix
			variableDeclaration = template;
			variableDeclaration = variableDeclaration.replace("(%s)s" % variableName, variable.dbName)
			if typeName != "":
				variableDeclaration = variableDeclaration.replace("(%s)s" % typeName, variable.sqlType)
			if descrName != "" :
				description = variable.description.replace("'", "\\'");
				variableDeclaration = variableDeclaration.replace("(%s)s" % descrName, description)

			variables += variableDeclaration + suffix

		# suppression du dernier suffixe
		variables = variables[:len(variables)-len(suffix)]
		return variables


	def listOfVariablesForEditing(self):
		allAttributesCode = ""

		for field in self.fields:
			attributeCode = ""
			if field.autoincrement:
				attributeCode += "<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE\n"
			attributeCode += """<tr><td><label title="%(desc)s" for="%(obName)s">""" % { 'obName' : field.obName, 'desc' : field.description }

			if not field.nullable:
				attributeCode += "* "

			attributeCode += """%(obName)s</label> : </td><td>""" % { 'obName' : field.obName }
			if field.isKey:
				attributeCode += """<input type="hidden" id="%(obName)s" value="<?= $%(structureObName)s->%(dbName)s ?>" """ % { 'obName' : field.obName, 'dbName' : field.dbName, 'structureObName' : self.obName.lower() }
			else:
				if field.sqlType.upper() == "DATE":
					attributeCode += """<input type="text" name="%(obName)s" id="%(obName)s" value="<?= $%(structureObName)s->%(dbName)s ?>" size="8" maxlength="10"> <span id="btn_%(obName)s" class="ss_sprite ss_calendar">&nbsp;</span>""" % { 'obName' : field.obName, 'dbName' : field.dbName, 'structureObName' : self.obName.lower() }
				else:
					attributeCode += """<input type="text" name="%(obName)s" id="%(obName)s" value="<?= $%(structureObName)s->%(dbName)s ?>" >""" % { 'obName' : field.obName, 'dbName' : field.dbName, 'structureObName' : self.obName.lower() }

			attributeCode += """</td></tr>"""

			if field.autoincrement:
				attributeCode += "\n-->"

			# ajouter le nouvel attribut, avec indentation si ce n'est pas le premier
			if allAttributesCode != "":
				allAttributesCode += "\n\t\t" 
			allAttributesCode += attributeCode


		return allAttributesCode 


	def javascriptCodeForControls(self):
		jsCode = ""
		for field in self.fields:
			if field.sqlType.upper() == "DATE":
				if jsCode == "":
					jsCode = """<script type="text/javascript">//<![CDATA[
      var cal = Calendar.setup({
          onSelect: function(cal) { cal.hide() },
          showTime: false
      });
"""
				jsCode += """	cal.manageFields("btn_%(obName)s", "%(obName)s", "%%d/%%m/%%Y");
""" % { 'obName' : field.obName }

		jsCode += """
    //]]></script>"""
		return jsCode


	def listOfVariablesForViewExtraction(self, includesKey):
		return self.dbAndObVariablesList("$model->(dbVar)s = $this->input->post('(obVar)s'); ", 'dbVar', 'obVar', 2, includesKey)

	def listOfVariablesForAdding(self):
		allAttributesCode = ""

		for field in self.fields:
			attributeCode = ""
			if field.autoincrement:
				attributeCode = "<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE\n"
			attributeCode += """<tr><td><label title="%(desc)s" for="%(obName)s">""" % { 'obName' : field.obName, 'desc' : field.description }

			if not field.nullable:
				attributeCode += "* "

			attributeCode += """%(obName)s</label> : </td><td>""" % { 'obName' : field.obName }

			if field.sqlType.upper() == "DATE":
				attributeCode += """<input type="text" name="%(obName)s" id="%(obName)s" size="8" maxlength="10"> <span id="btn_%(obName)s" class="ss_sprite ss_calendar">&nbsp;</span>""" % { 'obName' : field.obName }
			else:
				attributeCode += """<input type="text" name="%(obName)s" id="%(obName)s" >""" % { 'obName' : field.obName }

			attributeCode += """</td></tr>"""

			if field.autoincrement:
				attributeCode += "\n-->"

			# ajouter le nouel attribut, avec indentation si ce n'est pas le premier
			if allAttributesCode != "":
				allAttributesCode += "\n\t\t" 
			allAttributesCode += attributeCode

		return allAttributesCode
		
	def listOfVariablesForTableHeader(self):
		return self.dbAndObVariablesList("<th>(obVar)s</th>", 'dbVar', 'obVar', 3, True)

	def listOfVariablesForTableBody(self):
		return self.dbAndObVariablesList( ("<td valign=\"top\"><?=$%s->(dbVar)s?></td> " % self.obName.lower()), 'dbVar', 'obVar', 3, False) 

	def listOfVariablesForMethodSave(self):
		allAttributesCode = ""
		for field in self.fields:
			attributeCode = ""
			if not field.autoincrement :
				if field.sqlType.upper() == "DATE":
					attributeCode = "toSQLDate($this->%(dbName)s)" % { 'dbName' : field.dbName }
				else:
					attributeCode = "$this->%(dbName)s" % { 'dbName' : field.dbName }
			if allAttributesCode != "":
				allAttributesCode += ", "
			allAttributesCode += attributeCode
		return allAttributesCode
		

	def listOfVariablesForMethodUpdate(self):
		allAttributesCode = ""
		for field in self.fields:
			attributeCode = ""
			if field.sqlType.upper() == "DATE":
				attributeCode = "toSQLDate($this->%(dbName)s)" % { 'dbName' : field.dbName }
			else:
				attributeCode = "$this->%(dbName)s" % { 'dbName' : field.dbName }
			if allAttributesCode != "":
				allAttributesCode += ", "
			allAttributesCode += attributeCode
		return allAttributesCode

	def rowExtraction(self):
		allAttributesCode = ""
		for field in self.fields:
			attributeCode = ""
			if field.sqlType.upper() == "DATE":
				attributeCode = "$model->%(dbName)s = fromSQLDate($row['%(dbName)s']);" % { 'dbName' : field.dbName }
			else:
				attributeCode = "$model->%(dbName)s = $row['%(dbName)s'];" % { 'dbName' : field.dbName }
			if allAttributesCode != "":
				allAttributesCode += "\n\t\t"
			allAttributesCode += attributeCode
		return allAttributesCode
		#return self.dbVariablesList("$model->(var)s = $row['(var)s'];", 'var',  '', '', 2)

	def listOfVariablesForDeclaration(self):
		return self.dbVariablesList("var $(instVar)s;", 'instVar',  '', '', 1)

	def listOfFieldsForInsert(self):
		includesAutoIncrement = False
		for field in self.keyFields:
			if field.autoincrement and not includesAutoIncrement:
				includesAutoIncrement = True
		return self.dbVariablesList("'(var)s'=>$(var)s", 'var',  '', '', 0, not includesAutoIncrement)

	def listOfFieldsForUpdate(self):
		return self.dbVariablesList("(var)s = ?", 'var',  '', '', 0, False)

	def listOfFieldsForMethodInsert(self):
		includesAutoIncrement = False
		for field in self.keyFields:
			if field.autoincrement and not includesAutoIncrement:
				includesAutoIncrement = True
		return self.dbVariablesList("$(var)s", 'var',  '', '', 0, not includesAutoIncrement)

	def listOfFieldsForMethodUpdate(self):
		return self.dbVariablesList("$(var)s", 'var',  '', '', 0, False)

	def listOfFieldsForSQL(self):
		return self.dbVariablesList("(var)s", 'var',  '', '', 0, False)




			
