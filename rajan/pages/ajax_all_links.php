<?php
require_once("../../includes/connection.php");

$index = isset($_GET['jtStartIndex'])?$_GET['jtStartIndex']:0;
$offset = isset($_GET['jtPageSize'])?$_GET['jtPageSize']:10;
$sort = isset($_GET['jtSorting'])?$_GET['jtSorting']:' position ASC';
$parent_id = isset($_GET['parent_id'])?$_GET['parent_id']:0;


if(isset($_POST['name']) && isset($_POST['select'])){
  //$where = "WHERE `$_POST[select]` LIKE '%$_POST[name]%' AND `status` = '1'";
  $where = "WHERE `$_POST[select]` LIKE '%$_POST[name]%' ";
} else {
  //$where = "WHERE `parent_id` = '$parent_id' AND `status` = '1'";
  //$where = "WHERE  `status` = '1'";
  $where = "WHERE  1 = 1";
}
$query = "SELECT `id`,`title`,`titleOfHead`,`position`,`parent_id`,`alias`,`keywords`,`description`,`hits`,`status`,modified_date
          FROM `links` $where ORDER BY $sort LIMIT $index,$offset";
$result = mysql_query($query)or die(mysql_error());

$totalQuery = "SELECT COUNT(*) as `total`FROM `links` $where ";
$totalResult = mysql_query($totalQuery) or die(mysql_error());
$totalAns = mysql_fetch_assoc($totalResult);

while($ans = mysql_fetch_assoc($result)){
    $ans['display_id'] = '<a target="_blank" href="content.php?id='.$ans['id'].'">'.$ans['id'].'</a>';
    $ans['modified_date'] = date('d-M-Y G:i:a',strtotime($ans['modified_date']));
  $data[] = $ans;
}

$return_data = array('Result'=>'OK','Records'=>$data,'TotalRecordCount'=>$totalAns['total']);
echo json_encode($return_data);
