<?php
/*
 * Created by generator
 *
 */

class ListUtilisateurs extends Controller {

	/**
	 * Constructeur
	 */
	function ListUtilisateurs(){
		parent::Controller();
		$this->load->model('Utilisateur_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des Utilisateurs
	 */
	public function index(){
		$data['utilisateurs'] = Utilisateur_model::getAllUtilisateurs($this->db);
		$this->load->view('listutilisateurs_view', $data);
	}

	/**
	 * Ajout d'un Utilisateur
	 */
	public function add(){

		// Insertion en base
		$model = new Utilisateur_model();
		$model->usridusr = $this->input->post('identifiant'); 
		$model->usrcdusr = $this->input->post('codeUser'); 
		$model->usrlbnom = $this->input->post('nom'); 
		$model->usrlbprn = $this->input->post('prenom'); 
		$model->usridser = $this->input->post('service'); 
		$model->usridres = $this->input->post('responsable'); 
		$model->save($this->db);

		$this->session->set_userdata('message', formatInfo('Nouveau Utilisateur ajoute'));
		
		// Recharge la page avec les nouvelles infos
		redirect('listutilisateurs/index'); 
	}

	/**
	 * Suppression d'un Utilisateur
	 * @param $usridusr identifiant a supprimer
	 */
	function delete($usridusr){
		Utilisateur_model::delete($this->db, $usridusr);

		$this->session->set_userdata('message', formatInfo('Utilisateur supprime'));

		redirect('listutilisateurs/index'); 
	}

}
?>
