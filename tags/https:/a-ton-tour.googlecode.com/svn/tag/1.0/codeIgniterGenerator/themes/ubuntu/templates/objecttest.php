%[kind : unitTest]
%[file : %%(self.obName.lower())%%test.php] 
%[path : controllers/test]
<?php
/*
 * Created by generator
 *
 */
require_once(APPPATH . '/controllers/test/Toast.php');

class %%(self.obName)%%Test extends Toast {

	function __construct(){
		parent::__construct();
		$this->load->database('test');
		
		$this->load->model('%%(self.obName)%%_model');
		
	}
	
	/**
	 * OPTIONAL; Anything in this function will be run before each test
	 * Good for doing cleanup: resetting sessions, renewing objects, etc.
	 */
	function _pre() {
		$%%(self.obName.lower())%%s = %%(self.obName)%%_model::getAll%%(self.obName)%%s($this->db);
		foreach ($%%(self.obName.lower())%%s as $%%(self.obName.lower())%%) {
			%%(self.obName)%%_model::delete($this->db, $%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%);
		}
	}
	
	
	/**
	 * OPTIONAL; Anything in this function will be run after each test
	 * I use it for setting $this->message = $this->My_model->getError();
	 */
	function _post() {
		$%%(self.obName.lower())%%s = %%(self.obName)%%_model::getAll%%(self.obName)%%s($this->db);
		foreach ($%%(self.obName.lower())%%s as $%%(self.obName.lower())%%) {
			%%(self.obName)%%_model::delete($this->db, $%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%);
		}
	}
	
	public function test_insert(){
		$this->message = "Tested methods: save, get%%(self.obName)%%, delete";
		// création d'un enregistrement
		$%%(self.obName.lower())%%_insert = new %%(self.obName)%%_model();
		%%
allAttributesCode = ""
index = 0
for field in self.fields:
	attributeCode = ""
	if field.autoincrement:
		attributeCode = "// Nothing for field %s" % field.dbName
	elif field.sqlType.upper()[0:4] == "ENUM":
		# TODO : recuperer les valeurs possibles
		pass
	elif field.sqlType.upper()[0:4] == "DATE":
		attributeCode = "$%(obName)s_insert->%(dbName)s = fromSQLDate('31/12/2050');" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:4] == "FLAG":
		attributeCode = "$%(obName)s_insert->%(dbName)s = '0';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:5] == "COLOR":
		attributeCode = "$%(obName)s_insert->%(dbName)s = '#ffffff';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:8] == "PASSWORD":
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'p4ssW0rD-%(index)d';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper() == "FILE":
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'file-%(index)d : ...';" % {	'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:3] == "INT":
		attributeCode = "$%(obName)s_insert->%(dbName)s = %(index)d;" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:7] == "VARCHAR":
		# TODO : taille limite
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'test_%(index)d';" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:4] == "TEXT":
		# TODO : taille limite
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'text-%(index)d : ...';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:4] == "CHAR":
		# TODO : taille limite
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'c-%(index)d';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	else:
		attributeCode = "//[ERROR] type [%s] not generated." % field.sqlType
		
	if allAttributesCode != "":
		allAttributesCode += "\n\t\t"
	allAttributesCode += attributeCode
	
RETURN = allAttributesCode
%%
		$%%(self.obName.lower())%%_insert->save($this->db);
		// $%%(self.obName.lower())%%_insert->%%(self.keyFields[0].dbName)%% est maintenant affecté
	
		$%%(self.obName.lower())%%_select = %%(self.obName)%%_model::get%%(self.obName)%%($this->db, $%%(self.obName.lower())%%_insert->%%(self.keyFields[0].dbName)%%);
	
		$this->_assert_equals($%%(self.obName.lower())%%_select->%%(self.keyFields[0].dbName)%%, $%%(self.obName.lower())%%_insert->%%(self.keyFields[0].dbName)%%);
		%%(self.obName)%%_model::delete($this->db, $%%(self.obName.lower())%%_select->%%(self.keyFields[0].dbName)%%);
	}
	
	
	public function test_update(){
		$this->message = "Tested methods: save, update, get%%(self.obName)%%, delete";
		$%%(self.obName.lower())%%_insert = new %%(self.obName)%%_model();

		%%
allAttributesCode = ""
index = 0
for field in self.fields:
	attributeCode = ""
	if field.autoincrement:
		attributeCode = "// Nothing for field %s" % field.dbName
	elif field.sqlType.upper()[0:4] == "ENUM":
		# TODO : recuperer les valeurs possibles
		pass
	elif field.sqlType.upper()[0:4] == "DATE":
		attributeCode = "$%(obName)s_insert->%(dbName)s = fromSQLDate('31/12/2050');" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:4] == "FLAG":
		attributeCode = "$%(obName)s_insert->%(dbName)s = '0';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:5] == "COLOR":
		attributeCode = "$%(obName)s_insert->%(dbName)s = '#ffffff';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:8] == "PASSWORD":
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'p4ssW0rD-%(index)d';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper() == "FILE":
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'file-%(index)d : ...';" % {	'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:3] == "INT":
		attributeCode = "$%(obName)s_insert->%(dbName)s = %(index)d;" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:7] == "VARCHAR":
		# TODO : taille limite
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'test_%(index)d';" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:4] == "TEXT":
		# TODO : taille limite
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'text-%(index)d : ...';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:4] == "CHAR":
		# TODO : taille limite
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'c-%(index)d';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }

	if allAttributesCode != "":
		allAttributesCode += "\n\t\t"
	allAttributesCode += attributeCode
	
