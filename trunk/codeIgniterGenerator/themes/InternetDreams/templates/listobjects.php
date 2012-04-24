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
		$config['first_link'] = '&lt;&lt;';
		$config['first_tag_open'] = '<td class="page-right">';
		$config['first_tag_close'] = '</td>';		
		$config['last_link'] = '&gt;&gt;';
		$config['last_tag_open'] = '<td class="page-left">';
		$config['last_tag_close'] = '</td>';	
		$config['num_links'] = 5;
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
		attributeCode = """
		$data['%(referencedObjectLower)sCollection'] = %(referencedObject)s_model::getAll%(referencedObject)ss($this->db);""" % {
			'referencedObjectLower' : field.referencedObject.obName.lower(),
			'referencedObject' : field.referencedObject.obName
		}
	elif field.sqlType.upper()[0:4] == "ENUM":
		enumTypes = field.sqlType[5:-1]
		attributeCode = """
		$data["enum_%(dbName)s"] = array( """ % {'dbName' : field.dbName}
		for enum in enumTypes.split(','):
			valueAndText = enum.replace('"','').replace("'","").split(':')
			attributeCode += """"%(value)s" => "%(text)s",""" % {'value': valueAndText[0].strip(), 'text': valueAndText[1].strip()}
		attributeCode = attributeCode[:-1] + ");"
	if attributeCode != "":
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
%%codeForUploadFile = ""
useUpload = False
for field in self.fields:
	attributeCode = ""
	if field.sqlType.upper() == "FILE":
		useUpload = True
		attributeCode += """
		// Upload du fichier %(dbName)s : %(desc)s
		$uploadDataFile_%(dbName)s = null;
		if( $this->input->post('%(dbName)s_file') != "" && $this->upload->do_upload('%(dbName)s_file')){
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
			// suppression de l'image téléchargée
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
