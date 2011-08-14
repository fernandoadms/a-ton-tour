<?php
/*
 * Created by JC 11/06/2010
 *
 */

$this->load->helper('form');
$this->load->helper('url');
$this->load->helper('template');
?>

<html>
<head>
<? echo htmlHeader('Specs - login'); ?>

</head>
<body>

<div class="container"> 
	<h1><img src="<?=base_url()?>www/images/logo.jpg"/ style="vertical-align:middle;"> Specs</h1>
	<hr>
	<div class="prepend-1 colborder">
	<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>
	
	<div class="span-6">
		<img src="<?=base_url()?>www/images/key-lock.jpg"/ style="vertical-align:middle;">
		<h2> Identification </h2>
	</div>
	<div class="span-9">
		<fieldset>
<?
$attributes_info = array('name' => 'LoginForm');
$fields_info = array();
echo form_open_multipart('welcome/login', $attributes_info, $fields_info );
?>
	<table>
		<tr><td><label for="login">login</label> : </td><td><input type="text" name="login" id="login"></td></tr>
		<tr><td><label for="password">password</label> : </td><td><input type="password" name="password" id="password"></td></tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['LoginForm'].sumbit()">
					<span class="ss_sprite ss_key"> &nbsp; </span> Connexion
				</button>
			</td>
		</tr>
	</table>
<?
echo form_close('');
?>
	</fieldset>
	</div>
	</div>
	<div class="span-9">
		<p align="right">
		Retour à <a href="http://jc.specs.free.fr/">jc.specs.free.fr</a>
		</p>
	</div>
</div>


</body>
</html>