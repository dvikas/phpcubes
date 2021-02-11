<?php
class my_class {
	var $my_var;
	function _my_class($value) {
		$this->my_var = $value;
	}
}
$a = new my_class ( 10 );
echo $a->my_var;
