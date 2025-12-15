<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
include '../tools/session.php'; //  فایل معلوم کننده یوزر وارد شه
?>
<!DOCTYPE html>
<html lang="utf-8">

<head>
    <title>نمایه - iVideo</title>
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

<body>
    <?php
    include '../tools/header.php'; //   فایل عنوان بالایی و محوطه سمت یابی پیوند ها 
    include '../tools/humberger.php'; // فایل مینویی موبایل 
    include '../tools/hero.php'; // فایل دسته بندی ها، جستجو و تاریخ
    ?>
    <?php
    if (isset($_GET['un'])) {  // اگر یوزر نیم پوست شده موجود بود 
        $un = $_GET['un'];
        $query_this_accounts = mysqli_query($DB_config, "SELECT * from accounts where username = '$un'");  // انتخاب یوزر از جدول حساب ها جای که یوزر نیم مساوی به یوزر نیم پوست شده است
        if ($accounts_row = mysqli_fetch_assoc($query_this_accounts)) {
            $userid = $accounts_row['ID'];
            $fname = $accounts_row['FirstName'];
            $lname = $accounts_row['LastName'];
            $gender = $accounts_row['Gender'];
            $username = $accounts_row['username'];
            $email = $accounts_row['email'];
            $profile = $accounts_row['Profile'];
            ?>
            <!-- آغاز بخش نمایه -->
            <div class="profile container">
                <section class="card text-center">
                    <div class="card-img-top">
                        <img src="../DB/Users/<?= $profile ?>" class="img-thumbnail rounded-circle" />
                    </div>
                    <div class="card-header">
                        <h1><?= $fname ?> <?= $lname ?></h1>
                    </div>
                    <div class="card-body">
                        <h3><?= $username ?> <i class="fa fa-user"></i> </h3>
                        <p><?= $email ?> <i class="fa fa-envelope"></i></p>
                    </div>
                </section>
            </div>
            <!-- ختم بخش نمایه -->
            <section class="simple-list spad">
                <div class="container">
                    <div class="section-title">
                        <h2> فعالیت ها </h2>
                    </div>
                    <div class="row">
                        <!-- شروع یخش لایک ها -->
                        <div class="col-lg-4 ">
                            <?php  //Select Likes انتخاب لایک ها توسط یوزر 
                                    $S_L = mysqli_query($DB_config, "SELECT * from like_unlike  WHERE  (`type` = '1') And (`userid` = " . $userid . ")order by `timestamp` desc limit 4 ");
                                    if (mysqli_num_rows($S_L) > 0) {  // اگر تعداد رو ها بزرگتر از صفر بود 
                                        ?>
                                <div class="">
                                    <h4>ویدیو های پسندیده</h4>
                                    <div class="simple-list__slider__item">
                                        <?php
                                                    while ($S_L_row = mysqli_fetch_array($S_L)) {  // حلقه ویدیو های پسندیده شده 
                                                        $all_Like_id = $S_L_row['postid'];
                                                        // Select Liked Videos انتخاب ویدیوی لایک شده از جدول ویدیو ها 
                                                        $S_L_V = mysqli_query($DB_config, "SELECT * from videos WHERE (`ID` = " . $all_Like_id . ")");
                                                        if ($S_L_V_rows = mysqli_fetch_array($S_L_V)) {
                                                            $S_L_V_ID = $S_L_V_rows['ID'];
                                                            $S_L_V_Name = $S_L_V_rows['Name'];
                                                            $S_L_V_Title = $S_L_V_rows['Title'];
                                                            $S_L_V_Author = $S_L_V_rows['Author'];
                                                            $S_L_V_Subject = $S_L_V_rows['Subject'];
                                                            $S_L_V_Kind = $S_L_V_rows['Kind'];
                                                            $S_L_V_Owner = $S_L_V_rows['Owner'];
                                                            $S_L_V_Thumbnail = "../DB/$S_L_V_Kind/$S_L_V_Subject/$S_L_V_Author/$S_L_V_Name.jpg";
                                                            ?>
                                                <a href="../player/index.php?id=<?= $S_L_V_ID ?>#player" class="simple-list__item border border-primary">
                                                    <div class="simple-list__item__pic">
                                                        <img src='<?= $S_L_V_Thumbnail ?>' class='img-thumbnail' />
                                                    </div>
                                                    <div class="simple-list__item__text">
                                                        <h6><?= $S_L_V_Title ?></h6>
                                                        <span><?= $S_L_V_Author ?></span>
                                                    </div>
                                                </a>
                                        <?php }
                                                    } ?>
                                    </div>
                                </div>
                            <?php } else {  //  اگر ویدیوی پسندیده نشده بود     
                                        ?>
                                <div class="">
                                    <h4>ویدیو های پسندیده</h4>
                                    <div class="simple-list__slider__item">
                                        <div class="simple-list__item__text">
                                            <h4>هیچ ویدیوی پسندیده نشده است</h6>
                                                <span>ویدیوی های را که پسندیده اید در اینجا نمایان میشوند.</span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- ختم بخش لایک ها -->
                        <!-- آغاز بخش نظریه ها -->
                        <div class="col-lg-4 ">
                            <?php // Select Comments انتخاب کمنت های داده شده توسط یوزر
                                    $S_C = mysqli_query($DB_config, "SELECT * from `comments`  WHERE  `userid`='$userid' order by `post_time` desc limit 4");
                                    if (mysqli_num_rows($S_C) > 0) { // اگر کمنتی موجود بود    
                                        ?>
                                <div class="">
                                    <h4>آخرین نظر ها </h4>
                                    <div class="simple-list__slider__item">
                                        <?php
                                                    while ($S_C_row = mysqli_fetch_array($S_C)) { // حلقه کمنت ها داده شده 
                                                        $S_C_Video_ID = $S_C_row['postid'];
                                                        $S_C_Comment = $S_C_row['comment'];
                                                        $S_C_Time = $S_C_row['post_time'];
                                                        //Select Commented Video انتخاب ویدیوی کمنت داده شده
                                                        $S_C_V = mysqli_query($DB_config, "SELECT * from `videos` where `ID`='$S_C_Video_ID'");
                                                        if ($S_C_V_row = mysqli_fetch_array($S_C_V)) {
                                                            $S_C_V_ID = $S_C_V_row['ID'];
                                                            $S_C_V_Name = $S_C_V_row['Name'];
                                                            $S_C_V_Title = $S_C_V_row['Title'];
                                                            $S_C_V_Author = $S_C_V_row['Author'];
                                                            $S_C_V_Subject = $S_C_V_row['Subject'];
                                                            $S_C_V_Kind = $S_C_V_row['Kind'];
                                                            $S_C_V_Owner = $S_C_V_row['Owner'];
                                                            $S_C_V_Thumbnail = "../DB/$S_C_V_Kind/$S_C_V_Subject/$S_C_V_Author/$S_C_V_Name.jpg";
                                                            ?>
                                                <a href="../player/index.php?id=<?= $S_C_V_ID ?>#player" class="simple-list__item border border-primary">
                                                    <div class="simple-list__item__pic">
                                                        <img src='<?= $S_C_V_Thumbnail ?>' />
                                                    </div>
                                                    <div class="simple-list__item__text">
                                                        <span><?= $S_C_V_Title ?> از <?= $S_C_V_Author ?></span>
                                                        <h6><i class='fa fa-quote-right '></i><?= $S_C_Comment ?> <i class='fa fa-quote-left '></i> </h6>
                                                        <span><?= $S_C_Time ?></span>
                                                    </div>
                                                </a>
                                        <?php }
                                                    } ?>
                                    </div>
                                </div>
                            <?php } else { // اگر کمنتی موجود نبود    
                                        ?>
                                <div class="">
                                    <h4>آخرین نظر ها</h4>
                                    <div class="simple-list__slider__item">
                                        <div class="simple-list__item__text">
                                            <h4>نظری موجود نیست</h6>
                                                <span>نظر های شما در باره ویدیو ها در اینجا نمایان میشود</span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- ختم بخش کمنت ها  -->
                        <!-- آغاز بخش ان لایک ها -->
                        <div class="col-lg-4 ">
                            <?php  //Select UnLikes انتخاب ان لایک ها توسط یوزر
                                    $S_Un = mysqli_query($DB_config, "SELECT * from `like_unlike`  WHERE  (`type` = '0') And (`userid` = " . $userid . ") ORDER BY `timestamp` desc limit 4 ");
                                    if (mysqli_num_rows($S_Un) > 0) {  // اگر ان لایکی موجود بود   
                                        ?>
                                <div class="">
                                    <h4>ویدیو های پسندیده نا شده</h4>
                                    <div class="simple-list__slider__item">
                                        <?php
                                                    while ($S_Un_row = mysqli_fetch_array($S_Un)) {  // حلقه ان لایک ها 
                                                        $S_Un_ID = $S_Un_row['postid'];
                                                        // Select UnLiked Videos انتخاب ویدیو های ان لایک شده 
                                                        $S_Un_V = mysqli_query($DB_config, "SELECT * from `videos` WHERE (`ID`= " . $S_Un_ID . ") ");
                                                        if ($S_Un_V_rows = mysqli_fetch_array($S_Un_V)) {
                                                            $S_Un_V_ID = $S_Un_V_rows['ID'];
                                                            $S_Un_V_Name = $S_Un_V_rows['Name'];
                                                            $S_Un_V_Title = $S_Un_V_rows['Title'];
                                                            $S_Un_V_Author = $S_Un_V_rows['Author'];
                                                            $S_Un_V_Subject = $S_Un_V_rows['Subject'];
                                                            $S_Un_V_Kind = $S_Un_V_rows['Kind'];
                                                            $S_Un_V_Owner = $S_Un_V_rows['Owner'];
                                                            $S_Un_V_Thumbnail = "../DB/$S_Un_V_Kind/$S_Un_V_Subject/$S_Un_V_Author/$S_Un_V_Name.jpg";
                                                            ?>
                                                <a href="../player/index.php?id=<?= $S_Un_V_ID ?>#player" class="simple-list__item border border-primary">
                                                    <div class="simple-list__item__pic">
                                                        <img src='<?= $S_Un_V_Thumbnail ?>' />
                                                    </div>
                                                    <div class="simple-list__item__text">
                                                        <h6><?= $S_Un_V_Title ?></h6>
                                                        <span><?= $S_Un_V_Author ?></span>
                                                    </div>
                                                </a>
                                        <?php }
                                                    } ?>
                                    </div>
                                </div>
                            <?php } else {   //  اگر ویدیوی ان لایک نشده بود  
                                        ?>
                                <div class="">
                                    <h4>ویدیو های پسندیده نا شده</h4>
                                    <div class="simple-list__slider__item">
                                        <div class="simple-list__item__text">
                                            <h4>هیچ ویدیوی پسندیده نشده</h6>
                                                <span>ویدیوی های را پسندیده اید در اینجا نمایان میشوند.</span>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- آغاز بخش ویدیو های شما -->
            <section class="spad ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="filter__found" id="YourVideos">
                                <?php  // Select All Songs   انتخاب تمام آهنگ ها 
                                        $S_A_S = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آهنگ') and `Owner` = '$userid'   ORDER BY `timestamp` desc");
                                        $S_A_S_Result = mysqli_num_rows($S_A_S);
                                        // Select All Educations  انتخاب تمام آموزش ها
                                        $S_A_E = mysqli_query($DB_config,  "SELECT * from videos WHERE (`Kind` = 'آموزش') and `Owner` = '$userid'  ORDER BY `timestamp` desc ");
                                        $S_A_E_Result = mysqli_num_rows($S_A_E);
                                        //  Select All Entertainment  انتخاب تمام سرگرمی
                                        $S_A_En = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'سرگرمی') and `Owner` = '$userid'   ORDER BY `timestamp` desc ");
                                        $S_A_En_Result = mysqli_num_rows($S_A_En);
                                        // Select All News  انتخاب تمام اخبار
                                        $S_A_N = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'اخبار') and `Owner` = '$userid'   ORDER BY `timestamp` desc ");
                                        $S_A_N_Result = mysqli_num_rows($S_A_N);

                                        $All_Result = $S_A_S_Result + $S_A_E_Result +  $S_A_En_Result +  $S_A_N_Result;  // مجموع تمام ویدیو های آپلود شده توسط یوزر
                                        ?>
                                <div class="section-title">
                                    <h2>ویدیو های شما</h2>
                                </div>
                                <h6 class="text-center">
                                    <span class="badge badge-success"><?= $All_Result ?></span> مجموع
                                    <br> <br>
                                    <span class="badge badge-dark"><?= $S_A_S_Result ?></span> آهنگ ها ,
                                    <span class="badge badge-dark"><?= $S_A_E_Result ?></span> آموزش ,
                                    <span class="badge badge-dark"><?= $S_A_En_Result ?></span> سرگرمی ,
                                    <span class="badge badge-dark"><?= $S_A_N_Result ?></span> اخبار</h6>
                            </div>
                        </div>
                    </div>
                    <div class="your-videos spad">
                        <?php
                                if ($S_A_S_Result > 0) {    // اگر تعداد آهنگ های آپلود شده توسط یوزر بزرگ تر از صفر بود 
                                    ?>
                            <button class="collapsible btn btn-primary">
                                <span>آهنگ ها </span><i class="fa fa-chevron-down"></i>
                            </button>
                            <div class="content">
                                <div class="row">
                                    <?php
                                                while ($S_A_S_row = mysqli_fetch_array($S_A_S)) {  // حلقه تمام آهنگ های آپلود شده توسط یوزر
                                                    $S_A_S_ID = $S_A_S_row['ID'];
                                                    $S_A_S_Name = $S_A_S_row['Name'];
                                                    $S_A_S_Title = $S_A_S_row['Title'];
                                                    $S_A_S_Author = $S_A_S_row['Author'];
                                                    $S_A_S_Kind = $S_A_S_row['Kind'];
                                                    $S_A_S_Subject = $S_A_S_row['Subject'];
                                                    $S_A_S_Owner = $S_A_S_row['Owner'];
                                                    $S_A_S_Thumbnail = "../DB/$S_A_S_Kind/$S_A_S_Subject/$S_A_S_Author/$S_A_S_Name.jpg";
                                                    ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6 ">
                                            <div class="card text-center">
                                                <div class="card-img-top">
                                                    <img src='<?= $S_A_S_Thumbnail ?>' class="img-thumbnail" />
                                                </div>
                                                <div class="card-header">
                                                    <span><?= $S_A_S_Title ?></span>
                                                    <h6><?= $S_A_S_Author ?></h6>
                                                    <a href="../player/index.php?id=<?= $S_A_S_ID ?>#player" class="btn watch_btn">تماشا</a>
                                                </div>
                                                <?php if ($S_A_S_Owner == $S_L_U_ID) {  //  اگر صاحب ویدیو مساوی به یوزر لاگ ان شده بود، اختیار ویرایش وبا حذف ویدیو را برای آن میدهد   
                                                                    ?>
                                                    <div class="card-body">
                                                        <a href='editvideo.php?id=<?= $S_A_S_ID ?>' class="btn btn-primary">ویرایش <i class="fa fa-pencil"> </i></a>
                                                        <a href='delete.php?id=<?= $S_A_S_ID ?>' class="btn btn-danger"> حذف <i class="fa fa-close"> </i></a>
                                                    </div>
                                                <?php  } ?>
                                            </div>
                                        </div>
                                    <?php } // ختم حلقه 
                                                ?>
                                </div>
                            </diV>
                        <?php } // ختم شرطیه اف 
                                ?>
                        <?php if ($S_A_E_Result > 0) {    // اگر تعداد آموزش  های آپلود شده توسط یوزر بزرگ تر از صفر بود 
                                    ?>
                            <button class="collapsible btn btn-primary">
                                <span>آموزش ها </span><i class="fa fa-chevron-down"></i>
                            </button>
                            <div class="content">
                                <div class="row">
                                    <?php
                                                while ($S_A_E_row = mysqli_fetch_array($S_A_E)) {  // حلقه تمام آموزش های آپلود شده توسط یوزر
                                                    $S_A_E_ID = $S_A_E_row['ID'];
                                                    $S_A_E_Name = $S_A_E_row['Name'];
                                                    $S_A_E_Title = $S_A_E_row['Title'];
                                                    $S_A_E_Author = $S_A_E_row['Author'];
                                                    $S_A_E_Kind = $S_A_E_row['Kind'];
                                                    $S_A_E_Subject = $S_A_E_row['Subject'];
                                                    $S_A_E_Owner = $S_A_E_row['Owner'];
                                                    $S_A_E_Thumbnail = "../DB/$S_A_E_Kind/$S_A_E_Subject/$S_A_E_Author/$S_A_E_Name.jpg";
                                                    ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6 ">
                                            <div class="card text-center">
                                                <div class="card-img-top">
                                                    <img src='<?= $S_A_E_Thumbnail ?>' class="img-thumbnail" />
                                                </div>
                                                <div class="card-header">
                                                    <span><?= $S_A_E_Title ?></span>
                                                    <h6><?= $S_A_E_Author ?></h6>
                                                    <a href="../player/index.php?id=<?= $S_A_E_ID ?>#player" class="btn watch_btn">تماشا</a>
                                                </div>
                                                <?php if ($S_A_E_Owner == $S_L_U_ID) {  //  اگر صاحب ویدیو مساوی به یوزر لاگ ان شده بود، اختیار ویرایش وبا حذف ویدیو را برای آن میدهد    
                                                                    ?>
                                                    <div class="card-body">
                                                        <a href='editvideo.php?id=<?= $S_A_E_ID ?>' class="btn btn-primary">ویرایش <i class="fa fa-pencil"> </i></a>
                                                        <a href='delete.php?id=<?= $S_A_E_ID ?>' class="btn btn-danger"> حذف <i class="fa fa-close"> </i></a>
                                                    </div>
                                                <?php  } ?>
                                            </div>
                                        </div>
                                    <?php } // ختم حلقه 
                                                ?>
                                </div>
                            </diV>
                        <?php } // ختم شرطیه اف 
                                ?>
                        <?php if ($S_A_En_Result > 0) {    // اگر تعداد سرگرمی های آپلود شده توسط یوزر بزرگ تر از صفر بود 
                                    ?>
                            <button class="collapsible btn btn-primary">
                                <span>سرگرمی ها </span><i class="fa fa-chevron-down"></i>
                            </button>
                            <div class="content">
                                <div class="row">
                                    <?php
                                                while ($S_A_En_row = mysqli_fetch_array($S_A_En)) {  // حلقه تمام سرگرمی های آپلود شده توسط یوزر
                                                    $S_A_En_ID = $S_A_En_row['ID'];
                                                    $S_A_En_Name = $S_A_En_row['Name'];
                                                    $S_A_En_Title = $S_A_En_row['Title'];
                                                    $S_A_En_Author = $S_A_En_row['Author'];
                                                    $S_A_En_Kind = $S_A_En_row['Kind'];
                                                    $S_A_En_Subject = $S_A_En_row['Subject'];
                                                    $S_A_En_Owner = $S_A_En_row['Owner'];
                                                    $S_A_En_Thumbnail = "../DB/$S_A_En_Kind/$S_A_En_Subject/$S_A_En_Author/$S_A_En_Name.jpg";
                                                    ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6 ">
                                            <div class="card text-center">
                                                <div class="card-img-top">
                                                    <img src='<?= $S_A_En_Thumbnail ?>' class="img-thumbnail" />
                                                </div>
                                                <div class="card-header">
                                                    <span><?= $S_A_En_Title ?></span>
                                                    <h6><?= $S_A_En_Author ?></h6>
                                                    <a href="../player/index.php?id=<?= $S_A_En_ID ?>#player" class="btn watch_btn">تماشا</a>
                                                </div>
                                                <?php if ($S_A_En_Owner == $S_L_U_ID) {  //  اگر صاحب ویدیو مساوی به یوزر لاگ ان شده بود، اختیار ویرایش وبا حذف ویدیو را برای آن میدهد    
                                                                    ?>
                                                    <div class="card-body">
                                                        <a href='editvideo.php?id=<?= $S_A_En_ID ?>' class="btn btn-primary">ویرایش <i class="fa fa-pencil"> </i></a>
                                                        <a href='delete.php?id=<?= $S_A_En_ID ?>' class="btn btn-danger"> حذف <i class="fa fa-close"> </i></a>
                                                    </div>
                                                <?php  } ?>
                                            </div>
                                        </div>
                                    <?php } // ختم حلقه 
                                                ?>
                                </div>
                            </diV>
                        <?php } // ختم شرطیه اف 
                                ?>
                        <?php if ($S_A_N_Result > 0) {    // اگر تعداد اخبار آپلود شده توسط یوزر بزرگ تر از صفر بود 
                                    ?>
                            <button class="collapsible btn btn-primary">
                                <span>اخبار </span><i class="fa fa-chevron-down"></i>
                            </button>
                            <div class="content">
                                <div class="row">
                                    <?php
                                                while ($S_A_N_row = mysqli_fetch_array($S_A_N)) {  // حلقه تمام اخبار آپلود شده توسط یوزر
                                                    $S_A_N_ID = $S_A_N_row['ID'];
                                                    $S_A_N_Name = $S_A_N_row['Name'];
                                                    $S_A_N_Title = $S_A_N_row['Title'];
                                                    $S_A_N_Author = $S_A_N_row['Author'];
                                                    $S_A_N_Kind = $S_A_N_row['Kind'];
                                                    $S_A_N_Subject = $S_A_N_row['Subject'];
                                                    $S_A_N_Owner = $S_A_N_row['Owner'];
                                                    $S_A_N_Thumbnail = "../DB/$S_A_N_Kind/$S_A_N_Subject/$S_A_N_Author/$S_A_N_Name.jpg";
                                                    ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6 ">
                                            <div class="card text-center">
                                                <div class="card-img-top">
                                                    <img src='<?= $S_A_N_Thumbnail ?>' class="img-thumbnail" />
                                                </div>
                                                <div class="card-header">
                                                    <span><?= $S_A_N_Title ?></span>
                                                    <h6><?= $S_A_N_Author ?></h6>
                                                    <a href="../player/index.php?id=<?= $S_A_N_ID ?>#player" class="btn watch_btn">تماشا</a>
                                                </div>
                                                <?php if ($S_A_N_Owner == $S_L_U_ID) {  //  اگر صاحب ویدیو مساوی به یوزر لاگ ان شده بود، اختیار ویرایش وبا حذف ویدیو را برای آن میدهد    
                                                                    ?>
                                                    <div class="card-body">
                                                        <a href='editvideo.php?id=<?= $S_A_N_ID ?>' class="btn btn-primary">ویرایش <i class="fa fa-pencil"> </i></a>
                                                        <a href='delete.php?id=<?= $S_A_N_ID ?>' class="btn btn-danger"> حذف <i class="fa fa-close"> </i></a>
                                                    </div>
                                                <?php  } ?>
                                            </div>
                                        </div>
                                    <?php } // ختم حلقه 
                                                ?>
                                </div>
                            </diV>
                        <?php } // ختم شرطیه اف 
                                ?>
                    </div>
                </div>
                <script>
                    // اسکرپت نشان دهنده و مخفی کننده های ویدیو
                    var coll = document.getElementsByClassName("collapsible"); //  انتخاب دیف برای اجرای اسکرپت
                    var i;
                    for (i = 0; i < coll.length; i++) {
                        coll[i].addEventListener("click", function() { //  هنگامیکه بالای دیف کلک شد عملیه ذیل را اجرا میکند
                            this.classList.toggle("active"); // اگر کلس اکتیف بود آن کلس اکتیف را از آن میگیرد
                            var content = this.nextElementSibling; //  محتویات داخل بتن 
                            if (content.style.display === "block") { //  اگر آشکار بود  
                                content.style.display = "none"; //   آن را پنهان میکند 
                            } else { // در غیر آن 
                                content.style.display = "block"; // آن را آشکار میکند
                            }
                        });
                    }
                </script>
            <?php  } else {  //  اگر نام کاربری پوست شده در دیتابیس موجود نبود    
                    ?>
                <div class="jumbotron alert alert-danger text-center">
                    <h2>خطاء : نام کاربری ناشناس است</h2>
                    <p>نام کار بری ثبت نشده است <br> لطفأ نام کار بری را چک نمودهو مطمئن شوید که درست است</p>
                </div>
        <?php   }
        }  ?>
            </section>
            <?php
            include '../tools/footer.php'; // فایل فوتر 
            include '../tools/scripts.php'; // فایل اسکرپت ها 
            ?>
</body>

</html> <?php
        $DB_config->close(); // قطع ارتباط با دیتابیس 
        ?>