RETURN = allAttributesCode
%%
		$%%(self.obName.lower())%%_insert->save($this->db);
	
		%%
allAttributesCode = ""
index = 0
for field in self.fields:
	attributeCode = ""
	if field.autoincrement:
		attributeCode = "// Nothing for field %s" % field.dbName
	elif field.sqlType.upper()[0:4] == "ENUM":
		# TODO : recuperer les valeurs possibles
		pass
	elif field.sqlType.upper()[0:4] == "DATE":
		attributeCode = "$%(obName)s_insert->%(dbName)s = fromSQLDate('31/01/2051');" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:4] == "FLAG":
		attributeCode = "$%(obName)s_insert->%(dbName)s = '1';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:5] == "COLOR":
		attributeCode = "$%(obName)s_insert->%(dbName)s = '#fffff1';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:8] == "PASSWORD":
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'pwd1-%(index)d';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper() == "FILE":
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'file1-%(index)d : ...';" % {	'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:3] == "INT":
		attributeCode = "$%(obName)s_insert->%(dbName)s = 9%(index)d;" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:7] == "VARCHAR":
		# TODO : taille limite
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'test1_%(index)d';" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:4] == "TEXT":
		# TODO : taille limite
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'text1-%(index)d : ...';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:4] == "CHAR":
		# TODO : taille limite
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'b-%(index)d';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }

	if allAttributesCode != "":
		allAttributesCode += "\n\t\t"
	allAttributesCode += attributeCode
	
RETURN = allAttributesCode
%%
		$%%(self.obName.lower())%%_insert->update($this->db);
	
		$%%(self.obName.lower())%%_update = %%(self.obName)%%_model::get%%(self.obName)%%($this->db, $%%(self.obName.lower())%%_insert->%%(self.keyFields[0].dbName)%%);
		
		%%
RETURN = self.dbVariablesList("""if(!$this->_assert_equals($%s_insert->(instVar)s, $%s_update->(instVar)s)) {
			return false;
		}""" % (self.obName.lower(), self.obName.lower()), 'instVar',  'typeVar', 'descrVar', 2, includesKey=True)
%%

		%%(self.obName)%%_model::delete($this->db, $%%(self.obName.lower())%%_insert->%%(self.keyFields[0].dbName)%%);
	}
	
	
	public function test_count(){
		$this->message = "Tested methods: getCount%%(self.obName)%%s, save, get%%(self.obName)%%, delete";
	
		// comptage pour vérification : avant
		$count%%(self.obName)%%sAvant = %%(self.obName)%%_model::getCount%%(self.obName)%%s($this->db);
	
		// création d'un enregistrement
		$%%(self.obName.lower())%% = new %%(self.obName)%%_model();
		%%
allAttributesCode = ""
index = 0
for field in self.fields:
	attributeCode = ""
	if field.autoincrement:
		attributeCode = "// Nothing for field %s" % field.dbName
	elif field.sqlType.upper()[0:4] == "ENUM":
		# TODO : recuperer les valeurs possibles
		pass
	elif field.sqlType.upper()[0:4] == "DATE":
		attributeCode = "$%(obName)s->%(dbName)s = fromSQLDate('31/12/2050');" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:4] == "FLAG":
		attributeCode = "$%(obName)s->%(dbName)s = '0';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:5] == "COLOR":
		attributeCode = "$%(obName)s->%(dbName)s = '#ffffff';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:8] == "PASSWORD":
		attributeCode = "$%(obName)s->%(dbName)s = 'p4ssW0rD-%(index)d';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper() == "FILE":
		attributeCode = "$%(obName)s->%(dbName)s = 'file-%(index)d : ...';" % {	'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:3] == "INT":
		attributeCode = "$%(obName)s->%(dbName)s = %(index)d;" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:7] == "VARCHAR":
		# TODO : taille limite
		attributeCode = "$%(obName)s->%(dbName)s = 'test_%(index)d';" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:4] == "TEXT":
		# TODO : taille limite
		attributeCode = "$%(obName)s->%(dbName)s = 'text-%(index)d : ...';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:4] == "CHAR":
		# TODO : taille limite
		attributeCode = "$%(obName)s->%(dbName)s = 'c-%(index)d';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }

	if allAttributesCode != "":
		allAttributesCode += "\n\t\t"
	allAttributesCode += attributeCode
	
