<?php
include '../tools/DB_config.php';  //   فایل ارتباط با دیتابیس
$Path =  'Contact/contact.php';  //آدرس صفحه 
?>
<!DOCTYPE html> <!-- HTML 5 -->
<html lang="utf-8">
<!-- آغاز HTML -->

<head>
    <title>ارتباط با ما - iVideo</title> <!-- عنوان صفحه -->
    <?php
    include '../tools/meta.php';    // فایل  مشخصات میتا صفحه
    include '../tools/userproperty.php';  // فایل مشخصات یوزر وارد شده
    include '../tools/stylesheet.php';  // فایل مشخصات سی اس اس
    ?>
</head> <!--  ختم عنوان  -->
<?php
                        if (isset($_POST['submit'])) { //هنگامیکه دکمه ازسال فشار داده شد 
                            $subject = $_POST['subject']; //موضوع پیام را میگیرد
                            $massege = $_POST['massege']; //متن پیام را میگیرد
                            if (isset($_SESSION['username'])){
                                $q = "INSERT INTO `contact_us`(`ID`, `Author`, `Subject`, `Massege`) VALUES ('', '$S_L_U_username' ,'$subject','$massege')"; // پیام وارد شده را در دیتابیس ،در جدول کانتکت از ثبت میشود
                                if (mysqli_query($DB_config, $q)) { //اگر پیام در جدول ثبت شد این پراگراف را نمایش میدهد
                                    echo '<p class="alert alert-success">' . $S_L_U_fname . ' ' . $S_L_U_lname . ' عزیز <br/> تشکر از پیام تان ، پیام تان بزودی بررسی خواهد شد.</p>';
                                } else {                                    // نام یوزر و نام خانوادگی یوزر
                                    echo 'ERROR :)';
                                }
                            }else{
                                        setcookie("subject",$subject,time()+120,"/","",0);
                                        setcookie("massege",$massege,time()+120,"/","",0);
                                        header('location: ../Signin/index.php');  // به صفحه ورود آن را انتقال دهد
                                    }
                           
                        }

                        ?>
<body>
    <!-- آغاز بدنه -->
    <?php
    include '../tools/header.php';  // فایل عنوان بالایی و محوطه سمت یابی پیوند ها
    include '../tools/humberger.php';  // فایل مینویی موبایل
    include '../tools/hero.php';  // فایل دسته بندی ها، جستجو و تاریخ
    ?>

    <!-- Breadcrumb آغاز -->
    <section class="breadcrumb-section container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <!-- صفحه باز بوده ره مشخص میکند  -->
                        <h2>ارتباط با ما</h2>
                        <div class="breadcrumb__option">
                            <a href="../index.php"><i class="fa fa-home"> </i> خانه</a>
                            <a href="#"><i class="fa fa-address-book-o"> </i> ارتباط با ما</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb ختم  -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="fa fa-phone"></span>
                        <h4>تلفن</h4>
                        <p>+93-796-380-650</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="fa fa-map-marker"></span>
                        <h4>آدرس</h4>
                        <p> 315 خیر خانه کابل، افغانستان</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="fa fa-clock-o"></span>
                        <h4>زمان پاسخ دهی</h4>
                        <p>8:00 am to 4:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="fa fa-envelope"></span>
                        <h4>آدرس ایمیل</h4>
                        <p>Admin@ivideo.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map" id="Address">
        <div class="container">
            <!-- موقعیت جغرافیایی -->
            <iframe src="https://www.google.com/maps/@34.5874387,69.124837,45m/data=!3m1!1e3" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            <div class="map-inside">
                <i class="fa fa-map-marker"></i>
                <div class="inside-widget">
                    <h4>کابل</h4>
                    <ul>
                        <li>تلفن : +93796380650</li>
                        <li> 315 خیر خانه کابل، افغانستان</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Map End -->
    <section class="contact_links spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>پیوند های اجتماعی ما </h2>
                    </div>
                </div>

                <div class="contact__chip">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-telegram"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                    <a href="#"><i class="fa fa-yahoo"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- بخش پیام ها -->
    <section class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title section-title">
                        <h2>پیام تان</h2>
                        <p>پیام تان را وارد نموده و دکمه ارسال را فشار دهید.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-group" id="frm-forms" method="post" enctype="multipart/form-data">
                        <label for="subject">موضوع :</label>
                        <input type="text" name="subject" placeholder="موضوع پیام تان را اینجا راود نمائید" class="form-control" id="sabject">
                        <label for="massege">متن پیام :</label>
                        <textarea name="massege" placeholder="متن پیام تان را اینجا وارد نمائید" class="form-control" id="massege"></textarea>
                        <button type="submit" name="submit" class="site-btn btn btn-primary">ارسال پیام</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ختم بخش پیام ها-->
    <?php
    include '../tools/footer.php';   // فایل فوتر
    include '../tools/scripts.php';  // فایل اسکرپت ها
    ?>
</body>

</html>

<?php
$DB_config->close();  // قطع ارتباط با دیتابیس
?>