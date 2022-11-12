<?php

// *************************** CONSTANTS ****************************
// APP
defined('APP_TITLE') or define('APP_TITLE', 'داشبرد');

// DATABASE
defined('DB_HOST') or define('DB_HOST', '127.0.0.1');
defined('DB_USERNAME') or define('DB_USERNAME', 'root');
defined('DB_PASSWORD') or define('DB_PASSWORD', '');
defined('DB_NAME') or define('DB_NAME','vps-db');

// TABLE:USERS KEYS
defined('TABLE_USERS') or define('TABLE_USERS', 'users');
defined('USER_EMAIL') or define('USER_EMAIL', 'email');
defined('USER_PASS') or define('USER_PASSWORD', 'pass');
defined('USER_ID') or define('USER_ID', 'pass');
defined('USER_ADMIN') or define('USER_ADMIN', 'admin');
defined('USER_FULLNAME') or define('USER_FULLNAME', 'name');

// TABLE:PRODUCTS KEYS
defined('TABLE_PRODUCTS') or define('TABLE_PRODUCTS', 'products');
defined('PRODUCT_TITLE') or define('PRODUCT_TITLE', 'title');
defined('PRODUCT_ID') or define('PRODUCT_ID', 'id');
defined('PRODUCT_SUMMARY') or define('PRODUCT_SUMMARY', 'summary');
defined('PRODUCT_DESCRIPTION') or define('PRODUCT_DESCRIPTION', 'description');
defined('PRODUCT_PRICE') or define('PRODUCT_PRICE', 'price');
defined('PRODUCT_AVAILABLE') or define('PRODUCT_AVAILABLE', 'available');
defined('PRODUCT_DURATION') or define('PRODUCT_DURATION', 'duration');
defined('PRODUCT_MAX_USERS') or define('PRODUCT_MAX_USERS', 'max_users');
defined('PRODUCT_IMAGE') or define('PRODUCT_IMAGE', 'img');

// ROUTES
defined('ROUTE_LOCALROOT') or define('ROUTE_LOCALROOT',  "http://localhost"); // whatever.xxx/
defined('ROUTE_ROOT') or define('ROUTE_ROOT', '/'); // whatever.xxx/
defined('ROUTE_SIGN_IN') or define('ROUTE_SIGN_IN', ROUTE_ROOT . 'signin');
defined('ROUTE_SIGN_UP') or define('ROUTE_SIGN_UP', ROUTE_ROOT . 'signup');
defined('ROUTE_SIGN_OUT') or define('ROUTE_SIGN_OUT', ROUTE_ROOT . 'signout');
defined('ROUTE_FORGET_PASSWORD') or define('ROUTE_FORGET_PASSWORD', ROUTE_ROOT . '4get');
defined('ROUTE_RESET_PASSWORD') or define('ROUTE_RESET_PASSWORD', ROUTE_ROOT . 'reset');

defined('ROUTE_STORE') or define('ROUTE_STORE', ROUTE_ROOT . 'store');
defined('ROUTE_PRODUCT') or define('ROUTE_PRODUCT', ROUTE_ROOT . 'store/product');
defined('ROUTE_ORDERS') or define('ROUTE_ORDERS', ROUTE_ROOT . 'orders');
defined('ROUTE_FAQ') or define('ROUTE_FAQ', ROUTE_ROOT . 'faq');
defined('ROUTE_SUPPORT') or define('ROUTE_SUPPORT', ROUTE_ROOT . 'support');
defined('ROUTE_FORBIDDEN') or define('ROUTE_FORBIDDEN', ROUTE_ROOT . 'forbidden');
defined('ROUTE_VALIDATE_ORDER') or define('ROUTE_VALIDATE_ORDER', ROUTE_ROOT . 'validate');

// admn panel routes
defined('ADMIN_NICKNAME') or define('ROUTE_ADMIN', 'submax/');
defined('ROUTE_ADD_ENTRY') or define('ROUTE_ADD_STATION', ROUTE_ROOT . ROUTE_ADMIN . '+station');
defined('ROUTE_NEW_PRODUCT') or define('ROUTE_ADD_PRODUCT', ROUTE_ROOT . ROUTE_ADMIN . '+product');

defined('MEDIA_DIR') or define('MEDIA_DIR', ROUTE_ROOT . 'media');
defined('IMG_DIR') or define('IMG_DIR', ROUTE_ROOT . 'img');

// purchase
defined('ROUTE_PURCHASE') or define('ROUTE_PURCHASE', ROUTE_ROOT . 'store/purchase');

// purchase by zarinpal
defined('LINK_ZARINPALL_REQUEST') or define('LINK_ZARINPALL_REQUEST', 'https://api.zarinpal.com/pg/v4/payment/request.json');
defined('LINK_ZARINPALL_VERIFY') or define('LINK_ZARINPALL_VERIFY', 'https://api.zarinpal.com/pg/v4/payment/verify.json');

