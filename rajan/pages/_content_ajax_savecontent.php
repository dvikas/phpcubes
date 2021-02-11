<?php

	require_once("../../includes/connection.php");
	if(!isset($_SESSION['id'])){
		header("location: ".BASE_URL);
		exit;
	}


	$content =  mysql_real_escape_string($_POST['content']);
	$id = $_POST['id'];
	
	if($id==0) { exit(0); }
	
	$query = "UPDATE `links` SET `content`='".$content."' WHERE id = ".$id;
	mysql_query($query) or die('Unable to insert values'.mysql_error());
	
    if(mysql_affected_rows() > 0 ){
      echo 1;
    } else {
	  echo 2;
	}
