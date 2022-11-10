
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div>
                <img src="../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
            </div>
            <div>
                <h4 class="logo-text"><?php echo APP_TITLE; ?></h4>
            </div>
            <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
            </div>
        </div>
        <!--navigation-->
        <?php require_once __DIR__ . '/../common/navigation.php'; ?>
    </div>
    <!--end sidebar wrapper -->
    <!--start header -->
    <?php require_once __DIR__ . '/../common/topnav.php'; ?>
    <!--end header -->
    <!--start page wrapper -->
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
                            <li class="breadcrumb-item active" aria-current="page">اضافه کردن کالای جدید</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->
        <form action="#" method="post">
          <div class="card">
              <div class="card-bodyp-4">
                  <h5 class="card-title">کالای جدید</h5>
                  <hr/>
                   <div dir="rtl" class="form-body mt-4">
                        <div class="row">
                           <div class="col-lg-8 mx-auto">
                               <div class="border border-3 p-4 rounded">
                                    <div class="mb-5">
                                        <label for="txtTitle" class="form-label">عنوان کالا</label>
                                        <input type="text" class="form-control" name="title" id="txtTitle" required placeholder="عنوان کالا را وارد کنید">
                                      </div>
                                       <div class="mb-5">
                                           <label for="txtSummary" class="form-label">معرفی مختصر</label>
                                           <input name="summary" class="form-control" placeholder="معرفی مختصری وارد کنید" id="txtSummary"/>
                                       </div>
                                      <div class="mb-5">
                                        <label for="txtDescription" class="form-label">معرفی کامل</label>
                                        <textarea id="txtDescription" name="description" class="form-control" placeholder="در اینجا می توانید معرفی کامل تر، با توضیحات بیشتر وارد کنید؛ و یا اینکه به همان معرفی مختصر اکتفا کنید و این بخش را خالی بگذارید" txtDescription" rows="5"></textarea>
                                      </div>
                                       <div class="mb-5">
                                           <label for="txtPrice" class="form-label">قیمت</label>
                                           <input type="number" class="form-control" name="price" id="txtPrice" placeholder="قیمت کالا را وارد کنید" required>
                                       </div>
                                        <hr />
                                        <div class="my-5">
                                            <label for="txtDescription" class="form-label">تصویر کالا</label>
                                            <input id="image-uploadify" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf">
                                        </div>
                                         <hr />
                                          <div class="d-grid">
                                             <button type="submit" class="btn btn-light">ثبت کالا</button>
                                          </div>
                                   </div>
                              </div>
                          </div>
                       </div><!--end row-->
                    </div>
                  </div>
            </form>
          </div>
        </div>
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <footer class="page-footer">
        <p class="mb-0">Copyright © 2021. All right reserved.</p>
    </footer>
</div>
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">
    <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
    </div>
    <div class="switcher-body">
        <div class="d-flex align-items-center">
            <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
            <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
        </div>
        <hr/>
        <p class="mb-0">Gaussian Texture</p>
          <hr>

          <ul class="switcher">
            <li id="theme1"></li>
            <li id="theme2"></li>
            <li id="theme3"></li>
            <li id="theme4"></li>
            <li id="theme5"></li>
            <li id="theme6"></li>
          </ul>
           <hr>
          <p class="mb-0">Gradient Background</p>
          <hr>

          <ul class="switcher">
            <li id="theme7"></li>
            <li id="theme8"></li>
            <li id="theme9"></li>
            <li id="theme10"></li>
            <li id="theme11"></li>
            <li id="theme12"></li>
          </ul>
    </div>
</div>
<!--end switcher-->
<!-- Bootstrap JS -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="../assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
<script>
    $(document).ready(function () {
        $('#image-uploadify').imageuploadify();
    })
</script>
<!--app JS-->
<script src="../assets/js/app.js"></script>
