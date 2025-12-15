<?php
$DB_host = "iVideo.com";                   // نام هاست دیتابیس
$DB_user = "Habibullahobaidy1";            // نام کاربری استفاده کننده 
$DB_password = "Habibullahobaidy!@#$%";    // رمز استفاده کننده
$DB_name = "iVideo_db";                  // نام دیتابیس
$DB_config = mysqli_connect($DB_host, $DB_user, $DB_password, $DB_name); // عملیه وصل شدن به دیتابیس
if (!$DB_config) {                         // اگر به دیتابیس وصل نشده بود
    die("Connection failed: " . mysqli_connect_error());    //این خطا را نمایش میدهد
};
