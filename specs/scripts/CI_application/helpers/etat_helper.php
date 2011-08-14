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
if (!function_exists('getAllEtatsFromDB')) {
	function getAllEtatsFromDB($db) {
		$sql = "SELECT etacdeta, etalbeta, etacdact from fmeeta ";
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
if (!function_exists('insertNewEtat')) {
	function insertNewEtat($db, $etacdeta, $etalbeta, $etacdact) {
		$data=array( 'etacdeta'=>$etacdeta, 'etalbeta'=>$etalbeta, 'etacdact'=>$etacdact );
		$db->insert('fmeeta',$data);
		return $db->insert_id();
	}
}

/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('updateEtat')) {
	function updateEtat($db, $etacdeta, $etalbeta, $etacdact) {
		$sql = "update fmeeta set etalbeta = ?, etacdact = ? where etacdeta = ?";
		$query = $db->query($sql, array($etalbeta, $etacdact, $etacdeta));
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('deleteEtat')) {
	function deleteEtat($db, $etacdeta) {
		$sql = "delete from fmeeta where etacdeta = ?";
		$query = $db->query($sql, array($etacdeta));
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('getEtatRow')) {
	function getEtatRow($db, $etacdeta) {
		$sql = "select etacdeta, etalbeta, etacdact from fmeeta " .
		"where etacdeta = ?";
		$query = $db->query($sql, array($etacdeta));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

?>
