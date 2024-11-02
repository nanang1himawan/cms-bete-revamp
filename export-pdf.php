<?php

require_once('./dompdf/autoload.inc.php');

use Dompdf\Dompdf;

include "controller/controllerGuest.php";
$main = new controllerGuest();
$id_booking = $_GET["idBooking"];
$id_event = $_GET["idEvent"];
$tabel = "ticket_" . $id_event;
$hasil = $main->getTicketByidBooking($tabel, $id_booking);
foreach ($hasil as $dataTicket) {
    $nomorPendaftaran = $dataTicket["nomor_pendaftaran"];
}
$hasil2 = $main->getDataRecapTransactionByid($id_booking);

foreach ($hasil2 as $dataTicket2) {
    $nameBuyer = $dataTicket2["name_buyer"];
    $email = $dataTicket2["email"];
    $phoneBuyer = $dataTicket2["phoneBuyer"];
    $id_transaction = $dataTicket2["id"];
}
$hasil5 = $main->getDataEventById($id_event);
foreach ($hasil5 as $dataEvent) {
    $typeEvent = $dataEvent["type"];
}

$hasil3 = $main->getDataDetailTransaction($id_transaction);
$dataPeserta = "";
$index = 0;
foreach ($hasil3 as $dataTicket3) {
    $json_data = $dataTicket3["json_data"];
    $datatabel = json_decode($json_data);
    $player = $datatabel->player;
    $dataPartisipantConcertJson = $datatabel->data;
    if ($typeEvent == NULL) {
        $dataPeserta = $dataPeserta . "<table style=\"text-align: center; border-collapse: collapse; width: 100%; border: 1px solid black;\">
            <tr style=\"border: 1px solid black;\">
            <th>Keterangan</th>
            <th>Data Peserta</th>
            </tr>
            ";
        // for ($i = 0; $i < count($dataPartisipantConcertJson); $i++) {
            
            $id_ticket = $dataPartisipantConcertJson[$index]->id_ticket;
            $id_booking = $dataPartisipantConcertJson[$index]->id_booking;
            $id_ticket_category = $dataPartisipantConcertJson[$index]->id_ticket_category;
            $name = $dataPartisipantConcertJson[$index]->name;
            $ktp_id = $dataPartisipantConcertJson[$index]->ktp_id;
            $phone_number = $dataPartisipantConcertJson[$index]->phone_number;
            $email = $dataPartisipantConcertJson[$index]->email;
            $index++;

            $dataPeserta = $dataPeserta . "
                <tr style=\"border: 1px solid black;\">
                <td>Nama</td>
                <td>$name</td>`
                </tr>
                <tr style=\"border: 1px solid black;\">
                <td>NIK</td>
                <td>$ktp_id</td>`
                </tr>
                <tr style=\"border: 1px solid black;\">
                <td>No.Tlpn</td>
                <td>$phone_number</td>`
                </tr>
                <tr style=\"border: 1px solid black;\">
                <td>Email</td>
                <td>$email</td>`
                </tr>
                <tr style=\"border: 1px solid black;\">
                <td>-----</td>
                <td>-----</td>`
                </tr>
                
                ";
        // }
        $dataPeserta = $dataPeserta . "</table>";
    } else {
        for ($i = 0; $i < count($player); $i++) {
            $data = $player[$i]->data;
            $jumlahDataData = count($data);
            $dataPeserta = $dataPeserta . "<table style=\"text-align: center; border-collapse: collapse; width: 100%; border: 1px solid black;\">
            <tr style=\"border: 1px solid black;\">
            <th>Keterangan</th>
            <th>Data Peserta</th>
            </tr>
            ";
            for ($x = 0; $x < $jumlahDataData; $x++) {
                $value = $data[$x]->data;
                $kolom = $data[$x]->state;
                // echo $kolom."-".$value;`
                $dataPeserta = $dataPeserta . "
                <tr style=\"border: 1px solid black;\">
                <td>" . $kolom . "</td>
                <td>$value</td>`
                </tr>";
            }
            $dataPeserta = $dataPeserta . "</table>";
        }
    }
}

$hasil4 = $main->getDataEventById($id_event);

foreach ($hasil4 as $dataEvent) {
    $eventName = $dataEvent["name"];
    $eventLocation = $dataEvent["venue"];
    $startDate = $dataEvent["start_date"];
}

$messageInfomation = $main->getEmailInformation($id_event);
$messageIdBooking = "";
$messageEmail = "";
if ($id_event == "78c93452-5274-43e4-ab73-096cd64e555c") {
    $messageIdBooking = '
                <div style="background-color:white; margin-left: 1.5rem; margin-right: 1.5rem; padding-top: 1rem; padding-bottom: 1rem; text-align: center; border-radius: 0.5rem;">
                <div style="font-weight: 700; font-size: 24px;">Booking ID</div>
                <div style="font-weight: 700; font-size: 20px;">
                ' . $id_booking . '
                </div>
            </div>';
} else {
    if (mysqli_num_rows($messageInfomation) != 0) {
        foreach ($messageInfomation as $information) {
            $dataInformation = $information["information"];
        }

        $messageEmail = '
        <div style="background-color:white; margin-left: 1.5rem; margin-right: 1.5rem; padding-top: 1rem; padding-bottom: 1rem; text-align: center; border-radius: 0.5rem;">
        <div style="font-weight: 700; font-size: 10px;">Informasi Event</div>
        <div style="font-weight: 700; font-size: 15px;">
        ' . $dataInformation . '
        </div>
            </div>
        ';
    }
}

$dompdf = new Dompdf();

$html = '
        
<div style="background:#FFB103; padding: 16px; max-width: 80rem; margin-left: auto; margin-right: auto;">
    <div>
                    <p style="font-weight: 700;"> 
                    Event Detail
                    </p>
                    <table style="width: 100%;">
                    <tbody>
                        <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td style="width: 80%;">' . $eventName . '</td>
                        </tr>
                        <tr>
                        <td>Lokasi</td>
                        <td>:</td>
                        <td style="width: 80%;">' . $eventLocation . '</td>
                        </tr>
                        <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td style="width: 80%;">' . $startDate . '</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div>
                    <p style="font-weight: 700;"> 
                    Pendaftar
                    </p>
                    <table style="width: 100%;">
                    <tbody>
                        <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td style="width: 80%;">' . $nameBuyer . '</td>
                        </tr>
                        <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td style="width: 80%;">' . $email . '</td>
                        </tr>
                        <td>Nomor Telpon</td>
                        <td>:</td>
                        <td style="width: 80%;">' . $phoneBuyer . '</td>
                        </tr>
                    </tbody>
                    </table>
                    <br>
                </div>

        ' . $messageIdBooking . '

        <br>
        <br>
        <div style="background-color:#ffffff; margin-left: 1.5rem; margin-right: 1.5rem; padding-top: 1rem; padding-bottom: 1rem; text-align: center; border-radius: 0.5rem;">
            <div style="font-weight: 700; font-size: 24px;">Nomor Pendaftaran</div>
            <div style="font-weight: 700; font-size: 35px;">
                ' . $nomorPendaftaran . '
        </div>
        </div>
        <br>
        
        <div style="padding: 20px 0px;">
                <p style="font-weight: 700;"> 
                  Data Peserta:
                </p>
                ' . $dataPeserta . '
        </div>
        
</div>
' . $messageEmail . '
';

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'potrait');

$dompdf->render();

$dompdf->stream();
