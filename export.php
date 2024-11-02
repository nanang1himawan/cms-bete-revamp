<?php
// fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// membuat nama file ekspor "export-to-excel.xls"
header("Content-Disposition: attachment; filename=export-to-excel.xls");
include "controller/controllerGuest.php";
$main = new controllerGuest();
$id = $_GET["idEvent"];
$name = $_GET["nameEvent"];
// membuat nama file ekspor "export-to-excel.xls"
header("Content-Disposition: attachment; filename=" . $name . ".xls");
$hasil = $main->getDataEventById($id);
// tambahkan table
session_start();
foreach ($hasil as $data2) {
    $idEvent2 = $data2["id"];
    $nameEvent2 = $data2["name"];
    $idEvent = $data2["type"];
    $hasilCustome2 = $main->getDataCustomePartisipantByIdEvent($idEvent2);

    $row = mysqli_fetch_row($hasilCustome2);

    if ($idEvent == NULL) {

        echo "
        <table>
        <tr>
                
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>phone number</th>
                <th>id ticket category</th>
                <th>Referral Code</th>
        ";

        if ($_SESSION['status'] == "BETE") {
            echo "
            <th>Id Transaksi</th>
            ";
        }

        echo "
                <th>Status</th>
                <th>Nomor Pendaftaran</th>
            </tr>
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
                $referral_code = "";
                if (isset($dataPartisipantConcertJson[$i]->referral_code)) {
                    $referral_code = $dataPartisipantConcertJson[$i]->referral_code;
                } else {
                    $referral_code = "-";
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
                echo "
                    <td>$referral_code</td>
                ";
                $hasilStatus = $main->getDataTransactionByIdBooking($id_booking);
                foreach ($hasilStatus as $dataStatus) {
                    $status = $dataStatus["status"];
                    $idTrans = $dataStatus["id"];
                    if ($_SESSION['status'] == "BETE") {
                        echo "
                        <td>$idTrans</td>
                        ";
                    }
                    echo "
                    <td>$status</td>
                ";
                }
                $hasilNoPendaftaran = $main->getTicketByid("ticket_" . $idEvent2, $id_ticket);
                foreach ($hasilNoPendaftaran as $hasilNoPendaftaran1) {
                    $nomorPendafatan = $hasilNoPendaftaran1["nomor_pendaftaran"];

                    echo "<td>" . $nomorPendafatan . "</td>";
                }


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
                
                                    <table>
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
                if ($_SESSION['status'] == "BETE") {
                    echo "
                    <th scope=\"col\" style=\"text-align: start;\">Id Transaksi</th>
                    ";
                }
                echo "<th scope=\"col\" style=\"text-align: start;\">status</th>";
                echo "<th scope=\"col\" style=\"text-align: start;\">no_pendaftaran</th>";
                echo "
                                                        </tr>
                                                    </thead>
                                                    <tbody>";

                foreach ($hasilCustome2 as $dataCustome2) {
                    $idCustomPart = $dataCustome2["id"];
                    $json_data = $dataCustome2["json_data"];
                    $datatabel = json_decode($json_data);
                    $player = $datatabel->player;
                    $id_booking = $datatabel->data[0]->id_booking;
                    for ($i = 0; $i < count($player); $i++) {
                        foreach ($player[$i] as $keyField) {
                            usort($keyField, function ($a, $b) {
                                return $a->state <=> $b->state;
                            });
                            echo "<tr id=\"color_tabel\" class=\"table-primary\">";
                            for ($j = 0; $j < count($keyField); $j++) {
                                $dataField = $keyField[$j]->data;
                                echo "<td>" . $dataField . "</td>";
                            }
                            $hasilStatus = $main->getDataTransactionByIdBooking($id_booking);
                            foreach ($hasilStatus as $dataStatus) {
                                $status = $dataStatus["status"];
                                $idTrans = $dataStatus["id"];
                                if ($_SESSION['status'] == "BETE") {
                                    echo "
                                <td>$idTrans</td>
                                ";
                                }
                                echo "
                                <td>$status</td>
                            ";
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
                    $id_booking = $datatabel->data[0]->id_booking;
                    $idBuyer = $dataCustome2["id_buyer"];
                    $dataBuyers = $main->getBuyerById($idBuyer);
                    // var_dump($idBuyer);

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
                        echo "<tr>";
                        echo "<td>" . $nameBuyer . "</td>";
                        echo "<td>" . $emailBuyer . "</td>";
                        echo "<td>" . $noTelpBuyer . "</td>";
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
                    if ($_SESSION['status'] == "BETE") {
                        echo "
                        <th scope=\"col\" style=\"text-align: start;\">Id Transaksi</th>
                        ";
                    }
                    echo "<th scope=\"col\" style=\"text-align: start;\">status</th>";
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
                            $hasilStatus = $main->getDataTransactionByIdBooking($id_booking);
                            foreach ($hasilStatus as $dataStatus) {
                                $status = $dataStatus["status"];
                                $idTrans = $dataStatus["id"];
                                if ($_SESSION['status'] == "BETE") {
                                    echo "
                                <td>$idTrans</td>
                                ";
                                }
                                echo "
                                <td>$status</td>
                            ";
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
