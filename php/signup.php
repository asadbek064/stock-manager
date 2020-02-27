<?php 
    $servername = 'localhost';
    $username = "stock";
    $password = "stock";
    $dbname = "stock_manager";

    $userName = "";
    $firstName = "";
    $lastName = "";
    $email = "" ;
    //$password = "";

    //create connection 
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check connection 

    if($conn->connect_error) {
        die("Connection faild: " . $conn->connect_error);
    }else{
        echo "Connected successfully";
    }
    //qry var 
    // Check if the form is submitted
    if ( isset( $_POST['submit'] ) ) {
         // get POST data from signup page
         $userName = $_POST["username"];
         $firstName = $_POST["firstName"];
         $lastName = $_POST["lastName"];
         $email = $_POST["email"];
         $password = $_POST["password"];
        
         // hash password
         // create query 
         $sql = "INSERT INTO users (username, firstName, lastName, email, pwd) VALUES 
         ('$userName', '$firstName', '$lastName', '$email', '$password')";

         if ($conn->query($sql) === TRUE) {
             echo "New record created successfully";
          } else {
              echo "Error: " . $sql . "<br>" . $conn->error;
            }

        }

        //echo $sql;

         //connect and run the query 
        //  if ($conn->query($sql) === TRUE) {
        //     echo "New record created successfully";

        // } else {
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }
?>