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


"""
generate : produit des fichier php pour codeIgniter

Syntaxe:
./generate.py

"""

import sys, os, glob, string, ConfigParser

from themes.objects import CIObject

def generateModel(theme, modelsDirectory, structure):
	if not os.path.exists(modelsDirectory):
		os.makedirs(modelsDirectory)

	template_filename = os.path.join("themes", theme, "templates","object_model.php")
	f = open(template_filename, 'r')
	rawContent = f.read()
	
	content = string.replace(rawContent,"%(Name)", unicode(structure.obName) )
	content = string.replace(content,"%(name_lower)",  unicode(structure.obName.lower()) )
	content = string.replace(content,"%(listOfVariablesForDeclaration)", unicode(structure.listOfVariablesForDeclaration()) )
	content = string.replace(content,"%(rowExtraction)", unicode(structure.rowExtraction()) )
	content = string.replace(content,"%(keyVariable)", unicode(structure.keyFields[0].dbName) )
	content = string.replace(content,"%(listOfVariablesForMethodSave)", unicode(structure.listOfVariablesForMethodSave()) )
	content = string.replace(content,"%(listOfVariablesForMethodUpdate)", unicode(structure.listOfVariablesForMethodUpdate()) )

	filename = os.path.join(modelsDirectory, "%s_model.php" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()
	
def generateHelper(theme, helpersDirectory, structure):
	if not os.path.exists(helpersDirectory):
		os.makedirs(helpersDirectory)

	template_filename = os.path.join("themes", theme, "templates","object_helper.php")
	f = open(template_filename, 'r')
	rawContent = f.read()
	
	content = string.replace(rawContent,"%(Name)", structure.obName )
	content = string.replace(content,"%(tableName)", structure.dbTableName )

	listOfFieldsForSelectAllSQL = unicode(structure.listOfKeys(fieldPrefix="", fieldSuffix = ", "))
	nextString = structure.dbVariablesList("(var)s", 'var',  '', '', 0, False)
	if listOfFieldsForSelectAllSQL != "":
		if nextString != "":
			listOfFieldsForSelectAllSQL += ", " + nextString
	else:
		listOfFieldsForSelectAllSQL = nextString
	content = string.replace(content,"%(listOfFieldsForSelectAllSQL)", listOfFieldsForSelectAllSQL )

	listOfKeys = unicode(structure.listOfKeys(fieldPrefix="$", fieldSuffix = ", "))
	content = string.replace(content,"%(keyVariable)", listOfKeys  )
	
	content = string.replace(content,"%(dollarKeyVariable)",  unicode(structure.listOfKeys(fieldPrefix="$", fieldSuffix = ", "))  )
	content = string.replace(content,"%(dollarKeyVariableWithIntConversion)",  unicode(structure.listOfKeys(fieldPrefix="$", fieldSuffix = ", ", withIntConversion=True)) )

	listOfFieldsForSQL = unicode(structure.listOfFieldsForSQL())
	if listOfFieldsForSQL != "" and listOfKeys != "" :
		listOfFieldsForSQL = listOfKeys + ", " +listOfFieldsForSQL

	content = string.replace(content,"%(listOfFieldsForSQL)", listOfFieldsForSQL )
	content = string.replace(content,"%(listOfFieldsForMethodInsert)", unicode(structure.listOfFieldsForMethodInsert()) )
	content = string.replace(content,"%(listOfFieldsForMethodUpdate)", unicode(structure.listOfFieldsForMethodUpdate()) )
	content = string.replace(content,"%(listOfFieldsForArrayUpdate)", unicode(structure.listOfFieldsForArrayUpdate()) )
	content = string.replace(content,"%(listOfFieldsForUpdate)", unicode(structure.listOfFieldsForUpdate()) )
	content = string.replace(content,"%(listOfFieldsForInsert)", unicode(structure.listOfFieldsForInsert()) )
	content = string.replace(content,"%(keyVariableEqualsX)", unicode(structure.keyVariableEqualsX()) )

	filename = os.path.join(helpersDirectory, "%s_helper.php" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()

def generateControllerList(theme, controllersDirectory, structure):
	if not os.path.exists(controllersDirectory):
		os.makedirs(controllersDirectory)

	template_filename = os.path.join("themes", theme, "templates","listobjects.php")
	f = open(template_filename, 'r')
	rawContent = f.read()

	content = string.replace(rawContent,"%(Name)", unicode(structure.obName) )
	content = string.replace(content,"%(name_lower)",  unicode(structure.obName.lower()) )
	content = string.replace(content,"%(keyVariable)", unicode(structure.keyFields[0].dbName) )
	content = string.replace(content,"%(listOfVariablesForViewExtraction)", unicode(structure.listOfVariablesForViewExtraction(True)) )

	filename = os.path.join(controllersDirectory, "list%ss.php" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()

def generateViewList(theme, viewsDirectory, structure):
	if not os.path.exists(viewsDirectory):
		os.makedirs(viewsDirectory)

	template_filename = os.path.join("themes", theme, "templates","listobjects_view.php")
	f = open(template_filename, 'r')
	rawContent = f.read()

	content = string.replace(rawContent,"%(Name)", unicode(structure.obName) )
	content = string.replace(content,"%(name_lower)",  unicode(structure.obName.lower()) )
	content = string.replace(content,"%(keyVariable)", unicode(structure.keyFields[0].dbName) )
	content = string.replace(content,"%(listOfVariablesForTableBody)", unicode(structure.listOfVariablesForTableBody()) )
	content = string.replace(content,"%(listOfVariablesForTableHeader)", unicode(structure.listOfVariablesForTableHeader()) )
	content = string.replace(content,"%(listOfVariablesForAdding)", unicode(structure.listOfVariablesForAdding()) )
	content = string.replace(content,"%(javascriptCodeForControls)", unicode(structure.javascriptCodeForControls()) )

	filename = os.path.join(viewsDirectory, "list%ss_view.php" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()

def generateControllerEdit(theme, controllersDirectory, structure):
	if not os.path.exists(controllersDirectory):
		os.makedirs(controllersDirectory)

	template_filename = os.path.join("themes", theme, "templates","editobject.php")
	f = open(template_filename, 'r')
	rawContent = f.read()

	content = string.replace(rawContent,"%(Name)", unicode(structure.obName) )
	content = string.replace(content,"%(name_lower)",  unicode(structure.obName.lower()) )
	content = string.replace(content,"%(obNameKeyVariable)", unicode(structure.keyFields[0].obName) )
	content = string.replace(content,"%(keyVariable)", unicode(structure.keyFields[0].dbName) )
	content = string.replace(content,"%(listOfVariablesForViewExtraction)", unicode(structure.listOfVariablesForViewExtraction(False)) )

	filename = os.path.join(controllersDirectory, "edit%s.php" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()

def generateViewEdit(theme, viewsDirectory, structure):
	if not os.path.exists(viewsDirectory):
		os.makedirs(viewsDirectory)

	template_filename = os.path.join("themes", theme, "templates","editobject_view.php")
	f = open(template_filename, 'r')
	rawContent = f.read()

	content = string.replace(rawContent,"%(Name)", unicode(structure.obName) )
	content = string.replace(content,"%(name_lower)", unicode(structure.obName.lower()) )
	content = string.replace(content,"%(obNameKeyVariable)", unicode(structure.keyFields[0].obName) )
	content = string.replace(content,"%(keyVariable)", unicode(structure.keyFields[0].dbName) )
	content = string.replace(content,"%(listOfVariablesForEditing)", unicode(structure.listOfVariablesForEditing()) )
	content = string.replace(content,"%(javascriptCodeForControls)", unicode(structure.javascriptCodeForControls()) )


	filename = os.path.join(viewsDirectory, "edit%s_view.php" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()


def genrateSQL(theme, sqlDirectory, databaseName, structure):
	if not os.path.exists(sqlDirectory):
		os.makedirs(sqlDirectory)

	content = structure.createSQLTableScript(databaseName)

	filename = os.path.join(sqlDirectory, "cretab%s.sql" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()



if __name__ == '__main__':	

	# lecture du fichier de config
	config = ConfigParser.ConfigParser()
	config.readfp(open('theme.cfg'))
	theme = config.get('global', 'theme')
	CIRootFiles = config.get('generation', 'outDirFor_Classes')
	SQLFiles = config.get('generation', 'outDirFor_SQL')
	databaseName = config.get('generation', 'database')

	#import du theme
	print "Using theme <"+ theme +">..."
	fullModuleName = "themes." + theme + ".writer"
	module = __import__(fullModuleName)
	themeModule = getattr( getattr(module,theme), "writer")

	
	if len(sys.argv) < 2:
		print "Syntax : " + sys.argv[0] + " <fileObject0.xml> [fileObject1.xml]"
		sys.exit(1)


	i = 1
	while i < len(sys.argv):
		aFilename = sys.argv[i]

		print "-Object : " + aFilename

		structure = themeModule.WriterObject()
		structure.fromXML(aFilename)
	
		generateModel(theme, os.path.join(CIRootFiles,"models"), structure)

		generateHelper(theme, os.path.join(CIRootFiles,"helpers"), structure)

		generateControllerList(theme, os.path.join(CIRootFiles,"controllers"), structure)
		generateControllerEdit(theme, os.path.join(CIRootFiles,"controllers"), structure)

		generateViewList(theme, os.path.join(CIRootFiles,"views"), structure)
		generateViewEdit(theme, os.path.join(CIRootFiles,"views"), structure)
		print "   CI objects generated in " + CIRootFiles
	

		genrateSQL(theme, SQLFiles, databaseName, structure )
		print "   SQL script generated in " + SQLFiles

		i += 1

	print "Done."
	sys.exit(0)




