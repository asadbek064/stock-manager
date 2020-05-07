<?php
## AUTHOR = "Asad & Alain"

# LICENCE MIT

# This is the logout page


   include('session.php');
   
   // Initialize the session.
   session_start();
   // Unset all of the session variables.
   unset($_SESSION['username']);
   // Finally, destroy the session.    
   session_destroy();

   // Include URL for Login page to login again.
   header("Location: user_login.php");
   exit;
   
?>