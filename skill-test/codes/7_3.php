<?php
$a = array_sum ( explode ( ' ', microtime () ) );
for($i = 0; $i < 10000; $i ++)
	;
$b = array_sum ( explode ( ' ', microtime () ) );
echo $b - $a;
?> 