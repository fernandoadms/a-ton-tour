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
</script> -->';
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
<script src="'.base_url().'www/js/jquery/custom_jquery.js" type="text/javascript"></script>
<script type="text/javascript">
function checkField(inputField, regepx){
	if( regepx.test(inputField.value) ){
		inputField.className = "inp-form";
		$("#"+inputField.id + "Message").hide();
		return true;
	}else{
		inputField.className = "inp-form-error";
		inputField.focus();
		$("#"+inputField.id + "Message").show();
		return false;
	}
}
</script>';
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

?>