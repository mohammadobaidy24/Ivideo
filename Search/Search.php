<?php
include '../tools/DB_config.php'; //   فایل ارتباط با دیتابیس
?>
<!DOCTYPE html>
<html lang="utf-8">

<head>
    <title>جستجو - iVideo</title>
    <?php
    include '../tools/meta.php'; // فایل  مشخصات میتا صفحه
    include '../tools/stylesheet.php'; // فایل مشخصات سی اس اس
    include '../tools/userproperty.php'; // فایل مشخصات یوزر وارد شده
    ?>
</head>

<body>
    <?php
    include '../tools/header.php'; //   فایل عنوان بالایی و محوطه سمت یابی پیوند ها 
    include '../tools/humberger.php'; // فایل مینویی موبایل 
    include '../tools/hero.php'; // فایل دسته بندی ها، جستجو و تاریخ
    ?>

    <!-- Breadcrumb آغاز -->
    <section class="breadcrumb-section container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>جستجو</h2>
                        <div class="breadcrumb__option">
                            <a href="../index.php"><i class="fa fa-home"> </i> خانه</a>
                            <a href="#"><i class="fa fa-Search"> </i> جستجو</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb ختم  -->

    <!-- آغاز بخش نتیجه ویدیو ها  -->
    <section class="product spad profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <?php $Search_Txt = $_GET['search'];
                    $Search_query = mysqli_query($DB_config, "SELECT * from videos WHERE (`Title` LikE '%" . $Search_Txt . "%')
                     OR (`Author` LikE '%" . $Search_Txt . "%')OR (`Kind` LikE '%" . $Search_Txt . "%') OR (`Subject` LikE '%" . $Search_Txt . "%')");
                    $allresult = mysqli_num_rows($Search_query); ?>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="filter__found jumbotron">
                                    <div class="section-title ">
                                        <h2><?= $Search_Txt ?></h2>
                                    </div>
                                    <h6>
                                        <span class="badge badge-dark"><?= $allresult ?></span> ویدیو یافت شد</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($allresult > 0) { ?>
                        <div class="row">
                            <?php
                                while ($Search_row = mysqli_fetch_array($Search_query)) {
                                    $Search_ID = $Search_row['ID'];
                                    $Search_Name = $Search_row['Name'];
                                    $Search_Title = $Search_row['Title'];
                                    $Search_Author = $Search_row['Author'];
                                    $Search_kind = $Search_row['Kind'];
                                    $Search_Subject = $Search_row['Subject'];
                                    $Search_Owner = $Search_row['Owner'];
                                    $Search_Thumbnail = "../DB/$Search_kind/$Search_Subject/$Search_Author/$Search_Name.jpg"; ?>
                                <div class="col-lg-3 col-md-6 col-sm-10 ">
                                    <figure class="figure all_videos__item bg-light">
                                        <a href="../player/index.php?id=<?= $Search_ID ?>#player">
                                            <div class="all_videos__item__pic">
                                                <img src='<?= $Search_Thumbnail ?>' class='figure-img img-thumbnail rounded' />
                                            </div>
                                            <figcaption class="figure-caption all_videos__item__text">
                                                <h5><?= $Search_Title ?></h5>
                                                <h6><?= $Search_Author ?></h6>
                                                <p><?= $Search_Subject ?></p>
                                            </figcaption>
                                        </a>
                                    </figure>
                                </div>
                            <?php }  ?>
                        </diV>
                </div>
            <?php } else { ?>
                <div class="section-title ">
                    <h2>بی نتیجه</h2>
                </div>
                <div class="all_videos__item__text card-body">
                    <p> <b>هیچ نتیجه یافت نشد.<br> دوباره کوشش نمائید. </b> </p>
                </div>
                <div class="footer__widget">
                    <div class="footer__Search">
                        <form method="GET" action="../Search/Search.php#Searched">
                            <input type="text" placeholder="چی میخواهید؟" name="Search" required />
                            <button type="submit" value="Search"><span class="fa fa-Search"></span></button>
                        </form>
                    </div>
                </div>
            <?php } ?>
            </div>

    </section>
    <!-- Product Section End -->






    <?php
    include '../tools/footer.php';
    include '../tools/scripts.php';
    ?>
</body>

</html>
<?php
$DB_config->close();
?>