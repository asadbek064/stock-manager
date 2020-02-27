<?php
   include ('session.php');
   
   if(session_destroy()) {
      header("Location: /php/user_login.php");
      exit;
   }
?>