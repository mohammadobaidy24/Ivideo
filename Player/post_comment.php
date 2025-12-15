<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
include '../tools/session.php'; //  فایل معلوم کننده یوزر وارد شه if (isset($_SESSION['username'])){
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

if (isset($_POST['comment']) && isset($_POST['video_id'])) {  //  اگر کمنت و آی دی ویدیو موجود بود 
  $comment = $_POST['comment'];
  $postid = $_POST['video_id'];
  $insert = " INSERT INTO `comments`(`id`, `userid`, `postid`, `comment`, `post_time`) 
  VALUES ('','$S_L_U_ID','$postid','$comment',CURRENT_TIMESTAMP)";
  mysqli_query($DB_config, $insert);
  // Select Video Comments   انتخاب کمنت های ویدیو
  $S_V_C = mysqli_query($DB_config,  "SELECT * from comments where postid='$postid' and comment='$comment'");
  if ($S_V_C_row = mysqli_fetch_array($S_V_C)) {
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
<?php
    }
  }
  exit;
}
?>