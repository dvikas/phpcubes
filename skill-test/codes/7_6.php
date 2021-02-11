<?php
$a = strtotime ( '00:00:00 Feb 231976EST' );
$b = strtotime ( '00:00:00 Feb 231976CST' );
echo $a - $b;
?> 