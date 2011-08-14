<?php
/*
 * Created by generator
 *
 */

$this->load->helper('form');
$this->load->helper('url');
$this->load->helper('template');
?>

<html>
<head>
<? echo htmlHeader('Editer un Etat'); ?>

</head>
<body>


<div class="container">
	<div id="header">
		<img src="<?=base_url() . "www/images/logo.png"?>" style="vertical-align:middle;">
		<?= htmlNavigation( $this->session->userdata('user_id') == 0 ) ?>
		<div class="span-12"><h2><img src="<?=base_url()?>www/images/etat.png" style="vertical-align:middle;"> Etat </h2></div>
	</div>
	
	<div class="prepend-1 append-1">
	
	<fieldset>
<?
$attributes_info = array('name' => 'EditForm');
$fields_info = array('etacdeta' => $etat->etacdeta);
echo form_open_multipart('editetat/save', $attributes_info, $fields_info );
?>
	<table>
		<tr><td><label title="Code de l'état" for="code">* code</label> : </td><td><input type="hidden" name="code" id="code" value="<?= $etat->etacdeta ?>"><?= $etat->etacdeta ?></td></tr>
		<tr><td><label title="Libellé de l'état" for="libelle">* libelle</label> : </td><td><input type="text" name="libelle" id="libelle" value="<?= $etat->etalbeta ?>"></td></tr>
		<tr><td><label title="Activité : R : actif (running) / P : en pause (pause) / T : terminée (terminated) / L : repoussée à plus tard (later) / C : abandonné (canceled)" for="codeActivite">* codeActivite</label> : </td><td><input type="text" name="codeActivite" id="codeActivite" value="<?= $etat->etacdact ?>"></td></tr>
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
	</fieldset>
	</div>
</div>

</body>
</html>
