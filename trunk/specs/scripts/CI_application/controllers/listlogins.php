<?php
/*
 * Created by generator
 *
 */

class ListLogins extends Controller {

	/**
	 * Constructeur
	 */
	function ListLogins(){
		parent::Controller();
		$this->load->model('Login_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des Logins
	 */
	public function index(){
		$data['logins'] = Login_model::getAllLogins($this->db);
		$this->load->view('listlogins_view', $data);
	}

	/**
	 * Ajout d'un Login
	 */
	public function add(){

		// Insertion en base
		$model = new Login_model();
		$model->lgnidlgn = $this->input->post('identifiant'); 
		$model->lgnidusr = $this->input->post('utilisateur'); 
		$model->lgnlblgn = $this->input->post('login'); 
		$model->lgnlbpwd = $this->input->post('password'); 
		$model->lgncdprf = $this->input->post('profil'); 
		$model->lgnfgarc = $this->input->post('flagArchive'); 
		$model->save($this->db);

		$this->session->set_userdata('message', formatInfo('Nouveau Login ajoute'));
		
		// Recharge la page avec les nouvelles infos
		redirect('listlogins/index'); 
	}

	/**
	 * Suppression d'un Login
	 * @param $lgnidlgn identifiant a supprimer
	 */
	function delete($lgnidlgn){
		Login_model::delete($this->db, $lgnidlgn);

		$this->session->set_userdata('message', formatInfo('Login supprime'));

		redirect('listlogins/index'); 
	}

}
?>
