<?php
include('session.php');

if (!(isset($_SESSION['login_user']))) {
    header("Location: user_login.php");
}

echo ($user_check);

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
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">SAHQ</a>
            <a class="navbar-brand ml-auto" href="#"><?php print "$user_check" ?></a>
            <a class="navbar-brand ml-auto" href="logout.php">LOG OUT</a>
        </nav>
    </div>
    <br><br>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="width: 697px;">
                    <div style="width: 740px;">
                        <ul class="list-group" style="width: 548px;">
                            <li class="list-group-item list-group-item-dark">Live Stock Reminders</li>
                            <li class="list-group-item">Item 1</li>
                            <li class="list-group-item">Item 2</li>
                            <li class="list-group-item">Item 3</li>
                            <li class="list-group-item">Item 4</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6" style="width: 490px;"></div>
            </div>
        </div>
    </div>
    <br><br>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" style="width: 300px;" class="input-group" placeholder="Search Stock">
                        <div class="input-group-append"> 
                            <button class="btn btn-secondary" type="button" style="background: #007bff">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <br>
                    <div style="width: 557px;">
                        <ul class="list-group">
                            <li class="list-group-item">RESUTL 1</li>
                            <li class="list-group-item">RESULT 2</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12"><select>
                        <optgroup label="Select when to be alerted">
                            <option value="1" selected="">IF STOCK HITS HIGER THAN</option>
                            <option value="2">IF STOCK HITS LESS THAN</option>
                        </optgroup>
                    </select><input type="number"><button class="btn btn-primary" type="button">ADD</button></div>
            </div>
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