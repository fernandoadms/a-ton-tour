<?php
/*
 * Created by generator
 *
 */

$this->load->helper('form');
$this->load->helper('url');
$this->load->helper('template');

if($this->session->userdata('user_id') == null) {
	redirect('welcome/index');
}
?>

<html>
<head>
<? echo htmlHeader('Editer un User'); ?>
<script>
function go() {
	document.getElementById("selectedProjectIds").value="";
	var selection = Array();
	for(var i=0;i<document.getElementById("projects").length;i++){
		if (document.getElementById("projects").options[i].selected) {
			selection.push(document.getElementById("projects").options[i].value);
		}
	}
	document.getElementById("selectedProjectIds").value = selection.join(",");
	document.forms['EditForm'].sumbit();
	return true;
}
</script>
</head>
<body>

<div class="container">  
	<div class="prepend column span-15">
		<h1><img src="<?=base_url()?>www/images/logo.jpg"/ style="vertical-align:middle;"> Specs</h1>
	</div>
	<div class="column span-5 last">
		Utilisateur <i><?= $this->session->userdata('user_name'); ?></i> &nbsp;
		<a href="<?=base_url()?>index.php/welcome/logout" title="Logout"><span class="ss_sprite ss_exclamation "></span></a>
	</div>
	
	<div class="column span-24">
		<hr>

<?= htmlNavigation( $this->session->userdata('user_id') == 0 ) ?>
	<h2><img src="<?=base_url()?>www/images/user.png"/ style="vertical-align:middle;"> Utilisateur </h2>
	<div class="span-24">

	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('usridusr' => $user->usridusr);
echo form_open_multipart('edituser/save', $attributes_info, $fields_info );
?>
<input type="hidden" name="selectedProjectIds" id="selectedProjectIds" value="" />

	<table>
		<tr><td><label for="nom">Nom</label> : </td><td><input type="text" name="nom" id="nom" value="<?= $user->usrlbnom ?>"></td></tr>
		<tr><td><label for="login">login</label> : </td><td><input type="text" name="login" id="login" value="<?= $user->usrlblgn ?>"></td></tr>
		<tr><td><label for="password">password</label> : </td><td><input type="text" name="password" id="password" value="<?= $user->usrlbpwd ?>"></td></tr>
		<tr><td><label for="projects" style="vertical-align:top">projets</label> : </td>
			<td>
				<select name="projects" id="projects" size="5" multiple="multiple">
					<?php foreach ($allProjects as $project): ?>
					<option value="<?= $project->prjidprj ?>" <?= ($user->hasProjectId($this->db, $project->prjidprj))?("selected"):("") ?> ><?= $project->prjlbtit ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button onclick="go()">
					<span class="ss_sprite ss_accept"> &nbsp; </span> Enregistrer
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
</div>

</body>
</html>
