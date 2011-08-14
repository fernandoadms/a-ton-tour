<?php
/*
 * Created on 20/04/2010
 *
 */

class EditProject extends Controller {

	function EditProject(){
		parent::Controller();
		$this->load->model('Project_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos du projet
	 */
	public function index($prjidprj){
		$project = Project_model::getProject($this->db, $prjidprj);
		$data['project'] = $project;

		$this->load->view('editProject_view',$data);
	}

	/**
	 * Sauvegarde les modifications d'un projet
	 */
	public function save(){
		// Mise à jour des données en base
		$model = new Project_model();
		$model->prjidprj = $this->input->post('prjidprj');
		$model->prjlbtit = $this->input->post('title');
		$model->prjlbdes = $this->input->post('description');
		$model->update($this->db);

		$this->session->set_flashdata('message', formatInfo('Projet "'.$model->prjlbtit.'" mis à jour'));

		redirect('listprojects/index'); 
	}
	
	/**
	 * Ajout d'une règle de gestion
	 */
	public function addrdg(){
		// Insertion en base d'une regle de gestion
		$rdg = new RdG_model();
		$rdg->rdgnurdg = $this->input->post('number');
		$rdg->rdgtyrdg = $this->input->post('type');
		$rdg->rdglbeno = $this->input->post('anounce');
		$rdg->prjidprj = $this->input->post('project');
		$rdg->save($this->db);

		$this->session->set_flashdata('message', formatInfo('Nouvelle règle ajoutée'));

		// Recharge la page avec les nouvelles infos
		redirect('editproject/index/' . $rdg->prjidprj.'#rdg_'.$rdg->rdgidrdg); 
	}
	
	/**
	 * Ajout d'un CDU
	 */
	public function addcdu(){
		// Insertion en base d'un CDU
		$model = new Cdu_model();
		$model->cdulbdes = $this->input->post('description'); 
		$model->cdulbtit = $this->input->post('titre'); 
		$model->cdulbnum = $this->input->post('numero'); 
		$model->prjidprj = $this->input->post('projet'); 
		$model->save($this->db);

		$this->session->set_flashdata('message', formatInfo('Nouveau CDU ajouté'));
		
		// Recharge la page avec les nouvelles infos
		redirect('editproject/index/' . $model->prjidprj.'#cdu_'.$model->cduidcdu); 
	}
	
	/**
	 * Ajout d'un Objet
	 */
	public function addobjet(){
		// Insertion en base d'un Objet
		$model = new Objet_model();
		$model->prjidprj = $this->input->post('projet'); 
		$model->objlblib = $this->input->post('libelle'); 
		$model->objlbdes = $this->input->post('description'); 
		// trigramme non proposé à la création: prendre les 3 premiers caractères du libellé
		$model->objcdtri = strtolower(substr($model->objlblib, 0, 3));
		// code non proposé à la création: prendre le libellé sans espace ni majuscules
		$model->objlbcde = str_replace(" ","", $model->objlblib);
		$model->save($this->db);

		$this->session->set_flashdata('message', formatInfo('Nouvel objet "'.$model->objlblib.'" ajouté'));
		
		// Recharge la page avec les nouvelles infos
		redirect('editproject/index/' . $model->prjidprj.'#obj_'.$model->objidobj); 
	}
	
}
?>
