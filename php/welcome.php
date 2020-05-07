<?php 
## AUTHOR = "Alain & Asad"

# LICENCE MIT

# This is welme page that has the user login landing
# page. Designed this was for some better styling

    include ("config.php");
    session_start();
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

    <div class="bg-contact3">
		<div class="container-contact3">
			<div class="wrap-contact3" id ="wrap-contact3">
				<div class="container">
				<p><h1 id="container_text1">Welcome to Stock Manager</h1></p>
					<h5 id="container_text2">Enter to login </h5>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
	document.getElementsByClassName('wrap-contact3')[0]
        .addEventListener('click', function (event) {
			location.replace("http://sahq.000webhostapp.com/php/user_login.php");
        });

        document.getElementsByClassName('navbar-brand')[0]
        .addEventListener('click', function (event) {
			location.replace("http://localhost/stock-manager/php/welcome.php");
        });
</script>
</html>

