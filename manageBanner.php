<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::BETE:: Verify Orders </title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/cryptoon.style.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
</head>

<body>
    <div id="cryptoon-layout" class="theme-orange">

        <?php
        session_start();
        if (isset($_SESSION['status'])) {

        } else {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=auth-signin.php">';
            exit;
        }
        ?>

        <!-- sidebar -->
        <?php include "inc/slidebar.php" ?>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <?php include "inc/header.php" ?>

            <!-- Body: Body -->
            <?php include "inc/banner.php"; ?>

        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <!-- <script src="assets/bundles/dataTables.bundle.js"></script>
    <script src="assets/bundles/apexcharts.bundle.js"></script> -->

    <!-- Jquery Page Js -->
    <!-- <script src="js/template.js"></script> -->
    <!-- <script src="js/page/index.js"></script> -->
    <!-- <script src="js/page/chart-apex.js"></script> -->
</body>

</html>