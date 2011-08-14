<?php

class Welcome extends Controller {

	function Welcome() {
		parent::Controller();
		$this->load->model('User_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}
	
	/**
	 * Affichage de la page de connexion
	 */
	function index() {
		$this->load->view('welcome_message');
	}
	
	/**
	 * Connexion
	 */
	function login(){
		$login = $this->input->post('login'); 
		$password = $this->input->post('password'); 
		$user = User_model::connectUser($this->db, $login, $password);
		
		if($user == null) {
			$this->session->set_flashdata('message', formatError('Login ou mot de passe incorrect'));
			redirect('welcome/index'); 
		}else{
			$this->session->set_userdata('user_name', $user->usrlbnom);
			$this->session->set_userdata('user_id', $user->usridusr);
			redirect('listprojects/index'); 
		}
		
	}
	
	/**
	 * Deconnexion
	 */
	function logout(){
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_id');
		redirect('welcome/index'); 
	}
	
}

?>