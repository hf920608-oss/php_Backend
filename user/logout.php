<?php 

    include('config.inc.php');
include('function.inc.php');

unset($_SESSION['login']);
unset($_SESSION['user_name']);
unset($_SESSION['email']);

header("location:login.php");
?>