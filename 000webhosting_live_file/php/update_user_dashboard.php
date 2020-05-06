<?php 
    function liveStockReminders(){
        include('config.php');
        include('session.php');

        $sqlGetOrders = "SELECT order_id, userID, stockName,targetPrice, ifGTRtarget, ifLStarget, isCompleted FROM user_stock_alert";
        $resultsOrder = mysqli_query($con,$sqlGetOrders);

        if(!$resultsOrder){
            echo "could not run query: ". $con->error;
        }
        else {
                        $sqlGetEmail = "SELECT userID, username, firstName, lastName, email FROM users";
                        $results = mysqli_query($con,$sqlGetEmail);
                        
                        if(!$results) {
                            echo "error: get user data ". $con->error;
                        }else{
                            if(mysqli_num_rows($results) > 0){
                                while($row = mysqli_fetch_assoc($results)) {
                                        
                                    $userID = $row["userID"];
                                    $usernameUsername = $row["username"];
                                    $userFirstName = $row["firstName"];
                                    $userLastName = $row["lastName"];
                                    $userEmail = $row["email"];
                                    
                                    if($user_check == $usernameUsername){
                                    
                                            // this is the correct user 
                                            $usersAlerts = [];
                                            $usersAlerts = getUserArray($resultsOrder, $userID);
                                            $final = "";
                                            for($i = 0; $i <sizeof($usersAlerts); $i++){
                                                $current = $usersAlerts[$i];
                                                $final .=  "<li class='list-group-item'>$current</li>";
                                            }

                                            echo $final;
                                    }
                                }
                            }
                        }
                
            }
        }

        function getUserArray($results, $userID){
            $userAlerts = [];
            if(mysqli_num_rows($results) >= 1){
                while($row = mysqli_fetch_array($results)){
                    $orderID = $row['order_id'];
                    $order_userID = $row['userID'];
                    $orderStockName = $row['stockName'];
                    $orderTargetPrice = $row['targetPrice'];
                    $orderIfGTRtarget = $row['ifGTRtarget'];
                    $orderIfLStarget = $row['ifLStarget'];
                    $orderIsCompleted = $row['isCompleted'];

                    if($order_userID == $userID){
                        $ifGTR= "";
                        $ifLS = "";
                        
                        $orderStatus = "Order: ";
                        if($orderIsCompleted){
                            $orderStatus .= " Done";
                        }else { $orderStatus .= " notDone";}
                    

                        $orderTargetPrice = "<span style='color:#85bb65;font-size: large;'>$$orderTargetPrice</span>";
                        $orderStockName =  "<span style='color:#1FE6B5;  font-weight: bold; font-size:large;'>$orderStockName</span>";
                        $extra = " Remind me at: ";

                        // get current price of stock 
                        //function getStockPrice($con , $symbol) {
                            if($orderIfGTRtarget){
                                $ifGTR .= "if it's greated than: ";
                                array_push($userAlerts, "$orderStockName $ifGTR $orderTargetPrice $orderStatus");
                            }else if($orderIfLStarget){
                                $ifLS .= "if it's less than: ";
                                array_push($userAlerts, "$orderStockName $ifLS $orderTargetPrice $orderStatus");
                            }
                    }
        }
        return $userAlerts;
    }
}

?>