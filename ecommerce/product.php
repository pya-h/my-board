
<div class="wrapper">
    <?php
        $product = null;
        $_SESSION[ERROR] = null;
        if($connection) {
            $product_id = get_url_param($_SERVER['REQUEST_URI'], "id");
            $query = sprintf("SELECT * FROM `%s` WHERE %s=%d AND %s=%d", TABLE_PRODUCTS, PRODUCT_ID, $product_id, PRODUCT_AVAILABLE, 1);
            $result = $connection->query($query);

            if($result)
                if($result->num_rows > 0)
                    $product = $result->fetch_array(MYSQLI_ASSOC);
                else
                    $_SESSION[ERROR] = array(ERR_TITLE => "کالای ناموجود", ERR_MSG => 'چنین کالایی وجود خارجی ندارد!');
            else
                $_SESSION[ERROR] = array(ERR_TITLE => "خطای دریافت مشخصات", ERR_MSG => 'حین دریافت مشخصات محصول خطایی بوجود آمد');
        }
        else
            $_SESSION[ERROR] = array(ERR_TITLE => "خطای اتصال", ERR_MSG => 'برقراری ارتباط با دیتابیس ناموفق بود!');
    ?>
    <?php
        if (isset($_SESSION[ERROR])) {
            $_SESSION[ERROR][ERR_IMG] = null;
            require_once __DIR__ . "/../errors/index.php";
            unset($_SESSION[ERROR]);
        }
        else {
            require_once __DIR__ . '/../common/sidebar.php' ;
            require_once __DIR__ . '/../common/topnav.php' ;
    ?>
    <div dir="rtl" class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">فروشگاه</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">مشخصات کالا</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->

             <div class="card">
                 <form action="" method="post">
                        <div class="row g-0">
                              <div class="col-md-4 border-end">
                                <img src="<?php echo $product[PRODUCT_IMAGE] ?>" class="img-fluid" alt="...">
                              </div>
                              <div class="col-md-8">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $product[PRODUCT_TITLE] ?></h4>
                                        <div class="mb-3">
                                            <span class="price h4"><?php echo $product[PRODUCT_PRICE] ?></span>
                                            <span class="">تومان</span>
                                        </div>
                                        <p class="card-text fs-6"><?php echo $product[PRODUCT_SUMMARY] ?></p>
                                        <hr>
                                        <div class="col-md-6 text-center my-5 mx-auto" >
                                            <button type="submit" class="btn btn-white w-100 btn-block btn-large">خرید</button>
                                        </div>
                                    </div>
                              </div>
                        </div>
                 </form>
                <hr/>
                <div class="card-body">
                    <ul class="nav nav-tabs mb-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title"> توضیحات </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content pt-3">
                        <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                            <?php echo $product[PRODUCT_DESCRIPTION] ? $product[PRODUCT_DESCRIPTION] : $product[PRODUCT_SUMMARY] ?>
                        </div>
                    </div>
                </div>

              </div>
        </div>
    </div>
    <?php } ?>}
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button-->
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
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
