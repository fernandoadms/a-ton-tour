<?php
/*
 * Created by generator
 *
 */

class Projet_model extends Model {
	
	/**
	* Identifiant
	* @var int
	*/
	var $prjidprj;

	/**
	* Libellé du projet
	* @var varchar(255)
	*/
	var $prjlbnom;

	/**
	* Description globale de l'objectif à atteindre
	* @var varchar(4000)
	*/
	var $prjtxdes;

	
	/**
	 * Constructeur
	 */
	function Projet_model(){
		parent::Model();
		$this->load->helper('projet');
		
	}
	
	/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function Projet_modelFromRow($row){
		$model = new Projet_model();
		$model->prjidprj = $row['prjidprj'];
		$model->prjlbnom = $row['prjlbnom'];
		$model->prjtxdes = $row['prjtxdes'];
		return $model;
	}

	/**
	 * recupere tous les enregistrements
	 * @param $db connexion a la base de donnees
	 */
	static function getAllProjets($db){
		$rows = getAllProjetsFromDB($db);
		$records = array();
		foreach ($rows as $row) {
			$records[] = Projet_model::Projet_modelFromRow($row);
		}
		return $records;
	}
	
	/**
	 * Recupere l'enregistrement a partir de son id
	 * @param $db connexion a la base de donnees
	 * @param $prjidprj identifiant de l'enregistrement a recuperer
	 */
	static function getProjet($db, $prjidprj){
		$row = getProjetRow($db, $prjidprj);
		return Projet_model::Projet_modelFromRow($row);
	}
	
	/**
	 * Suppression d'un enregistrement
	 * @param $db connexion a la base de donnees
	 * @param $prjidprj identifiant de l'enregistrement a supprimer
	 */
	static function delete($db, $prjidprj){
		deleteProjet($db, $prjidprj);
	}

	/**
	 * Enregistre en base un nouvel enregistrement
	 * @param $db connexion a la base de donnees
	 */
	public function save($db){
		$this->prjidprj = insertNewProjet($db, $this->prjlbnom, $this->prjtxdes);
	}

	/**
	 * Mise a jour des donnees d'un enregistrement
	 * @param $db connexion a la base de donnees
	 */
	public function update($db){
		updateProjet($db, $this->prjidprj, $this->prjlbnom, $this->prjtxdes);
	}

	
	/***************************************************************************
	 * USER DEFINED FUNCTIONS
	 ***************************************************************************/

}

?>
