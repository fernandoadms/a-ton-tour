%[kind : views]
%[file : import%%(self.obName.lower())%%s_view.php]
%[path : views]
<?php
/*
 * Created by generator
 *
 */

$this->load->helper('form');
$this->load->helper('url');
$this->load->helper('template');
$this->load->helper('views');

if($this->session->userdata('user_name') == "") {
	redirect('welcome/index');
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<? echo htmlHeader('Import des %%(self.displayName)%%s'); ?>
</head>
<body> 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    

<!-- Start: page-top -->
<div id="page-top">

	<!-- start logo -->
	<div id="logo">
	<a href=""><img src="<?=base_url()?>www/images/shared/logo.png" alt="" /></a>
	</div>
	<!-- end logo -->
	
	<?= htmlSearch() ?>
	
 	<div class="clear"></div>

</div>
<!-- End: page-top -->

</div>
<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat................................................................................................. START -->
<div class="nav-outer-repeat"> 
<!--  start nav-outer -->
<div class="nav-outer">
 
	<?= htmlMyAccount($this->session) ?>
	<?= htmlNavigation("%%(self.obName.lower())%%","import", $this->session); ?>
	
</div>
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->

 <div class="clear"></div>
 
<!-- start content-outer ........................................................................................................................START -->
<div id="content-outer">
<!-- start content -->
<div id="content">

	<!--  start page-heading -->
	<div id="page-heading">
		<div style="float: left; with: 390px;">
			<h1>Import des %%(self.displayName)%%s</h1>
		</div>
		<div style="float: right; with: 390px;">
			<?php
				$msg = $this->session->flashdata('msg_info');    if($msg != ""){echo formatInfo($msg);} 
				$msg = $this->session->flashdata('msg_confirm'); if($msg != ""){echo formatConfirm($msg);}
				$msg = $this->session->flashdata('msg_warn');    if($msg != ""){echo formatWarn($msg);}
				$msg = $this->session->flashdata('msg_error');   if($msg != ""){echo formatError($msg);}
			?>
		</div>
	</div>
	<!-- end page-heading -->

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<th rowspan="3" class="sized"><img src="<?=base_url()?>www/images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
		<th class="topleft"></th>
		<td id="tbl-border-top">&nbsp;</td>
		<th class="topright"></th>
		<th rowspan="3" class="sized"><img src="<?=base_url()?>www/images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
	</tr>
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			
				<!--  start content-table ..................................................................................... -->
<?
$attributes_info = array('name' => 'ImportForm');
$fields_info = array();
echo form_open_multipart('import%%(self.obName.lower())%%s/loadFile', $attributes_info, $fields_info );
?>
				<h2>Contenu du fichier d'import</h2>
				<div style="margin-left: 10px;">
					<p>Choisir un fichier CSV avec les colonnes suivantes :</p>
					<ul style="margin-left: 30px;">
%%allAttributesCode = ""

for field in self.fields:
	if field.autoincrement:
		## ne pas presenter les champs auto-increment
		continue
	allAttributesCode += """
						<li>%(obName)s</li>""" % {'obName' : field.obName}
RETURN =  allAttributesCode
%%
					</ul>
				</div>
				
				<h2>Charger le fichier</h2>
					<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
						<tr>
							<td nowrap style="vertical-align: top; padding-top: 6px;"><label title="Document telecharge" for="import_file">* Fichier :</label> </td>
							<td>
								<input type="file" class="file_1" name="import_file" id="import_file">
							</td>
						</tr>
						<tr>
							<td></td>
							<td style="padding-top: 30px;">
								<input type="submit" value="" class="form-submit" />
							</td>
						</tr>
					</table>
<?
echo form_close('');
?>
			</div>
		
			<div class="clear"></div>

		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>
	<br>

<?php 
if(isset($dataProcessed)){
?>		
	<!--  start table-content  -->
	<div id="table-content">
	
		<!--  start product-table ..................................................................................... -->
		<form id="mainform" action="">
		<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
		<tr>
			<th class="table-header-check"><a id="toggle-all" ></a> </th>
			<!-- table header auto-generated : -->
%%allAttributesCode = ""
for field in self.fields:
	allAttributesCode += """
				<th class="table-header-repeat line-left minwidth-1"><a>%(obName)s ?></a></th>""" % {	
					'obName' : field.obName
				}
RETURN =  allAttributesCode
%%
		</tr>
	<?php
	$even = false;
	foreach($dataProcessed as $%%(self.obName.lower())%%):
	?>
		<tr <?=($even)?('class="alternate-row"'):('')?>>
			<td><input type="checkbox"/></td>
%%allAttributesCode = ""
for field in self.fields:
	allAttributesCode += """
			<td valign="top"><?= $%(structureObName)s->%(dbName)s ?></td>""" % {	
					'structureObName': self.obName.lower(), 
					'dbName' : field.dbName
				}
RETURN =  allAttributesCode
%%
		</tr>
	<?php 
	$even = !$even; 
	endforeach; ?>
		</table>
		<!--  end product-table................................... --> 
		</form>
	
	
	</div>
		
	<?php 
	}
	?>
	</div>
	<!--  end content -->

<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer........................................................END -->

<div class="clear">&nbsp;</div>


</body>
</html>