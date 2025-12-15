<?php if (count($errors) > 0) : //اگر تعداد خطا ها بیشتر از صفر شد?>
    <div>
        <?php foreach ($errors as $error) :// مجموع خطاها را به خطا های جداگانه تقسیم میکند  ?>
            <p><?php echo $error //خطا هارا در قالب پراگراف نمایش میدهد?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>