%[kind : controllers]
%[file : list%%(self.obName.lower())%%s.php] 
%[path : controllers]
<?php
/*
 * Created by generator
 *
 */

class List%%(self.obName)%%s extends CI_Controller {

	/**
	 * Constructeur
	 */
	function __construct(){
		parent::__construct();
		$this->load->model('%%(self.obName)%%_model');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->helper('url');
		$this->load->database();
%%allAttributeCode = ""
# inclure les modeles des objets référencés

for field in self.fields:
	attributeCode = ""
	if field.referencedObject:
		attributeCode += """
		$this->load->model('%s_model');""" % field.referencedObject.obName
	allAttributeCode += attributeCode
	
RETURN = allAttributeCode
%%

	}

	/**
	 * Affichage des %%(self.obName)%%s
	 */
	public function index($orderBy = null, $asc = null, $offset = 0){
		// preparer le tri
		if($orderBy == null) {
			$orderBy = '%%(self.keyFields[0].dbName)%%';
		}
		if($asc == null) {
			$asc = 'asc';
		}
		$data['orderBy'] = $orderBy;
		$data['asc'] = $asc;
		
		// preparer la pagination
		$config['base_url'] = base_url().'index.php/list%%(self.obName.lower())%%s/index/'.$orderBy.'/'.$asc.'/';
		$config['total_rows'] = %%(self.obName)%%_model::getCount%%(self.obName)%%s($this->db);
		$config['per_page'] = 15;
		$config['cur_tag_open'] = '<td class="currentPage">';
		$config['cur_tag_close'] = '</td>';
		$config['num_tag_open'] = '<td class="numPage">';
		$config['num_tag_close'] = '</td>';
		$config['prev_tag_open'] = '<td class="page-left">';
		$config['prev_tag_close'] = '</td>';
		$config['next_tag_open'] = '<td class="page-right">';
		$config['next_tag_close'] = '</td>';
		$config['uri_segment'] = '5'; // where the page number is in the URI segment 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination;
		
		// recuperation des donnees
		$data['%%(self.obName.lower())%%s'] = %%(self.obName)%%_model::getAll%%(self.obName)%%s($this->db, $orderBy, $asc, $config['per_page'], $offset);
		%%allAttributeCode = ""
# inclure les objets référencés dans l'objet $data

for field in self.fields:
	attributeCode = ""
	if field.referencedObject:
		attributeCode += """
		$data['%(referencedObjectLower)sCollection'] = %(referencedObject)s_model::getAll%(referencedObject)ss($this->db);""" % {
			'referencedObjectLower' : field.referencedObject.obName.lower(),
			'referencedObject' : field.referencedObject.obName
		}
	allAttributeCode += attributeCode
	
RETURN = allAttributeCode
%%
		
		$this->load->view('list%%(self.obName.lower())%%s_view', $data);
	}

	/**
	 * Ajout d'un %%(self.obName)%%
	 */
	public function add(){

		// Insertion en base
		$model = new %%(self.obName)%%_model();
		%%
includesKey = True;
RETURN = self.dbAndObVariablesList("$model->(dbVar)s = $this->input->post('(dbVar)s'); ", 'dbVar', 'obVar', 2, includesKey)
%%
		$model->save($this->db);

		$this->session->set_flashdata('msg_info', 'Nouveau %%(self.obName)%% ajoute');
		
		// Recharge la page avec les nouvelles infos
		redirect('list%%(self.obName.lower())%%s/index'); 
	}

	/**
	 * Suppression d'un %%(self.obName)%%
	 * @param $%%(self.keyFields[0].dbName)%% identifiant a supprimer
	 */
	function delete($%%(self.keyFields[0].dbName)%%){
		%%(self.obName)%%_model::delete($this->db, $%%(self.keyFields[0].dbName)%%);

		$this->session->set_flashdata('msg_confirm', '%%(self.obName)%% supprime');

		redirect('list%%(self.obName.lower())%%s/index'); 
	}

}
?>
