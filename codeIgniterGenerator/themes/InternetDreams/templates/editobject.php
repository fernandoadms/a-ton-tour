%[kind : controllers]
%[file : edit%%(self.obName.lower())%%.php] 
%[path : controllers]
<?php
/*
 * Created by generator
 *
 */

class Edit%%(self.obName)%% extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('%%(self.obName)%%_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
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

		$this->session->keep_flashdata('msg_info');
		$this->session->keep_flashdata('msg_confirm');
		$this->session->keep_flashdata('msg_warn');
		$this->session->keep_flashdata('msg_error');

	}


	/**
	 * Affichage des infos
	 */
	public function index($%%(self.keyFields[0].dbName)%%){
		$model = %%(self.obName)%%_model::get%%(self.obName)%%($this->db, $%%(self.keyFields[0].dbName)%%);
		$data['%%(self.obName.lower())%%'] = $model;
%%allAttributeCode = ""
# inclure les objets référencés dans l'objet $data

for field in self.fields:
	attributeCode = ""
	if field.referencedObject:
		attributeCode += """
		$data['%(referencedObjectLower)sCollection'] = %(referencedObject)s_model::getAll%(referencedObject)ss($this->db);""" % {
			'referencedObjectLower' : field.referencedObject.obName.lower(),
			'referencedObject' : field.referencedObject.obName
		}
	allAttributeCode += attributeCode
	
RETURN = allAttributeCode
%%

		$this->load->view('edit%%(self.obName.lower())%%_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new %%(self.obName)%%_model();
		$model->%%(self.keyFields[0].dbName)%% = $this->input->post('%%(self.keyFields[0].dbName)%%');
		%%
includesKey = False;
RETURN = self.dbAndObVariablesList("$model->(dbVar)s = $this->input->post('(dbVar)s'); ", 'dbVar', 'obVar', 2, includesKey)
%%
		$model->update($this->db);

		$this->session->set_flashdata('msg_confirm', '%%(self.obName)%% mis a jour');

		redirect('list%%(self.obName.lower())%%s/index');
	}

}
?>
