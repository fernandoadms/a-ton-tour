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
if (!function_exists('getAllUtilisateursFromDB')) {
	function getAllUtilisateursFromDB($db) {
		$sql = "SELECT usridusr, usrcdusr, usrlbnom, usrlbprn, usridser, usridres from fmeusr ";
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
if (!function_exists('insertNewUtilisateur')) {
	function insertNewUtilisateur($db, $usrcdusr, $usrlbnom, $usrlbprn, $usridser, $usridres) {
		$data=array( 'usrcdusr'=>$usrcdusr, 'usrlbnom'=>$usrlbnom, 'usrlbprn'=>$usrlbprn, 'usridser'=>$usridser, 'usridres'=>$usridres );
		$db->insert('fmeusr',$data);
		return $db->insert_id();
	}
}

/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('updateUtilisateur')) {
	function updateUtilisateur($db, $usridusr, $usrcdusr, $usrlbnom, $usrlbprn, $usridser, $usridres) {
		$sql = "update fmeusr set usrcdusr = ?, usrlbnom = ?, usrlbprn = ?, usridser = ?, usridres = ? where usridusr = ?";
		$query = $db->query($sql, array($usrcdusr, $usrlbnom, $usrlbprn, $usridser, $usridres, $usridusr));
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('deleteUtilisateur')) {
	function deleteUtilisateur($db, $usridusr) {
		$sql = "delete from fmeusr where usridusr = ?";
		$query = $db->query($sql, array((int)$usridusr));
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('getUtilisateurRow')) {
	function getUtilisateurRow($db, $usridusr) {
		$sql = "select usridusr, usrcdusr, usrlbnom, usrlbprn, usridser, usridres from fmeusr " .
		"where usridusr = ?";
		$query = $db->query($sql, array($usridusr));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

?>
