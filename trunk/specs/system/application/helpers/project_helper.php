<?php
/*
 * Created on 20/04/2010
 *
 */

/**
 * Recupere la liste des projets
 * @param object $db database object
 * @return array of data
 */
if (!function_exists('getAllProjectsFromDB')) {
	function getAllProjectsFromDB($db, $usridusr) {
		if( $usridusr == null ){
			$sql = "SELECT prjidprj, prjlbtit, prjlbdes from speprj";
			$query = $db->query($sql);
		}else {
			$sql = "SELECT speprj.prjidprj, prjlbtit, prjlbdes from speprj, spexup".
				" where speprj.prjidprj = spexup.prjidprj ".
				" and spexup.usridusr = ?";
			$query = $db->query($sql,  array ((int)$usridusr));
		}
		
		// recuperer les enregistrements
		$rdg = array ();
		foreach ($query->result_array() as $row) {
			$rdg[] = $row;
		}
		return $rdg;
	}
}

/**
 * Insertion d'un nouveau projet
 * @param db $db base de données
 * @param string $prjlbtit Titre du projet
 * @param string $prjlbdes Description
 * @return number $prjidprj identifiant du nouveau projet
 */
if (!function_exists('insertNewProject')) {
	function insertNewProject($db, $prjlbtit, $prjlbdes) {
		$data=array('prjlbtit'=>$prjlbtit,'prjlbdes'=>$prjlbdes);
		$db->insert('speprj',$data);
		return $db->insert_id();
	}
}

/**
 * Suppression d'un projet
 */
if (!function_exists('deleteProject')) {
	function deleteProject($db, $prjidprj) {
		$sql = "delete from speprj where prjidprj = ?";
		$query = $db->query($sql, array ((int)$prjidprj));
	}
}

/**
 * Recupere les informations d'une règle de gestion
 * @param object $db database object
 * @param int id de la règle
 * @return array ['prjidprj'=> , 'prjlbtit'=> , 'prjlbdes'=> ]
 */
if (!function_exists('getProjectRow')) {
	function getProjectRow($db, $prjidprj) {
		$sql = "select prjidprj, prjlbtit, prjlbdes from speprj " .
		"where prjidprj = ?";
		$query = $db->query($sql, array ((int)$prjidprj));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}

/**
 * Mise à jour d'une règle de gestion
 */
if (!function_exists('updateProject')) {
	function updateProject($db, $prjidprj, $prjlbtit, $prjlbdes) {
		$sql = "update speprj set prjlbtit = ?, prjlbdes = ? where prjidprj = ?";
		$query = $db->query($sql, array ($prjlbtit , $prjlbdes, (int)$prjidprj));
	}
}


/**
 * Recuperation des règles de gestion
 */
if (!function_exists('getRdGsIdsOfProjectFromDB')) {
	function getRdGsIdsOfProjectFromDB($db, $prjidprj){
		$rdg = array();
		$sql = "select rdgidrdg from sperdg " .
			"where prjidprj = ?";
		$query = $db->query($sql, array ((int)$prjidprj));
		return $query->result_array();
	}
}

/**
 * Ajoute un lien entre le user et le projet
 */
if (!function_exists('addLinkUserProject')) {
	function addLinkUserProject($db, $usridusr, $prjidprj){
		$data=array( 'usridusr'=>$usridusr, 'prjidprj'=>$prjidprj );
		$db->insert('spexup',$data);
	}
}


?>
