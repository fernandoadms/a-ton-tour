%[kind : lang]
%[file : messages_%%(self.obName.lower())%%s_lang.php] 
%[path : language/french]
<?php
$lang['%%(self.obName.lower())%%.message.confirm.deleted'] = "%%(self.obName.lower())%% supprimé";
$lang['%%(self.obName.lower())%%.message.confirm.added'] = "%%(self.obName.lower())%% créé avec succès";
$lang['%%(self.obName.lower())%%.message.confirm.modified'] = "%%(self.obName.lower())%% mis à jour avec succès";

$lang['%%(self.obName.lower())%%.form.create.title'] = "Ajouter un %%(self.displayName)%%";
$lang['%%(self.obName.lower())%%.form.edit.title'] = "Editer un %%(self.displayName)%%";
$lang['%%(self.obName.lower())%%.form.list.title'] = "Liste des %%(self.displayName)%%s";

$lang['%%(self.obName.lower())%%.menu.item'] = "%%(self.displayName)%%";


%%allAttributesCode = ""
for field in self.fields:
	attributeCode = """$lang['%(objectObName)s.form.%(dbName)s.label'] = "%(obName)s";
$lang['%(objectObName)s.form.%(dbName)s.description'] = "%(desc)s";  
""" % {	'dbName': field.dbName, 
		'obName': field.obName,
		'objectObName':self.obName.lower(),
		'desc' : field.description
	}
	allAttributesCode += attributeCode
	
RETURN = allAttributesCode
%%

?>