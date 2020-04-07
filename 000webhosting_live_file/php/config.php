<?php
  $servername = 'localhost';
  $username = 'id12800622_sahq064';
  $password = '>A)ho]m4>N>GkO+e';
  $dbname = 'id12800622_stockmanager';
  

   $con = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$con) {
     die("Connection failed: " . mysqli_connect_error());
    }
?>
