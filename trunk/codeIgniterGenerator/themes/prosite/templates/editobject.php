<?php
/*
 * Created by generator
 *
 */

class Edit%(Name) extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('%(Name)_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
		$this->load->database();
	}


	/**
	 * Affichage des infos
	 */
	public function index($%(keyVariable)){
		$model = %(Name)_model::get%(Name)($this->db, $%(keyVariable));
		$data['%(name_lower)'] = $model;

		$this->load->view('edit%(name_lower)_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new %(Name)_model();
		$model->%(keyVariable) = $this->input->post('%(keyVariable)');
		%(listOfVariablesForViewExtraction)
		$model->update($this->db);

		$this->session->set_flashdata('message', formatInfo('%(Name) mis a jour'));

		redirect('list%(name_lower)s/index'); 
	}
	
}
?>
