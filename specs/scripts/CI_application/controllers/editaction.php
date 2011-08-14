<?php
/*
 * Created by generator
 *
 */

class EditAction extends Controller {

	function EditAction(){
		parent::Controller();
		$this->load->model('Action_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos
	 */
	public function index($actidact){
		$model = Action_model::getAction($this->db, $actidact);
		$data['action'] = $model;

		$this->load->view('editaction_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new Action_model();
		$model->actidact = $this->input->post('identifiant');
		$model->actidpro = $this->input->post('proprietaire'); 
		$model->actlbtit = $this->input->post('titre'); 
		$model->actnupri = $this->input->post('priorite'); 
		$model->actdtcre = $this->input->post('dtCreation'); 
		$model->actdtdem = $this->input->post('dtDemarrage'); 
		$model->actdteci = $this->input->post('dtEcheanceIni'); 
		$model->actdtecp = $this->input->post('dtEcheancePrevue'); 
		$model->actdtecr = $this->input->post('dtEcheanceReelle'); 
		$model->actfgcac = $this->input->post('cacher'); 
		$model->update($this->db);

		$this->session->set_userdata('message', formatInfo('Action mis a jour'));

		redirect('listactions/index'); 
	}
	
}
?>
