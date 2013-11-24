%[kind : views]
%[file : list%%(self.obName.lower())%%s_view.php] 
%[path : views/json]
<?php
/*
 * Created by generator
 *
 */

$this->load->helper('jsonwrapper/jsonwrapper');

echo json_encode($%%(self.obName.lower())%%s); ?>

