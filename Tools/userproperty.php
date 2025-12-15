 <?php // نشان میدهد معلومات در باره یوزر وارد شده 
 // Select Logined User انتخاب یوزر وارد شده از دیتابیس
 session_start();
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
      