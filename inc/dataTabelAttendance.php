<style>
    .parent {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-column-gap: 10px;
        grid-row-gap: 10px;
    }

    .child {
        height: fit-content;
    }
</style>


<?php

include "controller/controllerGuest.php";
$main = new controllerGuest();
$id = $_GET["event"];
$tabel = "ticket_$id";

?>


<div class="col-xl-4 col-xxl-5" style="margin-bottom: 15px">
    <div class="card">
        <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center bg-transparent border-bottom-0">
            <h6 class="mb-0 fw-bold">Total Tickets</h6>
        </div>
        <div class="card-body">
            <?php
            $totalTic = $main->getDataTotalTicket($tabel);
            $recapAttendance = $main->getDataRecapAttendance($tabel);

            foreach ($totalTic as $dataTotal) {
                $total = $dataTotal["total"];
            }
            foreach ($recapAttendance as $dataRecap) {
                $TotalReady = $dataRecap["TotalReady"];
                $TotalCheckin = $dataRecap["TotalCheckin"];
                $TotalCheckout = $dataRecap["TotalCheckout"];
            }
            
            if ($TotalCheckin != 0) {
                $percentCheckin = ($TotalCheckin / $total) * 100; 
            } else {
                $percentCheckin = 0;
            }
            if ($TotalCheckout != 0) {
                $percentCheckout = ($TotalCheckout / $total) * 100; 
            } else {
                $percentCheckout = 0;
            }
            
            ?>
            
            <span class="h3 d-block mb-2"><?php echo $total; ?></span>
            <!-- Progress -->
            <div class="progress rounded-pill mb-1" style="height: 5px;">
                <div class="progress-bar chart-color1" role="progressbar" style="width: <?php echo $percentCheckin; ?>%" aria-valuenow="<?php echo $percentCheckin; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                <!-- <div class="progress-bar chart-color2" role="progressbar" style="width: 23%" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100"></div> -->
            </div>
            <div class="d-flex justify-content-between mb-4">
                <span>0%</span>
                <span>100%</span>
            </div>
            <!-- End Progress -->
            <div class="table-responsive">
                <table class="table  table-nowrap mb-0">
                    <tbody>
                        <tr>
                            <td><i class="fa fa-square chart-text-color1"></i> Check-in</td>
                            <td><?php echo $TotalCheckin; ?></td>
                            <td><span class="badge bg-success"><?php echo $percentCheckin; ?>%</span></td>
                        </tr>
                        <tr>
                            <td><i class="fa fa-square chart-text-color2"></i> Check-out</td>
                            <td><?php echo $TotalCheckout; ?></td>
                            <td><span class="badge bg-warning"><?php echo $percentCheckout; ?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header py-3 border-bottom">
        <h2 class="mb-0 fw-bold text-center">Data Attendance</h2>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <!-- OrderHistorytab End -->
            <div class="tab-pane fade show active">
                <!-- <tbody> -->
                <div class="card bg-transparent shadow-none border-0">
                    <div class="card-body">
                        <div class="row table-responsive">
                            <?php
                            $hasil = $main->getDataEventById($id);
                            // tambahkan table
                            foreach ($hasil as $data2) {
                                $idEvent2 = $data2["id"];
                                $nameEvent2 = $data2["name"];
                                $idEvent = $data2["type"];
                                $hasilCustome2 = $main->getDataCustomePartisipantByIdEvent($idEvent2);

                                $row = mysqli_fetch_row($hasilCustome2);

                                if ($idEvent == NULL) {

                                    echo "
                                    <table class=\"table\">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>NIK</th>
                                                <th>phone number</th>
                                                <th>ticket category</th>
                                                <th>Nomor Pendaftaran</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class=\"table-group-divider\">
                                    ";
                                    foreach ($hasilCustome2 as $dataPartisipantConcert) {
                                        // var_dump($dataPartisipantConcert);
                                        $dataPartisipantConcertJson = json_decode($dataPartisipantConcert["json_data"])->data;
                                        // var_dump($dataPartisipantConcertJson[0]);
                                        for ($i = 0; $i < count($dataPartisipantConcertJson); $i++) {
                                            $id_ticket = $dataPartisipantConcertJson[$i]->id_ticket;
                                            $id_booking = $dataPartisipantConcertJson[$i]->id_booking;
                                            $id_ticket_category = $dataPartisipantConcertJson[$i]->id_ticket_category;
                                            $name = $dataPartisipantConcertJson[$i]->name;
                                            $ktp_id = $dataPartisipantConcertJson[$i]->ktp_id;
                                            $phone_number = $dataPartisipantConcertJson[$i]->phone_number;
                                            $hasil3 = $main->getTicketByid($tabel, $id_ticket);
                                            foreach ($hasil3 as $dataQrcode) {
                                                $qrCode = $dataQrcode["QRcode"];
                                            }
                                            echo "
                                            <tr>
                                                <td>$name</td>
                                                <td>$ktp_id</td>
                                                <td>$phone_number</td>";
                                            $hasil2 = $main->getDataTicketById($id_ticket_category);
                                            foreach ($hasil2 as $dataTicketCategory) {
                                                echo "
                                                    <td>" . $dataTicketCategory["name"] . "</td>
                                                    ";
                                            }


                                            $hasilNoPendaftaran = $main->getTicketByid("ticket_" . $idEvent2, $id_ticket);
                                            foreach ($hasilNoPendaftaran as $hasilNoPendaftaran1) {
                                                $nomorPendafatan = $hasilNoPendaftaran1["nomor_pendaftaran"];

                                                echo "<td>" . $nomorPendafatan . "</td>";
                                            }

                                            echo "<td>" . $qrCode . "</td>";
                                            echo "
                                            </tr>
                                            ";
                                        }
                                    }
                                    echo "
                                    </table>
                                    ";
                                } else {
                                    echo "
                                            
                                                                <table class=\"table\">
                                                                    <thead>
                                                                        <tr>
                                            ";


                                    if ($idEvent == "Single Player") {
                                        if ($row != NULL) {
                                            $header = json_decode($row[4])->player[0]->data;

                                            usort($header, function ($a, $b) {
                                                return $a->state <=> $b->state;
                                            });

                                            for ($i = 0; $i < count($header); $i++) {
                                                echo "<th scope=\"col\" style=\"text-align: start;\">" . $header[$i]->state . "</th>";
                                            }

                                            echo "<th scope=\"col\" style=\"text-align: start;\">no_pendaftaran</th>";
                                            echo "<th scope=\"col\" style=\"text-align: start;\">Status</th>";
                                            echo "
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>";

                                            foreach ($hasilCustome2 as $dataCustome2) {
                                                $idCustomPart = $dataCustome2["id"];
                                                $json_data = $dataCustome2["json_data"];
                                                $datatabel = json_decode($json_data);
                                                $player = $datatabel->player;
                                                for ($i = 0; $i < count($player); $i++) {
                                                    foreach ($player[$i] as $keyField) {
                                                        usort($keyField, function ($a, $b) {
                                                            return $a->state <=> $b->state;
                                                        });
                                                        echo "<tr id=\"color_tabel\" class=\"table-primary\">";
                                                        $idTickets2 = $main->getDataIdtTicketByIdCustomPartisipant($idCustomPart);
                                                        foreach ($idTickets2 as $idTicketsData) {
                                                            $idTickets = $idTicketsData["id_ticket"];
                                                        }

                                                        $hasilNoPendaftaran = $main->getTicketByid("ticket_" . $idEvent2, $idTickets);
                                                        foreach ($hasilNoPendaftaran as $hasilNoPendaftaran1) {
                                                            $nomorPendafatan = $hasilNoPendaftaran1["nomor_pendaftaran"];
                                                            $qrCode = $hasilNoPendaftaran1["QRcode"];
                                                            //warna kuning status ready, warna hijau status chack-in, warna merah status checkout.
                                                        }
                                                        for ($j = 0; $j < count($keyField); $j++) {
                                                            $dataField = $keyField[$j]->data;
                                                            //warna kuning status ready, warna hijau status chack-in, warna merah status checkout.
                                                            echo "<td>" . $dataField . "</td>";
                                                        }


                                                        echo "<td >" . $nomorPendafatan . "</td>";
                                                        echo "<td >" . $qrCode . "</td>";


                                                        echo "</tr>";
                                                    }
                                                }
                                            }
                                        } else {
                                            echo "<center><h6 class=\"m-0 fw-bold\">NO DATA</h6></center>";
                                        }
                                    } else {
                                        if ($row != NULL) {
                                            // $header = json_decode($row[4])->player[0]->data;


                                            // for ($i = 0; $i < count($header); $i++) {
                                            //     echo "<th scope=\"col\">" . $header[$i]->state . "</th>";
                                            // }
                                            // echo "<th scope=\"col\" style=\"text-align: start;\">no_pendaftaran</th>";
                                            // echo "
                                            //                                             </tr>
                                            //                                         </thead>
                                            //                                         <tbody>";

                                            foreach ($hasilCustome2 as $dataCustome2) {
                                                $idCustomPart = $dataCustome2["id"];
                                                $json_data = $dataCustome2["json_data"];
                                                $datatabel = json_decode($json_data);
                                                // $idTickets = $datatabel->data;
                                                $player = $datatabel->player;
                                                $idBuyer = $dataCustome2["id_buyer"];
                                                $dataBuyers = $main->getBuyerById($idBuyer);
                                                // var_dump($idBuyer);
                                                $idTickets2 = $main->getDataIdtTicketByIdCustomPartisipant($idCustomPart);
                                                foreach ($idTickets2 as $idTicketsData) {
                                                    $idTickets = $idTicketsData["id_ticket"];
                                                }
                                                $hasilNoPendaftaran = $main->getTicketByid("ticket_" . $idEvent2, $idTickets);
                                                foreach ($hasilNoPendaftaran as $hasilNoPendaftaran1) {
                                                    $nomorPendafatan = $hasilNoPendaftaran1["nomor_pendaftaran"];
                                                    $qrCode = $hasilNoPendaftaran1["QRcode"];
                                                }
                                                // Tabel Buyer/Pendaftar
                                                foreach ($dataBuyers as $dataBuyer) {
                                                    // echo "<th scope=\"col\">" . $dataBuyer . "</th>";
                                                    $nameBuyer = $dataBuyer["name"];
                                                    $noTelpBuyer = $dataBuyer["phone_number"];
                                                    $emailBuyer = $dataBuyer["email"];
                                                    // var_dump($nameBuyer);

                                                    echo "<th scope=\"col\" style=\"text-align: left;\">nama</th>";
                                                    echo "<th scope=\"col\" style=\"text-align: left;\">email</th>";
                                                    echo "<th scope=\"col\" style=\"text-align: left;\">phone</th>";
                                                    echo "<th scope=\"col\" style=\"text-align: left;\">status</th>";
                                                    //warna kuning status ready, warna hijau status chack-in, warna merah status checkout.
                                                    echo "<tr>";
                                                    echo "<td>" . $nameBuyer . "</td>";
                                                    echo "<td>" . $emailBuyer . "</td>";
                                                    echo "<td>" . $noTelpBuyer . "</td>";
                                                    echo "<td>" . $qrCode . "</td>";
                                                    echo "</tr>";
                                                    
                                                }

                                                // Tabel Player
                                                $headerPlayer = json_decode($row[4])->player[0]->data;

                                                usort($headerPlayer, function ($a, $b) {
                                                    return $a->state <=> $b->state;
                                                });

                                                for ($i = 0; $i < count($headerPlayer); $i++) {
                                                    echo "<th scope=\"col\" style=\"text-align: left;\">" . $headerPlayer[$i]->state . "</th>";
                                                }

                                                echo "<th scope=\"col\" style=\"text-align: start;\">no_pendaftaran</th>";

                                                echo "
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>";
                                                for ($i = 0; $i < count($player); $i++) {
                                                    foreach ($player[$i] as $keyField) {
                                                        usort($keyField, function ($a, $b) {
                                                            return $a->state <=> $b->state;
                                                        });
                                                        for ($j = 0; $j < count($keyField); $j++) {
                                                            $dataField = $keyField[$j]->data;
                                                            echo "<td>" . $dataField . "</td>";
                                                        }

                                                        echo "<td>" . $nomorPendafatan . "</td>";
                                                        echo "<td>" . $qrCode . "</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                            }
                                        } else {
                                            echo "<center><h6 class=\"m-0 fw-bold\">NO DATA</h6></center>";
                                        }
                                    }
                                    echo "
                                
                                </tbody>
                                </table>
                                </td>
                                </tr>
                                </tbody>
                                </table>
                                ";
                                }
                            }

                            ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <h5 class="modal-title w-100" id="exampleModalLabel">
                            Payment Receipt
                        </h5>
                    </div>
                    <div class="modal-body">
                        <img src="assets/images/coin/SOL.png" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">
                            Verify
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
<script>
    function checkModal(id) {

    }


    function formSubmit(id) {
        document.getElementById("formAttendance" + id).submit();
    }

    function formSubmit2(id) {
        document.getElementById("formAttendance2" + id).submit();
    }

    function checkCategory() {
        var nameCategory = document.getElementById("categoryCheck").value;
        var nameCategory2 = document.getElementById("categoryCheck" + nameCategory);
        let name = nameCategory2.getAttribute("data");

        console.log(name);
        if (name == "Competition Event") {
            document.getElementById("typeComp").style.display = "block";
            document.getElementById("mxPly").style.display = "block";
        } else {
            document.getElementById("typeComp").style.display = "none";
            // $('#form').append('<input type="hidden" name="type" value="" />');
            document.getElementById("mxPly").style.display = "none";
        }
    }

    function preview(id) {
        var poster = document.getElementById("frame" + id);
        poster.src = URL.createObjectURL(event.target.files[0]);
    }

    function clearImage(id, poster3) {
        var poster2 = document.getElementById("frame" + id);
        document.getElementById("images" + id).value = null;
        poster2.src = poster3;
    }
</script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script> -->