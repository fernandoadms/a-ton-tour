<?php
/*
 * Created on 05/04/2010
 *
 */

class ListProjects extends Controller {

	/**
	 * Constructeur
	 */
	function ListProjects(){
		parent::Controller();
		$this->load->model('Project_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des projets
	 */
	public function index(){
		$usridusr = $this->session->userdata('user_id');
		
		$data['projects'] = Project_model::getAllProjects($this->db, $usridusr);
		$this->load->view('listProjects_view', $data);
	}

	/**
	 * Ajout d'un projet
	 */
	public function add(){

		// Insertion en base
		$project = new Project_model();
		$project->prjlbtit = $this->input->post('title');
		$project->prjlbdes = $this->input->post('description');
		$project->save($this->db);
		
		$project->addUser($this->db, $this->session->userdata('user_id') );

		$this->session->set_flashdata('message', formatInfo('Nouveau projet ajouté'));

		// Recharge la page avec les nouvelles infos
		redirect('listprojects/index'); 
	}

	/**
	 * Suppression d'un projet
	 * @param $rdgidrdg identifiant à supprimer
	 */
	function delete($prjidprj){
		Project_model::delete($this->db, $prjidprj);

		$this->session->set_flashdata('message', formatInfo('Projet supprimé'));

		redirect('listprojects/index'); 
	}

}
?>