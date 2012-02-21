<?php


if (!function_exists('htmlHeader')) {
	function htmlHeader($title){
		$htmlCode = metaTags() . titleTag($title) . siteCSS() . jquery() .
			checkboxStyling() . styledFileUpload() . customJquery() .
			tooltips() . calendar() . pngFix() . tinyMceEditor().
			//jsCalendar()
			treeMenu() . fancyBox();
		return $htmlCode;
	}
}

if (!function_exists('checkboxStyling')) {
	function checkboxStyling(){
		$htmlCode = '<!--  checkbox styling script -->
<script src="'.base_url().'www/js/jquery/ui.core.js" type="text/javascript"></script>
<script src="'.base_url().'www/js/jquery/ui.checkbox.js" type="text/javascript"></script>
<script src="'.base_url().'www/js/jquery/jquery.bind.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	$("input").checkBox();
	$("#toggle-all").click(function(){
 	$("#toggle-all").toggleClass("toggle-checked");
	$("#mainform input[type=checkbox]").checkBox("toggle");
	return false;
	});
});
</script>  

<![if !IE 7]>

<!--  styled select box script version 1 -->
<script src="'.base_url().'www/js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".styledselect").selectbox({ inputClass: "selectbox_styled" });
});
</script>
 

<![endif]>

<!--  styled select box script version 2 --> 
<script src="'.base_url().'www/js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".styledselect_form_1").selectbox({ inputClass: "styledselect_form_1" });
	$(".styledselect_form_2").selectbox({ inputClass: "styledselect_form_2" });
});
</script>

<!--  styled select box script version 3 --> 
<script src="'.base_url().'www/js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
	$(".styledselect_pages").selectbox({ inputClass: "styledselect_pages" });
});
</script>';
		return $htmlCode;
	}
}


if (!function_exists('styledFileUpload')) {
	function styledFileUpload(){
		$htmlCode = '<!--  styled file upload script --> 
<script src="'.base_url().'www/js/jquery/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
  $(function() {
      $("input.file_1").filestyle({ 
          image: "'.base_url().'www/images/forms/choose-file.gif",
          imageheight : 21,
          imagewidth : 78,
          width : 310
      });
  });
</script>';
		return $htmlCode;
	}
}

if (!function_exists('jquery')) {
	function jquery(){
		$htmlCode = '<!--  jquery core -->
<script src="'.base_url().'www/js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>';
		return $htmlCode;
	}
}

if (!function_exists('customJquery')) {
	function customJquery(){
		$htmlCode = '<!-- Custom jquery scripts -->
<script src="'.base_url().'www/js/jquery/custom_jquery.js" type="text/javascript"></script>';
		return $htmlCode;
	}
}

if (!function_exists('tooltips')) {
	function tooltips(){
		$htmlCode = '<!-- Tooltips -->
<script src="'.base_url().'www/js/jquery/jquery.tooltip.js" type="text/javascript"></script>
<script src="'.base_url().'www/js/jquery/jquery.dimensions.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
	$("a.info-tooltip ").tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});
});
</script>';
		return $htmlCode;
	}
}


if (!function_exists('calendar')) {
	function calendar(){
		$htmlCode = '<!-- CALENDAR -->
<script src="'.base_url().'www/js/JSCal2-1.8/src/js/jscal2.js"></script>
<script src="'.base_url().'www/js/JSCal2-1.8/src/js/lang/fr.js"></script>
<link rel="stylesheet" type="text/css" href="'.base_url().'www/js/JSCal2-1.8/src/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="'.base_url().'www/js/JSCal2-1.8/src/css/border-radius.css" />
<style>
.DynarchCalendar-title { padding-left:40px; }
</style>
<!-- /CALENDAR -->';
		return $htmlCode;
	}
}

if (!function_exists('pngFix')) {
	function pngFix(){
		$htmlCode = '<!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
<script src="'.base_url().'www/js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>';
		return $htmlCode;
	}
}


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


if (!function_exists('metaTags')) {
	function metaTags(){
		$htmlCode = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
		return $htmlCode;
	}
}

if (!function_exists('titleTag')) {
	function titleTag($title){
		$htmlCode = '<title>'. $title .'</title>';
		return $htmlCode;
	}
}


if (!function_exists('siteCSS')) {
	function siteCSS(){
		$htmlCode = '<link rel="stylesheet" href="'.base_url().'www/css/screen.css" type="text/css" media="screen" title="default" />
<!--[if IE]>
<link rel="stylesheet" media="all" type="text/css" href="'.base_url().'www/css/pro_dropline_ie.css" />
<![endif]-->';
		return $htmlCode;
	}
}


