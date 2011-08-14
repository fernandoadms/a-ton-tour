<?php
/*
 * Created by generator
 *
 */

class ListProjets extends Controller {

	/**
	 * Constructeur
	 */
	function ListProjets(){
		parent::Controller();
		$this->load->model('Projet_model');
		$this->load->library('session');
		$this->load->helper('url');
	}

	/**
	 * Affichage des Projets
	 */
	public function index(){
		$data['projets'] = Projet_model::getAllProjets($this->db);
		$this->load->view('listprojets_view', $data);
	}

	/**
	 * Ajout d'un Projet
	 */
	public function add(){

		// Insertion en base
		$model = new Projet_model();
		None
		$model->save($this->db);

		$this->session->set_flashdata('message', 'Nouveau Projet ajoute');
		
		// Recharge la page avec les nouvelles infos
		redirect('listprojets/index'); 
	}

	/**
	 * Suppression d'un Projet
	 * @param $prjidprj identifiant a supprimer
	 */
	function delete($prjidprj){
		Projet_model::delete($this->db, $prjidprj);

		$this->session->set_flashdata('message', 'Projet supprime');

		redirect('listprojets/index'); 
	}

}
?>
