<?php
  $url =  parse_url($_SERVER['HTTP_REFERER']);

  if($url['host'] != 'www.phpcubes.com' ){
   // exit('sorry..');
  }

  require_once('includes/connection.php');


    $query = 'SELECT `alias` FROM links';
    $where = '';

    if(isset($_POST['query'])){
    // Add validation and sanitization on $_POST['query'] here
      $data = trim(mysql_real_escape_string($_POST['query']));

      $dataArray = explode(' ',$data);
      $dataArray = array_map('trim',$dataArray);
      foreach($dataArray as $val){
        $where .= " `alias` LIKE '%{$val}%' OR";
      }
      $where = rtrim($where,"OR");
    // Now set the WHERE clause with LIKE query
      $query .= " WHERE ($where) AND `status`='1'";
    } else {
      die("YO YO!!");
    }

    $return = array();
//echo $query;
    if($result = mysql_query($query)){
    // fetch object array
    while($obj = mysql_fetch_object($result)) {
    $return[] = $obj->alias;
    }

    }

    $json = json_encode($return);
    print_r($json);
