<style>
    .more-info {
        display: none;
    }

    @media screen and (min-device-width: 320px) and (max-device-width: 480px) {
        .btn-res {
            font-size: 0;
        }

        .card-body-res {
            align-self: center;
        }

        .h6-res {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden
        }
    }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1, minimun-scale=1" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<link rel="stylesheet" href="assets/css/custom.style.min.css">

<?php

include "controller/controllerGuest.php";
$main = new controllerGuest();
$idGuest = $_SESSION['id_user'];


if ($_SESSION['status'] == "BETE") {
    $hasil = $main->getDataEvent();
} else {
    $hasil = $main->getDataEventbyCreateBy($idGuest);
}

?>
<div class="body d-flex py-lg-3 py-md-2">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div
                    class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom">
                    <h3 class="fw-bold mb-0">Dashboard Analytic</h3>

                </div>
            </div>
        </div> <!-- Row end  -->
        <div class="mb-3">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="row gx-3 row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-3">
                    <div class="col">
                        <div class="card mb-3">
                            <div
                                class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Payment Status</h6>
                            </div>
                            <div class="card-body card-body-res">
                                <div id="apex-simple-donut"></div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col">
                        <div class="card mb-3">
                            <div
                                class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Stock Ticket Event</h6>
                            </div>
                            <div class="card-body card-body-res">
                                <div id="apex-simple-donut"></div>
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-4">
                                        <label for="validationCustom04" class="form-label">Event Name</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="eventName" id="eventSelected" class="form-select">
                                            <option selected disabled value="">Choose...</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <canvas id="stockChart" style="width:100%;max-width:600px"></canvas>
                                    <div id="apex-simple-donut2"></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col">
                        <div class="card mb-3">
                            <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Your Ticket</h6>
                                <div class="col-md-4" id="typeComp">
                                    <select name="type" class="form-select" onchange="checkPlayer(this)" id="type2"> -->
                    <?php
                    $index = 1;
                    foreach ($hasil as $data) {
                        $idEvent = $data["id"];
                        $nameEvent = $data["name"];

                        echo "
                                            <option
                                            ";
                        if ($index == 1) {
                            echo " id=\"selected\" Selected";
                        }
                        echo "
                                            value=\"\"</option>
                                            ";
                        $index++;
                    }
                    ?>
                    <!-- </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="apex-circle-chart"></div>
                            </div>
                        </div>
                    </div> -->

                    <!-- 
                    <div class="col">
                        <div class="card mb-3">
                            <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Circle Chart Multiple</h6>
                            </div>
                            <div class="card-body">
                                <div id="apex-circle-chart-multiple"></div>
                            </div>
                        </div>
                    </div>
                     -->
                    <!-- <div class="col">
                        <div class="card mb-3">
                            <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Circle Gradient</h6>
                            </div>
                            <div class="card-body">
                                <div id="apex-circle-gradient"></div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>

            <!-- tabel participan -->
            <?php
            if ($_SESSION['status'] == "BETE") {
                $hasil2 = $main->getDataRecapTransactionStatus();
            } else {
                $hasil2 = $main->getRecapTransactionByOrganizerId($idGuest);
            }

            foreach ($hasil2 as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    $series[] = $value1;
                }
            }

            foreach ($hasil as $data2) {
                $idEvent2 = $data2["id"];
                $nameEvent2 = $data2["name"];
                $hasilCustome2 = $main->getDataCustomePartisipantByIdEvent2($idEvent2);
                $row = mysqli_fetch_row($hasilCustome2);

                echo "
                    <div class=\"row align-item-center\">
                        <div class=\"col\">
                            <div class=\"card mb-3\">
                                <div class=\"card-header py-3 bg-transparent border-bottom-0\">
                                    <div class=\"row\">
                                        <div class=\"col-9\"><h6 class=\"mb-0 fw-bold h6-res\">" . $nameEvent2 . "</h6></div>
                                        <div class=\"col-3 col-33\" style=\"display: flex; justify-content: flex-end;\"><form action=\"export.php\" method=\"GET\" enctype=\"multipart/form-data\">
                                        <button type=\"submit\" class=\"btn btn-success btn-res\"><img src=\"img/export-excel.png\">Export Data</button></div>
                                    </div>
                                    <input type=\"hidden\" name=\"idEvent\" value=\"$idEvent2\"/>
                                    <input type=\"hidden\" name=\"nameEvent\" value=\"$nameEvent2\"/>
                                    
                                    </form>
                                </div>
                                <div style=\"";

                if ($row != NULL) {
                    echo "max-height:350px; overflow:auto;";
                }
                echo "
                                \" class=\"card-body\">
                                    <div class=\"table-responsive\">
                                        <table class=\"table table-hover\">
                                            <thead>
                                                <tr>
                    ";

                if ($row != NULL) {

                    echo "
                    <th scope=\"col\">Nama</th>
                    <th scope=\"col\">Email</th>
                    <th scope=\"col\">Nomor Telepon</th>
                    ";


                    echo "
                                                        </tr>
                                                    </thead>
                                                    <tbody>";

                    if ($row[0] == 'Concert') {
                        // var_dump("true");
                        foreach ($hasilCustome2 as $dataCustome2) {
                            $idCustomPart = $dataCustome2["id"];
                            $json_data = $dataCustome2["json_data"];
                            $idBuyer = $dataCustome2["id_buyer"];
                            $datatabel = json_decode($json_data);
                            // $idTickets = $datatabel->data;
                            $player = $datatabel->data;
                            $hasilBuyer = $main->getBuyerById($idBuyer);

                            $indexPlayer = 0;
                            foreach ($hasilBuyer as $buyerData) {
                                $nameBuyer = $buyerData["name"];
                                $noTlpnBuyer = $buyerData["phone_number"];
                                $emailBuyer = $buyerData["email"];
                                echo "<tr>";
                                echo "<td>" . $nameBuyer . "</td>";
                                echo "<td>" . $emailBuyer . "</td>";
                                echo "<td>" . $noTlpnBuyer . "</td>";
                                echo "</tr>";
                                echo "
                                <tr class=\"more-info\">
                                    <td colspan=\"3\">
                                        <div class=\"table-responsive\">
                                            <table class=\"table table-striped\">
                                                <thead>
                                                    <tr class=\"table-primary\">";

                                // <th scope=\"col\">#</th>
            
                                // $header2 = $datatabel->player[$indexPlayer]->data;
                                $indexPlayer++;

                                foreach ($player as $keyField) {
                                    $array = json_decode(json_encode($keyField), true);
                                    $keys = array_keys($array);
                                    // var_dump(count($keys));
            
                                    for ($i = 0; $i < count($keys); $i++) {
                                        echo "<th>" . $keys[$i] . "</th>";
                                    }
                                    // var_dump($keyField->id_ticket);
            
                                    echo "<th scope=\"col\">No Pendaftaran</th>";
                                    echo "
                                                </tr>
                                                </thead>
                                                <tbody>
                                    ";
                                    // var_dump($array);
            
                                    echo "<tr id=\"color_tabel\" class=\"table-primary\">";
                                    echo "<td>" . $keyField->id_ticket . "</td>";
                                    echo "<td>" . $keyField->id_booking . "</td>";
                                    echo "<td>-</td>";
                                    echo "<td>" . $keyField->name . "</td>";
                                    echo "<td>" . $keyField->email . "</td>";
                                    echo "<td>" . $keyField->ktp_id . "</td>";
                                    echo "<td>" . $keyField->phone_number . "</td>";

                                    $idTickets2 = $main->getDataIdtTicketByIdCustomPartisipant($idCustomPart);
                                    foreach ($idTickets2 as $idTicketsData) {
                                        $idTickets = $idTicketsData["id_ticket"];
                                    }
                                    $hasilNoPendaftaran = $main->getTicketByid("ticket_" . $idEvent2, $idTickets);

                                    foreach ($hasilNoPendaftaran as $hasilNoPendaftaran1) {
                                        $nomorPendafatan = $hasilNoPendaftaran1["nomor_pendaftaran"];
                                        echo "<td>" . $nomorPendafatan . "</td>";
                                    }
                                    echo "</tr>";
                                }
                            }
                            echo "
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            ";
                        }
                    } else {
                        // var_dump("false");
                        foreach ($hasilCustome2 as $dataCustome2) {
                            $idCustomPart = $dataCustome2["id"];
                            $json_data = $dataCustome2["json_data"];
                            $idBuyer = $dataCustome2["id_buyer"];
                            $datatabel = json_decode($json_data);
                            // $idTickets = $datatabel->data;
                            $player = $datatabel->player;
                            $hasilBuyer = $main->getBuyerById($idBuyer);

                            $indexPlayer = 0;
                            foreach ($hasilBuyer as $buyerData) {
                                $nameBuyer = $buyerData["name"];
                                $noTlpnBuyer = $buyerData["phone_number"];
                                $emailBuyer = $buyerData["email"];
                                echo "<tr>";
                                echo "<td>" . $nameBuyer . "</td>";
                                echo "<td>" . $emailBuyer . "</td>";
                                echo "<td>" . $noTlpnBuyer . "</td>";
                                echo "</tr>";
                                echo "
                                <tr class=\"more-info\">
                                    <td colspan=\"3\">
                                        <div class=\"table-responsive\">
                                            <table class=\"table table-striped\">
                                                <thead>
                                                    <tr class=\"table-primary\">";

                                // <th scope=\"col\">#</th>
            
                                $header2 = $datatabel->player[$indexPlayer]->data;
                                $indexPlayer++;
                                for ($i = 0; $i < count($header2); $i++) {
                                    echo "<th scope=\"col\">" . $header2[$i]->state . "</th>";
                                }
                                echo "<th scope=\"col\">No Pendaftaran</th>";
                                echo "
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    ";
                                for ($i = 0; $i < count($player); $i++) {
                                    foreach ($player[$i] as $keyField) {
                                        echo "<tr id=\"color_tabel\" class=\"table-primary\">";
                                        for ($j = 0; $j < count($keyField); $j++) {
                                            $dataField = $keyField[$j]->data;

                                            echo "<td>" . $dataField . "</td>";
                                        }
                                        $idTickets2 = $main->getDataIdtTicketByIdCustomPartisipant($idCustomPart);
                                        foreach ($idTickets2 as $idTicketsData) {
                                            $idTickets = $idTicketsData["id_ticket"];
                                        }
                                        $hasilNoPendaftaran = $main->getTicketByid("ticket_" . $idEvent2, $idTickets);

                                        foreach ($hasilNoPendaftaran as $hasilNoPendaftaran1) {
                                            $nomorPendafatan = $hasilNoPendaftaran1["nomor_pendaftaran"];

                                            echo "<td>" . $nomorPendafatan . "</td>";
                                        }
                                        echo "</tr>";
                                    }
                                }
                            }

                            echo "
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>


                                </tr>
                        ";
                        }
                    }
                } else {
                    echo "<center><h6 class=\"m-0 fw-bold\">NO DATA</h6></center>";
                }

                echo "

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                ";
            }
            ?>

            <!-- <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                        <h6 class="m-0 fw-bold">Traffic Website</h6>
                    </div>
                    <div class="card-body">
                        <div id="apex-chart-line-column"></div>
                    </div>
                </div>
            </div> -->
        </div>
    </div> <!-- Row end  -->
