<?php
include '../tools/DB_config.php';  //   فایل ارتباط با دیتابیس
include '../tools/session.php';  //  فایل معلوم کننده یوزر وارد شه
?>
<!DOCTYPE html> <!-- HTML 5 -->
<html lang="utf-8">
<!-- آغاز HTML -->

<head>
    <title>مدیریت - iVideo</title> <!-- عنوان صفحه -->
    <?php
    include '../tools/meta.php';    // فایل  مشخصات میتا صفحه
    include '../tools/stylesheet.php';  // فایل مشخصات سی اس اس
   // نشان میدهد معلومات در باره یوزر وارد شده 
    // Select Logined User انتخاب یوزر وارد شده از دیتابیس
    if (isset($_SESSION['username'])){
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
    }
    ?>
</head> <!--  ختم عنوان  -->

<body>
    <!-- آغاز بدنه -->
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
                        <!-- صفحه باز بوده ره مشخص میکند  -->
                        <h2>مدیریت</h2>
                        <div class="breadcrumb__option">
                            <a href="../index.php"><i class="fa fa-home"> </i> خانه</a>
                            <a href="#"><i class="fa fa-mortar-board"> </i> مدیریت</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- Breadcrumb ختم  -->
    <section class="admin spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <!-- Bootstrap Columns -->
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <!-- آغاز نواز کناری -->
                            <ul class="btn-block">
                                <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> مدیریت
                                    </a></li>
                                <li><a href="activity.php"><i class="fa fa-feed"></i> فعالیت ها </a>
                                </li>
                                <li><a href="message.php"><i class="fa fa-envelope"></i> پیام ها </a></li>
                                <li><a href="logs/iVideo.com-access.log"><i class="fa fa-exchange"></i> لاگ های دسترسی </a></li>
                                <li><a href="logs/iVideo.com-error.log"><i class="fa fa-exchange"></i> لاگ های خطا </a></li>
                            </ul>
                            <ul class="btn-block">
                                <li><a href="accounts.php"><i class="fa fa-user-circle-o"></i> کاربران </a></li>
                                <li><a class="collapse" data-toggle="collapse" href="#togglePages"><i class="fa fa-film"> </i>
                                        ویدیو ها </a>
                                        <ul id="togglePages" class="collapse">
                                        <li><a href="videoeducations.php"><i class="fa fa-mortar-board"></i>آموزش ها </a></li>
                                        <li><a href="videosongs.php"><i class="fa fa-music"></i>آهنگ ها </a></li>
                                        <li><a href="videoentertainment.php"><i class="fa fa-film"></i>سرگرمی ها </a></li>
                                        <li><a href="videonews.php"><i class="fa fa-newspaper-o"></i>خبر ها </a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="btn-block">
                                <li><a href="http://localhost/phpmyadmin/db_structure.php?server=1&db=ivideo_db"><i class="fa fa-table"></i>دیتابیس </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <!-- Bootstrap Columns -->
                    <div class="simple-info">
                        <!-- آغاز بخش بهترین ویدیو ها  -->
                        <div class="section-title ">
                            <h2>گذارشات</h2> <!-- عنوان بهترین ویدیو ها  -->
                        </div>
                        <div class="btn-block large-btn">
                        <?php $C_T_V = mysqli_query($DB_config, "SELECT COUNT(*) AS allvideos FROM videos");
                            $C_T_V_row = mysqli_fetch_array($C_T_V);
                            $C_T_V_Total_Videos = $C_T_V_row['allvideos'];
                         ?>
                           <a href="allvideos.php"> <button class="btn btn-light"><i class="fa fa-film"></i><b><?=$C_T_V_Total_Videos?> </b>
                                <p class="text-muted"> ویدیوها</p>
                            </button></a>
                            <?php $C_T_U = mysqli_query($DB_config, "SELECT COUNT(*) AS allusers FROM `accounts`");
                            $C_T_U_row = mysqli_fetch_array($C_T_U);
                            $C_T_U_Total_Users = $C_T_U_row['allusers'];
                         ?>
                            <a href="accounts.php"><button class="btn btn-light"><i class="fa fa-user-circle-o"></i><b><?= $C_T_U_Total_Users?></b>
                                <p class="text-muted">کاربران</p>
                            </button></a>
                            <?php $C_T_M = mysqli_query($DB_config, "SELECT COUNT(*) AS allmasseges FROM `contact_us`");
                            $C_T_M_row = mysqli_fetch_array($C_T_M);
                            $C_T_M_Total_Masseges = $C_T_M_row['allmasseges'];
                         ?>
                            <a href="message.php"><button class="btn btn-light"><i class="fa fa-envelope"></i><b><?=$C_T_M_Total_Masseges?></b>
                                <p class="text-muted">پیام ها</p>
                            </button></a>
                        </div>
                        <div class="btn-block small-btn">
                            <div class="col-lg-6">
                                <div class="row">
                                <?php $C_T_L = mysqli_query($DB_config, "SELECT COUNT(type) AS alllikes FROM `like_unlike` where `type` = 1");
                            $C_T_L_row = mysqli_fetch_array($C_T_L);
                            $C_T_L_Total_Likes = $C_T_L_row['alllikes'];
                         ?>
                                    <a href="#" class="btn btn-light"><i class="fa fa-thumbs-up"></i><b>پسندیده شده ها</b><p > <?=$C_T_L_Total_Likes?></p></a>
                                    <?php $C_T_UL = mysqli_query($DB_config, "SELECT COUNT(*) AS allunlikes FROM `like_unlike` where `type` = 0");
                            $C_T_UL_row = mysqli_fetch_array($C_T_UL);
                            $C_T_UL_Total_UNLikes = $C_T_UL_row['allunlikes'];
                         ?>   
                                    <a href="#" class="btn btn-light"><i class="fa fa-thumbs-down"></i><b>نا پسندیده شده ها</b><p> <?=$C_T_UL_Total_UNLikes?></p></a>
                                
                                </div>
                                <div class="row">
                                <?php $C_T_C = mysqli_query($DB_config, "SELECT COUNT(*) AS allcomments FROM `comments`");
                            $C_T_C_row = mysqli_fetch_array($C_T_C);
                            $C_T_C_Total_Comments = $C_T_C_row['allcomments'];
                         ?> 
                                    <a href="#" class="btn btn-light"><i class="fa fa-commenting"></i><b>پر بحث ها </b><p> <?=$C_T_C_Total_Comments?></p></a>
                                    <?php $C_T_T = mysqli_query($DB_config, "SELECT COUNT(*) AS alltrends FROM `trending`");
                            $C_T_T_row = mysqli_fetch_array($C_T_T);
                            $C_T_T_Total_Trends = $C_T_T_row['alltrends'];
                         ?>  
                                    <a href="#" class="btn btn-light"><i class="fa fa-fire"></i><b>مرسوم ها</b><p> <?=$C_T_T_Total_Trends?></p></a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ul class="video-progress">
                            <?php
                            $C_T_Songs = mysqli_query($DB_config, "SELECT COUNT(*) AS allsongs FROM `videos` where `kind` = 'آهنگ' ");
                            $C_T_Songs_row = mysqli_fetch_array($C_T_Songs);
                            $C_T_Songs_Total = $C_T_Songs_row['allsongs'];
                         
                            $C_T_Educations = mysqli_query($DB_config, "SELECT COUNT(*) AS alleducations FROM `videos` where `kind` = 'آموزش' ");
                            $C_T_Educations_row = mysqli_fetch_array($C_T_Educations);
                            $C_T_Educations_Total = $C_T_Educations_row['alleducations'];
                        
                            $C_T_Entartaninments = mysqli_query($DB_config, "SELECT COUNT(*) AS allentartainments FROM `videos` where `kind` = 'سرگرمی' ");
                            $C_T_Entartaninments_row = mysqli_fetch_array($C_T_Entartaninments);
                            $C_T_Entartaninments_Total = $C_T_Entartaninments_row['allentartainments'];
                
                            $C_T_News = mysqli_query($DB_config, "SELECT COUNT(*) AS allnews FROM `videos` where `kind` = 'اخبار' ");
                            $C_T_News_row = mysqli_fetch_array($C_T_News);
                            $C_T_News_Total = $C_T_News_row['allnews'];
                         ?>   
                                    <li>
                                        <p><strong>آموزش ها</strong> <span class=" pull-left muted badge badge-success"><?=$C_T_Educations_Total?></span></p>
                                        <progress  style="width: 90%;"class="progress" value="<?=$C_T_Educations_Total?>" max="<?=$C_T_V_Total_Videos?>"></progress>
                                    </li>
                                    <li>
                                        <p><strong>آهنگ ها</strong> <span class="pull-left  muted badge badge-primary"><?=$C_T_Songs_Total?></span></p>
                                        <progress style="width: 90%;"class="progress" value="<?=$C_T_Songs_Total?>" max="<?=$C_T_V_Total_Videos?>"> </progress>
                                    </li>
                                    <li>
                                        <p><strong>سرگرمی ها</strong> <span class="pull-left  muted badge badge-secondary"><?=$C_T_Entartaninments_Total?></span></p>
                                        <progress  style="width: 90%;"class="progress" value="<?=$C_T_Entartaninments_Total?>" max="<?=$C_T_V_Total_Videos?>"></progress>
                                    </li>
                                    <li>
                                   
                                        <p><strong>خبر ها</strong> <span class="pull-left muted badge badge-danger"><?=$C_T_News_Total?></span></p>
                                        <progress  style="width: 90%;"class="progress" value="<?=$C_T_News_Total?>" max="<?=$C_T_V_Total_Videos?>"></progress>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.content-->
            </div>
            <!--/.span9-->
        </div>
</section>
        <?php
        include '../tools/footer.php';   // فایل فوتر
        include '../tools/scripts.php';  // فایل اسکرپت ها
        ?>
</body>

</html>
<?php
$DB_config->close();  // قطع ارتباط با دیتابیس
?>