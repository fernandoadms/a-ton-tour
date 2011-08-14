<?php
/*
 * Created on 05/04/2010
 *
 */

class ListRdGs extends Controller {

	/**
	 * Constructeur
	 */
	function ListRdGs(){
		parent::Controller();
		$this->load->model('Rdg_model');
		$this->load->model('Project_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des règles de gestion
	 */
	public function index(){
		$data['rdgs'] = RdG_model::getAllRdG($this->db);
		$data['projects'] = Project_model::getAllProjects($this->db);
		$this->load->view('listRdGs_view', $data);
	}

	/**
	 * Ajout d'une règle de gestion
	 */
	public function add(){

		// Insertion en base
		$rdg = new RdG_model();
		$rdg->rdgnurdg = $this->input->post('number');
		$rdg->rdgtyrdg = $this->input->post('type');
		$rdg->rdglbeno = $this->input->post('anounce');
		$rdg->prjidprj = $this->input->post('project');
		$rdg->save($this->db);

		$this->session->set_flashdata('message', formatInfo('Nouvelle règle ajoutée'));

		// Recharge la page avec les nouvelles infos
		redirect('listrdgs/index'); 
	}

	/**
	 * Suppression d'une règle de gestion
	 * @param $rdgidrdg identifiant de la règle de gestion à supprimer
	 */
	function delete($rdgidrdg){
		RdG_model::delete($this->db, $rdgidrdg);

		$this->session->set_flashdata('message', formatInfo('Règle supprimée'));

		redirect('listrdgs/index'); 
	}

}
?>