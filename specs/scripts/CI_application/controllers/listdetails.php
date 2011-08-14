<?php
/*
 * Created by generator
 *
 */

class ListDetails extends Controller {

	/**
	 * Constructeur
	 */
	function ListDetails(){
		parent::Controller();
		$this->load->model('Detail_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des Details
	 */
	public function index(){
		$data['details'] = Detail_model::getAllDetails($this->db);
		$this->load->view('listdetails_view', $data);
	}

	/**
	 * Ajout d'un Detail
	 */
	public function add(){

		// Insertion en base
		$model = new Detail_model();
		$model->detiddet = $this->input->post('identifiant'); 
		$model->detlbdes = $this->input->post('texte'); 
		$model->actidact = $this->input->post('identifiantAction'); 
		$model->usridres = $this->input->post('identifiantUserResponsable'); 
		$model->detdteci = $this->input->post('dtEcheanceIni'); 
		$model->detdtecp = $this->input->post('dtEcheancePrevue'); 
		$model->detdtecr = $this->input->post('dtEcheanceReelle'); 
		$model->etacdeta = $this->input->post('codeEtat'); 
		$model->save($this->db);

		$this->session->set_userdata('message', formatInfo('Nouveau Detail ajoute'));
		
		// Recharge la page avec les nouvelles infos
		redirect('listdetails/index'); 
	}

	/**
	 * Suppression d'un Detail
	 * @param $detiddet identifiant a supprimer
	 */
	function delete($detiddet){
		Detail_model::delete($this->db, $detiddet);

		$this->session->set_userdata('message', formatInfo('Detail supprime'));

		redirect('listdetails/index'); 
	}

}
?>
