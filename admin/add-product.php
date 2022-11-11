
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    <!--end sidebar wrapper -->
    <!--start header -->
    <?php require_once __DIR__ . '/../common/sidebar.php'; ?>
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
        <form action="/admin/addact.php" method="post" enctype="multipart/form-data">
          <div class="card">
              <div class="card-bodyp-4">
                  <h5 class="card-title text-center my-3">کالای جدید</h5>
                  <div class="row">
                      <div dir="rtl" class="col-md-6 mx-auto">
                          <?php
                              if(isset($_SESSION['upload_status'])){
                                  echo $_SESSION['upload_status'];
                                  unset($_SESSION['upload_status']);
                              }
                          ?>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6 mx-auto">
                          <?php
                              if(isset($_SESSION['final_status'])){
                                  echo $_SESSION['final_status'];
                                  unset($_SESSION['final_status']);
                              }
                          ?>
                      </div>
                  </div>
                  <hr/>

                  <div dir="rtl" class="form-body mt-4">
                        <div class="row">
                           <div class="col-lg-8 mx-auto">
                               <div class="border border-3 p-4 rounded">
                                    <div class="mb-5">
                                        <label for="txtTitle" class="form-label">عنوان کالا
                                            <span style="font-size: 30px; color: orangered;">
                                                *
                                            </span>
                                        </label>
                                        <input type="text" class="form-control" name="title" id="txtTitle" required placeholder="عنوان کالا را وارد کنید">
                                      </div>
                                       <div class="mb-5">
                                           <label for="txtSummary" class="form-label">معرفی مختصر
                                               <span style="font-size: 30px; color: orangered;">
                                                    *
                                                </span>
                                           </label>
                                           <input name="summary" class="form-control" placeholder="معرفی مختصری وارد کنید" id="txtSummary"/>
                                       </div>
                                       <div class="mb-5">
                                           <label for="txtPrice" class="form-label">قیمت
                                               <span style="font-size: 30px; color: orangered;">
                                                        *
                                                </span>
                                           </label>
                                           <input type="number" class="form-control" name="price" id="txtPrice" placeholder="قیمت کالا را وارد کنید" required>
                                       </div>
                                      <div class="mb-5">
                                        <label for="txtDescription" class="form-label">معرفی کامل</label>
                                        <textarea id="txtDescription" name="description" class="form-control" placeholder="در اینجا می توانید معرفی کامل تر، با توضیحات بیشتر وارد کنید؛ و یا اینکه به همان معرفی مختصر اکتفا کنید و این بخش را خالی بگذارید" txtDescription" rows="5"></textarea>
                                      </div>
                                        <hr />
                                       <script type="text/javascript">
                                           function openFileDialog() {
                                               const fileInput = document.getElementById("inputProductImage");
                                               fileInput.click();
                                           }
                                       </script>
                                        <div class="my-5">
                                            <div onclick="openFileDialog()" class="file-box-input text-center">
                                                <label  for="inputProductImage" class="form-label">
                                                    <h4 id="labelForInputImage">
                                                    لطفا با کلیک بر اینجا عکس کالا را انتخاب کنید.
                                                    </h4>
                                                </label>
                                                <input id="inputProductImage" name="selectedImageFile" hidden type="file" accept=".jpg,.jpeg,.png,.gif">
                                            </div>
                                        </div>
                                         <hr />
                                          <div class="d-grid">
                                             <button type="submit" name="newPoductSubmitted" class="btn btn-light">ثبت کالا</button>
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
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
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
