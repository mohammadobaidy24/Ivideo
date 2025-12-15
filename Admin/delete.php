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
    if (isset($_GET['id'])) {
        $Del_ID = $_GET['id'];
        // انتخاب ویدیو در دیتابیس
        $S_V = mysqli_query($DB_config, "SELECT * FROM videos WHERE (`ID` = '$Del_ID')");
        if ($S_V_row = mysqli_fetch_assoc($S_V)) { 
            $S_V_ID = $S_V_row['ID'];
            $S_V_Name = $rS_V_row['Name'];
            $S_V_Title = $S_V_row['Title'];
            $S_V_Author = $S_V_row['Author'];
            $S_V_Kind = $S_V_row['Kind'];
            $S_V_Subject = $S_V_row['Subject'];
            $S_V_Thumbnail = "../DB/$S_V_Kind/$S_V_Subject/$S_V_Author/$S_V_Name.jpg";
            $S_V_Video = "../DB/$S_V_Kind/$S_V_Subject/$S_V_Author/$S_V_Name";

            $Del_Video = mysqli_query($DB_config, "DELETE from `videos` where (`ID`='$S_V_ID')");  // ویدیو را از تیبل خود ویدیو پاک میکند
            $Del_Trending = mysqli_query($DB_config, "DELETE from `trending` where (`Video_id`='$S_V_ID')");  // ویدیو را از تیبل مرسوم ها پاک میکند
            $Del_Like_Unlike = mysqli_query($DB_config, "DELETE from `like_unlike` where (`postid`='$S_V_ID')");  // ویدیو را از تیبل لایک یا ان لایک ها پاک میکند
            $Del_Comment = mysqli_query($DB_config, "DELETE from `comments` where (`postid`='$S_V_ID')");  // ویدیو را از تیبل کمنت  ها پاک میکند

            if ($Del_Video && $Del_Trending && $Del_Like_Unlike && $Del_Comment) {  // اگر همه چیز پاک شد 
                unlink($S_V_Thumbnail);  //  حذف میکندعکس را 
                unlink($S_V_Video);  //  ویدیو را حذف میکند
                header('location:allvideos.php');  // و دوباره به صفحه نمایه بر میگرداند
            }
        }
    }
    ?>