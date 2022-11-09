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
            require __DIR__ . '/user/auth/sign-in.php';
            break;

        case ROUTE_SIGN_OUT:
            unset($_SESSION[USER_ID]);
            unset($_SESSION[USER_EMAIL]);
            header("Location: " . ROUTE_SIGN_IN);
            break;

        case ROUTE_SIGN_UP:
            require __DIR__ . '/user/auth/sign-up.php';
            break;

        default:
            http_response_code(404);
            require __DIR__ . '/common/404.php';
            break;
    }