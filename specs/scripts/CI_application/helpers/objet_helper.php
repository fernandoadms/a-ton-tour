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
if (!function_exists('getAllObjetsFromDB')) {
	function getAllObjetsFromDB($db) {
		$sql = "SELECT objidobj, objcdtri, prjidprj, objlblib, objlbcde, objlbdes from speobj ";
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
if (!function_exists('insertNewObjet')) {
	function insertNewObjet($db, $objcdtri, $prjidprj, $objlblib, $objlbcde, $objlbdes) {
		$data=array( 'objcdtri'=>$objcdtri, 'prjidprj'=>$prjidprj, 'objlblib'=>$objlblib, 'objlbcde'=>$objlbcde, 'objlbdes'=>$objlbdes );
		$db->insert('speobj',$data);
		return $db->insert_id();
	}
}

/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('updateObjet')) {
	function updateObjet($db, $objidobj, $objcdtri, $prjidprj, $objlblib, $objlbcde, $objlbdes) {
		$sql = "update speobj set objcdtri = ?, prjidprj = ?, objlblib = ?, objlbcde = ?, objlbdes = ? where objidobj = ?";
		$query = $db->query($sql, array($objcdtri, $prjidprj, $objlblib, $objlbcde, $objlbdes, $objidobj));
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('deleteObjet')) {
	function deleteObjet($db, $objidobj) {
		$sql = "delete from speobj where objidobj = ?";
		$query = $db->query($sql, array((int)$objidobj));
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('getObjetRow')) {
	function getObjetRow($db, $objidobj) {
		$sql = "select objidobj, objcdtri, prjidprj, objlblib, objlbcde, objlbdes from speobj " .
		"where objidobj = ?";
		$query = $db->query($sql, array($objidobj));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

?>
