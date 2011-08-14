#!/usr/bin/env python

"""
generate : produit des fichier php pour codeIgniter

Syntaxe:
./generate.py

"""

import sys, os, glob, string

from objects import *

def generateModel(modelsDirectory, structure):
	if not os.path.exists(modelsDirectory):
		os.makedirs(modelsDirectory)

	template_filename = os.path.join("templates","object_model.php")
	f = open(template_filename, 'r')
	rawContent = f.read()
	
	content = string.replace(rawContent,"%(Name)", structure.obName )
	content = string.replace(content,"%(name_lower)",  structure.obName.lower() )
	content = string.replace(content,"%(listOfVariablesForDeclaration)", structure.listOfVariablesForDeclaration() )
	content = string.replace(content,"%(rowExtraction)", structure.rowExtraction() )
	content = string.replace(content,"%(keyVariable)", structure.keyFields[0].dbName )
	content = string.replace(content,"%(listOfVariablesForMethodSave)", structure.listOfVariablesForMethodSave() )
	content = string.replace(content,"%(listOfVariablesForMethodUpdate)", structure.listOfVariablesForMethodUpdate() )

	filename = os.path.join(modelsDirectory, "%s_model.php" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()
	
def generateHelper(helpersDirectory, structure):
	if not os.path.exists(helpersDirectory):
		os.makedirs(helpersDirectory)

	template_filename = os.path.join("templates","object_helper.php")
	f = open(template_filename, 'r')
	rawContent = f.read()
	
	content = string.replace(rawContent,"%(Name)", structure.obName )
	content = string.replace(content,"%(tableName)", structure.dbTableName )
	content = string.replace(content,"%(keyVariable)", structure.keyFields[0].dbName )
	# forcer la consersion en int
	if structure.keyFields[0].sqlType == "int":
		content = string.replace(content,"%(intConversion)", "(int)" )
	else:
		content = string.replace(content,"%(intConversion)", "" )

	content = string.replace(content,"%(listOfFieldsForSQL)", structure.listOfFieldsForSQL() )
	content = string.replace(content,"%(listOfFieldsForMethodInsert)", structure.listOfFieldsForMethodInsert() )
	content = string.replace(content,"%(listOfFieldsForMethodUpdate)", structure.listOfFieldsForMethodUpdate() )
	content = string.replace(content,"%(listOfFieldsForUpdate)", structure.listOfFieldsForUpdate() )
	content = string.replace(content,"%(listOfFieldsForInsert)", structure.listOfFieldsForInsert() )

	filename = os.path.join(helpersDirectory, "%s_helper.php" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()

def generateControllerList(controllersDirectory, structure):
	if not os.path.exists(controllersDirectory):
		os.makedirs(controllersDirectory)

	template_filename = os.path.join("templates","listobjects.php")
	f = open(template_filename, 'r')
	rawContent = f.read()

	content = string.replace(rawContent,"%(Name)", structure.obName )
	content = string.replace(content,"%(name_lower)",  structure.obName.lower() )
	content = string.replace(content,"%(keyVariable)", structure.keyFields[0].dbName )
	content = string.replace(content,"%(listOfVariablesForViewExtraction)", structure.listOfVariablesForViewExtraction(True) )

	filename = os.path.join(controllersDirectory, "list%ss.php" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()

def generateViewList(viewsDirectory, structure):
	if not os.path.exists(viewsDirectory):
		os.makedirs(viewsDirectory)

	template_filename = os.path.join("templates","listobjects_view.php")
	f = open(template_filename, 'r')
	rawContent = f.read()

	content = string.replace(rawContent,"%(Name)", structure.obName )
	content = string.replace(content,"%(name_lower)",  structure.obName.lower() )
	content = string.replace(content,"%(keyVariable)", structure.keyFields[0].dbName )
	content = string.replace(content,"%(listOfVariablesForTableBody)", structure.listOfVariablesForTableBody() )
	content = string.replace(content,"%(listOfVariablesForTableHeader)", structure.listOfVariablesForTableHeader() )
	content = string.replace(content,"%(listOfVariablesForAdding)", structure.listOfVariablesForAdding() )
	content = string.replace(content,"%(javascriptCodeForControls)", structure.javascriptCodeForControls() )

	filename = os.path.join(viewsDirectory, "list%ss_view.php" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()

def generateControllerEdit(controllersDirectory, structure):
	if not os.path.exists(controllersDirectory):
		os.makedirs(controllersDirectory)

	template_filename = os.path.join("templates","editobject.php")
	f = open(template_filename, 'r')
	rawContent = f.read()

	content = string.replace(rawContent,"%(Name)", structure.obName )
	content = string.replace(content,"%(name_lower)",  structure.obName.lower() )
	content = string.replace(content,"%(obNameKeyVariable)", structure.keyFields[0].obName )
	content = string.replace(content,"%(keyVariable)", structure.keyFields[0].dbName )
	content = string.replace(content,"%(listOfVariablesForViewExtraction)", structure.listOfVariablesForViewExtraction(False) )

	filename = os.path.join(controllersDirectory, "edit%s.php" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()

def generateViewEdit(viewsDirectory, structure):
	if not os.path.exists(viewsDirectory):
		os.makedirs(viewsDirectory)

	template_filename = os.path.join("templates","editobject_view.php")
	f = open(template_filename, 'r')
	rawContent = f.read()

	content = string.replace(rawContent,"%(Name)", structure.obName )
	content = string.replace(content,"%(name_lower)",  structure.obName.lower() )
	content = string.replace(content,"%(obNameKeyVariable)", structure.keyFields[0].obName )
	content = string.replace(content,"%(keyVariable)", structure.keyFields[0].dbName )
	content = string.replace(content,"%(listOfVariablesForEditing)", structure.listOfVariablesForEditing() )
	content = string.replace(content,"%(javascriptCodeForControls)", structure.javascriptCodeForControls() )


	filename = os.path.join(viewsDirectory, "edit%s_view.php" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()


def genrateSQL(sqlDirectory, databaseName, structure):
	if not os.path.exists(sqlDirectory):
		os.makedirs(sqlDirectory)

	content = structure.createSQLTableScript(databaseName)

	filename = os.path.join(sqlDirectory, "cretab%s.sql" % structure.obName.lower() )
	file = open(filename,'w')
	file.write(content.encode("utf-8"))
	file.close()



if __name__ == '__main__':	
	
	if len(sys.argv) < 3:
		print "Syntax : " + sys.argv[0] + " <databaseName> <fileObject0.xml> [fileObject1.xml]"
		sys.exit(1)
	databaseName = sys.argv[1]

	i = 2
	while i < len(sys.argv):
		aFilename = sys.argv[i]

		print "-Object : " + aFilename

		structure = CIObject()
		structure.fromXML(aFilename)
	
		CIRootFiles = "CI_application"
		generateModel(os.path.join(CIRootFiles,"models"), structure)

		generateHelper(os.path.join(CIRootFiles,"helpers"), structure)

		generateControllerList(os.path.join(CIRootFiles,"controllers"), structure)
		generateControllerEdit(os.path.join(CIRootFiles,"controllers"), structure)

		generateViewList(os.path.join(CIRootFiles,"views"), structure)
		generateViewEdit(os.path.join(CIRootFiles,"views"), structure)
		print "   CI objects generated in " + CIRootFiles
	
		SQLFiles = "sql"
		genrateSQL(SQLFiles, databaseName, structure )
		print "   SQL script generated in " + SQLFiles

		i += 1

	print "Done."
	sys.exit(0)




