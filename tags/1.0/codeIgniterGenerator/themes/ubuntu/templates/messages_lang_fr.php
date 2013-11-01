%[kind : lang]
%[file : messages_%%(self.obName.lower())%%_lang.php] 
%[path : language/french]
<?php
/**
 * Message file for entity %%(self.obName)%%
 * 
 * Please don't forget to load this file:
 *  Solution A : Use "/application/config/autoload.php"
 *               Add this line:
 *               $autoload['language'] = array(..., 'messages_%%(self.obName.lower())%%', ...);
 *
 *  Solution B : Load this message file anywhere you want.
 *  
 */

$lang['%%(self.obName.lower())%%.message.askConfirm.deletion'] = "Désirez-vous supprimer ce %%(self.displayName)%% ?";

$lang['%%(self.obName.lower())%%.message.confirm.deleted'] = "%%(self.displayName)%% supprimé avec succès";
$lang['%%(self.obName.lower())%%.message.confirm.added'] = "%%(self.displayName)%% créé avec succès";
$lang['%%(self.obName.lower())%%.message.confirm.modified'] = "%%(self.displayName)%% mis à jour avec succès";

$lang['%%(self.obName.lower())%%.form.create.title'] = "Ajouter un %%(self.displayName.lower())%%";
$lang['%%(self.obName.lower())%%.form.edit.title'] = "Editer un %%(self.displayName.lower())%%";
$lang['%%(self.obName.lower())%%.form.list.title'] = "Liste des %%(self.displayName.lower())%%s";

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