<?php 
//Creating Session If Not Created Already
if(!isset($_SESSION)){
  session_start(); 
}

//Connection To Database And Page Title
$con = mysqli_connect("localhost","root","","mam") or die("connection error");
$title="BRUH FORCE";
?>