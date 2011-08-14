<?php
/*
 * Created on 29 juil. 09
 *
 */

class EditSchema extends Controller {

	function EditSchema(){
		parent::Controller();
		$this->load->model('Schema_model');
		$this->load->helper('url');
		$this->load->library('session');
	}


	/**
	 * Affichage des infos du schema
	 */
	public function index($schidsch){
		$schema = $this->Schema_model->getSchema($this->db, $schidsch);
		$data['schema'] = $schema;

		$this->load->view('editSchema_view',$data);

	}

	/**
	 * Sauvegarde les modifications d'un schéma
	 */
	public function save(){
		// Upload les fichiers
		$config['upload_path'] = realpath('www/schemas/');
		$config['allowed_types'] = 'gif|jpg|png|zip';

		$config['max_size']	= '1000000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		$uploadDataImage = null;
		if($this->upload->do_upload('image')){
			$uploadDataImage = $this->upload->data('image');
		}
		$uploadDataSource = null;
		if($this->upload->do_upload('source')){
			$uploadDataSource = $this->upload->data('source');
		}

		// Mise à jour des données en base
		$model = new Schema_model();
		$model->schidsch = $this->input->post('schidsch');
		$model->schlbtit = $this->input->post('title');
		$model->schlbdes = $this->input->post('description');
		$model->update($this->db,
				$config['upload_path'] . "/",
				$uploadDataImage,
				$uploadDataSource);

		redirect('listschemas/index'); 
	}

}
?>
