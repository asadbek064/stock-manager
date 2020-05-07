<?php

## AUTHOR = "Asad"
# Reviewer= "Alain"

# LICENCE MIT

# This is the session component
# enforce security

include('config.php');

   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($con,"select username from users where username = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("Location: user_login.php");
      die();
   }
?>