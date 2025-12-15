    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper bg-primary">
        <div class="humberger__menu__contact">

            <a href="../profile/profile.php">
                <img src="../DB/Users/<?= $profile ?>" />
                <?= $username ?>
            </a>
            <?= $email ?>
            </ul>
        </div>
        <div class="humberger__menu__widget">
            <div class="humberger__menu__user">
                <a href="../uploud/index.php"><i class="fa fa-upload"></i> بارگذاری</a>
                <a href="../logout.php"><i class="fa fa-user"></i> خروج</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li><a href="../index.php"><i class="fa fa-home"> </i> خانه</a></li>
                <li><a href="../videoeducation/index.php"><i class="fa fa-mortar-board"> </i> آموزش</a></li>
                <li><a href="../videosongs/index.php"><i class="fa fa-music"> </i> آهنگ ها </a></li>
                <li><a href="../Videoother/index.php"><i class="fa fa-film"> </i> سرگرمی</a></li>
                <li><a href="../Videonews/index.php"><i class="fa fa-newspaper-o"> </i> اخبار</a></li>
                <li><a href="../contact/contact.php"><i class="fa fa-address-book-o"> </i> ارتباط با ما</a></li>
                <li><a href="../about/about.php"><i class="fa fa-info-circle"> </i> در باره ما</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="humberger__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>

    </div>
    <!-- Humberger End -->