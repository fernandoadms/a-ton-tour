<?php
/*
 * Created by generator
 *
 */

class Detail_model extends Model {
	
	var $detiddet;
	var $detlbdes;
	var $actidact;
	var $usridres;
	var $detdteci;
	var $detdtecp;
	var $detdtecr;
	var $etacdeta;
	
	/**
	 * Constructeur
	 */
	function Detail_model(){
		parent::Model();
		$this->load->helper('detail');
		$this->load->helper('utils');
		
	}
	
	/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function Detail_modelFromRow($row){
		$model = new Detail_model();
		$model->detiddet = $row['detiddet'];
		$model->detlbdes = $row['detlbdes'];
		$model->actidact = $row['actidact'];
		$model->usridres = $row['usridres'];
		$model->detdteci = fromSQLDate($row['detdteci']);
		$model->detdtecp = fromSQLDate($row['detdtecp']);
		$model->detdtecr = fromSQLDate($row['detdtecr']);
		$model->etacdeta = $row['etacdeta'];
		return $model;
	}

	/**
	 * recupere tous les enregistrements
	 * @param $db connexion a la base de donnees
	 */
	static function getAllDetails($db){
		$rows = getAllDetailsFromDB($db);
		$records = array();
		foreach ($rows as $row) {
			$records[] = Detail_model::Detail_modelFromRow($row);
		}
		return $records;
	}
	
	/**
	 * Recupere l'enregistrement a partir de son id
	 * @param $db database
	 * @param $detiddet identifiant de l'enregistrement a recuperer
	 */
	static function getDetail($db, $detiddet){
		$row = getDetailRow($db, $detiddet);
		return Detail_model::Detail_modelFromRow($row);
	}
	
	/**
	 * Suppression d'un enregistrement
	 * @param $db database
	 * @param $detiddet identifiant de l'enregistrement a supprimer
	 */
	static function delete($db, $detiddet){
		deleteDetail($db, $detiddet);
	}

	/**
	 * Enregistre en base un nouvel enregistrement
	 * @param $db
	 */
	public function save($db){
		$this->detiddet = insertNewDetail($db, $this->detlbdes, $this->actidact, $this->usridres, toSQLDate($this->detdteci), toSQLDate($this->detdtecp), toSQLDate($this->detdtecr), $this->etacdeta);
	}

	/**
	 * Mise a jour des donnees d'un enregistrement
	 * @param db $db
	 */
	public function update($db){
		updateDetail($db, $this->detiddet, $this->detiddet, $this->detlbdes, $this->actidact, $this->usridres, toSQLDate($this->detdteci), toSQLDate($this->detdtecp), toSQLDate($this->detdtecr), $this->etacdeta);
	}

	
	/***************************************************************************
	 * USER DEFINED FUNCTIONS
	 ***************************************************************************/

}

?>
