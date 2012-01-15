%[kind : views]
%[file : list%%(self.obName.lower())%%_view.php] 
%[path : views]
<?php
/*
 * Created by generator
 *
 */

$this->load->helper('form');
$this->load->helper('url');
$this->load->helper('template');
?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<? echo htmlHeader('%%(self.obName)%%'); ?>

</head>
<body>

<div id="mybody">

<div class="container container_12">
	<div class="grid_12">
		<h1><img src="<?=base_url()?>www/img/%%(self.obName.lower())%%.png" style="vertical-align:middle;"> Liste des %%(self.obName.lower())%%s</h1>
	</div>
 	<div class="clear"></div>
</div> <!-- container container_12 -->


<div class="container container_12">
  <div class="grid_12 menu">
		<? echo htmlMenu('getUserProfile'); ?>
  </div> <!-- grid_12 menu -->
  <div class="clear"></div>
  <div class="grid_12">
  	<table class="shadowPage">
  		<tr>
  			<td class="pageLeft">&nbsp;</td>
  			<td class="page">
  			
<?php $this->load->view('subviews/%%(self.obName.lower())%%s_all_view.php'); ?>
	
<hr>
	
<?php $this->load->view('subviews/%%(self.obName.lower())%%_new_view.php'); ?>

  			</td>
  			<td class="pageRight">&nbsp;</td>
  		</tr>
  		<tr>
  			<td class="bottomPageLeft"></td>
  			<td class="bottomPage"></td>
  			<td class="bottomPageRight"></td>
  		</tr>
  	</table>
  	
  </div> <!-- grid_12 -->

</div> <!-- container container_12 -->

</div> <!-- mybody -->

</body>
</html>