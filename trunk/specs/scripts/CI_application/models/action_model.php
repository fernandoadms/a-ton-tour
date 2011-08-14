<?php
/*
 * Created by generator
 *
 */

class Action_model extends Model {
	
	var $actidact;
	var $actidpro;
	var $actlbtit;
	var $actnupri;
	var $actdtcre;
	var $actdtdem;
	var $actdteci;
	var $actdtecp;
	var $actdtecr;
	var $actfgcac;
	
	/**
	 * Constructeur
	 */
	function Action_model(){
		parent::Model();
		$this->load->helper('action');
		
	}
	
	/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function Action_modelFromRow($row){
		$model = new Action_model();
		$model->actidact = $row['actidact'];
		$model->actidpro = $row['actidpro'];
		$model->actlbtit = $row['actlbtit'];
		$model->actnupri = $row['actnupri'];
		$model->actdtcre = fromSQLDate($row['actdtcre']);
		$model->actdtdem = fromSQLDate($row['actdtdem']);
		$model->actdteci = fromSQLDate($row['actdteci']);
		$model->actdtecp = fromSQLDate($row['actdtecp']);
		$model->actdtecr = fromSQLDate($row['actdtecr']);
		$model->actfgcac = $row['actfgcac'];
		return $model;
	}

	/**
	 * recupere tous les enregistrements
	 * @param $db connexion a la base de donnees
	 */
	static function getAllActions($db){
		$rows = getAllActionsFromDB($db);
		$records = array();
		foreach ($rows as $row) {
			$records[] = Action_model::Action_modelFromRow($row);
		}
		return $records;
	}
	
	/**
	 * Recupere l'enregistrement a partir de son id
	 * @param $db database
	 * @param $actidact identifiant de l'enregistrement a recuperer
	 */
	static function getAction($db, $actidact){
		$row = getActionRow($db, $actidact);
		return Action_model::Action_modelFromRow($row);
	}
	
	/**
	 * Suppression d'un enregistrement
	 * @param $db database
	 * @param $actidact identifiant de l'enregistrement a supprimer
	 */
	static function delete($db, $actidact){
		deleteAction($db, $actidact);
	}

	/**
	 * Enregistre en base un nouvel enregistrement
	 * @param $db
	 */
	public function save($db){
		$this->actidact = insertNewAction($db, $this->actidpro, $this->actlbtit, $this->actnupri, toSQLDate($this->actdtcre), toSQLDate($this->actdtdem), toSQLDate($this->actdteci), toSQLDate($this->actdtecp), toSQLDate($this->actdtecr), $this->actfgcac);
	}

	/**
	 * Mise a jour des donnees d'un enregistrement
	 * @param db $db
	 */
	public function update($db){
		updateAction($db, $this->actidact, $this->actidact, $this->actidpro, $this->actlbtit, $this->actnupri, toSQLDate($this->actdtcre), toSQLDate($this->actdtdem), toSQLDate($this->actdteci), toSQLDate($this->actdtecp), toSQLDate($this->actdtecr), $this->actfgcac);
	}

	
	/***************************************************************************
	 * USER DEFINED FUNCTIONS
	 ***************************************************************************/

}

?>
