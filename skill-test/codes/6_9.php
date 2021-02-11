<?php
function my_funct($file_name, $data) {
	$f = fopen ( $file_name, 'w' );
	fwrite ( $f, $data );
	fclose ( $f );
}
?> 