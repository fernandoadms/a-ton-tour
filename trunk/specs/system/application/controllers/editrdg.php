<?php
/*
 * Created on 29 juil. 09
 *
 */

class EditRdG extends Controller {

	function EditRdG(){
		parent::Controller();
		$this->load->model('RdG_model');
		$this->load->model('Project_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos de la règle de gestion
	 */
	public function index($rdgidrdg, $prjidprj = null){
		$rdg = RdG_model::getRdG($this->db, $rdgidrdg);
		$data['rdg'] = $rdg;
		if($prjidprj == null){
			$data['projects'] = Project_model::getAllProjects($this->db);
		}else{
			$data['project'] = Project_model::getProject($this->db, $prjidprj);
		}
		
		$this->load->view('editRdG_view',$data);
	}

	/**
	 * Sauvegarde les modifications d'une règle de gestion
	 */
	public function save(){
		// Mise à jour des données en base
		$model = new RdG_model();
		$model->rdgidrdg = $this->input->post('rdgidrdg');
		$model->rdgnurdg = $this->input->post('number');
		$model->rdgtyrdg = $this->input->post('type');
		$model->rdglbeno = $this->input->post('anounce');
		$model->rdgdtcre = $this->input->post('rdgdtcre');
		if( $this->input->post('project') != null && $this->input->post('project') != '' ) {
			$model->prjidprj = $this->input->post('project');
		}else{
			$model->prjidprj = $this->input->post('masterProject');
		}
		
		$model->update($this->db);

		$this->session->set_flashdata('message', formatInfo('Règle "'.$model->rdgnurdg.'" mise à jour'));

		if($this->input->post('masterProject') == null){
			redirect('listrdgs/index'); 
		}else {
			redirect('editproject/index/'.$model->prjidprj.'#rdg_'.$model->rdgidrdg); 
		}

	}
	
	/**
	 * Suppression d'un schéma sur une règle
	 * @param unknown_type $rdgidrdg
	 * @param unknown_type $schidsch
	 */
	public function deleteschema($rdgidrdg, $schidsch, $prjidprj = null){
		$rdg = RdG_model::getRdG($this->db, $rdgidrdg);
		$rdg->removeSchema($this->db, $schidsch);
		if($prjidprj != null){
			redirect('editrdg/index/'.$rdgidrdg.'/'.$prjidprj);
		}else {
			redirect('editrdg/index/'.$rdgidrdg); 
		}
		
	}

}
?>
