%[kind : models]
%[file : %%(self.obName.lower())%%_model.php]
%[path : models]
<?php
/*
 * Created by generator
 *
 */

include_once( APPPATH . 'models/%%(self.obName.lower())%%Base_model' . EXT );

class %%(self.obName)%%_model extends %%(self.obName)%%Base_model {
	
	/**
	 * Constructeur
	 */
	function __construct(){
		parent::__construct();
	}
	
	/***************************************************************************
	 * USER DEFINED FUNCTIONS
	 ***************************************************************************/

}

?>
