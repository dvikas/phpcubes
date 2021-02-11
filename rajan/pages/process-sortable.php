<?php
require_once("../../includes/connection.php");
if(isset($_GET['child'])) {
  foreach ($_GET['child'] as $position => $item) {
    $query = "UPDATE `links` SET `position` = $position WHERE `id` = $item";
    mysql_query($query);
    $sql[] = $query;
  }
}

if(isset($_GET['parent'])) {
  foreach ($_GET['parent'] as $position => $item) {
    $query = "UPDATE `links` SET `position` = $position WHERE `id` = $item";
    mysql_query($query);
    $sql[] = $query;
  }
}
echo "Order Updated..";
