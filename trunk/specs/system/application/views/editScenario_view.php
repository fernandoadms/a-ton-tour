<?php
/*
 * Created on 04/05/2010
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
<? echo htmlHeader('Editer un scénario'); ?>

<script language="javascript">
function addNewAction(){
	acquire();
	actions.push("nouvelle action");
	redisplay();
}

function up_item(index){
	if(index == 0){
		return;
	}
	acquire();
	var action = actions[index];
	actions.splice(index,1); // remove the element
	actions.splice(index-1,0,action); // insert before
	redisplay();
}

function down_item(index){
	if(index == actions.length-1){
		return;
	}
	acquire();
	var action = actions[index];
	actions.splice(index,1); // remove the element
	actions.splice(index+1,0,action); // insert after
	redisplay();
}

function delete_item(index){
	acquire();
	var action = actions[index];
	actions.splice(index,1); // remove the element
	redisplay();
}

function acquire(){
	 newActions = new Array();
	 for(var i=0;i<actions.length;i++){
		 newActions.push($("#field_"+i).val());
	 }
	 actions = newActions;
}

function redisplay(){
	$("#newAction").html("");
	for(var i=0;i<actions.length;i++){
		$("#newAction").append("<tr><td width=\"15\">"+(i+1)+"-</td>"+
				"<td><input id='field_"+i+"' name='actions["+i+"]' type='text' value='"+actions[i]+"' size=\"80\"></input></td>"+
				"<td><span onclick='delete_item("+i+")' class='ss_sprite ss_cancel'> &nbsp; </span></td>"+
				"<td><span onclick='up_item("+i+")' class='ss_sprite ss_arrow_up'> &nbsp; </span></td>"+
				"<td><span onclick='down_item("+i+")' class='ss_sprite ss_arrow_down'> &nbsp; </span></td></tr>");
	}
}
var actions = new Array();
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
<h2><img src="<?=base_url()?>www/images/scenario.jpg"/ style="vertical-align:middle;"> 
	<?php if($scenario->scnidscn == ""){
	?> Nouveau scénario 
	<?php } else{
	?>Scénario "<?= $scenario->scnlbscn ?>"<?php } ?></h2>
	<div class="span-12">

<?
$attributes_info = array('name' => 'EditForm');
if(isset($prjidprj) ){
	$fields_info = array('scnidscn' => $scenario->scnidscn, 'cduidcdu' => $scenario->cduidcdu, 'prjidprj' => $prjidprj);
}else {
	$fields_info = array('scnidscn' => $scenario->scnidscn, 'cduidcdu' => $scenario->cduidcdu);
}

echo form_open_multipart('editscenario/save', $attributes_info, $fields_info );
?>
<script language="javascript">
$(document).ready(function() {
		actions = [
<?php foreach($scenario->getActions($this->db) as $action): ?>
	"<?= $action->actlbact ?>",
<?php endforeach;?>
           ];
		redisplay();
	}
);
</script>

	<fieldset>
	<table>
		<tr>
			<td nowrap style="vertical-align:top; width: 80px;"><label for="cdu">CDU</label> : </td>
			<td>
				<?php if(isset($cdus)){ ?>
				<select id="cdu" name="cdu">
					<?php foreach( $cdus as $cdu):?>
					<option value="<?=$cdu->cduidcdu?>"><?= $cdu->cdulbtit ?></option>
					<?php endforeach;?>
				</select>
				<?php }else{ ?>
					<span id="project"><input type="hidden" name="cdu" value="<?= $cdu->cduidcdu ?>"><?= $cdu->cdulbtit ?></span>
				<?php }?>
			</td>
		</tr>
		<tr>
			<td nowrap style="vertical-align:top; width: 80px;"><label for="label">Libellé</label> : </td>
			<td><input type="text" name="label" id="label" value="<?= $scenario->scnlbscn ?>"></td>
		</tr>
		<tr>
			<td nowrap style="vertical-align:top"><label for="type">Type</label> : </td>
			<td>
				<select name="type" id="type">
					<option value="<?= Scenario_model::$typeNOMINAL?>" <?= ($scenario->scntyscn == Scenario_model::$typeNOMINAL)?("selected"):("") ?> >Nominal</option>
					<option value="<?= Scenario_model::$typeALTERNATIF?>" <?= ($scenario->scntyscn == Scenario_model::$typeALTERNATIF)?("selected"):("") ?> >Alternatif</option>
					<option value="<?= Scenario_model::$typeEXCEPTION?>" <?= ($scenario->scntyscn == Scenario_model::$typeEXCEPTION)?("selected"):("") ?> >Exception</option>
				</select>
			</td>
		</tr>
		<tr>
			<td nowrap style="vertical-align:top"><label for="actions">Actions</label> : </td>
			<td>
				<table id="newAction">
				</table>
				<table>
					<tr>
						<td colspan="4">
							<button onclick="addNewAction(); return false">
								<span class="ss_sprite ss_add"> &nbsp; </span>
							</button>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td nowrap style="vertical-align:top"><label for="result">Résultat</label> : </td>
			<td><textarea rows="3" cols="20" style="height: 60px;" name="result" id="result" class="editor_short"><?= $scenario->scnlbres ?></textarea></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button onclick="document.forms['EditForm'].sumbit()">
					<span class="ss_sprite ss_accept"> &nbsp; </span> Enregistrer
				</button>
				<button onclick="document.location.href='<?php if( isset($scenario->scnidscn) ){
	?><?=base_url()?>index.php/editcdu/index/<?=$scenario->cduidcdu?><?= isset($cdus)?(""):("/".$prjidprj) ?><?php } else{
	?><?=base_url()?>index.php/listscenarios<?php } ?>'; return false;">
					<span class="ss_sprite ss_cancel"> &nbsp; </span> Annuler
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

