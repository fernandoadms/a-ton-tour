%[kind : helpers]
%[file : %%(self.obName.lower())%%_helper.php] 
%[path : helpers]
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
if (!function_exists('getAll%%(self.obName)%%sFromDB')) {
	function getAll%%(self.obName)%%sFromDB($db, $orderBy = null, $asc = null, $limit = null, $offset = null) {
		if( $orderBy != null ){
			if($asc != null) {
				$db->order_by($orderBy, $asc);
			}else {
				$db->order_by($orderBy, "asc");
			}
		}
		if( $limit == null ) {
			$query = $db->get("%%(self.dbTableName)%%");
		} else {
			$query = $db->limit($limit, $offset)->get("%%(self.dbTableName)%%");
		}
		// recuperer les enregistrements
		$records = array();
		foreach ($query->result_array() as $row) {
			$records[] = $row;
		}
		return $records;
	}
}

/**
 * Recupere le nombre d'enregistrements
 * @param object $db database object
 * @return int
 */
if (!function_exists('getCount%%(self.obName)%%sFromDB')) {
	function getCount%%(self.obName)%%sFromDB($db) {
		return $db->count_all("%%(self.dbTableName)%%");
	}
}

/**
 * Insere un nouvel enregistrement
 */
if (!function_exists('insertNew%%(self.obName)%%')) {
	function insertNew%%(self.obName)%%($db, %%
phpCode = "" 
if self.isCrossTable:
	phpCode = self.listOfKeys(fieldPrefix="$", fieldSuffix = ", ",withIntConversion=False)
else:
	includesAutoIncrement = False
	for field in self.keyFields:
		if field.autoincrement and not includesAutoIncrement:
			includesAutoIncrement = True
	phpCode = self.dbVariablesList("$(var)s", 'var',  '', '', 0, not includesAutoIncrement)
RETURN = phpCode
%%) {
		$data=array( %%
phpCode = ""
if self.isCrossTable:
	includesKey = True
	phpCode = self.dbVariablesList("'(var)s'=>$(var)s", 'var',  '', '', 0, includesKey)
else:
	includesAutoIncrement = False
	for field in self.keyFields:
		if field.autoincrement and not includesAutoIncrement:
			includesAutoIncrement = True
	phpCode = self.dbVariablesList("'(var)s'=>$(var)s", 'var',  '', '', 0, not includesAutoIncrement)
RETURN = phpCode
%%);
		$db->insert('%%(self.dbTableName)%%',$data);
		return $db->insert_id();
	}
}


/**
 * Mise a jour d'un enregistrement
 */
if (!function_exists('update%%(self.obName)%%')) {
	function update%%(self.obName)%%($db, %%(self.listOfKeys(fieldPrefix="$", fieldSuffix = ", "))%%, %%
includesKey = False
if self.isCrossTable:
	includesKey = True
RETURN = self.dbVariablesList("$(var)s", 'var',  '', '', 0, includesKey)
%%) {
		$data = array(%%
includesKey = False
if self.isCrossTable:
	includesKey = True
RETURN = self.dbVariablesList("'(var)s'=>$(var)s", 'var',  '', '', 0, includesKey)
%%);
		$db->where('%%(self.keyFields[0].dbName)%%', %%(self.listOfKeys(fieldPrefix="$", fieldSuffix = ", "))%%);
		$db->update('%%(self.dbTableName)%%', $data);
	}
}


/**
 * Suppression d'un enregistrement
 */
if (!function_exists('delete%%(self.obName)%%')) {
	function delete%%(self.obName)%%($db, %%(self.listOfKeys(fieldPrefix="$", fieldSuffix = ", "))%%) {
		$db->delete('%%(self.dbTableName)%%', array(%%
allVariables = ""
for field in self.keyFields:
	if allVariables != "":
		allVariables += ", "
	allVariables += """'%(variable)s'=>$%(variable)s""" % {'variable' : field.dbName }
RETURN = allVariables
%%)); 
	}
}


/**
 * Recupere les informations d'un enregistrement
 * @param object $db database object
 * @param int id de l'enregistrement
 * @return array
 */
if (!function_exists('get%%(self.obName)%%Row')) {
	function get%%(self.obName)%%Row($db, %%(self.listOfKeys(fieldPrefix="$", fieldSuffix = ", "))%%) {
		$query = $db->get_where('%%(self.dbTableName)%%', array('%%(self.keyFields[0].dbName)%%' => $%%(self.keyFields[0].dbName)%%));
		if ($query->num_rows() != 1) {
			return null;
		}
		return $query->row_array();
	}
}

	/***************************************************************************
	 * USER DEFINED FUNCTIONS
	 ***************************************************************************/


?>
