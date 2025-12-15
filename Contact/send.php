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

    <!-- بخش پیام ها -->
    <section class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title section-title">
                        <h2>پیام تان</h2>
                        <p>جزییات پیام شما قرار ذیل است</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-group" id="frm-forms" method="post" enctype="multipart/form-data">
                        <label for="subject">موضوع :</label>
                        <input type="text" name="subject" value=<?=$_COOKIE['subject']?> class="form-control" id="sabject" disabled>
                        <label for="massege">متن پیام :</label>
                        <textarea name="massege"  value=<?=$_COOKIE['massege']?> class="form-control" id="massege" disabled></textarea>
                    
                        <?php
                            $subject = $_COOKIE['subject']; //موضوع پیام را میگیرد
                            $massege = $_COOKIE['massege']; //متن پیام را میگیرد
                                $q = "INSERT INTO `contact_us`(`ID`, `Author`, `Subject`, `Massege`) VALUES ('', '$S_L_U_username' ,'$subject','$massege')"; // پیام وارد شده را در دیتابیس ،در جدول کانتکت از ثبت میشود
                                if (mysqli_query($DB_config, $q)) { //اگر پیام در جدول ثبت شد این پراگراف را نمایش میدهد
                                    echo '<p class="alert alert-success">' . $S_L_U_fname . ' ' . $S_L_U_lname . ' عزیز <br/> تشکر از پیام تان ، پیام تان بزودی بررسی خواهد شد.</p>';
                        
                                }?>
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