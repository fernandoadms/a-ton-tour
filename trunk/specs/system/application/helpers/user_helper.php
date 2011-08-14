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
if (!function_exists('getAllUsersFromDB')) {
	function getAllUsersFromDB($db) {
		$sql = "SELECT usridusr, usrlbnom, usrlblgn, usrlbpwd from speusr ";
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
if (!function_exists('insertNewUser')) {
	function insertNewUser($db, $usrlbnom, $usrlblgn, $usrlbpwd) {
		$data=array( 'usrlbnom'=>$usrlbnom, 'usrlblgn'=>$usrlblgn, 'usrlbpwd'=>$usrlbpwd );
		$db->insert('speusr',$data);
		return $db->insert_id();
	}
}

/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('updateUser')) {
	function updateUser($db, $usridusr, $usrlbnom, $usrlblgn, $usrlbpwd) {
		$sql = "update speusr set usrlbnom = ?, usrlblgn = ?, usrlbpwd = ? where usridusr = ?";
		$query = $db->query($sql, array($usrlbnom, $usrlblgn, $usrlbpwd, $usridusr));
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('deleteUser')) {
	function deleteUser($db, $usridusr) {
		// suppression des liens vers les projets
		$sql = "delete from spexup where usridusr = ?";
		$query = $db->query($sql, array((int)$usridusr));
		
		// suppression du user
		$sql = "delete from speusr where usridusr = ?";
		$query = $db->query($sql, array((int)$usridusr));
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('getUserRow')) {
	function getUserRow($db, $usridusr) {
		$sql = "select usridusr, usrlbnom, usrlblgn, usrlbpwd from speusr " .
		"where usridusr = ?";
		$query = $db->query($sql, array($usridusr));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

/**
 * Recupere les projets d'un user
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('getUserProjectIds')) {
	function getUserProjectIds($db, $usridusr) {
		$sql = "select prjidprj from spexup " .
		"where usridusr = ?";
		$query = $db->query($sql, array($usridusr));
		
		// recuperer les enregistrements
		$records = array();
		foreach ($query->result_array() as $row) {
			$records[] = $row['prjidprj'];
		}
		return $records;
	}
}



if (!function_exists('connectUserRow')) {
	function connectUserRow($db, $usrlblgn, $usrlbpwd) {
		$sql = "select usridusr, usrlbnom, usrlblgn, usrlbpwd from speusr " .
		"where usrlblgn = ? and usrlbpwd = ?";
		$query = $db->query($sql, array($usrlblgn, $usrlbpwd));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

if (!function_exists('removeAllUserProjectLinks')) {
	function removeAllUserProjectLinks($db, $usridusr) {
		$sql = "delete from spexup where usridusr = ?";
		$query = $db->query($sql, array((int)$usridusr));
	}
}


if (!function_exists('insertAllUserProjectLinks')) {
	function insertAllUserProjectLinks($db, $usridusr, $projectIds) {
		foreach ($projectIds as $prjidprj) {
			$data=array( 'usridusr'=>$usridusr, 'prjidprj'=>$prjidprj );
			$db->insert('spexup',$data);
		}
	}
}



?>
