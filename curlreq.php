<?php
  include_once('curl.php');
  $c = new CURL();
  
  echo $c->httpGet("https://web.njit.edu/~tmh27/is218/Homework13/main.php");
?>