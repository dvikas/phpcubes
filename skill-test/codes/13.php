<?php
  function process($c, $d = 25)
  {
  global $e;
  $retval = $c + $d - $_GET['c'] - $e;
  return $retval;
  }
  $e = 10;
  echo process(5);
?>
