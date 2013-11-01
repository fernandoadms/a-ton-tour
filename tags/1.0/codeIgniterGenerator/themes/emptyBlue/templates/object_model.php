<?php
/*
 * Created by generator
 *
 */

class %(Name)_model extends Model {
	
	%(listOfVariablesForDeclaration)
	
	/**
	 * Constructeur
	 */
	function %(Name)_model(){
		parent::Model();
		$this->load->helper('%(name_lower)');
		
	}
	
	/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function %(Name)_modelFromRow($row){
		$model = new %(Name)_model();
		%(rowExtraction)
		return $model;
	}

	/**
	 * recupere tous les enregistrements
	 * @param $db connexion a la base de donnees
	 */
	static function getAll%(Name)s($db){
		$rows = getAll%(Name)sFromDB($db);
		$records = array();
		foreach ($rows as $row) {
			$records[] = %(Name)_model::%(Name)_modelFromRow($row);
		}
		return $records;
	}
	
	/**
	 * Recupere l'enregistrement a partir de son id
	 * @param $db connexion a la base de donnees
	 * @param $%(keyVariable) identifiant de l'enregistrement a recuperer
	 */
	static function get%(Name)($db, $%(keyVariable)){
		$row = get%(Name)Row($db, $%(keyVariable));
		return %(Name)_model::%(Name)_modelFromRow($row);
	}
	
	/**
	 * Suppression d'un enregistrement
	 * @param $db connexion a la base de donnees
	 * @param $%(keyVariable) identifiant de l'enregistrement a supprimer
	 */
	static function delete($db, $%(keyVariable)){
		delete%(Name)($db, $%(keyVariable));
	}

	/**
	 * Enregistre en base un nouvel enregistrement
	 * @param $db connexion a la base de donnees
	 */
	public function save($db){
		$this->%(keyVariable) = insertNew%(Name)($db, %(listOfVariablesForMethodSave));
	}

	/**
	 * Mise a jour des donnees d'un enregistrement
	 * @param $db connexion a la base de donnees
	 */
	public function update($db){
		update%(Name)($db, %(listOfVariablesForMethodUpdate));
	}

	
	/***************************************************************************
	 * USER DEFINED FUNCTIONS
	 ***************************************************************************/

}

?>
