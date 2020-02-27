<?php
   define('DB_SERVER',   'localhost');
   define('DB_USERNAME', 'stock');
   define('DB_PASSWORD', 'stock');
   define('DB_DATABASE', 'stock_manager');
  

   $con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
?>
