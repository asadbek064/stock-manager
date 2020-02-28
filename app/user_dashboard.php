<?php 
	include ('session.php');

    if (!(isset($_SESSION['login_user']))) {
        header("Location: user_login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
		
        <link rel="stylesheet" type="text/css" href="../css/util.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css"> 
		<link rel="stylesheet" type="text/css" href="../css/custom_welcome.css">
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
		<a class="navbar-brand" href="#">
			<p style="color: white;">Stock Manager</p>
        </a>
        <a class="navbar-brand" href="logout.php" id="logout">
            <p style="color:white;" >Log Out</p>    
        </a>
	  </div>
	</div>
  </nav>

    <div class="bg-contact3">
		<div class="container-contact3">
			<div class="wrap-contact3" id ="wrap-contact3">
				<div class="container">
				<p><h1 id="container_text1">Welcome to Stock Manager</h1></p>
					<h5 id="container_text2"> 
						Current User: <?php echo $login_session; ?>
					</h5>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
    document.getElementsByClassName('logout')[0]
        .addEventListener('click', function (event) {
			location.replace("http://localhost/stock-manager/php/logout.php");
        });
	document.getElementsByClassName('wrap-contact3')[0]
        .addEventListener('click', function (event) {
			location.replace("./user_login.php");
        });
</script>
</html>