<?php
include('session.php');

if (!(isset($_SESSION['login_user']))) {
    header("Location: http://localhost/stock-manager/php/user_login.php");
}


// searchbar 

$string = file_get_contents("../assest/stocks.json");
$myArray = json_decode($string);

?>

<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/custom_welcome.css">
    <link rel="stylesheet" type="text/css" href="../css/user_dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../css/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../css/vendor/css-hamburgers/hamburgers.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body onload="getTIME()">
    <!-- navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <p style="color: white;">Stock Manager</p>
                </a>
                <a class="navbar-brand" href="#" id="logout">
                    <p style="color:white;">Log Out</p>
                </a>
            </div>
        </div>
    </nav>


    <div class="parent">
        <div class="list_alert">
            <ul class="list-group">
                
            </ul>
        </div>

        <div class="timeDiv">
            <div class="clock">
                <div id="time"></div>
                <div id="dateFull"></div>
            </div>
        </div>

        <div class="stock_search">
            <br><br>
            <div class="container" style="width:900px;">
            
                    <input type="text" name="search" id="search" placeholder="Search Employee Details" class="form-control" />
               
                <ul style="width:300px;" class="list-group" id="result">
                <li >test</li>
                    <
                      
            </ul>
            
            </div>

        </div>

        <div class="div4">

        </div>
    </div>



</body>
<script>
    document.getElementsByClassName('logout')[0]
        .addEventListener('click', function(event) {
            location.replace("http://localhost/stock-manager/php/logout.php");
        });
    document.getElementsByClassName('wrap-contact3')[0]
        .addEventListener('click', function(event) {
            location.replace("http://localhost/stock-manager/php/user_login.php");
        });


    // user local time 

    function getTIME() {
        var date = new Date();
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0' + minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        document.getElementById("time").innerHTML = strTime;

        (function() {
            var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'];

            var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            Date.prototype.getMonthName = function() {
                return months[this.getMonth()];
            };
            Date.prototype.getDayName = function() {
                return days[this.getDay()];
            };
        })();



        var day = date.getDayName();
        var month = date.getMonthName();
        var final = date.getDate() + ' ' + month + ' ' + day;
        document.getElementById("dateFull").innerHTML = final;
    }
</script>

<script>
    function getStockName() {
        const request = require('request');

        request('https://finnhub.io/api/v1/stock/symbol?exchange=US&token=bpsmrs7rh5re0jhjnu70', {
            json: true
        }, (err, res, body) => {
            if (err) {
                return console.log(err);
            }
            console.log(body.url);
            console.log(body.explanation);
        });
    }
</script>

</html>