<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::BETE:: Manage Ticket Category</title>
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
                                    <h1 class="h4 mt-1">Ticket Category List</h1>
                                </center>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card mb-3">
                    <?php
                    include "controller/controllerGuest.php";
                    $main = new controllerGuest();
                    $idEvent = $_GET["event"];
                    $hasil = $main->getDataEventById($idEvent);
                    foreach ($hasil as $data) {
                        $id = $data["id"];
                    }
                    ?>

                    <div class="card-body">
                        <button type="button" class="btn btn-warning btn-lg text-white" data-bs-toggle="modal"
                            data-bs-target="#addTicket">Add</button>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="TradeHistory">
                                <table id="ordertabthree"
                                    class="priceTable table table-hover custom-table-2 table-bordered align-middle mb-0"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>price</th>
                                            <th>stock</th>
                                            <th>status</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $hasil = $main->getDataTicketByIdEvent($idEvent);
                                        foreach ($hasil as $data) {
                                            $id = $data["id"];
                                            $name = $data["name"];
                                            $price = $data["price"];
                                            $stock = $data["stock"];
                                            $status = $data["status"];

                                            echo "<tr>
                                                <td>" . $name . "</td>
                                                <td>Rp. " . $price . "</td>
                                                <td>" . $stock . "</td>
                                                <td>" . $status . "</td>
                                                <td>
                                                    <button type=\"button\" class=\"btn btn-warning text-white\" data-bs-toggle=\"modal\" data-bs-target=\"#editTicket" . $id . "\">Edit Data</button>
                                                    <button type=\"button\" class=\"btn btn-danger text-white\">Delete</button>
                                                </td>
                                            </tr>
                                            ";

                                            echo "
                                            <!-- Modal Edit -->
                                            <div class=\"modal fade\" id=\"editTicket" . $id . "\" tabindex=\"-1\" aria-hidden=\"true\">
                                                <div class=\"modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable\">
                                                    <div class=\"modal-content\">
                                                        <div class=\"modal-header\">
                                                            <h5 class=\"modal-title  fw-bold\" id=\"expeditLabel1111\">Edit Ticket
                                                                Category
                                                            </h5>
                                                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"
                                                                aria-label=\"Close\"></button>
                                                        </div>
                                                        <div class=\"modal-body\">
                                                            <div class=\"deadline-form\">
                                                                <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                                                                    <input type=\"hidden\" name=\"idEvent\" value=\"" . $idEvent . "\">
                                                                    <input type=\"hidden\" name=\"idTicket\" value=\"" . $id . "\" >
                                                                    <input type=\"hidden\" name=\"currentStock\" value=\"" . $stock . "\" >
                                                                    <div class=\"row g-3 mb-3\">
                                                                        <div class=\"col-sm-12\">
                                                                            <label for=\"item100\" class=\"form-label\">Name</label>
                                                                            <input type=\"text\" name=\"name\" class=\"form-control\"
                                                                                id=\"item100\" value=\"" . $name . "\">
                                                                        </div>
                                                                        <div class=\"col-sm-12\">
                                                                            <label for=\"item100\" class=\"form-label\">Price</label>
                                                                            <input type=\"number\" name=\"price\" class=\"form-control\"
                                                                                id=\"item100\" value=\"" . $price . "\">
                                                                        </div>
                                                                        <div class=\"col-sm-12\">
                                                                            <label for=\"item100\" class=\"form-label\">Stock</label>
                                                                            <input type=\"number\" name=\"newStock\" class=\"form-control\"
                                                                                id=\"item6\" value=\"" . $stock . "\">
                                                                            <a style=\"color: red; font-style: italic;\">*ticket stock cannot be reduced.</a>
                                                                        </div>
                                                                        <div class=\"col-sm-12\">
                                                                            <label for=\"item100\" class=\"form-label\">Ticket
                                                                                Status</label>
                                                                            <select class=\"form-select\" id=\"ticketStatus\"
                                                                                name=\"status\">
                                                                                <option selected value=\"" . $status . "\">$status</option>
                                                                                <option value=\"open\">Open</option>
                                                                                <option value=\"close\">Close</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class=\"modal-footer\">
                                                            <button type=\"button\" class=\"btn btn-secondary\"
                                                                data-bs-dismiss=\"modal\">Cancel</button>
                                                            <button type=\"submit\" name=\"updateTicketCategory\"
                                                                class=\"btn btn-primary\">Update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            ";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <!-- Modal New -->
                                <div class="modal fade" id="addTicket" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title  fw-bold" id="expeditLabel1111">New Ticket
                                                    Category
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="deadline-form">
                                                    <form action="save.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="idEvent"
                                                            value="<?php echo $idEvent; ?>">
                                                        <div class="row g-3 mb-3">
                                                            <div class="col-sm-12">
                                                                <label for="item100" class="form-label">Name</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    id="item100" placeholder="e.g. VIP">
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="item100" class="form-label">Price</label>
                                                                <input type="number" name="price" class="form-control"
                                                                    id="item100" placeholder="e.g. 25000">
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="item100" class="form-label">Stock</label>
                                                                <input type="number" name="stock" class="form-control"
                                                                    id="item100" placeholder="e.g. 50">
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <label for="item100" class="form-label">Ticket
                                                                    Status</label>
                                                                <select class="form-select" id="ticketStatus"
                                                                    name="status">
                                                                    <option selected disabled>Select...</option>
                                                                    <option value="open">Open</option>
                                                                    <option value="close">Close</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" name="saveTicket"
                                                    class="btn btn-primary">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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