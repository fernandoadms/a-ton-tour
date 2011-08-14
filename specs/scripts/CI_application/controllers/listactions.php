<?php
/*
 * Created by generator
 *
 */

class ListActions extends Controller {

	/**
	 * Constructeur
	 */
	function ListActions(){
		parent::Controller();
		$this->load->model('Action_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des Actions
	 */
	public function index(){
		$data['actions'] = Action_model::getAllActions($this->db);
		$this->load->view('listactions_view', $data);
	}

	/**
	 * Ajout d'un Action
	 */
	public function add(){

		// Insertion en base
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
		$model->save($this->db);

		$this->session->set_userdata('message', formatInfo('Nouveau Action ajoute'));
		
		// Recharge la page avec les nouvelles infos
		redirect('listactions/index'); 
	}

	/**
	 * Suppression d'un Action
	 * @param $actidact identifiant a supprimer
	 */
	function delete($actidact){
		Action_model::delete($this->db, $actidact);

		$this->session->set_userdata('message', formatInfo('Action supprime'));

		redirect('listactions/index'); 
	}

}
?>
