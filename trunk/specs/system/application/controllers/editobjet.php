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
		$this->load->helper('download');
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

		$this->session->set_flashdata('message', formatInfo('Objet mis a jour'));

		// Recharge la page du projet avec les nouvelles infos
		redirect('editproject/index/' . $model->prjidprj.'#obj_'.$model->objidobj); 
	}
	
	/**
	 * Ajout d'un Champ
	 */
	public function addChamp(){

		$idProjet =  $this->input->post('projet'); 
		
		// Insertion en base
		$model = new Champ_model();
		$model->chplbcde = $this->input->post('code'); 
		$model->chplbnom = $this->input->post('nom'); 
		$model->chpfgnul = $this->input->post('peutEtreNull'); 
		$model->chpcdtyp = $this->input->post('type'); 
		$model->chplbdes = $this->input->post('description'); 
		$model->objidobj = $this->input->post('idObjet'); 
		$model->save($this->db);

		$this->session->set_flashdata('message', formatInfo('Nouveau champ ajoute'));
		
		// Recharge la page avec les nouvelles infos
		redirect('editobjet/index/'. $model->objidobj . '/' . $idProjet . '#chp_'.$model->chpidchp); 
	}
	
	/**
	 * Suppression d'un champ
	 * @param int $chpidchp
	 * @param int $objidobj
	 * @param int $idProjet
	 */
	public function deleteChamp($chpidchp, $objidobj, $idProjet){
		Champ_model::delete($this->db, $chpidchp);
		$this->session->set_flashdata('message', formatInfo('Champ supprimé'));
		redirect('editobjet/index/'. $objidobj . '/' . $idProjet); 
	}
	
	
	/**
	 * Suppression d'un objet
	 * @param int $objidobj
	 */
	public function delete($objidobj){
		$model = Objet_model::getObjet($this->db, $objidobj);
		if( $model == null ) {
			return;
		}
		$idProjet = $model->prjidprj;
		$nomObjet = $model->objlblib;
		Objet_model::delete($this->db, $objidobj);
		$this->session->set_flashdata('message', formatInfo('Objet "'.$nomObjet.'" supprimé'));
		
		redirect('editproject/index/' . $model->prjidprj.'#obj_'); 
	}
	
	/**
	 * Export de l'objet en XML
	 * @param int $objidobj
	 */
	public function export($objidobj){
		$model = Objet_model::getObjet($this->db, $objidobj);
		if( $model == null ) {
			return;
		}
		$xmlString = $model->exportXML($this->db);
		
		$resultOK = force_download($model->objlblib.".xml", $xmlString); 
		if( ! $resultOK ){
			$this->session->set_flashdata('message', formatInfo('Problème lors de l\'export XML'));
		}
			
		redirect('editobjet/index/' . $model->objidobj); 
		
	}
	
}
?>
