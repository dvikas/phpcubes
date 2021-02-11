<?php
error_reporting(0);
$cat_id = isset($_REQUEST['cat_id'])?$_REQUEST['cat_id']:0;
setcookie('cat_'.$cat_id, '',time()-10);

