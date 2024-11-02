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

            <div class="card">
                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold ">Create and Manage Form</h6>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs tab-body-header rounded d-inline-flex mb-3" role="tablist">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addForm">Add New Form</button>
                    </ul>
                    <div class="tab-content">
                        <!-- OrderHistorytab End -->
                        <div class="tab-pane fade show active" id="TradeHistory">
                            <table id="ordertabthree"
                                class="priceTable table table-hover custom-table-2 table-bordered align-middle mb-0"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Form Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    include "controller/controllerGuest.php";
                                    $main = new controllerGuest();
                                    $idGuest = $_SESSION['id_user'];
                                    if ($_SESSION['status'] == 'BETE') {
                                        $hasil = $main->getDataForm();
                                    } else {
                                        $hasil = $main->getDataFormByGuestId($idGuest);
                                    }

                                    foreach ($hasil as $data) {
                                        $id = $data["id"];
                                        $name = $data["form_name"];

                                        echo "<tr>
                                                    <td>" . $name . "</td>
                                                    <form action=\"detail-form.php\" id=\"formDetail" . $id . "\" name=\"formDetail\"  method=\"GET\">
                                                    <input type=\"hidden\" name=\"formDetail\" value=\"$id\"/>
                                                    </form>
                                                    <td><button type=\"button\" class=\"btn btn-warning\" onclick=\"formSubmit('" . $id . "')\">Detail Form</button>
                                                    <button type=\"button\" class=\"btn btn-danger\">Delete</button></td>
                                                </tr>
                                            ";
                                        echo "
                                    
                                                <div class=\"modal fade\" id=\"editCategoryEvent" . $id . "\" tabindex=\"-1\"  aria-hidden=\"true\">
                                                    <div class=\"modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable\">
                                                    <div class=\"modal-content\">
                                                        <div class=\"modal-header\">
                                                            <h5 class=\"modal-title  fw-bold\" id=\"expeditLabel1111\"> Edit Profile</h5>
                                                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                                        </div>
                                                        <div class=\"modal-body\">
                                                            
                                                            <div class=\"deadline-form\">
                                                                <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                                                                    <input type=\"hidden\" name=\"id\" value=\"" . $id . "\"> 
                                                                    <div class=\"row g-3 mb-3\">
                                                                        <div class=\"col-sm-12\">
                                                                        <label for=\"item100\" class=\"form-label\">Name</label>
                                                                        <input type=\"text\" name=\"name\" class=\"form-control\" id=\"item100\" value=\"" . $name . "\"> 
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <div class=\"modal-footer\">
                                                                    <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">cancel</button>
                                                                    <button type=\"submit\" name=\"editCategoryEvent\" class=\"btn btn-primary\">Save</button>
                                                                </form>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                    
                                            ";
                                    }
                                    ?>
                                    <!-- <tr>
                            <td>Leo</td>
                            <td><button type="button" class="btn btn-info">Edit Data</button><button type="button" class="btn btn-danger">Delete</button></td>
                        </tr> -->
                                </tbody>
                            </table>
                        </div>

                        <div class="modal fade" id="addForm" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title  fw-bold" id="expeditLabel1111">New Form</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="deadline-form">
                                            <form action="save.php" method="POST" enctype="multipart/form-data">
                                                <!-- <input type="hidden" name="id" value="">  -->
                                                <div class="row g-3 mb-3">
                                                    <div class="col-sm-12">
                                                        <label for="item100" class="form-label">Form Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            id="item100">
                                                        <?php
                                                        echo "
                                                        <input name=\"create_by\" type=\"hidden\" value=\"" . $idGuest . "\">
                                                        ";
                                                        ?>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="addForm" class="btn btn-primary">Save</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
            </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
            </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
            </script>

    </div>

    </div>



    <script>
        function formSubmit(id) {
            document.getElementById("formDetail" + id).submit();
        }
    </script>



    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <script src="assets/bundles/dataTables.bundle.js"></script>
    <script src="assets/bundles/apexcharts.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script src="js/template.js"></script>
    <script src="js/page/index.js"></script>
    <script src="js/page/chart-apex.js"></script>
</body>

</html>