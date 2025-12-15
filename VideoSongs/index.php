<!-- 
    نمایه آهنگ ها  
    خانه / VideoSong / 
-->
<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
$Path =  'VideoSongs/index.php';  //آدرس صفحه 
?>
<!DOCTYPE html> <!-- HTML 5 -->
<html lang="utf-8">
<!-- آغاز HTML -->

<head>
    <!--  Head آغاز-->
    <title>آهنگ ها - iVideo</title> <!-- عنوان صحفه -->
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
                        <h2>آهنگ های ویدویی</h2>
                        <div class="breadcrumb__option">
                            <a href="../index.php"><i class="fa fa-home"> </i> خانه</a>
                            <a href="#"><i class="fa fa-mortar-board"> </i> آهنگ ها</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- Breadcrumb ختم  -->
    <!-- آغاز آهنگ های مرسوم  -->
    <section class="trending spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>آهنگ های مرسوم</h2> <!-- عنوان آهنگ های مرسوم -->
                    </div>
                </div>
            </div>
            <div class="row trending__filter">
                <?php
                // Select Trending Songs انتخاب آهنگ های مرسوم
                $S_T_S = mysqli_query($DB_config, "SELECT * FROM `trending` WHERE (`Kind` = 'آهنگ') ORDER BY `Timestamp` desc limit 8 ");
                while ($S_T_S_row = mysqli_fetch_array($S_T_S)) { // While data of Select Trending Songs 
                    $S_T_S_Video_ID = $S_T_S_row['Video_id']; // ای دی ویدیو های مرسوم در جدول مرسوم ها
                    // Select Trending Songs From Videos Table انتخاب آهنگ های مرسوم در جدول ویدیو ها 
                    $S_T_S_from_Videos = mysqli_query($DB_config, "SELECT * from videos WHERE (`ID` = " . $S_T_S_Video_ID . ")");
                    while ($S_T_S_row = mysqli_fetch_array($S_T_S_from_Videos)) { // While data of Select Trending Songs From Video Table
                        $S_T_S_ID = $S_T_S_row['ID']; // ای دی ویدیو های مرسوم در جدول ویدیو ها 
                        $S_T_S_Name = $S_T_S_row['Name']; // نام فایل ویدیو های مرسوم در جدول ویدیو ها
                        $S_T_S_Title = $S_T_S_row['Title']; //عنوان ویدیو های مرسوم در جدول ویدیو ها
                        $S_T_S_Author = $S_T_S_row['Author']; // تدریس کننده ویدیو های مرسوم در جدول ویدیو ها
                        $S_T_S_Subject = $S_T_S_row['Subject']; // موضوع ویدیو های مرسوم در جدول ویدیو ها
                        $S_T_S_Kind = $S_T_S_row['Kind']; // نوعیت ویدیو های مرسوم در جدول ویدیو ها 
                        $S_T_S_Thumbnail = "../DB/$S_T_S_Kind/$S_T_S_Subject/$S_T_S_Author/$S_T_S_Name.jpg"; // تصویر ویدیو های مرسوم در جدول ویدیو ها
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-10">
                            <!-- Bootstrap Columns -->
                            <div class="trending__item jumbotron rounded">
                                <div class="trending__item__pic ">
                                    <img src="<?= $S_T_S_Thumbnail ?>" class='img-thumbnail' /> <!-- تصویر ویدیو -->
                                </div>
                                <div class="trending__item__text">
                                    <h6><?= $S_T_S_Title ?></h6>
                                    <span><?= $S_T_S_Author ?></span>
                                    <a href="../player/index.php?id=<?= $S_T_S_ID  ?>#player" class="btn watch_btn">تماشا</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }  // Select Trending Songs From Video Table While Ends
                } // Select Trending Songs While Ends
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
                                // Select Authors Of Song انتخاب تدریس کننده های ویدیو های آهنگی
                                $S_A_E = mysqli_query($DB_config, "SELECT DISTINCT(Author) As Author from videos WHERE (`Kind` = 'آهنگ') order by Author");
                                while ($S_A_E_row = mysqli_fetch_array($S_A_E)) {
                                    $S_A_E_Author = $S_A_E_row['Author']; // تدریس کننده گان 
                                    ?>
                                    <li>
                                        <!-- List The Song Authors -->
                                        <a href="../Search/search.php?search=<?= $S_A_E_Author ?>">
                                            <i class="fa fa-user"> </i>
                                            <?= $S_A_E_Author ?>
                                        </a>
                                    </li>
                                <?php } // Select Authors Of Song While End 
                                ?>
                            </ul>
                        </div> <!-- ختم بخش دسته بندی -->
                        <div class="sidebar__item">
                            <!-- آغار بخش آخرین ویدیو ها -->
                            <div class="simple-list__text ">
                                <h4>آخرین ویدیوها</h4> <!-- عنوان بخش آخرین ویدیو ها -->
                                <div class="simple-list__slider owl-carousel ">
                                    <!-- آغاز بخش Slider -->
                                    <div class="simple-list__slider__item">
                                        <!-- Slider اولی -->
                                        <?php
                                        // Select Latest Songs انتخاب آخرین آهنگ ها 
                                        $S_L_S = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آهنگ') ORDER BY `Timestamp` desc limit 5 ");
                                        while ($S_L_S_row = mysqli_fetch_array($S_L_S)) {
                                            $S_L_S_ID = $S_L_S_row['ID'];  // آی دی آخرین آهنگ ها 
                                            $S_L_S_Name = $S_L_S_row['Name'];  //  نام ویدیو آخرین آهنگ ها
                                            $S_L_S_Title = $S_L_S_row['Title'];  // عنوان آخرین آهنگ ها
                                            $S_L_S_Author = $S_L_S_row['Author'];  //  تدریس کننده آخرین آهنگ ها
                                            $S_L_S_Subject = $S_L_S_row['Subject'];  //   موضوع آخرین آهنگ ها
                                            $S_L_S_Owner = $S_L_S_row['Owner'];  //  صاحب آخرین آهنگ ها
                                            $S_L_S_Kind = $S_L_S_row['Kind'];  //   نوعیت آخرین آهنگ ها
                                            $S_L_S_Thumbnail = "../DB/$S_L_S_Kind/$S_L_S_Subject/$S_L_S_Author/$S_L_S_Name.jpg";  //  تصویر آخرین آهنگ ها
                                            $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_L_S_Owner");
                                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                                            $S_F_S_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
                                            ?>
                                            <a href="../player/index.php?id=<?= $S_L_S_ID ?>#player" class="simple-list__item border border-primary">
                                                <div class="simple-list__item__pic">
                                                    <img src="<?= $S_L_S_Thumbnail ?>" class='img-thumbnail' />
                                                </div>
                                                <div class="simple-list__item__text">

                                                    <span><?= $S_L_S_Title ?></span>
                                                    <h6><?= $S_L_S_Author ?></h6>
                                                    <p class="text-muted"> <?= $S_F_S_Owner_Name ?></p>
                                                </div>
                                            </a>
                                        <?php
                                        } // Select Latest Songs While End
                                        ?>
                                    </div>
                                    <!-- آغاز بخش Slider -->
                                    <div class="simple-list__slider__item">
                                        <!-- Slider اولی -->
                                        <?php
                                        // Select Latest Songs انتخاب آخرین آهنگ ها 
                                        $S_L_S = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آهنگ') ORDER BY `Timestamp` desc limit 5 OFFSET 5 ");
                                        while ($S_L_S_row = mysqli_fetch_array($S_L_S)) {
                                            $S_L_S_ID = $S_L_S_row['ID'];  // آی دی آخرین آهنگ ها 
                                            $S_L_S_Name = $S_L_S_row['Name'];  //  نام ویدیو آخرین آهنگ ها
                                            $S_L_S_Title = $S_L_S_row['Title'];  // عنوان آخرین آهنگ ها
                                            $S_L_S_Author = $S_L_S_row['Author'];  //  تدریس کننده آخرین آهنگ ها
                                            $S_L_S_Subject = $S_L_S_row['Subject'];  //   موضوع آخرین آهنگ ها
                                            $S_L_S_Owner = $S_L_S_row['Owner'];  //  صاحب آخرین آهنگ ها
                                            $S_L_S_Kind = $S_L_S_row['Kind'];  //   نوعیت آخرین آهنگ ها
                                            $S_L_S_Thumbnail = "../DB/$S_L_S_Kind/$S_L_S_Subject/$S_L_S_Author/$S_L_S_Name.jpg";  //  تصویر آخرین آهنگ ها
                                            $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_L_S_Owner");
                                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                                            $S_F_S_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
                                            ?>
                                            <a href="../player/index.php?id=<?= $S_L_S_ID ?>#player" class="simple-list__item border border-primary">
                                                <div class="simple-list__item__pic">
                                                    <img src="<?= $S_L_S_Thumbnail ?>" class='img-thumbnail' />
                                                </div>
                                                <div class="simple-list__item__text">

                                                    <span><?= $S_L_S_Title ?></span>
                                                    <h6><?= $S_L_S_Author ?></h6>
                                                    <p class="text-muted"> <?= $S_F_S_Owner_Name ?></p>
                                                </div>
                                            </a>
                                        <?php
                                        } // Select Latest Songs While End
                                        ?>
                                    </div>
                                    <!-- آغاز بخش Slider -->
                                    <div class="simple-list__slider__item">
                                        <!-- Slider اولی -->
                                        <?php
                                        // Select Latest Songs انتخاب آخرین آهنگ ها 
                                        $S_L_S = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آهنگ') ORDER BY `Timestamp` desc limit 5 OFFSET 10 ");
                                        while ($S_L_S_row = mysqli_fetch_array($S_L_S)) {
                                            $S_L_S_ID = $S_L_S_row['ID'];  // آی دی آخرین آهنگ ها 
                                            $S_L_S_Name = $S_L_S_row['Name'];  //  نام ویدیو آخرین آهنگ ها
                                            $S_L_S_Title = $S_L_S_row['Title'];  // عنوان آخرین آهنگ ها
                                            $S_L_S_Author = $S_L_S_row['Author'];  //  تدریس کننده آخرین آهنگ ها
                                            $S_L_S_Subject = $S_L_S_row['Subject'];  //   موضوع آخرین آهنگ ها
                                            $S_L_S_Owner = $S_L_S_row['Owner'];  //  صاحب آخرین آهنگ ها
                                            $S_L_S_Kind = $S_L_S_row['Kind'];  //   نوعیت آخرین آهنگ ها
                                            $S_L_S_Thumbnail = "../DB/$S_L_S_Kind/$S_L_S_Subject/$S_L_S_Author/$S_L_S_Name.jpg";  //  تصویر آخرین آهنگ ها

                    
                                            $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_L_S_Owner");
                                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                                            $S_F_S_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]"; ?>
                                            <a href="../player/index.php?id=<?= $S_L_S_ID ?>#player" class="simple-list__item border border-primary">
                                                <div class="simple-list__item__pic">
                                                    <img src="<?= $S_L_S_Thumbnail ?>" class='img-thumbnail' />
                                                </div>
                                                <div class="simple-list__item__text">

                                                    <span><?= $S_L_S_Title ?></span>
                                                    <h6><?= $S_L_S_Author ?></h6>
                                                    <p class="text-muted"> <?= $S_F_S_Owner_Name ?></p>
                                                </div>
                                            </a>
                                        <?php
                                        } // Select Latest Songs While End
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
                                // Select Best Song انتخاب بهترین آهنگ ها 
                                $S_B_S = mysqli_query($DB_config, "SELECT * from `like_unlike`WHERE (`type` = '1') order by `timestamp` desc limit 18");
                                while ($S_B_S_row = mysqli_fetch_array($S_B_S)) {
                                    $S_B_S_id = $S_B_S_row['postid'];
                                    // Select Best Song From Videos Table انتخاب بهترین آهنگ ها از جدول ویدیو ها 
                                    $S_B_S_Items = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آهنگ') and  (`ID` =" . $S_B_S_id . ")  ");
                                    while ($S_B_S_Items_row = mysqli_fetch_array($S_B_S_Items)) {
                                        $S_B_S_Items_ID = $S_B_S_Items_row['ID']; //  آی دی بهترین آهنگ ها
                                        $S_B_S_Items_Name = $S_B_S_Items_row['Name']; //  نام فایل بهترین آهنگ ها
                                        $S_B_S_Items_Title = $S_B_S_Items_row['Title']; //  عنوان بهترین آهنگ ها
                                        $S_B_S_Items_Author = $S_B_S_Items_row['Author']; //  تدریس کننده بهترین آهنگ ها
                                        $S_B_S_Items_Subject = $S_B_S_Items_row['Subject']; //  موضوع بهترین آهنگ ها
                                        $S_B_S_Items_Kind = $S_B_S_Items_row['Kind']; //  نوعیت بهترین آهنگ ها
                                        $S_B_S_Items_Tumbnail = "../DB/$S_B_S_Items_Kind/$S_B_S_Items_Subject/$S_B_S_Items_Author/$S_B_S_Items_Name.jpg"; // تصویر بهترین آهنگ ها
                                        ?>
                                        <div class="col-lg-4 ">
                                            <!-- Bootstrap Columns -->
                                            <a href="../player/index.php?id=<?= $S_B_S_Items_ID  ?>#player">
                                                <div class="all_videos__item card">
                                                    <!-- Bootstrap Card -->
                                                    <div class="all_videos__item__pic card-img-top">
                                                        <img src="<?= $S_B_S_Items_Tumbnail ?>" class='img-thumbnail' />
                                                    </div>
                                                    <div class="all_videos__item__text card-body">
                                                        <h5 class="card-title"><?= $S_B_S_Items_Title ?></h5>
                                                        <p class="card-text"><?= $S_B_S_Items_Author  ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                <?php }   // Select Best Song From Videos Table While End
                                } // Select Best Song While End
                                ?>
                            </div>
                        </div> <!-- ختم بخش بهترین ویدیو ها -->
                    </div>
                    <div class="filter__item">
                        <!-- آغاز بخش عنوان بهترین ویدیو ها  -->
                        <div class="section-title">
                            <h2>تمام آهنگ ها</h2><!-- عنوان بهترین ویدیو ها  -->
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
                                    <?php // Select All Of Song In Database انتخاب تمام آهنگ ها در دیتابیس 
                                    $S_Owner_S_V = mysqli_query($DB_config, "SELECT ID from videos WHERE (`Kind` = 'آهنگ')");
                                    $S_Owner_S_V_Result = mysqli_num_rows($S_Owner_S_V); // تعداد آنوزش ها 
                                    ?>
                                    <span class="badge badge-dark"><?= $S_Owner_S_V_Result ?> </span>
                                    <h6> تعداد آهنگ ها</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__text">
                                    <span> بخاطریکه هیچگاه زنده گی آهنگ را متوقف نمیکند.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        // عدد ویدیو ها برای نمایش اولیه 
                        $video_per_page = 18;
                        // حساب تمام آهنگ ها در دیتابیس 
                        $S_F_S  = mysqli_query($DB_config, "SELECT count(*) as allcount FROM videos WHERE (`Kind` = 'آهنگ')");
                        $S_F_S_fetch = mysqli_fetch_array($S_F_S);
                        $S_F_S_allcount =  $S_F_S_fetch['allcount'];
                        // Select First 18 Songs انتخاب ویدیو اولیه  
                        $S_F_S = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آهنگ') order by Rand() limit 0,$video_per_page ");
                        while ($S_F_S_row = mysqli_fetch_array($S_F_S)) {
                            $S_F_S_ID = $S_F_S_row['ID'];  //  آی دی ویدیو اولیه
                            $S_F_S_Name = $S_F_S_row['Name'];  //  نام فایل ویدیو اولیه
                            $S_F_S_Title = $S_F_S_row['Title'];  //  عنوان ویدیو اولیه
                            $S_F_S_Author = $S_F_S_row['Author'];  //  تدریس کننده ویدیو اولیه
                            $S_F_S_Subject = $S_F_S_row['Subject'];  //  موضوع ویدیو اولیه
                            $S_F_S_Owner = $S_F_S_row['Owner']; // صاحب ویدیو اولیه
                            $S_F_S_Kind = $S_F_S_row['Kind']; // نوعیت ویدیو اولیه
                            $S_F_S_Tumbnail = "../DB/$S_F_S_Kind/$S_F_S_Subject/$S_F_S_Author/$S_F_S_Name.jpg";  //  تصویر آخرین آهنگ ها
                            $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_F_S_Owner");
                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                            $S_F_S_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-6 videosdiv" id="post_<?= $S_F_S_ID ?>">
                                <figure class="figure all_videos__item bg-light">
                                    <!-- Bootstrap Figure -->
                                    <a href="../player/index.php?id=<?= $S_F_S_ID  ?>#player">
                                        <div class="all_videos__item__pic">
                                            <img src="<?= $S_F_S_Tumbnail ?>" class="figure-img img-thumbnail rounded" />
                                        </div>
                                        <figcaption class="figure-caption all_videos__item__text">
                                            <h5><?= $S_F_S_Title ?></h5>
                                            <h6><?= $S_F_S_Author ?></h6>
                                            <p><?= $S_F_S_Owner_Name ?></p>
                                        </figcaption>
                                    </a>
                                </figure>
                            </div>
                        <?php } // Select First 18 Songs While Ends 
                        ?>
                        <div class="col-lg-12 ">
                            <!-- Bootstrap Columns -->
                            <div class="all_videos__pagination text-center">
                                <!-- بخش دکمه ویدیوهای بیشتر  -->
                                <span class="load-more btn btn-primary">بیشتر...</span>
                                <input type="hidden" id="row" value="0"> <!-- مشخص کننده آغاز نمایش ویدیو ها   -->
                                <input type="hidden" id="all" value="<?= $S_F_S_allcount ?>"> <!-- مشخص کننده تعداد تمام ویدیو ها  -->
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