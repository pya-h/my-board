<?php

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
defined('ROUTE_SIGN_IN') or define('ROUTE_SIGN_IN', '/signin');
defined('ROUTE_SIGN_UP') or define('ROUTE_SIGN_UP', '/signup');
defined('ROUTE_SIGN_OUT') or define('ROUTE_SIGN_OUT', '/signout');
defined('ROUTE_FORGET_PASSWORD') or define('ROUTE_FORGET_PASSWORD', '/4get');
defined('ROUTE_RESET_PASSWORD') or define('ROUTE_RESET_PASSWORD', '/reset');

defined('ROUTE_STORE') or define('ROUTE_STORE', '/store');
defined('ROUTE_NEW_PRODUCT') or define('ROUTE_NEW_PRODUCT', '/newproduct');
defined('ROUTE_ORDERS') or define('ROUTE_ORDERS', '/orders');

defined('MEDIA_DIR') or define('MEDIA_DIR', '/media');

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
    $connection = null;
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

