<?php
/*
 * Created by generator
 *
 */

class ListEtats extends Controller {

	/**
	 * Constructeur
	 */
	function ListEtats(){
		parent::Controller();
		$this->load->model('Etat_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des Etats
	 */
	public function index(){
		$data['etats'] = Etat_model::getAllEtats($this->db);
		$this->load->view('listetats_view', $data);
	}

	/**
	 * Ajout d'un Etat
	 */
	public function add(){

		// Insertion en base
		$model = new Etat_model();
		$model->etacdeta = $this->input->post('code'); 
		$model->etalbeta = $this->input->post('libelle'); 
		$model->etacdact = $this->input->post('codeActivite'); 
		$model->save($this->db);

		$this->session->set_userdata('message', formatInfo('Nouveau Etat ajoute'));
		
		// Recharge la page avec les nouvelles infos
		redirect('listetats/index'); 
	}

	/**
	 * Suppression d'un Etat
	 * @param $etacdeta identifiant a supprimer
	 */
	function delete($etacdeta){
		Etat_model::delete($this->db, $etacdeta);

		$this->session->set_userdata('message', formatInfo('Etat supprime'));

		redirect('listetats/index'); 
	}

}
?>
