<?php
require_once("../../includes/connection.php");

$_POST = array_map('trim',$_POST);

$regex = '/(<a.*>)(.*)(<\/a>)/';
if(preg_match($regex, $_POST['alias'], $matches)){
  $alias = ($matches[2]);
  $_POST['alias'] = $alias;
}

update($tableName = 'links', $_POST, $where = "id='$_POST[id]'");

echo json_encode(array('Result'=>'OK'));
