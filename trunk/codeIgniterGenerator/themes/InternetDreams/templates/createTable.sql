%[kind : sql]
%[file : cretab_%%(self.obName.lower())%%.sql]
%[path : ../sources/sql]
CREATE TABLE `%%(self.dbTableName)%%` (
%%content = ""
allAttributesCode = ""

for field in self.fields:
	if allAttributesCode != "":
		allAttributesCode += ", \n"

	typeForSQL = field.sqlType

	if field.sqlType.upper()[0:4] == "FLAG":
		typeForSQL = "char(1)"
	if field.sqlType.upper()[0:5] == "COLOR":
		typeForSQL = "char(7)"
	if field.sqlType.upper()[0:4] == "DATE":
		typeForSQL = "date"
	elif field.sqlType.upper()[0:8] == "PASSWORD":
		typeForSQL = "varchar" + field.sqlType[8:]
	elif field.sqlType.upper()[0:4] == "ENUM":
		typeForSQL = "ENUM(" 
		enumTypes = field.sqlType[5:-1]
		for enum in enumTypes.split(','):
			valueAndText = enum.replace('"','').replace("'","").split(':')
			typeForSQL += """"%(value)s",""" % {'value': valueAndText[0].strip()}
		typeForSQL = typeForSQL[:-1]
		typeForSQL += ")"

	elif field.sqlType.upper() == "FILE":
		typeForSQL = "varchar(4000)" 

	attributeCode = "\t`%(dbName)s` %(sqlType)s " % { 'dbName' : field.dbName,
	  'sqlType' : typeForSQL
	}
	if not field.nullable:
		attributeCode += "NOT NULL "
	if field.autoincrement:
		attributeCode += "AUTO_INCREMENT "
	attributeCode += "COMMENT '%(desc)s'" % { 'desc' : field.description.replace("'","\\'") }
	allAttributesCode += attributeCode

content += allAttributesCode

primaryKeys = ""
for field in self.keyFields:
	primaryKeys += """ ,
	PRIMARY KEY (%s) """ % field.dbName

content += primaryKeys + """
);"""

RETURN = content
%%


%%foreignKeys = ""
for field in self.fields:
	foreignKey = ""
	if field.referencedObject:
		foreignKey = """ALTER TABLE %(tableName)s ADD CONSTRAINT FK_%(foreignTable)s_%(foreignColumn)s FOREIGN KEY (%(tableColumn)s) REFERENCES %(foreignTable)s (%(foreignColumn)s);
""" % {	'tableName': self.dbTableName,
			'foreignTable': field.referencedObject.dbTableName,
			'foreignColumn': field.referencedObject.keyFields[0].dbName,
			'tableColumn': field.dbName
		}
	foreignKeys += foreignKey
RETURN = foreignKeys
%%

