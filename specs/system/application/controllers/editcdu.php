<?php
/*
 * Created by generator
 *
 */

class EditCdu extends Controller {

	function EditCdu(){
		parent::Controller();
		$this->load->model('Cdu_model');
		$this->load->model('Project_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos
	 */
	public function index($cduidcdu, $prjidprj = null){
		$data['cdu'] = Cdu_model::getCdu($this->db, $cduidcdu);
		
		if($prjidprj == null){
			$data['projects'] = Project_model::getAllProjects($this->db);
		}else{
			$data['project'] = Project_model::getProject($this->db, $prjidprj);
		}
		
		$this->load->view('editcdu_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new Cdu_model();
		$model->cduidcdu = $this->input->post('identifiant');
		$model->cdulbdes = $this->input->post('description');
		$model->cdulbtit = $this->input->post('titre');
		$model->cdulbnum = $this->input->post('numero');
		
		if( $this->input->post('project') != null && $this->input->post('project') != '' ) {
			$model->prjidprj = $this->input->post('project');
		}else{
			$model->prjidprj = $this->input->post('masterProject');
		}
		$model->update($this->db);

		$this->session->set_flashdata('message', formatInfo('Cdu mis a jour'));

		if($this->input->post('masterProject') == null){
			redirect('listcdus/index'); 
		}else {
			redirect('editproject/index/'.$model->prjidprj.'#cdu_'.$model->cduidcdu); 
		}
		
	}
	
}
?>