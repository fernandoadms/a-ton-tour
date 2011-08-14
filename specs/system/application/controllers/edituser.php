<?php
/*
 * Created by generator
 *
 */

class EditUser extends Controller {

	function EditUser(){
		parent::Controller();
		$this->load->model('User_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos
	 */
	public function index($usridusr){
		$model = User_model::getUser($this->db, $usridusr);
		$data['user'] = $model;
		
		$data['allProjects'] = Project_model::getAllProjects($this->db);

		$this->load->view('edituser_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new User_model();
		$model->usridusr = $this->input->post('usridusr'); 
		$model->usrlbnom = $this->input->post('nom'); 
		$model->usrlblgn = $this->input->post('login'); 
		$model->usrlbpwd = $this->input->post('password'); 
		$model->update($this->db);
		
		$model->setProjects($this->db, explode(",", $this->input->post('selectedProjectIds')));

		$this->session->set_flashdata('message', formatInfo('User mis a jour'));

		redirect('listusers/index'); 
	}
	
}
?>