<?php
session_start();  
 $host = "localhost";  
 $username = "stock";  
 $password = "stock";  
 $database = "stock_manager";  
 $message = "";

 $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
 $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
