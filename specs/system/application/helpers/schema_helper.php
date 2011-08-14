<?php

/*
 * Created on 31/03/2010
 *
 */

/**
 * Recupere la liste des schemas
 * @param object $db database object
 *  @return array of data
 */
if (!function_exists('getAllSchemasFromDB')) {
	function getAllSchemasFromDB($db) {
		$sql = "SELECT schidsch, schnuver , schdtcre , schlbtit , schlbdes , schlbimg , schlbsrc , schidvpr  from spesch ";
		$query = $db->query($sql);

		// recuperer les enregistrements
		$schemas = array ();
		foreach ($query->result_array() as $row) {
			$schemas[] = $row;
		}
		return $schemas;
	}
}

/**
 * Recupere les identifiants des tags associes a un nom de fichier image
 * @param object $db database object
 * @param string $imglbnom image name
 * @return array of tag names
 * /
if (!function_exists('getTagsIdsFromImglbnom')) {
	function getTagsIdsFromImglbnom($db, $imglbnom) {
		$sql = "SELECT itltag.tagidtag from itlimg,itlgrp,itltag " .
		"where imglbnom = ? " .
		"and itlimg.grpidgrp = itlgrp.grpidgrp " .
		"and itlgrp.tagidtag = itltag.tagidtag";
		$query = $db->query($sql, array ($imglbnom));

		// recuperer les enregistrements
		$tags = array();
		foreach ($query->result_array() as $row) {
			$tags[] = $row['tagidtag'];
		}
		return $tags;
	}
}


/**
 * Insere un nouveau schéma
 * @param object $db database object
 * @param string $schlbtit Title
 * @param string $schlbdes Description
 * @return number $schidsch the id of the created schema
 */
if (!function_exists('insertNewSchema')) {
	function insertNewSchema($db, $schlbtit, $schlbdes) {
		$data=array('schlbtit'=>$schlbtit,'schlbdes'=>$schlbdes, 'schnuver'=>1, 'schdtcre'=> date("Y-m-d"));
		$db->insert('spesch',$data);
		return $db->insert_id();
	}
}

/**
 * Mise à jour des fichiers d'un schema
 */
if (!function_exists('updateTitleAndDescriptionSchema')) {
	function updateTitleAndDescriptionSchema($db, $schidsch, $schlbtit, $schlbdes) {
		$sql = "update spesch set schlbtit = ?, schlbdes = ? where schidsch = ?";
		$query = $db->query($sql, array ($schlbtit , $schlbdes, $schidsch));
	}
}

/**
 * Mise à jour des fichiers d'un schema
 */
if (!function_exists('updateFilesOfSchema')) {
	function updateFilesOfSchema($db, $schidsch, $schlbimg, $schlbsrc) {
		$sql = "update spesch set schlbimg = ?, schlbsrc = ? where schidsch = ?";
		$query = $db->query($sql, array ($schlbimg , $schlbsrc, $schidsch));
	}
}

/**
 * Suppression d'un schema
 */
if (!function_exists('deleteSchema')) {
	function deleteSchema($db, $schidsch) {
		$sql = "delete from spesch where schidsch = ?";
		$query = $db->query($sql, array ((int)$schidsch));
	}
}



/**
 * Recupere les informations d'un schema
 * @param object $db database object
 * @param int id du schema
 * @return array ['schidsch'=> , 'schnuver'=> , 'schdtcre'=>, ...]
 */
if (!function_exists('getSchemaRow')) {
	function getSchemaRow($db, $schidsch) {
		$sql = "select schidsch, schnuver, schdtcre, schlbtit, schlbdes, schlbimg, schlbsrc, schidvpr from spesch " .
		"where schidsch = ?";
		$query = $db->query($sql, array ($schidsch));
		if ($query->num_rows() == 0) {
			return null;
		}
		return $query->row_array();
	}
}


?>
