<?php

/*
 * Created on 03/05/2010
 *
 */

/**
 * Recupere la liste des scenarios
 * @param object $db database object
 *  @return array of data
 */
if (!function_exists('getAllScenariosFromDB')) {
	function getAllScenariosFromDB($db) {
		$sql = "SELECT scnidscn, scntyscn , scnlbscn , scnlbres, cduidcdu from spescn ";
		$query = $db->query($sql);

		// recuperer les enregistrements
		$scenarios = array ();
		foreach ($query->result_array() as $row) {
			$scenarios[] = $row;
		}
		return $scenarios;
	}
}


/**
 * Insere un nouveau scenario
 * @param object $db database object
 * @param string $scntyscn Type
 * @param string $scnlbscn Libellé
 * @param string $scnlbres Resultat
 * @return number $scnidscn the id of the created schema
 */
if (!function_exists('insertNewScenario')) {
	function insertNewScenario($db, $scntyscn, $scnlbscn, $scnlbres, $cduidcdu) {
		$data=array('scntyscn'=>$scntyscn,'scnlbscn'=>$scnlbscn, 'scnlbres'=>$scnlbres, 'cduidcdu'=> $cduidcdu);
		$db->insert('spescn',$data);
		return $db->insert_id();
	}
}

/**
 * Mise à jour des fichiers d'un scenario
 */
if (!function_exists('updateScenario')) {
	function updateScenario($db, $scnidscn, $scntyscn, $scnlbscn, $scnlbres, $cduidcdu) {
		$sql = "update spescn set scntyscn = ?, scnlbscn = ?, scnlbres = ?, cduidcdu=? where scnidscn = ?";
		$query = $db->query($sql, array ($scntyscn , $scnlbscn, $scnlbres, $scnidscn, $cduidcdu));
	}
}


/**
 * Suppression d'un schema
 */
if (!function_exists('deleteScenario')) {
	function deleteScenario($db, $scnidscn) {
		$sql = "delete from spescn where scnidscn = ?";
		$query = $db->query($sql, array ((int)$scnidscn));
	}
}



/**
 * Recupere les informations d'un scenario
 * @param object $db database object
 * @param int id du scenario
 * @return array ['scnidscn'=> , 'schnuver'=> , 'schdtcre'=>, ...]
 */
if (!function_exists('getScenarioRow')) {
	function getScenarioRow($db, $scnidscn) {
		$sql = "select scnidscn, scntyscn, scnlbscn, scnlbres, cduidcdu from spescn " .
		"where scnidscn = ?";
		$query = $db->query($sql, array ($scnidscn));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

/**
 * Recupere les actions d'un scenario
 * @param object $db database object
 * @param int id du scenario
 * @return array ...
 */
if (!function_exists('getActionsRowsForScenario')) {
	function getActionsRowsForScenario($db, $scnidscn) {
		$sql = "SELECT actidact, actnuord, actlbact, scnidscn from speact " .
			"where scnidscn = ? order by actnuord asc";
		$query = $db->query($sql, array ($scnidscn));

		// recuperer les enregistrements
		$actions = array ();
		foreach ($query->result_array() as $row) {
			$actions[] = $row;
		}
		return $actions;
	}
}

/**
 * Suppression d'un schema
 */
if (!function_exists('removeAllActionsForScenario')) {
	function removeAllActionsForScenario($db, $scnidscn) {
		$sql = "delete from speact where scnidscn = ?";
		$query = $db->query($sql, array ((int)$scnidscn));
	}
}


?>
