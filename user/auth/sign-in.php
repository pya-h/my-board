
<?php
    if(isset($_SESSION[USER_ID]) && isset($_SESSION[USER_EMAIL]) && $_SESSION[USER_EMAIL] && $_SESSION[USER_ID])
        redirect(ROUTE_ROOT)
?>
<!--wrapper-->
<div dir="rtl" class="wrapper">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="border rounded px-4 py-5">
                                <div class="text-center">
                                    <h3 class="mb-5"><span style="border-bottom: 2px solid gray;" class="py-2 my-5">ورود به حساب کاربری</span></h3>
                                    <?php
                                        if(isset($_SESSION['response'])){
                                            echo $_SESSION['response'];
                                            unset($_SESSION['response']);
                                        }
                                    ?>
                                </div>
                                <div class="login-separater text-center my-4">
                                    <span>                                        اگر هنوز حساب کاربری نساخته اید،
                                        <a class="cool-anchor" href="<?php echo ROUTE_SIGN_UP; ?>"> اینجا ثبت نام کنید...</a>
                                    </span>
                                    <hr/>
                                </div>
                                <div class="form-body">
                                    <form action="/user/auth/formact.php" method="post" class="row g-3">
                                        <div class="col-12">
                                            <label for="txtEmail" class="form-label">ایمیل</label>
                                            <input type="email" name="email" class="form-control" id="txtEmail"
                                                   placeholder="ایمیل">
                                        </div>
                                        <div class="col-12">
                                            <label for="txtPassword" class="form-label">رمز عبور</label>
                                            <div name="password" class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0" id="txtPassword" name="password" placeholder="رمز عبور">
                                                <a href="javascript:;" class="input-group-text bg-transparent">
                                                    <i class='bx bx-hide'></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <a href="forgot-password.php">فراموشی رمز</a>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch text-start">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">مرا بخاطر بسپار</label>
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-light" name="signinAttemp"><i class="bx bxs-lock-open"></i>ورود</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="../../assets/js/jquery.min.js"></script>
<script src="../../assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="../../assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="../../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<!--Password show & hide js -->
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>
<!--app JS-->
<script src="../../assets/js/app.js"></script>
