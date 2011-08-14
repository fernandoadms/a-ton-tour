<?php

/*
 *  Created on 19/06/2011
 */

/**
 * Supprime les tags HTML de la chaine de caractères
 * @param $aHTMLstring
 */
if (!function_exists('removeHTML')) {
	function removeHTML($aHTMLstring) {
		$str = str_replace(array("<p>","</p>","&eacute;", "&egrave;", "&agrave;"),
						   array("", "",	 "é", "è", "à"),
						   $aHTMLstring);
		return $str;
	}
}

