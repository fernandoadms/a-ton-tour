<?php
/*
 * Created on 05/04/2010
 *
 */

//define("WWW_ROOT", 'www');
//define("THUMB_DIR", '_thumbnails');

class RdG_model extends Model {

	var $rdgidrdg;
	var $rdgnurdg;
	var $rdgtyrdg;
	var $rdglbeno;
	var $rdgdtcre;
	var $schemas;
	var $prjidprj;
	var $prjlbtit;

	/**
	 * Constructeur
	 */
	function RdG_model(){
		parent::Model();
		$this->load->helper('rdg');
		$this->load->model('schema_model');
	}

	
	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 * @param array $row Enregistrement de base de donnees
	 */
	static function RdG_modelFromRow($row){
		$rdg = new RdG_model();
		$rdg->rdgidrdg = $row['rdgidrdg'];
		$rdg->rdgnurdg = $row['rdgnurdg'];
		$rdg->rdgtyrdg = $row['rdgtyrdg'];
		$rdg->rdglbeno = $row['rdglbeno'];
		$rdg->rdgdtcre = $row['rdgdtcre'];
		$rdg->prjidprj = $row['prjidprj'];
		$rdg->prjlbtit = $row['prjlbtit'];
		return $rdg;
	}
	
	/**
	 * recupere toutes les règles de gestion
	 * @param db $db connexion a la base de donnees
	 */
	static function getAllRdG($db){
		$rows = getAllRdGFromDB($db);
		$RdGs = array();
		foreach ($rows as $row) {
			$RdGs[] = RdG_model::RdG_modelFromRow($row);
		}
		return $RdGs;
	}
	/**
	 * recupere toutes les règles de gestion pour un projet
	 * @param unknown_type $db
	 * @param unknown_type $prjidprj
	 */
	static function getAllRdGForProject($db, $prjidprj){
		$rows = getAllRdGFromDBForProject($db, $prjidprj);
		$RdGs = array();
		foreach ($rows as $row) {
			$RdGs[] = RdG_model::RdG_modelFromRow($row);
		}
		return $RdGs;
	}
	
	/**
	 * Suppression d'une règle de gestion
	 * @param $db database
	 * @param $schidsch identifiant de la règle de gestion à supprimer
	 */
	static function delete($db, $rdgidrdg){
		removeRowLinkRdgAndAllSchemas($db, $rdgidrdg); 
		deleteRdg($db, $rdgidrdg);
	}
	
	/**
	 * Retourne l'objet à partir de l'identifiant
	 * @param database $db
	 * @param integer $rdgidrdg
	 */
	static function getRdG($db, $rdgidrdg) {
		$row = getRdgRow($db, $rdgidrdg);
		return RdG_model::RdG_modelFromRow($row);
	}
	
	/************************************************************************
	 * Méthodes d'instance
	 ************************************************************************/
	
	/**
	 * Sauvegarde des données d'une nouvelle règle de gestion
	 * @param db $db
	 */
	public function save($db){
		$this->rdgidrdg = insertNewRdG($db, $this->rdgnurdg, $this->rdgtyrdg, $this->rdglbeno, $this->prjidprj);
	}
	
	/**
	 * Mise à jour d'une règle de gestion
	 * @param unknown_type $db
	 */
	public function update($db){
		updateRdG($db, $this->rdgidrdg, $this->rdgnurdg, $this->rdgtyrdg, $this->rdglbeno, $this->prjidprj);
	}
	
	/**
	 * Retourne le libellé du type
	 * @return string 'Technique' | 'Fonctionnelle'
	 */
	public function getLabelType(){
		return ($this->rdgtyrdg == 'T')?('Technique'):('Fonctionnelle');
	}
	
	/**
	 * Recupere les schemas. Si vide, essaye de les lire depuis la base de données
	 * @param $db
	 * @return array list of schemas ($this->schemas) 
	 */
	function getSchemas($db){
		if($this->schemas == null){
			$allSchemasIds = getSchemasIdsOfRdGFromDB($db, $this->rdgidrdg);
			$this->schemas = array();
			foreach($allSchemasIds as $row) {
				$this->schemas[] = Schema_model::getSchema($db, $row['schidsch']);
			}
		}
		return $this->schemas;
	}
	
	/**
	 * Suppression de l'enregistrement liant la règle au schéma
	 * @param $db
	 * @param $schidsch
	 */
	function removeSchema($db, $schidsch){
		removeRowLinkRdgAndSchema($db, $this->rdgidrdg, $schidsch);

		// reset schemas
		$this->schemas = null;
	}
	
	/**
	 * Ajout des liens entre la règle et les schémas
	 * @param $db
	 * @param $arrayOfSchidsch
	 */
	function setSchemasIds($db, $arrayOfSchidsch) {
		removeRowLinkRdgAndAllSchemas($db, $this->rdgidrdg); 
		
		addRowLinkRdgToSchemas($db, $this->rdgidrdg, $arrayOfSchidsch); 

		// reset schemas
		$this->schemas = null;
	}
	
	/**
	 * Retourne vrai si le schéma est inclu dans la règle
	 * @param $db
	 * @param $schidsch
	 * @return bool
	 */
	function includesSchema($db, $schidsch){
		foreach($this->getSchemas($db) as $schema){
			if((int)$schema->schidsch == (int)$schidsch){
				return true;
			}
		}
		return false;
	}
}

?>