</div>

<!-- Chart 1 -->
<script>
    var xx = document.getElementById("selected").value;

    function checkPlayer(selectObject) {
        var id = selectObject.value;

    }

    $(document).ready(function () {
        $('tr').click(function () {
            $(this).next('.more-info').slideToggle('slow');
        });
    });

    $(document).ready(function () {

        var options = {
            chart: {
                height: 250,
                type: "donut",
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                position: "top",
                horizontalAlign: "center",
                show: true,
            },
            colors: [
                "var(--bs-yellow)",
                "var(--chart-color1)",
                "var(--bs-green)",
                "var(--color-000)",
                "var(--bs-danger)",
            ],
            series: [<?php echo implode(",", $series); ?>],
            labels: ["WFP", "WFA", "VERIFIED", "INVALID", "CANCELED"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200,
                    },
                    legend: {
                        position: "bottom",
                    },
                },
            },],
        };

        var chart = new ApexCharts(
            document.querySelector("#apex-simple-donut"),
            options
        );

        chart.render();
    });
</script>
<!-- Chart 2 -->
<!-- <script>
    var xx = document.getElementById("selected2").value;

    $(document).ready(function () {
        $('tr').click(function () {
            $(this).next('.more-info').slideToggle('slow');
        });
    });

    $(document).ready(function () {

        var options = {
            chart: {
                height: 250,
                type: "pie",
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                position: "top",
                horizontalAlign: "center",
                show: true,
            },
            colors: [
                "var(--chart-color1)",
                "var(--chart-color2)",
            ],
            series: [<?php echo implode(",", $series); ?>],
            labels: ["SOLD", "AVAILABLE"],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200,
                    },
                    legend: {
                        position: "bottom",
                    },
                },
            },],
        };
        var chart = new ApexCharts(
            document.querySelector("#apex-simple-donut2"),
            options
        );
        chart.render();
    }); -->
<!-- </script> -->
<!-- <script>


    function getEventId() {
        var idEvent = document.getElementById("eventSelected").value;
        console.log(idEvent)
    }

    var xValues = ["Sold", "Available"];
    var yValues = [44, 56];
    var barColors = [
        "#ef7e56",
        "#44558f"
    ];

    new Chart("stockChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        }
    });
</script> -->