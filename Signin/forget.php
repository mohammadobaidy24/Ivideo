<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
?>
<!DOCTYPE html>
<html lang="utf-8">


<head>
    <title>فراموش شده - iVideo</title>
    <?php
    include '../tools/meta.php'; // فایل  مشخصات میتا صفحه
    include '../tools/stylesheet.php'; // فایل مشخصات سی اس اس
    ?>
    <script>
        function ShowPass() { // اسکرپت نمایش پسورد 
            var x = document.getElementById("pswd1");
            x.type = "text";
            var y = document.getElementById("pswd2");
            y.type = "text";
        }
    </script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder"> </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top bg-dark border-bottom border-success">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="header__top__left">
                            <ul>
                                <li> <a href="index.php"><i class="fa fa-user"></i> ورود</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="header__top__middel">
                            <div class="header__top__text">
                                با ما بپیوند و لذت ببر
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
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
    </header>
    <!-- Header Section End -->
    <!-- Breadcrumb Section Begin -->
    <section class=" spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="logo-section text-center"> ویدیوی من</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <?php

    $errors = array();   // خطأ ها را در اری ثبت میکنیم
    if (isset($_POST['search_user'])) { //هنگامیکه دکمه ورود فشار داده شد  
        // تمام داده وارد شده از فورم ها را میگیرد   	Escapes special characters in a string for use in an SQL statement
        $Input_Username = mysqli_real_escape_string($DB_config, $_POST['username']);
        $Input_Email = mysqli_real_escape_string($DB_config, $_POST['email']);
        $Input_Password_1 = mysqli_real_escape_string($DB_config, $_POST['password_1']);
        $Input_FirstName = mysqli_real_escape_string($DB_config, $_POST['firstname']);
        $Input_LastName = mysqli_real_escape_string($DB_config, $_POST['lastname']);
        // مطمأن میشویم که فیلد های ضروری پر شده است اگر نه شده بود خطأمربوط آن فیلد را نشان میدهد
        if (empty($Input_Username)) {
            array_push($errors, "نام کاربری ضروری میباشد");
        }
        if (empty($Input_Email)) {
            array_push($errors, "آدرس ایمل ضروری میباشد");
        }
        if (empty($Input_Password_1)) {
            array_push($errors, "رمز عبور ضروری میباشد");
        }
        if (count($errors) == 0) { //اگر تعداد خطا ها مساوی با صفر بود 
            $Hash_Password = md5($Input_Password_1); // رمز وارده را به هش تبدیل میکنیم بخاطر امنیت یوزر
            $Check_User = mysqli_query($DB_config,  "SELECT * FROM accounts WHERE (`username` like '$Input_Username') or (`email` = '$Input_Email') or (`password` like '$Hash_Password') LIMIT 1");
            if ($Check_User_Result = mysqli_fetch_assoc($Check_User)) {
                $User_ID = $Check_User_Result['ID'];
                header('location: update.php?id='.$User_ID); 
            } else {
                array_push($errors, "معلومات فوق طتابق ندارد");
            }
        }
    }
    ?>
    
    <!-- forms Section Begin -->
    <section class="forms spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><i class="fa fa-thumb-tack"></i> فیلد های ذیک را تکمیل نمائید
                    </h6>
                </div>
            </div>
            <div class="forms__form">
                <div class="col-lg-8 col-md-6">
                    <h4> <i class="	fa fa-edit"></i> جزئیات حساب</h4>
                    <form class="form-group" method="post" enctype="multipart/form-data" action="forget.php">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="forms__input">
                                    <p>نام</p>
                                    <input type="text" name="firstname" placeholder="نام تان را وارد نمائید" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="forms__input">
                                    <p>نام خانوادگی</p>
                                    <input type="text" name="lastname" placeholder="نام خانوادگی تان را وارد نمائید" />
                                </div>
                            </div>
                        </div>
                        <div class="forms__input">
                            <p><i class="fa fa-envelope"></i> آدرس ایمیل<span>*</span></p>
                            <input type="email" name="email" placeholder="آدرس ایمیل تان را وارد نمائید" />
                        </div>

                        <div class="forms__input">
                            <p><i class="fa fa-address-card"></i> نام کاربری<span>*</span></p>
                            <input type="text" name="username" placeholder="نام کابری تان را وارد نمائید" />
                        </div>
                        <div class="row">
                            <div class="forms__input">
                                <p><i class="fa fa-lock"></i> رمز عبور<span>*</span></p>
                                <input type="password" name="password_1" id="pswd1" placeholder="رمز عبور تان را وارد نمائید" />
                                <u onclick="ShowPass()"><i class="fa fa-eye-slash"></i> نمایش رمز عبور </u>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" name="search_user" class="submit"> <i class="fa fa-sign-in"></i> جستجو</button>
                                <div class="member">برگشت به صفحه<a href="index.php"> ورود</a></div>
                            </div>
                            <div class="col-lg-6">
                                <?php include '../tools/errors.php';  // خظأ ها را نشان میدهد 
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="forms__all">
                        <h4>داشته های ما...</h4>
                        <div class="forms__all__things">
                            <h3>کاربران</h3>
                            <ul>
                                <?php
                                $select_users = "SELECT * FROM accounts WHERE (`Gender` = 'male')";
                                $raw_results = mysqli_query($DB_config, $select_users);
                                $allmales = mysqli_num_rows($raw_results);
                                ?>
                                <li>آقا<span><?= $allmales ?></span></li>
                                <?php
                                $select_users = "SELECT * FROM accounts WHERE (`Gender` = 'female')";
                                $raw_results = mysqli_query($DB_config, $select_users);
                                $allfemales = mysqli_num_rows($raw_results);
                                ?>
                                <li>خانم<span><?= $allfemales ?></span></li>
                            </ul>
                        </div>
                        <div class="forms__total">مجموع کاربران
                            <span><?php echo $allmales + $allfemales; ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- forms Section End -->
    <?php
    include '../tools/footer.php'; // فایل فوتر 
    include '../tools/scripts.php'; // فایل اسکرپت ها 
    ?>
</body>

</html>
<?php
$DB_config->close(); // قطع ارتباط با دیتابیس 
?>