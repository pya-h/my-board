
<!--wrapper-->
<div  class="wrapper">
    <!--sidebar wrapper -->
    <!--end sidebar wrapper -->
    <!--start header -->
    <?php
        if (!$_SESSION[USER_ADMIN]) {
            header("Location: " . ROUTE_FORBIDDEN);
            return;
        }
        require_once __DIR__ . '/../common/sidebar.php';
        require_once __DIR__ . '/../common/topnav.php';
    ?>
    <!--end header -->
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Station</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add Station</li>
                        </ol>
                    </nav>
                </div>

            </div>
            <!--end breadcrumb-->
        <form action="/admin/addact.php" method="post" enctype="multipart/form-data">
          <div class="card addstation-card">
              <div class="card-bodyp-4">
                  <h5 class="card-title text-center my-3">Add Station</h5>
                  <div class="row">
                      <div class="col-md-6 mx-auto">
                          <?php
                              if(isset($_SESSION[RES])){
                                  echo $_SESSION[RES];
                                  unset($_SESSION[RES]);
                              }
                          ?>
                      </div>
                  </div>
                  <hr/>

                  <div dir="ltr" class="form-body mt-4">
                        <div class="row">
                           <div class="col-lg-8 mx-auto">
                               <div class="border border-3 p-4 rounded">
                                   <div class="row mb-4">
                                       <div class="col-8">
                                           Remark
                                           <input type="text" class="form-control" name="remark" id="txtRemark" placeholder="Remark">
                                       </div>
                                       <div class="form-check col mt-3">
                                           <label class="form-check-label text-center mt-2 text-right" for="checkEnable">Enable</label>
                                           <input name="enable" class="w-25 h-75 mx-lg-5 mx-1 px-3 form-check-input" type="checkbox" checked id="checkEnable">
                                       </div>
                                   </div>
                                   <div class="row mb-4">
                                       <div class="col-6">
                                           Protocol
                                           <select name="protocol" class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
                                               <option value="vmess" selected>vmess</option>
                                               <option value="vless">vless</option>
                                               <option value="trojan">trojan</option>
                                               <option value="shadowsocks">shadowsocks</option>
                                               <option value="dokodemo-door">dokodemo-door</option>
                                               <option value="socks">socks</option>
                                               <option value="http">http</option>
                                           </select>

                                       </div>
                                       <div class="col">
                                           Listen IP:
                                           <input type="text" class="form-control" name="listen" id="txtMonitorIP" placeholder="Monitor IP">
                                       </div>
                                   </div>
                                   <div class="row mb-4">
                                       <div class="col-6">
                                           Port:
                                           <input type="number" class="form-control" name="port" id="txtPort" placeholder="Port">
                                       </div>
                                       <div class="col">
                                           Total Traffic (GB):
                                           <input type="number" class="form-control" name="total" id="txtTotalFlow" placeholder="Total Flow (GB)">
                                       </div>
                                   </div>
                                   <div class="row mb-4">
                                       <div class="col-8 text-center" style="margin-left: 20%">
                                           Expiration Date:
                                           <input type="date" class="form-control" name="expiryTime" style="cursor: pointer" id="dateExpiryTime" placeholder="Expiration Date">
                                           <script type="text/javascript">
                                              // const date = document.getElementById("dateExpiryTime").value = new Date().toString();
                                           </script>
                                       </div>
                                   </div>

                                   <hr />
                                   <div class="row mb-4">
                                       <div class="col-6">
                                           id:
                                           <input type="text" class="form-control" name="id" id="txtID" placeholder="ID">
                                       </div>
                                       <div class="col">
                                           Alter ID:
                                           <input type="number" class="form-control" name="alterId" id="txtTotalFlow" placeholder="Alter ID">
                                       </div>
                                   </div>
                                   <div class="row mb-4">
                                       <div class="col-md-6">
                                           Transmission (Network Type):
                                           <select name="network" class="form-select form-select-md mb-3" aria-label=".form-select-lg example">
                                               <option value="tcp" selected>tcp</option>
                                               <option value="kcp">kcp</option>
                                               <option value="ws">ws</option>
                                               <option value="http">http</option>
                                               <option value="quic">quic</option>
                                               <option value="grpc">grpc</option>
                                           </select>
                                       </div>
                                       <div class="col mx-auto">
                                           <div class="form-check form-switch col mt-3">
                                               <label class="form-check-label text-center mt-2 text-right" for="checkSniffing">Sniffing</label>
                                               <input name="sniffing" class="w-25 h-50 mx-lg-5 mx-1 px-3 form-check-input" type="checkbox" checked id="checkSniffing">
                                           </div>
                                       </div>
                                   </div>
                                   <hr />
                                   <div class="row my-4">
                                       <button type="submit" name="newStationSubmit" class="btn btn-secondary btn-block btn-lg px-5 mx-1 xbo">Add</button>
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
