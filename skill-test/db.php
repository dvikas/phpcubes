<?php
session_start();
  if($_SERVER['HTTP_HOST'] == "www.phpcubes.local"){
     $debug = true;
    error_reporting(~E_STRICT);
    define('BASE_URL', "http://www.phpcubes.local");
    @mysql_connect('localhost','root','') or die('unable to connect mysql--localhost');
    mysql_select_db('phpcubes')or die('unable to select database--localhost');
  } else{
     $debug = false;
    error_reporting(0);
    define('BASE_URL', "http://www.phpcubes.com");

    //mysql_pconnect("173.233.65.100","dynamicw_12",".V5ZtmJGR}^T") or die(mysql_error()."unable to connect mysql--www.dynamicwebstream.com");
    @mysql_connect("localhost","phpcubes1984","x+Q&mc@P?F+]") or die(mysql_error()."unable to connect mysql--www.phpcubes.com");

    mysql_select_db("phpcubes")or die("unable to select database-->www.phpcubes.com");
  }
  
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
//http://utf8-chartable.de/unicode-utf8-table.pl?start=128&number=128&utf8=string-literal
  function cleanCopy($string) {

        $badwordchars=array( //unicode char
            "\xe2\x80\x98", // left single quote
            "\xe2\x80\x99", // right single quote
            "\xe2\x80\x9c", // left double quote
            "\xe2\x80\x9d", // right double quote
            "\xe2\x80\x94", // em dash
            "\xe2\x80\xa6", // elipses
            "\xc2\xb0" // DEGREE SIGN
        );
        $fixedwordchars=array(
            "&#8216;",
            "&#8217;",
            '&#8220;',
            '&#8221;',
            '&mdash;',
            '&#8230;',
            '&#176;'
        );
    
        $string=str_replace($badwordchars,$fixedwordchars,$string);
        $string = iconv("UTF-8", "UTF-8//IGNORE", $string);
        return $string;
    
  }

  function die1($msg=''){
    if( $_SERVER['REMOTE_ADDR'] != '115.112.129.194' ) return false;
  vx($msg);
  exit;
  }

  function pr($data) {

 // if( $_SERVER['REMOTE_ADDR'] != '115.112.129.194' ) return false;

  echo '<pre style="background-color: black; color: white;">', print_r($data, true), '</pre>';

  }
  function pr1($data) { echo '<pre style="background-color: yellow; color: red;">', print_r($data, true), '</pre>'; }
  function pr2($data) { echo '<pre style="background-color: yellow; color: green;">', print_r($data, true), '</pre>'; }

  /*
   * used to insert values in database
   * */
  function insert($tableName = '', $data = array())
  {

  $data = array_map('cleanCopy',$data);
    if(empty($tableName) || empty($data)){ return false;}

    $q = '';
    foreach($data as $colName=>$value) {
       $value = addslashes($value);

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
    $data = array_map('cleanCopy',$data);
    if(empty($tableName) || empty($data)){ return false;}

    $q = '';
    foreach($data as $colName=>$value) {
  if($colName == 'desc'){
  echo 'found';
  }
      $value = addslashes($value);
      $q  .= "`$colName`='$value', ";
    }
    $q = rtrim($q, ', ');
    if($where) {
       $query = "UPDATE `$tableName`  SET $q WHERE $where";
    } else {
      die("It's risk to update query without where");
    }
    mysql_query($query) or die("<h4>Unable to update</h4><br>".mysql_error());
    return mysql_affected_rows();
  }

  /*
   * used to fetch values from database
   * */
  function findAll($tableName = '', $fieldsName = '*', $where = '', $order = '',$limit = '')
  {
    if(empty($tableName)){ return false;}

    $query = "SELECT $fieldsName FROM `$tableName` $where $order $limit" ;
  //pr($query);
    $result =  mysql_query($query) or die("<h4>Unable to fetch</h4><br>".mysql_error());
    return $result;
  }


  function encrypt($string='')
  {
    // This is 32 bit salt value change it
    $salt = '9iwjwj455aufj4669gafmdfkl244h45t';

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
    // This is 32 bit salt value change it
    $salt = '9iwjwj455aufj4669gafmdfkl244h45t';

    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,
                                      md5($salt),
                                      base64_decode($encrypted),
                                      MCRYPT_MODE_CBC,
                                      md5(md5($salt))
                                      ),
                  "\0");
    return urldecode($decrypted);
  }

function convert_quotes($string) {
    $string = " " . $string . " "; //add spaces to beginning and end of string to catch strings that begin and/or end with quotes
    $search = array(" '", //use spaces to determine which direction a quote show curl.
                     "' ",
                     "'",
                     ' "',
                     '" '
    );
    $replace = array("&nbsp;&#8216;",
                    "&#8217;&nbsp;",
                    "&#8217;",
                    "&nbsp;&#8220;",
                    "&#8221;&nbsp;"
    );


//$replace = array('&lsquo;',
                 //'&rsquo;',
                 //'&ldquo;',
                 //'&rdquo;',
                 //'&mdash;');

    return trim(str_replace($search, $replace, $string)); //replace quotes and trim spaces added at beginning of function
}
