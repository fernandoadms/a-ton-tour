<?php
/*
 * Created by generator
 *
 */

class Cdu_model extends Model {
	
	var $cduidcdu;
	var $cdulbdes;
	var $cdulbtit;
	var $cdulbnum;
	var $prjidprj;
	var $prjlbtit;
	
	/**
	 * Constructeur
	 */
	function Cdu_model(){
		parent::Model();
		$this->load->helper('cdu');
		$this->load->model('RdG_model');
		$this->load->model('Scenario_model');
		
	}
	
	/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function Cdu_modelFromRow($row){
		$model = new Cdu_model();
		$model->cduidcdu = $row['cduidcdu'];
		$model->cdulbdes = $row['cdulbdes'];
		$model->cdulbtit = $row['cdulbtit'];
		$model->cdulbnum = $row['cdulbnum'];
		$model->prjidprj = $row['prjidprj'];
		$model->prjlbtit = $row['prjlbtit'];
		return $model;
	}

	/**
	 * recupere tous les enregistrements
	 * @param $db 
	 */
	static function getAllCdus($db){
		$rows = getAllCdusFromDB($db);
		$records = array();
		foreach ($rows as $row) {
			$records[] = Cdu_model::Cdu_modelFromRow($row);
		}
		return $records;
	}
	
	/**
	 * Recupere tous les enregistrements pour un projet
	 * @param $db 
	 * @return Cdu_model[]
	 */
	static function getAllCdusForProject($db, $prjidprj){
		$rows = getAllCdusFromDBForProject($db, $prjidprj);
		$records = array();
		foreach ($rows as $row) {
			$records[] = Cdu_model::Cdu_modelFromRow($row);
		}
		return $records;
	}
	
	/**
	 * Recupere l'enregistrement a partir de son id
	 * @param $db 
	 * @param $cduidcdu 
	 */
	static function getCdu($db, $cduidcdu){
		$row = getCduRow($db, $cduidcdu);
		return Cdu_model::Cdu_modelFromRow($row);
	}
	
	/**
	 * Suppression d'un enregistrement
	 * @param $db 
	 * @param $cduidcdu
	 */
	static function delete($db, $cduidcdu){
		deleteCdu($db, $cduidcdu);
	}

	/**
	 * Enregistre en base un nouvel enregistrement
	 * @param $db
	 */
	public function save($db){
		$this->cduidcdu = insertNewCdu($db, $this->cdulbdes, $this->cdulbtit, $this->cdulbnum, $this->prjidprj);
	}

	/**
	 * Mise a jour des donnees d'un enregistrement
	 * @param $db
	 */
	public function update($db){
		updateCdu($db, $this->cduidcdu, $this->cdulbdes, $this->cdulbtit, $this->cdulbnum, $this->prjidprj);
	}

	/************************************************************************
	 * Methodes d'accès aux autres objets
	 ************************************************************************/
	/**
	 * Recupere les règles de gestions du CDU
	 * @param $db
	 * @return array
	 */
	public function getAllRdgs($db){
		$allRdgIds = getRdgIdsOfCduFromDB($db, $this->cduidcdu);
		$allRdg = array();
		foreach($allRdgIds as $rdgidrdg) {
			$allRdg[] = Rdg_model::getRdG($db, $rdgidrdg);
		}
		return $allRdg;
	}
	/**
	 * Recupere tous les scenarios du CDU
	 * @param $db
	 * @return array
	 */
	public function getAllScenarios($db) {
		$allScenariosIds = getScenarioIdsOfCduFromDB($db, $this->cduidcdu);
		$allScenarios = array();
		foreach($allScenariosIds as $scnidscn) {
			$allScenarios[] = Scenario_model::getScenario($db, $scnidscn);
		}
		return $allScenarios;
	}
	
	/**
	 * Retourne VRAI si le CDU inclu la règle de gestion
	 * @param $db
	 * @param $rdgidrdg
	 * @return boolean
	 */
	public function includesRdg($db, $rdgidrdg){
		$allRdgIds = getRdgIdsOfCduFromDB($db, $this->cduidcdu);
		foreach($allRdgIds as $cdu_rdgidrdg){
			if( (int)$cdu_rdgidrdg == (int)$rdgidrdg ){
				return true;
			}
		}
		return false;
	} 

	/**
	 * Affecte la liste de règles au CDU
	 * @param $db
	 * @param $arrayOfRdgidrdg
	 */
	public function setRdgIds($db, $arrayOfRdgidrdg){
		removeRowLinkCduAndAllRdg($db, $this->cduidcdu); 
		
		addRowLinkCduToRdg($db, $this->cduidcdu, $arrayOfRdgidrdg); 
		
	}
}

?>
