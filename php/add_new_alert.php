<?php 
include('search.php');
include('config.php');

$targetOptionChoice;
$currentStockChoice;
$targetPrice = 0;
$ifGTRtarget = False;
$ifLStarget  = False;


if (isset($_POST['targetSearchbox'])) {
    $targetPrice = $_POST['targetSearchbox'];
    $targetOptionChoice = $_POST['alertState'];
    $currentStockChoice = $_POST['hiddenInput'];

    if($targetOptionChoice == 1 ){
        $ifGTRtarget = True;
        $ifLStarget = False;
    }elseif($targetOptionChoice == 2 ){
        $ifLStarget = True;
        $ifGTRtarget = False;
    }

    echo $ifGTRtarget. ' '. $ifLStarget;

    // Make new alert for that user 
    // create query 
    $sql = " INSERT INTO user_stock_alert( stockName, targetPrice, ifGTRtarget, ifLStarget, isCompleted) VALUES
    ('$currentStockChoice', '$targetPrice', '$ifGTRtarget','$ifLStarget',FALSE)";

    //connect and run the query 
    if ($con->query($sql) === TRUE) {
     echo "New record created successfully";
   
   } else {
     echo "Error: " . $sql . "<br>" . $con->error;
   }
   
}

?>