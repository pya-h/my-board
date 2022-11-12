<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text"><?php echo APP_TITLE; ?></h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="<?php echo ROUTE_ROOT; ?>">
                <div class="parent-icon"><i class="bx bx-home-circle"></i>
                </div>
                <div class="menu-title">خانه</div>
            </a>
        </li>
        <?php
        if (isset($_SESSION[USER_ADMIN]) && $_SESSION[USER_ADMIN]) {
            $routes = [ROUTE_ADD_PRODUCT, ROUTE_ADD_STATION]; // for using in _ADMIN_MENU string
            echo <<<_ADMIN_MENU
                            <li>
                                <a href="javascript:;" class="has-arrow">
                                    <div class="parent-icon"><i class='bx bx-home-circle'></i>
                                    </div>
                                    <div class="menu-title">ادمین پنل</div>
                                </a>
                                <ul>
                                    <li> <a href="$routes[0]"><i class="bx bx-right-arrow-alt"></i>کالای جدید</a></li>
                                    <li> <a href="$routes[1]"><i class="bx bx-right-arrow-alt"></i>استیشن جدید</a></li>
                                </ul>
                            </li>
                    _ADMIN_MENU;
        }
        ?>
        <li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">فروشگاه</div>
            </a>
            <ul>
                <li> <a href="<?php echo ROUTE_STORE; ?>"><i class="bx bx-right-arrow-alt"></i>کالاها</a></li>

                <li> <a href="<?php echo ROUTE_ORDERS; ?>"><i class="bx bx-right-arrow-alt"></i>سفارشات شما</a></li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-lock"></i>
                </div>
                <div class="menu-title">مدیریت اکانت</div>
            </a>
            <ul>
                <li>
                    <a href="<?php echo APP_TITLE ?>">
                        <div class="parent-icon"><i class="bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">پروفایل</div>
                    </a>
                </li>
                <li> <a href="<?php echo ROUTE_SIGN_IN ?>" target="_blank"><i class="bx bx-right-arrow-alt"></i>ورود</a>
                </li>
                <li> <a href="<?php echo ROUTE_SIGN_UP ?>" target="_blank"><i class="bx bx-right-arrow-alt"></i>ثبت نام</a>
                </li>
                <li> <a href="<?php echo ROUTE_FORGET_PASSWORD; ?>" target="_blank"><i class="bx bx-right-arrow-alt"></i>فراموشی رمز</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?php echo ROUTE_FAQ; ?>">
                <div class="parent-icon"><i class="bx bx-help-circle"></i>
                </div>
                <div class="menu-title">پرسش و پاسخ</div>
            </a>
        </li>
        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">پشتیبانی</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
