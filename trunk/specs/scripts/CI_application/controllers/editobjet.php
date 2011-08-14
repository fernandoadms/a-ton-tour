<?php
/*
 * Created by generator
 *
 */

class EditObjet extends Controller {

	function EditObjet(){
		parent::Controller();
		$this->load->model('Objet_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos
	 */
	public function index($objidobj){
		$model = Objet_model::getObjet($this->db, $objidobj);
		$data['objet'] = $model;

		$this->load->view('editobjet_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new Objet_model();
		$model->objidobj = $this->input->post('identifiant');
		$model->objcdtri = $this->input->post('trigramme'); 
		$model->prjidprj = $this->input->post('projet'); 
		$model->objlblib = $this->input->post('libelle'); 
		$model->objlbcde = $this->input->post('code'); 
		$model->objlbdes = $this->input->post('description'); 
		$model->update($this->db);

		$this->session->set_userdata('message', formatInfo('Objet mis a jour'));

		redirect('listobjets/index'); 
	}
	
}
?>
