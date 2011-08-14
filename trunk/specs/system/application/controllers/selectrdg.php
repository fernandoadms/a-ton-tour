<?php
/*
 * Created on 18/04/2010
 *
 */

class SelectRdg extends Controller {

	/**
	 * Constructeur
	 */
	function SelectRdg(){
		parent::Controller();
		$this->load->model('Cdu_model');
		$this->load->model('RdG_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des regles de gestion
	 */
	public function index($cduidcdu, $prjidprj = null){
		$cdu = Cdu_model::getCdu($this->db, $cduidcdu);
		$data['rdgs'] = RdG_model::getAllRdGForProject($this->db, $cdu->prjidprj);
		$data['cdu'] = $cdu;
		if( $prjidprj != null ){
			$data['prjidprj'] = $prjidprj;
		}
		$this->load->view('selectRdg_view', $data);
	}

	/**
	 * Ajout d'une regle de gestion
	 */
	public function save(){
		$selectionRdgidrdg = $this->input->post('selectionRdgidrdg');
		$cduidcdu = $this->input->post('cduidcdu');
		$cdu = Cdu_model::getCdu($this->db, $cduidcdu);
		
		// Affectation des règles de gestion en remplacement des anciens schémas
		$cdu->setRdgIds($this->db, $selectionRdgidrdg);
		
		$this->session->set_flashdata('message', formatInfo('Modification enregistrée'));
		
		// Recharge la page avec les nouvelles infos
		if( $this->input->post('prjidprj') != null &&  $this->input->post('prjidprj') != ""){
			redirect('editcdu/index/'.$cduidcdu.'/'.$this->input->post('prjidprj')); 
		}else {
			redirect('editcdu/index/'.$cduidcdu); 
		}
		
		
	}


}
?>