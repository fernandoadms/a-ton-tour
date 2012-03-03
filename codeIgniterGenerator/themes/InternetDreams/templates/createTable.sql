%[kind : sql]
%[file : cretab_%%(self.obName.lower())%%.sql]
%[path : ../../CI_objets]
CREATE TABLE `%%(self.dbTableName)%%` (
%%content = ""
allAttributesCode = ""

for field in self.fields:
	if allAttributesCode != "":
		allAttributesCode += ", \n"

	typeForSQL = field.sqlType

	if field.sqlType.upper()[0:4] == "FLAG":
		typeForSQL = "char(1)"
	elif field.sqlType.upper()[0:4] == "ENUM":
		typeForSQL = "varchar(255)"

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

content += allAttributesCode
RETURN = content
%%
);

