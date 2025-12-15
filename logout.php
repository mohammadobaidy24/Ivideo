<!DOCTYPE html>
<html lang="utf-8">

<head>
    <title>Goodbye - iVideo</title>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <H1> Have a Nice Time </h1>
    <?php
    include 'tools/scripts.php';
    ?>
</body>

</html>

<?php
session_start();
session_destroy();
unset($_SESSION['username']);
unset($_SESSION['userid']);
header("location: signin/index.php");
