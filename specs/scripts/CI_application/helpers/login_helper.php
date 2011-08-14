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
if (!function_exists('getAllLoginsFromDB')) {
	function getAllLoginsFromDB($db) {
		$sql = "SELECT lgnidlgn, lgnidusr, lgnlblgn, lgnlbpwd, lgncdprf, lgnfgarc from fmelgn ";
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
if (!function_exists('insertNewLogin')) {
	function insertNewLogin($db, $lgnidusr, $lgnlblgn, $lgnlbpwd, $lgncdprf, $lgnfgarc) {
		$data=array( 'lgnidusr'=>$lgnidusr, 'lgnlblgn'=>$lgnlblgn, 'lgnlbpwd'=>$lgnlbpwd, 'lgncdprf'=>$lgncdprf, 'lgnfgarc'=>$lgnfgarc );
		$db->insert('fmelgn',$data);
		return $db->insert_id();
	}
}

/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('updateLogin')) {
	function updateLogin($db, $lgnidlgn, $lgnidusr, $lgnlblgn, $lgnlbpwd, $lgncdprf, $lgnfgarc) {
		$sql = "update fmelgn set lgnidusr = ?, lgnlblgn = ?, lgnlbpwd = ?, lgncdprf = ?, lgnfgarc = ? where lgnidlgn = ?";
		$query = $db->query($sql, array($lgnidusr, $lgnlblgn, $lgnlbpwd, $lgncdprf, $lgnfgarc, $lgnidlgn));
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('deleteLogin')) {
	function deleteLogin($db, $lgnidlgn) {
		$sql = "delete from fmelgn where lgnidlgn = ?";
		$query = $db->query($sql, array((int)$lgnidlgn));
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('getLoginRow')) {
	function getLoginRow($db, $lgnidlgn) {
		$sql = "select lgnidlgn, lgnidusr, lgnlblgn, lgnlbpwd, lgncdprf, lgnfgarc from fmelgn " .
		"where lgnidlgn = ?";
		$query = $db->query($sql, array($lgnidlgn));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

?>
