<?php
/*
 * Created by generator
 *
 */

class EditEtat extends Controller {

	function EditEtat(){
		parent::Controller();
		$this->load->model('Etat_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos
	 */
	public function index($etacdeta){
		$model = Etat_model::getEtat($this->db, $etacdeta);
		$data['etat'] = $model;

		$this->load->view('editetat_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new Etat_model();
		$model->etacdeta = $this->input->post('etacdeta');
		$model->etalbeta = $this->input->post('libelle'); 
		$model->etacdact = $this->input->post('codeActivite'); 
		$model->update($this->db);

		$this->session->set_userdata('message', formatInfo('Etat mis a jour'));

		redirect('listetats/index'); 
	}
	
}
?>
