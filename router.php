<?php
    $request = $_SERVER['REQUEST_URI'];
    switch($request){
        case ROUTE_ROOT:
        case '':
            if(isset($_SESSION[USER_ID]) && $_SESSION[USER_ID] && isset($_SESSION[USER_EMAIL]) && $_SESSION[USER_EMAIL])
                require_once __DIR__ . '/home.php';
            else
                header("Location: " . ROUTE_SIGN_IN);
            break;


        // AUTHENTICATION SECTION
        case ROUTE_SIGN_IN:
            require_once __DIR__ . '/user/auth/sign-in.php';
            break;

        case ROUTE_SIGN_OUT:
            unset($_SESSION[USER_ID]);
            unset($_SESSION[USER_EMAIL]);
            unset($_SESSION[USER_FULLNAME]);
            unset($_SESSION[USER_ADMIN]);
            header("Location: " . ROUTE_SIGN_IN);
            break;

        case ROUTE_SIGN_UP:
            require __DIR__ . '/user/auth/sign-up.php';
            break;

        case ROUTE_FORGET_PASSWORD:
            require_once __DIR__ . '/user/auth/forgot-password.php';
            break;

        case ROUTE_RESET_PASSWORD:
            require_once __DIR__ . '/user/auth/reset-password.php';
            break;


        // ECOMMERCE SECTION
        case ROUTE_STORE:
            require_once __DIR__ . '/ecommerce/store.php';
            break;

        case ROUTE_ORDERS:
            require_once __DIR__ . '/ecommerce/orders.php';
            break;

        case ROUTE_NEW_PRODUCT:
            require_once __DIR__ . '/admin/add-product.php';
            break;


        // QUESTION & SUPPORT SECTION
        case ROUTE_FAQ:
            require_once __DIR__ . '/admin/faq.php';
            break;


        // PURCHASE SECTION
        case ROUTE_PURCHASE:
            require_once __DIR__ . '/purchase/manage.php';
            break;

            // BY ZARINPAL
        case ROUTE_ZARINCALL:
            require_once __DIR__ . '/purchase/zarinpal/request.php';
            break;
        case ROUTE_ZARINPAL_VERIFY:
            require_once __DIR__ . '/purchase/zarinpal/verification.php';
            break;


        // OTHERS
        default:
            // PRODUCT DETAILS SECTION
            $arr_route = explode("?", $request);
            if (count($arr_route) === 2) {
                if($arr_route[0] === ROUTE_PRODUCT) {
                    require_once __DIR__ . '/ecommerce/product.php';
                    break;
                }
            }

            // UNKNOWN PAGE
            http_response_code(404);
            $_SESSION[ERROR] = array(ERR_MSG => "صفحه مورد نظر یافت نشد!", ERR_TITLE => "404", ERR_IMG => "https://cdn.searchenginejournal.com/wp-content/uploads/2019/03/shutterstock_1338315902.png");
            require __DIR__ . '/errors/index.php';
            unset($_SESSION[ERROR]);
            break;
    }