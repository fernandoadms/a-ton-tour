<?php
/*
 * Created on 03/05/2010
 *
 */

class ListScenarios extends Controller {

	/**
	 * Constructeur
	 */
	function ListScenarios(){
		parent::Controller();
		$this->load->model('Scenario_model');
		$this->load->model('Cdu_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des schemas
	 */
	public function index(){
		$data['scenarios'] = Scenario_model::getAllScenarios($this->db);
		$data['cdus'] = Cdu_model::getAllCdus($this->db);
		$this->load->view('listScenarios_view', $data);
	}

	/**
	 * Ajout d'un scenario
	 */
	public function add(){
		
		// Insertion en base
		$model = new Scenario_model();
		$model->scntyscn = $this->input->post('type');
		$model->scnlbscn = $this->input->post('label');
		$model->scnlbres = $this->input->post('result');
		$model->cduidcdu = $this->input->post('cdu');
		$model->save($this->db);
				
		$this->session->set_flashdata('message', formatInfo('Nouveau scénario ajouté'));

		// Recharge la page avec les nouvelles infos
		redirect('listscenarios/index'); 
	}

	/**
	 * Suppression d'un scenario
	 * @param $scnidscn identifiant du scenario à supprimer
	 */
	function delete($scnidscn){
		Scenario_model::delete($this->db, $scnidscn);
		
		$this->session->set_flashdata('message', formatInfo('Scénario supprimé'));
		
		redirect('listscenarios/index'); 
	}

}
?>