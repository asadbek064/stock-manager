<?php 
include('apikey.php');
include('config.php');

$currentResultDes ="";
$currentResultSymbol ="";
$currentResutlPrice;

$stockNotFound = False;


// searchbox
if(isset($_POST['searchbox'])) {
    // get input text  
    $selectedStock = $_POST["searchbox"];
    $selectedStock = strval($selectedStock);

    $sql = "SELECT symbol, description FROM stock_list WHERE symbol = '$selectedStock'";
    $result = $con->query($sql);

    if (!$result) {
        trigger_error('Invalid query: ' . $con->error);
    } else {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentResultDes = $row["description"];
            $currentResultSymbol = $row["symbol"];

            // get current stock result current price 
            $url = 'https://finnhub.io/api/v1/quote?symbol=' . $currentResultSymbol . '&token=' . $apikey;
            $xml = file_get_contents($url);
            $xml = json_decode($xml, true);
            $currentResutlPrice =  $xml['c'];
            $currentResutlPrice =  $currentResutlPrice;

        } else {
            $stockNotFound = True;
        }
    }
}

?>