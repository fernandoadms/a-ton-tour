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
# reference au package parent
from ..objects import *

class WriterObject(CIObject):
	def __init__(self, dbTableName = "", obName = ""):
		# call to super()
		CIObject.__init__(self, dbTableName, obName)

	## VUE
	""" Champs pour la vue en édition :
	<tr><td><label title="description" for="dbName">obName</label> : </td>
	    <td><input type="text" name="dbName" id="dbName" value="<?= structureObName->dbName ?>">
	</tr>
	"""
	def listOfVariablesForEditing(self):
		return CIObject.listOfVariablesForEditing(self)

	""" Champs pour la vue en création :
	<tr><td><label title="description" for="dbName">obName</label> : </td>
	    <td><input type="text" name="dbName" id="dbName" value="">
	</tr>
	"""
	def listOfVariablesForAdding(self):
		#return CIObject.listOfVariablesForAdding(self)
		allAttributesCode = ""

		for field in self.fields:
			attributeCode = ""
			if field.autoincrement:
				attributeCode = "<!-- AUTO_INCREMENT : DO NOT DISPLAY THIS ATTRIBUTE\n"
			attributeCode += """<tr><td nowrap><label title="%(desc)s" for="%(dbName)s">""" % { 'dbName' : field.dbName, 'desc' : field.description }

			if not field.nullable:
				attributeCode += "* "

			attributeCode += """%(obName)s :</label> </td>
			<td>""" % { 'obName' : field.obName }

			if field.sqlType.upper() == "DATE":
				attributeCode += """<input type="text" name="%(dbName)s" id="%(dbName)s" size="8" maxlength="10"> <span id="btn_%(dbName)s" class="calendar">&nbsp;</span>""" % { 'dbName' : field.dbName }
			elif field.sqlType.upper() == "TEXT":
				attributeCode += """<textarea name="%(dbName)s" id="%(dbName)s" class="editor_detail"></textarea>""" % { 'dbName' : field.dbName }
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



	""" Entete de tableau
	<th>(obVar)s</th>
	"""
	def listOfVariablesForTableHeader(self):
		#return CIObject.listOfVariablesForTableHeader(self)
		return self.dbAndObVariablesList("""<th>(obVar)s
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


	""" Contenu du tableau
	<td valign="top"><?= obName_lower->dbVar ?></td>
	"""
	def listOfVariablesForTableBody(self):
		return CIObject.listOfVariablesForTableBody(self)


	def javascriptCodeForControls(self):
		return CIObject.javascriptCodeForControls(self)

	## CONTROLEUR
	def listOfVariablesForViewExtraction(self, includesKey):
		return CIObject.listOfVariablesForViewExtraction(self, includesKey)


	## MODELE
	def listOfVariablesForMethodSave(self):
		return CIObject.listOfVariablesForMethodSave(self)

	def listOfVariablesForMethodUpdate(self):
		return CIObject.listOfVariablesForMethodUpdate(self)

	def rowExtraction(self):
		return CIObject.rowExtraction(self)

	def listOfVariablesForDeclaration(self):
		return CIObject.listOfVariablesForDeclaration(self)

	def listOfFieldsForInsert(self):
		return CIObject.listOfFieldsForInsert(self)

	def listOfFieldsForUpdate(self):
		return CIObject.listOfFieldsForUpdate(self)

	def listOfFieldsForMethodInsert(self):
		return CIObject.listOfFieldsForMethodInsert(self)

	def listOfFieldsForMethodUpdate(self):
		return CIObject.listOfFieldsForMethodUpdate(self)

	def listOfFieldsForSQL(self):
		return CIObject.listOfFieldsForSQL(self)

	## HELPER
	def helper_selectAll(self):
		return CIObject.helper_selectAll(self)

	def helper_listOfFieldsForMethodInsert(self):
		return CIObject.helper_listOfFieldsForMethodInsert(self)

	def helper_listOfFieldsForInsert(self):
		return CIObject.helper_listOfFieldsForInsert(self)

	def helper_listOfFieldsForMethodUpdate(self):
		return CIObject.helper_listOfFieldsForMethodUpdate(self)

	def helper_listOfFieldsForArrayValues(self):
		return CIObject.helper_listOfFieldsForArrayValues(self)

	def commentStart_crossTable(self):
		return CIObject.commentStart_crossTable(self)

	def commentStop_crossTable(self):
		return CIObject.commentStop_crossTable(self)







