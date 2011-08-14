<?php
/*
 * Created by generator
 *
 */

class List%(Name)s extends Controller {

	/**
	 * Constructeur
	 */
	function List%(Name)s(){
		parent::Controller();
		$this->load->model('%(Name)_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des %(Name)s
	 */
	public function index(){
		$data['%(name_lower)s'] = %(Name)_model::getAll%(Name)s($this->db);
		$this->load->view('list%(name_lower)s_view', $data);
	}

	/**
	 * Ajout d'un %(Name)
	 */
	public function add(){

		// Insertion en base
		$model = new %(Name)_model();
		%(listOfVariablesForViewExtraction)
		$model->save($this->db);

		$this->session->set_userdata('message', formatInfo('Nouveau %(Name) ajoute'));
		
		// Recharge la page avec les nouvelles infos
		redirect('list%(name_lower)s/index'); 
	}

	/**
	 * Suppression d'un %(Name)
	 * @param $%(keyVariable) identifiant a supprimer
	 */
	function delete($%(keyVariable)){
		%(Name)_model::delete($this->db, $%(keyVariable));

		$this->session->set_userdata('message', formatInfo('%(Name) supprime'));

		redirect('list%(name_lower)s/index'); 
	}

}
?>
