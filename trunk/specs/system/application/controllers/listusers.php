<?php
/*
 * Created by generator
 *
 */

class ListUsers extends Controller {

	/**
	 * Constructeur
	 */
	function ListUsers(){
		parent::Controller();
		$this->load->model('User_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des User
	 */
	public function index(){
		$data['users'] = User_model::getAllUsers($this->db);
		$this->load->view('listusers_view', $data);
	}

	/**
	 * Ajout d'un User
	 */
	public function add(){

		// Insertion en base
		$model = new User_model();
		$model->usrlbnom = $this->input->post('nom'); 
		$model->usrlblgn = $this->input->post('login'); 
		$model->usrlbpwd = $this->input->post('password'); 
		$model->save($this->db);

		$this->session->set_flashdata('message', formatInfo('Nouveau User ajoute'));
		
		// Recharge la page avec les nouvelles infos
		redirect('listusers/index'); 
	}

	/**
	 * Suppression d'un User
	 * @param $usridusr identifiant a supprimer
	 */
	function delete($usridusr){
		User_model::delete($this->db, $usridusr);

		$this->session->set_flashdata('message', formatInfo('User supprime'));

		redirect('listusers/index'); 
	}

}
?>
