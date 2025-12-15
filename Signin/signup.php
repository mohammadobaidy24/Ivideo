<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
?>
<!DOCTYPE html>
<html lang="utf-8">
<?php

$errors = array();   // خطأ ها را در اری ثبت میکنیم
if (isset($_POST['reg_user'])) { //هنگامیکه دکمه ورود فشار داده شد  
    // تمام داده وارد شده از فورم ها را میگیرد   	Escapes special characters in a string for use in an SQL statement
    $Input_Username = mysqli_real_escape_string($DB_config, $_POST['username']);
    $Input_Email = mysqli_real_escape_string($DB_config, $_POST['email']);
    $Input_Password_1 =  $_POST['password_1'];
    $Input_Password_2 = $_POST['password_2'];
    $Input_FirstName = mysqli_real_escape_string($DB_config, $_POST['firstname']);
    $Input_LastName = mysqli_real_escape_string($DB_config, $_POST['lastname']);
    $Input_Gender = mysqli_real_escape_string($DB_config, $_POST['gender']);
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
    if (empty($Input_Password_2)) {
        array_push($errors, "تائید رمز عبور ضروری میباشد");
    }
    if ($Input_Password_1 != $Input_Password_2) {
        array_push($errors, "رمز های عبور باهم مطابقت نمیکند");
    }
    // دیتابیس را چک مینماییم تا مطمأ شویم نام کاربری و ایمیل موجود است یا نی
    $Check_User = mysqli_query($DB_config,  "SELECT * FROM accounts WHERE username='$Input_Username' OR email='$Input_Email' LIMIT 1");
    if ($Check_User_Result = mysqli_fetch_assoc($Check_User)) {
        // اگر فیلدی در دیتابیس موجود بود 
        if ($Check_User_Result['username'] === $Input_Username) {
            array_push($errors, "نام کاربری موجود است");
        }
        if ($Check_User_Result['email'] === $Input_Email) {
            array_push($errors, "ایمیل  موجود است");
        }
    }
    $Input_Profile = $_FILES["profile"]["name"]; // عکس نمایه 
    if (empty($profile)) {  // اگر عکس نمایه انتخاب نشده بود 
        switch ($Input_Gender) {  // جتسیت فرد را در نظر گرفته عکس نمایه پیش فرض به آن میدهیم 
            case 'Male':
                $New_Input_Profile = "Defult Male Profile.png";
                break;
            case 'Female':
                $New_Input_Profile = "Defult Female Profile.png";
                break;
        }
    } else {  // اگر عگس نمایه انتخاب شده بود 
        $New_Input_Profile = "$Input_Username Profile $Input_Profile";  // عکس را به نام یوزر تغیر نام میدهیم 
    }
    if (count($errors) == 0) { //اگر تعداد خطا ها مساوی با صفر بود 
        move_uploaded_file($_FILES["profile"]["tmp_name"], "../DB/Users/" . $New_Input_Profile . "");  // عکس نمایه را ذخیره میکنیم
        $Hash_Password = md5($Input_Password_2); // رمز وارده را به هش تبدیل میکنیم بخاطر امنیت یوزر
        mysqli_query($DB_config, "INSERT INTO accounts (`username`, `email`, `password`, `FirstName`, `LastName`, `Gender`, `Profile`) 
        VALUES('$Input_Username', '$Input_Email', '$Hash_Password', '$Input_FirstName', '$Input_LastName', '$Input_Gender', '$New_Input_Profile')");  // معلومات یوزر را در دیتابیس وارد میکنیم 

        $S_L_U = mysqli_query($DB_config, "SELECT * FROM accounts WHERE username='$Input_Username' AND password='$Hash_Password'"); // بعدأ یوزر را از دیتابیس سلکت میکنیم بخاطر ورود به سایت
        if ($S_L_U_row = mysqli_fetch_assoc($S_L_U)) {
            $S_L_U_ID = $S_L_U_row['ID'];              // کاربر id 
            $S_L_U_fname = $S_L_U_row['FirstName'];        // کاربر firstname
            $S_L_U_lname = $S_L_U_row['LastName'];         // کاربر lastname
            $S_L_U_gender = $S_L_U_row['Gender'];          // کاربر gender
            $S_L_U_username = $S_L_U_row['username'];      // کاربر username
            $S_L_U_email = $S_L_U_row['email'];            // کاربر email
            $S_L_U_profile = $S_L_U_row['Profile'];        // کاربر profile
        }
        session_start();  // آغاز سیزن
        $_SESSION['username'] = $S_L_U_username;  //  نام کاربری یوزر وارد شده را در سیزن ثبت میکند
        $_SESSION['userid'] = $S_L_U_ID;  //  آی دی  یوزر وارد شده را در سیزن ثبت میکند
       
        header('location: welcome.php'); // یوزر را به صفحه خوش آمدید منتقل میسازیم 
    }
}
?>

    <head>
        <title>ثبت نام - iVideo</title>
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

        <!-- forms Section Begin -->
        <section class="forms spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h6><i class="fa fa-thumb-tack"></i> با ما بپیوند و دنیای خودت را بساز و از تماشای ویدیو ها لذت ببر
                        </h6>
                    </div>
                </div>
                <div class="forms__form">
                    <div class="col-lg-8 col-md-6">
                        <h4> <i class="	fa fa-edit"></i> جزئیات حساب</h4>
                        <form class="form-group" method="post" enctype="multipart/form-data" action="signup.php">

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
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="forms__input">
                                        <p><i class="fa fa-venus-mars"></i> جنسیت<span>*</span></p>
                                        <div class="radio">
                                            <label> <input style="width:20px;" type="radio" name="gender" value="Male" required>آقا</label>
                                        </div>
                                        <div class="radio">
                                            <label><input style="width:20px;"type="radio" name="gender" value="Female" required>خانم</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="forms__input">
                                        <p><i class="fa fa-photo"></i> عکس نمایه</p>
                                        <input type="file" name="profile" accept="image/*">
                                    </div>
                                </div>
                            </div>
                            <div class="forms__input">
                                <p><i class="fa fa-address-card"></i> نام کاربری<span>*</span></p>
                                <input type="text" name="username" placeholder="نام کابری تان را وارد نمائید" />
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="forms__input">
                                        <p><i class="fa fa-lock"></i> رمز عبور<span>*</span></p>
                                        <input type="password" name="password_1" id="pswd1" placeholder="رمز عبور تان را وارد نمائید" />
                                        <u onclick="ShowPass()"><i class="fa fa-eye-slash"></i> نمایش رمز عبور </u>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="forms__input">
                                        <p><i class="fa fa-lock"></i> تائید رمز عبور<span>*</span></p>
                                        <input type="password" name="password_2" id="pswd2" placeholder="رمز عبورتان را دوباره وارد نمائید" />
                                        <u onclick="ShowPass()"> <i class="fa fa-eye-slash"></i> نمایش تائید رمز عبور</u>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="submit" name="reg_user" class="submit btn btn-primary"> <i class="fa fa-sign-in"></i> ثبت نام</button>
                                    <div class="member"> عضو هستید؟ <a href="index.php">ورود</a></div>
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