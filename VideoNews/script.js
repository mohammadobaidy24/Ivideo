$(document).ready(function(){ // اسکرپت دکمه بیشتر 
    $('.load-more').click(function(){   //هنگامیکه بالایش کلک شد
        var row = Number($('#row').val()); // تعداد ویدیو های نمایش داده شده 
        var allcount = Number($('#all').val()); // تعداد تمام ویدیو ها ره مشخص میکند
        row = row + 18; // تعداد ویدیو های نمایش داده شده +18 جدید
        if(row <= allcount){ // اگر ویدیو های نمایش داده شده کوچک تر و مساوی به تمام ویدیو ها بود
            $("#row").val(row);
            $.ajax({// بخاطر آوردن ویدیو های جدید بدون لود شدن صفحه استفاده میکنیم ajax 
                url: 'getData.php', // فایل است که دیتای نو را میارد
                type: 'post',
                data: {row:row}, 
                beforeSend:function(){ //  قبل از آوردن دیتای جدید دکمه بیشتر را به اسپینر تبدیل میکند
                    $(".load-more").html("<i class='fa fa-spinner fa-spin'></i>");
                },
                success: function(response){  // هنگامیکه دیتای جدید آماده شد این عمل را اجرا میکند 
                    setTimeout(function() {
                        $(".videosdiv:last").after(response).show().fadeIn("fast"); // نشان میدهد ویدیوی جدید بعد از آخرین ویدیو
                        var rowno = row + 18;
                        if(rowno > allcount){ // حساب میکند که تعداد ویدیو های نمایش داده شده بزرگتر است یا نی
                            $('.load-more').html("<i class='fa fa-times'></i>");  // وقتیکه تمام ویدیو ها نمایش داده شده باشد دکمه بیشتر را به دکمه کلوز تبدیل میکند
                        }else{
                            $(".load-more").html("بیشتر..."); // اگر تعداد ویدیو نمایش داده شده کوچک تر از تمام ویدیو ها باشد دوباره دکمه بیشتر را نمایش میدهد 
                        }
                    }, 1800);  //   تأخیر ایجاد میکند برای نمایش دادن  ویدیو های جدید 
                }
            }); // Ajax End
        }else{
            $('.load-more').html("<i class='fa fa-spinner fa-spin'></i>");
            setTimeout(function() { // هنگامیکه دیتای جدید مساوی با تمام دیتا شد 
                $('.videosdiv:nth-child(18)').nextAll('.videosdiv').remove().fadeIn("slow"); // تمام دیتای جدید را حذف نموده و ویدیو های اولی را جا میگذارد 
                $("#row").val(0);  // قیمت ویدیو های جدید برای نمایش را به صفر تبدیل میکند
                 $(".load-more").html("بیشتر...");  // و تبدیل میکند دکمه کلوز را به دکمه بیشتر
            }, 1800);
        }
    });
});