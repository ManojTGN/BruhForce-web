<?php 
include('connection.php');

session_unset();
session_destroy();
header("Location: sign-in.php");
?>