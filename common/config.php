<?php

// APP
defined('APP_TITLE') or define('APP_TITLE', 'داشبرد');

// DATABASE
defined('DB_HOST') or define('DB_HOST', '127.0.0.1');
defined('DB_USERNAME') or define('DB_USERNAME', 'root');
defined('DB_PASSWORD') or define('DB_PASSWORD', '');
defined('DB_NAME') or define('DB_NAME','vps-db');

// TABLE:USER KEYS
defined('TABLE_USERS') or define('TABLE_USERS', 'users');
defined('USER_EMAIL') or define('USER_EMAIL', 'email');
defined('USER_PASS') or define('USER_PASSWORD', 'pass');
defined('USER_ID') or define('USER_ID', 'pass');
defined('USER_FULLNAME') or define('USER_FULLNAME', 'name');

// ROUTES
defined('ROUTE_SIGN_IN') or define('ROUTE_SIGN_IN', '/sign-in');
defined('ROUTE_SIGN_UP') or define('ROUTE_SIGN_UP', '/sign-up');
defined('ROUTE_SIGN_OUT') or define('ROUTE_SIGN_OUT', '/sign-out');
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

