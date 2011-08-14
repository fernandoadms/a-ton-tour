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
if (!function_exists('getAllDetailsFromDB')) {
	function getAllDetailsFromDB($db) {
		$sql = "SELECT detiddet, detlbdes, actidact, usridres, detdteci, detdtecp, detdtecr, etacdeta from fmedet ";
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
if (!function_exists('insertNewDetail')) {
	function insertNewDetail($db, $detlbdes, $actidact, $usridres, $detdteci, $detdtecp, $detdtecr, $etacdeta) {
		$data=array( 'detlbdes'=>$detlbdes, 'actidact'=>$actidact, 'usridres'=>$usridres, 'detdteci'=>$detdteci, 'detdtecp'=>$detdtecp, 'detdtecr'=>$detdtecr, 'etacdeta'=>$etacdeta );
		$db->insert('fmedet',$data);
		return $db->insert_id();
	}
}

/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('updateDetail')) {
	function updateDetail($db, $detiddet, $detlbdes, $actidact, $usridres, $detdteci, $detdtecp, $detdtecr, $etacdeta) {
		$sql = "update fmedet set detlbdes = ?, actidact = ?, usridres = ?, detdteci = ?, detdtecp = ?, detdtecr = ?, etacdeta = ? where detiddet = ?";
		$query = $db->query($sql, array($detlbdes, $actidact, $usridres, $detdteci, $detdtecp, $detdtecr, $etacdeta, $detiddet));
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('deleteDetail')) {
	function deleteDetail($db, $detiddet) {
		$sql = "delete from fmedet where detiddet = ?";
		$query = $db->query($sql, array((int)$detiddet));
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('getDetailRow')) {
	function getDetailRow($db, $detiddet) {
		$sql = "select detiddet, detlbdes, actidact, usridres, detdteci, detdtecp, detdtecr, etacdeta from fmedet " .
		"where detiddet = ?";
		$query = $db->query($sql, array($detiddet));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

?>
