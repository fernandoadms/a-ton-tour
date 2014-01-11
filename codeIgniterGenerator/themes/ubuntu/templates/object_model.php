%[kind : models]
%[file : %%(self.obName.lower())%%_model.php]
%[path : models]
<?php
/*
 * Created by generator
 *
 */

include_once( APPPATH . 'models/%%(self.obName.lower())%%Base_model' . EXT );

class %%(self.obName)%%_model extends %%(self.obName)%%Base_model {
	
	/**
	 * Constructeur
	 */
	function __construct(){
		parent::__construct();
	}
	
	
	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function %%(self.obName)%%_modelFromRow($row){
		if($row == null){
			return null;
		}
		$model = new %%(self.obName)%%_model();
%%
allAttributesCode = ""
for field in self.fields:
	attributeCode = ""
	if field.sqlType.upper()[0:4] == "DATE":
		attributeCode = "$model->%(dbName)s = fromSQLDate($row['%(dbName)s']);" % { 'dbName' : field.dbName }
	else:
		attributeCode = "$model->%(dbName)s = $row['%(dbName)s'];" % { 'dbName' : field.dbName }
	if allAttributesCode != "":
		allAttributesCode += "\n\t\t"
	allAttributesCode += attributeCode
RETURN = allAttributesCode
%%
		return $model;
	}
	
	/***************************************************************************
	 * USER DEFINED FUNCTIONS
	 ***************************************************************************/

}

?>
