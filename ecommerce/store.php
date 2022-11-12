
<!--wrapper-->
<div class="wrapper">
    <?php require_once __DIR__ . '/../common/sidebar.php' ;
    require_once __DIR__ . '/../common/topnav.php' ; ?>

    <div class="page-wrapper">
        <div class="page-content">
            <?php
                if (isset($_SESSION[USER_ADMIN]) && $_SESSION[USER_ADMIN]) {
                    $new_product = ROUTE_ADD_PRODUCT; // for using in _ADMIN_MENU string
                    echo <<<_NEW_PRODUCT_BUTTON
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-5 mx-auto">
                                                    <a href="$new_product" class="btn btn-light btn-large btn-block w-100 mb-3 mb-lg-0"><i class='bx bxs-plus-square'></i>کالای جدید</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                _NEW_PRODUCT_BUTTON;
                }
            ?>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
                <?php
                    global $connection;
                    $query = mysqli_query($connection, 'SELECT * FROM ' . TABLE_PRODUCTS . ' WHERE ' . PRODUCT_AVAILABLE . "=1");
                    while( $product = mysqli_fetch_array($query)):
                ?>
                        <a href="<?php echo make_url_param(ROUTE_PRODUCT ,PRODUCT_ID, $product[PRODUCT_ID]); ?>" class="col product-card">
                            <div dir="rtl" class="card h-100">
                                <img src="<?php echo $product[PRODUCT_IMAGE]; ?>" class="card-img-top" alt="...">
                                <div class="position-absolute top-0 end-0 m-3 product-discount"><span class="">-10%</span></div>
                                <div class="card-body">
                                    <h6 class="card-title cursor-pointer"><?php echo $product[PRODUCT_TITLE]; ?></h6>
                                    <div class="clearfix">
                                        <h5 class="mb-0 text-info float-end fw-bold"><span class="me-2 text-success"><?php echo $product[PRODUCT_PRICE]; ?> </span> تومان</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                <?php endwhile; ?>
            </div><!--end row-->
        </div>
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>

</div>
<!--end wrapper-->
<?php require_once __DIR__ . '/../common/switcher.php' ?>

<!-- Bootstrap JS -->
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<!--app JS-->
<script src="/assets/js/app.js"></script>
