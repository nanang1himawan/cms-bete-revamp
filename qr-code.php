<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::BETE:: Manage QR Qode</title>
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

                <div class="body-header d-flex py-3">
                    <div class="container-xxl">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Pretitle -->
                                <center>
                                    <h1 class="h4 mt-1">QR Code Information</h1>
                                </center>
                            </div>

                        </div> <!-- Row end  -->

                    </div>
                </div>
                <div class="container">
                    <div class="card text-center">
                        <div class="card-body">
                            <!-- <h3 class="card-title">QR Code</h3> -->
                            <?php
                            include "phpqrcode/qrlib.php";
                            include "controller/controllerGuest.php";
                            $main = new controllerGuest();
                            $id = $_GET["event"];
                            $hasil = $main->getDataEventById($id);
                            foreach ($hasil as $data) {
                            $nameEvent = $data["name"];
                            }
                            $tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
                            if (!file_exists($tempdir)) //Buat folder bername temp
                                mkdir($tempdir);

                            //isi qrcode jika di scan
                            $codeContents = 'https://belitiketevent.com/event/'.$id;
                            // $codeContents = 'https://beli-tiket-event.vercel.app/event/'.$id;

                            //simpan file kedalam temp 
                            //parameter ke empat ukuran pixel qrcode
                            QRcode::png($codeContents, $tempdir . $id.'.png', QR_ECLEVEL_L, 9);

                            //menampilkan file qrcode 
                            echo '<h2>'.$nameEvent.'</h2>';
                            echo '<img src="' . $tempdir . $id.'.png" />';
                            echo '<h4>https://belitiketevent.com/event/'.$id.'</h4>';
                            // echo '<h4>https://beli-tiket-event.vercel.app/event/'.$id.'</h4>';
                            ?>

                        </div>
                    </div>
                </div>

                <!-- <div class="card mb-3"> -->
                <?php
                // include "controller/controllerGuest.php";
                // $main = new controllerGuest();
                // $idEvent = $_GET["event"];
                // $hasil = $main->getDataEventById($idEvent);
                // foreach ($hasil as $data) {
                //     $id = $data["id"];
                // }
                ?>
                <!-- 
                    <div class="card-body">
                        <div class="tab-content"> -->
                <!-- OrderHistorytab End -->
                <!-- <div class="tab-pane"> -->
                <!-- <table id="ordertabthree"
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
                                        // $hasil = $main->getDataTicketByIdEvent($idEvent);
                                        // foreach ($hasil as $data) {
                                        //     $id = $data["id"];
                                        //     $name = $data["name"];
                                        //     $price = $data["price"];
                                        //     $stock = $data["stock"];
                                        //     $status = $data["status"];

                                        //     echo "<tr>
                                        //         <td>" . $name . "</td>
                                        //         <td>Rp. " . $price . "</td>
                                        //         <td>" . $stock . "</td>
                                        //         <td>" . $status . "</td>
                                        //         <td><button type=\"button\" class=\"btn btn-warning\" data-bs-toggle=\"modal\" data-bs-target=\"#editOrganizer" . $id . "\">Edit Data</button>
                                        //         <button type=\"button\" class=\"btn btn-danger\">Delete</button></td>
                                        //     </tr>
                                        //     ";
                                        // }
                                        ?>
                                    </tbody>
                                </table> -->
                <!-- </div>
                        </div>
                    </div>

                </div> -->

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