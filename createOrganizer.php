<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::BETE:: Manage Organizer </title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/cryptoon.style.min.css">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['status'])) {
    } else {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=auth-signin.php">';
        exit;
    }
    ?>
    <div id="cryptoon-layout" class="theme-orange">

        <!-- sidebar -->
        <?php include "inc/slidebar.php" ?>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <?php include "inc/header.php" ?>

            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-1">

                <div class="body-header border-bottom d-flex py-3">
                    <div class="container-xxl">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Pretitle -->
                                <center>
                                    <h1 class="h4 mt-1">Create Organizer</h1>
                                </center>
                            </div>

                        </div> <!-- Row end  -->

                    </div>
                </div>
                <div class="alert alert-success" id="idSuccess" role="alert" style="display: none;">
                    Create Organizer Berhasil
                </div>
                <div class="card mb-3">

                    <div class="card-body">
                        <form action="save.php" id="basic-form" method="post" novalidate>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Nama</label>
                                        <input name="name" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Alamat Email</label>
                                        <input name="email" type="email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="address" class="form-control" rows="5" cols="30" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Nomor Telepon</label>
                                        <input name="phone" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">NPWP</label>
                                        <input name="id_npwp" type="text" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <center>
                                <button name="buttonCreateOrganizer" type="submit" class="btn btn-primary">Create</button>
                            </center>
                        </form>
                    </div>
                </div>




                <!-- <div class="container-xxl">
            <div class="row g-3">
                <div class="d-flex justify-content-center align-items-center auth-h100">
                    <div class="d-flex flex-column">
                        <h1>Input Guest Name</h1>
                        <ul class="nav nav-pills mt-4" role="tablist">
                            
                        </ul>
                        <div class="tab-content mt-4 mb-3">
                            <div class="tab-pane fade show active">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <form  action="save.php" required method="POST">
                                            <div class="mb-3">
                                                <label class="form-label fs-6">Name</label>
                                                <input type="text" name="name" class="form-control">
                                            </div>
                                            <button type="submit" name="saveGuest" class="btn btn-primary text-uppercase py-2 fs-5 w-100 mt-2">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <a href="auth-signin.html" title="#">Already registered?<span class="text-secondary text-decoration-underline">View All Guest</span></a>
                    </div>
                </div>

                
            </div>

        </div> -->
            </div>
        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <!-- <script src="assets/bundles/dataTables.bundle.js"></script> -->
    <!-- <script src="assets/bundles/apexcharts.bundle.js"></script> -->

    <!-- Jquery Page Js -->
    <!-- <script src="js/template.js"></script> -->
    <!-- <script src="js/page/index.js"></script> -->
</body>

</html>