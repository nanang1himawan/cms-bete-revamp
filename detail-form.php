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
                                    <h1 class="h4 mt-1">Form Detail</h1>
                                </center>
                            </div>

                        </div> <!-- Row end  -->

                    </div>
                </div>
                <div class="alert alert-success" id="idSuccess" role="alert" style="display: none;">
                    Create Organizer Berhasil
                </div>
                <div class="card mb-3">

                    <?php

                    include "controller/controllerGuest.php";
                    $main = new controllerGuest();
                    $idForm = $_GET["formDetail"];
                    $hasil = $main->getDetailFormById($idForm);
                    foreach ($hasil as $data) {
                        $id = $data["id"];
                    }
                    ?>
                    <div class="card-body">


                        <ul class="nav nav-tabs tab-body-header rounded d-inline-flex mb-3" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-bs-toggle="modal" data-bs-target="#addTicket">Add New Field</a></li>
                        </ul>
                        <div class="tab-content">
                            <!-- OrderHistorytab End -->
                            <div class="tab-pane fade show active" id="TradeHistory">
                                <table id="ordertabthree" class="priceTable table table-hover custom-table-2 table-bordered align-middle mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Label</th>
                                            <th>Type</th>
                                            <th>State</th>
                                            <th>Placeholder</th>
                                            <th>Min-Length</th>
                                            <th>Max-Length</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        // include "controller/controllerGuest.php";
                                        // $main = new controllerGuest();

                                        $hasil = $main->getDetailFormById($idForm);
                                        foreach ($hasil as $data) {
                                            $id = $data["id"];
                                            $label = $data["label"];
                                            $type = $data["type"];
                                            $state = $data["state"];
                                            $placeholder = $data["placeholder"];
                                            $min = $data["minlength"];
                                            $max = $data["maxlength"];

                                            echo "<tr>
                                                <td>" . $label . "</td>
                                                <td>" . $type . "</td>
                                                <td>" . $state . "</td>
                                                <td>" . $placeholder . "</td>
                                                <td>" . $min . "</td>
                                                <td>" . $max . "</td>
                                                <td><button type=\"button\" class=\"btn btn-warning\" data-bs-toggle=\"modal\" data-bs-target=\"#editDataField" . $id . "\">Edit Data</button>
                                                <button type=\"button\" class=\"btn btn-danger\">Delete</button></td>

                                            </tr>
                                            ";

                                            echo "
                                            
                                            <div class=\"modal fade\" id=\"editDataField" . $id . "\" tabindex=\"-1\" aria-hidden=\"true\">
                                                    <div class=\"modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable\">
                                                        <div class=\"modal-content\">
                                                            <div class=\"modal-header\">
                                                                <h5 class=\"modal-title  fw-bold\" id=\"expeditLabel1111\"> Category Ticket</h5>
                                                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"></button>
                                                            </div>
                                                            <div class=\"modal-body\">

                                                                <div class=\"deadline-form\">
                                                                    <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                                                                        <input type=\"hidden\" name=\"idForm\" value=\"".$idForm."\" >
                                                                        <input type=\"hidden\" name=\"idDetail\" value=\"".$id."\" >
                                                                        <div class=\"row g-3 mb-3\">
                                                                            <div class=\"col-sm-12\">
                                                                                <label for=\"item100\" class=\"form-label\">Label</label>
                                                                                <input type=\"text\" name=\"label\" value=\"".$label."\" class=\"form-control\" id=\"item100\">
                                                                            </div>
                                                                            <div class=\"col-md-6\" id=\"typeComp\">
                                                                                <label for=\"validationCustom04\" class=\"form-label\">Type</label>
                                                                                <select name=\"type\" class=\"form-select\" id=\"validationCustom04\">
                                                                                    <option selected value=\"".$type."\">$type</option>
                                                                                    <option value=\"text\">Text</option>
                                                                                    <option value=\"number\">Number</option>
                                                                                    <option value=\"phone\">Phone</option>
                                                                                    <option value=\"email\">Email</option>
                                                                                    <option value=\"image\">Image</option>
                                                                                    <option value=\"file\">File</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class=\"col-sm-12\">
                                                                                <label for=\"item100\" class=\"form-label\">State</label>
                                                                                <input type=\"text\" name=\"state\" value=\"".$state."\" class=\"form-control\" id=\"item100\" required>
                                                                            </div>
                                                                            <div class=\"col-sm-12\">
                                                                                <label for=\"item100\" class=\"form-label\">Placeholder</label>
                                                                                <input type=\"text\" name=\"placeholder\" value=\"".$placeholder."\" class=\"form-control\" id=\"item100\" required>
                                                                            </div>
                                                                            <div class=\"col-sm-12\">
                                                                                <label for=\"item100\" class=\"form-label\">Min-Length</label>
                                                                                <input type=\"number\" placeholder=\"Optional\" name=\"minlength\" value=\"".$min."\" class=\"form-control\" id=\"item100\" required>
                                                                            </div>
                                                                            <div class=\"col-sm-12\">
                                                                                <label for=\"item100\" class=\"form-label\">Max-Length</label>
                                                                                <input type=\"number\" placeholder=\"Optional\" name=\"maxlength\" value=\"".$max."\" class=\"form-control\" id=\"item100\" required>
                                                                            </div>
                                                                        </div>
                                                                </div>

                                                            </div>
                                                            <div class=\"modal-footer\">
                                                                <button type=\"button\" class=\"btn btn-secondary\" data-bs-dismiss=\"modal\">Cancel</button>
                                                                <button type=\"submit\" name=\"editDataField\" class=\"btn btn-primary\">Save</button>
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

                                <!-- Modal Edit -->
                                <div class="modal fade" id="addTicket" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title  fw-bold" id="expeditLabel1111"> Category Ticket</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="deadline-form">
                                                    <form action="save.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="idForm" value="<?php echo $idForm; ?>" >
                                                        <div class="row g-3 mb-3">
                                                            <div class="col-sm-12">
                                                                <label for="item100" class="form-label">Label</label>
                                                                <input type="text" name="label" class="form-control" id="item100" required>
                                                            </div>
                                                            <div class="col-md-6" id="typeComp">
                                                                <label for="validationCustom04" class="form-label">Type</label>
                                                                <select name="type" class="form-select" id="validationCustom04">
                                                                    <option selected disabled value="">Choose...</option>
                                                                    <option value="text">Text</option>
                                                                    <option value="number">Number</option>
                                                                    <option value="phone">Phone</option>
                                                                    <option value="email">Email</option>
                                                                    <option value="date">Date</option>
                                                                    <option value="image">Image</option>
                                                                    <option value="file">File</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="item100" class="form-label">State</label>
                                                                <input type="text" name="state" class="form-control" id="item100" required>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="item100" class="form-label">Placeholder</label>
                                                                <input type="text" name="placeholder" class="form-control" id="item100" required>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="item100" class="form-label">Min-Length</label>
                                                                <input type="number" placeholder="Optional" name="minlength" class="form-control" id="item100">
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="item100" class="form-label">Max-Length</label>
                                                                <input type="number" placeholder="Optional" name="maxlength" class="form-control" id="item100">
                                                            </div>
                                                        </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" name="saveField" class="btn btn-primary">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal edit form -->
                                

                            </div>

                        </div>

                    </div>



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