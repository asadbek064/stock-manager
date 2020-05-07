<?php
## AUTHOR = "Asad & Asad"
# LICENCE MIT

# This is the config file
# I have redicted the sensitive data.
  $servername = 'localhost';
  $username = 'REDACTED';
  $password = 'REDACTED';
  $dbname = 'REDACTED';
  

   $con = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$con) {
     die("Connection failed: " . mysqli_connect_error());
    }
?>
