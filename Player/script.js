
function ShowCMT() {  // عملیه نمایش دادن فورم کمنت را اجرا میکند 
    var x = document.getElementById("cmtDIV");
    if (x.style.display === "none") {  // اگر دسپلی نن بود 
        x.style.display = "block";   //  دسپلی آن را به بلاک تغیر میدهد
    } else {  // در غیر این صورت 
        x.style.display = "none"; // دسپلی آن را دوباره به نن تغیر میدهد
    }
}
function PostCMT() {  // عملیه ثبت و دوباره نمایش دادن کمنت را اجرا میکند 
    var user_comment = document.getElementById("comment").value; // قیمت کمنت را میگیرد از المنت که آی دی کمنت است 
    var vid_id = document.getElementById("video_id").value;  // قیمت آی دی ویدیو را از المنت که آی دی آن ویدیو _ آی دی است
    if (user_comment && video_id) {  // اگر کمنت و آی دی ویدیو موجود بود 
        $.ajax({
            type: 'post',
            url: 'post_comment.php',
            data: {  // کلمه دست چپ نام پوست می باشد و یمت راست قیمت آن
                comment: user_comment,
                video_id: vid_id
            },
            success: function (response) {  //  هنگامیکه کمنت در دیتابیس ثبت شد 
                document.getElementById("all_comments").innerHTML = response + document.getElementById("all_comments").innerHTML;
                // کمنت تازه را اول و بعدا دیگر کمنت ها را نمایش میدهد
                document.getElementById("comment").value = "";
                document.getElementById("video_id").value = "";
                // و قیمت های انپت ها را از بین میبرد
            }
        });
    }
    return false; // اگر کمنت و آی دی ویدیو داده نشده بود
}