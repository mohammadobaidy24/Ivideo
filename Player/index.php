<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
include '../tools/session.php'; //  فایل معلوم کننده یوزر وارد شه
?>
<!DOCTYPE html>
<html lang="utf-8">

<head>
    <?php
    if (isset($_GET['id'])) { //اگر آی دی را در یافت کرد 
        $Get_id = $_GET['id'];
        setcookie("player_id",$Get_id,time()+120,"/","",0);
        // select play video  انتخاب ویدیو در حال پخش
        $S_P_V = mysqli_query($DB_config, "SELECT * from videos where ID = $Get_id");
        if ($S_P_V_row = mysqli_fetch_assoc($S_P_V)) {
            $PlayId = $S_P_V_row['ID'];
            $PlayName = $S_P_V_row['Name'];
            $PlayTitle = $S_P_V_row['Title'];
            $PlayAuthor = $S_P_V_row['Author'];
            $PlaySubject = $S_P_V_row['Subject'];
            $PlayKind = $S_P_V_row['Kind'];
            $PlayOwner = $S_P_V_row['Owner'];
            $PlayTimestamp = $S_P_V_row['timestamp'];
            $PlayTumbnail = '../DB/' . $PlayKind  . '/' . $PlaySubject . '/' . $PlayAuthor . '/' . $PlayName . '.jpg';
            $PlayVideo = '../DB/' . $PlayKind  . '/' . $PlaySubject . '/' . $PlayAuthor . '/' . $PlayName;
            //------------------------------وارد ساختن ویدیو در جدول مرسوم ها ----------------------------//
            // Select Play Video at Trending table   
            $S_P_V_T = mysqli_query($DB_config, "SELECT * from trending where Video_id = $Get_id LIMIT 1");
            if ($S_P_V_T_row = mysqli_fetch_assoc($S_P_V_T)) { // اگر ویدیو در جدول وجود داشت 
                $S_P_V_T_id = $S_P_V_T_row['ID'];
                $S_P_V_T_video_id = $S_P_V_T_row['Video_id'];
                $S_P_V_T_add_watched = " $S_P_V_T_row[Watched] + 1";
                // update watched of video
                mysqli_query($DB_config, "UPDATE `trending` SET `Watched`=$S_P_V_T_add_watched where ID=$S_P_V_T_id");
            } else { // اگر ویدیو در جدول مرسوم ها نبود 
                // insert Video to Trending
                mysqli_query($DB_config, "INSERT INTO `trending`(`ID`, `Video_id`, `Kind`, `watched`)
                VALUES ('','$PlayId ','$PlayKind','1')");
            }
            //----------------------------------------------------------------------------------------------------//
            ?>
            <title><?= $PlayTitle ?> - <?= $PlayAuthor  ?> - iVideo </title> <!-- عنوان صفحه  -->
    <?php }
    } ?>
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
    <script type='text/javascript' src='../JS/jquery-3.3.1.js'></script>
    <script src="script.js" type="text/javascript"></script> <!-- اسکرپت لایک ، ان لایک و نظریه -->
</head>

<body>
    <?php
    include '../tools/header.php'; //   فایل عنوان بالایی و محوطه سمت یابی پیوند ها 
    include '../tools/humberger.php'; // فایل مینویی موبایل 
    include '../tools/hero.php'; // فایل دسته بندی ها، جستجو و تاریخ
    ?>
    <!--  شروع بخش ویدیوی اصلی  -->
    <?php
    if (isset($Get_id)) { // اگر آدی گرفته شده بود ویدیو را پخش کن
        ?>
        <section class="span player_section " id="player">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-8 card">
                        <div class="video card-img-top embed-responsive">
                            <video id="video" class="rounded" controls autoplay>
                                <source src='<?= $PlayVideo ?>' type='video/mp4' />
                            </video>
                        </div>

                        <div class="card-header video_detail">
                            <div class="video_info">
                                <h3><?= $PlayTitle ?></h3>
                                <span>
                                    <?= $PlayAuthor ?> - <?= $PlaySubject ?>
                                </span>
                            </div>
                            <div class="users_detail">
                                <a download href="<?= $PlayVideo ?>" class="downloadbtn rounded btn btn-primary">دانلود</a>
                                <?php
                                    // انتخاب عکس نمایه صاحب ویدیو
                                    $uservideo = mysqli_query($DB_config, "SELECT `Profile`,`username` from `accounts` where `ID`='$PlayOwner'");
                                    if ($row = mysqli_fetch_array($uservideo)) {
                                        $uservideoprofile = $row['Profile'];
                                        $uservideousername = $row['username'];
                                        ?>
                                    <a href="../profile/profile.php?un=<?= $uservideousername ?>">
                                        <img src="../DB/Users/<?= $uservideoprofile ?>" class="userimg img-thumbnail">
                                        <span><?= $uservideousername ?></span>
                                    </a>
                                   
                                    <?php } ?>
                                <br />
                                <time>بارگذاری شده :<?= $PlayTimestamp  ?></time>
                            </div>
                        </div>
                        <?php
                            // Select User States انتخاب حالت لایک وان لایک
                            $S_U_S = mysqli_query($DB_config, "SELECT * FROM `like_unlike` WHERE userid=" . $S_L_U_ID . " AND postid=" . $PlayId . " LIMIT 1");
                            // انتخاب سطر که یوزر آی دی مساوی به آدی یوزر لاگ ان شده و پوست آی دی آن مساوی به آد دی ویدیوی که در حال اجرا است
                            if ($S_U_S_row = mysqli_fetch_array($S_U_S)) {
                                $UserStates = $S_U_S_row['type'];
                            }
                            // Count total loves     مجموع لایک ها را حساب میکند  
                            $C_T_L = mysqli_query($DB_config, "SELECT COUNT(*) AS cntlike FROM like_unlike WHERE `type`='1' and postid=" . $PlayId);
                            $C_T_L_row = mysqli_fetch_array($C_T_L);
                            $C_T_L_Total_Like = $C_T_L_row['cntlike'];
                            // Count total disloves    تعداد ان لایک را حساب میکند
                            $C_T_D = mysqli_query($DB_config, "SELECT COUNT(*) AS cntunlike FROM like_unlike WHERE `type`='0' and postid=" . $PlayId);
                            $C_T_D_row = mysqli_fetch_array($C_T_D);
                            $C_T_D_Total_Dislike = $C_T_D_row['cntunlike'];
                            ?>
                        <div class="card-body video_options">
                            <button id="like_<?= $PlayId ?>" class="like" style="<?php if ($UserStates == 1) { // اگر یوزر این ویدیو را لایک کرده بود
                                                                                            echo "color: #28a745;";
                                                                                        } ?>">
                                <i class="fa fa-thumbs-up "></i> لایک
                            </button>
                            <span class="badge " id="likes_<?= $PlayId ?>"><?= $C_T_L_Total_Like ?></span> <!-- تعداد لایک ها را نشان میدهد -->
                            <b class="pipline">|</b>
                            <button id="unlike_<?= $PlayId ?>" class="unlike" style="<?php if ($UserStates == 0) { // اگر یوزر این ویدیو را ان لایک کرده بود
                                                                                                echo "color:#dc3545;";
                                                                                            } ?>">
                                <i class="fa fa-thumbs-down"></i> ان لایک
                            </button>
                            <span class="badge" id="unlikes_<?= $PlayId ?>"><?= $C_T_D_Total_Dislike ?></span> <!-- تعداد ان لایک ها را نشان میدهد -->
                            <b class="pipline">|</b>
                            <button onclick="ShowCMT()">
                                <!-- وقتیکه کلک شد کمنت فکشن شو کمنت را اجرا کند -->
                                <i class="fa fa-commenting "></i> کمنت
                            </button>
                            <div class="Comment" id="cmtDIV" style="display:none;">
                                <form method='post' action="" onsubmit="return PostCMT();">
                                    <!-- وقتیکه سبمت شد پوست کو کمنت -->
                                    <input type="text" id="comment" class="form-control" placeholder="نظریه تان را وارد نمائید" />
                                    <input type="hidden" id="video_id" value="<?= $PlayId ?>">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i></button>
                                </form>
                            </div>
                            <?php // Show Watched Video   نشان بتی ویدیو های دیده شده ره
                                $S_W_V = mysqli_query($DB_config, "SELECT `Watched` from `trending` where `Video_id`= $PlayId");
                                if ($S_W_V_row = mysqli_fetch_array($S_W_V)) {
                                    $S_W_V_Watched = $S_W_V_row['Watched'];
                                }
                                ?>
                            <button class="Watched">
                                <i class="fa fa-eye "></i>
                                تماشا شده <span class="badge"><?= $S_W_V_Watched ?></span>
                            </button>
                        </div>
                    </div>
                    <?php // Select Next Video To Play      انتخاب ویدیوی بعدی برای اجرا
                        $S_N_V_T_P = mysqli_query($DB_config, "SELECT ID from videos WHERE (`ID` > " . $PlayId . ") and (`Kind` = '$PlayKind') limit 1 ");
                        if ($S_N_V_T_P_row = mysqli_fetch_array($S_N_V_T_P)) {
                            ?>
                        <script type='text/javascript'>
                            // وقتیکه ویدیو به پایان رسید ویدیوی بعدی را پخش نماید
                            document.getElementById('video').addEventListener('ended', Handler, false);

                            function Handler(e) {
                                window.open("../player/index.php?id=<?= $S_N_V_T_P_row['ID']; ?>#player", "_self")
                            }
                        </script>
                    <?php } ?>
                    <div class="col-lg-3 col-md-4">
                        <div class=" card">
                            <span class="card-title text-center">Play List </span>
                            <?php // Select Playlist Video    انتخاب ویدیوی های لست اجرا 
                                $S_P_V = mysqli_query($DB_config, "SELECT * from videos WHERE (`ID` > " . $PlayId . ") and (`Kind` = '$PlayKind') limit 5");
                                while ($S_P_V_row = mysqli_fetch_array($S_P_V)) {
                                    $Playlist_Id = $S_P_V_row['ID'];
                                    $Playlist_Name = $S_P_V_row['Name'];
                                    $Playlist_Title = $S_P_V_row['Title'];
                                    $Playlist_Author = $S_P_V_row['Author'];
                                    $Playlist_Subject = $S_P_V_row['Subject'];
                                    $Playlist_Kind = $S_P_V_row['Kind'];
                                    $Playlist_Tumbnail = '../DB/' . $Playlist_Kind . '/' . $Playlist_Subject . '/' . $Playlist_Author . '/' . $Playlist_Name . '.jpg';
                                    ?>
                                <a href="../player/index.php?id=<?= $Playlist_Id ?>#player" class="simple-list__item card">
                                    <div class="simple-list__item__pic ">
                                        <img src='<?= $Playlist_Tumbnail ?>' />
                                    </div>
                                    <div class="simple-list__item__text card-body">
                                        <h6><?= $Playlist_Title ?></h6>
                                        <span><?= $Playlist_Author ?></span>
                                    </div>
                                </a>
                            <?php
                                } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php    }
    ?>
    <!--  ختم بخش ویدیوی اصلی  -->
    <!--  شروع بخش ویدیو های دیگر -->
    <section class="sidebar spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="sidebar__item">
                        <div class=" card">
                            <!-- شروع بخش ویدیو ها -->
                            <h4>کمنت ها</h4>
                            <div class="simple-list__slider__item">
                                <div id="all_comments">
                                    <?php
                                    // Select Video Comments   انتخاب کمنت های ویدیو
                                    $S_V_C = mysqli_query($DB_config, "SELECT * from comments  where postid='$PlayId' order by post_time desc");
                                    while ($S_V_C_row = mysqli_fetch_array($S_V_C)) {
                                        $CmtVideoId = $S_V_C_row['postid'];
                                        $Cmt = $S_V_C_row['comment'];
                                        $CmtTimestamp = $S_V_C_row['post_time'];
                                        $CmtUserId = $S_V_C_row['userid'];
                                        // Select Commented User  انتخاب یوزری که کمنت را داده است
                                        $S_C_U = mysqli_query($DB_config, "SELECT * from accounts where id='$CmtUserId'");
                                        if ($S_C_U_row = mysqli_fetch_array($S_C_U)) {
                                            $UserName = $S_C_U_row['username'];
                                            $UserProfile = $S_C_U_row['Profile'];
                                            ?>
                                            <div class="comment_div simple-list__item border border-primary">
                                                <div class="simple-list__item__pic">
                                                    <img src="../DB/Users/<?= $UserProfile ?>" class="img-thumbnail">
                                                </div>
                                                <div class="simple-list__item__text">
                                                    <h6><?= $UserName ?></h6>
                                                    <span><i class='fa fa-quote-left '></i> <?= $Cmt ?> <i class='fa fa-quote-right '></i></span>
                                                    <p><?= $CmtTimestamp ?></p>
                                                </div>
                                            </div>
                                    <?php }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div> <!-- ختم بخش ویدیو ها -->
                        <br />
                        <div class=" ">
                            <h4>ویدیو ها</h4> <!-- عنوان بخش ویدیو ها -->
                            <div class="simple-list__slider owl-carousel ">
                                <!-- آغاز بخش Slider -->
                                <div class="simple-list__slider__item">
                                    <!-- Slider اولی -->
                                    <h5>آموزش ها</h5>
                                    <?php
                                    // Select Video Educations انتخاب آموزش ها 
                                    $S_E_V = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آموزش') ORDER BY Rand() limit 5 ");
                                    while ($S_E_V_row = mysqli_fetch_array($S_E_V)) {
                                        $S_E_V_ID = $S_E_V_row['ID'];  // آی دی  آموزش ها 
                                        $S_E_V_Name = $S_E_V_row['Name'];  //  نام ویدیو آموزش ها
                                        $S_E_V_Title = $S_E_V_row['Title'];  // عنوان آموزش ها
                                        $S_E_V_Author = $S_E_V_row['Author'];  //  تدریس کننده  آموزش ها
                                        $S_E_V_Subject = $S_E_V_row['Subject'];  //   موضوع آموزش ها
                                        $S_E_V_Owner = $S_E_V_row['Owner'];  //  صاحب آموزش ها
                                        $S_E_V_Kind = $S_E_V_row['Kind'];  //   نوعیت آموزش ها
                                        $S_E_V_Thumbnail = "../DB/$S_E_V_Kind/$S_E_V_Subject/$S_E_V_Author/$S_E_V_Name.jpg";  //  تصویر  آموزش ها
                                        $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_E_V_Owner");
                                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                                            $S_F_S_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
                                        ?>
                                        <a href="../player/index.php?id=<?= $S_E_V_ID ?>#player" class="simple-list__item border border-primary">
                                            <div class="simple-list__item__pic">
                                                <img src="<?= $S_E_V_Thumbnail ?>" class='img-thumbnail' />
                                            </div>
                                            <div class="simple-list__item__text">
                                                <span><?= $S_E_V_Title ?></span>
                                                <h6><?= $S_E_V_Author ?></h6>
                                                <p class="text-muted"> <?= $S_F_S_Owner_Name ?></p>
                                            </div>
                                        </a>
                                    <?php
                                    } // Select Video Educations While End
                                    ?>
                                </div>
                                <div class="simple-list__slider__item">
                                    <!-- Slider دومی -->
                                    <h5>آهنگ ها</h5>
                                    <?php
                                    // Select  Video Songs انتخاب آهنگ ها 
                                    $S_V_S = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind`= 'آهنگ') ORDER BY Rand()  limit 5 ");
                                    while ($S_V_S_row = mysqli_fetch_array($S_V_S)) {
                                        $S_V_S_ID = $S_V_S_row['ID'];  // آی دی آهنگ ها 
                                        $S_V_S_Name = $S_V_S_row['Name'];  //  نام ویدیو آهنگ ها
                                        $S_V_S_Title = $S_V_S_row['Title'];  // عنوان آهنگ ها
                                        $S_V_S_Author = $S_V_S_row['Author'];  //  تدریس کننده آهنگ ها
                                        $S_V_S_Subject = $S_V_S_row['Subject'];  //   موضوع آهنگ ها
                                        $S_V_S_Owner = $S_V_S_row['Owner'];  //  صاحب آهنگ ها
                                        $S_V_S_Kind = $S_V_S_row['Kind'];  //   نوعیت آهنگ ها
                                        $S_V_S_Thumbnail = "../DB/$S_V_S_Kind/$S_V_S_Subject/$S_V_S_Author/$S_V_S_Name.jpg";  //  تصویر آهنگ ها
                                        $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_V_S_Owner");
                                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                                            $S_F_S_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
                                        ?>
                                        <a href="../player/index.php?id=<?= $S_V_S_ID ?>#player" class="simple-list__item border border-primary">
                                            <div class="simple-list__item__pic">
                                                <img src="<?= $S_V_S_Thumbnail ?>" class='img-thumbnail' />
                                            </div>
                                            <div class="simple-list__item__text">
                                                <span><?= $S_V_S_Title ?></span>
                                                <h6><?= $S_V_S_Author ?></h6>
                                                <p class="text-muted"> <?= $S_F_S_Owner_Name ?></p>
                                            </div>
                                        </a>
                                    <?php
                                    } // Select Video Songs While End
                                    ?>
                                </div>
                                <div class="simple-list__slider__item">
                                    <!-- Slider سومی -->
                                    <h5>سرگرمی</h5>
                                    <?php
                                    // Select Video Entertainment انتخاب ویدیوی سرگرمی 
                                    $S_V_En = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'سرگرمی') ORDER BY Rand() limit 5 ");
                                    while ($S_V_En_row = mysqli_fetch_array($S_V_En)) {
                                        $S_V_En_ID = $S_V_En_row['ID'];  // آی دی سرگرمی 
                                        $S_V_En_Name = $S_V_En_row['Name'];  //  نام ویدیو سرگرمی
                                        $S_V_En_Title = $S_V_En_row['Title'];  // عنوان سرگرمی 
                                        $S_V_En_Author = $S_V_En_row['Author'];  //  تدریس کننده سرگرمی
                                        $S_V_En_Subject = $S_V_En_row['Subject'];  //   موضوع سرگرمی
                                        $S_V_En_Owner = $S_V_En_row['Owner'];  //  صاحب سرگرمی
                                        $S_V_En_Kind = $S_V_En_row['Kind'];  //   نوعیت سرگرمی
                                        $S_V_En_Thumbnail = "../DB/$S_V_En_Kind/$S_V_En_Subject/$S_V_En_Author/$S_V_En_Name.jpg";  //  تصویر سرگرمی
                                        $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_V_En_Owner");
                                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                                            $S_F_S_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
                                        ?>
                                        <a href="../player/index.php?id=<?= $S_V_En_ID ?>#player" class="simple-list__item border border-primary">
                                            <div class="simple-list__item__pic">
                                                <img src="<?= $S_V_En_Thumbnail ?>" class='img-thumbnail' />
                                            </div>
                                            <div class="simple-list__item__text">
                                                <span><?= $S_V_En_Title ?></span>
                                                <h6><?= $S_V_En_Author ?></h6>
                                                <p class="text-muted"> <?= $S_F_S_Owner_Name ?></p>
                                            </div>
                                        </a>
                                    <?php
                                    } // Select Video Entertainment While End
                                    ?>
                                </div>
                                <div class="simple-list__slider__item">
                                    <!-- Slider چهارمی -->
                                    <h5>اخبار</h5>
                                    <?php
                                    // Select Video News انتخاب ویدیو های اخبار  
                                    $S_V_N = mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'اخبار') ORDER BY  Rand() limit 5 ");
                                    while ($S_V_N_row = mysqli_fetch_array($S_V_N)) {
                                        $S_V_N_ID = $S_V_N_row['ID'];  // آی دی اخبار 
                                        $S_V_N_Name = $S_V_N_row['Name'];  //  نام ویدیو اخبار
                                        $S_V_N_Title = $S_V_N_row['Title'];  // عنوان اخبار
                                        $S_V_N_Author = $S_V_N_row['Author'];  //  تدریس کننده اخبار
                                        $S_V_N_Subject = $S_V_N_row['Subject'];  //   موضوع اخبار
                                        $S_V_N_Owner = $S_V_N_row['Owner'];  //  صاحب اخبار
                                        $S_V_N_Kind = $S_V_N_row['Kind'];  //   نوعیت اخبار
                                        $S_V_N_Thumbnail = "../DB/$S_V_N_Kind/$S_V_N_Subject/$S_V_N_Author/$S_V_N_Name.jpg";  //  تصویر اخبار
                                        $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_V_N_Owner");
                                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
                                            $S_F_S_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
                                        ?>
                                        <a href="../player/index.php?id=<?= $S_V_N_ID ?>#player" class="simple-list__item border border-primary">
                                            <div class="simple-list__item__pic">
                                                <img src="<?= $S_V_N_Thumbnail ?>" class='img-thumbnail' />
                                            </div>
                                            <div class="simple-list__item__text">
                                                <span><?= $S_V_N_Title ?></span>
                                                <h6><?= $S_V_N_Author ?></h6>
                                                <p class="text-muted"> <?= $S_F_S_Owner_Name ?></p>
                                            </div>
                                        </a>
                                    <?php
                                    } // Select Video News  While End
                                    ?>
                                </div>
                            </div>
                        </div> <!-- ختم بخش  ویدیو ها -->
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        <?php
                        // Select Videos Some As Play Video   انتخاب ویدیو های که موضوع شان هم مانند موضوع ویدیو در حال اجرا است
                        $S_V_S_P = mysqli_query($DB_config, "SELECT * from videos WHERE (`Subject` LIKE '$PlaySubject') ORDER BY rand() limit 12");
                        while ($S_V_S_P_row = mysqli_fetch_array($S_V_S_P)) {
                            $S_V_S_P_id = $S_V_S_P_row['ID'];
                            $S_V_S_P_name = $S_V_S_P_row['Name'];
                            $S_V_S_P_Title = $S_V_S_P_row['Title'];
                            $S_V_S_P_Author = $S_V_S_P_row['Author'];
                            $S_V_S_P_kind = $S_V_S_P_row['Kind'];
                            $S_V_S_P_subject = $S_V_S_P_row['Subject'];
                            $S_V_S_P_owner = $S_V_S_P_row['Owner'];
                            $S_V_S_P_Tumbnail = '../DB/' . $S_V_S_P_kind . '/' . $S_V_S_P_subject . '/' . $S_V_S_P_Author . '/' . $S_V_S_P_name . '.jpg';
                            ?>
                            <div class="col-lg-4 col-md-5 col-sm-5">
                                <figure class="figure all_videos__item bg-light">
                                    <a href="../player/index.php?id=<?= $S_V_S_P_id ?>#player">
                                        <div class="all_videos__item__pic">
                                            <img src='<?= $S_V_S_P_Tumbnail ?>' class='figure-img img-thumbnail rounded' />
                                        </div>
                                        <figcaption class="figure-caption all_videos__item__text">
                                            <h6><?= $S_V_S_P_Author ?></h6>
                                            <h5><?= $S_V_S_P_Title ?></h5>
                                        </figcaption>
                                    </a>
                                </figure>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
    <?php
    include '../tools/footer.php'; // فایل فوتر 
    include '../tools/scripts.php'; // فایل اسکرپت ها 
    ?>
</body>

</html>
<?php
$DB_config->close(); // قطع ارتباط با دیتابیس 
?>