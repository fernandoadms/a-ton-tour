<?php
/*
 * Created on 01/04/2010
 *
 */

function htmlHeader($title){
	return '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>'.$title.'</title>
<link rel="shortcut icon" href="'.base_url().'favicon.gif">

<!-- CSS & JS pour treeMenu -->
<script src="'.base_url().'www/treeMenu/TreeMenu.js" language="JavaScript" type="text/javascript"></script>
<link href="'.base_url().'www/treeMenu/TreeMenu.css" rel="stylesheet" type="text/css">

<script src="'.base_url().'www/js/jquery.js" language="JavaScript" type="text/javascript"></script>

<style type="text/css">
/* Layout */
@import "'.base_url().'www/dropdownMenu/css/dropdown/dropdown.css";

/* Theme */
@import "'.base_url().'www/dropdownMenu/css/dropdown/themes/adobe.com/default.advanced.css";

table.visible{
	border: 1px solid #b2b2ff; border-collapse: collapse;
}
tr.header {
	background: #b2b2ff;
}
</style>
<link rel="stylesheet" href="'.base_url().'www/googleBlueprint/blueprint/screen.css" type="text/css" media="screen, projection">
<link rel="stylesheet" href="'.base_url().'www/googleBlueprint/blueprint/plugins/silksprite/sprite.css" type="text/css" media="screen, projection">

<!-- TinyMCE -->
<script type="text/javascript" src="'.base_url().'www/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	editor_selector : "editor_detail",
	plugins : "ibrowser,safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

	// Theme options
	theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,|,bullist,numlist,|,outdent,indent,|,charmap,code",
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
<!-- /TinyMCE -->
'; 
}

function htmlNavigation($isAdmin){
	return '<ul id="nav" class="dropdown dropdown-horizontal">
	<li><a href="#" class="dir">Projets</a>
		<ul>
			<li><a href="'.base_url().'index.php/listprojects">Liste</a></li>
			' . (($isAdmin)?('<li><a href="'.base_url().'index.php/listusers">Utilisateurs</a></li>'):('')).' 
			</ul>
	</li>
	<li><a href="#" class="dir">Composants</a>
		<ul>
			<li><a href="'.base_url().'index.php/listcdus">Cas d\'utilisation</a></li>
			<li><a href="'.base_url().'index.php/listrdgs">Règles de gestion</a></li>
			<li><a href="'.base_url().'index.php/listschemas">Schémas</a></li>
			<li><a href="'.base_url().'index.php/listscenarios">Scénarios</a></li>
		</ul>
	</li>
</ul><hr>
	';
}



function formatInfo($message){
	return '<div class="success">'.$message.'</div>';
}
function formatWarn($message){
	return '<div class="notice">'.$message.'</div>';
}
function formatError($message){
	return '<div class="error">'.$message.'</div>';
}
?>
