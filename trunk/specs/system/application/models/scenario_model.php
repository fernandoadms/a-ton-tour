<?php
/*
 * Created on 03/05/2010
 *
 */

class Scenario_model extends Model {

	var $scnidscn;
	var $scntyscn;
	var $scnlbscn;
	var $scnlbres;
	var $cduidcdu;
	public static $typeNOMINAL = "NOMINAL";
	public static $typeALTERNATIF = "ALTERNATIF";
	public static $typeEXCEPTION = "EXCEPTION";

	/**
	 * Constructeur
	 */
	function Scenario_model(){
		parent::Model();
		$this->load->helper('scenario');
		$this->load->helper('action');
		
	}

	/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function Scenario_modelFromRow($row){
		$scenario = new Scenario_model();
		$scenario->scnidscn = $row['scnidscn'];
		$scenario->scntyscn = $row['scntyscn'];
		$scenario->scnlbscn = $row['scnlbscn'];
		$scenario->scnlbres = $row['scnlbres'];
		$scenario->cduidcdu = $row['cduidcdu'];
		return $scenario;
	}


	/**
	 * recupere tous les scenarios
	 * @param $db connexion a la base de donnees
	 */
	static function getAllScenarios($db){
		$rows = getAllScenariosFromDB($db);
		$scenarios = array();
		foreach ($rows as $row) {
			$scenarios[] = Scenario_model::Scenario_modelFromRow($row);
		}
		return $scenarios;
	}


	/**
	 * Recupere le scenario a partir de son id
	 */
	static function getScenario($db, $scnidscn){
		$row = getScenarioRow($db, $scnidscn);
		return Scenario_model::Scenario_modelFromRow($row);
	}

	/**
	 * Suppression d'un scenario
	 * @param $db database
	 * @param $scnidscn identifiant du scenario à supprimer
	 */
	static function delete($db, $scnidscn){
		removeAllActionsForScenario($db, $scnidscn);
		deleteScenario($db, $scnidscn);
	}

	/**
	 * Enregistre en base un nouveau scenario
	 * @param $db
	 */
	public function save($db){
		$this->scnidscn = insertNewScenario($db, $this->scntyscn, $this->scnlbscn, 
			$this->scnlbres, $this->cduidcdu);
	}

	/**
	 * Mise à jour des données d'un scenario
	 * @param db $db
	 */
	public function update($db){
		deleteAllActionsOfScenario($db, $this->scnidscn);
		updateScenario($db,$this->scnidscn, $this->scntyscn, $this->scnlbscn, 
			$this->scnlbres, $this->cduidcdu);
	}

	/**
	 * Force la suppresion des actions
	 * @param db $db
	 */
	public function removeAllActions($db){
		deleteAllActionsOfScenario($db, $this->scnidscn);
	}
	
	/**
	 * Recupere la liste des actions pour un scenario
	 * @param db $db
	 * @return array
	 */
	public function getActions($db) {
		$actions = array();
		$rows = getActionsRowsForScenario($db, $this->scnidscn);
		foreach ($rows as $row) {
			$actions[] = Action_model::Action_modelFromRow($row);
		}
		return $actions;
	}
	
	/**
	 * Retrouve le CDU
	 * @param $db
	 * @return Cdu_model
	 */
	public function getCdu($db){
		return Cdu_model::getCdu($db, $this->cduidcdu);
	}
}

?>
