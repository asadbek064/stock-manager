<?php
   include ("config.php");
   $errorLogin  = False;

   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST"){

    $myusername = mysqli_real_escape_string($con,$_POST['username']);
    $mypassword = mysqli_real_escape_string($con,$_POST['password']);
    
	/*
	$salt = 'CSC350'; 
	$mypassword = sha1($mypassword.$salt);
	*/

    if ($myusername != "" && $mypassword != ""){
		
        $sql_query = "SELECT count(*) as cntUser from users WHERE username='".$myusername."' and pwd='".$mypassword."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
         	$_SESSION['login_user'] = $myusername;
            header("Location: https://sahq.000webhostapp.com/php/user_dashboard.php");
			 
        }else{
             $errorLogin = True;
        }

	}
}


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
<div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">SAHQ</a>
            <a class="navbar-brand ml-auto" href="#"></a>
            <a class="navbar-brand ml-auto" href="#">ABOUT</a>
        </nav>
    </div>

    <div class="bg-contact3">
		<div class="container-contact3">
			<div class="wrap-contact3">

				<form class="contact3-form validate-form" name="signUpForm" method="post" action=""  >
				
					<div class="wrap-input3 validate-input" data-validate="username">
						<input class="input3" type="text" name="username" placeholder="username" required>
						<span class="focus-input3"></span>
					</div>

					<div class="wrap-input3 validate-input" data-validate="password">
						<input class="input3" type="password" name="password" placeholder="Password">
                        <span class="focus-input3"></span>
                    </div>
                    <?php 
                        if($errorLogin == True){
                            echo "<small class ='text-danger' style='font-size: 18px'>Invalid username and password</small>";
                        }else{}
                     ?>
                    <div class ="row">
                        <div class = "col-sm">
					        <div class="container-contact3-form-btn">
					        	<input class="contact3-form-btn" type="submit" value="Log In" name="submit" required>	
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
	
	document.getElementsByClassName('navbar-brand')[0]
        .addEventListener('click', function (event) {
			location.replace("https://sahq.000webhostapp.com/php/welcome.php");
        });
  </script>


</body>
</html>


