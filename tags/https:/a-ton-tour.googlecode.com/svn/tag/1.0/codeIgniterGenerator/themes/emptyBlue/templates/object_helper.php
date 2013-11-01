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
		$sql = "%(helper_selectAll)";
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
 */
if (!function_exists('insertNew%(Name)')) {
	function insertNew%(Name)($db, %(helper_listOfFieldsForMethodInsert)) {
		$data=array( %(helper_listOfFieldsForInsert) );
		$db->insert('%(tableName)',$data);
		return $db->insert_id();
	}
}

/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('update%(Name)')) {
	function update%(Name)($db, $%(keyVariable), %(helper_listOfFieldsForMethodUpdate)) {
		$sql = "%(helper_updateSQL)";
		$query = $db->query($sql, array(%(helper_listOfFieldsForMethodUpdate), $%(keyVariable)));
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('delete%(Name)')) {
	function delete%(Name)($db, %(dollarKeyVariable)) {
		$sql = "%(helper_deleteSQL)";
		$query = $db->query($sql, array(%(dollarKeyVariable)));
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('get%(Name)Row')) {
	function get%(Name)Row($db, %(dollarKeyVariable)) {
		$sql = "%(helper_selectWhere)";
		$query = $db->query($sql, array(%(dollarKeyVariable)));
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
