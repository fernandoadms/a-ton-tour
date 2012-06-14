%[kind : controllers]
%[file : edit%%(self.obName.lower())%%.php] 
%[path : controllers]
<?php
/*
 * Created by generator
 *
 */

class Edit%%(self.obName)%% extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('%%(self.obName)%%_model');
		$this->load->library('session');
		$this->load->helper('template');
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
	 * Affichage des infos
	 */
	public function index($%%(self.keyFields[0].dbName)%%){
		$model = %%(self.obName)%%_model::get%%(self.obName)%%($this->db, $%%(self.keyFields[0].dbName)%%);
		$data['%%(self.obName.lower())%%'] = $model;
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

		$this->load->view('edit%%(self.obName.lower())%%_view',$data);
	}

	/**
	 * Sauvegarde des modifications
	 */
	public function save(){
		// Mise a jour des donnees en base
		$model = new %%(self.obName)%%_model();
		$oldModel = %%(self.obName)%%_model::get%%(self.obName)%%($this->db, $this->input->post('%%(self.keyFields[0].dbName)%%') );
		%%
codeForAttributes = ""
for field in self.fields:
	codeForField = """
		$model->%(dbName)s = $this->input->post('%(dbName)s');""" % {'dbName' : field.dbName }
	codeForAttributes += codeForField
RETURN = codeForAttributes
%%
		$model->update($this->db);
		
%%codeForUploadFile = ""
useUpload = False
for field in self.fields:
	attributeCode = ""
	if field.sqlType.upper() == "FILE":
		useUpload = True
		attributeCode += """
		// Suppression de l'ancien fichier %(dbName)s : %(desc)s
		if( $oldModel->%(dbName)s != "" && $model->%(dbName)s == ""){
			unlink($path . $oldModel->%(dbName)s);
		}
		// Upload du nouveau fichier %(dbName)s : %(desc)s
		$uploadDataFile_%(dbName)s = null;
		if( $this->upload->do_upload('%(dbName)s_file')){
			$uploadDataFile_%(dbName)s = $this->upload->data('%(dbName)s_file');
		} else {
			// erreur
			if( $this->input->post('%(dbName)s_file') != "" ){
				$this->session->set_flashdata('msg_error', $this->upload->display_errors());
			}
		}
		if($uploadDataFile_%(dbName)s != null) {
			$model->%(dbName)s = '%(obName)s_%(dbName)s_' . $model->%(keyField)s . '_file' . $uploadDataFile_%(dbName)s['file_ext'];
			rename($path . $uploadDataFile_%(dbName)s['file_name'], $path . $model->%(dbName)s);
			// suppression du fichier temporaire téléchargée
			unlink($path . $uploadDataFile_%(dbName)s['file_name']);
			$model->update($this->db);
		}""" % {'dbName' : field.dbName, 
			'desc' : field.description, 
			'obName' : self.obName,
			'keyField' : self.keyFields[0].dbName
		}
	codeForUploadFile += attributeCode

if useUpload:
	codeForUploadFile = """
		// Configuration pour chargement des fichiers 
		$config['upload_path'] = realpath('www/uploads/');
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$this->load->library('upload', $config);
		$path = $config['upload_path'] . "/";
""" + codeForUploadFile
		
RETURN = codeForUploadFile
%%
		$this->session->set_flashdata('msg_confirm', '%%(self.obName)%% mis a jour');

		redirect('list%%(self.obName.lower())%%s/index');
	}

}
?>
