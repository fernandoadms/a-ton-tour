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
if (!function_exists('getAllCdusFromDB')) {
	function getAllCdusFromDB($db) {
		$sql = "SELECT cduidcdu, cdulbdes, cdulbtit, cdulbnum, specdu.prjidprj, prjlbtit ".
			" from specdu LEFT JOIN speprj prj on (specdu.prjidprj = prj.prjidprj) ".
			" order by cdulbnum";
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
 * Recupere la liste des enregistrements
 * @param object $db database object
 * @return array of data
 */
if (!function_exists('getAllCdusFromDBForProject')) {
	function getAllCdusFromDBForProject($db, $prjidprj) {
		$sql = "SELECT cduidcdu, cdulbdes, cdulbtit, cdulbnum, specdu.prjidprj, prjlbtit ".
			" from specdu LEFT JOIN speprj prj on (specdu.prjidprj = prj.prjidprj) ".
			" where specdu.prjidprj = ? order by cdulbnum";
		$query = $db->query($sql, array ((int)$prjidprj));

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
if (!function_exists('insertNewCdu')) {
	function insertNewCdu($db, $cdulbdes, $cdulbtit, $cdulbnum, $prjidprj) {
		$data=array( 'cdulbdes'=>$cdulbdes, 'cdulbtit'=>$cdulbtit, 'cdulbnum'=>$cdulbnum, 'prjidprj'=>$prjidprj );
		$db->insert('specdu',$data);
		return $db->insert_id();
	}
}

/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('updateCdu')) {
	function updateCdu($db, $cduidcdu, $cdulbdes, $cdulbtit, $cdulbnum, $prjidprj) {
		$sql = "update specdu set cdulbdes = ?, cdulbtit = ?, cdulbnum = ?, prjidprj = ? where cduidcdu = ?";
		$query = $db->query($sql, array ($cdulbdes, $cdulbtit, $cdulbnum, $prjidprj, $cduidcdu));
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('deleteCdu')) {
	function deleteCdu($db, $cduidcdu) {
		$sql = "delete from specdu where cduidcdu = ?";
		$query = $db->query($sql, array ((int)$cduidcdu));
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('getCduRow')) {
	function getCduRow($db, $cduidcdu) {
		$sql = "select cduidcdu, cdulbdes, cdulbtit, cdulbnum,  specdu.prjidprj, prjlbtit ".
			"from specdu LEFT JOIN speprj prj on (specdu.prjidprj = prj.prjidprj) " .
			"where cduidcdu = ?";
		$query = $db->query($sql, array ($cduidcdu));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

/**
 * Recupere les idnetifiants des règles de gestion associées au CDU
 */
if (!function_exists('getRdgIdsOfCduFromDB')) {
	function getRdgIdsOfCduFromDB($db, $cduidcdu) {
		$sql = "SELECT rdgidrdg from spexcr where cduidcdu = ?";
		$query = $db->query($sql,  array($cduidcdu));

		// recuperer les enregistrements
		$records = array();
		foreach ($query->result_array() as $row) {
			$records[] = $row['rdgidrdg'];
		}
		return $records;
	}
}


/**
 * Recupere les identifiants des règles de gestion associées au CDU
 */
if (!function_exists('getScenarioIdsOfCduFromDB')) {
	function getScenarioIdsOfCduFromDB($db, $cduidcdu) {
		$sql = "SELECT scnidscn from spescn where cduidcdu = ?";
		$query = $db->query($sql,  array((int)$cduidcdu));

		// recuperer les enregistrements
		$records = array();
		foreach ($query->result_array() as $row) {
			$records[] = $row['scnidscn'];
		}
		return $records;
	}
}


/**
 * Suppression des enregistrements liant un cdu à toutes les règles
 */
if (!function_exists('removeRowLinkCduAndAllRdg')) {
	function removeRowLinkCduAndAllRdg($db, $cduidcdu){
		$sql = "delete from spexcr where cduidcdu = ?;";
		$query = $db->query($sql, array( (int)$cduidcdu) );
	}
}

/**
 * Ajout des enregistrements liant un cdu à toutes les règles
 */
if (!function_exists('addRowLinkCduToRdg')) {
	function addRowLinkCduToRdg($db, $cduidcdu, $arrayOfRdgidrdg){
		$sql = "insert into spexcr (cduidcdu, rdgidrdg) values (?, ?);";
		foreach($arrayOfRdgidrdg as $rdgidrdg){
			$query = $db->query($sql, array( (int)$cduidcdu, (int)$rdgidrdg ) ) ;
		}
		
	}
}


?>
