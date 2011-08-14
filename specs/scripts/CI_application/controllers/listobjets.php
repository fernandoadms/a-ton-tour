<?php
/*
 * Created by generator
 *
 */

class ListObjets extends Controller {

	/**
	 * Constructeur
	 */
	function ListObjets(){
		parent::Controller();
		$this->load->model('Objet_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des Objets
	 */
	public function index(){
		$data['objets'] = Objet_model::getAllObjets($this->db);
		$this->load->view('listobjets_view', $data);
	}

	/**
	 * Ajout d'un Objet
	 */
	public function add(){

		// Insertion en base
		$model = new Objet_model();
		$model->objidobj = $this->input->post('identifiant'); 
		$model->objcdtri = $this->input->post('trigramme'); 
		$model->prjidprj = $this->input->post('projet'); 
		$model->objlblib = $this->input->post('libelle'); 
		$model->objlbcde = $this->input->post('code'); 
		$model->objlbdes = $this->input->post('description'); 
		$model->save($this->db);

		$this->session->set_userdata('message', formatInfo('Nouveau Objet ajoute'));
		
		// Recharge la page avec les nouvelles infos
		redirect('listobjets/index'); 
	}

	/**
	 * Suppression d'un Objet
	 * @param $objidobj identifiant a supprimer
	 */
	function delete($objidobj){
		Objet_model::delete($this->db, $objidobj);

		$this->session->set_userdata('message', formatInfo('Objet supprime'));

		redirect('listobjets/index'); 
	}

}
?>
