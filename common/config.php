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
defined('ROUTE_ROOT') or define('ROUTE_ROOT', '/'); // whatever.xxx/
defined('ROUTE_SIGN_IN') or define('ROUTE_SIGN_IN', ROUTE_ROOT . 'signin');
defined('ROUTE_SIGN_UP') or define('ROUTE_SIGN_UP', ROUTE_ROOT . 'signup');
defined('ROUTE_SIGN_OUT') or define('ROUTE_SIGN_OUT', ROUTE_ROOT . 'signout');
defined('ROUTE_FORGET_PASSWORD') or define('ROUTE_FORGET_PASSWORD', ROUTE_ROOT . '4get');
defined('ROUTE_RESET_PASSWORD') or define('ROUTE_RESET_PASSWORD', ROUTE_ROOT . 'reset');

defined('ROUTE_STORE') or define('ROUTE_STORE', ROUTE_ROOT . 'store');
defined('ROUTE_PRODUCT') or define('ROUTE_PRODUCT', ROUTE_ROOT . 'store/product');
defined('ROUTE_NEW_PRODUCT') or define('ROUTE_NEW_PRODUCT', ROUTE_ROOT . 'newproduct');
defined('ROUTE_ORDERS') or define('ROUTE_ORDERS', ROUTE_ROOT . 'orders');
defined('ROUTE_FAQ') or define('ROUTE_FAQ', ROUTE_ROOT . 'faq');
defined('ROUTE_SUPPORT') or define('ROUTE_SUPPORT', ROUTE_ROOT . 'support');

defined('MEDIA_DIR') or define('MEDIA_DIR', ROUTE_ROOT . 'media');
defined('IMG_DIR') or define('IMG_DIR', ROUTE_ROOT . 'img');

// purchase
defined('ROUTE_PURCHASE') or define('ROUTE_PURCHASE', ROUTE_ROOT . 'purchase');

// purchase by zarinpal
defined('LINK_ZARINPALL_REQUEST') or define('LINK_ZARINPALL_REQUEST', 'https://api.zarinpal.com/pg/v4/payment/request.json');
defined('LINK_ZARINPALL_VERIFY') or define('LINK_ZARINPALL_VERIFY', 'https://api.zarinpal.com/pg/v4/payment/verify.json');

defined('ROUTE_ZARINCALL') or define('ROUTE_ZARINCALL', ROUTE_ROOT . 'purchase/zarinpal');
defined('ROUTE_ZARINPAL_VERIFY') or define('ROUTE_ZARINPAL_VERIFY', ROUTE_ROOT . 'purchase/verify');
defined('ZARINPAL_MERCHANT_ID') or define('ZARINPAL_MERCHANT_ID', "21b1695f-b0a4-479f-8df2-f79fbe91d285");

defined('ORDER') or define('ORDER', 'order');
defined('ORDER_COST') or define('ORDER_COST', 'cost');
defined('ORDER_PRODUCT') or define('ORDER_PRODUCT', 'productname');

defined('ERROR') or define('ERROR', 'err');
defined('ERR_TITLE') or define('ERR_TITLE', 'title');
defined('ERR_MSG') or define('ERR_MSG', 'msg');
defined('ERR_IMG') or define('ERR_IMG', 'img');

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
