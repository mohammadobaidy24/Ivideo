<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories"><!-- مینو دسته بندی ها -->
                    <div class="hero__categories__all  btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span>دسته بندی ها</span>
                    </div>
                    <ul class="border border-dark rounded bg-primary">
                        <b><i class="fa fa-music"> </i> آهنگ ها</b>
                        <?php // Select Sabject Of Songs انتخاب موضوع آهنک ها 
                        $S_S_O_S = mysqli_query($DB_config,"SELECT DISTINCT(Subject) As Subject from videos where `Kind` = 'آهنگ'");
                        while ($S_S_O_S_row = mysqli_fetch_array($S_S_O_S)) {
                            $S_S_O_S_subject = $S_S_O_S_row['Subject'];
                            ?>
                            <li><a href="../Search/search.php?search=<?= $S_S_O_S_subject ?>"><i class="fa fa-mail-reply"> </i> <?= $S_S_O_S_subject ?>  </a></li>
                        <?php } ?>

                        <b><i class="fa fa-mortar-board"> </i> آموزش ها</b>
                        <?php // Select Sabject Of Educations انتخاب موضوع ویدیو های آموزشی
                        $S_S_O_E = mysqli_query($DB_config, "SELECT DISTINCT(Subject) As Subject from videos where `Kind` = 'آموزش'");
                        while ($S_S_O_E_row = mysqli_fetch_array($S_S_O_E)) {
                            $S_S_O_E_subject = $S_S_O_E_row['Subject'];
                            ?>
                            <li><a href="../Search/search.php?search=<?= $S_S_O_E_subject ?>"><i class="fa fa-mail-reply"> </i> <?= $S_S_O_E_subject ?></a></li>
                        <?php } ?>
                        <b><i class="fa fa-film"> </i> سرگرمی</b>
                        <?php //Select Sabject Of Entertainment انتخاب موضوع ویدیوهای سرگرمی
                        $S_S_O_En = mysqli_query($DB_config, "SELECT DISTINCT(Subject) As Subject from videos where `Kind` = 'سرگرمی'");
                        while ($S_S_O_En_row = mysqli_fetch_array($S_S_O_En)) {
                            $S_S_O_En_subject = $S_S_O_En_row['Subject'];
                            ?>
                            <li><a href="../Search/search.php?search=<?= $S_S_O_En_subject ?>"><i class="fa fa-mail-reply"> </i><?= $S_S_O_En_subject ?></a></li>
                        <?php } ?>
                        <b><i class="fa fa-newspaper-o"> </i> اخبار</b>
                        <?php //Select Sabject Of News انتخاب موضوع ویدیوهای اخبار
                        $S_S_O_N = mysqli_query($DB_config, "SELECT DISTINCT(Subject) As Subject from videos where `Kind` = 'اخبار'");
                        while ($S_S_O_N_row = mysqli_fetch_array($S_S_O_N)) {
                            $S_S_O_N_subject = $S_S_O_N_row['Subject'];
                            ?>
                            <li><a href="../Search/search.php?search=<?= $S_S_O_N_subject ?>"><i class="fa fa-mail-reply"> </i><?= $S_S_O_N_subject ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 h-50">
                <div class="hero__search"> <!-- بخش جستجو -->
                    <div class="hero__search__form">
                        <form method="GET" action="../search/search.php">
                            <input type="text" class="form-control-plaintext rounded" placeholder="در ذهن تان چیست؟" name="search" required />
                            <button type="submit" class="btn btn-primary" value="SEARCH">جستجو</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 h-50">
                <div class="hero__date bg-primary rounded"> <!-- بخش تاریخ زمان -->
                    <div class="hero__date__text">
                        <span id="time" class="text-light"></span>
                        <br>
                        <script> // عملیه داده شده را در زمان داده شده تکرار میکند setInterval 
                            var myVar = setInterval(myTimer, 1000); //  در هر ثانیه تکرار میکند function myTimer()
                            function myTimer() {// آغاز عملگر ساعت
                                var d = new Date()
                                document.getElementById("time").innerHTML = d.toLocaleTimeString();
                                // ساعت را در المنت  که ای دیش تایم است به صورت ساعت ساده نشان میدهد 
                            }
                        </script>
                        <span class="text-light"><?php echo date("D d M");?></span>
                        
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Hero Section End -->