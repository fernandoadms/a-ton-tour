<?php
/*
 * Created on 20/04/2010
 *
 */

class Project_model extends Model {

	var $prjidprj;
	var $prjlbtit;
	var $prjlbdes;
	var $rdgs;


	/**
	 * Constructeur
	 */
	function Project_model(){
		parent::Model();
		$this->load->helper('project');
		$this->load->model('RdG_model');
		$this->load->model('Cdu_model');
		$this->load->model('Objet_model');
	}
	

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 * @param array $row Enregistrement de base de donnees
	 * @return Project_model
	 */
	static function Project_modelFromRow($row){
		$project = new Project_model();
		$project->prjidprj = $row['prjidprj'];
		$project->prjlbtit = $row['prjlbtit'];
		$project->prjlbdes = $row['prjlbdes'];
		$project->rdgs = null;
		return $project;
	}
	
	/**
	 * recupere tous les projets
	 * @param $db 
	 * @return Project_model[]
	 */
	static function getAllProjects($db, $usridusr = null){
		$rows = getAllProjectsFromDB($db, $usridusr);
		$projects = array();
		foreach ($rows as $row) {
			$projects[] = Project_model::Project_modelFromRow($row);
		}
		return $projects;
	}
	
	/**
	 * Suppression d'un projet
	 * @param $db database
	 * @param $prjidprj identifiant du projet à supprimer
	 */
	static function delete($db, $prjidprj){
		
		//TODO Savoir s'il faut aussi supprimer les règles de gestion et les CDU
		deleteProject($db, $prjidprj);
	}
	
	/**
	 * Retourne l'objet à partir de l'identifiant
	 * @param $db
	 * @param $rdgidrdg
	 * @return Project_model
	 */
	static function getProject($db, $prjidprj) {
		$row = getProjectRow($db, $prjidprj);
		return Project_model::Project_modelFromRow($row);
	}
	
	/************************************************************************
	 * Méthodes d'instance
	 ************************************************************************/
	
	/**
	 * Sauvegarde des données d'un nouveau projet
	 * @param $db
	 */
	public function save($db){
		$this->prjidprj = insertNewProject($db, $this->prjlbtit, $this->prjlbdes);
	}
	
	/**
	 * Mise à jour d'un projet
	 * @param $db
	 */
	public function update($db){
		updateProject($db, $this->prjidprj, $this->prjlbtit, $this->prjlbdes);
	}
	
	
	/**
	 * Retourne la liste des règles de gestion
	 * @param $db
	 * @return RdG_model[]
	 */
	public function getRdgs($db){
		if($this->rdgs == null) {
			$allRdgsIds = getRdGsIdsOfProjectFromDB($db, $this->prjidprj);
			$this->rdgs = array();
			foreach($allRdgsIds as $row) {
				$this->rdgs[] = RdG_model::getRdg($db, $row['rdgidrdg']);
			}
		}
		return $this->rdgs;
	}
	
	/**
	 * Retourne la liste des CDU
	 * @param $db
	 * @return Cdu_model[]
	 */
	public function getCdus($db){
		return Cdu_model::getAllCdusForProject($db, $this->prjidprj);
	} 
	
	/**
	 * ajoute le projet pour l'utilisateur
	 * @param $db
	 * @param $usridusr
	 */
	public function addUser($db, $usridusr){
		addLinkUserProject($db, $usridusr, $this->prjidprj);
	}
	
	
	/**
	 * Retourne la liste des Objets
	 * @param $db
	 * @return Objet_model[]
	 */
	public function getObjets($db){
		return Objet_model::getAllObjetsForProject($db, $this->prjidprj);
	} 
	
	
}
?>