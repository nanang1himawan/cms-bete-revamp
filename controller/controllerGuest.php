<?php

include "model/model.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "library/PHPMailer.php";
require_once "library/Exception.php";
require_once "library/OAuth.php";
require_once "library/POP3.php";
require_once "library/SMTP.php";

class controllerGuest
{

    public $model;

    function __construct()
    {
        $this->model = new model();
    }

    function guidv4($data = null)
    {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    function generateQrCode($id)
    {
        include "phpqrcode/qrlib.php";

        $tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
        if (!file_exists($tempdir)) //Buat folder bername temp
            mkdir($tempdir);

        //isi qrcode jika di scan
        $codeContents = $id;
        //nama file qrcode yang akan disimpan
        $namaFile = $id . '.png';
        // $namaFile="001-sdfasd-asdfas.png";
        //ECC Level
        $level = QR_ECLEVEL_H;
        //Ukuran pixel
        $UkuranPixel = 10;
        //Ukuran frame
        $UkuranFrame = 4;

        QRcode::png($codeContents, $tempdir . $namaFile, $level, $UkuranPixel, $UkuranFrame);

        //image PNG menjadi base64
        $imagedata = file_get_contents($tempdir . $namaFile);
        $data = base64_encode($imagedata);
        return $data;
    }


    function get_guest_view_by_id($id_guest)
    {
        $data = $this->model->getGuestById($id_guest);
        // var_dump($data);
        if (mysqli_num_rows($data) == 0) {
            include "view/welcomeError.php";
        } else {
            include "view/welcomeGuestWedding.php";
        }
    }



    function get_guest_by_id($id_guest)
    {
        $data = $this->model->getGuestById($id_guest);
        return $data;
    }

    function insertDataOrganizer($name, $email, $address, $phone, $id_npwp)
    {
        $id_guest = $this->guidv4();
        $data = $this->model->insertOrganizer($id_guest, $name, $email, $address, $phone, $id_npwp);
        return $data;
    }
    function insertDataCategoryEvent($name)
    {
        $id_guest = $this->guidv4();
        $data = $this->model->insertCategoryEvent($id_guest, $name);
        return $data;
    }
    function insertDataForm($name, $create_by)
    {
        $id_form = $this->guidv4();
        $data = $this->model->insertForm($id_form, $name, $create_by);
        return $data;
    }
    function insertDataCategoryTicket($name, $idEvent, $price, $stock, $status)
    {
        $id_ticket = $this->guidv4();
        $data = $this->model->insertCategoryTicket($id_ticket, $name, $idEvent, $price, $stock, $status);
        $tabel = "ticket_$idEvent";
        $data2 = $this->model->cekTabel($tabel);

        if ($data2 == false) {
            $data3 = $this->model->createTabelTicket($tabel);
        }

        for ($i = 0; $i < $stock; $i++) {
            $id = $this->guidv4();
            $data4 = $this->model->insertTicket($tabel, $id, $idEvent, $id_ticket);
        }

        return $data;
    }
    function updateDataTicketCategory($id_ticket, $idEvent, $name, $price, $stock, $status, $stockGap)
    {
        $data = $this->model->updateCategoryTicket($id_ticket, $name, $price, $stock, $status);
        $tabel = "ticket_$idEvent";

        for ($i = 0; $i < $stockGap; $i++) {
            $id = $this->guidv4();
            $data4 = $this->model->insertTicket($tabel, $id, $idEvent, $id_ticket);
        }
        return $data;
    }

    function getTicketByidBooking($tabel, $id_booking)
    {
        $data = $this->model->getDataTicketByIdBooking($tabel, $id_booking);
        return $data;
    }
    function getTicketByid($tabel, $id)
    {
        $data = $this->model->getDataTicketById($tabel, $id);
        return $data;
    }

    function insertDetailForm($idForm, $label, $type, $state, $placeholder, $minlength, $maxlength)
    {
        $id = $this->guidv4();
        $data = $this->model->insertDataFormDetail($id, $idForm, $label, $type, $state, $placeholder, $minlength, $maxlength);
        return $data;
    }
    function UpdateFormDetail($id, $label, $type, $state, $placeholder, $minlength, $maxlength)
    {
        $data = $this->model->updateDataFormDetail($id, $label, $type, $state, $placeholder, $minlength, $maxlength);
        return $data;
    }
    function updateTransactionStatus($idTransaction, $status)
    {
        $data = $this->model->updateStatus($idTransaction, $status);
        return $data;
    }

    function updateEventStatus($idEvent, $status)
    {
        $data = $this->model->updateStatusEvent($idEvent, $status);
        return $data;
    }

    function updateStatusTicket($tabel, $id_guest, $status)
    {
        $data = $this->model->updateStatusTicket($tabel, $id_guest, $status);
        return $data;
    }

    function getDataPartisipantByIdTicket($id)
    {
        $data = $this->model->getPartisipantByIdTicket($id);
        return $data;
    }
    function getDataCustomePartisipantByIdTicket($id)
    {
        $data = $this->model->getCustomPartisipantByIdTicket($id);
        return $data;
    }

	function insertDataEmailSendInformation($id, $email, $idEvent, $category, $status){
        $data = $this->model->insertEmailSendInformation($id, $email, $idEvent, $category, $status);
        return $data;
    }
	
    function updateQRcodeTicket($tabel, $id, $category, $idBooking, $email, $idEvent, $nameBuyer)
    {

        include "phpqrcode/qrlib.php";
        $tempdir = "temp/";
        for ($i = 0; $i < count($id); $i++) {

            $codeContents = $id[$i];
            // echo $idfix . '<br>';
            // echo $idasli;
            // $level = QR_ECLEVEL_H;
            // Ukuran pixel
            // $UkuranPixel = 10;
            // Ukuran frame
            // $UkuranFrame = 4;

            //simpan file kedalam folder temp dengan nama 001.png
            // QRcode::png($codeContents, $tempdir . $codeContents . '.png', $level, $UkuranPixel, $UkuranFrame);
            // $imagedata = file_get_contents($tempdir . $codeContents . '.png');
            // $data = base64_encode($imagedata);
            $data = "ready";
            if ($idEvent == "cf9f7ad4-baf8-43c8-a9bf-3a1a0c817b03" || $idEvent == "15eb4e2d-2393-4913-ad23-71bb2be3d2cc") {
				$category = "BT";
                $nomor_pendaftaran = $this->getNomorPendaftaran($category, $idEvent);
            } else {
                $nomor_pendaftaran = $idBooking;
            }
            $data2 = $this->model->updateQrCodeTicket($tabel, $codeContents, $data, $nomor_pendaftaran);


            // echo "kirim email";
        }
        $emailResult = $this->sendEmail($email, $idBooking, $nomor_pendaftaran, $idEvent, $nameBuyer);
		
		$idEmailSend = $this->guidv4();
        if ($emailResult == "failed") {
            $this->insertDataEmailSendInformation($idEmailSend, $email, $idEvent, "cms-verify", "failed");
        }else{
            $this->insertDataEmailSendInformation($idEmailSend, $email, $idEvent, "cms-verify", "success");
        }
		
        return $data2;
    }


    function getNomorPendaftaran($category, $idEvent)
    {
       
			$lastNo = $this->model->getBiggesNoPendaftaran($category, $idEvent);
            foreach ($lastNo as $last) {
                $nomorLast = $last["maxNo"];
            }

            if ($nomorLast == "") {
                $nomorLast = "0000";
            }
            $code = "";
            $nomor = "1" . substr($nomorLast, 0, 4);
            $nomor = $nomor + 1;
            $nomorPendaftaran = $code . $nomor;
            $nomor2 = substr($nomorPendaftaran, 1, 4);
            $nomorPendaftaran2 = "$nomor2";
		
            //$lastNo = $this->model->getBiggesNoPendaftaran($category, $idEvent);
            //foreach ($lastNo as $last) {
            //    $nomorLast = $last["maxNo"];
            //}

            //if ($nomorLast == "") {
                $nomorLast = "BT0000";
            //}
            //$code = "BT";
            //$nomor = "1" . substr($nomorLast, 2, 5);
            //$nomor = $nomor + 1;
            //$nomorPendaftaran = $code . $nomor;
            //$nomor2 = substr($nomorPendaftaran, 3, 5);
            //$nomorPendaftaran2 = $code . $nomor2;

        return $nomorPendaftaran2;
    }

    function updateQRcodeTicketInvalid($tabel, $id)
    {
        for ($i = 0; $i < count($id); $i++) {

            $codeContents = $id[$i];

            $data = NULL;
            $nomor_pendaftaran = NULL;
            $data2 = $this->model->updateQrCodeTicket($tabel, $codeContents, $data, $nomor_pendaftaran);
        }
        return $data2;
    }

    function updateDataBanner($id, $name, $link, $image)
    {
        $data = $this->model->updateBanner($id, $name, $link, $image);
        return $data;
    }

    function insertCategoryEvent($name)
    {
        $id_guest = $this->guidv4();
        $data = $this->model->insertCategoryEvent($id_guest, $name);
        return $data;
    }

    function insertDataEvent($name, $category, $type, $minPlayer, $maxPlayer, $description, $termCondition, $venue, $location, $poster, $startDate, $endDate, $maps, $create_by, $formSelect)
    {
        $id_event = $this->guidv4();
        $data = $this->model->insertEvent($id_event, $name, $category, $type, $minPlayer, $maxPlayer, $description, $termCondition, $venue, $location, $poster, $startDate, $endDate, $maps, $create_by, $formSelect);
        return $data;
    }

    function insertDataBanner($id, $name, $link, $image)
    {
        $id = $this->guidv4();
        $data = $this->model->insertBanner($id, $name, $link, $image);
        return $data;
    }

    function updateDataOrganizer($id, $name, $email, $address, $phone, $id_npwp)
    {
        $data = $this->model->updateOrganizer($id, $name, $email, $address, $phone, $id_npwp);
        return $data;
    }
    function updateDataCategoryEvent($id, $name)
    {
        $data = $this->model->updateCategoryEvent($id, $name);
        return $data;
    }
    function updateDataEvent($id, $name, $category, $type, $minPlayer, $maxPlayer, $description, $termCondition, $venue, $location, $startDate, $endDate, $maps, $create_by, $formSelect)
    {
        $data = $this->model->updateEvent($id, $name, $category, $type, $minPlayer, $maxPlayer, $description, $termCondition, $venue, $location, $startDate, $endDate, $maps, $create_by, $formSelect);
        return $data;
    }
    function updateDataImgEvent($id, $poster)
    {
        $data = $this->model->updateImgEvent($id, $poster);
        return $data;
    }

    function updateDataTalent($id, $name, $subtitle, $image)
    {
        $data = $this->model->updateTalent($id, $name, $subtitle, $image);
        return $data;
    }

    function getDataOrganizer()
    {
        $data = $this->model->getAllOrganizer();
        return $data;
    }
    function getDataCustomePartisipant()
    {
        $data = $this->model->getAllCustomePartisipant();
        return $data;
    }
    function getDataCustomePartisipantByIdEvent2($idEvent)
    {
        $data = $this->model->getAllCustomePartisipantByIdEvent2($idEvent);
        return $data;
    }
    function getDataCustomePartisipantByIdEvent($idEvent)
    {
        $data = $this->model->getAllCustomePartisipantByIdEvent($idEvent);
        return $data;
    }
    function getDataTransactionByIdEvent($idEvent)
    {
        $data = $this->model->getTrasanctionByIdEvent($idEvent);
        return $data;
    }
    function getDataTransactionByIdBooking($idBooking)
    {
        $data = $this->model->getTransactionByIdBooking($idBooking);
        return $data;
    }

    function getDataRecapTransactionStatus()
    {
        $data = $this->model->getRecapTransactionStatus();
        return $data;
    }
    function getDataRecapTransactionByid($id)
    {
        $data = $this->model->getAllTransactionByIdEvent($id);
        return $data;
    }

    function getDataTicketByIdEvent($id)
    {
        $data = $this->model->getTicketByIdEvent($id);
        return $data;
    }
    function getDetailFormByIdForm($id)
    {
        $data = $this->model->getFormByIdForm($id);
        return $data;
    }
    function getDataEvent()
    {
        $data = $this->model->getAllEvent();
        return $data;
    }
    function getDataEventByCreateBy($idGuest)
    {
        $data = $this->model->getAllEventByCreateBy($idGuest);
        return $data;
    }
    function getDataTicketById($id)
    {
        $data = $this->model->getTicketById($id);
        return $data;
    }
    function getDataTransaction()
    {
        $data = $this->model->getAllTransaction();
        return $data;
    }
    function getDataTransactionByEvent($idEvent)
    {
        $data = $this->model->getTransactionByIdEvent($idEvent);
        return $data;
    }
    function getDataTransactionByOrganizer($id_organizer)
    {
        $data = $this->model->getAllTransactionByOrganizerId($id_organizer);
        return $data;
    }
    function getDataTransactionByOrganizerByIdEvent($id_organizer, $idEvent)
    {
        $data = $this->model->getAllTransactionByOrganizerIdByIdEvent($id_organizer, $idEvent);
        return $data;
    }
    function getDataDetailTransaction($idEvent)
    {
        $data = $this->model->getDetailTransaction($idEvent);
        return $data;
    }

    function getRecapTransactionByOrganizerId($id_organizer)
    {
        $data = $this->model->getTransactionByOrganizerId($id_organizer);
        return $data;
    }

    function getDataIdtTicketByIdCustomPartisipant($id)
    {
        $data = $this->model->getIdtTicketByIdCustomPartisipant($id);
        return $data;
    }

    function getBuyerById($id)
    {
        $data = $this->model->getDataBuyerById($id);
        return $data;
    }

    function getDataTotalTicket($tabel)
    {
        $data = $this->model->getTotalTicket($tabel);
        return $data;
    }
    function getDataRecapAttendance($tabel)
    {
        $data = $this->model->getRecapAttendance($tabel);
        return $data;
    }

    function getDataEventById($id)
    {
        $data = $this->model->getEventById($id);
        return $data;
    }
    function getDetailFormById($id)
    {
        $data = $this->model->getFormDetailById($id);
        return $data;
    }
    function getDataFormById($id)
    {
        $data = $this->model->getFormById($id);
        return $data;
    }
    function getDataCategoryEvent()
    {
        $data = $this->model->getAllCategoryEvent();
        return $data;
    }
    function getDataForm()
    {
        $data = $this->model->getAllForm();
        return $data;
    }
    function getDataFormByGuestId($id_guest)
    {
        $data = $this->model->getAllFormByGuestId($id_guest);
        return $data;
    }

    function getDataCategoryEventById($id_category)
    {
        $data = $this->model->getCategoryEventById($id_category);
        return $data;
    }

    function getDataBanner()
    {
        $data = $this->model->getAllBanner();
        return $data;
    }

    function getDataTalent()
    {
        $data = $this->model->getAllTalent();
        return $data;
    }

    function insertDataTalent($id, $name, $subtitle, $image)
    {
        $id = $this->guidv4();
        $data = $this->model->insertTalent($id, $name, $subtitle, $image);
        return $data;
    }

    function getDataTicketCategoryByEventId($id_event)
    {
        $data = $this->model->getTicketCategoryByEventId($id_event);
        return $data;
    }


    function insertDataQrCode($id_guest, $qr_code)
    {
        $data = $this->model->insertGuestByQrCode($id_guest, $qr_code);
        return $data;
    }
    function insertDataPhoto($id_guest, $photo)
    {
        $data = $this->model->insertGuestByPhoto($id_guest, $photo);
        return $data;
    }
    function insertDataAttend($id_guest, $attend)
    {
        $data = $this->model->insertGuestByAttend($id_guest, $attend);
        return $data;
    }
    function validateVisite($id_guest)
    {
        $data = $this->model->getGuestById($id_guest);
        $photo = null;
        foreach ($data as $value) {
            $photo = $value["photo"];
        }

        if ($photo == null) {
            $data2 = 0;
        } else {
            $data2 = $photo;
        }

        return $data2;
    }
    function getEmailInformation($id)
    {
        $data = $this->model->getEmailInformationByIdEvent($id);
        return $data;
    }

    function sendEmail($email, $id_booking, $nomorPendaftaran, $idEvent, $nameBuyer)
    {
        $mail = new PHPMailer;
		//Enable SMTP debugging. 
		$mail->SMTPDebug = 0;
		//Set PHPMailer to use SMTP.
		$mail->isSMTP();
		//Set SMTP host name                          
		$mail->Host = "110.webhostingindonesia.co.id"; //host mail server
		//$mail->Host = "kretek.idweb.host"; //host mail server
		//Set this to true if SMTP host requires authentication to send email
		$mail->SMTPAuth = true;
		//Provide username and password     
		//$mail->Username = "pasukan_belitiketevent@leokrisnoto.com";   //nama-email smtp          
		//$mail->Password = "145314097@Pancasila.";           //password email smtp
		$mail->Username = "info@belitiketevent.com";   //nama-email smtp          
		$mail->Password = "7N4ijg13*";           //password email smtp
		//If SMTP requires TLS encryption then set it
		$mail->SMTPSecure = "tls";
		//Set TCP port to connect to 
		$mail->Port = 587;

		//$mail->From = "pasukan_belitiketevent@leokrisnoto.com"; //email pengirim
		$mail->From = "info@belitiketevent.com"; //email pengirim
		$mail->FromName = "Beli Tiket Event"; //nama pengirim

		$mail->addAddress($email, $email); //email penerima

		$mail->isHTML(true);

        // Message

        $dataEventById = $this->getDataEventById($idEvent);

        foreach ($dataEventById as $dataEvent) {
            $eventName = $dataEvent["name"];
            $eventLocation = $dataEvent["venue"];
            $startDate = $dataEvent["start_date"];
        }

        $messageInfomation = $this->getEmailInformation($idEvent);
        $messageIdBooking = "";
        $messageEmail = "";
        if ($idEvent == "78c93452-5274-43e4-ab73-096cd64e555c") {
            $messageIdBooking = '
                <div style="background-color:white; margin-left: 1.5rem; margin-right: 1.5rem; padding-top: 1rem; padding-bottom: 1rem; text-align: center; border-radius: 0.5rem;">
                <div style="font-weight: 700; font-size: 24px;">Booking ID</div>
                <div style="font-weight: 700; font-size: 24px;">
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
                    <div style="font-weight: 700; font-size: 24px;">Informasi Event</div>
                    <div style="font-weight: 700; font-size: 16px;">
                    ' . $dataInformation . '
                    </div>
                </div>
            ';
            }
        }





        $message = '
        <div style="bakcround-color: white;">
        <div style="max-width: 80rem; padding: 30px 0px; margin-left: auto; margin-right: auto; overflow: hidden;">
          <table style="width: 100%;">
            <td>
              <a href="https://belitiketevent.com/">
                <img width="250" height="120" src="https://dashboard.belitiketevent.com/assets/logo-bete-color.png" alt="logo">
              </a>
            </td>
          </table>
        </div>
        <div style="display: grid; gap: 1rem; grid-template-columns: repeat(1, minmax(0, 1fr)); grid-auto-flow: row; background: var(--orange, #FFB103); padding: 16px; max-width: 80rem; margin-left: auto; margin-right: auto;">
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
                </tbody>
                </table>
                <br>
            </div>
            
            ' . $messageIdBooking . '

              <br>
              <br>
          <div style="background-color:white; margin-left: 1.5rem; margin-right: 1.5rem; padding-top: 1rem; padding-bottom: 1rem; text-align: center; border-radius: 0.5rem;">
            <div style="font-weight: 700; font-size: 24px;">Nomor Pendaftaran</div>
            <div style="font-weight: 700; font-size: 40px;">
              ' . $nomorPendaftaran . '
            </div>
          </div>
            <br>
            <br>

            ' . $messageEmail . '

        </div>
        <div style="max-width: 80rem; padding: 2rem 1rem; margin-left: auto; margin-right: auto;">
          <a target="_blank" href="https://dashboard.belitiketevent.com/cms-bete/export-pdf?idBooking=' . $id_booking . '&idEvent=' . $idEvent . '">
            Download
          </a>
        </div>
        <div>
          <div style="max-width: 80rem; display: flex; margin-left: auto; margin-right: auto; flex-direction: column; padding: 0px 1rem;">
           
            <div style="align-items:center; width: 100%; margin-top: 2rem; margin-bottom: 2rem; gap: 1rem;">
              <table style="width:100%;">
                <td style="text-align: end;">
                  <div style="display: inline-block;">
                    <a href="https://www.instagram.com/belitiketeventofficial/">
                      <img src="https://dashboard.belitiketevent.com/assets/Logo-Instagram.png" alt="logo-ig">
                    </a>
                  </div>
                </td>
                <td>
                  <div style="display: inline-block; border-left: white solid 10px;">
                    <a href="https://api.whatsapp.com/send/?phone=6282325295912">
                      <img src="https://dashboard.belitiketevent.com/assets/Logo-Whatsapp.png" alt="logo-wa">
                    </a>
                  </div>
                </td>
              </table>
            </div>
          </div>
          <div style="background: var(--orange, #FFB103); padding: 20px 30px;">
            <div style="max-width: 80rem;  margin-left: auto; margin-right: auto; width: 100%; ">
              Beli Tiket Event Â© 2023. All Right Reserved
            </div>
          </div>
        </div>
      </div>';
        $mail->Subject = "Pendaftaran"; //subject
        $mail->Body = "<p>{$message}</p>"; //isi email
        $mail->AltBody = "Pendaftaran"; //body email (optional)

        if (!$mail->send()) {
            return "failed";
        } else {
            return "success";
        }
    }


    function fetch($result)
    {
        return mysqli_fetch_assoc($result);
    }

    function __destruct()
    {
    }
}
