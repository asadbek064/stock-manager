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
	$currentStockChoice = $_POST['hiddenChoice'];
	$currentStockPrice = $_POST['hiddenPrice'];

    if($targetOptionChoice == 1 ){
        $ifGTRtarget = True;
        $ifLStarget = False;
    }elseif($targetOptionChoice == 2 ){
        $ifLStarget = True;
        $ifGTRtarget = False;
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
        $sql = " INSERT INTO user_stock_alert (userID, stockName, targetPrice, ifGTRtarget, ifLStarget,isCompleted)
        VALUES ('$currentUserID','$currentStockChoice', '$targetPrice', '$ifGTRtarget','$ifLStarget',FALSE)";

       //connect and run the query 
       	if ($con->query($sql) === TRUE) {
			echo "New record created successfully";
			$currentStockChoice = strval($currentStockChoice);
			$currentStockPrice = floatval($currentStockPrice);
			// check if currentstockchoice exisist in stock table if not add to stock table 
			$sqlSymbolCheck = "SELECT count(*) as cntSymbol FROM liveStocks WHERE symbol = '$currentStockChoice'";
			$result = mysqli_query($con,$sqlSymbolCheck);
			$row =mysqli_fetch_array($result);
			$count = $row['cntSymbol'];

			if($count > 0) {
				echo "symbol already exists in live stock";
			}else {
				// symbol doesn't exists in liveStocks add symbol to liveStocks and its current price table 
				$sqlAddSymbol = "INSERT INTO liveStocks(symbol,stockPrice) VALUES ('$currentStockChoice','$currentStockPrice')";
				//con and run 
				if($con->query($sqlAddSymbol) == TRUE){
					echo "added new stock to liveStocks table";
				}
			}
		
      	} else {
        	echo "Error: " . $sql . "<br>" . $con->error;
      	}

      }
    }
    
  
   
}
