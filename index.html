<?php
include 'tools/DB_config.php'; //   فایل ارتباط با دیتابیس
$Path =  'index.php';  //آدرس صفحه 
?>
<!DOCTYPE html> <!-- HTML 5 -->
<html lang="utf-8">
<!-- Start of HTML -->

<head>
    <title>خانه - iVideo</title> <!-- Title of the page-->
    <?php
    include 'tools/meta.php'; // فایل  مشخصات میتا صفحه
    include 'tools/stylesheet.php'; // فایل مشخصات سی اس اس
    include 'tools/userproperty.php'; // فایل مشخصات یوزر وارد شده
    ?>
</head>

<body class="bg-light">
    <!-- body with bootsrap color-->
    <?php
    include 'tools/header.php'; //   فایل عنوان بالایی و محوطه سمت یابی پیوند ها 
    include 'tools/humberger.php'; // فایل مینویی موبایل 
    include 'tools/hero.php'; // فایل دسته بندی ها، جستجو و تاریخ
    ?>


    <!--آغز بخش بهترین ویدیو -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <?php // Select Most Liked انتخاب ویدیوی که بیشترین لایک داشته باشد
                $S_M_Liked = mysqli_query($DB_config, "SELECT `postid`,COUNT(postid) from like_unlike where type='1' group by postid having count(postid) >= 2 ORDER BY Rand() limit 1 ");
                if ($S_M_Liked_row = mysqli_fetch_array($S_M_Liked)) {
                    $S_M_Liked_ID = $S_M_Liked_row['postid'];
                    // Select Most Liked Video 
                    $S_M_L_Video = mysqli_query($DB_config, "SELECT * from videos where `ID`='$S_M_Liked_ID'");
                    if ($S_M_L_Video_row = mysqli_fetch_array($S_M_L_Video)) {
                        $S_M_L_V_ID = $S_M_L_Video_row['ID'];
                        $S_M_L_V_Name = $S_M_L_Video_row['Name'];
                        $S_M_L_V_Title = $S_M_L_Video_row['Title'];
                        $S_M_L_V_Author = $S_M_L_Video_row['Author'];
                        $S_M_L_V_Subject = $S_M_L_Video_row['Subject'];
                        $S_M_L_V_Kind = $S_M_L_Video_row['Kind'];
                        $S_M_L_V_Owner = $S_M_L_Video_row['Owner'];
                        $S_M_L_V_Video = 'DB/' . $S_M_L_V_Kind . '/' . $S_M_L_V_Subject . '/' . $S_M_L_V_Author . '/' . $S_M_L_V_Name;
                        // Select Video Owner
                        $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `id`=$S_M_L_V_Owner");
                        $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                        $Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";

                        ?>
                        <div class="hero__item row">
                            <div class="col-lg-8">
                                <video autoplay muted class="img-thumbnail rounded ">
                                    <source src='<?= $S_M_L_V_Video ?>' type='video/mp4' />
                                </video>
                            </div>
                            <div class="col-lg-4">
                                <div class="hero__text rounded img-thumbnail">
                                    <span>بهترین ها</span>
                                    <h2><?= $S_M_L_V_Author ?> <br /><?= $S_M_L_V_Title ?></h2>
                                    <p> اضافه شده توسط <?= $Owner_Name ?></p>
                                    <a href="player/index.php?id=<?= $S_M_L_V_ID ?>#player" class="site-btn badge-primary">تماشا کن</a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <?php // Select Most Liked انتخاب ویدیوی که بیشترین لایک داشته باشد
                    $S_M_Liked =  mysqli_query($DB_config, "SELECT `postid`,COUNT(postid) from like_unlike where type='1' group by postid having count(postid) >= 2 ORDER BY Rand() limit 20 ");
                    while ($S_M_Liked_row = mysqli_fetch_array($S_M_Liked)) {
                        $S_M_Liked_ID = $S_M_Liked_row['postid'];
                        //Select Most Liked Video 
                        $S_M_L_Video = mysqli_query($DB_config, "SELECT * from videos where `ID`= $S_M_Liked_ID ");
                        if ($S_M_L_Video_row = mysqli_fetch_array($S_M_L_Video)) {
                            $S_M_L_V_ID = $S_M_L_Video_row['ID'];
                            $S_M_L_V_Name = $S_M_L_Video_row['Name'];
                            $S_M_L_V_Title = $S_M_L_Video_row['Title'];
                            $S_M_L_V_Author = $S_M_L_Video_row['Author'];
                            $S_M_L_V_Subject = $S_M_L_Video_row['Subject'];
                            $S_M_L_V_Kind = $S_M_L_Video_row['Kind'];
                            $S_M_L_V_Owner = $S_M_L_Video_row['Owner'];
                            $S_M_L_V_Thumbnail = 'DB/' . $S_M_L_V_Kind . '/' . $S_M_L_V_Subject . '/' . $S_M_L_V_Author . '/' . $S_M_L_V_Name . '.jpg';
                            ?>
                            <div class="col-lg-3">
                                <div class="categories__item ">
                                    <a href="player/index.php?id=<?= $S_M_L_V_ID ?>#player">
                                        <img src="<?= $S_M_L_V_Thumbnail ?>" class="img-thumbnail">
                                        <h5><?= $S_M_L_V_Title ?><br><i><?= $S_M_L_V_Author ?></i></h5>
                                    </a>
                                </div>
                            </div>
                    <?php }
                    } ?>

                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- trending Section Begin -->
    <section class="trending spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title trending__title">
                        <h2>ویدیو های مرسوم </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                // Select Trendings
                $S_T = mysqli_query($DB_config, "SELECT * FROM `trending` Where `Watched`>'10' ORDER BY rand() limit 12 ");
                while ($S_T_row = mysqli_fetch_array($S_T)) {
                    $S_T_ID = $S_T_row['Video_id'];
                    // Select trending videos
                    $S_T_Videos = mysqli_query($DB_config, "SELECT * from videos WHERE id = $S_T_ID ");
                    while ($S_T_Videos_row = mysqli_fetch_array($S_T_Videos)) {
                        $S_T_V_ID = $S_T_Videos_row['ID'];
                        $S_T_V_Name = $S_T_Videos_row['Name'];
                        $S_T_V_Title = $S_T_Videos_row['Title'];
                        $S_T_V_Author = $S_T_Videos_row['Author'];
                        $S_T_V_Subject = $S_T_Videos_row['Subject'];
                        $S_T_V_Kind = $S_T_Videos_row['Kind'];
                        $S_T_V_Owner = $S_T_Videos_row['Owner'];
                        $S_T_V_Thumbnail = 'DB/' . $S_T_V_Kind . '/' . $S_T_V_Subject . '/' . $S_T_V_Author . '/' . $S_T_V_Name . '.jpg';
                        ?>
                        <div class="col-lg-3 col-md-4 col-sm-10">
                            <div class="trending__item jumbotron">
                                <div class="trending__item__pic">
                                    <img src='<?= $S_T_V_Thumbnail ?>' class='img-thumbnail' />
                                </div>
                                <div class="trending__item__text">
                                    <h5><?= $S_T_V_Title ?></h5>
                                    <p><?= $S_T_V_Author ?></p>
                                    <a href="Player/index.php?id=<?= $S_T_V_ID ?>#player" class="btn watch_btn">تماشا</a>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        </div>
    </section>
    <!-- trending Section End -->
    <!-- simple list Section Begin -->
    <section class="simple-list spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h4>آهنگ ها</h4>
                    <div class="simple-list__slider owl-carousel">
                        <div class="simple-list__slider__item">
                            <?php // Slect Songs 1
                            $S_S = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آهنگ') ORDER BY Rand() limit 4 ");
                            while ($S_S_row = mysqli_fetch_array($S_S)) {
                                $S_S_ID = $S_S_row['ID'];
                                $S_S_Name = $S_S_row['Name'];
                                $S_S_Title = $S_S_row['Title'];
                                $S_S_Author = $S_S_row['Author'];
                                $S_S_Subject = $S_S_row['Subject'];
                                $S_S_Kind = $S_S_row['Kind'];
                                $S_S_Owner = $S_S_row['Owner'];
                                $S_S_Thumbnail = 'DB/' . $S_S_Kind . '/' . $S_S_Subject . '/' . $S_S_Author . '/' . $S_S_Name . '.jpg';

                                ?>
                                <a href="player/index.php?id=<?= $S_S_ID ?>#player" class="simple-list__item border border-primary">
                                    <div class="simple-list__item__pic">
                                        <img src='<?= $S_S_Thumbnail ?>' class='img-thumbnail' />
                                    </div>
                                    <div class="simple-list__item__text">
                                        <h6><?= $S_S_Title ?></h6>
                                        <span><?= $S_S_Author ?></span>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="simple-list__slider__item">
                            <?php // Select Songs 2
                            $S_S = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آهنگ') ORDER BY Rand() limit 4 ");
                            while ($S_S_row = mysqli_fetch_array($S_S)) {
                                $S_S_ID = $S_S_row['ID'];
                                $S_S_Name = $S_S_row['Name'];
                                $S_S_Title = $S_S_row['Title'];
                                $S_S_Author = $S_S_row['Author'];
                                $S_S_Subject = $S_S_row['Subject'];
                                $S_S_Kind = $S_S_row['Kind'];
                                $S_S_Owner = $S_S_row['Owner'];
                                $S_S_Thumbnail = 'DB/' . $S_S_Kind . '/' . $S_S_Subject . '/' . $S_S_Author . '/' . $S_S_Name . '.jpg';

                                ?>
                                <a href="player/index.php?id=<?= $S_S_ID ?>#player" class="simple-list__item border border-primary">
                                    <div class="simple-list__item__pic">
                                        <img src='<?= $S_S_Thumbnail ?>' class='img-thumbnail' />
                                    </div>
                                    <div class="simple-list__item__text">
                                        <h6><?= $S_S_Title ?></h6>
                                        <span><?= $S_S_Author ?></span>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4>آموزش ها</h4>
                    <div class="simple-list__slider owl-carousel">
                        <div class="simple-list__slider__item">
                            <?php // Select Educations 1
                            $S_E = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آموزش') ORDER BY Rand() limit 4 ");
                            while ($S_E_row = mysqli_fetch_array($S_E)) {
                                $S_E_ID = $S_E_row['ID'];
                                $S_E_Name = $S_E_row['Name'];
                                $S_E_Title = $S_E_row['Title'];
                                $S_E_Author = $S_E_row['Author'];
                                $S_E_Subject = $S_E_row['Subject'];
                                $S_E_Kind = $S_E_row['Kind'];
                                $S_E_Owner = $S_E_row['Owner'];
                                $S_E_Thumbnail = 'DB/' . $S_E_Kind . '/' . $S_E_Subject . '/' . $S_E_Author . '/' . $S_E_Name . '.jpg';

                                ?>
                                <a href="player/index.php?id=<?= $S_E_ID ?>#player" class="simple-list__item border border-primary">
                                    <div class="simple-list__item__pic">
                                        <img src='<?= $S_E_Thumbnail ?>' class='img-thumbnail' />
                                    </div>
                                    <div class="simple-list__item__text">
                                        <h6><?= $S_E_Title ?></h6>
                                        <span><?= $S_E_Author ?></span>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="simple-list__slider__item">
                            <?php // Select Educations 2
                            $S_E = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آموزش') ORDER BY Rand() limit 4 ");
                            while ($S_E_row = mysqli_fetch_array($S_E)) {
                                $S_E_ID = $S_E_row['ID'];
                                $S_E_Name = $S_E_row['Name'];
                                $S_E_Title = $S_E_row['Title'];
                                $S_E_Author = $S_E_row['Author'];
                                $S_E_Subject = $S_E_row['Subject'];
                                $S_E_Kind = $S_E_row['Kind'];
                                $S_E_Owner = $S_E_row['Owner'];
                                $S_E_Thumbnail = 'DB/' . $S_E_Kind . '/' . $S_E_Subject . '/' . $S_E_Author . '/' . $S_E_Name . '.jpg';

                                ?>
                                <a href="player/index.php?id=<?= $S_E_ID ?>#player" class="simple-list__item border border-primary">
                                    <div class="simple-list__item__pic">
                                        <img src='<?= $S_E_Thumbnail ?>' class='img-thumbnail' />
                                    </div>
                                    <div class="simple-list__item__text">
                                        <h6><?= $S_E_Title ?></h6>
                                        <span><?= $S_E_Author ?></span>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4>سرگرمی ها</h4>
                    <div class="simple-list__slider owl-carousel">
                        <div class="simple-list__slider__item">
                            <?php // Select Entertainment 1
                            $S_En = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'سرگرمی') ORDER BY Rand() limit 4 ");
                            while ($S_En_row = mysqli_fetch_array($S_En)) {
                                $S_En_ID = $S_En_row['ID'];
                                $S_En_Name = $S_En_row['Name'];
                                $S_En_Title = $S_En_row['Title'];
                                $S_En_Author = $S_En_row['Author'];
                                $S_En_Subject = $S_En_row['Subject'];
                                $S_En_Kind = $S_En_row['Kind'];
                                $S_En_Owner = $S_En_row['Owner'];
                                $S_En_Thumbnail = 'DB/' . $S_En_Kind . '/' . $S_En_Subject . '/' . $S_En_Author . '/' . $S_En_Name . '.jpg';

                                ?>
                                <a href="player/index.php?id=<?= $S_En_ID ?>#player" class="simple-list__item border border-primary">
                                    <div class="simple-list__item__pic">
                                        <img src='<?= $S_En_Thumbnail ?>' class='img-thumbnail' />
                                    </div>
                                    <div class="simple-list__item__text">
                                        <h6><?= $S_En_Title ?></h6>
                                        <span><?= $S_En_Author ?></span>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="simple-list__slider__item">
                            <?php // Select Entertainment 2
                            $S_En = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'سرگرمی') ORDER BY Rand() limit 4 ");
                            while ($S_En_row = mysqli_fetch_array($S_En)) {
                                $S_En_ID = $S_En_row['ID'];
                                $S_En_Name = $S_En_row['Name'];
                                $S_En_Title = $S_En_row['Title'];
                                $S_En_Author = $S_En_row['Author'];
                                $S_En_Subject = $S_En_row['Subject'];
                                $S_En_Kind = $S_En_row['Kind'];
                                $S_En_Owner = $S_En_row['Owner'];
                                $S_En_Thumbnail = 'DB/' . $S_En_Kind . '/' . $S_En_Subject . '/' . $S_En_Author . '/' . $S_En_Name . '.jpg';

                                ?>
                                <a href="player/index.php?id=<?= $S_En_ID ?>#player" class="simple-list__item border border-primary">
                                    <div class="simple-list__item__pic">
                                        <img src='<?= $S_En_Thumbnail ?>' class='img-thumbnail' />
                                    </div>
                                    <div class="simple-list__item__text">
                                        <h6><?= $S_En_Title ?></h6>
                                        <span><?= $S_En_Author ?></span>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4>اخبار</h4>
                    <div class="simple-list__slider owl-carousel">
                        <div class="simple-list__slider__item">
                            <?php // Select News 1
                            $S_N = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'اخبار') ORDER BY Rand() limit 4 ");
                            while ($S_N_row = mysqli_fetch_array($S_N)) {
                                $S_N_ID = $S_N_row['ID'];
                                $S_N_Name = $S_N_row['Name'];
                                $S_N_Title = $S_N_row['Title'];
                                $S_N_Author = $S_N_row['Author'];
                                $S_N_Subject = $S_N_row['Subject'];
                                $S_N_Kind = $S_N_row['Kind'];
                                $S_N_Owner = $S_N_row['Owner'];
                                $S_N_Thumbnail = 'DB/' . $S_N_Kind . '/' . $S_N_Subject . '/' . $S_N_Author . '/' . $S_N_Name . '.jpg';

                                ?>
                                <a href="player/index.php?id=<?= $S_N_ID ?>#player" class="simple-list__item border border-primary">
                                    <div class="simple-list__item__pic">
                                        <img src='<?= $S_N_Thumbnail ?>' class='img-thumbnail' />
                                    </div>
                                    <div class="simple-list__item__text">
                                        <h6><?= $S_N_Title ?></h6>
                                        <span><?= $S_N_Author ?></span>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="simple-list__slider__item">
                            <?php // Select News 2
                            $S_N = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'اخبار') ORDER BY Rand() limit 4 ");
                            while ($S_N_row = mysqli_fetch_array($S_N)) {
                                $S_N_ID = $S_N_row['ID'];
                                $S_N_Name = $S_N_row['Name'];
                                $S_N_Title = $S_N_row['Title'];
                                $S_N_Author = $S_N_row['Author'];
                                $S_N_Subject = $S_N_row['Subject'];
                                $S_N_Kind = $S_N_row['Kind'];
                                $S_N_Owner = $S_N_row['Owner'];
                                $S_N_Thumbnail = 'DB/' . $S_N_Kind . '/' . $S_N_Subject . '/' . $S_N_Author . '/' . $S_N_Name . '.jpg';

                                ?>
                                <a href="player/index.php?id=<?= $S_N_ID ?>#player" class="simple-list__item border border-primary">
                                    <div class="simple-list__item__pic">
                                        <img src='<?= $S_N_Thumbnail ?>' class='img-thumbnail' />
                                    </div>
                                    <div class="simple-list__item__text">
                                        <h6><?= $S_N_Title ?></h6>
                                        <span><?= $S_N_Author ?></span>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->
    <!-- Banner Begin -->
    <div class="banner spad">
        <div class="container">
            <div class="section-title">
                <h2>باز پخش</h2>
            </div>
            <div class="row">

                <?php
                $result = mysqli_query($DB_config, "SELECT * from videos ORDER BY Rand() limit 3 ");
                while ($row = mysqli_fetch_array($result)) {
                    $id = $row['ID'];
                    $name = $row['Name'];
                    $Title = $row['Title'];
                    $Author = $row['Author'];
                    $subject = $row['Subject'];
                    $kind = $row['Kind'];
                    $owner = $row['Owner'];
                    $thumbnail = 'DB/' . $kind . '/' . $subject . '/' . $Author . '/' . $name;

                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <div class="card">
                            <a href="player/index.php?id=<?= $id ?>#player">
                                <video autoplay muted class="img-thumbnail card-img-top">
                                    <source src='<?= $thumbnail ?>' type='video/mp4' />
                                </video>
                                <div class="card-body text-center">
                                    <h4 class="card-title"><?= $Title ?></h4>
                                    <p class="card-text"><?= $Author ?></p>
                            </a>
                        </div>

                    </div>
            </div>
        <?php } ?>
        </div>
    </div>
    </div>
    <!-- Banner End -->
    <div class="container">
        <div class="jumbotron text-center">
            <h1>ویدیوی من</h1>
            <p>روزت را بساز، افراد واقعی، ویدیوهای واقعی</p>
        </div>
    </div>
    <?php
    include 'tools/footer.php'; // فایل فوتر 
    include 'tools/scripts.php'; // فایل اسکرپت ها 
    ?>
</body>

</html>
<?php
$DB_config->close(); // قطع ارتباط با دیتابیس 
?>