<?php
    function show_error($code, $msg) {
        http_response_code($code);
        $_SESSION[ERROR] = [ERR_TITLE => strval($code), ERR_MSG => $msg, ERR_IMG => "/assets/images/errors-images/$code.png" ];
        require __DIR__ . '/errors/index.php';
        unset($_SESSION[ERROR]);
    }
    $request = $_SERVER['REQUEST_URI'];
    switch($request){
        case ROUTE_ROOT:
        case '':
            if(isset($_SESSION[USER_ID]) && $_SESSION[USER_ID] && isset($_SESSION[USER_EMAIL]) && $_SESSION[USER_EMAIL])
                require_once __DIR__ . '/home.php';
            else
                redirect(ROUTE_SIGN_IN);
            break;


        // AUTHENTICATION SECTION
        case ROUTE_SIGN_IN:
            if(isset($_SESSION[USER_ID]) && $_SESSION[USER_ID] && isset($_SESSION[USER_EMAIL]) && $_SESSION[USER_EMAIL])
                show_error(405, "در حال حاضر، شما مجاز به ورود به این بخش نیستید! برای ورود به این صفحه ابتدا باید از حساب کاربری تان خارج شوید.");
            else
                require_once __DIR__ . '/user/auth/sign-in.php';
            break;

        case ROUTE_SIGN_OUT:
            unset($_SESSION[USER_ID]);
            unset($_SESSION[USER_EMAIL]);
            unset($_SESSION[USER_FULLNAME]);
            unset($_SESSION[USER_ADMIN]);
            redirect(ROUTE_SIGN_IN);
            break;

        case ROUTE_SIGN_UP:
            if(isset($_SESSION[USER_ID]) && $_SESSION[USER_ID] && isset($_SESSION[USER_EMAIL]) && $_SESSION[USER_EMAIL])
                show_error(405, "در حال حاضر، شما مجاز به ورود به این بخش نیستید! برای ورود به این صفحه ابتدا باید از حساب کاربری تان خارج شوید.");
            else
                require_once __DIR__ . '/user/auth/sign-up.php';
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


        // admin routes
        case ROUTE_ADD_PRODUCT:
            require_once __DIR__ . '/admin/add-product.php';
            break;

        case ROUTE_ADD_STATION:
            require_once __DIR__ . '/admin/add-station.php';
            break;


        // QUESTION & SUPPORT SECTION
        case ROUTE_FAQ:
            require_once __DIR__ . '/admin/faq.php';
            break;

            // BY ZARINPAL
        case ROUTE_ZARINCALL:
            require_once __DIR__ . '/purchase/zarinpal/request.php';
            break;
        case ROUTE_ZARINPAL_VERIFY:
            require_once __DIR__ . '/purchase/zarinpal/verification.php';
            break;


        case ROUTE_FORBIDDEN:
            show_error(403, "شما مجاز به مشاهده این صفحه نیستید.");
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
                else if($arr_route[0] === ROUTE_PURCHASE){
                    // PURCHASE SECTION
                    require_once __DIR__ . '/purchase/manage.php';
                    break;
                }
                else if($arr_route[0] === ROUTE_ZARINPAL_VERIFY){
                    require_once __DIR__ . '/purchase/zarinpal/verification.php';
                    break;
                }
                else if($arr_route[0] === ROUTE_ORDERS){
                    // PURCHASE SECTION
                    if($_SESSION[USER_ADMIN]){
                        $order_id = get_url_param($request, ORDER_ID);
                        if($order_id) {
                            $query = sprintf("UPDATE `%s` SET %s='%s' WHERE %s='%s'", TABLE_ORDERS,
                                    ORDER_STATUS, "تکمیل شده",ORDER_ID, $order_id);
                            $result = $connection->query($query);
                            redirect(ROUTE_ORDERS);
                        }
                    }
                    
                    break;
                }
            }

            // UNKNOWN PAGE
            show_error(404, "صفحه مورد نظر یافت نشد!");
            break;
    }