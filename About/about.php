<?php
include '../tools/DB_config.php';  //   فایل ارتباط با دیتابیس
$Path =  'About/about.php';  //آدرس صفحه 
?>
<!DOCTYPE html>
<html lang="utf-8">

<head>
    <title>در باره ما - iVideo</title> <!-- عنوان صفحه -->
    <?php include '../tools/meta.php';   // فایل  مشخصات میتا صفحه 
    include '../tools/stylesheet.php';  // فایل مشخصات سی اس اس
    include '../tools/userproperty.php'; // فایل مشخصات یوزر وارد شده
    ?>
</head> <!--  ختم عنوان  -->

<body>
    <!-- آغاز بدنه -->
    <?php include '../tools/header.php';  // فایل عنوان بالایی و محوطه سمت یابی پیوند ها
    include '../tools/humberger.php';  // فایل مینویی موبایل
    include '../tools/hero.php';  // فایل دسته بندی ها، جستجو و تاریخ
    ?>
    <!-- Breadcrumb آغاز -->
    <section class="breadcrumb-section container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <!-- صفحه باز بوده ره مشخص میکند  -->
                        <h2>در باره ما</h2>
                        <div class="breadcrumb__option">
                            <a href="../index.php"><i class="fa fa-home"> </i> خانه</a>
                            <a href="#"><i class="fa fa-info-circle"> </i> درباره ما</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb ختم  -->
    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-10">
                    <div class="card text-center">
                        <div class="card-header ">
                            <h2>مدیر سایت</h2>
                        </div>
                        <div class="card-img-top">
                            <img src="../img/ho1-pic.JPG" alt="HO1" class="img-thumbnail">
                            <div>
                                <div class="card-body">
                                    <h4><b>حبیب الله عبیدی</b></h4>
                                    <p>مدیر عامل، طراح و سازنده ویدیوی من</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->
    <!-- آغاز بخش اهداف سایت -->
    <section class="about spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <section class="about__header jumbotron text-center">
                        <h1>ویدیوی من</h1>
                        <h2>مأموریت ما این است که صدای مردم را به دنیا رسانده و دنیا را به مردم نشان دهیم.</h2>
                        <p>ما معتقدیم که همه سزاوار صدای هستند و دنیا جای بهتر خواهد شد وقتیکه ما به این صدا گوش بدهیم، به اشتراک بگذاریم و بسازیم جامعه را توسط این اطلاعات.</p>
                    </section>
                    <section class="freedoms">
                        <h2 class="alert alert-primary text-center">ارزش های ما بر اساس چهار آزادی ضروری است که تعریف میکند که ما کی هستیم.</h2>
                        <div class="freedoms__item left card">
                            <h3 class="freedoms__title card-header">آزادی تجربه کردن </h3>
                            <p class="freedoms__copy card-body">ما معتقدیم مردم باید بتوانند به طور آزادانه صحبت نمایند، به اشتراک بگذارند نظرات شان را، و تجربیات خود را به دنیا نشان بدهند.</p>
                        </div>
                        <div class="freedoms__item right card">
                            <h3 class="freedoms__title card-header">آزادی اطلاعات </h3>
                            <p class="freedoms__copy card-body">ما معتقدیم که همه باید راه آسان و دسترسی به اطلاعات را در دست داشته باشند و ویدیو نیروی قدرتمند برای آموزش ، پخش و نشر اطلاعات است .</p>
                        </div>
                        <div class="freedoms__item left card">
                            <h3 class="freedoms__title card-header">آزادی فرصت</h3>
                            <p class="freedoms__copy card-body">ما معتقدیم که همه باید فرصتی برای کشف، ساختن کسب کار و مؤفقیت در شرایت خود را داشته باشند، و ویدیو بهترین فرصت برای پخش و نشر خلاقیت ها است.</p>
                        </div>
                        <div class="freedoms__item right card">
                            <h3 class="freedoms__title card-header">آزادی متعلق</h3>
                            <p class="freedoms__copy card-body">ما معتقدیم که همه باید بتوانند ویدیو های خود را با ذکر نام خود به نشر برساند تابتوانند خود و روش کار خود را به دبیا نشان بدهند .</p>
                        </div>
                    </section>
                    <p class="text-center">تیم ویدیوی من :)</p>
                </div>
            </div>
        </div>
    </section>
    <!-- ختم اهداف سایت -->
    <?php
    include '../tools/footer.php';  // فایل فوتر
    include '../tools/scripts.php';  // فایل اسکرپت ها 
    ?>
</body>

</html>
<?php
$DB_config->close();  // قطع ارتباط با دیتابیس
?>