if (!function_exists('dropdownMenuScripts')) {
	function dropdownMenuScripts(){
		$htmlCode = '<!-- dropdown menu -->
<link href="'.base_url().'www/js/dropdownMenu/css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="'.base_url().'www/js/dropdownMenu/css/dropdown/themes/adobe.com/default.advanced.css" media="screen" rel="stylesheet" type="text/css" />
<link href="'.base_url().'www/js/dropdownMenu/css/custom_dropdown.css" media="screen" rel="stylesheet" type="text/css" />

<!--[if lt IE 7]>
<script type="text/javascript" src="'.base_url().'www/js/dropdownMenu/js/jquery/jquery.js"></script>
<script type="text/javascript" src="'.base_url().'www/js/dropdownMenu/js/jquery/jquery.dropdown.js"></script>
<![endif]-->

<!-- / END -->';
		return $htmlCode;
	}
}


if (!function_exists('customCSS')) {
	function customCSS(){
		$htmlCode = '<!-- Custom CSS -->
<link rel="stylesheet" href="'.base_url().'www/css/main.css" />';
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
 * saisons --> actuelle || liste || nouveau
 * activites --> liste || nouveau
 * professeurs --> liste || nouveau
 * adherents --> liste || nouveau
 * parametrage --> niveaux || trancheAge || situations
 * statistiques --> 
 */
if (!function_exists('htmlNavigation')) {
	function htmlNavigation($itemToShow, $subItemToShow){
		$htmlCode = '<!--  start nav -->
		<div class="nav">
		<div class="table">';
		
		// SAISONS
		$htmlCode .= '<ul class="'.(($itemToShow == "saisons")?('current'):('select')).'"><li><a href="'.base_url().'index.php/saisonactuelle"><b>Saisons</b><!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
			<div class="select_sub '.(($itemToShow == "saisons")?('show'):('')).'">
				<ul class="sub">';
			// items
		$htmlCode .= '
					<li'.(($subItemToShow == "actuelle")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/saisonactuelle">Saison actuelle</a></li>
					<li'.(($subItemToShow == "liste")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/listsaisons">Liste des saisons</a></li>
					<li'.(($subItemToShow == "nouveau")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/listsaisons#new">Nouvelle saison</a></li>';
		$htmlCode .= '
				</ul>
			</div>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			</ul>';
				
		$htmlCode .= '<div class="nav-divider">&nbsp;</div>';
		
		// ACTIVITES
		$htmlCode .= '<ul class="'.(($itemToShow == "activites")?('current'):('select')).'"><li><a href="'.base_url().'index.php/listactivites"><b>Activités</b><!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
			<div class="select_sub '.(($itemToShow == "activites")?('show'):('')).'">
				<ul class="sub">';
			// items
		$htmlCode .= '
					<li'.(($subItemToShow == "liste")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/listactivites">Liste des activités</a></li>
					<li'.(($subItemToShow == "nouveau")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/listactivites#new">Nouvelle activité</a></li>';
		$htmlCode .= '
				</ul>
			</div>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			</ul>';
				
		$htmlCode .= '<div class="nav-divider">&nbsp;</div>';
		
		// PROFESSEURS
		$htmlCode .= '<ul class="'.(($itemToShow == "professeurs")?('current'):('select')).'"><li><a href="'.base_url().'index.php/listprofesseurs"><b>Professeurs</b><!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
			<div class="select_sub '.(($itemToShow == "professeurs")?('show'):('')).'">
				<ul class="sub">';
			// items
		$htmlCode .= '
					<li'.(($subItemToShow == "liste")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/listprofesseurs">Liste des professeurs</a></li>
					<li'.(($subItemToShow == "nouveau")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/listprofesseurs#new">Nouveau professeur</a></li>';
		$htmlCode .= '
				</ul>
			</div>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			</ul>';
				
		$htmlCode .= '<div class="nav-divider">&nbsp;</div>';
		
		// ADHERENTS
		$htmlCode .= '<ul class="'.(($itemToShow == "adherents")?('current'):('select')).'"><li><a href="'.base_url().'index.php/listadherents"><b>Adherents</b><!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
			<div class="select_sub '.(($itemToShow == "adherents")?('show'):('')).'">
				<ul class="sub">';
			// items
		$htmlCode .= '
					<li'.(($subItemToShow == "liste")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/listadherents">Liste des adherents</a></li>
					<li'.(($subItemToShow == "nouveau")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/listadherents#new">Nouvel adherent</a></li>';
		$htmlCode .= '
				</ul>
			</div>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			</ul>';
				
		$htmlCode .= '<div class="nav-divider">&nbsp;</div>';
		
		// PARAMETRAGE
		$htmlCode .= '<ul class="'.(($itemToShow == "parametrage")?('current'):('select')).'"><li><a href="'.base_url().'index.php/listniveaus"><b>Paramétrage</b><!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
			<div class="select_sub '.(($itemToShow == "parametrage")?('show'):('')).'">
				<ul class="sub">';
			// items
		$htmlCode .= '
					<li'.(($subItemToShow == "niveaux")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/listniveaus">Niveaux</a></li>
					<li'.(($subItemToShow == "trancheAge")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/listtrancheages">Tranches d\'ages</a></li>
					<li'.(($subItemToShow == "situations")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/listsituations">Situations</a></li>';
		$htmlCode .= '
				</ul>
			</div>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			</ul>';
		
		// STATISTIQUES
		$htmlCode .= '<ul class="'.(($itemToShow == "statistiques")?('current'):('select')).'"><li><a href="'.base_url().'index.php/stats"><b>Statistiques</b><!--[if IE 7]><!--></a><!--<![endif]-->
			<!--[if lte IE 6]><table><tr><td><![endif]-->
			<div class="select_sub '.(($itemToShow == "statistiques")?('show'):('')).'">
				<ul class="sub">';
			// items
		$htmlCode .= '
					<li'.(($subItemToShow == "tdb")?(' class="sub_show"'):('')).'><a href="'.base_url().'index.php/stats">Tableau de bord</a></li>';
		$htmlCode .= '
				</ul>
			</div>
			<!--[if lte IE 6]></td></tr></table></a><![endif]-->
			</li>
			</ul>';
		
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

if (!function_exists('tinyMceEditor')) {
	function tinyMceEditor(){
		$htmlCode = '<!-- TinyMCE -->
<script type="text/javascript" src="'.base_url().'www/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	editor_selector : "editor_detail",
	plugins : "ibrowser,safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

	// Theme options
	theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontselect,fontsizeselect,|,bullist,numlist,|,outdent,indent,|,charmap,code",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,

	imagemanager_insert_template : \'<a href="{$url}"><img src="{$custom.thumbnail_url}" width="{$custom.twidth}" height="{$custom.theight}" /></a>\',

	// Example content CSS (should be your site CSS)
	content_css : "css/content.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "lists/template_list.js",
	external_link_list_url : "lists/link_list.js",
	external_image_list_url : "lists/image_list.js",
	media_external_list_url : "lists/media_list.js"

});

tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	editor_selector : "editor_short",
	width : "300px",
	plugins : "ibrowser,safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

	// Theme options
	theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,bullist,numlist,|,outdent,indent,|,charmap,code",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,

	imagemanager_insert_template : \'<a href="{$url}"><img src="{$custom.thumbnail_url}" width="{$custom.twidth}" height="{$custom.theight}" /></a>\',

	// Example content CSS (should be your site CSS)
	content_css : "css/content.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "lists/template_list.js",
	external_link_list_url : "lists/link_list.js",
	external_image_list_url : "lists/image_list.js",
	media_external_list_url : "lists/media_list.js"

});
</script>
<!-- /TinyMCE -->';
		return $htmlCode;
	}
}



