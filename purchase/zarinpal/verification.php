<?php

$Authority = $_GET['Authority'];
$data = array("merchant_id" => "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx", "authority" => $Authority, "amount" => 1000);
$jsonData = json_encode($data);
$ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
));

$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result, true);
//edit this
//  **** ALL THIS MUST BE RE ROUTED TO PRODUCT PAGE (OR A PAGE THAT IS DESIGNED FOR REROUTING TO THE TRANSACTION SECTION ********
// THE RESULT MESSAGE MUST BE SHOWN THERE
if ( $_SESSION[ERROR]) {
    echo $_SESSION[ERROR][ERR_TITLE] . " <br> " .  $_SESSION[ERROR][ERR_MSG];
} else {
    if ($result['data']['code'] == 100)
        echo "<h2>پرداخت با موفقیت انجام شد. <br> کد رهگیری: " . $result['data']['ref_id'] . "</h2>";
    else
        echo  "<h2>" . $_SESSION[ERROR][ERR_TITLE] . " <br> " .  $_SESSION[ERROR][ERR_MSG] . "</h2>";

}
