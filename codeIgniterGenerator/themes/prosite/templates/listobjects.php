<?php
/*
 * Created by generator
 *
 */

class List%(Name)s extends CI_Controller {

	/**
	 * Constructeur
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('%(Name)_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper('template');
		$this->load->helper('url');
		$this->load->database();
	}

	/**
	 * Affichage des %(Name)s
	 */
	public function index($orderBy = null, $asc = null, $page = 0){
		// preparer le tri
		if($orderBy == null) {
			$orderBy = '%(keyVariable)';
		}
		if($asc == null) {
			$asc = 'asc';
		}
		$data['orderBy'] = $orderBy;
		$data['asc'] = $asc;
		
		// preparer la pagination
		$config['base_url'] = base_url().'index.php/list%(name_lower)s/index/'.$orderBy.'/'.$asc.'/';
		$config['total_rows'] = %(Name)_model::getCount%(Name)s($this->db);
		$config['per_page'] = 15;
		$config['cur_tag_open'] = '<td class="currentPage">';
		$config['cur_tag_close'] = '</td>';
		$config['num_tag_open'] = '<td>';
		$config['num_tag_close'] = '</td>';
		$config['prev_tag_open'] = '<td>';
		$config['prev_tag_close'] = '</td>';
		$config['next_tag_open'] = '<td>';
		$config['next_tag_close'] = '</td>';
		$config['uri_segment'] = '5'; // where the page number is in the URI segment 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination;
		$offset = $page * $config['per_page'];
		
		// recuperation des donnees
		$data['%(name_lower)s'] = %(Name)_model::getAll%(Name)s($this->db, $orderBy, $asc, $config['per_page'], $offset);
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

		$this->session->set_flashdata('message', formatInfo('Nouveau %(Name) ajoute'));
		
		// Recharge la page avec les nouvelles infos
		redirect('list%(name_lower)s/index'); 
	}

	/**
	 * Suppression d'un %(Name)
	 * @param $%(keyVariable) identifiant a supprimer
	 */
	function delete($%(keyVariable)){
		%(Name)_model::delete($this->db, $%(keyVariable));

		$this->session->set_flashdata('message', formatInfo('%(Name) supprime'));

		redirect('list%(name_lower)s/index'); 
	}

}
?>
