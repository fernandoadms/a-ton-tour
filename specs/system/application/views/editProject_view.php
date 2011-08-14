<?php
/*
 * Created on 06/04/2010
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
<? echo htmlHeader('Editer un projet'); ?>

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
	<h2><img src="<?=base_url()?>www/images/projet.jpg"/ style="vertical-align:middle;"> Projet "<?= $project->prjlbtit ?>"</h2>
	<div class="span-24">

	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('prjidprj' => $project->prjidprj);
echo form_open_multipart('editproject/save', $attributes_info, $fields_info );
?>

	<table>
		<tr>
			<th style="width: 15%"><label for="title">Titre</label> : </th>
			<td><input type="text" name="title" id="title" value="<?= $project->prjlbtit ?>"></td>
		</tr>
		<tr>
			<th style="vertical-align:top;"><label for="description">Description</label> : </th>
			<td><textarea rows="3" cols="20" style="width: 100%; height: 100px;" name="description" id="description" class="editor_detail"><?= $project->prjlbdes ?></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['EditForm'].sumbit()">
					<span class="ss_sprite ss_accept"> &nbsp; </span> Enregistrer
				</button>
			</td>
		</tr>
	</table>
<?
echo form_close('');
?>
	<table>
		<tr>
			<td colspan="2" style="background-image: url(<?=base_url()?>www/images/rdg.jpg); background-repeat: no-repeat; padding-left: 100px" height="64">
				<h3> Liste des règles de gestion</h3>
				<p class="small quiet">Décrire ici les contraintes du métier qui doivent être appliquées dans tout le logiciel.</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="visible">
					<tr class="header">
						<th style="width:20%;">Numéro</th>
						<th style="width:15%;">Type</th>
						<th style="width:50%;">Enoncé</th>
						<th style="width:15%;">Schémas</th>
					</tr>
				<?php
				$even = true;
				foreach($project->getRdgs($this->db) as $rdg):
				?>
					<tr <?=($even)?('class="even"'):('')?>>
						<td style="vertical-align:top;"><a name="rdg_<?=$rdg->rdgidrdg?>" href="<?=base_url()?>index.php/editrdg/index/<?=$rdg->rdgidrdg?>/<?=$project->prjidprj?>"><?=$rdg->rdgnurdg?></a></td>
						<td style="vertical-align:top;"><?=$rdg->getLabelType()?></td>
						<td style="vertical-align:top;"><?=$rdg->rdglbeno?></td>
						<td style="vertical-align:top;">
							<?php foreach($rdg->getSchemas($this->db) as $schema): ?>
								<a title="<?= $schema->schlbtit ?>" href="<?=base_url() . $schema->getImageFileURL()?>"><img width="100" src="<?=base_url() . $schema->getImageFileURL()?>"></a><br></br>
							<?php endforeach;?>
						</td>

					</tr>
					
				<?php $even = !$even;
				 endforeach;?>
					<tr>
						<td colspan="4"><hr/></td>
					</tr>
<!-- Formulaire inline RdG -->
				 	<tr>
				 		<td style="vertical-align:top"><a name="rdg_"></a>
							<?
							$attributes_info = array('name' => 'AddRdg');
							$fields_info = array();
							echo form_open_multipart('editproject/addrdg', $attributes_info, $fields_info );
							?>
							<input type="hidden" id="project" name="project" value="<?=$project->prjidprj?>">
							<input type="text" name="number" id="number">
						</td>
						<td style="vertical-align:top">
							<select name="type" id="type">
								<option value="F">Fonctionnelle</option>
								<option value="T">Technique</option>
							</select>
						</td>
						<td style="vertical-align: top;">
							<textarea style="width: 100%; height: 38px;" name="anounce" id="anounce" class="editor_short"></textarea>
						</td>
						<td style="vertical-align: top;">
							<button title="Ajouter la règle de gestion" onclick="document.forms['AddRdg'].sumbit()">
								<span class="ss_sprite ss_add"> &nbsp; </span> 
							</button>
							<?
							echo form_close('');
							?>
							
						</td>
				 	</tr>
<!-- FIN Formulaire inline RdG -->
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"><HR/></td>
		</tr>
		<tr>
			<td colspan="2" style="background-image: url(<?=base_url()?>www/images/cdu.png); background-repeat: no-repeat; padding-left: 100px" height="64">
				<h3> Liste des cas d'utilisations</h3>
				<p class="small quiet">Décrire ici les différentes utilisations d'une partie du logiciel</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="visible">
					<tr class="header">
						<th>Titre</th>
						<th>Numéro</th>
						<th>Description</th>
					</tr>
				<?php
				$even = true;
				foreach($project->getCdus($this->db) as $cdu):
				?>
					<tr <?=($even)?('class="even"'):('')?>>
						<td style="vertical-align:top"><span class="ss_sprite ss_cog">&nbsp;</span> <a name="cdu_<?=$cdu->cduidcdu?>" href="<?=base_url()?>index.php/editcdu/index/<?=$cdu->cduidcdu?>/<?=$project->prjidprj?>"><?=$cdu->cdulbtit?></a></td>
						<td style="vertical-align:top"><?=$cdu->cdulbnum?></td>
						<td style="vertical-align:top"><?=$cdu->cdulbdes?></td>
					</tr>
					
				<?php $even = !$even;
				 endforeach;?>
<!-- Formulaire inline CDU -->
				 	<tr>
				 		<td style="vertical-align:top"><a name="cdu_"></a>
							<?
							$attributes_info = array('name' => 'AddCDU');
							$fields_info = array();
							echo form_open_multipart('editproject/addcdu', $attributes_info, $fields_info );
							?>
							<input type="hidden" id="projet" name="projet" value="<?=$project->prjidprj?>">
							<input type="text" name="titre" id="titre">
						</td>
						<td style="vertical-align:top">
							<input type="text" name="numero" id="numero">
						</td>
						<td style="vertical-align: top;">
							<textarea style="width: 100%; height: 38px;" name="description" id="description" class="editor_short"></textarea>
						
							<button title="Ajouter le CDU" onclick="document.forms['AddCDU'].sumbit()">
								<span class="ss_sprite ss_add"> &nbsp; </span> 
							</button>
							<?
							echo form_close('');
							?>
							
						</td>
				 	</tr>
<!-- FIN Formulaire inline CDU -->
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"><HR/></td>
		</tr>
		
<!-- OBJETS -->
		<tr>
			<td colspan="2" style="background-image: url(<?=base_url()?>www/images/objet.jpg); background-repeat: no-repeat; padding-left: 100px" height="64">
				<h3><a name="obj_"></a>Liste des objets</h3>
				<p class="small quiet">Décrire ici les différentes objets manipulés par le logiciel</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="visible">
					<tr class="header">
						<th>Libelle</th>
						<th>Description</th>
					</tr>
				<?php
				$even = true;
				foreach($project->getObjets($this->db) as $objet):
				?>
					<tr <?=($even)?('class="even"'):('')?>>
						<td style="vertical-align:top"><span class="ss_sprite ss_brick">&nbsp;</span> <a name="obj_<?=$objet->objidobj?>" href="<?=base_url()?>index.php/editobjet/index/<?=$objet->objidobj?>/<?=$project->prjidprj?>"><?=$objet->objlblib?></a></td>
						<td style="vertical-align:top"><?=$objet->objlbdes?></td>
					</tr>
					
				<?php $even = !$even;
				 endforeach;?>
<!-- Formulaire inline Objets -->
				 	<tr>
				 		<td style="vertical-align:top"><a name="objet_"></a>
							<?
							$attributes_info = array('name' => 'AddObjet');
							$fields_info = array();
							echo form_open_multipart('editproject/addobjet', $attributes_info, $fields_info );
							?>
							<input type="hidden" id="projet" name="projet" value="<?=$project->prjidprj?>">
							<input type="text" name="libelle" id="libelle" >
		
						</td>
						<td style="vertical-align: top;">
							<textarea style="width: 100%; height: 38px;" name="description" id="description" class="editor_short"></textarea>
						
							<button title="Ajouter l'objet" onclick="document.forms['AddObjet'].sumbit()">
								<span class="ss_sprite ss_add"> &nbsp; </span> 
							</button>
							<?
							echo form_close('');
							?>
							
						</td>
				 	</tr>
<!-- FIN Formulaire inline Objets -->
				</table>
			</td>
		</tr>
	</table>

	</fieldset>
	</div>
	</div>
</div>

</body>
</html>

