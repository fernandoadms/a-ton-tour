<?php

/*
 * Created by generator
 *
 */

/**
 * Recupere la liste des enregistrements
 * @param object $db database object
 * @return array of data
 */
if (!function_exists('getAllProjetsFromDB')) {
	function getAllProjetsFromDB($db) {
		$sql = "SELECT prjidprj, prjlbnom, prjtxdes from tstprj ";
		$query = $db->query($sql);

		// recuperer les enregistrements
		$records = array();
		foreach ($query->result_array() as $row) {
			$records[] = $row;
		}
		return $records;
	}
}


/**
 * Insere un nouvel enregistrement
 * @param object $db database object
 * @param string ...
 * @return number identifiant
 */
if (!function_exists('insertNewProjet')) {
	function insertNewProjet($db, $prjlbnom, $prjtxdes) {
		$data=array( 'prjlbnom'=>$prjlbnom, 'prjtxdes'=>$prjtxdes );
		$db->insert('tstprj',$data);
		return $db->insert_id();
	}
}

/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('updateProjet')) {
	function updateProjet($db, $prjidprj, $prjlbnom, $prjtxdes) {
		$sql = "update tstprj set prjlbnom = ?, prjtxdes = ? where prjidprj = ?";
		$query = $db->query($sql, array($prjlbnom, $prjtxdes, $prjidprj));
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('deleteProjet')) {
	function deleteProjet($db, $prjidprj) {
		$sql = "delete from tstprj where prjidprj = ?";
		$query = $db->query($sql, array((int)$prjidprj));
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('getProjetRow')) {
	function getProjetRow($db, $prjidprj) {
		$sql = "select prjidprj, prjlbnom, prjtxdes from tstprj " .
		"where prjidprj = ?";
		$query = $db->query($sql, array($prjidprj));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

	/***************************************************************************
	 * USER DEFINED FUNCTIONS
	 ***************************************************************************/


?>
