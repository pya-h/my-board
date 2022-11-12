<?php
$data = array("merchant_id" => ZARINPAL_MERCHANT_ID,
    "amount" => $_SESSION[ORDER_COST],
    "callback_url" => ROUTE_LOCALROOT . ROUTE_ZARINPAL_VERIFY,
    "description" => "خرید " . $_SESSION[ORDER_PRODUCT_NAME],
    "metadata" => ["email" => $_SESSION[USER_EMAIL]],
);
$jsonData = json_encode($data);
$ch = curl_init(LINK_ZARINPALL_REQUEST);
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
));

$result = curl_exec($ch);
$err = curl_error($ch);
$result = json_decode($result, true, JSON_PRETTY_PRINT);
curl_close($ch);

if ($err)
    $_SESSION[ERROR] = [ERR_TITLE => "خطا در پرداخت", ERR_MSG => $err, ERR_IMG => null];
else {
    if (empty($result['errors']))
        if ($result['data']['code'] == 100) {
            header('Location: https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"]);
            //header('Location: ' . ROUTE_ZARINPAL_VERIFY);
        }
        else
            $_SESSION[ERROR] = [ERR_TITLE => $result['errors']['code'], ERR_MSG => $result['errors']['message']];
}
