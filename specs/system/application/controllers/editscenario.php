<?php
/*
 * Created on 04/05/2010
 *
 */

class EditScenario extends Controller {

	function EditScenario(){
		parent::Controller();
		$this->load->model('Scenario_model');
		$this->load->model('Action_model');
		$this->load->model('Cdu_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}


	/**
	 * Affichage des infos de la règle de gestion
	 */
	public function index($scnidscn){
		$scenario = Scenario_model::getScenario($this->db, $scnidscn);
		$data['scenario'] = $scenario;
		$data['cdus'] = Cdu_model::getAllCdus($this->db);
		$data['prjidprj'] = $scenario->getCdu($this->db)->prjidprj;
		
		$this->load->view('editScenario_view',$data);
	}
	
	/**
	 * propose un nouveau formulaire avec le CDU proposé par défaut
	 * @param $cduidcdu
	 */
	public function create($cduidcdu, $prjidprj){
		$data['cdu'] = Cdu_model::getCdu($this->db, $cduidcdu);
		$data['prjidprj'] = $prjidprj;
		$scenario = new Scenario_model();
		$scenario->cduidcdu = $cduidcdu;
		$data['scenario'] = $scenario;
		$this->load->view('editScenario_view',$data);
	}

	/**
	 * Sauvegarde les modifications d'un scenario
	 */
	public function save(){
		if(  $this->input->post('scnidscn') == "" ){
			// creation d'un nouveau scenario
			$model = new Scenario_model();
			$model->scntyscn = $this->input->post('type');
			$model->scnlbscn = $this->input->post('label');
			$model->scnlbres = $this->input->post('result');
			$model->cduidcdu = $this->input->post('cdu');
			$model->save($this->db);
			
			$actions = $this->input->post('actions');
			foreach ($actions as $i => $value) {
				$action = new Action_model();
				$action->actnuord = $i;
				$action->actlbact = $value;
				$action->scnidscn = $model->scnidscn;
				$action->save($this->db);
			}
			
			$this->session->set_flashdata('message', formatInfo('Nouveau scénario ajouté'));
			
		} else {
			// mise à jour du scenario
			
			$model = new Scenario_model();
			$model->scnidscn = $this->input->post('scnidscn');
			$model->scnlbscn = $this->input->post('label');
			$model->scntyscn = $this->input->post('type');
			$model->scnlbres = $this->input->post('result');
			$model->cduidcdu = $this->input->post('cdu');
			$model->update($this->db);
	
			$model->removeAllActions($this->db);
			$actions = $this->input->post('actions');
			foreach ($actions as $i => $value) {
				$action = new Action_model();
				$action->actnuord = $i;
				$action->actlbact = $value;
				$action->scnidscn = $model->scnidscn;
				$action->save($this->db);
			}
			
			$this->session->set_flashdata('message', formatInfo('Scenario "'.$model->scnlbscn.'" mis à jour'));
			
		}
		
		$prjidprj = $this->input->post('prjidprj');
		redirect('editcdu/index/'.$model->cduidcdu . '/'. $prjidprj);
		

	}

}
?>
