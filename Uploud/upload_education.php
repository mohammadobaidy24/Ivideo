<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
include '../tools/session.php'; //  فایل معلوم کننده یوزر وارد شه
?>
<!DOCTYPE html>
<html lang="utf-8">

<head>
    <title>بارگذاری - iVideo</title>
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

<?php
if (isset($_POST['submit'])) {
    $name = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $Title = $_POST['Title'];
    $Author = $_POST['Author'];
    $subject = $_POST['subject'];
    $owner = $_SESSION['userid'];
    $postKind = 'آموزش';
    //  Making Thumbnail from video by using ffmpeg
    require '../vendor/autoload.php';
    $path = "../DB/" . $postKind . "/" . $subject . "/" . $Author . "/";
    // Create directory if it does not exist
    if (!is_dir($path)) {
        mkdir($path, 0777, TRUE);
    }
    move_uploaded_file($temp, $path . "/" . $name);
    $movie = $path . "/" . $name;
    $thumbnail =  $path . "/"  . $name . ".jpg";

    $sec = 25;
    $ffmpeg = FFMpeg\FFMpeg::create();
    $video = $ffmpeg->open($movie);
    $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($sec));
    $frame->save($thumbnail);



    $q = "INSERT INTO `videos`(`id`, `name`, `Title`, `Author`, `Kind`, `Subject`, `owner`)
             VALUES ('','$name','$Title','$Author','$postKind', '$subject', '$owner')";
    mysqli_query($DB_config, $q);
}

?>

<body>
    <?php
    include '../tools/header.php'; //   فایل عنوان بالایی و محوطه سمت یابی پیوند ها 
    include '../tools/humberger.php'; // فایل مینویی موبایل 
    include '../tools/hero.php'; // فایل دسته بندی ها، جستجو و تاریخ
    ?>

    <!-- Breadcrumb شروع بخش -->
    <section class="breadcrumb-section container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>بارگذاری آموزشی </h2>
                        <div class="breadcrumb__option">
                            <a href="../index.php"><i class="fa fa-home"> </i> خانه</a>
                            <a href="#"><i class="fa fa-upload"></i> بارگذاری</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb ختم بخش-->

    <!-- forms شروع بخش -->
    <section class="forms spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><i class="fa fa-dropbox"> </i> فایل را انتخاب نموده و معلومات در باره آن را بنویسید
                    </h6>
                </div>
            </div>
            <div class="forms__form">
                <div class="col-lg-8 col-md-6">
                    <h4>مشخصات فایل</h4>
                    <form class="form-group" id="frm-forms" method="post" enctype="multipart/form-data" action="uploud.php">
                        <div class="row">
                            <div class="forms__input">
                                <p>ویدیو<span>*</span></p>
                                <input type="file" accept="video/*" class="form-control" name="file" placeholder="File" id="video" required />
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="forms__input">
                                        <p>عنوان<span>*</span></p>
                                        <input type="text" name="Title" placeholder="Title" id="title" required />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="forms__input">
                                        <p>مدرس<span>*</span></p>
                                        <input  type="text" name="Author" placeholder="Author" id="author" required>
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="forms__input">
                                <p>موضوع<span>*</span></p>
                                <input name="subject" placeholder="Subject" id="subject" required>
                               
                            </div>
                        </div>
                        <div class="forms__input">
                            <button type="submit" name="submit" id="submitButton" class="btn btn-primary">بارگذاری <i class="fa fa-upload"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="forms__all">
                        <h4>داشته های ما...</h4>
                        <div class="forms__all__things">
                            <h3>ویدیو ها</h3>
                            <ul>
                                <li>آهنگ ها
                                    <?php
                                    $S_Song = mysqli_query($DB_config,  "SELECT * FROM videos WHERE (`Kind` = 'آهنگ')");
                                    $All_Songs = mysqli_num_rows($S_Song);  // تعداد روی آهنگ ها را حساب میکند
                                    ?>
                                    <span><?= $All_Songs ?></span>
                                </li>
                                <li>آموزش
                                    <?php
                                    $S_Education = mysqli_query($DB_config, "SELECT * FROM videos WHERE (`Kind` = 'آموزش')");
                                    $All_Educaton = mysqli_num_rows($S_Education);    // تعداد روی آموزش ها را حساب میکند
                                    ?>
                                    <span><?= $All_Educaton ?></span>
                                </li>
                                <li>سرگرمی
                                    <?php
                                    $S_Entertainment = mysqli_query($DB_config, "SELECT * FROM videos WHERE (`Kind` = 'سرگرمی')");
                                    $All_Entertainmen = mysqli_num_rows($S_Entertainment);   // تعداد روی سرگرمی ها را حساب میکند
                                    ?>
                                    <span><?= $All_Entertainmen ?></span>
                                </li>
                                <li>اخبار
                                    <?php
                                    $S_News = mysqli_query($DB_config, "SELECT * FROM videos WHERE (`Kind` = 'اخبار')");
                                    $All_News = mysqli_num_rows($S_News);    // تعداد روی اخبار را حساب میکند
                                    ?>
                                    <span><?= $All_News ?></span>
                                </li>
                            </ul>
                            <div class="forms__total">تمام ویدیو ها
                                <span><?php echo $All_Songs + $All_Educaton + $All_Entertainmen + $All_News; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- forms  ختم بخش -->
    <?php
    include '../tools/footer.php'; // فایل فوتر 
    include '../tools/scripts.php'; // فایل اسکرپت ها 
    ?>
</body>

</html>
<?php
$DB_config->close(); // قطع ارتباط با دیتابیس 
?>