<?php

/*
 * Created on 08/05/2010
 *
 */

/**
 * Recupere la liste des actions
 * @param object $db database object
 *  @return array of data
 */
if (!function_exists('getAllActionsFromDB')) {
	function getAllActionsFromDB($db) {
		$sql = "SELECT actidact, actnuord, actlbact, scnidscn from speact ";
		$query = $db->query($sql);

		// recuperer les enregistrements
		$actions = array ();
		foreach ($query->result_array() as $row) {
			$actions[] = $row;
		}
		return $actions;
	}
}


/**
 * Insere une nouvelle action
 * @param object $db database object
 * @param string $scntyscn Type
 * @param string $scnlbscn Libellé
 * @param string $scnlbres Resultat
 * @return number $actidact identifiant
 */
if (!function_exists('insertNewAction')) {
	function insertNewAction($db, $actnuord, $actlbact, $scnidscn) {
		$data=array('actnuord'=>$actnuord,'actlbact'=>$actlbact, 'scnidscn'=>$scnidscn);
		$db->insert('speact',$data);
		return $db->insert_id();
	}
}

/**
 * Mise à jour des fichiers d'une action
 */
if (!function_exists('updateAction')) {
	function updateAction($db, $actidact, $actnuord, $actlbact, $scnidscn) {
		$sql = "update speact set actnuord = ?, actlbact = ?, scnidscn = ? where actidact = ?";
		$query = $db->query($sql, array ($actnuord , $actlbact, $scnidscn, $actidact));
	}
}


/**
 * Suppression d'une action
 */
if (!function_exists('deleteAction')) {
	function deleteAction($db, $actidact) {
		$sql = "delete from speact where actidact = ?";
		$query = $db->query($sql, array ((int)$actidact));
	}
}


/**
 * Suppression de toutes les actions d'un scenario
 */
if (!function_exists('deleteAllActionsOfScenario')) {
	function deleteAllActionsOfScenario($db, $scnidscn) {
		$sql = "delete from speact where scnidscn = ?";
		$query = $db->query($sql, array ((int)$scnidscn));
	}
}


/**
 * Recupere les informations d'une action
 * @param object $db database object
 * @param int id de l'action
 * @return array ['scnidscn'=> , 'schnuver'=> , 'schdtcre'=>, ...]
 */
if (!function_exists('getActionRow')) {
	function getActionRow($db, $actidact) {
		$sql = "select actidact, actnuord, actlbact, scnidscn from speact " .
		"where actidact = ?";
		$query = $db->query($sql, array ($actidact));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}


?>
