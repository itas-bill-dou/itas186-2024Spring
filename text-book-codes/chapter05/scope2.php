<?php
function test() {
  global $var;
  $var = 'contents';
  echo 'inside the function, $var = '.$var.'<br />';
}

test();
echo 'outside the function, $var = '.$var;
?>