defined('ROUTE_ZARINCALL') or define('ROUTE_ZARINCALL', ROUTE_PURCHASE . '/zarinpal');
defined('ROUTE_ZARINPAL_VERIFY') or define('ROUTE_ZARINPAL_VERIFY', ROUTE_PURCHASE . '/verify');
defined('ZARINPAL_MERCHANT_ID') or define('ZARINPAL_MERCHANT_ID', "21b1695f-b0a4-479f-8df2-f79fbe91d285");

defined('ORDER') or define('ORDER', 'order');
defined('ORDER_PRODUCT') or define('ORDER_PRODUCT_NAME', 'productname');

defined('ERROR') or define('ERROR', 'err');
defined('ERR_TITLE') or define('ERR_TITLE', 'title');
defined('ERR_MSG') or define('ERR_MSG', 'msg');
defined('ERR_IMG') or define('ERR_IMG', 'img');
defined('RES') or define('RES', 'res');
defined('COOKIE') or define('COOKIE', 'cookie');

// TABLE:PRODUCTS KEYS
defined('TABLE_ORDERS') or define('TABLE_ORDERS', 'orders');
defined('ORDER_ID') or define('ORDER_ID', 'id');
defined('ORDER_PRODUCT_ID') or define('ORDER_PRODUCT_ID', 'product_id');
defined('ORDER_COST') or define('ORDER_COST', 'cost');
defined('ORDER_STATUS') or define('ORDER_STATUS', 'status');
defined('ORDER_DATE') or define('ORDER_DATE', 'date');
defined('ORDER_TRANSACTION_ID') or define('ORDER_TRANSACTION_ID', 'transaction_id');

// *************************** COMMON METHODS ****************************

$connection = null;

try {
    $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
}
catch(Exception $ex){
    // echo 'Cannot connect to the database because: ' . $ex ;
?>
<script type="text/javascript">
    setTimeout(() => window.alert("ارتباط با دیتابیس ناموفق بود! \n این یعنی اکثر بخش های سایت را بصورت ناقض خواهید دید! \n لطفا لحظاتی دیگر دوباره تلاش کنید."), 2000);
</script>
<?php
}

function make_url_param($url, $key, $value) {
    return "$url?$key=$value";
}
function get_url_param($url, $expected_param = 'todo'){
    $url_components = parse_url($url);
    if(array_key_exists("query", $url_components)) {
        parse_str($url_components['query'], $params);
        if (array_key_exists($expected_param, $params))
            return $params[$expected_param];
    }
    return null;
}

function gen_dirtree($full_route) {
    // create a dir if doesnt exist
    $routes = explode("/", $full_route);
    $cd = __DIR__ . '/..';
    foreach($routes as $child) {
        $cd .= '/' . $child;
        if (!file_exists( $cd)) {
            mkdir($cd, 0777, true);
        }
    }
}

function get_product($product_id) {
    global $connection;
    if($connection) {
        $query = sprintf("SELECT * FROM `%s` WHERE %s=%d AND %s=%d", TABLE_PRODUCTS, PRODUCT_ID, $product_id, PRODUCT_AVAILABLE, 1);
        $result = $connection->query($query);

        if($result)
            if($result->num_rows > 0) {
                return $result->fetch_array(MYSQLI_ASSOC);
            }
            else
                $_SESSION[ERROR] = array(ERR_TITLE => "کالای ناموجود", ERR_MSG => 'چنین کالایی وجود خارجی ندارد!');
        else
            $_SESSION[ERROR] = array(ERR_TITLE => "خطای دریافت مشخصات", ERR_MSG => 'حین دریافت مشخصات محصول خطایی بوجود آمد');
    }
    else
        $_SESSION[ERROR] = array(ERR_TITLE => "خطای اتصال", ERR_MSG => 'برقراری ارتباط با دیتابیس ناموفق بود!');

    return null;
}
gen_dirtree( MEDIA_DIR . IMG_DIR );

function decode_res_header($header_text) {
    $headers = [];
    foreach (explode("\r\n", $header_text) as $i => $line)
        if ($i === 0)
            $headers['http_code'] = $line;
        else
        {
            list ($key, $value) = explode(': ', $line);

            $headers[$key] = $value;
        }

    return $headers;
}
function login2panel() {
    $payload = ["username" => "admin", "password" => "admin"];
    $jsonData = json_encode($payload);
    $ch = curl_init("http://91.149.255.31:54321/login");
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData),
    ));
    curl_setopt($ch, CURLOPT_HEADER, 1);
    $response = curl_exec($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = json_decode(substr($response, $header_size), true, JSON_PRETTY_PRINT);
    $header = decode_res_header($header);
    $err = curl_error($ch);
    curl_close($ch);
    if($body["success"])
        $_SESSION[COOKIE] = $header["Set-Cookie"];
    else
        $_SESSION[RES] = "<p class=\"error\">ERROR: " . $body["msg"] . "</p>";

}

function short_size($bytes) {
    $names = ["B", "KB", "MB", "GB", "TB", "EB"];
    $idx = 0;
    while($bytes > 1024 && $idx < count($names)) {
        $bytes /= 1024;
        $idx++;
    }

    return sprintf("%.2f %s", $bytes, $names[$idx]);
}