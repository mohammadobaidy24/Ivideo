<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
session_start();  // آغاز سیزن
$errors = array();   // خطأ ها را در اری ثبت میکنیم
if (isset($_POST['Login_Btn'])) {  //هنگامیکه دکمه ورود فشار داده شد
    $Input_Username = mysqli_real_escape_string($DB_config, $_POST['Input_Username']); // 	Escapes special characters in a string for use in an SQL statement
    $Input_Password = mysqli_real_escape_string($DB_config, $_POST['Input_Password']);
    if (empty($Input_Username)) { // اگر نام کاربری حالی بود
        array_push($errors, "<i class='alert alert-danger'>نام کاربری را وارد نمائید</i>"); // جمله ذیل را در متحول ایرورس ذخیره میکند
    }
    if (empty($Input_Password)) { // اگر رمز خالی بود
        array_push($errors, "<i class='alert alert-danger'>رمز عبور تان را وارد نمائید</i>"); // جمله ذیل را در متحول ایرورس ذخیره میکند
    }
    if (count($errors) == 0) { //اگر تعداد خطا ها مساوی با صفر بود 
        $Input_Password = md5($Input_Password); // رمز وارده را به هش تبدیل میکنیم بخاطریکه رمز در دیتابیس بطور هش ثبت است

        $S_L_U = mysqli_query($DB_config, "SELECT * FROM `accounts` WHERE `username`='$Input_Username' AND `password`='$Input_Password'");
        if (mysqli_num_rows($S_L_U) == 1) { // اگر نام کاربری وارد شده و رمز عبور آن در دیتابیس موجود بود 
            if ($S_L_U_row = mysqli_fetch_assoc($S_L_U)) {  // معلومات درباره یوزر وارد شده را از دیتابیس میگیرد
                $S_L_U_ID = $S_L_U_row['ID'];              // کاربر id 
                $S_L_U_fname = $S_L_U_row['FirstName'];        // کاربر firstname
                $S_L_U_lname = $S_L_U_row['LastName'];         // کاربر lastname
                $S_L_U_gender = $S_L_U_row['Gender'];          // کاربر gender
                $S_L_U_username = $S_L_U_row['username'];      // کاربر username
                $S_L_U_email = $S_L_U_row['email'];            // کاربر email
                $S_L_U_profile = $S_L_U_row['Profile'];        // کاربر profile
            }
            $_SESSION['username'] = $S_L_U_username;  //  نام کاربری یوزر وارد شده را در سیزن ثبت میکند
            $_SESSION['userid'] = $S_L_U_ID;  //  آی دی  یوزر وارد شده را در سیزن ثبت میکند
           
if(isset($_COOKIE['player_id'])){
    header("location: ../Player/index.php?id=".$_COOKIE['player_id']."#player");
}
if(isset($_COOKIE['path'])){
    header("location: ../".$_COOKIE['path']);
}
if(isset($_COOKIE['massege'])){
    header("location: ../Contact/send.php");
}

            if($_SESSION['username'] == "admin"){
                header('location: ../Admin/index.php');
            }
        } else { // اگر نام کاربری وارد شده و رمز عبور آن در دیتابیس موجود نبود 
            array_push($errors, "
				<i class='alert alert-danger'>ترکیب نام کاربر و رمز عبور اشتباه است</i>"); // جمله ذیل را در متحول ایرورس ذخیره میکند
        }
    }
}
?>
<!DOCTYPE html>
<html lang="UTF-8">

<head>
    <title>ورود - iVideo</title>
    <?php
    include '../tools/meta.php'; // فایل  مشخصات میتا صفحه
    include '../tools/stylesheet.php'; // فایل مشخصات سی اس اس
    ?>
</head>

<body>
    <!-- Header Section Begin -->
    <div class="header__top bg-dark border-bottom border-success">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="header__top__left">
                        <ul>
                            <li><a href="signup.php"><i class="fa fa-user"></i> ثبت نام</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 head">
                    <div class="header__top__middel">
                        <div class="header__top__text">
                            افراد واقعی، ویدیو های واقعی.
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5">
                    <div class="header__top__right">
                        <ul>
                            <li>روزت را بساز!</li>
                            <li><i class="fa fa-video-camera"></i><b> ویدیوی من </b></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Section End -->
    <!--  آغاز یخش ورود -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form class="box" action="index.php" method="post" enctype="multipart/form-data">
                        <h1>ورود</h1>
                        <p class="text-muted"> نام کاربری و رمز عبورتان را وار نمائید</p>
                        <?php include('../tools/errors.php');  // خظأ ها را نشان میدهد 
                        ?>
                        <input type="text" name="Input_Username" placeholder="نام کاربری" autofocus>
                        <input type="password" name="Input_Password" placeholder="رمز عبور">
                        <a class="forgot text-muted" href="forget.php">
                            فراموش کرده اید؟</a>
                        <button type="submit" name="Login_Btn" value="Login">ورود</button>
                        <div class="signup">
                            <a href="signup.php">
                                <li>حساب کار بری ندارید؟</li>
                                <li>حساب کاربری جدید بسازید</li>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    include '../tools/footer.php'; // فایل فوتر 
    include '../tools/scripts.php'; // فایل اسکرپت ها 
    ?>
</body>

</html>
<?php
$DB_config->close(); // قطع ارتباط با دیتابیس 
?>