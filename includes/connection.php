<?php
session_start();
 $debugArr = array();

     $debug = true;
    error_reporting(~E_STRICT);
    define('BASE_URL', "http://www.phpcubes.local");
    @mysql_connect('localhost','root','') or die('unable to connect mysql--localhost');
    mysql_select_db('phpcubes')or die('unable to select database--localhost');


  function quotesTrim($arr){
      $arr = trim($arr);
      $arr = trim($arr, '"');
      return $arr = trim($arr);
  }

  // Called from getDelimiter() to trim space from multi dimention array
  function clean(&$item) {
    $val = trim($item);
    $item = trim($val, '"');
    $item = trim($val);
  }



function pr($data=array(),$line='',$file='')
{
 global $debug;
 global $debugArr;
 if($debug==false)return false;
 $pr = "&nbsp;&nbsp;&nbsp;&nbsp;$file on Line $line<br>";
 $pr .= '<pre style="border-radius:10px;padding:10px 20px;;color:#fff;background-color:#000;font-size:15px;">';
 $pr .= print_r($data,true);
 $pr .= '</pre>';

// echo $pr;exit;
 array_push($debugArr,$pr);
 }

function query($query='',$line='',$file='')
{

  $result = mysql_query($query) or die(mysql_error());
  $query .= "<br> Rows: ".' '.mysql_affected_rows();
  pq($query,$line,$file);
  return $result;
}

function pq($data='',$line='',$file='')
{
    global $debugArr;
     global $debug;
 if($debug==false)return false;
  $pr = "&nbsp;&nbsp;&nbsp;&nbsp;$file on Line $line<br>";
  $pr .='<div style="border-radius:10px;
  padding:5px 20px ;color:black;background-color:gray;font-size:15px;">';
  $pr .= print_r($data,1);
  $pr .= '</div>';
 array_push($debugArr,$pr);
}

function pr1($data=array())
{
  global $debugArr;
   global $debug;
 if($debug==false)return false;
  $pr = '<div style="width:700px;border-radius:10px;
  padding:10px;color:red;background-color:yellow;font-size:20px;">';
  $pr .= print_r($data,1);
  $pr .= '</div>';
 array_push($debugArr,$pr);
}

  /*
   * used to insert values in database
   * */
  function insert($tableName = '', $data = array())
  {
    if(empty($tableName) || empty($data)){ return false;}
    $data = array_map('addslashes',$data);
    $q = '';
    foreach($data as $colName=>$value) {
      $q  .= "`$colName`='$value', ";
    }
    $q = rtrim($q, ', ');
    $query = "INSERT INTO `$tableName`  SET $q";
    mysql_query($query) or die("<h4>Unable to insert</h4><br>".mysql_error());
    return mysql_insert_id();
  }

  /*
   * used to update values in database
   * */
  function update($tableName = '', $data = array(), $where = "")
  {
    if(empty($tableName) || empty($data)){ return false;}

    $q = '';
    foreach($data as $colName=>$value) {
      $value = addslashes($value);
      $q  .= "`$colName`='$value', ";
    }
    $q = rtrim($q, ', ');
    if($where) {
      $query = "UPDATE `$tableName`  SET $q WHERE $where";
    } else {
      die("It's risk to update query without where");
    }
    mysql_query($query) or die("<h4>Unable to insert</h4><br>".mysql_error());
    return mysql_affected_rows();
  }

  /*
   * used to fetch values from database
   * */
  function findAll($tableName = '', $fieldsName = '*', $where = '')
  {
    if(empty($tableName)){ return false;}

    $query = "SELECT $fieldsName FROM `$tableName` $where";

    $result =  mysql_query($query) or die("<h4>Unable to fetch</h4><br>".mysql_error());
    return $result;
  }

function highlight_num($file)
{
  $lines = implode(range(1, count(file($file))), '<br />');
  $content = highlight_file($file, true);


  echo '
    <style type="text/css">
        .num {
        float: left;
        color: gray;
        font-size: 15px;
        font-family: monospace;
        text-align: right;
        margin-right: 6pt;
        padding-right: 6pt;
        border-right: 1px solid gray;}

        body {margin: 0px; margin-left: 5px;}
        td {vertical-align: top;}
        code {white-space: nowrap;}
    </style>';


    echo "<table class=\"table-striped table-hover\"><tr><td class=\"num\">\n$lines\n</td><td>\n$content\n</td></tr></table>";
}

function encrypt($string='')
  {
    $string = trim($string);
    // This is 32 bit salt value change it
    $salt = '9iwjwj455aufj4669gafmdfkt244h45t';

    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,
                                              md5($salt),
                                              $string,
                                              MCRYPT_MODE_CBC,
                                              md5(md5($salt))
                                             )
                              );
    return urlencode($encrypted);
  }

  function decrypt($encrypted='')
  {
        $string = trim($string);

    // This is 32 bit salt value change it
    $salt = '9iwjwj455aufj4669gafmdfkt244h45t';

    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,
                                      md5($salt),
                                      base64_decode($encrypted),
                                      MCRYPT_MODE_CBC,
                                      md5(md5($salt))
                                      ),
                  "\0");
    return urldecode($decrypted);
  }
