
<!--wrapper-->
<div class="wrapper">
    <?php require_once __DIR__ . '/../common/sidebar.php' ;
    require_once __DIR__ . '/../common/topnav.php' ; ?>

    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">فروشگاه</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">سفارش های شما</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->
          
            <div class="card">
                <div class="card-body">
                    <div class="d-lg-flex align-items-center mb-4 gap-3">
                        <div dir="rtl" class="position-relative">
                            <?php
                                if(isset($_SESSION[RES])){
                                    echo $_SESSION[RES];
                                    unset($_SESSION[RES]);
                                }
                            ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <?php $is_admin_here = isset($_SESSION[USER_ADMIN]) && $_SESSION[USER_ADMIN]; ?>
                        <table class="table mb-0">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>شماره</th>
                                    <th>نام کالا</th>
                                    <th>وضعیت</th>
                                    <th>هزینه</th>
                                    <th>تاریخ</th>
                                    <th>مشاهده کالا</th>
                                    <?php if ($is_admin_here) echo "<th>تایید</th>" ?>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php
                                    global $connection;
                                    $query_result = null;
                                    if($connection) {
                                        try {
                                            $query_result = mysqli_query($connection, 'SELECT * FROM ' . TABLE_ORDERS .
                                                (!$_SESSION[USER_ADMIN] ? ' WHERE ' . ORDER_PRODUCT_ID . '=' . $_SESSION[USER_ID] : "")
                                            );
                                        } catch (Exception $ex) {
                                            echo "<p class='error'>خطا در برقراری ارتباط با دیتابیس!</p>";
                                        }
                                    }
                                    while($connection && $query_result && $order = mysqli_fetch_array($query_result)):
                                ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="ms-2">
                                                    <h6 class="mb-0 font-14"><?php echo $order[ORDER_ID] ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                        <?php $product = get_product($order[ORDER_PRODUCT_ID]);
                                                echo $product ? $product[PRODUCT_TITLE] : "خطا!";
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($order[ORDER_STATUS] === "منتظر تایید خرید")
                                                echo<<<_WAITING
                                                    <div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>
                                                        منتظر تایید خرید
                                                    </div>
                                            _WAITING;
                                                else
                                                    echo <<<_DONE
                                                        <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>
                                                            تکمیل شده
                                                        </div>
                                                _DONE;
                                            ?>
                                        </td>
                                        <td><?php echo $order[ORDER_COST] ?></td>
                                        <td><?php echo $order[ORDER_DATE] ?></td>
                                        <td>
                                            <?php if($product) ?>
                                                <a href="<?php echo make_url_param(ROUTE_PRODUCT ,PRODUCT_ID, $product[PRODUCT_ID]); ?>"
                                                   type="button" class="btn btn-light btn-sm radius-30 px-4">مشاهده کالا</a>
                                        </td>
                                        <td>
                                            <div class="d-flex order-actions">
                                                <a href="<?php echo make_url_param(ROUTE_ORDERS ,ORDER_ID, $order[ORDER_ID]); ?>" class=""><i class='bx bxs-edit'></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
</div>
<!--end wrapper-->
<?php require_once __DIR__ . '/../common/switcher.php' ?>

<!-- Bootstrap JS -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<!--app JS-->
<script src="../assets/js/app.js"></script>
