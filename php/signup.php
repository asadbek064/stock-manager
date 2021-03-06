<?php
## AUTHOR = "Alain & Asad"

# LICENCE MIT

# This is the sign up page

  include('config.php');
    
    $userName = "";
    $firstName = "";
    $lastName = "";
    $email = "" ;
    $pwd = "";


    // check connection 

    if($con->connect_error) {
        die("Connection faild: " . $con->connect_error);
    }else{
        //echo "Connected successfully";
    }
    $sql = "";
    // Check if the form is submitted
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        echo '   submit working ';
         // get POST data from signup page
         $userName = $_POST["username"];
         $firstName = $_POST["firstName"];
         $lastName = $_POST["lastName"];
         $email = $_POST["email"];
         $pwd = $_POST["password"];
         
         // hashed the password before sending 
         $pwd = password_hash($pwd,PASSWORD_DEFAULT);
         
         // create query 
         $sql = "INSERT INTO users (username, firstName, lastName, email, pwd) VALUES 
         ('$userName', '$firstName', '$lastName', '$email', '$pwd')";


         //connect and run the query 
         if ($con->query($sql) === TRUE) {
          echo "New record created successfully";
        
          // After sign up is completed redirect to user_login.php 
        header("Location: /php/user_login.php");
        
        } else {
          echo "Error: " . $sql . "<br>" . $con->error;
        }

        }
  

        // SINGUP HTML
?>

<!DOCTYPE html>
<html>
    <head>
		
        <link rel="stylesheet" type="text/css" href="../css/util.css">
        <link rel="stylesheet" type="text/css" href="../css/main.css"> 
        <link rel="stylesheet" type="text/css" href="../css/vendor/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" href="../css/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/vendor/animate/animate.css">
        <link rel="stylesheet" type="text/css" href="../css/vendor/css-hamburgers/hamburgers.min.css">     
	</head>

<body>	
<!-- navbar -->
<div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">SAHQ</a>
            <a class="navbar-brand ml-auto" href="#"></a>
            <a class="navbar-brand ml-auto" href="#">ABOUT</a>
        </nav>
</div>
    
    <div class="bg-contact3"">
		<div class="container-contact3">
			<div class="wrap-contact3">
				<form class="contact3-form validate-form"  action=""  method="POST" name="signUpForm"  onsubmit="return validateForm()" >

					<div class="wrap-input3 validate-input" data-validate="username">
						<input class="input3" type="text" name="username" placeholder="username" required>
						<span class="focus-input3"></span>
						
					
					</div>

					<div class="wrap-input3 validate-input" data-validate="firstName">
						<input class="input3" type="text" name="firstName" placeholder="First Name" required>
						<span class="focus-input3"></span>
						<div id ="firstNameError"></div>
					</div>
					<div class="wrap-input3 validate-input" data-validate="lastName">
						<input class="input3" type="text" name="lastName" placeholder="Last Name" required>
						<span class="focus-input3"></span>
						<div id ="lastNameError"></div>
					</div>

					<div class="wrap-input3 validate-input" data-validate = "Valid email is required: ex@abc.xyz" required>
						<input class="input3" type="email" name="email" placeholder="Email">
						<span class="focus-input3"></span>
						<div id ="emailError"></div>
					</div>

					<div class="wrap-input3 validate-input" data-validate="password">
						<input class="input3" type="password" name="password" placeholder="Password">
						<span class="focus-input3"></span>
						<div id ="passwordError"></div>
					</div>



					<div class="container-contact3-form-btn">
						<input class="contact3-form-btn" name="submit" type=submit value="Create account">
						
					</div>
				</form>
			</div>
		</div>
	</div>

<!-- input validation check-->
<script type="text/javascript">
	function validateForm() {
	  var a = document.forms["signUpForm"]["username"].value;
	  var b = document.forms["signUpForm"]["lastName"].value;
	  var c = document.forms["signUpForm"]["email"].value;
	  var d = document.forms["signUpForm"]["password"].value;
	  // a == null || a ==""
	 

	}

	document.getElementsByClassName('navbar-brand')[0]
        .addEventListener('click', function (event) {
			location.replace("https://sahq.000webhostapp.com/php/welcome.php");
        });
  </script>


</body>
</html>

