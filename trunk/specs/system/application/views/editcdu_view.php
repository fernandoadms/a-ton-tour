<?php
/*
 * Created on 03/04/2010
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
<? echo htmlHeader('Editer un cas d\'utilisation'); ?>

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
	<h2><img src="<?=base_url()?>www/images/cdu.png" style="vertical-align:middle;" /> Cas d'utilisation "<?=$cdu->cdulbtit?>"</h2>
	<div class="span-20">
	
	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('identifiant' => $cdu->cduidcdu);
echo form_open_multipart('editcdu/save', $attributes_info, $fields_info );
?>
	<table>
		<tr>
			<td><label for="project">Projet</label> : </td>
			<td>
				<?php if(isset($projects)){ ?>
				<select name="project" id="project">
					<?php foreach($projects as $project): ?>
						<option value="<?= $project->prjidprj ?>" <?= ($cdu->prjidprj == $project->prjidprj)?("selected"):("") ?>><?= $project->prjlbtit ?></option>
					<?php endforeach; ?>
				</select>
				<?php }else{ ?>
					<span id="projet"><input type="hidden" name="masterProject" value="<?= $project->prjidprj ?>"><?= $project->prjlbtit ?></span>
				<?php }?>
			</td>
		</tr>
		<tr>
			<th style="vertical-align:top;" nowrap><label for="titre">Titre</label> :</th>
			<td colspan="2"><input style="width:100%" type="text" name="titre" id="titre" value="<?= $cdu->cdulbtit ?>"></td>
		</tr>
		<tr>
			<th nowrap><label for="numero">Numéro</label> : </th>
			<td><input type="text" name="numero" id="numero" value="<?= $cdu->cdulbnum ?>" /></td>
		</tr>
		<tr>
			<th style="vertical-align:top;" nowrap><label for="description">Description</label> : </th>
			<td><textarea style="width: 100%; height: 80px;" name="description" id="description" class="editor_detail"><?= $cdu->cdulbdes ?></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['EditForm'].sumbit()">
					<span class="ss_sprite ss_accept"> &nbsp; </span> Enregistrer
				</button>
				<?php if( !isset($projects)){ ?>
				&nbsp;
				<button onclick="document.location.href='<?=base_url()?>index.php/editproject/index/<?= $project->prjidprj.'#cdu_'.$cdu->cduidcdu?>';return false;">
					<span class="ss_sprite ss_control_rewind"> &nbsp; </span> Retour au projet
				</button>
				<?php } ?>
			</td>
		</tr>
	</table>
<?
echo form_close('');
?>
	</fieldset>
	</div>
	
	<div class="span-20">
		<h3><img src="<?=base_url()?>www/images/rdg.jpg" style="vertical-align:middle;"/> Regles de gestion</h3>
		<table class="visible">
			<tr class="header">
				<th>Numéro</th>
				<th>Type</th>
				<th>Enoncé</th>
			</tr>
			<?php $even = true;
			foreach($cdu->getAllRdgs($this->db) as $rdg): ?>
			<tr <?=($even)?('class="even"'):('')?>>
				<td valign="top"><?=$rdg->rdgnurdg?></td>
				<td valign="top"><?=$rdg->getLabelType()?></td>
				<td valign="top"><?=$rdg->rdglbeno?></td>
			</tr>
			<?php  $even = !$even;
			endforeach;?>
		</table>
		<button onclick="document.location.href='<?=base_url()?>index.php/selectrdg/index/<?= $cdu->cduidcdu ?><?= isset($projects)?(""):("/".$project->prjidprj) ?>'">
			<span class="ss_sprite ss_add"> &nbsp; </span> Sélection des règles de gestion
		</button>
		<br><br>
		<hr>
		<h3><img src="<?=base_url()?>www/images/scenario.jpg"/ style="vertical-align:middle;">Scenarios</h3>
		<table class="visible">
			<tr class="header">
				<th>Libellé</th>
				<th>Type</th>
				<th>Résultat</th>
			</tr>
			<?php $even = true;
			foreach($cdu->getAllScenarios($this->db) as $scenario): ?>
			<tr <?=($even)?('class="even"'):('')?>>
				<td><span class="ss_sprite ss_flag_blue">&nbsp;</span> <a name="scn_<?=$scenario->scnidscn?>" title="Modifier ce scenario" href="<?=base_url()?>index.php/editscenario/index/<?=$scenario->scnidscn?>"><?=$scenario->scnlbscn?></a></td>
				<td><?= $scenario->scntyscn ?></td>
				<td><?= $scenario->scnlbres ?></td>
			</tr>
			<?php  $even = !$even;
			endforeach;?>
		</table>
		<button onclick="document.location.href='<?=base_url()?>index.php/editscenario/create/<?= $cdu->cduidcdu ?><?= isset($projects)?(""):("/".$project->prjidprj) ?>'">
			<span class="ss_sprite ss_add"> &nbsp; </span> Créer un scénario
		</button>
	</div>
</div>
</div>
</body>
</html>

