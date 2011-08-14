<?php
/*
 * Created by generator
 *
 */

class Etat_model extends Model {
	
	var $etacdeta;
	var $etalbeta;
	var $etacdact;
	
	/**
	 * Constructeur
	 */
	function Etat_model(){
		parent::Model();
		$this->load->helper('etat');
		
	}
	
	/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function Etat_modelFromRow($row){
		$model = new Etat_model();
		$model->etacdeta = $row['etacdeta'];
		$model->etalbeta = $row['etalbeta'];
		$model->etacdact = $row['etacdact'];
		return $model;
	}

	/**
	 * recupere tous les enregistrements
	 * @param $db connexion a la base de donnees
	 */
	static function getAllEtats($db){
		$rows = getAllEtatsFromDB($db);
		$records = array();
		foreach ($rows as $row) {
			$records[] = Etat_model::Etat_modelFromRow($row);
		}
		return $records;
	}
	
	/**
	 * Recupere l'enregistrement a partir de son id
	 * @param $db database
	 * @param $etacdeta identifiant de l'enregistrement a recuperer
	 */
	static function getEtat($db, $etacdeta){
		$row = getEtatRow($db, $etacdeta);
		return Etat_model::Etat_modelFromRow($row);
	}
	
	/**
	 * Suppression d'un enregistrement
	 * @param $db database
	 * @param $etacdeta identifiant de l'enregistrement a supprimer
	 */
	static function delete($db, $etacdeta){
		deleteEtat($db, $etacdeta);
	}

	/**
	 * Enregistre en base un nouvel enregistrement
	 * @param $db
	 */
	public function save($db){
		$this->etacdeta = insertNewEtat($db, $this->etacdeta, $this->etalbeta, $this->etacdact);
	}

	/**
	 * Mise a jour des donnees d'un enregistrement
	 * @param db $db
	 */
	public function update($db){
		updateEtat($db, $this->etacdeta, $this->etalbeta, $this->etacdact);
	}


}

?>
