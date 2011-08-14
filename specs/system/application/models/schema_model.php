<?php
/*
 * Created on 01/04/2010
 *
 */

class Schema_model extends Model {

	var $schidsch;
	var $schnuver;
	var $schdtcre;
	var $schlbtit;
	var $schlbdes;
	var $schlbimg;
	var $schlbsrc;
	var $schidvpr;
	var $filesPath;

	/**
	 * Constructeur
	 */
	function Schema_model(){
		parent::Model();
		$this->load->helper('schema');
		$this->filesPath = 'www/schemas/';
	}

		/************************************************************************
	 * Methodes de mise a jour a partir de la base de donnees
	 ************************************************************************/

	/**
	 * Cree une nouvelle instance a partir d'un enregistrement de base de donnees
	 */
	static function Schema_modelFromRow($row){
		$schema = new Schema_model();
		$schema->schidsch = $row['schidsch'];
		$schema->schnuver = $row['schnuver'];
		$schema->schdtcre = $row['schdtcre'];
		$schema->schlbtit = $row['schlbtit'];
		$schema->schlbdes = $row['schlbdes'];
		$schema->schlbimg = $row['schlbimg'];
		$schema->schlbsrc = $row['schlbsrc'];
		$schema->schidvpr = $row['schidvpr'];
		return $schema;
	}


	/**
	 * recupere tous les schemas
	 * @param $db connexion a la base de donnees
	 */
	static function getAllSchemas($db){
		$rows = getAllSchemasFromDB($db);
		$schemas = array ();
		foreach ($rows as $row) {
			$schemas[] = Schema_model::Schema_modelFromRow($row);
		}
		return $schemas;
	}


	/**
	 * Recupere le schema a partir de son id
	 */
	static function getSchema($db, $schidsch){
		$row = getSchemaRow($db, $schidsch);
		return Schema_model::Schema_modelFromRow($row);
	}

	/**
	 * Suppression d'un schéma
	 * @param $db database
	 * @param $schidsch identifiant du schéma à supprimer
	 */
	static function delete($db, $schidsch){
		$schema = Schema_model::getSchema($db,$schidsch);
		if($schema->schlbimg != null){
			unlink($schema->filesPath . $schema->schlbimg);
		}
		if($schema->schlbsrc != null){
			unlink($schema->filesPath . $schema->schlbsrc);
		}

		deleteSchema($db, $schidsch);

	}
	
	/**
	 *
	 */
	public function saveFiles($db, $path, $imageFileData, $sourceFileData){
		// Renommer le fichier en fonction de ce qui est stocké
		if($imageFileData != null) {
			// nouvelle image
			$this->schlbimg = 'sch_' . $this->schidsch . '_img' . $imageFileData['file_ext'];
			rename($path . $imageFileData['file_name'], $path . $this->schlbimg);
		}

		if($sourceFileData != null) {
			$this->schlbsrc = 'sch_' . $this->schidsch . '_src' . $sourceFileData['file_ext'];
			rename($path . $sourceFileData['file_name'], $path . $this->schlbsrc);
		}

		// Mettre à jour les fichiers
		updateFilesOfSchema($db, $this->schidsch, $this->schlbimg, $this->schlbsrc);
	}

	/**
	 * Enregistre en base un nouveau schéma
	 * @param $db
	 * @param $path
	 * @param $imageFileData
	 * @param $sourceFileData
	 */
	public function save($db, $path, $imageFileData, $sourceFileData){
		$this->schidsch = insertNewSchema($db, $this->schlbtit, $this->schlbdes);
		$this->filesPath = $path;

		$this->saveFiles($db, $path, $imageFileData, $sourceFileData);

	}

	/**
	 * Mise à jour des données d'un schéma
	 * @param db $db
	 * @param string $path
	 * @param array $imageFileData
	 * @param array $sourceFileData
	 */
	public function update($db, $path, $imageFileData, $sourceFileData){
		$oldSchema = Schema_model::getSchema($db, $this->schidsch);
		updateTitleAndDescriptionSchema($db, $this->schidsch, $this->schlbtit, $this->schlbdes);
		$this->filesPath = $path;

		if($oldSchema->schlbimg != null && $imageFileData != null){
			// nouvelle image
			if( file_exists($oldSchema->filesPath . $oldSchema->schlbimg) ) {
				unlink($oldSchema->filesPath . $oldSchema->schlbimg);
			}
			$this->schlbimg = null;
		}else if($oldSchema->schlbimg != null && $imageFileData == null){
			// pas de nouvelle image
			$this->schlbimg = $oldSchema->schlbimg;
		}
		
		if($oldSchema->schlbsrc != null && $sourceFileData != null){
			if( file_exists($oldSchema->filesPath . $oldSchema->schlbsrc) ) {
				unlink($oldSchema->filesPath . $oldSchema->schlbsrc);
			}
			$this->schlbsrc = null;
		}else if($oldSchema->schlbsrc != null && $sourceFileData == null){
			// pas de nouvelle image
			$this->schlbsrc = $oldSchema->schlbsrc;
		}

		$this->saveFiles($db, $path, $imageFileData, $sourceFileData);

	}

	/**
	 * Affecte les variables pour une nouvelle version
	 * @param string $schlbtit
	 * @param string $schlbdes
	 */
	public function setNewVersion($schlbtit, $schlbdes){
		$this->schnuver = 1;
		$this->schlbtit = $schlbtit;
		$this->schlbdes = $schlbdes;
	}

	/************************************************************************
	 * Methodes d'utilisation dans le HTML
	 ************************************************************************/


	/**
	 * Recuperation du chemin de l'image
	 * @return string
	 */
	public function getImageFileURL() {
		return $this->filesPath . $this->schlbimg;
	}


	/**
	 * Recuperation du chemin de la source
	 * @return string
	 */
	public function getSourceFileURL() {
		return $this->filesPath . $this->schlbsrc;
	}

	/**
	 * Insere dans $aHTML_TreeNodeXL les fils de $this, sous forme d'instances de HTML_TreeNodeXL
	 * @param $db connexion a la base de donnees
	 * @param $aHTML_TreeNodeXL noeud a mettre a jour
	 * @param $excludeNode identifiant du noeud a exclure
	 * @param $nodeProperties parametres d'afficahge du noeud
	 * @return $this
	 * /
	private function appendTree($db, $aHTML_TreeNodeXL, $excludeNode, $nodeProperties,
		$labelFunction, $linkFunction) {
		// append children
		$children = $this->childrenTags($db);

		foreach( $children as $child ) {
			// exclure le tag identifié
			if( $excludeNode == $child->tagidtag) {
				continue;
			}
			$childNode = &new HTML_TreeNodeXL(
	 			call_user_func($labelFunction, $child),
	  			( $linkFunction == null )?(''):(call_user_func($linkFunction, $child)),
				$nodeProperties);
			$child->appendTree($db, $childNode, $excludeNode, $nodeProperties, $labelFunction, $linkFunction);
			$aHTML_TreeNodeXL->addItem($childNode);
		}
		return $this;
	}

	/**
	 * Suppression d'un tag
	 * /
	static function deleteTagById($db, $tagidtag){
		deleteTagRecordById($db, $tagidtag);
	}*/

}

?>
