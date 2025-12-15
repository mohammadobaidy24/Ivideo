<?php
$DB_host = "iVideo.com";                   // نام هاست دیتابیس
$DB_user = "root";            // نام کاربری استفاده کننده 
$DB_password = "";    // رمز استفاده کننده
$DB_name = "iVideo_db";                  // نام دیتابیس
$DB_config = mysqli_connect($DB_host, $DB_user, $DB_password, $DB_name); // عملیه وصل شدن به دیتابیس
if (!$DB_config) {                         // اگر به دیتابیس وصل نشده بود
    die("Connection failed: " . mysqli_connect_error());    //این خطا را نمایش میدهد
}
$id = $_GET['id'];
session_start();  // آغاز سیزن
$S_U = mysqli_query($DB_config, "SELECT * FROM `accounts`  WHERE `ID`=$id");
$S_U_row = mysqli_fetch_array($S_U);  // معلومات درباره یوزر وارد شده را از دیتابیس میگیرد
$S_U_ID = $S_U_row['ID'];              // کاربر id 
$S_U_fname = $S_U_row['FirstName'];        // کاربر firstname
$S_U_lname = $S_U_row['LastName'];         // کاربر lastname
$S_U_gender = $S_U_row['Gender'];          // کاربر gender
$S_U_username = $S_U_row['username'];      // کاربر username
$S_U_email = $S_U_row['email'];            // کاربر email
$S_U_profile = $S_U_row['Profile'];        // کاربر profile

if (isset($_POST['Login_Btn'])) {  //هنگامیکه دکمه ورود فشار داده شد
    $New_Input_Username = mysqli_real_escape_string($DB_config, $_POST['New_Input_Username']); // 	Escapes special characters in a string for use in an SQL statement
    $New_Input_Password =  mysqli_real_escape_string($DB_config, $_POST['New_Input_Password']);
    $Hashed_Password = md5($New_Input_Password); // رمز وارده را به هش تبدیل میکنیم بخاطریکه رمز در دیتابیس بطور هش ثبت است
    $query =  "UPDATE `accounts` SET `username`='$New_Input_Username' , `password`='$New_Input_Password' where `ID`='$S_U_ID' limit 1";
    if (mysqli_query($DB_config, $query)) {
        echo 'shode';
    } else {
        echo 'nashoid';
    }
} ?>
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
                <div class="col-lg-4 col-md-4">
                    <div class="header__top__middel">
                        <div class="header__top__text">
                            افراد واقعی، ویدیو های واقعی.
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
    <!-- Header Section End -->
    <!--  آغاز یخش ورود -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form class="box" action="update.php" method="post" enctype="multipart/form-data">
                        <h1>باز نویسی</h1>
                        <p class="text-muted"> نام کاربری و رمز عبور جدید تان را وارد کنید</p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- forms Section Begin -->
    <section class="forms spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><i class="fa fa-thumb-tack"></i> نام کاربری و رمز عبور جدید تان را وارد کنید
                    </h6>
                </div>
            </div>
            <div class="forms__form">
                <div class="col-lg-8 col-md-6">
                    <h4> <i class="	fa fa-edit"></i> باز نویسی</h4>
                    <form class="form-group" method="post" enctype="multipart/form-data" action="update.php">
                        <div class="forms__input">
                            <p><i class="fa fa-address-card"></i> نام کاربری<span>*</span></p>
                            <input type="text" name="New_Input_Username" placeholder="نام کاربری" value="<?= $S_U_username ?>" required>
                        </div>
                        <div class="forms__input">
                            <p><i class="fa fa-lock"></i> رمز عبور<span>*</span></p>
                            <input type="password" name="New_Input_Password" placeholder="رمز عبور" required>
                            <u onclick="ShowPass()"><i class="fa fa-eye-slash"></i> نمایش رمز عبور </u>
                        </div>
                        <div class="forms__input">
                            <button type="submit" name="Login_Btn" value="Login">اعمال</button>
                            <div class="member">برگشت به صفحه<a href="index.php"> ورود</a></div>
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