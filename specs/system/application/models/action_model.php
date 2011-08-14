<?php
/*
 * Created on 09/05/2010
 *
 */

class Action_model extends Model {

	var $actidact;
	var $actnuord;
	var $actlbact;
	var $scnidscn;

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
		$action = new Action_model();
		$action->actidact = $row['actidact'];
		$action->actnuord = $row['actnuord'];
		$action->actlbact = $row['actlbact'];
		$action->scnidscn = $row['scnidscn'];
		return $action;
	}


	/**
	 * recupere tous les actions
	 * @param $db connexion a la base de donnees
	 */
	static function getAllActions($db){
		$rows = getAllActionsFromDB($db);
		$actions = array();
		foreach ($rows as $row) {
			$actions[] = Action_model::Action_modelFromRow($row);
		}
		return $actions;
	}


	/**
	 * Recupere l'action a partir de son id
	 */
	static function getAction($db, $actidact){
		$row = getActionRow($db, $actidact);
		return Action_model::Action_modelFromRow($row);
	}

	/**
	 * Suppression d'une action
	 * @param $db database
	 * @param $actidact identifiant de l'action à supprimer
	 */
	static function delete($db, $actidact){
		deleteAction($db, $actidact);
	}

	/**
	 * Enregistre en base une nouvelle action
	 * @param $db
	 */
	public function save($db){
		$this->actidact = insertNewAction($db, $this->actnuord, $this->actlbact, $this->scnidscn);
	}
	
	/**
	 * Mise à jour des données d'un scenario
	 * @param db $db
	 */
	public function update($db){
		updateAction($db,$this->actidact, $this->actnuord, $this->actlbact, $this->scnidscn);
	}


}

?>
