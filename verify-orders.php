<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::BETE::  Verify Orders </title>

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css"> 
    
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/cryptoon.style.min.css">
</head>
<body>
    <div id="cryptoon-layout" class="theme-orange">
        
    <?php 
        session_start();
        if(isset($_SESSION['status'])){

        }else{
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=auth-signin.php">';
        exit;
        }
    ?>

        <!-- sidebar -->
        <?php include "inc/slidebar.php" ?> 

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <?php include "inc/header.php"?>
            
            <!-- Body: Body -->
            
            <?php 

            if (isset($_GET['event'])) {
                include "inc/verify-page.php";
            } else {
                include "inc/verify-page-choose.php";
            }
            
            
            ?>
            
        </div>     
    
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <script src="assets/bundles/dataTables.bundle.js"></script>
    <!-- <script src="assets/bundles/apexcharts.bundle.js"></script> -->

    <!-- Jquery Page Js -->
    <script>
         $(document).ready(function() {
        $('#ordertabthree')
        .addClass( 'nowrap' )
        .dataTable( {
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        });
    });

</script>
</body>
</html> 