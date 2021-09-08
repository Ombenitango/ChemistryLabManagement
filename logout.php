<?php 
session_start();
unset($_SESSION['usenad']);
header("location:index.php");
?>