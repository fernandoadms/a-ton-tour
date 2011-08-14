<?php
/*
 * Created by generator
 *
 */

class Utilisateur_model extends Model {
	
	var $usridusr;
	var $usrcdusr;
	var $usrlbnom;
	var $usrlbprn;
	var $usridser;
	var $usridres;
	
	/**
	 * Constructeur
	 */
	function Utilisateur_model(){
		parent::Model();
		$this->load->helper('utilisateur');
		
	}
	
	/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function Utilisateur_modelFromRow($row){
		$model = new Utilisateur_model();
		$model->usridusr = $row['usridusr'];
		$model->usrcdusr = $row['usrcdusr'];
		$model->usrlbnom = $row['usrlbnom'];
		$model->usrlbprn = $row['usrlbprn'];
		$model->usridser = $row['usridser'];
		$model->usridres = $row['usridres'];
		return $model;
	}

	/**
	 * recupere tous les enregistrements
	 * @param $db connexion a la base de donnees
	 */
	static function getAllUtilisateurs($db){
		$rows = getAllUtilisateursFromDB($db);
		$records = array();
		foreach ($rows as $row) {
			$records[] = Utilisateur_model::Utilisateur_modelFromRow($row);
		}
		return $records;
	}
	
	/**
	 * Recupere l'enregistrement a partir de son id
	 * @param $db database
	 * @param $usridusr identifiant de l'enregistrement a recuperer
	 */
	static function getUtilisateur($db, $usridusr){
		$row = getUtilisateurRow($db, $usridusr);
		return Utilisateur_model::Utilisateur_modelFromRow($row);
	}
	
	/**
	 * Suppression d'un enregistrement
	 * @param $db database
	 * @param $usridusr identifiant de l'enregistrement a supprimer
	 */
	static function delete($db, $usridusr){
		deleteUtilisateur($db, $usridusr);
	}

	/**
	 * Enregistre en base un nouvel enregistrement
	 * @param $db
	 */
	public function save($db){
		$this->usridusr = insertNewUtilisateur($db, $this->usridusr, $this->usrcdusr, $this->usrlbnom, $this->usrlbprn, $this->usridser, $this->usridres);
	}

	/**
	 * Mise a jour des donnees d'un enregistrement
	 * @param db $db
	 */
	public function update($db){
		updateUtilisateur($db, $this->usridusr, $this->usridusr, $this->usrcdusr, $this->usrlbnom, $this->usrlbprn, $this->usridser, $this->usridres);
	}


}

?>
