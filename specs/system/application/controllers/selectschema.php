<?php
/*
 * Created on 18/04/2010
 *
 */

class SelectSchema extends Controller {

	/**
	 * Constructeur
	 */
	function SelectSchema(){
		parent::Controller();
		$this->load->model('Schema_model');
		$this->load->model('RdG_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des schemas
	 */
	public function index($rdgidrdg, $prjidprj = null){
		$data['schemas'] = Schema_model::getAllSchemas($this->db);
		$rdg = RdG_model::getRdG($this->db, $rdgidrdg);
		$data['rdg'] = $rdg;
		if($prjidprj != null){
			$data['prjidprj'] = $prjidprj;
		}else {
			$data['prjidprj'] = '';
		}
		$this->load->view('selectSchema_view', $data);
	}

	/**
	 * Ajout d'un schema
	 */
	public function save(){
		$selectionSchidsch = $this->input->post('selectionSchidsch');
		$rdgidrdg = $this->input->post('rdgidrdg');
		$prjidprj = $this->input->post('prjidprj');
		
		$rdg = RdG_model::getRdG($this->db, $rdgidrdg);
		
		// Affectation des schemas en remplacement des anciens schémas
		$rdg->setSchemasIds($this->db, $selectionSchidsch);
		
		$this->session->set_flashdata('message', formatInfo('Modification enregistrée'));
				
		// Recharge la page avec les nouvelles infos
		if($prjidprj != null && $prjidprj != ''){
			redirect('editrdg/index/'.$rdgidrdg.'/'.$prjidprj);
		}else {
			redirect('editrdg/index/'.$rdgidrdg);
		}
	}


}
?>