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


"""
generate : produit des fichier php pour codeIgniter

Syntaxe:
./generate.py

"""

import sys, os, glob, string, ConfigParser, re, codecs
from code import InteractiveInterpreter, InteractiveConsole
import traceback, inspect

from objects import CIObject

class TemplateFileReader:
	def __init__(self):
		self.fileOut = ""
		self.kind = ""
		self.filePath = ""
		self.segments = []

	def readFile(self, templateFilename):
		f = codecs.open(templateFilename, 'r', sys.getfilesystemencoding())
		print ("templateFilename : %s" % templateFilename)

		# detection des infos meta sur les premieres lignes
		regexpMetaSpliter = re.compile('^%\[\s*(?P<key>.+)\s*:\s*(?P<value>.+)\s*\]\s*$')
		rawContent = ""
		metaIfFinished = False
		metaInfos = {}

		for line in f:
			matchGroupMeta = regexpMetaSpliter.match(line)
			if matchGroupMeta and not metaIfFinished:
				#DEBUG print (matchGroupMeta.groupdict())
				metaInfos[matchGroupMeta.groupdict()['key'].strip()] = matchGroupMeta.groupdict()['value'].strip()
			else:
				#DEBUG if not metaIfFinished:
				#DEBUG 	print (line)
				metaIfFinished = True
				rawContent += line
		#DEBUG 
		#print (metaInfos)
		if 'file' in metaInfos :
			self.fileOut = self.extractSegments(metaInfos['file'])
		else:
			self.fileOut = ""

		if 'kind' in metaInfos :
			self.kind = metaInfos['kind']
		else:
			self.kind = ""

		if 'path' in metaInfos :
			self.filePath = self.extractSegments(metaInfos['path'])
		else:
			self.filePath = ""

		self.segments = self.extractSegments(rawContent)


	def extractSegments(self, rawContent):
		# recuperaton des segments de code
		wasCode = False
		segments = []
		for item in rawContent.split("%%"):
			if wasCode:
				if re.match("\(.*\)", item):
					segments.append( PythonLine(item) )
					#DEBUG print ("PythonLine : %s" % item)
				else:
					segments.append( PythonSegment(item) )
					#DEBUG print ("PythonSegment : %s" % item)
			else:
				segments.append( StringSegment(item) )
			wasCode = not wasCode
		return segments


	def generateSegmentsFor(self, structure):
		return self.generateSegmentObjectFor(self.segments, structure)

	def generateSegmentObjectFor(self, segmentArray, structure):
		content = u""
		for segment in segmentArray:
			## encoding to UTF-8
			content += segment.toString(structure)
			
		return content


class StringSegment:
	def __init__(self, data):
		self.data = data

	def toString(self, structure):
		return self.data

class PythonSegment:
	def __init__(self, data):
		self.data = data.strip()
	
	def toString(self, structure):
		filename='<input>'
		symbol='single'
		localVars = {"self" : structure, "RETURN" : ""}
		inter = InteractiveInterpreter(localVars)
		
		#if isinstance(source, types.UnicodeType):
		#    import IOBinding
		#    try:
		#        source = source.encode(IOBinding.encoding)
		#    except UnicodeError:
		console = InteractiveConsole(localVars, filename)

		try:
			code_object = compile(self.data, '<string>', 'exec')
			exec code_object in localVars
		except Exception as e :
			print ("-  ERR -----------------------------------------")
			InteractiveInterpreter.showsyntaxerror(console, filename)
			frames = inspect.trace()
			lineNumber = frames[1][2]
			print "At line %s" % lineNumber
			print ("- /ERR -----------------------------------------")

			print ("-  CODE -----------------------------------------")
			lines = self.data.split('\n')
			for i in range(0,lineNumber):
				print lines[i]
			print "^"*20
			
			print ("- /CODE -----------------------------------------")
			print ("")
					
		return localVars["RETURN"]

class PythonLine:
	def __init__(self, data):
		self.data = data.strip()
	
	def toString(self, structure):
		result = ""
		try:
			result = eval(self.data, {"self" : structure} )
		except Exception as e:
			print ("ERROR while executing this code:")
			print ("------------------------------------------------")
			print (self.data)
			print ("------------------------------------------------")
		
		return result


def generateTemplates(rootFiles, readerTemplates, kind):
	# generation du fichier a partir du template
	if not kind in readerTemplates:
		print ("No kind <%s>:" % kind)
		return
	print ("  Generating files of kind <%s>:" % kind)
	for reader in readerTemplates[kind]:
		myDirectory = os.path.join(rootFiles, reader.generateSegmentObjectFor(reader.filePath, structure) )
		if not os.path.exists(myDirectory):
			os.makedirs(myDirectory)
		content = reader.generateSegmentsFor(structure)

		#print ("fileOut : %s" % reader.fileOut)
		#print (reader.generateSegmentObjectFor(reader.fileOut, structure))
		filename = os.path.join(myDirectory, reader.generateSegmentObjectFor(reader.fileOut, structure) )
		file = open(filename,'w')
		file.write( content.encode("utf-8") )
		file.close()
		print ("    File <%s> succeffuly generated:" % filename)

if __name__ == '__main__':	

	# lecture du fichier de config
	config = ConfigParser.ConfigParser()
	config.readfp(open('theme.cfg'))
	theme = config.get('global', 'theme').strip()
	CIRootFiles = config.get('generation', 'outDirFor_Classes').strip()
	generateObjects = config.get('generation','generate').strip()
	databaseName = config.get('generation', 'database').strip()

	# import du theme
	print ("Using theme <"+ theme +">...")

	# découpage de generateObjects en liste d'items à générer
	kindsToGenerate = []
	if generateObjects.find("all") > -1:
		kindsToGenerate = "helpers,controllers,views,subViews,baseModels,models,sql,lang".split(",")
	else:
		for item in generateObjects.split(","):
			kindsToGenerate.append(item.strip())


	if len(sys.argv) < 2:
		print ("Syntax : " + sys.argv[0] + " <fileObject0.xml> [fileObject1.xml]")
		sys.exit(1)

	# recuperation de tous les fichiers template
	allTemplates = {}
	for templateFilename in glob.glob(os.path.join("themes", theme, "templates","*.*")):
		#DEBUG print (templateFilename)
		reader = TemplateFileReader()
		reader.readFile(templateFilename)
		if reader.kind != "":
			if not reader.kind in allTemplates :
				allTemplates[reader.kind] = []
			allTemplates[reader.kind].append(reader)


	i = 1
	while i < len(sys.argv):
		aFilename = sys.argv[i]

		print ("-Object : " + aFilename)

		structure = CIObject()
		structure.fromXML(aFilename)

		for kind in kindsToGenerate:
			# générer les fichiers de template
			generateTemplates(CIRootFiles, allTemplates, kind)

		i += 1

	print ("Done.")
	sys.exit(0)


