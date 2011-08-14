<?php
/*
 * Created by generator
 *
 */

class User_model extends Model {
	
	var $usridusr;
	var $usrlbnom;
	var $usrlblgn;
	var $usrlbpwd;
	
	/**
	 * Constructeur
	 */
	function User_model(){
		parent::Model();
		$this->load->helper('user');
		$this->load->model('Project_model');
	}
	
	/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function User_modelFromRow($row){
		$model = new User_model();
		$model->usridusr = $row['usridusr'];
		$model->usrlbnom = $row['usrlbnom'];
		$model->usrlblgn = $row['usrlblgn'];
		$model->usrlbpwd = $row['usrlbpwd'];
		return $model;
	}

	/**
	 * recupere tous les enregistrements
	 * @param $db connexion a la base de donnees
	 */
	static function getAllUsers($db){
		$rows = getAllUsersFromDB($db);
		$records = array();
		foreach ($rows as $row) {
			$records[] = User_model::User_modelFromRow($row);
		}
		return $records;
	}
	
	/**
	 * Recupere l'enregistrement a partir de son id
	 * @param $db database
	 * @param $usridusr identifiant de l'enregistrement a recuperer
	 */
	static function getUser($db, $usridusr){
		$row = getUserRow($db, $usridusr);
		return User_model::User_modelFromRow($row);
	}
	
	/**
	 * Test de connexion
	 * @param $db database
	 * @param $usrlblgn login
	 * @param $usrlblgn login
	 */
	static function connectUser($db, $usrlblgn, $usrlbpwd){
		$row = connectUserRow($db, $usrlblgn, $usrlbpwd);
		if( $row == null ){
			return null;
		}
		return User_model::User_modelFromRow($row);
	}
	
	/**
	 * Suppression d'un enregistrement
	 * @param $db database
	 * @param $usridusr identifiant de l'enregistrement a supprimer
	 */
	static function delete($db, $usridusr){
		deleteUser($db, $usridusr);
	}

	/**
	 * Enregistre en base un nouvel enregistrement
	 * @param $db
	 */
	public function save($db){
		$this->usridusr = insertNewUser($db, $this->usrlbnom, $this->usrlblgn, $this->usrlbpwd);
	}

	/**
	 * Mise a jour des donnees d'un enregistrement
	 * @param $db
	 */
	public function update($db){
		updateUser($db, $this->usridusr, $this->usrlbnom, $this->usrlblgn, $this->usrlbpwd);
	}
	
	/* ************************************************
	 * liens avec les projets
	 * ************************************************/

	/**
	 * Liste des projets d'un user
	 * @param $db
	 * @return array(Project_model)
	 */
	public function getProjects($db){
		$ids = getUserProjectIds($db, $this->usridusr);
		$allProjects = array();
		foreach($ids as $projectId){
			$allProjects[] = Project_model::getProject($db, $projectId);
		}
		return $allProjects;
	}
	
	/**
	 * Teste si un acteur a un projet
	 * @param $db
	 * @param $prjidprj
	 */
	public function hasProjectId($db, $prjidprj){
		$ids = getUserProjectIds($db, $this->usridusr);
		return in_array($prjidprj, $ids);
	}
	
	/**
	 * affectation des projets à l'acteur
	 * @param $db
	 * @param $projectIds
	 */
	public function setProjects($db, $projectIds){
		removeAllUserProjectLinks($db, $this->usridusr);
		insertAllUserProjectLinks($db, $this->usridusr, $projectIds);
	}

}

?>
