%[kind : json]
%[file : list%%(self.obName.lower())%%s.php] 
%[path : controllers/json]
<?php
/*
 * Created by generator
 *
 */

class List%%(self.obName)%%s extends CI_Controller {

	/**
	 * Constructeur
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('%%(self.obName)%%_model');
		$this->load->library('session');
		$this->load->database();
%%allAttributeCode = ""
# inclure les modeles des objets référencés

for field in self.fields:
	attributeCode = ""
	if field.referencedObject:
		attributeCode += """
		$this->load->model('%s_model');""" % field.referencedObject.obName
	allAttributeCode += attributeCode
	
RETURN = allAttributeCode
%%

	}

	/**
	 * Affichage des %%(self.obName)%%s
	 */
	public function index(){
		// recuperation des donnees
		$data['%%(self.obName.lower())%%s'] = %%(self.obName)%%_model::getAll%%(self.obName)%%s($this->db);
		
		$this->load->view('json/list%%(self.obName.lower())%%s_view', $data);
	}

%%allAttributeCode = ""
	# inclure les objets référencés
	
for field in self.fields:
	attributeCode = ""
	if field.autoincrement:
		continue
	elif field.referencedObject:
		attributeCode += """
	public function findBy_%(fieldDbName)s($%(fieldDbName)s, $limit = 50, $offset = 0){
		$data['%(objectNameLower)ss'] = %(obName)s_model::getAll%(obName)ssFor%(referencedObject)sBy_%(fieldDbName)s($this->db, $%(fieldDbName)s, $limit, $offset);
		$this->load->view('json/list%(objectNameLower)ss_view', $data);
	}""" % { 'referencedObject' : field.referencedObject.obName,
			'fieldDbName' : field.dbName.lower(),
			'objectNameLower' : self.obName.lower(),
			'obName' : self.obName
		}
	else:
		if field.sqlType.upper()[0:4] == "FILE":
			continue
		attributeCode += """
	public function findBy_%(fieldDbName)s($%(fieldDbName)s, $limit = 50, $offset = 0){
		$data['%(objectNameLower)ss'] = %(obName)s_model::getAll%(obName)ssBy_%(fieldDbName)s($this->db, $%(fieldDbName)s, $limit, $offset);
		$this->load->view('json/list%(objectNameLower)ss_view', $data);
	}""" % { 'fieldDbName' : field.dbName.lower(),
			'objectNameLower' : self.obName.lower(),
			'obName' : self.obName
		}
		
	if attributeCode != "":
		allAttributeCode += attributeCode
	
RETURN = allAttributeCode
%%

}
?>
