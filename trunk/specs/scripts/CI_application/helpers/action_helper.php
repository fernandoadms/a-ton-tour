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
if (!function_exists('getAllActionsFromDB')) {
	function getAllActionsFromDB($db) {
		$sql = "SELECT actidact, actidpro, actlbtit, actnupri, actdtcre, actdtdem, actdteci, actdtecp, actdtecr, actfgcac from fmeact ";
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
if (!function_exists('insertNewAction')) {
	function insertNewAction($db, $actidpro, $actlbtit, $actnupri, $actdtcre, $actdtdem, $actdteci, $actdtecp, $actdtecr, $actfgcac) {
		$data=array( 'actidpro'=>$actidpro, 'actlbtit'=>$actlbtit, 'actnupri'=>$actnupri, 'actdtcre'=>$actdtcre, 'actdtdem'=>$actdtdem, 'actdteci'=>$actdteci, 'actdtecp'=>$actdtecp, 'actdtecr'=>$actdtecr, 'actfgcac'=>$actfgcac );
		$db->insert('fmeact',$data);
		return $db->insert_id();
	}
}

/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('updateAction')) {
	function updateAction($db, $actidact, $actidpro, $actlbtit, $actnupri, $actdtcre, $actdtdem, $actdteci, $actdtecp, $actdtecr, $actfgcac) {
		$sql = "update fmeact set actidpro = ?, actlbtit = ?, actnupri = ?, actdtcre = ?, actdtdem = ?, actdteci = ?, actdtecp = ?, actdtecr = ?, actfgcac = ? where actidact = ?";
		$query = $db->query($sql, array($actidpro, $actlbtit, $actnupri, $actdtcre, $actdtdem, $actdteci, $actdtecp, $actdtecr, $actfgcac, $actidact));
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('deleteAction')) {
	function deleteAction($db, $actidact) {
		$sql = "delete from fmeact where actidact = ?";
		$query = $db->query($sql, array((int)$actidact));
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('getActionRow')) {
	function getActionRow($db, $actidact) {
		$sql = "select actidact, actidpro, actlbtit, actnupri, actdtcre, actdtdem, actdteci, actdtecp, actdtecr, actfgcac from fmeact " .
		"where actidact = ?";
		$query = $db->query($sql, array($actidact));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

?>
