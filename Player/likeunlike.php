<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
include '../tools/session.php'; //  فایل معلوم کننده یوزر وارد شه
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
 

$Video_ID = $_POST['video_id'];   // آی دی ویدیو 
$type = $_POST['type'];  // (نوعیت ( لایک یا ان لایک 

// چک میکند که ویدیو توسط یوزر لاگ ان شده لایک یا ان لایک شده یانی
$Qurey = mysqli_query($DB_config, "SELECT * FROM like_unlike WHERE postid=" . $Video_ID . " and userid=" . $S_L_U_ID);
if (mysqli_fetch_array($Qurey)) { // اگر لایک یا ان لایک شده بود آنرا آپدیت میکند 
    mysqli_query($DB_config, "UPDATE like_unlike SET type=" . $type . " where userid=" . $S_L_U_ID . " and postid=" . $Video_ID);
} else {  // در غیر آن یک دیتای نو وارد دیتابیس میکند 
    mysqli_query($DB_config, "INSERT INTO like_unlike(userid,postid,type) values(" . $S_L_U_ID . "," . $Video_ID . "," . $type . ")");
}

// Count total loves     مجموع لایک ها را حساب میکند  
$C_T_L = mysqli_query($DB_config, "SELECT COUNT(*) AS cntlike FROM like_unlike WHERE `type`='1' and postid=" . $Video_ID);
$C_T_L_row = mysqli_fetch_array($C_T_L);
$C_T_L_Total_Like = $C_T_L_row['cntlike'];
// Count total disloves    تعداد ان لایک را حساب میکند
$C_T_D = mysqli_query($DB_config, "SELECT COUNT(*) AS cntunlike FROM like_unlike WHERE `type`='0' and postid=" . $Video_ID);
$C_T_D_row = mysqli_fetch_array($C_T_D);
$C_T_D_Total_Dislike = $C_T_D_row['cntunlike'];

$return_arr = array("likes" => $C_T_L_Total_Like, "unlikes" => $C_T_D_Total_Dislike);
//  دوباره تعداد مجموع لایک ها و ان لایک ها را برمیگرداند
echo json_encode($return_arr);
