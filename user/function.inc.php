<?php 
function pr($arr){
  echo "<pre>";
  print_r($arr);
}

function prx($arr){
  echo "<pre style='color:white; background-color:black'>";
  print_r($arr); echo "</br>";
  echo "</pre>";
  die();
  
}

function get_safe_value($con,$str){
  return mysqli_real_escape_string($con,trim($str));
  
}



?>