<?php
/*
 * Created by generator
 *
 */

class EditUtilisateur extends Controller {

	function EditUtilisateur(){
		parent::Controller();
		$this->load->model('Utilisateur_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos
	 */
	public function index($usridusr){
		$model = Utilisateur_model::getUtilisateur($this->db, $usridusr);
		$data['utilisateur'] = $model;

		$this->load->view('editutilisateur_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new Utilisateur_model();
		$model->usridusr = $this->input->post('usridusr');
		$model->usrcdusr = $this->input->post('codeUser'); 
		$model->usrlbnom = $this->input->post('nom'); 
		$model->usrlbprn = $this->input->post('prenom'); 
		$model->usridser = $this->input->post('service'); 
		$model->usridres = $this->input->post('responsable'); 
		$model->update($this->db);

		$this->session->set_userdata('message', formatInfo('Utilisateur mis a jour'));

		redirect('listutilisateurs/index'); 
	}
	
}
?>
