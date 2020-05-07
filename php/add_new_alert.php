<?php 
## AUTHOR = "Asad"
# Reviewer= "Alain"
# LICENCE MIT

# This is the an internal componant which is part of
# user alert notification

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
	$currentStockChoice = $_POST['hiddenChoice'];
	$currentStockPrice = $_POST['hiddenPrice'];

    if($targetOptionChoice == 1 ){
        $ifGTRtarget = 1;
        $ifLStarget = 0;
    }elseif($targetOptionChoice == 2 ){
        $ifLStarget = 1;
        $ifGTRtarget = 0;
    }

    // get current userID from DB using current session  
    $currentUser = $user_check;
    $currentUserID;
    $sqlGetuserID = "SELECT userID FROM users WHERE username = '$currentUser' ";
    $result =$con->query($sqlGetuserID);
    
    if(!$result) { 
      echo "Erro: ".$sqlGetuserID. "<br>". $con->error;
    }else {
      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
		$currentUserID = $row["userID"];
		
		$currentUserID = number_format($currentUserID);
        
        // INSERT NEW STOCK ALERT 
        $sqlAddAlert = " INSERT INTO user_stock_alert(userID, stockName, targetPrice, ifGTRtarget, ifLStarget,isCompleted)
		VALUES ('$currentUserID','$currentStockChoice', '$targetPrice', '$ifGTRtarget','$ifLStarget',FALSE)";

       //connect and run the query 
       	if ($con->query($sqlAddAlert) === TRUE) {
			echo "New record created successfully";
			$currentStockChoice = strval($currentStockChoice);
			$currentStockPrice = floatval($currentStockPrice);
			
			// check if currentstockchoice exisist in stock table if not add to stock table 
			$sqlSymbolCheck = "SELECT count(*) as cntSymbol FROM livestocks WHERE symbol = '$currentStockChoice'";
			$resultCheck = mysqli_query($con,$sqlSymbolCheck) or die(mysqli_error($sqlSymbolCheck));
			$row =mysqli_fetch_array($resultCheck);
			$count = $row['cntSymbol'];

			if($count > 0) {
				echo "symbol already exists in live stock";
			}else {
				// symbol doesn't exists in liveStocks add symbol to liveStocks and its current price table 
				$sqlAddSymbol = "INSERT INTO livestocks(symbol,stockPrice) VALUES ('$currentStockChoice','$currentStockPrice')";
				//con and run 
				if($con->query($sqlAddSymbol) == TRUE){
				    
				    echo "
				    <div class='popup'>
				    <div class='d-flex justify-content-center'>
				        <div class='alert alert-success'>
                        <strong>Success!</strong> This alert box could indicate a successful or positive action.
                    </div>
				    </div>
				    </div>" ;
                    
					
				}
			}
		
      	} else {
        	echo "Error: " . $sqlAddAlert . "<br>" . $con->error;
      	}

      }
    }
    
  
   
}
