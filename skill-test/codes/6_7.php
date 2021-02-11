<?php
$array = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$f = fopen ( "myfile.txt", "r" );
for($i = 0; $i < 50; $i ++) {
	fwrite ( $f, $array [rand ( 0, strlen ( $array ) - 1 )] );
}
?> 