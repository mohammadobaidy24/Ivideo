<?php
include '../tools/DB_config.php'; //  فایل ارتباط با دیتابیس 
$showed_videos = $_POST['row']; // گرفتن تعداد ویدیو های نمایش داده شده 
$video_per_page = 18; // تعداد ویدیو ها برای نمایش بعدی 
 // Select The Songs Between Showed Videos and Number of Items To Show  انتخاب آهنگها بعد از تعداد نمایش داده شده           
$S_F_S= mysqli_query($DB_config, "SELECT * from videos WHERE (`Kind` = 'آهنگ')  ORDER BY `Timestamp` desc limit  " . $showed_videos . "," . $video_per_page);
while ($S_F_S_row = mysqli_fetch_array($S_F_S)) {
    $S_F_S_ID = $S_F_S_row['ID'];  // آی دی 
    $S_F_S_Name = $S_F_S_row['Name'];  // نام فایل 
    $S_F_S_Title = $S_F_S_row['Title'];  // عنوان 
    $S_F_S_Author = $S_F_S_row['Author'];  //تدریس کننده 
    $S_F_S_Subject = $S_F_S_row['Subject'];  // موضوع 
    $S_F_S_Owner = $S_F_S_row['Owner']; //صاحب 
    $S_F_S_Kind = $S_F_S_row['Kind']; // نوعیت 
    $S_F_S_Tumbnail  =  "../DB/$S_F_S_Kind/$S_F_S_Subject/$S_F_S_Author/$S_F_S_Name.jpg "; // تصویر 
    $S_Owner = mysqli_query($DB_config, "SELECT `FirstName`,`LastName` From `accounts` where `ID`=$S_F_S_Owner");
    $S_Owner_Result = mysqli_fetch_assoc($S_Owner);
    $S_F_S_Owner_Name = "$S_Owner_Result[FirstName] $S_Owner_Result[LastName]";
    ?>
    <div class="col-lg-4 col-md-6 col-sm-6 videosdiv" id="post_<?= $S_F_S_ID?>">
        <figure class="figure all_videos__item bg-light"> <!-- Bootstrap Figure -->
            <a href="../player/index.php?id=<?= $S_F_S_ID  ?>#player">
                <div class="all_videos__item__pic">
                    <img src="<?= $S_F_S_Tumbnail ?>" class="figure-img img-thumbnail rounded" />
                </div>
                <figcaption class="figure-caption all_videos__item__text">
                    <h5><?= $S_F_S_Title ?></h5>
                    <h6><?= $S_F_S_Author ?></h6>
                    <p><?=  $S_F_S_Owner_Name ?></p>
                </figcaption>
            </a>
        </figure>
    </div>
<?php

}
