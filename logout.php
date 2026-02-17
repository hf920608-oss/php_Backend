<?php 
include('config.inc.php');

 unset($_SESSION['login']);   
 unset($_SESSION['admin_name']);
  header("location:index.php");
?>