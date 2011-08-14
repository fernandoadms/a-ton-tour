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
if (!function_exists('getAllChampsFromDB')) {
	function getAllChampsFromDB($db) {
		$sql = "SELECT chpidchp, chplbcde, chplbnom, chpfgnul, chpfgcle, chpcdtyp, chplbdes, objidobj from spechp ";
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
if (!function_exists('insertNewChamp')) {
	function insertNewChamp($db, $chplbcde, $chplbnom, $chpfgnul, $chpfgcle, $chpcdtyp, $chplbdes, $objidobj) {
		$data=array( 'chplbcde'=>$chplbcde, 'chplbnom'=>$chplbnom, 'chpfgnul'=>$chpfgnul, 'chpfgcle'=>$chpfgcle, 'chpcdtyp'=>$chpcdtyp, 'chplbdes'=>$chplbdes, 'objidobj'=>$objidobj );
		$db->insert('spechp',$data);
		return $db->insert_id();
	}
}

/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('updateChamp')) {
	function updateChamp($db, $chpidchp, $chplbcde, $chplbnom, $chpfgnul, $chpfgcle, $chpcdtyp, $chplbdes, $objidobj) {
		$sql = "update spechp set chplbcde = ?, chplbnom = ?, chpfgnul = ?, chpfgcle = ?, chpcdtyp = ?, chplbdes = ?, objidobj = ? where chpidchp = ?";
		$query = $db->query($sql, array($chplbcde, $chplbnom, $chpfgnul, $chpfgcle, $chpcdtyp, $chplbdes, $objidobj, $chpidchp));
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('deleteChamp')) {
	function deleteChamp($db, $chpidchp) {
		$sql = "delete from spechp where chpidchp = ?";
		$query = $db->query($sql, array((int)$chpidchp));
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('getChampRow')) {
	function getChampRow($db, $chpidchp) {
		$sql = "select chpidchp, chplbcde, chplbnom, chpfgnul, chpfgcle, chpcdtyp, chplbdes, objidobj from spechp " .
		"where chpidchp = ?";
		$query = $db->query($sql, array($chpidchp));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

?>
