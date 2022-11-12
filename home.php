
<!--wrapper-->
<div class="wrapper">
    <?php require_once __DIR__ . '/common/sidebar.php';
    require_once __DIR__ . '/common/topnav.php' ?>

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <div class="row row-cols-1 row-cols-lg-3">

                <?php
                    if(!isset($_SESSION[COOKIE]) || !$_SESSION[COOKIE])
                        login2panel();

                    $ch = curl_init("http://91.149.255.31:54321/server/status");
                    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        "Cookie: " . $_SESSION[COOKIE] ));
                    $result = curl_exec($ch);
                    $err = curl_error($ch);
                    $result = json_decode($result, true, JSON_PRETTY_PRINT);
                    curl_close($ch);
                    if(array_key_exists("obj", $result))
                        $result = $result["obj"];
                    else return;
                ?>
                <div class="col d-flex">
                    <div class="card radius-10 w-100 overflow-hidden">
                        <div class="card-body">
                            <h4 class="text-center">CPU & RAM</h4>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">CPU:</h5>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <h4 class="cool-anchor"><?php echo sprintf("%.2f", $result['cpu']) ?> %</h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Memory:</h5>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <h4 class="cool-anchor"><?php echo short_size($result['mem']['current']) . " / " . short_size($result['mem']['total']) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card radius-10 w-100 overflow-hidden">
                        <div class="card-body">
                            <h4 class="text-center">Disk Usages</h4>

                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Disk:</h5>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <h4 class="cool-anchor"><?php echo short_size($result['disk']['current']) . " / " . short_size($result['disk']['total']) ?></h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Swap:</h5>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <h4 class="cool-anchor"><?php echo short_size($result['swap']['current']) . " / " . short_size($result['swap']['total']) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="col d-flex">
                    <div class="card radius-10 w-100 overflow-hidden">
                        <div class="card-body">
                            <h4 class="text-center">Traffic</h4>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Sent:</h5>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <h4 class="cool-anchor"><?php echo short_size($result['netTraffic']['sent']) ?></h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Received:</h5>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <h4 class="cool-anchor"><?php echo short_size($result['netTraffic']['recv']) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card radius-10 w-100 overflow-hidden">
                        <div class="card-body">
                            <h4 class="text-center">Net Speed</h4>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Upload:</h5>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <h4 class="cool-anchor"><?php echo short_size($result['netIO']['up']) ?></h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">Download:</h5>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <h4 class="cool-anchor"><?php echo short_size($result['netIO']['down']) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="col d-flex">
                    <div class="card radius-10 w-100 overflow-hidden">
                        <div class="card-body">
                            <h4 class="text-center">Counts</h4>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">TCP:</h5>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <h4 class="cool-anchor"><?php echo $result['tcpCount'] ?></h4>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <div>
                                    <h5 class="mb-0">UDP:</h5>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <h4 class="cool-anchor"><?php echo  $result['udpCount'] ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
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
<?php require_once __DIR__ . '/common/switcher.php' ?>

<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#Transaction-History').DataTable({
            lengthMenu: [[6, 10, 20, -1], [6, 10, 20, 'Todos']]
        });
      } );
</script>
<script src="assets/js/index.js"></script>
<!--app JS-->
<script src="assets/js/app.js"></script>
<script>
    new PerfectScrollbar('.product-list');
    new PerfectScrollbar('.customers-list');
</script>