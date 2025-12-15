<?php
include '../tools/DB_config.php';  //   فایل ارتباط با دیتابیس
include '../tools/session.php';  //  فایل معلوم کننده یوزر وارد شه
?>
<!DOCTYPE html> <!-- HTML 5 -->
<html lang="utf-8">
<!-- آغاز HTML -->

<head>
    <title>ویدیو ها - iVideo</title> <!-- عنوان صفحه -->
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
                        <h2>ویدیو ها</h2>
                        <div class="breadcrumb__option">
                            <a href="../index.php"><i class="fa fa-home"> </i> خانه</a>
                            <a href="index.php"><i class="fa fa-mortar-board"> </i> مدیریت</a>
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
                            <h2>آخرین ویدیو ها</h2> <!-- عنوان بهترین ویدیو ها  -->
						</div>
						<div class="row">
						<div class="col-lg-12">
						<?php
                                        // Select Latest Songs انتخاب آخرین آهنگ ها 
                                        $S_L_V = mysqli_query($DB_config, "SELECT * from videos ORDER BY `Timestamp` desc ");
                                        while ($S_L_V_row = mysqli_fetch_array($S_L_V)) {
                                            $S_L_V_ID = $S_L_V_row['ID'];  // آی دی آخرین آهنگ ها 
                                            $S_L_V_Name = $S_L_V_row['Name'];  //  نام ویدیو آخرین آهنگ ها
                                            $S_L_V_Title = $S_L_V_row['Title'];  // عنوان آخرین آهنگ ها
                                            $S_L_V_Author = $S_L_V_row['Author'];  //  تدریس کننده آخرین آهنگ ها
                                            $S_L_V_Subject = $S_L_V_row['Subject'];  //   موضوع آخرین آهنگ ها
                                            $S_L_V_Owner = $S_L_V_row['Owner'];  //  صاحب آخرین آهنگ ها
											$S_L_V_Kind = $S_L_V_row['Kind'];  //   نوعیت آخرین آهنگ ها
											$S_L_V_timstamp = $S_L_V_row['timestamp'];
                                            $S_L_V_Thumbnail = "../DB/$S_L_V_Kind/$S_L_V_Subject/$S_L_V_Author/$S_L_V_Name.jpg";  //  تصویر آخرین آهنگ ها
                                            $S_Owner = mysqli_query($DB_config, "SELECT * From `accounts` where `ID`=$S_L_V_Owner");
                                            $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
											$S_F_S_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
											$S_F_S_Username = $S_Owner_Result['username'];     
     										$S_F_S_Profile = $S_Owner_Result['Profile'];
											?>
											<div class="card">
  							<div class="card-header"> 
								  <a href='../profile/profile.php?un=<?=$S_F_S_Username?>'>
								  <img src="../DB/Users/<?=$S_F_S_Profile?>" style="height:50px;width:50px; border-radius:50%;"/>
								   <b><?=$S_F_S_Owner_Name?> </b> <i> <?=$S_L_V_timstamp?></i></a>
										</div>
										<div class="card-body">
										<a href="../player/index.php?id=<?= $S_L_V_ID ?>#player" >
								   <div class="simple-list__item__pic">
                                                    <img src="<?= $S_L_V_Thumbnail ?>" class='img-thumbnail' />
                                                </div>
                                                <div class="simple-list__item__text">

                                                    <span><?= $S_L_V_Title ?></span>
                                                    <h6><?= $S_L_V_Author ?></h6>
												</div>
                                                <a href='delete.php?id=<?= $S_L_V_ID ?>'style="float:left;" class="btn btn-danger"> حذف <i class="fa fa-close"> </i></a>
										</a>
								</div>
						</div>
                                    
                                        <?php
                                        } // Select Latest Songs While End
										?>
										</div>
						
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