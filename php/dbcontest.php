<?php
session_start();
$servername = "localhost";
$username = "stock";
$password = "stock";
$dbname="stock_manager";

// // Create connection
$con = mysqli_connect($servername, $username, $password, $dbname);

if (!$con){
  die("Connection failed: " . mysqli_connect_error());
}

?> 
