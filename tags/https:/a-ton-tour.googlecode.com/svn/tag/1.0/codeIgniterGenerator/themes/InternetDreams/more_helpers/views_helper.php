<?php

if (!function_exists('formatInfo')) {
	function formatInfo($message){
		$htmlCode = '<!--  start message-blue -->
				<div id="message-blue">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="blue-left">'.$message.'</td>
					<td class="blue-right"><a class="close-blue"><img src="'.base_url().'www/images/table/icon_close_blue.gif" alt="" /></a></td>
				</tr>
				</table>
				</div>
				<!--  end message-blue -->';
		return $htmlCode;
	}
}

if (!function_exists('formatWarn')) {
	function formatWarn($message){
		$htmlCode = '<!--  start message-yellow -->
				<div id="message-yellow">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="yellow-left">'.$message.'</td>
					<td class="yellow-right"><a class="close-yellow"><img src="'.base_url().'www/images/table/icon_close_yellow.gif" alt="" /></a></td>
				</tr>
				</table>
				</div>
				<!-- end message-yellow -->';
		return $htmlCode;
	}
}

if (!function_exists('formatError')) {
	function formatError($message){
		$htmlCode = '<!--  start message-red -->
				<div id="message-red">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="red-left">'.$message.'</td>
					<td class="red-right"><a class="close-red"><img src="'.base_url().'www/images/table/icon_close_red.gif" alt="" /></a></td>
				</tr>
				</table>
				</div>
				<!--  end message-red -->';
		return $htmlCode;
	}
}

if (!function_exists('formatConfirm')) {
	function formatConfirm($message){
		$htmlCode = '<!--  start message-green -->
				<div id="message-green">
				<table border="0" width="100%" cellpadding="0" cellspacing="0">
				<tr>
					<td class="green-left">'.$message.'</td>
					<td class="green-right"><a class="close-green"><img src="'.base_url().'www/images/table/icon_close_green.gif" alt="" /></a></td>
				</tr>
				</table>
				</div>
				<!--  end message-green -->';
		return $htmlCode;
	}
}


if (!function_exists('htmlSearch')) {
	function htmlSearch(){
		$htmlCode = '<!--  start top-search -->
	<div id="top-search">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td><input type="text" value="Rechercher" onblur="if (this.value==\'\') { this.value=\'Rechercher\'; }" onfocus="if (this.value==\'Rechercher\') { this.value=\'\'; }" class="top-search-inp" /></td>
		<td>
		<select  class="styledselect">
			<option value=""> Tout</option>
			<option value=""> Adherent</option>
			<option value=""> Professeur</option>
		</select> 
		</td>
		<td>
		<input type="image" src="'.base_url().'www/images/shared/top_search_btn.gif"  />
		</td>
		</tr>
		</table>
	</div>
 	<!--  end top-search -->';
		
		return $htmlCode;
	}
}


if (!function_exists('htmlMyAccount')) {
	function htmlMyAccount(){
		$htmlCode = '<!-- start nav-right -->
		<div id="nav-right">
		
			<div class="nav-divider">&nbsp;</div>
			<!--div class="showhide-account"><img src="'.base_url().'www/images/shared/nav/nav_myaccount.gif" width="93" height="14" alt="" /></div>
			<div class="nav-divider">&nbsp;</div-->
			<a href="'.base_url().'index.php/welcome/logout" id="logout"><img src="'.base_url().'www/images/shared/nav/nav_logout.gif" width="64" height="14" alt="" /></a>
			<div class="clear">&nbsp;</div>
		
			<!--  start account-content -->	
			<div class="account-content">
			<div class="account-drop-inner">
				<a href="" id="acc-settings">Settings</a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-details">Personal details </a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-project">Project details</a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-inbox">Inbox</a>
				<div class="clear">&nbsp;</div>
				<div class="acc-line">&nbsp;</div>
				<a href="" id="acc-stats">Statistics</a> 
			</div>
			</div>
			<!--  end account-content -->
		
		</div>
		<!-- end nav-right -->';
		
		return $htmlCode;
	}
}


/**
 * $itemToShow --> $subItemToShow : 
 * itemA --> list || edit
 * itemB --> list || edit
 */
if (!function_exists('htmlNavigation')) {
	function htmlNavigation($itemToShow, $subItemToShow){
		$htmlCode = '<!--  start nav -->
		<div class="nav">
		<div class="table">';
		
		// itemA
		$htmlCode .= '<ul class="'.(($itemToShow == "itemA")?('current'):('select')).'"><li><a href="'.base_url().'index.php/itemA"><b>itemA</b><!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
			<div class="select_sub '.(($itemToShow == "itemA")?('show'):('')).'">
				<ul class="sub">';
			// items
		$htmlCode .= '
					<li'.(($subItemToShow == "list")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/list">list</a></li>
					<li'.(($subItemToShow == "edit")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/edit">edit</a></li>';
		$htmlCode .= '
				</ul>
			</div>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			</ul>';
				
		$htmlCode .= '<div class="nav-divider">&nbsp;</div>';
		
		// itemB
		$htmlCode .= '<ul class="'.(($itemToShow == "itemB")?('current'):('select')).'"><li><a href="'.base_url().'index.php/itemB"><b>itemB</b><!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
			<div class="select_sub '.(($itemToShow == "itemB")?('show'):('')).'">
				<ul class="sub">';
			// items
		$htmlCode .= '
					<li'.(($subItemToShow == "list")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/list">list</a></li>
					<li'.(($subItemToShow == "edit")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/edit">edit</a></li>';
		$htmlCode .= '
				</ul>
			</div>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			</ul>';
				
		// of of menu
		
		$htmlCode .= '<div class="nav-divider">&nbsp;</div>
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>
		<!--  start nav -->';
		
		
		return $htmlCode;
	}
}

/*
if (!function_exists('htmlMenu')) {
	function htmlMenu($userProfile){
		$htmlCode = '<ul id="nav" class="dropdown dropdown-horizontal">
		<li><a href="'.base_url().'index.php">Home</a></li>
		<li><a href="#" class="dir">Produits</a>
			<ul>
				<li><a href="'.base_url().'index.php/listproduits">Liste</a></li>
				<li><a href="'.base_url().'index.php/listproduits#new">Nouveau</a></li>
			</ul>
		</li>
		<li><a href="./" class="dir">Classement</a>
			<ul>
				<li class="empty">&#8250;&#8250; Catégories</li>
				<li><a href="'.base_url().'index.php/listcategories">Liste</a></li>
				<li><a href="'.base_url().'index.php/listcategories#new">Nouveau</a></li>
				<li class="empty">&#8250;&#8250; Sous-Catégories</li>
				<li><a href="'.base_url().'index.php/listsouscategories">Liste</a></li>
				<li><a href="'.base_url().'index.php/listsouscategories#new">Nouveau</a></li>
				<li class="empty">&#8250;&#8250; Rubriques</li>
				<li><a href="'.base_url().'index.php/listrubriques">Liste</a></li>
				<li><a href="'.base_url().'index.php/listrubriques#new">Nouveau</a></li>
			</ul>
		</li>
		<li><a href="./" class="dir">News</a>
			<ul>
				<li><a href="'.base_url().'index.php/listnewss">Liste</a></li>
				<li><a href="'.base_url().'index.php/listnewss#new">Nouvelle news</a></li>
			</ul>
		</li>
		<li><a href="./" class="dir">Quitter</a>
			<ul>
				<li><a href="'.base_url().'index.php/welcome/logout">Retour au site</a></li>
			</ul>
		</li>
		</ul>';
		return $htmlCode;
	}
}
*/
?>