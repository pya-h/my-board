<?php
session_start();
require_once '../common/config.php';
$_SESSION[RES] = null;
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

function network_default_setting($network){
    switch ($network) {
        case "kcp":
            return ["header" => ["type" => "none"], "seed" => "QZHSjaxi5h", 'mtu' => 1350, 'tti' => 20,
                    "uplinkCapacity" => 5, "downlinkCapacity" => 20, "congestion" => false,
                    "readBufferSize" => 2, "writeBufferSize" => 2
                ];
        case "ws":
            return ["headers" => [], "path" => "/"];
        case "http":
            return ["host" => [], "path" => "/"];
        case "quic":
            return ["security" => "none", "key" => "", "header" => ["type" => "none"]];
        case "grpc":
            return ["serviceName" => ""];
        case "tcp":
        default:
            return ["header" => ["type" => "none"]];

    }
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
                    $_SESSION[RES] = '<p class="error">فیلد معرفی مختصر نمی تواند خالی باشد!</p>';
                else if(!strlen($title))
                    $_SESSION[RES] = '<p class="error">فیلد عنوان نمی تواند خالی باشد!</p>';
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
                        $_SESSION[RES] = '<p class="success">کالای موردنظر با موفقیت اضافه شد.</p>';
                    } else {
                        $_SESSION[RES] = '<p class="error">ثبت کالا ناموفق بود. لطفا دوباره تلاش کنید...</p>';
                    }
                }
            }
            else
                $_SESSION[RES] = '<p class="error">فیلد قیمت کالا نمی تواند مقدار غیر عددی بگیرد!</p>';
        }
        else
            $_SESSION[RES] = '<p class="error">لطفا فیلدها را به طور کامل پر کنید.</p>';
    }
    else
        $_SESSION[RES] = '<p class="error">لطفا فیلدها را به طور کامل پر کنید.</p>';
}

else if(isset($_POST['newStationSubmit'])) {
    $payload = ["down" => 0, "up" => 0];
    try {
        $payload["enable"] = array_key_exists("enable", $_POST) && (strtolower($_POST["enable"] || strtolower($_POST["enable"]) === "on"));
    } catch (Exception) {
        $payload["enable"] = false;
    }
    try {
        $straight_fields = ['remark', 'protocol', 'listen'];
        foreach ($straight_fields as $skey)
            $payload[$skey] = $_POST[$skey];
        foreach (['port', 'total'] as $item) {
            $payload[$item] = intval($_POST[$item]);
        }
    } catch (Exception $ex) {
        $_SESSION[RES] = "Error: $ex";
    }
    $payload["setting"] = ["clients" => [ ["id" => $_POST["id"], "alterId" => intval($_POST["alterId"]) ] ], "disableInsecureEncryption" => false];
    $network = strtolower($_POST["network"]);
    $network_setting = network_default_setting($network);
    $payload["streamSettings"] = ["network" => $network, "security" => "none", ]; // not completed yet!
    $payload["streamSettings"][$network . "Setting"] = ["network" => $network, "security" => "none", ]; // not completed yet!
    $payload["sniffing"] = ["enabled" =>  array_key_exists("sniffing", $_POST) && (strtolower($_POST["sniffing"] || strtolower($_POST["sniffing"]) === "on")),
                                    "destOverride" => ["http", "tls"]
        ];

    $payload["streamSettings"] = json_encode($payload["streamSettings"]);
    $payload["sniffing"] = json_encode($payload["sniffing"]);

    $jsonData = json_encode($payload);

    $ch = curl_init("http://91.149.255.31:54321/xui/inbound/add");
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonData),
        "Cookie: " . $_SESSION[COOKIE] ));

    $result = curl_exec($ch);
    $err = curl_error($ch);
    $result = json_decode($result, true, JSON_PRETTY_PRINT);
    curl_close($ch);
    if($result["success"])
         $_SESSION[RES] = "<p class=\"success\">Successful: " . $result["msg"] . "</p>";
    else
        $_SESSION[RES] = "<p class=\"error\">ERROR: " . $result["msg"] . "</p>";

}
redirect(ROUTE_ADD_STATION);
