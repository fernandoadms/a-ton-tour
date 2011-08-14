<?php
/*
 * Created on 16 août 09
 *
 */

class ListSchemas extends Controller {

	/**
	 * Constructeur
	 */
	function ListSchemas(){
		parent::Controller();
		$this->load->model('Schema_model');
		$this->load->library('session');
		$this->load->helper('template');
		$this->load->helper('url');
	}

	/**
	 * Affichage des schemas
	 */
	public function index(){
		$data['schemas'] = Schema_model::getAllSchemas($this->db);
		$this->load->view('listSchemas_view', $data);
	}

	/**
	 * Ajout d'un schema
	 */
	public function add(){
		// Upload les fichiers
		$config['upload_path'] = realpath('www/schemas/');
		$config['allowed_types'] = 'gif|jpg|png|zip';

		$config['max_size']	= '1000000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		$uploadDataImage = null;
		$data['message'] = "";
		if($this->upload->do_upload('image')){
			$uploadDataImage = $this->upload->data('image');
		}
		$uploadDataSource = null;
		if($this->upload->do_upload('source')){
			$uploadDataSource = $this->upload->data('source');
		}

		// Insertion en base
		$model = new Schema_model();
		$model->setNewVersion($this->input->post('title'), $this->input->post('description'));
		$model->save($this->db,
				$config['upload_path'] . "/",
				$uploadDataImage,
				$uploadDataSource);
				
		$this->session->set_flashdata('message', formatInfo('Nouveau schéma ajouté'));
				
		// Recharge la page avec les nouvelles infos
		redirect('listschemas/index'); 
	}

	/**
	 * Suppression d'un schema
	 * @param $schidsch identifiant du schema à supprimer
	 */
	function delete($schidsch){
		$this->Schema_model->delete($this->db, $schidsch);
		
		$this->session->set_flashdata('message', formatInfo('Schéma supprimé'));
		
		redirect('listschemas/index'); 
	}

}
?>