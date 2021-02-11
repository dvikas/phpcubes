<?php
  /* Function declaration here */
  {
    $is_leap = (!($year %4) && (($year % 100) ||
    !($year % 400)));
    return $is_leap;
  }
  var_dump(is_leap(1987)); /* Displays false */
  var_dump(is_leap()); /* Displays true */
  ?>
