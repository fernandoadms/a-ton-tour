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
if (!function_exists('getAll%(Name)sFromDB')) {
	function getAll%(Name)sFromDB($db) {
		$sql = "SELECT %(keyVariable), %(listOfFieldsForSQL) from %(tableName) ";
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
if (!function_exists('insertNew%(Name)')) {
	function insertNew%(Name)($db, %(listOfFieldsForMethodInsert)) {
		$data=array( %(listOfFieldsForInsert) );
		$db->insert('%(tableName)',$data);
		return $db->insert_id();
	}
}

/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('update%(Name)')) {
	function update%(Name)($db, $%(keyVariable), %(listOfFieldsForMethodUpdate)) {
		$sql = "update %(tableName) set %(listOfFieldsForUpdate) where %(keyVariable) = ?";
		$query = $db->query($sql, array(%(listOfFieldsForMethodUpdate), $%(keyVariable)));
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('delete%(Name)')) {
	function delete%(Name)($db, $%(keyVariable)) {
		$sql = "delete from %(tableName) where %(keyVariable) = ?";
		$query = $db->query($sql, array(%(intConversion)$%(keyVariable)));
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('get%(Name)Row')) {
	function get%(Name)Row($db, $%(keyVariable)) {
		$sql = "select %(keyVariable), %(listOfFieldsForSQL) from %(tableName) " .
		"where %(keyVariable) = ?";
		$query = $db->query($sql, array($%(keyVariable)));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

?>