RETURN = allAttributesCode
%%
		$%%(self.obName.lower())%%->save($this->db);
	
		// comptage pour vérification : après insertion
		$count%%(self.obName)%%sApres = %%(self.obName)%%_model::getCount%%(self.obName)%%s($this->db);
	
		// verification d'ajout d'un enregistrement
		$this->_assert_equals($count%%(self.obName)%%sAvant +1, $count%%(self.obName)%%sApres);
	
		// recupération de l'objet par son  %%(self.keyFields[0].dbName)%%
		$%%(self.obName.lower())%% = %%(self.obName)%%_model::get%%(self.obName)%%($this->db, $%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%);
	
		// suppression de l'enregistrement
		%%(self.obName)%%_model::delete($this->db, $%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%);
	
		// comptage pour vérification : après suppression
		$count%%(self.obName)%%sFinal = %%(self.obName)%%_model::getCount%%(self.obName)%%s($this->db);
		$this->_assert_equals($count%%(self.obName)%%sAvant, $count%%(self.obName)%%sFinal);
	
	}
	
	
	function test_list(){
		$this->message = "Tested methods: save, getAll%%(self.obName)%%s, delete";
	
		$%%(self.obName.lower())%%_insert = new %%(self.obName)%%_model();
		%%
allAttributesCode = ""
index = 0
for field in self.fields:
	attributeCode = ""
	if field.autoincrement:
		attributeCode = "// Nothing for field %s" % field.dbName
	elif field.sqlType.upper()[0:4] == "ENUM":
		# TODO : recuperer les valeurs possibles
		pass
	elif field.sqlType.upper()[0:4] == "DATE":
		attributeCode = "$%(obName)s_insert->%(dbName)s = fromSQLDate('31/12/2050');" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:4] == "FLAG":
		attributeCode = "$%(obName)s_insert->%(dbName)s = '0';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:5] == "COLOR":
		attributeCode = "$%(obName)s_insert->%(dbName)s = '#ffffff';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName }
	elif field.sqlType.upper()[0:8] == "PASSWORD":
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'p4ssW0rD-%(index)d';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper() == "FILE":
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'file-%(index)d : ...';" % {	'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:3] == "INT":
		attributeCode = "$%(obName)s_insert->%(dbName)s = %(index)d;" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:7] == "VARCHAR":
		# TODO : taille limite
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'test_%(index)d';" % { 'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:4] == "TEXT":
		# TODO : taille limite
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'text-%(index)d : ...';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }
	elif field.sqlType.upper()[0:4] == "CHAR":
		# TODO : taille limite
		attributeCode = "$%(obName)s_insert->%(dbName)s = 'c-%(index)d';" % {'obName' : self.obName.lower(), 'dbName' : field.dbName, 'index': index }

	if allAttributesCode != "":
		allAttributesCode += "\n\t\t"
	allAttributesCode += attributeCode
	
RETURN = allAttributesCode
%%
		$%%(self.obName.lower())%%_insert->save($this->db);
	
		$%%(self.obName.lower())%%s = %%(self.obName)%%_model::getAll%%(self.obName)%%s($this->db);
		if( ! $this->_assert_not_empty($%%(self.obName.lower())%%s) ) {
			return FALSE;
		}
		$found = 0;
		foreach ($%%(self.obName.lower())%%s as $%%(self.obName.lower())%%) {
			if($%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%% == $%%(self.obName.lower())%%_insert->%%(self.keyFields[0].dbName)%% &&
					%%
RETURN = self.dbVariablesList("""$this->_assert_equals($%s->(instVar)s, $%s_insert->(instVar)s )""" % (self.obName.lower(), self.obName.lower()), 'instVar',  'typeVar', 'descrVar', 5, includesKey=False, suffix=" && ")
%%
				){
				$found++;
			}
		}
		if( $found == 1 ){
			%%(self.obName)%%_model::delete($this->db, $%%(self.obName.lower())%%->%%(self.keyFields[0].dbName)%%);
			return TRUE;
		}else{
			return FALSE;
		}
	}

}
?>
