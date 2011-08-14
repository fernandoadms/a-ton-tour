<?php
/*
 * Created by generator
 *
 */

class Login_model extends Model {
	
	var $lgnidlgn;
	var $lgnidusr;
	var $lgnlblgn;
	var $lgnlbpwd;
	var $lgncdprf;
	var $lgnfgarc;
	
	/**
	 * Constructeur
	 */
	function Login_model(){
		parent::Model();
		$this->load->helper('login');
		
	}
	
	/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function Login_modelFromRow($row){
		$model = new Login_model();
		$model->lgnidlgn = $row['lgnidlgn'];
		$model->lgnidusr = $row['lgnidusr'];
		$model->lgnlblgn = $row['lgnlblgn'];
		$model->lgnlbpwd = $row['lgnlbpwd'];
		$model->lgncdprf = $row['lgncdprf'];
		$model->lgnfgarc = $row['lgnfgarc'];
		return $model;
	}

	/**
	 * recupere tous les enregistrements
	 * @param $db connexion a la base de donnees
	 */
	static function getAllLogins($db){
		$rows = getAllLoginsFromDB($db);
		$records = array();
		foreach ($rows as $row) {
			$records[] = Login_model::Login_modelFromRow($row);
		}
		return $records;
	}
	
	/**
	 * Recupere l'enregistrement a partir de son id
	 * @param $db database
	 * @param $lgnidlgn identifiant de l'enregistrement a recuperer
	 */
	static function getLogin($db, $lgnidlgn){
		$row = getLoginRow($db, $lgnidlgn);
		return Login_model::Login_modelFromRow($row);
	}
	
	/**
	 * Suppression d'un enregistrement
	 * @param $db database
	 * @param $lgnidlgn identifiant de l'enregistrement a supprimer
	 */
	static function delete($db, $lgnidlgn){
		deleteLogin($db, $lgnidlgn);
	}

	/**
	 * Enregistre en base un nouvel enregistrement
	 * @param $db
	 */
	public function save($db){
		$this->lgnidlgn = insertNewLogin($db, $this->lgnidlgn, $this->lgnidusr, $this->lgnlblgn, $this->lgnlbpwd, $this->lgncdprf, $this->lgnfgarc);
	}

	/**
	 * Mise a jour des donnees d'un enregistrement
	 * @param db $db
	 */
	public function update($db){
		updateLogin($db, $this->lgnidlgn, $this->lgnidlgn, $this->lgnidusr, $this->lgnlblgn, $this->lgnlbpwd, $this->lgncdprf, $this->lgnfgarc);
	}


}

?>
