<?php
   include ('session.php');
   
   if(session_destroy()) {
      header("Location: ./user_login.php");
      exit;
   }
?>