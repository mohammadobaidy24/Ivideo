<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
include '../tools/session.php'; //  فایل معلوم کننده یوزر وارد شه
?>
<!DOCTYPE html>
<html lang="utf-8">

<head>
    <title>ویرایش ویدیو - iVideo</title>
    <?php
    include '../tools/meta.php'; // فایل  مشخصات میتا صفحه
    include '../tools/stylesheet.php'; // فایل مشخصات سی اس اس
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

</head>

<body>
    <?php
    include '../tools/header.php'; //   فایل عنوان بالایی و محوطه سمت یابی پیوند ها 
    include '../tools/humberger.php'; // فایل مینویی موبایل 
    include '../tools/hero.php'; // فایل دسته بندی ها، جستجو و تاریخ
    ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Edit Video</h2>
                        <div class="breadcrumb__option">
                            <a href="../index.php"><i class="fa fa-home"> </i> خانه</a>
                            <a href="profile.php"><i class="fa fa-address-book-o"> </i> نمایه</a>
                            <a href="#"><i class="fa fa-address-book-o"> </i> ویرایش ویدیو</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <!-- forms Section Begin -->
    <section class="forms spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span>ویدیو را ویریش نموده و دکمه به روز رسانی را فشار دهید
                    </h6>
                </div>
            </div>

            <div class="forms__form">
                <div class="col-lg-8 col-md-6">
                    <?php
                    if (isset($_GET['id'])) {
                        $select_video = "select * from videos where ID = $_GET[id]";
                        $query_this_video = mysqli_query($DB_config, $select_video);
                        if ($video_row = mysqli_fetch_assoc($query_this_video)) {
                            $playpostid = $video_row['ID'];
                            $playname = $video_row['Name'];
                            $playTitle = $video_row['Title'];
                            $playAuthor = $video_row['Author'];
                            $playsubject = $video_row['Subject'];
                            $playkind = $video_row['Kind'];
                            $playowner = $video_row['Owner'];
                            $playimg = '../DB/' . $playkind . '/' . $playsubject . '/' . $playAuthor . '/' . $playname . '.jpg';
                            $playvideo = '../DB/' . $playkind . '/' . $playsubject . '/' . $playAuthor . '/' . $playname;
                            ?>
                            <h4>مشخصات ویدیو</h4>
                            <form class="form-group" id="frm-uploud" method="post" action="update.php"enctype="multipart/form-data">
                                <div class="forms__input">
                                    <p>ویدیو<span>*</span></p>
                                    <video id="video" controls poster="<?= $playimg ?>">
                                        <source src='<?= $playvideo ?>' type='video/mp4' />
                                    </video>
                                    <input type="hidden" value="<?=$playpostid?>" name="playpostid"/>
                                </div>
                               
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="forms__input">
                                            <p>عنوان<span>*</span></p>
                                            <input type="text" name="Title" value="<?= $playTitle ?>" id="title" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="forms__input">
                                            <p>سازنده<span>*</span></p>
                                            <input type="text" name="author" value="<?= $playAuthor ?>" id="author" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="forms__input">
                                            <p>موضوع<span>*</span></p>
                                            <input type="text" name="subject" value="<?= $playsubject ?>" id="subject" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="forms__input">
                                            <p>نوعیت<span>*</span></p>
                                            <input type="text" name="kind" value="<?= $playkind ?>" id="author" required />
                                        </div>
                                    </div>
                                </div>
                               
                                <input type="submit" name="update" class="btn btn-primary" value="ثبت"id="Update Video" />
                            </form>
                    <?php
                           
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- forms Section End -->

    <hr />




    <?php
    include '../tools/footer.php';
    include '../tools/scripts.php';
    ?>
</body>

</html>
<?php
$DB_config->close();
?>