#!/usr/bin/env python
# coding: latin-1


"""
Copyright (C) 2011 julien CORON - http://julien.coron.free.fr

-- Licence GPL --

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

"""

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
			attributeCode += "COMMENT '%(desc)s'" % { 'desc' : field.description.replace("'","\\'") }
			allAttributesCode += attributeCode

		content += allAttributesCode + "\n);\n"
		return content


	def dbVariablesList(self, template, variableName, typeName="", descrName="", indent=1, includesKey=True, suffix=""):
		prefix = ", "
		if indent > 0 :
			prefix = "\n" + ("\t"*indent)

		variables = ""
		variableDeclaration = template
		if includesKey :
			for field in self.keyFields:
				if variables != "":
					variables += prefix
				variableDeclaration = variableDeclaration.replace("(%s)s" % variableName, field.dbName)
				if typeName != "":
					variableDeclaration = variableDeclaration.replace("(%s)s" % typeName, field.sqlType)
				if descrName != "" :
					description = field.description
					variableDeclaration = variableDeclaration.replace("(%s)s" % descrName, description)
				variables += variableDeclaration + suffix
	
			 
		for variable in self.nonKeyFields:
			if variables != "":
				variables += prefix
			variableDeclaration = template;
			variableDeclaration = variableDeclaration.replace("(%s)s" % variableName, variable.dbName)
			if typeName != "":
				variableDeclaration = variableDeclaration.replace("(%s)s" % typeName, variable.sqlType)
			if descrName != "" :
				description = variable.description
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
			attributeCode += """<tr><td><label title="%(desc)s" for="%(dbName)s">""" % { 'dbName' : field.dbName, 'desc' : field.description }

			if not field.nullable:
				attributeCode += "* "

			attributeCode += """%(obName)s</label> : </td><td>""" % { 'obName' : field.obName }
			if field.isKey:
				attributeCode += """<input type="hidden" id="%(dbName)s" value="<?= $%(structureObName)s->%(dbName)s ?>" """ % { 'dbName' : field.dbName, 'structureObName' : self.obName.lower() }
			else:
				if field.sqlType.upper() == "DATE":
					attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" value="<?= $%(structureObName)s->%(dbName)s ?>" size="8" maxlength="10"> <span id="btn_%(dbName)s" class="ss_sprite ss_calendar">&nbsp;</span>""" % { 'dbName' : field.dbName, 'structureObName' : self.obName.lower() }
				else:
					attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" value="<?= $%(structureObName)s->%(dbName)s ?>" >""" % { 'dbName' : field.dbName, 'structureObName' : self.obName.lower() }

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
		return jsCode


	def listOfVariablesForViewExtraction(self, includesKey):
		return self.dbAndObVariablesList("$model->(dbVar)s = $this->input->post('(dbVar)s'); ", 'dbVar', 'obVar', 2, includesKey)

	def listOfVariablesForAdding(self):
		allAttributesCode = ""

		for field in self.fields:
			attributeCode = ""
			if field.autoincrement:
				attributeCode = "<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE\n"
			attributeCode += """<tr><td><label title="%(desc)s" for="%(dbName)s">""" % { 'dbName' : field.dbName, 'desc' : field.description }

			if not field.nullable:
				attributeCode += "* "

			attributeCode += """%(obName)s</label> : </td><td>""" % { 'obName' : field.obName }

			if field.sqlType.upper() == "DATE":
				attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" size="8" maxlength="10"> <span id="btn_%(dbName)s" class="ss_sprite ss_calendar">&nbsp;</span>""" % { 'dbName' : field.dbName }
			else:
				attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" >""" % { 'dbName' : field.dbName }

			attributeCode += """</td></tr>"""

			if field.autoincrement:
				attributeCode += "\n-->"

			# ajouter le nouvel attribut, avec indentation si ce n'est pas le premier
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

	def listOfVariablesForDeclaration(self):
		return self.dbVariablesList("""/**
\t* (descrVar)s
\t* @var (typeVar)s
\t*/
\tvar $(instVar)s;
""", 'instVar',  'typeVar', 'descrVar', 1)

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
		return self.dbVariablesList("$(var)s", 'var',  '', '', 0, True)

	def listOfFieldsForArrayUpdate(self):
		updateKeys = unicode(self.listOfKeys(fieldPrefix="$", fieldSuffix = ", ", withIntConversion=True))
		listOfFields = self.dbVariablesList("$(var)s", 'var',  '', '', 0, False)
		if listOfFields != "":
			if updateKeys != "":
				listOfFields = listOfFields + ", " + updateKeys
		else:
			listOfFields = updateKeys
		return listOfFields

	def listOfFieldsForSQL(self):
		return self.dbVariablesList("(var)s", 'var',  '', '', 0, False)

	def keyVariableEqualsX(self):
		return self.listOfKeys(fieldPrefix="", fieldSuffix = "=? and ",withIntConversion=False) + "=?"

	def listOfKeys(self, fieldPrefix = "", fieldSuffix = "", withIntConversion = False):
		resultString = ""
		for field in self.keyFields:
			if field.sqlType == "int" and withIntConversion:
				resultString += ("(int)"+fieldPrefix + field.dbName + fieldSuffix)
			else:
				resultString += (fieldPrefix+ field.dbName + fieldSuffix)

		if len(fieldSuffix) > 0:
			suffixLength = 0 - len(fieldSuffix)
			return resultString[:suffixLength]
		else:
			return resultString





