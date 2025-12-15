<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
include '../tools/session.php'; //  فایل معلوم کننده یوزر وارد شه
$Path =  'Uploud/index.php';  //آدرس صفحه 
?>
<!DOCTYPE html>
<html lang="utf-8">

<head>
    <title>بارگذاری - iVideo</title>
    <?php
    include '../tools/meta.php'; // فایل  مشخصات میتا صفحه
  
    include '../tools/stylesheet.php'; // فایل مشخصات سی اس اس
    // نشان میدهد معلومات در باره یوزر وارد شده 
    // Select Logined User انتخاب یوزر وارد شده از دیتابیس
    $S_L_U = mysqli_query($DB_config,"SELECT * from accounts WHERE `username` = '$_SESSION[username]'");
    // انتخاب نام کاربری که توسط سیزن ارائه شده است 
    $S_L_U_row = mysqli_fetch_assoc($S_L_U); //گرفتن معلومات یوزر از دیتابیس 
    $S_L_U_ID = $S_L_U_row['ID'];              // کاربر id 
    $S_L_U_fname = $S_L_U_row['FirstName'];        // کاربر firstname
    $S_L_U_lname = $S_L_U_row['LastName'];         // کاربر lastname
    $S_L_U_gender = $S_L_U_row['Gender'];          // کاربر gender
    $S_L_U_username = $S_L_U_row['username'];      // کاربر username
    $S_L_U_email = $S_L_U_row['email'];            // کاربر email
    $S_L_U_profile = $S_L_U_row['Profile'];        // کاربر profile
 
    ?>
</head>

<body >
<?php
    include '../tools/header.php'; //   فایل عنوان بالایی و محوطه سمت یابی پیوند ها 
    include '../tools/humberger.php'; // فایل مینویی موبایل 
    include '../tools/hero.php'; // فایل دسته بندی ها، جستجو و تاریخ
    ?>

   <!-- Breadcrumb آغاز -->
    <section class="breadcrumb-section container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>بارگذاری ویدیو </h2>
                        <div class="breadcrumb__option">
                            <a href="../index.php"><i class="fa fa-home"> </i> خانه</a>
                            <a href="#"><i class="fa fa-upload"></i> بارگذاری</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   <!-- Breadcrumb ختم -->

    <!-- forms آغاز بخش  -->
    <section class="forms spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><i class="fa fa-dropbox"> </i>چه نوع ویدیو را میخواهید بارگذاری کنید.
                    </h6>
                </div>
            </div>
            <div class="forms__form">
                <div class="col-lg-8 col-md-6">
                    <h4>نوعیت ویدیوی تان را انتخاب کنید</h4>
                    
                        <div class="row">
                            <div class="forms__input kind">
                                <p>نوعیت<span>*</span></p>
               <a href="upload_Song.php" class="btn btn-primary"><i class="fa fa-music"> </i> آهنگ </a>
               <a href="upload_education.php" class="btn btn-primary"><i class="fa fa-mortar-board"> </i> آموزش</a>
               <a href="upload_entertainment.php" class="btn btn-primary">  <i class="fa fa-film"> </i> سرگرمی</a>
               <a href="upload_news.php" class="btn btn-primary">  <i class="fa fa-newspaper-o"> </i> اخبار</a>
                            </div>
                            
                        </div>
                    
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="forms__all">
                        <h4>داشته های ما ...</h4>
                        <div class="forms__all__things">
                            <h3>ویدیو ها</h3>
                            <ul>
                                <li>آهنگ ها
                                    <?php
                                    $S_Song = mysqli_query($DB_config,  "SELECT * FROM videos WHERE (`Kind` = 'آهنگ')");
                                    $All_Songs = mysqli_num_rows($S_Song);  // تعداد روی آهنگ ها را حساب میکند
                                    ?>
                                    <span><?= $All_Songs ?></span></li>
                                <li>آموزش
                                    <?php
                                    $S_Education = mysqli_query($DB_config, "SELECT * FROM videos WHERE (`Kind` = 'آموزش')");
                                    $All_Educaton = mysqli_num_rows($S_Education);    // تعداد روی آموزش ها را حساب میکند
                                    ?>
                                    <span><?= $All_Educaton ?></span></li>
                                <li>سرگرمی
                                    <?php
                                    $S_Entertainment = mysqli_query($DB_config, "SELECT * FROM videos WHERE (`Kind` = 'سرگرمی')");
                                    $All_Entertainmen = mysqli_num_rows($S_Entertainment);   // تعداد روی سرگرمی ها را حساب میکند
                                    ?>
                                    <span><?= $All_Entertainmen ?></span></li>
                                    <li>اخبار
                                    <?php
                                    $S_News = mysqli_query($DB_config, "SELECT * FROM videos WHERE (`Kind` = 'اخبار')");
                                    $All_News = mysqli_num_rows($S_News);    // تعداد روی اخبار را حساب میکند
                                    ?>
                                    <span><?= $All_News ?></span></li>
                            </ul>
                            <div class="forms__total">تمام ویدیو ها 
                                <span><?php echo $All_Songs + $All_Educaton + $All_Entertainmen + $All_News ; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- forms ختم بخش  -->
    <?php
    include '../tools/footer.php'; // فایل فوتر 
    include '../tools/scripts.php'; // فایل اسکرپت ها 
    ?>
</body>
</html>
<?php
$DB_config->close(); // قطع ارتباط با دیتابیس 
?>