<?php 
    $servername = 'localhost';
    $username = "stock";
    $password = "stock";
    $dbname = "stock_manager";

    $userName = "";
    $firstName = "";
    $lastName = "";
    $email = "" ;
    $pwd = "";

    //create connection 
    $conn = new mysqli($servername, $username, $password, $dbname);

    // check connection 

    if($conn->connect_error) {
        die("Connection faild: " . $conn->connect_error);
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

         // hash password
         // test purpos not hashing
         /*
         $salt = 'CSC350'; 
         $pwd = sha1($pwd.$salt);
          */

          $hash= password_hash($pwd, PASSWORD_DEFAULT);
         // create query 
         $sql = "INSERT INTO users (username, firstName, lastName, email, pwd) VALUES 
         ('$userName', '$firstName', '$lastName', '$email', '$hash')";


         //connect and run the query 
         if ($conn->query($sql) === TRUE) {
          echo "New record created successfully";
        
          // After sign up is completed redirect to user_login.php 
          header("Location: user_login.php");
          exit;
        
        } else {
          $msg= "Error: " . $sql . "<br>" . $conn->error;
          echo  $msg; //"Error: " . $sql . "<br>" . $conn->error;
        

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
<nav class="navbar navbar-default">
	<div class="container-fluid">
	  <div class="navbar-header">
		<a class="navbar-brand" href="welcome.php" id="navbar-brand">
		  <p style="color: white;">Stock Manager</p>
		</a>
	  </div>
	</div>
</nav>
    <div class="bg-contact3">
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
    var e = document.forms["signUpForm"]["firstName"].value;
    
    if (a == null || a == "", b == null || b == "", c == null || c == "", d == null|| d == "") {
		alert("Please Fill All Required Field");
		return false;
	  }
	}

	document.getElementsByClassName('navbar-brand')[0]
        .addEventListener('click', function (event) {
			location.replace("http://localhost/stock-manager/php/welcome.php"
	 

	});
  </script>

</body>
</html>