if (!function_exists('jsCalendar')) {
	function jsCalendar(){
		$htmlCode = '<!-- CALENDAR -->
<script src="'.base_url().'www/js/JSCal2-1.8/src/js/jscal2.js"></script>
<script src="'.base_url().'www/js/JSCal2-1.8/src/js/lang/fr.js"></script>
<link rel="stylesheet" type="text/css" href="'.base_url().'www/js/JSCal2-1.8/src/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="'.base_url().'www/js/JSCal2-1.8/src/css/border-radius.css" />
<style>
.DynarchCalendar-title { padding-left:40px; }
</style>
<!-- /CALENDAR -->';
		return $htmlCode;
	}
}


if (!function_exists('treeMenu')) {
	function treeMenu(){
		$htmlCode = '
<!-- CSS & JS pour tree -->
<script src="'.base_url().'www/js/jstree/_lib/jquery.js" language="JavaScript" type="text/javascript"></script>
<script src="'.base_url().'www/js/jstree/jquery.jstree.js" language="JavaScript" type="text/javascript"></script>
<link href="'.base_url().'www/js/jstree/themes/default/style.css" rel="stylesheet" type="text/css">';
		return $htmlCode;
	}
}

if (!function_exists('fancyBox')) {
	function fancyBox(){
		$htmlCode = '
<!-- Fancy Box -->
<script type="text/javascript" src="'.base_url().'../js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="'.base_url().'../js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="'.base_url().'../js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
	$("a#image").fancybox({
				\'transitionIn\'	: \'none\',
				\'transitionOut\'	: \'none\'	
	});
});
</script>
<!-- /Fancy Box -->';
		return $htmlCode;
	}
}

