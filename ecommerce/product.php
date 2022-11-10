
<div class="wrapper">
    <?php
        require_once __DIR__ . '/../common/sidebar.php' ;
        require_once __DIR__ . '/../common/topnav.php' ;
        if($connection) {
            $product_id = get_url_param($_SERVER['REQUEST_URI'], "id");
            $query = sprintf("SELECT * FROM `%s` WHERE %s=%d AND %s=%d", TABLE_PRODUCTS, PRODUCT_ID, $product_id, PRODUCT_AVAILABLE, 1);
            $result = $connection->query($query);
            $product = null;
            if($result){
                if($result->num_rows > 0)
                    $product = $result->fetch_array(MYSQLI_ASSOC);
                else
                    $db_result = '<p class="error">کالای مورد نظر پیدا نشد!</p>';
            }
            else
                $db_result = '<p class="error">حین دریافت اطلاعات محصول خطایی بوجود آمد</p>';
        }
        else
            $db_result = '<p class="error">برقراری ارتباط با دیتابیس ناموفق بود!</p>';
    ?>

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
                            <li class="breadcrumb-item active" aria-current="page">مشخصات کالا</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <?php
                if ($db_result) {
                    echo $db_result;
                    $db_result = null;
                }
            ?>
             <div class="card">
                <div class="row g-0">
                  <div class="col-md-4 border-end">
                    <img src="https://via.placeholder.com/600x600" class="img-fluid" alt="...">
                    <div class="row mb-3 row-cols-auto g-2 justify-content-center mt-3">
                        <div class="col"><img src="https://via.placeholder.com/110x110" width="70" class="border rounded cursor-pointer" alt=""></div>
                        <div class="col"><img src="https://via.placeholder.com/110x110" width="70" class="border rounded cursor-pointer" alt=""></div>
                        <div class="col"><img src="https://via.placeholder.com/110x110" width="70" class="border rounded cursor-pointer" alt=""></div>
                        <div class="col"><img src="https://via.placeholder.com/110x110" width="70" class="border rounded cursor-pointer" alt=""></div>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h4 class="card-title">Off-White Odsy-1000 Men Half T-Shirt</h4>
                      <div class="d-flex gap-3 py-3">
                        <div class="cursor-pointer">
                            <i class='bx bxs-star text-warning'></i>
                            <i class='bx bxs-star text-warning'></i>
                            <i class='bx bxs-star text-warning'></i>
                            <i class='bx bxs-star text-warning'></i>
                            <i class='bx bxs-star'></i>
                          </div>
                          <div>142 reviews</div>
                          <div class="text-white"><i class='bx bxs-cart-alt align-middle'></i> 134 orders</div>
                      </div>
                      <div class="mb-3">
                        <span class="price h4">$149.00</span>
                        <span class="">/per kg</span>
                    </div>
                      <p class="card-text fs-6">Virgil Abloh’s Off-White is a streetwear-inspired collection that continues to break away from the conventions of mainstream fashion. Made in Italy, these black and brown Odsy-1000 low-top sneakers.</p>
                      <dl class="row">
                        <dt class="col-sm-3">Model#</dt>
                        <dd class="col-sm-9">Odsy-1000</dd>

                        <dt class="col-sm-3">Color</dt>
                        <dd class="col-sm-9">Brown</dd>

                        <dt class="col-sm-3">Delivery</dt>
                        <dd class="col-sm-9">Russia, USA, and Europe </dd>
                      </dl>
                      <hr>
                      <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center">
                        <div class="col">
                            <label class="form-label">Quantity</label>
                            <div class="input-group input-spinner">
                                <button class="btn btn-light" type="button" id="button-plus"> + </button>
                                 <input type="text" class="form-control" value="1">
                                <button class="btn btn-light" type="button" id="button-minus"> − </button>
                            </div>
                        </div>
                        <div class="col">
                                <label class="form-label">Select size</label>
                                <div class="">
                                    <label class="form-check form-check-inline">
                                      <input type="radio"class="form-check-input"  name="select_size" checked="" class="custom-control-input">
                                      <div class="form-check-label">Small</div>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input type="radio"class="form-check-input"  name="select_size" checked="" class="custom-control-input">
                                        <div class="form-check-label">Medium</div>
                                      </label>

                                      <label class="form-check form-check-inline">
                                        <input type="radio"class="form-check-input"  name="select_size" checked="" class="custom-control-input">
                                        <div class="form-check-label">Large</div>
                                      </label>
                                </div>
                        </div>
                        <div class="col">
                            <label class="form-label">Select Color</label>
                            <div class="color-indigators d-flex align-items-center gap-2">
                                 <div class="color-indigator-item bg-primary"></div>
                                 <div class="color-indigator-item bg-danger"></div>
                                 <div class="color-indigator-item bg-success"></div>
                                 <div class="color-indigator-item bg-warning"></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="btn btn-white">Buy Now</a>
                        <a href="#" class="btn btn-light"><span class="text">Add to cart</span> <i class='bx bxs-cart-alt'></i></a>
                    </div>
                    </div>
                  </div>
                </div>
                <hr/>
                <div class="card-body">
                    <ul class="nav nav-tabs mb-0" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title"> Product Description </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-bookmark-alt font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Tags</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#primarycontact" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-star font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Reviews</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content pt-3">
                        <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi.</p>
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi.</p>
                        </div>
                        <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
                        </div>
                        <div class="tab-pane fade" id="primarycontact" role="tabpanel">
                            <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                        </div>
                    </div>
                </div>

              </div>


                <h6 class="text-uppercase mb-0">Related Product</h6>
                <hr/>
                 <div class="row row-cols-1 row-cols-lg-3">
                       <div class="col">
                        <div class="card">
                            <div class="row g-0">
                              <div class="col-md-4">
                                <img src="https://via.placeholder.com/110x110" class="img-fluid" alt="...">
                              </div>
                              <div class="col-md-8">
                                <div class="card-body">
                                  <h6 class="card-title">Light Grey Headphone</h6>
                                  <div class="cursor-pointer my-2">
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-secondary"></i>
                                  </div>
                                  <div class="clearfix">
                                    <p class="mb-0 float-start fw-bold"><span class="me-2 text-decoration-line-through text-secondary">$240</span><span>$199</span></p>
                                 </div>
                                </div>
                              </div>
                            </div>
                          </div>
                       </div>
                       <div class="col">
                        <div class="card">
                            <div class="row g-0">
                              <div class="col-md-4">
                                <img src="https://via.placeholder.com/110x110" class="img-fluid" alt="...">
                              </div>
                              <div class="col-md-8">
                                <div class="card-body">
                                  <h6 class="card-title">Black Cover iPhone 8</h6>
                                  <div class="cursor-pointer my-2">
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                  </div>
                                  <div class="clearfix">
                                    <p class="mb-0 float-start fw-bold"><span class="me-2 text-decoration-line-through text-secondary">$179</span><span>$110</span></p>
                                 </div>
                                </div>
                              </div>
                            </div>
                          </div>
                       </div>
                       <div class="col">
                        <div class="card">
                            <div class="row g-0">
                              <div class="col-md-4">
                                <img src="https://via.placeholder.com/110x110" class="img-fluid" alt="...">
                              </div>
                              <div class="col-md-8">
                                <div class="card-body">
                                  <h6 class="card-title">Men Hand Watch</h6>
                                  <div class="cursor-pointer my-2">
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-warning"></i>
                                    <i class="bx bxs-star text-secondary"></i>
                                    <i class="bx bxs-star text-secondary"></i>
                                  </div>
                                  <div class="clearfix">
                                    <p class="mb-0 float-start fw-bold"><span class="me-2 text-decoration-line-through text-secondary">$150</span><span>$120</span></p>
                                 </div>
                                </div>
                              </div>
                            </div>
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
<!--app JS-->
<script src="../assets/js/app.js"></script>
