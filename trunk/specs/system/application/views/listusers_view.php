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
<? echo htmlHeader('User'); ?>

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


	<div class="span-12"><h2><img src="<?=base_url()?>www/images/user.png"/ style="vertical-align:middle;"> Liste des utilisateurs</h2></div>
	<div class="span-7 last" style="float: right;"><?echo $this->session->flashdata('message');?></div>

	<table class="visible">
		<tr class="header">
			<th>Nom</th>
			<th>Login</th>
			<th>Password</th>
			<th>Projets</th>
			<? if($this->session->userdata('user_id') == 0 ){echo "<th>Supprimer</th>";} ?>
		</tr>
	<?php
	$even = true;
	foreach($users as $user):
	?>
		<tr <?=($even)?('class="even"'):('')?>>
			<td valign="top"><span class="ss_sprite ss_user">&nbsp;</span><a title="Modifier ce User" href="<?=base_url()?>index.php/edituser/index/<?=$user->usridusr?>"><?=$user->usrlbnom?></a></td> 
			<td valign="top"><?=$user->usrlblgn?></td> 
			<td valign="top" title="<?=$user->usrlbpwd?>">XXXXXX</td> 
			<td valign="top">
				<?php foreach($user->getProjects($this->db) as $project): ?>
					<a title="Modifier ce projet" href="<?=base_url()?>index.php/editproject/index/<?=$project->prjidprj?>"><?= $project->prjlbtit ?></a>
				<?php endforeach;?>
			</td> 
			<? if($this->session->userdata('user_id') == 0 ){?>
			<td valign="top">
				<a href="#" title="Supprimer ce User" onclick="if(confirm('Desirez vous supprimer ce User ?')){location.href='<?=base_url()?>index.php/listusers/delete/<?=$user->usridusr?>'}">
				<img src="<?=base_url()?>www/images/delete_16.png"></a>
			</td>
			<?} ?>
		</tr>
		
	<?php $even = !$even;
	 endforeach;?>
</table>
<? if($this->session->userdata('user_id') == 0 ){?>
<hr>
<fieldset>
	<legend><img src="<?=base_url()?>www/images/plus_16.png"> Ajouter un User</legend>

<?
$attributes_info = array('name' => 'AddForm');
$fields_info = array();
echo form_open_multipart('listusers/add', $attributes_info, $fields_info );
?>
	<table>
		<tr><td><label for="nom">Nom</label> : </td><td><input type="text" name="nom" id="nom"></td></tr>
		<tr><td><label for="login">Login</label> : </td><td><input type="text" name="login" id="login"></td></tr>
		<tr><td><label for="password">Password</label> : </td><td><input type="text" name="password" id="password"></td></tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['AddForm'].sumbit()">
					<span class="ss_sprite ss_add"> &nbsp; </span> Ajouter
				</button>
			</td>
		</tr>
	</table>

<?
echo form_close('');
?>
</fieldset>
<?} ?>
	</div>
</div>

</body>
</html>
