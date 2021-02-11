<?php
class my_class {
	var $value;
}

$a = new my_class ();
$a->my_value = 5;
$b = $a;
$b->my_value = 10;

echo $a->my_value;
