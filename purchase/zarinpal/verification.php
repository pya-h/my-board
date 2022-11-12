<?php
$Authority = $_GET['Authority'];
$data = array("merchant_id" => ZARINPAL_MERCHANT_ID, "authority" => $Authority, "amount" => $_SESSION[ORDER_COST]);
$jsonData = json_encode($data);
$ch = curl_init(LINK_ZARINPALL_VERIFY);
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
    global $connection;
    if (array_key_exists('data', $result) && array_key_exists('code', $result['data'])) {
        if ($result['data']['code'] == 100) {
            $order_id = strval($result['data']['ref_id']);
            $order_cost = $_SESSION[ORDER_COST];
            $order_product_id = $_SESSION[ORDER_PRODUCT_ID];
            $date = date("Y-m-d h:i:sa");
            echo "<h2>پرداخت با موفقیت انجام شد. <br> کد رهگیری: " . $order_id . "</h2>";
            $query = "INSERT INTO `" . TABLE_ORDERS . "` (" . ORDER_ID . ", " . ORDER_PRODUCT_ID . ", " . ORDER_COST .
                ") values ('$order_id', $order_product_id, $order_cost)";
            $result = $connection->query($query);
            $_SESSION[RES] = '<p class="success">سفارش موردنظر با موفقیت ثبت شد.</p>';
        } else
            $_SESSION[RES] = "<p class='error'>خرید کالا ناموفق بود!</p>";
    }
    else
        $_SESSION[RES] = "<p class='error'>پاسخ دریافت شده از زرین پال نامعتبر است!</p>";
}
// unset session values
foreach ([ORDER_COST, ORDER_PRODUCT_NAME, ERROR] as $key)
    unset($_SESSION[$key]);

redirect(ROUTE_ORDERS);
