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
	}


	/**
	 * Affichage des infos
	 */
	public function index($%%(self.keyFields[0].dbName)%%){
		$model = %%(self.obName)%%_model::get%%(self.obName)%%($this->db, $%%(self.keyFields[0].dbName)%%);
		$data['%%(self.obName.lower())%%'] = $model;

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

		$this->session->set_flashdata('message', formatInfo('%(self.obName)%% mis a jour'));

		redirect('list%%(self.obName.lower())%%s/index');
	}

}
?>
