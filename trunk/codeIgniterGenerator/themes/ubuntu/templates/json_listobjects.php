%[kind : controllers]
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
	if field.referencedObject:
		attributeCode += """
	public function for%(referencedObject)s($%(fieldDbName)s){
		$data['teas'] = Tea_model::getAllTeasFor%(referencedObject)sBy_%(fieldDbName)s($this->db, $%(fieldDbName)s);
		$this->load->view('json/list%(objectNameLower)ss_view', $data);
	}""" % { 'referencedObject' : field.referencedObject.obName,
			'fieldDbName' : field.dbName.lower(),
			'objectNameLower' : self.obName.lower()
		}
	
	if attributeCode != "":
		allAttributeCode += attributeCode
	
RETURN = allAttributeCode
%%

}
?>
