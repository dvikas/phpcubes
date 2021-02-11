<?php
$global_obj = null;
class my_class {
	var $value;
	function my_class() {
		global $global_obj;
		$global_obj = &$this;
	}
}
$a = new my_class ();
$a->my_value = 5;
$global_obj->my_value = 10;
echo $a->my_value;
