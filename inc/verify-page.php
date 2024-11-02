<div class="card">
    <div class="card-header py-3 d-flex align-items-center bg-transparent border-bottom-0">
        <h6 class="mb-0 fw-bold ">Data List</h6>
        <div class="col-md-4 px-5">
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

            <select onchange="setIdEvent(this)" name="eventName" id="eventSelected" class="form-select">
                <option selected disabled value="">Choose Event...</option>
                <?php

                foreach ($hasil as $data2) {
                    $id2 = $data2["id"];
                    $name2 = $data2["name"];
                    // $getTicketData = $main->getDataTicketCategoryByEventId($id2);
                    echo "
                           <option  data=\"" . $name2 . "\"value=\"" . $id2 . "\">" . $name2 . "</option>";
                }
                ?>
            </select>
        </div>

    </div>
    <div class="card-body">
        <div class="tab-content">
            <!-- OrderHistorytab End -->
            <div class="tab-pane fade show active" id="TradeHistory">
                <table id="ordertabthree" class="priceTable table table-hover custom-table-2 table-bordered align-middle mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <!-- <th>transaksi</th>
                            <th>id booking</th> -->
                            <th>Name</th>
                            <th>Payment recorded</th>
                            <th>Event</th>
                            <th>Category</th>
                            <th>Detail Data</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $idGuest = $_SESSION['id_user'];
                        $id_event_choose = $_GET['event'];

                        if ($_SESSION['status'] == 'BETE') {
                            $hasil = $main->getDataTransactionByEvent($id_event_choose);
                        } else {
                            $hasil = $main->getDataTransactionByOrganizerByIdEvent($idGuest, $id_event_choose);
                        }
                        foreach ($hasil as $data) {
                            $count = 0;
                            $id = $data["id"];
                            $id_booking = $data["id_booking"];

                            $name_buyer = $data["name_buyer"];
                            $email = $data["email"];
                            $phoneBuyer = $data["phoneBuyer"];
                            $name_event = $data["name_event"];
                            $id_event = $data["id_event"];
                            $create_date = $data["create_date"];
                            $total = $data["total"];
                            $typeEvent = $data["typeForm"];
                            $payment_receipt = $data["payment_receipt"];
                            $status = $data["status"];

                            $tabel = "ticket_$id_event";
                            $data4[$count] = [];


                            $hasil2 = $main->getTicketByidBooking($tabel, $id_booking);

                            foreach ($hasil2 as $data22) {
                                $hasil33 = $main->getDataTicketById($data22["id_ticket_category"]);
                                foreach ($hasil33 as $data3) {
                                    array_push($data4[$count], $data22["id"]);
                                }
                            }
                            echo "
                                                
                            <div class=\"modal fade\" id=\"detailModal" . $id . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog\" role=\"document\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <h5 class=\"modal-title w-100\" id=\"exampleModalLabel\">
                                    Detail Data
                                </h5>
                                
                            </div>
                            <!--Modal body with image-->
                            ";
                            if ($payment_receipt != "0") {
                                echo "
                                <img src=\"" . $payment_receipt . "\" />
                                ";
                            }

                            echo "
                            <div style=\"max-height:350px\" class=\"modal-body overflow-auto\">
                            ";

                            $hasil4 = $main->getDataDetailTransaction($id);
                            // $hasil5 = $main->getDataEventById($id_event);

                            // foreach ($hasil5 as $dataEvent) {
                            //     $typeEvent = $dataEvent["type"];
                            // }
                            if ($typeEvent == NULL) {
                                foreach ($hasil4 as $customePartisipant) {
                                    $dataPartisipantConcertJson = json_decode($customePartisipant["json_data"])->data;
                                }
                                for ($i = 0; $i < count($dataPartisipantConcertJson); $i++) {

                                    $id_ticket = $dataPartisipantConcertJson[$i]->id_ticket;
                                    $id_booking = $dataPartisipantConcertJson[$i]->id_booking;
                                    $id_ticket_category = $dataPartisipantConcertJson[$i]->id_ticket_category;
                                    $name = $dataPartisipantConcertJson[$i]->name;
                                    $ktp_id = $dataPartisipantConcertJson[$i]->ktp_id;
                                    $phone_number = $dataPartisipantConcertJson[$i]->phone_number;
                                    $email2 = $dataPartisipantConcertJson[$i]->email;
                                    $referral_code = "";
                                    if (isset($dataPartisipantConcertJson[$i]->referral_code)) {
                                        $referral_code = $dataPartisipantConcertJson[$i]->referral_code;
                                    }else{
                                        $referral_code = "-";
                                    }
                                    


                                    echo " Nama     : " . $name . "<br>";
                                    echo " NIK      : " . $ktp_id . "<br>";
                                    echo " No.Tlpn  : " . $phone_number . "<br>";
                                    echo " Email    : " . $email2 . "<br>";
                                    echo " Referal  : " . $referral_code . "<br><br>";
                                }
                            } else {
                                foreach ($hasil4 as $customePartisipant) {
                                    $json_data = $customePartisipant["json_data"];
                                    $datatabel = json_decode($json_data);
                                    $player = $datatabel->player;


                                    for ($i = 0; $i < count($player); $i++) {
                                        foreach ($player[$i] as $keyField) {
                                            for ($j = 0; $j < count($keyField); $j++) {
                                                $dataField = $keyField[$j]->data;
                                                $dataField2 = $keyField[$j]->state;

                                                echo $dataField2 . " : " . $dataField . "<br>";
                                            }
                                            echo "<br>";
                                        }
                                    }
                                }
                            }
                            echo "
                    </div>
                    <div class=\"modal-footer\">
                    <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                    <input type=\"hidden\" name=\"idTransaction\" value=\"" . $id . "\"> 
                    <input type=\"hidden\" name=\"status\" value=\"verified\">
                    <input type=\"hidden\" name=\"email\" value=\"" . $email . "\">
                    <input type=\"hidden\" name=\"nameBuyer\" value=\"" . $name_buyer . "\">
                    <input type=\"hidden\" name=\"id_booking\" value=\"" . $id_booking . "\">
                    <input type=\"hidden\" name=\"categoryHuruf\" value=\"\">";
                            for ($i = 0; $i < count($data4[$count]); $i++) {
                                echo "<input type=\"hidden\" name=\"idTicket[]\" value=\"" . $data4[$count][$i] . "\"> ";
                            }
                            echo "
                    <input type=\"hidden\" name=\"idEvent\" value=\"" . $id_event . "\">
                    <button type=\"submit\" name=\"updateStatus\" class=\"btn btn-success\">
                        Verify
                    </button>
                    </form>
                    ";

                            if ($id_event == "78c93452-5274-43e4-ab73-096cd64e555c") {
                                echo "
                            <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                            <input type=\"hidden\" name=\"idTransaction\" value=\"" . $id . "\"> 
                            <input type=\"hidden\" name=\"status\" value=\"verify\">
                            <input type=\"hidden\" name=\"email\" value=\"" . $email . "\">
                            <input type=\"hidden\" name=\"nameBuyer\" value=\"" . $name_buyer . "\">
                            <input type=\"hidden\" name=\"id_booking\" value=\"" . $id_booking . "\">
                            <input type=\"hidden\" name=\"categoryHuruf\" value=\"A\">";
                                for ($i = 0; $i < count($data4[$count]); $i++) {
                                    echo "<input type=\"hidden\" name=\"idTicket[]\" value=\"" . $data4[$count][$i] . "\"> ";
                                }
                                echo "
                            <input type=\"hidden\" name=\"idEvent\" value=\"" . $id_event . "\">
                            <button type=\"submit\" name=\"updateStatus\" class=\"btn btn-info\">
                                Verify A
                            </button>
                            </form>
                            <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                            <input type=\"hidden\" name=\"idTransaction\" value=\"" . $id . "\"> 
                            <input type=\"hidden\" name=\"status\" value=\"verify\">
                            <input type=\"hidden\" name=\"email\" value=\"" . $email . "\">
                            <input type=\"hidden\" name=\"nameBuyer\" value=\"" . $name_buyer . "\">
                            <input type=\"hidden\" name=\"id_booking\" value=\"" . $id_booking . "\">
                            <input type=\"hidden\" name=\"categoryHuruf\" value=\"B\">";
                                for ($i = 0; $i < count($data4[$count]); $i++) {
                                    echo "<input type=\"hidden\" name=\"idTicket[]\" value=\"" . $data4[$count][$i] . "\"> ";
                                }
                                echo "
                            
                            <input type=\"hidden\" name=\"idEvent\" value=\"" . $id_event . "\">
                            <button type=\"submit\" name=\"updateStatus\" class=\"btn btn-info\">
                                Verify B
                            </button>
                            </form>
                            <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                            <input type=\"hidden\" name=\"idTransaction\" value=\"" . $id . "\"> 
                            <input type=\"hidden\" name=\"status\" value=\"verify\">
                            <input type=\"hidden\" name=\"email\" value=\"" . $email . "\">
                            <input type=\"hidden\" name=\"nameBuyer\" value=\"" . $name_buyer . "\">
                            <input type=\"hidden\" name=\"id_booking\" value=\"" . $id_booking . "\">
                            <input type=\"hidden\" name=\"categoryHuruf\" value=\"C\">";
                                for ($i = 0; $i < count($data4[$count]); $i++) {
                                    echo "<input type=\"hidden\" name=\"idTicket[]\" value=\"" . $data4[$count][$i] . "\"> ";
                                }
                                echo "
                            
                            <input type=\"hidden\" name=\"idEvent\" value=\"" . $id_event . "\">
                            <button type=\"submit\" name=\"updateStatus\" class=\"btn btn-info\">
                                Verify C
                            </button>
                            </form>";
                            }

                            echo "
                            
                            <form action=\"edit.php\" method=\"POST\" enctype=\"multipart/form-data\">
                            <input type=\"hidden\" name=\"idTransaction\" value=\"" . $id . "\"> 
                            <input type=\"hidden\" name=\"status\" value=\"invalid\">
                            <input type=\"hidden\" name=\"idEvent\" value=\"" . $id_event . "\">
                            <input type=\"hidden\" name=\"email\" value=\"" . $email . "\">
                            <input type=\"hidden\" name=\"nameBuyer\" value=\"" . $name_buyer . "\">
                            <input type=\"hidden\" name=\"id_booking\" value=\"" . $id_booking . "\">
                            <input type=\"hidden\" name=\"categoryHuruf\" value=\"\">";
                            for ($i = 0; $i < count($data4[$count]); $i++) {
                                echo "<input type=\"hidden\" name=\"idTicket[]\" value=\"" . $data4[$count][$i] . "\"> ";
                            }
                            echo "
                            <button type=\"submit\" name=\"updateStatusInvalid\"  class=\"btn btn-danger\">
                                Invalid Data
                            </button>
                            </form>
                                <button type=\"button\" class=\"btn btn-primary\" data-dismiss=\"modal\">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                            
                            ";

                            echo "
                                    <tr>
                                        <!-- <td>" . $id . "</td>
                                        <td>" . $id_booking . "</td> -->
                                        <td>" . $name_buyer . "</td>
                                        <td>" . $create_date . "</td>
                                        <td>" . $name_event . "</td>
                                        <td>
                                    ";

                            foreach ($hasil2 as $data2) {
                                // var_dump($data2);
                                // $nomor_pendaftaran = $data2["nomor_pendaftaran"];

                                $hasil3 = $main->getDataTicketById($data2["id_ticket_category"]);
                                foreach ($hasil3 as $data3) {

                                    array_push($data4[$count], $data2["id"]);
                                    echo "
                                    <span class=\"color-price-up\">" . $data3["name"] . "</span><br>
                                    ";
                                }
                            }
                            echo "
                                        </td>
                                        <td>";
                            echo "<button data-toggle=\"modal\" data-target=\"#detailModal" . $id . "\" class=\"";
                            if ($status == "wfp") {
                                echo "btn btn-danger";
                            }
                            if ($status == "process") {
                                echo "btn btn-warning";
                            }
                            if ($status == "verify" || $status == "verified") {
                                echo "btn btn-success";
                            }
                            if ($status == "canceled") {
                                echo "btn btn-danger";
                            }
                            if ($status == "invalid") {
                                echo "btn btn-dark";
                            }

                            echo "
                            \">Verify Data</button>
                            ";

                            echo "
                                        </td>
                                        
                                        <td>Rp. " . $total . "</td>
                                        
                                        <td><span id=\"statuscolor\" class=\"text-uppercase ";
                            // <td><img data-toggle=\"modal\" data-target=\"#fotoModal" . $id . "\" src=\"data:image/jpeg;base64," . $payment_receipt . "\" class=\"img-fluid avatar mx-1\"></td>
                            if ($status == "wfp") {
                                echo "badge bg-warning";
                            }
                            if ($status == "process") {
                                echo "badge bg-warning";
                            }
                            if ($status == "verify" || $status == "verified") {
                                echo "badge bg-success";
                            }
                            if ($status == "canceled") {
                                echo "badge bg-danger";
                            }
                            if ($status == "invalid") {
                                echo "badge bg-dark";
                            }

                            echo "\">" . $status . "</span></td>
                                    </tr>


                                    ";



                            $count++;
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function setIdEvent(id) {
        var idEvent = id.value;
        window.location.href = 'verify-orders?event=' + idEvent;
    }
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>