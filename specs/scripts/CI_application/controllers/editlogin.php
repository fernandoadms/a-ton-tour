<?php
/*
 * Created by generator
 *
 */

class EditLogin extends Controller {

	function EditLogin(){
		parent::Controller();
		$this->load->model('Login_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos
	 */
	public function index($lgnidlgn){
		$model = Login_model::getLogin($this->db, $lgnidlgn);
		$data['login'] = $model;

		$this->load->view('editlogin_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new Login_model();
		$model->lgnidlgn = $this->input->post('lgnidlgn');
		$model->lgnidusr = $this->input->post('utilisateur'); 
		$model->lgnlblgn = $this->input->post('login'); 
		$model->lgnlbpwd = $this->input->post('password'); 
		$model->lgncdprf = $this->input->post('profil'); 
		$model->lgnfgarc = $this->input->post('flagArchive'); 
		$model->update($this->db);

		$this->session->set_userdata('message', formatInfo('Login mis a jour'));

		redirect('listlogins/index'); 
	}
	
}
?>
