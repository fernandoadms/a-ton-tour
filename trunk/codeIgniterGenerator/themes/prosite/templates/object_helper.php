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
	function getAll%(Name)sFromDB($db, $orderBy = null, $asc = null, $limit = null, $offset = null) {
		if( $orderBy != null ){
			if($asc != null) {
				$db->order_by($orderBy, $asc);
			}else {
				$db->order_by($orderBy, "asc");
			}
		}
		if( $limit == null ) {
			$query = $db->get("%(tableName)");
		} else {
			$query = $db->limit($limit, $offset)->get("%(tableName)");
		}
		// recuperer les enregistrements
		$records = array();
		foreach ($query->result_array() as $row) {
			$records[] = $row;
		}
		return $records;
	}
}

/**
 * Recupere le nombre d'enregistrements
 * @param object $db database object
 * @return int
 */
if (!function_exists('getCount%(Name)sFromDB')) {
	function getCount%(Name)sFromDB($db) {
		return $db->count_all("%(tableName)");
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
%(commentStart_crossTable)
if (!function_exists('update%(Name)')) {
	function update%(Name)($db, $%(keyVariable), %(helper_listOfFieldsForMethodUpdate)) {
		$data = array(%(helper_listOfFieldsForArrayValues));
		$db->where('%(keyVariable)', %(dollarKeyVariable));
		$db->update('%(tableName)', $data);
	}
}
%(commentStop_crossTable)


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('delete%(Name)')) {
	function delete%(Name)($db, %(dollarKeyVariable)) {
		$db->delete('%(tableName)', array('%(keyVariable)' => %(dollarKeyVariable))); 
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
		$query = $db->get_where('%(tableName)', array('%(keyVariable)' => %(dollarKeyVariable)));
		if ($query->num_rows() != 1) {
			return null;
		}
		return $query->row_array();
	}
}

	/***************************************************************************
	 * USER DEFINED FUNCTIONS
	 ***************************************************************************/


?>
