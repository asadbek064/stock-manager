<?php
## AUTHOR = "Asad"
# Reviewer= "Alain"

# LICENCE MIT

# This is part of the cron componant

    include('apikey.php');
    include('config.php');
    include('cronjob_checkOrders.php');

    /* cron job script this script will update all the rows of stockPrices in liveStocks using finhub api
     the max updates it can do is 60 rows because the free tier of the api plan allows it.  
     KEEP liveStocks ROW TO 60*/

    $sql = "SELECT symbol FROM livestocks";
    $results = mysqli_query($con,$sql);

    if(!$results){
        echo "could not run query:  " . $con->error;
    }
    else{
        if(mysqli_num_rows($results) >= 1){  
            while($row = mysqli_fetch_array($results)){
                $currentSymbol = $row["symbol"];
                $stockPrice = getPrice($currentSymbol,$apikey);
                $stocPrice = floatval($stockPrice);


                $sqlUpdatePrice = "UPDATE liveStocks SET `stockPrice` ='$stockPrice' WHERE `symbol` ='$currentSymbol' ";
                
                if($con->query($sqlUpdatePrice) == TRUE){
					echo "stock price update".$currentSymbol." ".$stockPrice."<br>";
				}else{
                    echo "error: ". $con->error;
                }
            }
        }

        // run check orders job 
        start_cronjob_checkOrder();

    }

    function getPrice($symbol,$apikey){
        // get current stock result current price 
        $url = 'https://finnhub.io/api/v1/quote?symbol=' . $symbol . '&token=' . $apikey;
        $xml = file_get_contents($url);
        $xml = json_decode($xml, true);
        $currentResutlPrice =  $xml['c'];
        
        return $currentResutlPrice;
    }
    

?>
