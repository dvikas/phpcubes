<?php

  $isChild = false;
  $content_with_thumb = false;
  $allParents = array();
  /////////////// Selecting URL ///////////////////
  if($_SERVER['HTTP_HOST'] == "localhost"){

      $len_site_alias = strlen(BASE_URL)-15;
  }else{
      $len_site_alias = 1;
  }

  if(strlen($_SERVER['REQUEST_URI']) == $len_site_alias){
      $link = "php/introduction-of-php.html";
    require_once('includes/all_parents.php');
  }else{
      $fileName = $_SERVER['REQUEST_URI'];
      $lenghOfFile = strlen($fileName);
      $link =  substr($fileName, $len_site_alias, $lenghOfFile);
    require_once('includes/parent_child.php');
  }
  ////////////////// End Selecting URL




