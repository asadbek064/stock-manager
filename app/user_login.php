<?php
   session_start();
   include ("config.php");

   if($_SERVER["REQUEST_METHOD"] == "POST"){

    $myusername = mysqli_real_escape_string($con,$_POST['username']);
	$mypassword = mysqli_real_escape_string($con,$_POST['password']);
	
	// $sql_query = "SELECT count(*) as cntUser from users WHERE username='".$myusername."' and pwd='".$mypassword."'";

	$query= "SELECT pwd FROM users WHERE username='$myusername";

	$result = mysqli_query($con,$query);

	while($row = mysqli_fetch_array($result) ){
		$currrent_pwd= $row['pwd'];
	}

	if (password_verify($_POST['password'], $currrent_pwd)){
		$_SESSION['login_user'] = $myusername;
		header("Location: user_dashboard.php");
	} else{
		echo "Invalid username and password";
		
	}
}




    // if ($myusername != "" && $mypassword != ""){
    //     $sql_query = "SELECT count(*) as cntUser from users WHERE username='".$myusername."' and pwd='".$mypassword."'";
	// 	$result = mysqli_query($con,$sql_query);
    //     $row = mysqli_fetch_array($result);

    //     $count = $row['cntUser'];

    //     if($count > 0){
	// 			$_SESSION['login_user'] = $myusername;
	// 			header("Location: user_dashboard.php");
			 
    //     }else{
    //         echo "Invalid username and password";
    //     }

	// }




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
<style>
	html{
		overflow: hidden;
	}
</style>

<body>
<!-- navbar -->
<nav class="navbar navbar-default">
	<div class="container-fluid">
	  <div class="navbar-header">
		<a class="navbar-brand" href="#" id="navbar-brand">
			<p style="color: white;">Stock Manager</p>
		</a>
	  </div>
	</div>
  </nav>

    <div class="bg-contact3">
		<div class="container-contact3">
			<div class="wrap-contact3">

				<form class="contact3-form validate-form" name="signUpForm" method="post" action=""  onsubmit="return validateForm()" >
				
					<div class="wrap-input3 validate-input" data-validate="username">
						<input class="input3" type="text" name="username" placeholder="username">
						<span class="focus-input3"></span>
					</div>

					<div class="wrap-input3 validate-input" data-validate="password">
						<input class="input3" type="password" name="password" placeholder="Password">
						<span class="focus-input3"></span>
					</div>
                    <div class ="row">
                        <div class = "col-sm">
					        <div class="container-contact3-form-btn">
					        	<input class="contact3-form-btn" type="submit" value="Log In" name="submit">	
                            </div>
                        </div> 
                        <div class = "col-sm">
                            <div class="container-contact3-form-btn">
                                <input class="contact3-form-btn" type="button" value="Register" onclick="window.location.href= 'signup.php' ">	
                            </div>
                        </div>
                     </div>  
				</form>
			</div>
		</div>
	</div>


    
<!-- input validation check-->
<script type="text/javascript">
	function validateForm() {
	  var a = document.forms["signUpForm"]["username"].value;
      var b = document.forms["signUpForm"]["password"].value;
      
	  if (a == null || a == "", b == null || b == "") {
		alert("Please Fill All Required Field");
		return false;
	  }
	}

	document.getElementsByClassName('navbar-brand')[0]
        .addEventListener('click', function (event) {
			location.replace("http://localhost/stock-manager/php/welcome.php");
        });
  </script>


</body>
</html>


