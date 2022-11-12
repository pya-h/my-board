<?php
    session_start();
    require_once '../common/config.php';
    $_SESSION['final_status'] = null;
    $_SESSION['upload_status'] = null;
    global $connection;

    function uploadPhoto($img_file){
        // get details of the uploaded file
        $temp_path = $img_file['tmp_name'];
        $filename = $img_file['name'];
        $file_size = $img_file['size'];
        $file_type = $img_file['type'];
        $filename_split_bydot = explode(".", $filename);
        $fileExtension = strtolower(end($filename_split_bydot));
        $unique_filename = md5(time() . $filename) . '.' . $fileExtension;

        // check if file has one of the following extensions
        $allowed_extensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowed_extensions)) {
            // directory in which the uploaded file will be moved
            $upload_directory = '..' . MEDIA_DIR . IMG_DIR . '/';
            $destination = $upload_directory . $unique_filename;

            if (!move_uploaded_file($temp_path, $destination)) {
                $_SESSION['upload_status'] ='<p class="error">حین ذخیره فایل در سرور مشکلی رخ داده است!</p>';
                echo "EROR";
                return -1;
            }
        } else {
            $text = 'فایل انتخاب شده دارای فرمت نامعتبر است. فرمت های پشتیبانی شده:  ' . implode(',', $allowed_extensions);
            $_SESSION['upload_status'] ="<p class='error'>$text</p>";
            echo "EROR";

            return -1;
        }
        return $destination;
    }
    if(isset($_POST['newPoductSubmitted'])) {
        if(isset($_POST['title']) && isset($_POST['summary']) && isset($_POST['price'])){
            $title = trim($_POST['title']);
            $summary = trim($_POST['summary']);
            $price = $_POST['price'];
            $description = isset($_POST['description']) ? trim($_POST['description']) : "";
            if($title && $summary && $price) {
                if(is_numeric($price)) {
                    if(!strlen($summary))
                        $_SESSION['final_status'] = '<p class="error">فیلد معرفی مختصر نمی تواند خالی باشد!</p>';
                    else if(!strlen($title))
                        $_SESSION['final_status'] = '<p class="error">فیلد عنوان نمی تواند خالی باشد!</p>';
                    else {
                        $img_filename = null;
                     //   var_dump($_FILES);
                        if (isset($_FILES['selectedImageFile']) && $_FILES['selectedImageFile'] && trim($_FILES['selectedImageFile']["name"])) {
                            if ($_FILES['selectedImageFile']['error'] === UPLOAD_ERR_OK) {
                                $img_filename = uploadPhoto($_FILES['selectedImageFile']);
                            } else {
                                $_SESSION['upload_status'] = '<p class="error">حین آپلود تصویر مشکلی نامعلوم رخ داده است!</p>';
                                $img_filename = -1;
                            }
                        }
                        if($img_filename !== -1) {
                            $query = "INSERT INTO `" . TABLE_PRODUCTS . "` (" . PRODUCT_TITLE . ", " . PRODUCT_PRICE . ", " . PRODUCT_SUMMARY .
                                ", " . PRODUCT_DESCRIPTION . ($img_filename ? ", " . PRODUCT_IMAGE . ")" : ")") .
                                " values ('$title', $price, '$summary', '$description'" . ($img_filename ? ", '$img_filename')" : ")");
                            $result = $connection->query($query);
                            $_SESSION['final_status'] = '<p class="success">کالای موردنظر با موفقیت اضافه شد.</p>';
                        } else {
                            $_SESSION['final_status'] = '<p class="error">ثبت کالا ناموفق بود. لطفا دوباره تلاش کنید...</p>';
                        }
                    }
                }
                else
                    $_SESSION['final_status'] = '<p class="error">فیلد قیمت کالا نمی تواند مقدار غیر عددی بگیرد!</p>';
            }
            else
                $_SESSION['final_status'] = '<p class="error">لطفا فیلدها را به طور کامل پر کنید.</p>';
        }
        else
            $_SESSION['final_status'] = '<p class="error">لطفا فیلدها را به طور کامل پر کنید.</p>';
    }


header("Location: " . ROUTE_ADD_PRODUCT);
