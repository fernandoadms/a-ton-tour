<?php
/*
 * Created by generator
 *
 */

class EditChamp extends Controller {

	function EditChamp(){
		parent::Controller();
		$this->load->model('Champ_model');
		$this->load->model('Objet_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos
	 */
	public function index($chpidchp){
		$model = Champ_model::getChamp($this->db, $chpidchp);
		$data['champ'] = $model;
		$data['objet'] = Objet_model::getObjet($this->db, $model->objidobj);

		$this->load->view('editchamp_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new Champ_model();
		$model->chpidchp = $this->input->post('identifiant');
		$model->chplbcde = $this->input->post('code'); 
		$model->chplbnom = $this->input->post('Nom'); 
		$model->chpfgnul = $this->input->post('peutEtreNull'); 
		$model->chpfgcle = $this->input->post('estCle'); 
		$model->chpcdtyp = $this->input->post('type'); 
		$model->chplbdes = $this->input->post('description'); 
		$model->objidobj = $this->input->post('idObjet'); 
		$model->update($this->db);

		$this->session->set_userdata('message', formatInfo('Champ "'.$model->chplbnom.'" mis a jour'));

		$prjidprj = $this->input->post('prjidprj'); 
		redirect('/editobjet/index/'.$model->objidobj.'/'.$prjidprj.'#chp_'.$model->chpidchp); 
	}
	
}
?>
