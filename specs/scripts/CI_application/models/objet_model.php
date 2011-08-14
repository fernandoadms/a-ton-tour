<?php
/*
 * Created by generator
 *
 */

class Objet_model extends Model {
	
	var $objidobj;
	var $objcdtri;
	var $prjidprj;
	var $objlblib;
	var $objlbcde;
	var $objlbdes;
	
	/**
	 * Constructeur
	 */
	function Objet_model(){
		parent::Model();
		$this->load->helper('objet');
		
	}
	
	/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function Objet_modelFromRow($row){
		$model = new Objet_model();
		$model->objidobj = $row['objidobj'];
		$model->objcdtri = $row['objcdtri'];
		$model->prjidprj = $row['prjidprj'];
		$model->objlblib = $row['objlblib'];
		$model->objlbcde = $row['objlbcde'];
		$model->objlbdes = $row['objlbdes'];
		return $model;
	}

	/**
	 * recupere tous les enregistrements
	 * @param $db connexion a la base de donnees
	 */
	static function getAllObjets($db){
		$rows = getAllObjetsFromDB($db);
		$records = array();
		foreach ($rows as $row) {
			$records[] = Objet_model::Objet_modelFromRow($row);
		}
		return $records;
	}
	
	/**
	 * Recupere l'enregistrement a partir de son id
	 * @param $db database
	 * @param $objidobj identifiant de l'enregistrement a recuperer
	 */
	static function getObjet($db, $objidobj){
		$row = getObjetRow($db, $objidobj);
		return Objet_model::Objet_modelFromRow($row);
	}
	
	/**
	 * Suppression d'un enregistrement
	 * @param $db database
	 * @param $objidobj identifiant de l'enregistrement a supprimer
	 */
	static function delete($db, $objidobj){
		deleteObjet($db, $objidobj);
	}

	/**
	 * Enregistre en base un nouvel enregistrement
	 * @param $db
	 */
	public function save($db){
		$this->objidobj = insertNewObjet($db, $this->objcdtri, $this->prjidprj, $this->objlblib, $this->objlbcde, $this->objlbdes);
	}

	/**
	 * Mise a jour des donnees d'un enregistrement
	 * @param db $db
	 */
	public function update($db){
		updateObjet($db, $this->objidobj, $this->objidobj, $this->objcdtri, $this->prjidprj, $this->objlblib, $this->objlbcde, $this->objlbdes);
	}

	
	/***************************************************************************
	 * USER DEFINED FUNCTIONS
	 ***************************************************************************/

}

?>
