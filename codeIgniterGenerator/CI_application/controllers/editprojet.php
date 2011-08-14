<?php
/*
 * Created by generator
 *
 */

class EditProjet extends Controller {

	function EditProjet(){
		parent::Controller();
		$this->load->model('Projet_model');
		$this->load->library('session');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos
	 */
	public function index($prjidprj){
		$model = Projet_model::getProjet($this->db, $prjidprj);
		$data['projet'] = $model;

		$this->load->view('editprojet_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new Projet_model();
		$model->prjidprj = $this->input->post('prjidprj');
		None
		$model->update($this->db);

		$this->session->set_flashdata('message', 'Projet mis a jour');

		redirect('listprojets/index'); 
	}
	
}
?>
