<?php

   function start_cronjob_checkOrder(){
        include('apikey.php');
        include('config.php');
        /* cron job script this script will check all the orders in user_stock_alert 
        and check if there target price is true based on prices on stockPrices table*/

        $sqlGetOrders = "SELECT order_id, userID, stockName,targetPrice, ifGTRtarget, ifLStarget, isCompleted FROM user_stock_alert";
        $results = mysqli_query($con,$sqlGetOrders);

        if(!$results){
            echo "could not run query: ". $con->error;
        }
        else {
            if(mysqli_num_rows($results) >= 1){
                while($row = mysqli_fetch_array($results)){
                    $orderID = $row['order_id'];
                    $order_userID = $row['userID'];
                    $orderStockName = $row['stockName'];
                    $orderTargetPrice = $row['targetPrice'];
                    $orderIfGTRtarget = $row['ifGTRtarget'];
                    $orderIfLStarget = $row['ifLStarget'];
                    $orderIsCompleted = $row['isCompleted'];

                    echo $orderID.' '.$order_userID.' '.$orderStockName.' '.$orderTargetPrice.' '.$orderIfGTRtarget.' '.$orderIfLStarget. '<br>';
                    $orderComplet = False;

                    $liveStockPrice = getPriceFrom_liveStocks($orderStockName,$con);
                        
                    if($orderIfGTRtarget){
                        // check if target price is GTR target 
                        if($orderTargetPrice >= $liveStockPrice){
                            $orderComplet = True;
                        }
                    }elseif($orderIfLStarget){
                        if($orderTargetPrice <= $liveStockPrice){
                            $orderComplet = True;
                        }
                    }
                    
                    // if order is satisfied send user email and set isCompleted to True
                    if($orderComplet && !$orderIsCompleted){
                        //get users data 
                        $sqlGetEmail = "SELECT userID, username, firstName, lastName, email FROM users";
                        $results = mysqli_query($con,$sqlGetEmail);
                        
                        if(!$results) {
                            echo "error: get user data ". $con->error;
                        }else{
                            if(mysqli_num_rows($results) > 0){
                                while($row = mysqli_fetch_assoc($results)) {
                                        
                                    $userID = $row["userID"];
                                    $userFirstName = $row["firstName"];
                                    $userLastName = $row["lastName"];
                                    $userEmail = $row["email"];
                                    echo $userID.' '.$userFirstName.' '. $userLastName.' '.$userEmail.'<br>';
            
                                    if($userID == $order_userID){
                                        //prep email and send it 
                                        $from = "sahq064@gmail.com";
                                        $subject = " SAQH alert notification";
                                        $triggerType = "";
                                        
                                        if($orderIfGTRtarget){
                                            $triggerType = "is greater than ";
                                        }elseif($orderIfLStarget){
                                            $triggerType = "is less than ";
                                        }
                                            
                                        //send email 
                                        sendEmailAlert($from, $userEmail, $subject, $userFirstName, $userLastName, $orderStockName, $orderTargetPrice, $triggerType);
                                    }
                                
                                        
                                    }   
                            }
                                
    
                        
                        orderCompleted($con,$orderID);
                    }
                }
            }
        }
    }
        

        //function to get liveStocksPrice
        function getPriceFrom_liveStocks($symbol,$con){
            $sql = "SELECT symbol, stockPrice FROM livestocks";
            $results =  mysqli_query($con,$sql);

            if(!$results){
                echo "could not run query: ". $con->error;
            }else {
                if(mysqli_num_rows($results) >=1){
                    while($row = mysqli_fetch_array($results)){
                        $tableSymbol = $row["symbol"];
                        
                        if($symbol == $tableSymbol){
                            $stockPrice = $row["stockPrice"];
                            return $stockPrice;
                        }
                    }
                }
            }

        }

        function orderCompleted($con, $orderID){
            $true = True;
            $orderID  = intval($orderID);
            $sql = "UPDATE user_stock_alert SET isCompleted = 1 WHERE `order_id` = '$orderID' ";
            
            if($con->query($sql) == TRUE){
                echo " <br>stock isCompleted updated";
            }
            else{
                echo "error: ". $con->error;
            }
        }
        
        function sendEmailAlert($from, $to, $subject, $firstName, $lastName, $stockSymbol, $targetPrice, $triggerType){
            $message = " <h1> Alert $firstName ' '$lastName</h2>";
            $message .= "<h2> Your Stock $stockSymbol is $triggerType $targetPrice </h2>";
        
            $header = "From:".$from."\r\n";
            $header .= "Cc:".$to."\r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $retval = mail($to,$subject,$message,$header);

            if( $retval == true) { 
                echo "message sent successfully...";
            }else {
                echo "message could not be sent...";
            }
        }
   }