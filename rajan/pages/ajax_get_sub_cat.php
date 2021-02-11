<?php
require_once("../../includes/connection.php");
$parent_id = isset($_POST['id'])?$_POST['id']:0;

if ($parent_id == 0 ) {
  echo json_encode(array());exit;
}
// SELECT PARENT POSTS
    $query_select_parent = "SELECT * FROM `links` WHERE `status`='1' AND `parent_id`='$parent_id' ORDER BY position";
    $result_select_parent = mysql_query($query_select_parent) or die('Selection Fails'.mysql_error());
    if(mysql_num_rows($result_select_parent) > 0){
      $links_title = array();
      $i = 0;
      while($ans = mysql_fetch_array($result_select_parent)){
        $links_title[$i]['title'] = $ans['title'];
        $links_title[$i]['id'] = $ans['id'];
        $i++;
      }
    }
// End SELECT
echo json_encode($links_title);
