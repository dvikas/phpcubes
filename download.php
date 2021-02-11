<?php
  require_once('includes/connection.php');
ob_start();
$fileserver_path = './upload/php/'; // change this to the directory your files reside
$req_file='';

$arrFilesDir = array();
if ($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            $arrFilesDir[] = $entry;
        }
    }
    closedir($handle);
}

if (isset($_GET['file'])) {
  $req_file = ($_GET['file']);
} else {
  die("Why you are trying to do this :(");
}

$get_req_file = ($req_file);
$req_file = decrypt($req_file);
//echo "$fileserver_path/$req_file";
$whoami = basename(__FILE__); // you are free to rename this file

if (empty($req_file)) {
  print "Usage: $whoami?file=&lt;file_to_download&gt;";
  exit;
}

/* no web spamming */
if (!preg_match("/^[\/ a-zA-Z0-9._-]+$/", $req_file, $matches)) {
  print "File doesn't exist.";
  exit;
}

/* download any file, but not this one */
if ($req_file == $whoami ||
    in_array($req_file, $arrFilesDir) ||
    (strpos($req_file, 'manager') !== false ) ||(strpos($req_file, '/db.php') !== false ) ||
    (strpos($req_file, '..') !== false )

    ) {
  print "File doesn't exist.";
  exit;
}

/* check if file exists */
if (!file_exists("$fileserver_path/$req_file")) {
  print "File doesn't exist.";
  exit;
}


if (empty($_GET['send_file'])) {
$get_req_file = urlencode($get_req_file);
  header("Refresh: 1; url=download.php?file=$get_req_file&send_file=yes");
} else {

  header('Content-Description: File Transfer');
  header('Content-Type: application/force-download');
  header('Content-Length: ' . filesize("$fileserver_path/$req_file"));
  header('Content-Disposition: attachment; filename=' . $req_file);
  readfile("$fileserver_path/$req_file");
  exit;
}
echo '<center><p>Your download will start automatically. Please wait... <br>Check your <strong>Downloads</strong> folder for downloaded file.</p>';
echo '<h3>Downloading '.$req_file.'...</h3></center>';
//echo '<p>Your download should begin shortly. If it doesn\'t start,
//follow this <a href="'.$fileserver_path.''.$req_file.'">link</a>.</p>';
//http://www.phpcubes.com/download.php?file=apps/detect-input-number-as-spam.php
