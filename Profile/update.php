<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
include '../tools/session.php'; //  فایل معلوم کننده یوزر وارد شه
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

$id = $_POST['playpostid'];

$select_video = "select * from videos where ID = $id";
$query_this_video = mysqli_query($DB_config, $select_video);
$video_row = mysqli_fetch_assoc($query_this_video);
    $playpostid = $video_row['ID'];
    $playname = $video_row['Name'];
    $playTitle = $video_row['Title'];
    $playAuthor = $video_row['Author'];
    $playsubject = $video_row['Subject'];
    $playkind = $video_row['Kind'];
    $playowner = $video_row['Owner'];
    $playimg = '../DB/' . $playkind . '/' . $playsubject . '/' . $playAuthor . '/' . $playname . '.jpg';
    $playvideo = '../DB/' . $playkind . '/' . $playsubject . '/' . $playAuthor . '/' . $playname;


$new_title = $_POST['Title'];
$new_author = $_POST['author'];
$new_subject = $_POST['subject'];
$new_kind = $_POST['kind'];
$new_playvideo = '../DB/'.$new_kind.'/'.$new_subject.'/'.$new_author.'/'.$playname;
$new_playimg = '../DB/'.$new_kind.'/'.$new_subject.'/'.$new_author.'/'.$playname.'.jpg';
$path = "../DB/" . $new_kind . "/" . $new_subject . "/" . $new_author . "/";


$update = mysqli_query($DB_config, "UPDATE `videos` set `Title`='$new_title',`Author`='$new_author',`Subject`='$new_subject',`Kind`='$new_kind' where `id`=$playpostid");
    // Create directory if it does not exist
    if (!is_dir($path)) {
        mkdir($path, 0777, TRUE);
    }
rename($playvideo, $new_playvideo); // move the file 
rename($playimg, $new_playimg); // move the file 
if ($update) {
    header('location:profile.php?un=' . $S_L_U_username . '#YourVideos');  // و دوباره به صفحه نمایه بر میگرداند
} else {
    echo "Error to updating the values";
}
