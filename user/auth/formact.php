<?php
session_start();
require_once '../../common/config.php';

$_SESSION['response'] = '';
$logged_in = false;
if(isset($_POST['signinAttemp'])){
    if($connection) {
        if (isset($_POST['email']) && isset($_POST['password']) && $_POST['email'] && $_POST['password']) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $query = "SELECT " . USER_ID . ", " . USER_ADMIN . ", " . USER_EMAIL . ", " . USER_FULLNAME .
                " FROM  `" . TABLE_USERS . "` WHERE " . USER_EMAIL . "='$email' AND " . USER_PASSWORD . "='$password'";
            $result = $connection->query($query);
            if (!$result)
                $_SESSION['response'] = '<p class="error">بارگذاری داده های دیتابیس با خطا مواجه شد!</p>';
            else if ($result->num_rows > 0) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $_SESSION[USER_ID] = $row[USER_ID];
                $_SESSION[USER_EMAIL] = $row[USER_EMAIL];
                $_SESSION[USER_ADMIN] = $row[USER_ADMIN];
                $_SESSION[USER_FULLNAME] = $row[USER_FULLNAME];
                $logged_in = true;
            }
            else {
                $_SESSION['response'] = '<p class="error">ایمیل یا رمزعبور وارد شده اشتباه است!</p>';
            }

        } else
            $_SESSION['response'] = '<p class="error">لطفا فیلدها را به طور کامل پر کنید.</p>';

    }
    else {
        $_SESSION['response'] = '<p class="error">اتصال به سرور موفقیت آمیز نبود!</p>';
    }

    // take action:
    if(!$logged_in)
        header("Location: " . ROUTE_SIGN_IN);
    else
        header("Location: /");
}
else if(isset($_POST['signupAttemp'])){
    if($connection) {
        if (isset($_POST['email']) && isset($_POST['password']) && $_POST['email'] && $_POST['password']) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];

            if(is_numeric($email) || strlen($email) < 3)
                $_SESSION['response'] = '<p class="error"ایمیل وارد شده نامعتبر است!</p>';
            else if(strlen($password) < 4)
                $_SESSION['response'] = '<p class="error">رمزعبور انتخابی باید حداقل 4 کاراکتر باشد!</p>';
            else {
                $query = "SELECT * FROM  `" . TABLE_USERS . "` WHERE email='$email' ";
                $result = $connection->query($query);
                if (!$result)
                    $_SESSION['response'] = '<p class="error">بارگذاری داده های دیتابیس با خطا مواجه شد!</p>';
                else if ($result->num_rows > 0)
                    $_SESSION['response'] = '<p class="error">حساب کاربری دیگری با این ایمیل قبلا ثبت نام کرده است!</p>';
                else {
                    $query = "INSERT INTO `" . TABLE_USERS . "` (" . USER_EMAIL . ", " . USER_PASSWORD . ", " . USER_FULLNAME . ") values ('$email', '$password', '$fullname')";
                    $result = $connection->query($query);
                    if ($result)
                        $_SESSION['response'] = '<p class="success">ثبت نام با موفقیت انجام شد.</p>';
                    else
                        $_SESSION['response'] = '<p class="error">عملیات ثبت نام با مشکلی نامشخص مواجه شده است!</p>';
                }
            }
        } else
            $_SESSION['response'] = '<p class="error">لطفا فیلدها را به طور کامل پر کنید.</p>';

    }
    else {
        $_SESSION['response'] = '<p class="error">اتصال به سرور موفقیت آمیز نبود!</p>';
    }
    header("Location: " . ROUTE_SIGN_UP);
}