<?php
/*
 * Created by generator
 *
 */

class ListChamps extends Controller {

	/**
	 * Constructeur
	 */
	function ListChamps(){
		parent::Controller();
		$this->load->model('Champ_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des Champs
	 */
	public function index(){
		$data['champs'] = Champ_model::getAllChamps($this->db);
		$this->load->view('listchamps_view', $data);
	}

	/**
	 * Ajout d'un Champ
	 */
	public function add(){

		// Insertion en base
		$model = new Champ_model();
		$model->chpidchp = $this->input->post('identifiant'); 
		$model->chplbcde = $this->input->post('code'); 
		$model->chplbnom = $this->input->post('Nom'); 
		$model->chpfgnul = $this->input->post('peutEtreNull'); 
		$model->chpfgcle = $this->input->post('estCle'); 
		$model->chpcdtyp = $this->input->post('type'); 
		$model->chplbdes = $this->input->post('description'); 
		$model->objidobj = $this->input->post('idObjet'); 
		$model->save($this->db);

		$this->session->set_userdata('message', formatInfo('Nouveau Champ ajoute'));
		
		// Recharge la page avec les nouvelles infos
		redirect('listchamps/index'); 
	}

	/**
	 * Suppression d'un Champ
	 * @param $chpidchp identifiant a supprimer
	 */
	function delete($chpidchp){
		Champ_model::delete($this->db, $chpidchp);

		$this->session->set_userdata('message', formatInfo('Champ supprime'));

		redirect('listchamps/index'); 
	}

}
?>
