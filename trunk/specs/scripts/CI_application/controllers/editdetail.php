<?php
/*
 * Created by generator
 *
 */

class EditDetail extends Controller {

	function EditDetail(){
		parent::Controller();
		$this->load->model('Detail_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos
	 */
	public function index($detiddet){
		$model = Detail_model::getDetail($this->db, $detiddet);
		$data['detail'] = $model;

		$this->load->view('editdetail_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new Detail_model();
		$model->detiddet = $this->input->post('identifiant');
		$model->detlbdes = $this->input->post('texte'); 
		$model->actidact = $this->input->post('identifiantAction'); 
		$model->usridres = $this->input->post('identifiantUserResponsable'); 
		$model->detdteci = $this->input->post('dtEcheanceIni'); 
		$model->detdtecp = $this->input->post('dtEcheancePrevue'); 
		$model->detdtecr = $this->input->post('dtEcheanceReelle'); 
		$model->etacdeta = $this->input->post('codeEtat'); 
		$model->update($this->db);

		$this->session->set_userdata('message', formatInfo('Detail mis a jour'));

		redirect('listdetails/index'); 
	}
	
}
?>
