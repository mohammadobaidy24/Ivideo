<div id="preloder"></div> <!-- صفحه اولی قبل از لود سایت  -->
 <!-- Header Section Begin -->
 <header class="header">
     <div class="header__top bg-dark border-bottom border-success">
         <div class="container">
             <div class="row">
                 <div class="col-lg-8 col-md-7 col-sm-8">
                     <div class="header__top__left">
                         <ul>
                         <?php 
                         if(isset($_SESSION['username'])){  
                              ?>
                          <li>
                             <a href="../profile/profile.php?un=<?= $S_L_U_username // نام کار بری یوزر وارد شده ?>"> <!-- لینک پروفایل یوزر وارد شده -->
                            <?= $S_L_U_username ?> <img src="../DB/Users/<?= $S_L_U_profile //عکس پروفایل ?>" class="rounded-circle" /></a>
                                    </li>
                             <b class="pipline">|</b>
                             <li> <?php if($_SESSION['username'] == 'admin'){?>
                                <a href='../Admin/index.php'>مدیریت</a>
                             <?php }else{?>
                                <a href='../profile/profile.php?un=<?=$S_L_U_username?>#YourVideos'>ویدیو های شما</a>
                             <?php } ?> </li> <!-- لینک ویدیوهای یوزر وارد شده -->
                         <?php }else{
                              setcookie("path",$Path,time()+10000,"/","",0);
                             ?>
                            
 <a href="../Signin/index.php"> <!--لینک وارد شدن -->
 <i  class="fa fa-user" ></i> ورود </a>
                                    </li>
                             <b class="pipline">|</b>
                             <li ><a href="../Signin/signup.php"class="text-primary"><i  class="fa fa-edit" ></i> ثبت نام </a></li> <!-- لینک ثبت نام -->
                             <?php    }?>
                            
                         </ul>
                     </div>
                 </div>
                 
                 <div class="col-lg-4 col-md-5 col-sm-4">
                     <div class="header__top__right">
                         <ul>
                             <li><a href="../uploud/index.php"><i class="fa fa-upload"></i> بار گذاری</a></li>
                             <b class="pipline">|</b>
<?php if(isset($_SESSION['username'])){?><li><a href="../logout.php"><i class="fa fa-user"></i> خروج</a></li><?php } ?>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="main-nav  bg-dark">
         <div class="height-progress-container"> <!-- پروگرسبار ارتفاع صفحه -->
             <div class="height-progress-bar progress-bar progress-bar-striped" id="myBar"></div> <!-- نشان میدهد در کجای صفحه موقعیت داری -->
         </div>
         <div class="container">
             <div class="row"> 
                 <nav class="navbar navbar-expand-sm navbar-dark header__menu"><!-- نف بار -->
                     <!-- Brand/logo -->
                     <div class="col-lg-3 col-md-3">
                         <a class="navbar-brand header__logo " href="../index.php">
                             <img src="../img/logo.png" />
                         </a>
                     </div>
                     <!-- Links -->
                     <div class="col-lg-9 col-md-9">
                         <ul class="navbar-nav">
                             <li class="nav-item">
                                 <a class="nav-link text-light" href="../index.php"><i class="fa fa-home"> </i> خانه</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link text-light" href="../videoeducation/index.php"><i class="fa fa-mortar-board"> </i> آموزش</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link text-light" href="../videosongs/index.php"><i class="fa fa-music"> </i> آهنگ ها </a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link text-light" href="../Videoother/index.php"><i class="fa fa-film"> </i> سرگرمی</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link text-light" href="../Videonews/index.php"><i class="fa fa-newspaper-o"> </i> اخبار</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link text-light" href="../contact/contact.php"><i class="fa fa-address-book-o"> </i> ارتباط با ما</a>
                             </li>
                             <li class="nav-item">
                                 <a class="nav-link text-light" href="../about/about.php"><i class="fa fa-info-circle"> </i> در باره ما</a>
                             </li>
                         </ul>
                     </div>
                     <div class="humberger__open">
                         <i class="fa fa-bars"></i>
                     </div>
                 </nav>

             </div>
         </div>
     </div>
 </header>
 <!-- Header Section End -->