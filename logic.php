<?php
require_once('includes/connection.php');
///////////////////////////// PEAR SYNTAX HIGHLIGHT  ////////////////
// figure out the if ":" or ";" should be used for ini separators
if (strpos(strtoupper(PHP_OS), "WIN") !== false) {
    define("INI_PATH_SEPARATOR", ";");
} else {
    define("INI_PATH_SEPARATOR", ":");
}
// add PEAR to the path
      ini_set(
        "include_path",
        ini_get("include_path") . INI_PATH_SEPARATOR .
        realpath("PEAR")
       );
/*
  $languages = array(
      'php', 'cpp', 'css', 'diff', 'dtd', 'javascript',
      'mysql', 'perl', 'python', 'ruby', 'sql', 'xml'
  );
*/
  $languages = array('php','javascript','mysql');

//////////////////////////////////////////////////////
  require_once './Text/Highlighter.php';
  require_once './Text/Highlighter/Renderer/Html.php';
//////////////////////////////////////////////////////

  $request = "";
  if($_SERVER['HTTP_HOST'] == "localhost"){
      $len_site_alias = strlen(BASE_URL)-strlen(BASE_URL)-1;
  }else{
      $len_site_alias = 1;
  }

  if(strlen($_SERVER['REQUEST_URI']) == $len_site_alias){
      $request = "php/introduction-of-php.html";
  }else{
      $fileName = $_SERVER['REQUEST_URI'];
      $lenghOfFile = strlen($fileName);
      $request =  substr($fileName, $len_site_alias, $lenghOfFile);
  }
  $request = mysql_real_escape_string($request);
if(strpos($request, 'tag/') !== false) {
  $isSearch = explode('/',$request);
  $isSearch = $isSearch[1];
  require_once('includes/search_logic.php');

} else {
  require_once('includes/main_logic.php');
}
