<?php
/*
 * Created on 05/04/2010
 *
 */

/**
 * Recupere la liste des règles de gestion
 * @param object $db database object
 * @return array of data
 */
if (!function_exists('getAllRdGFromDB')) {
	function getAllRdGFromDB($db) {
		$sql = "SELECT rdgidrdg, rdgnurdg, rdgtyrdg, rdglbeno, rdgdtcre, sperdg.prjidprj, prjlbtit ".
			"from sperdg LEFT JOIN speprj prj on (sperdg.prjidprj = prj.prjidprj) ";
		$query = $db->query($sql);

		// recuperer les enregistrements
		$rdg = array ();
		foreach ($query->result_array() as $row) {
			$rdg[] = $row;
		}
		return $rdg;
	}
}

/**
 * Recupere la liste des règles de gestion pour un projet
 * @param object $db database object
 * @return array of data
 */
if (!function_exists('getAllRdGFromDBForProject')) {
	function getAllRdGFromDBForProject($db, $prjidprj) {
		$sql = "SELECT rdgidrdg, rdgnurdg, rdgtyrdg, rdglbeno, rdgdtcre, sperdg.prjidprj, prjlbtit ".
			"from sperdg LEFT JOIN speprj prj on (sperdg.prjidprj = prj.prjidprj) ".
			"where sperdg.prjidprj = ?";
		$query = $db->query($sql, array ((int)$prjidprj));

		// recuperer les enregistrements
		$rdg = array ();
		foreach ($query->result_array() as $row) {
			$rdg[] = $row;
		}
		return $rdg;
	}
}

/**
 * Insertion d'une nouvelle règle de gestion
 * @param db $db base de donnéest
 * @param string $rdgnurdg Numéro de la règle
 * @param string $rdgtyrdg Type
 * @param string $rdglbeno Enoncé de la règle
 * @return number $rdgidrdg identifiant de la nouvelle règle
 */
if (!function_exists('insertNewRdG')) {
	function insertNewRdG($db, $rdgnurdg, $rdgtyrdg, $rdglbeno, $prjidprj) {
		$data=array('rdgnurdg'=>$rdgnurdg,'rdgtyrdg'=>$rdgtyrdg, 'rdglbeno'=>$rdglbeno, 'prjidprj'=>$prjidprj, 'rdgdtcre'=> date("Y-m-d"));
		$db->insert('sperdg',$data);
		return $db->insert_id();
	}
}

/**
 * Suppression d'une règle de gestion
 */
if (!function_exists('deleteRdg')) {
	function deleteRdg($db, $rdgidrdg) {
		$sql = "delete from sperdg where rdgidrdg = ?";
		$query = $db->query($sql, array ((int)$rdgidrdg));
	}
}

/**
 * Recupere les informations d'une règle de gestion
 * @param object $db database object
 * @param int id de la règle
 * @return array ['rdgidrdg'=> , 'rdgnurdg'=> , 'rdgtyrdg'=>, ...]
 */
if (!function_exists('getRdgRow')) {
	function getRdgRow($db, $rdgidrdg) {
		$sql = "select rdgidrdg, rdgnurdg, rdgtyrdg, rdglbeno, rdgdtcre, sperdg.prjidprj, prjlbtit ".
			"from sperdg LEFT JOIN speprj prj on (sperdg.prjidprj = prj.prjidprj) " .
			"where rdgidrdg = ?";
		$query = $db->query($sql, array ((int)$rdgidrdg));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

/**
 * Mise à jour d'une règle de gestion
 */
if (!function_exists('updateRdG')) {
	function updateRdG($db, $rdgidrdg, $rdgnurdg, $rdgtyrdg, $rdglbeno, $prjidprj) {
		$sql = "update sperdg set rdgnurdg = ?, rdgtyrdg = ?, rdglbeno = ?, prjidprj = ? where rdgidrdg = ?";
		$query = $db->query($sql, array ($rdgnurdg , $rdgtyrdg, $rdglbeno, (int)$prjidprj, (int)$rdgidrdg));
	}
}


/**
 * Recuperation des schémas
 */
if (!function_exists('getSchemasIdsOfRdGFromDB')) {
	function getSchemasIdsOfRdGFromDB($db, $rdgidrdg){
		$schemas = array();
		$sql = "select schidsch from spexrs " .
			"where rdgidrdg = ?";
		$query = $db->query($sql, array ((int)$rdgidrdg));
		return $query->result_array();
	}
}

/************************************************************************
 * Méthodes d'accès aux liens avec les schémas
 ************************************************************************/


/**
 * Suppression de l'enregistrement liant une règle à un schéma
 */
if (!function_exists('removeRowLinkRdgAndSchema')) {
	function removeRowLinkRdgAndSchema($db, $rdgidrdg, $schidsch){
		$sql = "delete from spexrs where rdgidrdg = ? and schidsch = ?;";
		$query = $db->query($sql, array( (int)$rdgidrdg, (int)$schidsch) );
	}
}

/**
 * Suppression des enregistrements liant une règle à tous les schémas
 */
if (!function_exists('removeRowLinkRdgAndAllSchemas')) {
	function removeRowLinkRdgAndAllSchemas($db, $rdgidrdg){
		$sql = "delete from spexrs where rdgidrdg = ?;";
		$query = $db->query($sql, array( (int)$rdgidrdg) );
	}
}

/**
 * Ajout des enregistrements liant une règle à tous les schémas
 */
if (!function_exists('addRowLinkRdgToSchemas')) {
	function addRowLinkRdgToSchemas($db, $rdgidrdg, $arrayOfSchidsch){
		$sql = "insert into spexrs (rdgidrdg, schidsch) values (?, ?);";
		foreach($arrayOfSchidsch as $schidsch){
			$query = $db->query($sql, array( (int)$rdgidrdg, (int)$schidsch ) ) ;
		}
		
	}
}




?>
