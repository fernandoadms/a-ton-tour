#!/usr/bin/env python
# coding: utf-8


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
import os

class Field:
	def __init__(self, dbName= "", obName = "", isKey = False):
		self.dbName = dbName
		self.obName = obName
		self.isKey = isKey
		self.nullable = True
		self.sqlType = "no_type"
		self.description = "";
		self.autoincrement = False
		self.referencedObject = None
		self.display = None
		self.node = None
	
	def sysout(self):
		if self.isKey :
			print (" > %s : %s" % (self.dbName, self.obName))
		else :
			print (" - %s : %s" % (self.dbName, self.obName))
		
	def getAttribute(this, attrName):
		return this.node.getAttribute(attrName)
		
class CIObject:
	def __init__(self, dbTableName = "", obName = ""):
		self.dbTableName = dbTableName
		self.obName = obName
		self.displayName = ""
		self.description = ""
		self.isCrossTable = False
		self.fields = []
		self.keyFields = []
		self.nonKeyFields = []

	def fromXML(self, aFilename):
		doc = parse(aFilename)
		objectDef = doc.getElementsByTagName("object")[0]
		self.dbTableName = objectDef.getAttribute("shortName")
		self.displayName = objectDef.getAttribute("displayName")
		self.obName = objectDef.getAttribute("obName")
		if objectDef.getAttribute("isCrossTable") :
			if objectDef.getAttribute("isCrossTable").upper() == "TRUE" or objectDef.getAttribute("isCrossTable").upper() == "YES":
				self.isCrossTable = True
		descriptionDef = objectDef.getElementsByTagName("description")[0]
		self.description = descriptionDef.firstChild.data

		# stockage des objets référencés pour ne pas avoir à les charger en boucle
		allSubStructure = {}
		allSubStructure[self.obName] = self
		for attributeTag in objectDef.getElementsByTagName("attribute"):
			aField = Field()
			aField.dbName = attributeTag.getAttribute("id")
			aField.obName = attributeTag.getAttribute("name")
			if attributeTag.getAttribute("type") != "":
				aField.sqlType = attributeTag.getAttribute("type")
			if attributeTag.getAttribute("nullable") != "":
				aField.nullable = (attributeTag.getAttribute("nullable") == "YES")
			if attributeTag.getAttribute("isKey") != "":
				aField.isKey = (attributeTag.getAttribute("isKey") == "YES")
			if attributeTag.getAttribute("autoincrement") != "":
				aField.autoincrement = (attributeTag.getAttribute("autoincrement") == "YES")
			if attributeTag.getAttribute("referencedObject") != "":
				#print("... Finding %s" % attributeTag.getAttribute("referencedObject"))
				if attributeTag.getAttribute("referencedObject") not in allSubStructure:
					subStructure = CIObject()
					filePath = os.path.dirname(aFilename)
					subStructure.fromXML(os.path.join(filePath, attributeTag.getAttribute("referencedObject") + ".xml"))
					allSubStructure[attributeTag.getAttribute("referencedObject")] = subStructure
				aField.referencedObject = allSubStructure[attributeTag.getAttribute("referencedObject")]
				#print("...... key: %s" % aField.referencedObject.keyFields[0].dbName)

			if attributeTag.getAttribute("display") != "":
				aField.display = attributeTag.getAttribute("display")
				
			# ajout de tous les attributs
			aField.node = attributeTag

			descriptionDef = attributeTag.getElementsByTagName("description")[0]
			if descriptionDef.firstChild :
				aField.description = descriptionDef.firstChild.data
			else:
				aField.description = ""
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
		print ("%s (%s):" % (self.obName, self.dbTableName))
		for field in self.keyFields:
			field.sysout()
		for field in self.nonKeyFields:
			field.sysout()			
		
	""" replace de maniere generique le texte template avec les donnees de la structure d'objet
	"""
	def dbAndObVariablesList(self, template, dbName, obName, indent=1, includesKey=True):
		variables = ""
		if includesKey :
			for variable in self.keyFields:
				variableDeclaration = ""
				variableDeclaration = template.replace("(%s)s" % dbName, variable.dbName)
				variableDeclaration = variableDeclaration.replace("(%s)s" % obName, variable.obName)
				variables += variableDeclaration
		prefix = ", "
		if indent > 0 :
			prefix = "\n" + ("\t"*indent)
			 
		for variable in self.nonKeyFields:
			variableDeclaration = ""
		
			variableDeclaration = template.replace("(%s)s" % dbName, variable.dbName)
			variableDeclaration = variableDeclaration.replace("(%s)s" % obName, variable.obName)
	
			if variables != "" :
				variables += prefix
			variables += variableDeclaration
		return variables


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
				variableDeclaration = template
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
			variableDeclaration = template
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

