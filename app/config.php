<?php
session_start();  
 $host = "localhost";  
 $username = "stock";  
 $password = "stock";  
 $database = "stock_manager";  
 $message = "";

 try{
    $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 } catch (PDOException $e){
     echo "could not connect to the database";
 }

// mysql connection
$con = mysqli_connect($host,$username,$password,$database,);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
?>
