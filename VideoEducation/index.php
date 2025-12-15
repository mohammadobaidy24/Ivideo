<!-- 
    نمایه آموزش ها  
    خانه / VideoEducation / 
-->
<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
$Path =  'VideoEducation/index.php';  //آدرس صفحه 
?>
<!DOCTYPE html> <!-- HTML 5 -->
<html lang="utf-8">
<!-- آغاز HTML -->

<head>
    <!--  Head آغاز-->
    <title>آموزش ها - iVideo</title> <!-- عنوان صحفه -->
    <?php
    include '../tools/meta.php'; // فایل  مشخصات میتا صفحه
    include '../tools/stylesheet.php'; // فایل مشخصات سی اس اس
    include '../tools/userproperty.php'; // فایل مشخصات یوزر وارد شده
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
                        <h2>ویدیو های آموزشی</h2>
                        <div class="breadcrumb__option">
                            <a href="../index.php"><i class="fa fa-home"> </i> خانه</a>
                            <a href="#"><i class="fa fa-mortar-board"> </i> آموزش</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- Breadcrumb ختم  -->
    <!-- آغاز آموزش های مرسوم  -->
    <section class="trending spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>آموزش های مرسوم</h2> <!-- عنوان آموزش های مرسوم -->
                    </div>
                </div>
            </div>
            <div class="row trending__filter">
                <?php
                // Select Trending Educations انتخاب آموزش های مرسوم
                $S_T_E = mysqli_query($DB_config, "SELECT * FROM `trending` WHERE (`Kind` = 'آموزش') ORDER BY `Timestamp` desc limit 8 ");
                while ($S_T_E_row = mysqli_fetch_array($S_T_E)) { // While data of Select Trending Educations 
                    $S_T_E_Video_ID = $S_T_E_row['Video_id']; // ای دی ویدیو های مرسوم در جدول مرسوم ها
                    // Select Trending Educations From Videos Table انتخاب آموزش های مرسوم در جدول ویدیو ها 
                    $S_T_E_from_Videos = mysqli_query($DB_config, "SELECT * from videos WHERE (`ID` = " . $S_T_E_Video_ID . ")");
                    while ($S_T_E_row = mysqli_fetch_array($S_T_E_from_Videos)) { // While data of Select Trending Educations From Video Table
                        $S_T_E_ID = $S_T_E_row['ID']; // ای دی ویدیو های مرسوم در جدول ویدیو ها 
                        $S_T_E_Name = $S_T_E_row['Name']; // نام فایل ویدیو های مرسوم در جدول ویدیو ها
                        $S_T_E_Title = $S_T_E_row['Title']; //عنوان ویدیو های مرسوم در جدول ویدیو ها
                        $S_T_E_Author = $S_T_E_row['Author']; // تدریس کننده ویدیو های مرسوم در جدول ویدیو ها
                        $S_T_E_Subject = $S_T_E_row['Subject']; // موضوع ویدیو های مرسوم در جدول ویدیو ها
                        $S_T_E_Kind = $S_T_E_row['Kind']; // نوعیت ویدیو های مرسوم در جدول ویدیو ها 
                        $S_T_E_Thumbnail = "../DB/$S_T_E_Kind/$S_T_E_Subject/$S_T_E_Author/$S_T_E_Name.jpg"; // تصویر ویدیو های مرسوم در جدول ویدیو ها
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-10">
                            <!-- Bootstrap Columns -->
                            <div class="trending__item jumbotron rounded">
                                <div class="trending__item__pic ">
                                    <img src="<?= $S_T_E_Thumbnail ?>" class='img-thumbnail' /> <!-- تصویر ویدیو -->
                                </div>
                                <div class="trending__item__text">
                                    <h6><?= $S_T_E_Title ?></h6>
                                    <span><?= $S_T_E_Author ?></span>
                                    <a href="../player/index.php?id=<?= $S_T_E_ID  ?>#player" class="btn watch_btn">تماشا</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }  // Select Trending Educations From Video Table While Ends
                } // Select Trending Educations While Ends
                ?>
            </div> <!-- row Ends -->
        </div> <!-- Container Ends -->
    </section> <!-- Trending Section End -->
    <!-- آغاز بخش تمام ویدیو ها  -->
    <section class="all_videos spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <!-- Bootstrap Columns -->
                    <div class="sidebar">
                        <!-- آغاز نواز کناری -->
                        <div class="sidebar__item">
                            <!-- آغاز بخش دسته بندی -->
                            <h4>دسته بندی</h4>
                            <ul class="list">
                                <?php
                                // Select Authors Of Education انتخاب تدریس کننده های ویدیو های آموزشی
                                $S_A_E = mysqli_query($DB_config, "SELECT DISTINCT(Author) As Author from videos WHERE (`Kind` = 'آموزش') order by Author");
                                while ($S_A_E_row = mysqli_fetch_array($S_A_E)) {
                                    $S_A_E_Author = $S_A_E_row['Author']; // تدریس کننده گان 
                                    ?>
                                    <li>
                                        <!-- List The Education Authors -->
                                        <a href="../Search/search.php?search=<?= $S_A_E_Author ?>">
                                            <i class="fa fa-book"> </i>
                                            <?= $S_A_E_Author ?>
                                        </a>
                                    </li>
                                <?php } // Select Authors Of Education While End 
                                ?>
                            </ul>
                        </div> <!-- ختم بخش دسته بندی -->
                        <div class="sidebar__item">
                            <!-- آغار بخش آخرین ویدیو ها -->
                            <div class="simple-list__text">
                                <h4>آخرین ویدیوها</h4> <!-- عنوان بخش آخرین ویدیو ها -->
                                <div class="simple-list__slider owl-carousel ">
                                    <!-- آغاز بخش Slider -->
                                    <div class="simple-list__slider__item">
                                        <!-- Slider اولی -->
                                        <?php
                                        // Select Latest Educations انتخاب آخرین آموزش ها 
                                        $S_L_E = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آموزش') ORDER BY `Timestamp` desc limit 5 ");
                                        while ($S_L_E_row = mysqli_fetch_array($S_L_E)) {
                                            $S_L_E_ID = $S_L_E_row['ID'];  // آی دی آخرین آموزش ها 
                                            $S_L_E_Name = $S_L_E_row['Name'];  //  نام ویدیو آخرین آموزش ها
                                            $S_L_E_Title = $S_L_E_row['Title'];  // عنوان آخرین آموزش ها
                                            $S_L_E_Author = $S_L_E_row['Author'];  //  تدریس کننده آخرین آموزش ها
                                            $S_L_E_Subject = $S_L_E_row['Subject'];  //   موضوع آخرین آموزش ها
                                            $S_L_E_Owner = $S_L_E_row['Owner'];  //  صاحب آخرین آموزش ها
                                            $S_L_E_Kind = $S_L_E_row['Kind'];  //   نوعیت آخرین آموزش ها
                                            $S_L_E_Thumbnail = "../DB/$S_L_E_Kind/$S_L_E_Subject/$S_L_E_Author/$S_L_E_Name.jpg";  //  تصویر آخرین آموزش ها
                                            $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_L_E_Owner");
                                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                                            $S_L_E_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
                                            ?>
                                            <a href="../player/index.php?id=<?= $S_L_E_ID ?>#player" class="simple-list__item border border-primary">
                                                <div class="simple-list__item__pic">
                                                    <img src="<?= $S_L_E_Thumbnail ?>" class='img-thumbnail' />
                                                </div>
                                                <div class="simple-list__item__text">

                                                    <span><?= $S_L_E_Title ?></span>
                                                    <h6><?= $S_L_E_Author ?></h6>
                                                    <p class="text-muted"> <?= $S_L_E_Owner_Name ?></p>
                                                </div>
                                            </a>
                                        <?php
                                        } // Select Latest Educations While End
                                        ?>
                                    </div>
                                    <!-- آغاز بخش Slider -->
                                    <div class="simple-list__slider__item">
                                        <!-- Slider اولی -->
                                        <?php
                                        // Select Latest Educations انتخاب آخرین آموزش ها 
                                        $S_L_E = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آموزش') ORDER BY `Timestamp` desc limit 5 offset 5");
                                        while ($S_L_E_row = mysqli_fetch_array($S_L_E)) {
                                            $S_L_E_ID = $S_L_E_row['ID'];  // آی دی آخرین آموزش ها 
                                            $S_L_E_Name = $S_L_E_row['Name'];  //  نام ویدیو آخرین آموزش ها
                                            $S_L_E_Title = $S_L_E_row['Title'];  // عنوان آخرین آموزش ها
                                            $S_L_E_Author = $S_L_E_row['Author'];  //  تدریس کننده آخرین آموزش ها
                                            $S_L_E_Subject = $S_L_E_row['Subject'];  //   موضوع آخرین آموزش ها
                                            $S_L_E_Owner = $S_L_E_row['Owner'];  //  صاحب آخرین آموزش ها
                                            $S_L_E_Kind = $S_L_E_row['Kind'];  //   نوعیت آخرین آموزش ها
                                            $S_L_E_Thumbnail = "../DB/$S_L_E_Kind/$S_L_E_Subject/$S_L_E_Author/$S_L_E_Name.jpg";  //  تصویر آخرین آموزش ها
                                            $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_L_E_Owner");
                                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                                            $S_L_E_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
                                            ?>
                                            <a href="../player/index.php?id=<?= $S_L_E_ID ?>#player" class="simple-list__item border border-primary">
                                                <div class="simple-list__item__pic">
                                                    <img src="<?= $S_L_E_Thumbnail ?>" class='img-thumbnail' />
                                                </div>
                                                <div class="simple-list__item__text">

                                                    <span><?= $S_L_E_Title ?></span>
                                                    <h6><?= $S_L_E_Author ?></h6>
                                                    <p class="text-muted"> <?= $S_L_E_Owner_Name ?></p>
                                                </div>
                                            </a>
                                        <?php
                                        } // Select Latest Educations While End
                                        ?>
                                    </div>
                                    <!-- آغاز بخش Slider -->
                                    <div class="simple-list__slider__item">
                                        <!-- Slider اولی -->
                                        <?php
                                        // Select Latest Educations انتخاب آخرین آموزش ها 
                                        $S_L_E = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آموزش') ORDER BY `Timestamp` desc limit 5 offset 10");
                                        while ($S_L_E_row = mysqli_fetch_array($S_L_E)) {
                                            $S_L_E_ID = $S_L_E_row['ID'];  // آی دی آخرین آموزش ها 
                                            $S_L_E_Name = $S_L_E_row['Name'];  //  نام ویدیو آخرین آموزش ها
                                            $S_L_E_Title = $S_L_E_row['Title'];  // عنوان آخرین آموزش ها
                                            $S_L_E_Author = $S_L_E_row['Author'];  //  تدریس کننده آخرین آموزش ها
                                            $S_L_E_Subject = $S_L_E_row['Subject'];  //   موضوع آخرین آموزش ها
                                            $S_L_E_Owner = $S_L_E_row['Owner'];  //  صاحب آخرین آموزش ها
                                            $S_L_E_Kind = $S_L_E_row['Kind'];  //   نوعیت آخرین آموزش ها
                                            $S_L_E_Thumbnail = "../DB/$S_L_E_Kind/$S_L_E_Subject/$S_L_E_Author/$S_L_E_Name.jpg";  //  تصویر آخرین آموزش ها
                                            $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_L_E_Owner");
                                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                                            $S_L_E_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
                                            ?>
                                            <a href="../player/index.php?id=<?= $S_L_E_ID ?>#player" class="simple-list__item border border-primary">
                                                <div class="simple-list__item__pic">
                                                    <img src="<?= $S_L_E_Thumbnail ?>" class='img-thumbnail' />
                                                </div>
                                                <div class="simple-list__item__text">

                                                    <span><?= $S_L_E_Title ?></span>
                                                    <h6><?= $S_L_E_Author ?></h6>
                                                    <p class="text-muted"> <?= $S_L_E_Owner_Name ?></p>
                                                </div>
                                            </a>
                                        <?php
                                        } // Select Latest Educations While End
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- ختم بخش آخرین ویدیو ها -->
                    </div>
                </div>
                <!-- آغاز بخش تمام ویدیو ها -->
                <div class="col-lg-9 col-md-7">
                    <!-- Bootstrap Columns -->
                    <div class="all_videos__section">
                        <!-- آغاز بخش بهترین ویدیو ها  -->
                        <div class="section-title all_videos__title">
                            <h2>بهترین ها</h2> <!-- عنوان بهترین ویدیو ها  -->
                        </div>
                        <div class="row">
                            <div class="all_videos__slider owl-carousel">
                                <?php
                                // Select Best Education انتخاب بهترین آموزش ها 
                                $S_B_E = mysqli_query($DB_config, "SELECT * from `like_unlike`WHERE (`type` = '1') order by `timestamp` desc limit 18");
                                while ($S_B_E_row = mysqli_fetch_array($S_B_E)) {
                                    $S_B_E_id = $S_B_E_row['postid'];
                                    // Select Best Education From Videos Table انتخاب بهترین آموزش ها از جدول ویدیو ها 
                                    $S_B_E_Items = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آموزش') and  (`ID` =" . $S_B_E_id . ")  ");
                                    while ($S_B_E_Items_row = mysqli_fetch_array($S_B_E_Items)) {
                                        $S_B_E_Items_ID = $S_B_E_Items_row['ID']; //  آی دی بهترین آموزش ها
                                        $S_B_E_Items_Name = $S_B_E_Items_row['Name']; //  نام فایل بهترین آموزش ها
                                        $S_B_E_Items_Title = $S_B_E_Items_row['Title']; //  عنوان بهترین آموزش ها
                                        $S_B_E_Items_Author = $S_B_E_Items_row['Author']; //  تدریس کننده بهترین آموزش ها
                                        $S_B_E_Items_Subject = $S_B_E_Items_row['Subject']; //  موضوع بهترین آموزش ها
                                        $S_B_E_Items_Kind = $S_B_E_Items_row['Kind']; //  نوعیت بهترین آموزش ها
                                        $S_B_E_Items_Tumbnail = "../DB/$S_B_E_Items_Kind/$S_B_E_Items_Subject/$S_B_E_Items_Author/$S_B_E_Items_Name.jpg"; // تصویر بهترین آموزش ها
                                        ?>
                                        <div class="col-lg-4 ">
                                            <!-- Bootstrap Columns -->
                                            <a href="../player/index.php?id=<?= $S_B_E_Items_ID  ?>#player">
                                                <div class="all_videos__item card">
                                                    <!-- Bootstrap Card -->
                                                    <div class="all_videos__item__pic card-img-top">
                                                        <img src="<?= $S_B_E_Items_Tumbnail ?>" class='img-thumbnail' />
                                                    </div>
                                                    <div class="all_videos__item__text card-body">
                                                        <h5 class="card-title"><?= $S_B_E_Items_Title ?></h5>
                                                        <p class="card-text"><?= $S_B_E_Items_Author  ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                <?php }   // Select Best Education From Videos Table While End
                                } // Select Best Education While End
                                ?>
                            </div>
                        </div> <!-- ختم بخش بهترین ویدیو ها -->
                    </div>
                    <div class="filter__item">
                        <!-- آغاز بخش عنوان بهترین ویدیو ها  -->
                        <div class="section-title">
                            <h2>تمام آموزش ها</h2><!-- عنوان بهترین ویدیو ها  -->
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <!-- Bootstrap Columns -->
                                <div class="filter__text">
                                    <span>هیچگاه آموختن را فراموش نکن،</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <?php // Select All Of Education In Database انتخاب تمام آموزش ها در دیتابیس 
                                    $S_A_E_V = mysqli_query($DB_config, "SELECT ID from videos WHERE (`Kind` = 'آموزش')");
                                    $S_A_E_V_Result = mysqli_num_rows($S_A_E_V); // تعداد آنوزش ها 
                                    ?>
                                    <span class="badge badge-dark"><?= $S_A_E_V_Result ?> </span>
                                    <h6> تعداد آموزش ها</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__text">
                                    <span> بخاطریکه هیچگاه زنده گی آموزش را متوقف نمیکند.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        // عدد ویدیو ها برای نمایش اولیه 
                        $video_per_page = 18;
                        // حساب تمام آموزش ها در دیتابیس 
                        $C_T_E  = mysqli_query($DB_config, "SELECT count(*) as allcount FROM videos WHERE (`Kind` = 'آموزش')");
                        $C_T_E_fetch = mysqli_fetch_array($C_T_E);
                        $C_T_E_allcount =  $C_T_E_fetch['allcount'];
                        // Select First 18 Educations انتخاب ویدیو اولیه  
                        $S_F_E = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آموزش') order by Rand() limit 0,$video_per_page ");
                        while ($S_F_E_row = mysqli_fetch_array($S_F_E)) {
                            $S_F_E_ID = $S_F_E_row['ID'];  //  آی دی ویدیو اولیه
                            $S_F_E_Name = $S_F_E_row['Name'];  //  نام فایل ویدیو اولیه
                            $S_F_E_Title = $S_F_E_row['Title'];  //  عنوان ویدیو اولیه
                            $S_F_E_Author = $S_F_E_row['Author'];  //  تدریس کننده ویدیو اولیه
                            $S_F_E_Subject = $S_F_E_row['Subject'];  //  موضوع ویدیو اولیه
                            $S_F_E_Owner = $S_F_E_row['Owner']; // صاحب ویدیو اولیه
                            $S_F_E_Kind = $S_F_E_row['Kind']; // نوعیت ویدیو اولیه
                            $S_F_E_Tumbnail  =  "../DB/$S_F_E_Kind/$S_F_E_Subject/$S_F_E_Author/$S_F_E_Name.jpg "; // تصویر ویدیو اولیه

                            $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_F_E_Owner");
                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                            $S_F_E_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-6 videosdiv" id="post_<?= $S_F_E_ID ?>">
                                <figure class="figure all_videos__item bg-light">
                                    <!-- Bootstrap Figure -->
                                    <a href="../player/index.php?id=<?= $S_F_E_ID  ?>#player">
                                        <div class="all_videos__item__pic">
                                            <img src="<?= $S_F_E_Tumbnail ?>" class="figure-img img-thumbnail rounded" />
                                        </div>
                                        <figcaption class="figure-caption all_videos__item__text">
                                            <h5><?= $S_F_E_Title ?></h5>
                                            <h6><?= $S_F_E_Author ?></h6>
                                            <p><?= $S_F_E_Owner_Name ?></p>
                                        </figcaption>
                                    </a>
                                </figure>
                            </div>
                        <?php } // Select First 18 Educations While Ends 
                        ?>
                        <div class="col-lg-12 ">
                            <!-- Bootstrap Columns -->
                            <div class="all_videos__pagination text-center">
                                <!-- بخش دکمه ویدیوهای بیشتر  -->
                                <span class="load-more btn btn-primary">بیشتر...</span>
                                <input type="hidden" id="row" value="0"> <!-- مشخص کننده آغاز نمایش ویدیو ها   -->
                                <input type="hidden" id="all" value="<?= $C_T_E_allcount ?>"> <!-- مشخص کننده تعداد تمام ویدیو ها  -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- all_videos Section End -->
    <?php
    include '../tools/footer.php'; // فایل فوتر 
    include '../tools/scripts.php'; // فایل اسکرپت ها 
    ?>
    <script src="script.js"></script> <!-- اسکرپت ویدیو های بیشتر  -->
</body>

</html>
<?php
$DB_config->close(); // قطع ارتباط با دیتابیس 
?>