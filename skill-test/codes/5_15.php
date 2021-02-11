<?php
$s = file_get_contents ( "http://www.php.net" );
strip_tags ( $s, array (
		'p' 
) );
echocount ( $s );
?>