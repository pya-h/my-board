
<!-- wrapper -->
<div dir="rtl" class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded fixed-top rounded-0 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../assets/images/logo-img.png" width="140" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="error-404 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="card py-5">
                <div class="row g-0 text-center w-100">
                    <div class="col col-xl-5 mx-auto">
                        <div class="card-body p-4">
                            <?php
                                $msg = $title = $img = null;

                                if(isset($_SESSION[ERROR])) {
                                    $msg = $_SESSION[ERROR][ERR_MSG];
                                    $title = $_SESSION[ERROR][ERR_TITLE];
                                    $img = $_SESSION[ERROR][ERR_IMG];
                                    $root = ROUTE_ROOT;
                                    echo <<<_ERR
                                        <h2 style="border-bottom: 3px solid darkred; color: darkred"  class="font-weight-bold display-4 my-4">$title</h2>
                                        <p style="font-size: 18px; font-weight: bold" class="text-info">$msg </p>
                                        <div class="mt-5"> <a href="$root" class="btn btn-light btn-lg px-md-5 radius-30">خانه</a>
                                            <a  href="$root"  class="btn btn-light btn-lg ms-3 px-md-5 radius-30">صفحه قبلی</a>
                                        </div>
                                    _ERR;
                                }
                                else
                                    echo "<p>خطای نامعلوم</p>";
                            ?>
                        </div>
                    </div>
                    <?php if($img)
                      echo <<<_IMG
                            <div class="col-xl-7">
                                <img src="$img" class="img-fluid" alt="تصویر ارور">
                            </div>
                       _IMG;
                    ?>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <div class="bg-light p-3 fixed-bottom border-top shadow">
        <div class="d-flex align-items-center justify-content-between flex-wrap">

        </div>
    </div>
</div>
<!-- end wrapper -->
<!-- Bootstrap JS -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
