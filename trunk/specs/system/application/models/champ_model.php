<?php
/*
 * Created by generator
 *
 */

class Champ_model extends Model {
	
	/**
	 * identifiant
	 * @var int 
	 */
	var $chpidchp; 
	
	/**
	 * code
	 * @var string
	 */
	var $chplbcde;
	
	/**
	 * nom
	 * @var String
	 */
	var $chplbnom;
	
	/**
	 * flag nullable
	 * @var int
	 */
	var $chpfgnul; 
	
	/**
	 * type
	 * @var string
	 */
	var $chpcdtyp;
	
	/**
	 * description
	 * @var string
	 */
	var $chplbdes;
	
	/**
	 * id de l'objet
	 * @var int
	 */
	var $objidobj;
	
	/**
	 * Constructeur
	 */
	function Champ_model(){
		parent::Model();
		$this->load->helper('champ');
		$this->load->helper('htmlEncoding');
		
	}
	
	/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function Champ_modelFromRow($row){
		$model = new Champ_model();
		$model->chpidchp = $row['chpidchp'];
		$model->chplbcde = $row['chplbcde'];
		$model->chplbnom = $row['chplbnom'];
		$model->chpfgnul = $row['chpfgnul'];
		$model->chpcdtyp = $row['chpcdtyp'];
		$model->chplbdes = $row['chplbdes'];
		$model->objidobj = $row['objidobj'];
		return $model;
	}

	/**
	 * recupere tous les enregistrements
	 * @param $db connexion a la base de donnees
	 */
	static function getAllChamps($db){
		$rows = getAllChampsFromDB($db);
		$records = array();
		foreach ($rows as $row) {
			$records[] = Champ_model::Champ_modelFromRow($row);
		}
		return $records;
	}
	
	/**
	 * Recupere l'enregistrement a partir de son id
	 * @param $db database
	 * @param $chpidchp identifiant de l'enregistrement a recuperer
	 */
	static function getChamp($db, $chpidchp){
		$row = getChampRow($db, $chpidchp);
		return Champ_model::Champ_modelFromRow($row);
	}
	
	/**
	 * Suppression d'un enregistrement
	 * @param $db database
	 * @param $chpidchp identifiant de l'enregistrement a supprimer
	 */
	static function delete($db, $chpidchp){
		deleteChamp($db, $chpidchp);
	}

	/**
	 * Enregistre en base un nouvel enregistrement
	 * @param $db
	 */
	public function save($db){
		if( $this->chpfgnul == null ){
			$this->chpfgnul = "N";
		}
		
		$this->chpidchp = insertNewChamp($db, $this->chplbcde, $this->chplbnom, $this->chpfgnul, $this->chpcdtyp, $this->chplbdes, $this->objidobj);
	}

	/**
	 * Mise a jour des donnees d'un enregistrement
	 * @param db $db
	 */
	public function update($db){
		updateChamp($db, $this->chpidchp, $this->chplbcde, $this->chplbnom, $this->chpfgnul, $this->chpcdtyp, $this->chplbdes, $this->objidobj);
	}

	
	/***************************************************************************
	 * USER DEFINED FUNCTIONS
	 ***************************************************************************/
	
	public function estNullable(){
		return $this->chpfgnul == 'O';
	}
	
	/**
	 * Retourne le champ en String au format XML
	 * @return string
	 */
	public function exportXML($trigrammeObjet){
		$xlmlString = "	<attribute id=\"".$trigrammeObjet.$this->chplbcde."\" ".
			"name=\"".$this->chplbnom."\" ";
		
		if( $this->estNullable() ) {
			$xlmlString .= "nullable=\"YES\" ";
		}else {
			$xlmlString .= "nullable=\"NO\" ";
		}
		
		$xlmlString .= "type=\"".$this->chpcdtyp."\">\n".
			"		<description>".removeHTML($this->chplbdes)."</description>\n".
			"	</attribute>\n";
		return $xlmlString;
	}
}

?>
