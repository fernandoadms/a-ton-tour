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
		return CIObject.listOfVariablesForAdding(self)


	""" Entete de tableau
	<th>(obVar)s</th>
	"""
	def listOfVariablesForTableHeader(self):
		return CIObject.listOfVariablesForTableHeader(self)

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



