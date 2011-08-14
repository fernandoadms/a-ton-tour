<?php
/*
 * Created by generator
 *
 */

class ListCdus extends Controller {

	/**
	 * Constructeur
	 */
	function ListCdus(){
		parent::Controller();
		$this->load->model('Cdu_model');
		$this->load->model('Project_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des Cdu
	 */
	public function index(){
		$data['cdus'] = Cdu_model::getAllCdus($this->db);
		$data['projects'] = Project_model::getAllProjects($this->db);
		$this->load->view('listcdus_view', $data);
	}

	/**
	 * Ajout d'un Cdu
	 */
	public function add(){

		// Insertion en base
		$model = new Cdu_model();
		$model->cdulbdes = $this->input->post('description'); 
		$model->cdulbtit = $this->input->post('titre'); 
		$model->cdulbnum = $this->input->post('numero'); 
		$model->prjidprj = $this->input->post('projet'); 
		$model->save($this->db);

		$this->session->set_flashdata('message', formatInfo('Nouveau Cdu ajoute'));
		
		// Recharge la page avec les nouvelles infos
		redirect('listcdus/index'); 
	}

	/**
	 * Suppression d'un Cdu
	 * @param $cduidcdu identifiant a supprimer
	 */
	function delete($cduidcdu){
		Cdu_model::delete($this->db, $cduidcdu);

		$this->session->set_flashdata('message', formatInfo('Cdu supprime'));

		redirect('listcdus/index'); 
	}

}
?>
