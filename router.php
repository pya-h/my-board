<?php
    $request = $_SERVER['REQUEST_URI'];
    switch($request){
        case '/':
        case '':
            if(isset($_SESSION[USER_ID]) && $_SESSION[USER_ID] && isset($_SESSION[USER_EMAIL]) && $_SESSION[USER_EMAIL])
                require_once __DIR__ . '/home.php';
            else
                header("Location: " . ROUTE_SIGN_IN);
            break;

        case ROUTE_SIGN_IN:
            require_once __DIR__ . '/user/auth/sign-in.php';
            break;

        case ROUTE_STORE:
            require_once __DIR__ . '/ecommerce/store.php';
            break;

        case ROUTE_ORDERS:
            require_once __DIR__ . '/ecommerce/orders.php';
            break;

        case ROUTE_NEW_PRODUCT:
            require_once __DIR__ . '/admin/add-product.php';
            break;
        case ROUTE_FORGET_PASSWORD:
            require_once __DIR__ . '/user/auth/forgot-password.php';
            break;
        case ROUTE_RESET_PASSWORD:
            require_once __DIR__ . '/user/auth/reset-password.php';
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

        default:
            http_response_code(404);
            require __DIR__ . '/errors/404.php';
            break;
    }