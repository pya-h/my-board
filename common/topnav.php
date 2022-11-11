<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                </div>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#">	<i class='bx bx-search'></i>
                        </a>
                    </li>
                    <li class="header-notifications-list"></li>
                    <li class="header-message-list"></li>
                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://via.placeholder.com/110x110" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <?php
                            $user_email = $_SESSION[USER_EMAIL];
                            $user_fn = $_SESSION[USER_FULLNAME];
                            echo <<<_USER
                                        <p class="user-name mb-0" style="font-weight: bold; color: darkblue; font-size: 17px">$user_email</p>
                                        <p dir="rtl" class="designattion mb-0 text-end" style="font-weight: bold; color:coral; font-size: 17px">$user_fn</p>
                                _USER;
                        ?>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="javascript:;"><i class="bx bx-user"></i><span>پروفایل</span></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:;"><i class="bx bx-cog"></i><span>تنظیمات</span></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:;"><i class='bx bx-home-circle'></i><span>داشبرد</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item" href="<?php echo ROUTE_SIGN_OUT ?>"><i class='bx bx-log-out-circle'></i><span>خروج</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>