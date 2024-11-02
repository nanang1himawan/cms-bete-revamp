<?php
class model
{

    function __construct()
    {
    }

    function execute($query)
    {
        $connect = $this->Connection();
        return mysqli_query($connect, $query);
    }

    function Connection()
    {
        // return mysqli_connect("localhost", "root", "", "belitiketevent-dev");
        // return mysqli_connect("localhost", "root", "", "customer-double");
        // return mysqli_connect("localhost", "omnitynd_bete", "g93X4g2_s", "omnitynd_bete");
        // return mysqli_connect("localhost", "root", "", "bete4");
        return mysqli_connect("localhost", "omnitynd_dev", "password_omnitynd_dev", "omnitynd_dev_bete");
        // return mysqli_connect("leokrisnoto.com", "leokrisn", "511MwrsBm2", "leokrisn_bete_dev");
    }

    function getGuest()
    {
        $query = "select * from guest";
        return $this->execute($query);
    }


    function updateOtpOrganizer($otp, $id_organizer)
    {
        $query1 = "SELECT * FROM auth WHERE id_actor='$id_organizer'";

        if (mysqli_num_rows($this->execute($query1)) == 1) {
            $query = "UPDATE `auth` SET `otp`=\"$otp\" WHERE `id_actor` = \"$id_organizer\"";
        } else {
            $query = "INSERT INTO `auth` (`id_actor`,`otp`) VALUES ('$id_organizer', '$otp')";
        }

        if ($this->execute($query)) {
            $this->loadingHtml();
            $status = true;
        }
        return $status;
    }
    function updateOtp($otp, $email)
    {
        $query = "UPDATE `admin_bete` SET `otp`=\"$otp\" WHERE `email` = \"$email\"";

        if ($this->execute($query)) {
            $this->loadingHtml();
            $status = true;
        }

        return $status;
    }

    function getAllOrganizer()
    {
        $query = "SELECT * FROM organizers";
        return $this->execute($query);
    }
    function getTicketByIdEvent($id)
    {
        $query = "SELECT * FROM ticket_category WHERE `id_event`='$id'";
        return $this->execute($query);
    }
    function getTicketById($id)
    {
        $query = "SELECT * FROM ticket_category WHERE `id`='$id'";
        return $this->execute($query);
    }
    function getFormByIdForm($id)
    {
        $query = "SELECT * FROM form WHERE `id_form`='$id'";
        return $this->execute($query);
    }
    function getAllEvent()
    {
        $query = "SELECT event.*, event_category.type FROM `event` 
        LEFT JOIN event_category ON event.id_event_category = event_category.id";
        return $this->execute($query);
    }
    function getAllEventByCreateBy($id)
    {
        $query = "SELECT event.*, event_category.type FROM `event` 
        LEFT JOIN event_category ON event.id_event_category = event_category.id
        WHERE `create_by` = '$id' ORDER BY event.name";
        return $this->execute($query);
    }
    function getAllCustomePartisipant()
    {
        $query = "SELECT * FROM `custome_partisipants`";
        return $this->execute($query);
    }
    function getAllCustomePartisipantByIdEvent2($idEvent)
    {
        // $query = "SELECT * FROM `custome_partisipants` WHERE `id_event`='$idEvent'";
        $query = "SELECT event_category.name AS event_category, custome_partisipants.*
        FROM ((event 
        INNER JOIN event_category ON event.id_event_category = event_category.id)
        INNER JOIN custome_partisipants ON custome_partisipants.id_event = event.id)
        WHERE event.id = '$idEvent'";

        return $this->execute($query);
    }
    function getAllCustomePartisipantByIdEvent($idEvent)
    {
        $query = "SELECT * FROM `custome_partisipants` WHERE `id_event`='$idEvent'";
        return $this->execute($query);
    }

    function getTrasanctionByIdEvent($idEvent)
    {
        $query = "SELECT * FROM `transaction` WHERE `id_event`='$idEvent'";
        return $this->execute($query);
    }

    function getRecapTransactionStatus()
    {

        $query = "SELECT COUNT(IF(status='wfp',status,NULL)) AS WFP,
        COUNT(IF(status='process',status,NULL)) AS WFA,
        COUNT(IF(status='verified' or status='verify',status,NULL)) AS VERIFIED,
        COUNT(IF(status='invalid',status,NULL)) AS INVALID,
        COUNT(IF(status='canceled',status,NULL)) AS CANCELED
        FROM transaction;
        ";
        return $this->execute($query);
    }
    function getAllTransactionByIdEvent($id)
    {
        $query = "SELECT buyer.name AS name_buyer, buyer.phone_number AS phoneBuyer, buyer.email AS email, event.name AS name_event, event.id AS id_event, transaction.id_booking AS id_booking, transaction.create_date, transaction.id, transaction.total, transaction.payment_receipt, transaction.status
        FROM ((transaction
        INNER JOIN buyer ON transaction.id_buyer = buyer.id)
        INNER JOIN event ON transaction.id_event = event.id)
        WHERE transaction.id_booking = '$id'";
        return $this->execute($query);
    }

    function getTransactionByOrganizerId($id_organizer)
    {
        $query = "SELECT COUNT(IF(transaction.status='wfp',transaction.status,NULL)) AS WFP,
        COUNT(IF(transaction.status='process',transaction.status,NULL)) AS WFA,
        COUNT(IF(transaction.status='verified' or transaction.status='verify',transaction.status,NULL)) AS VERIFIED,
        COUNT(IF(transaction.status='invalid',transaction.status,NULL)) AS INVALID,
        COUNT(IF(transaction.status='canceled',transaction.status,NULL)) AS CANCELED
        FROM ((transaction 
        INNER JOIN event ON transaction.id_event = event.id)
        INNER JOIN organizers ON event.create_by = organizers.id)
        WHERE organizers.id = '$id_organizer'";
        return $this->execute($query);
    }

    function getAllTransaction()
    {
        $query = "SELECT buyer.name AS name_buyer, buyer.phone_number AS phoneBuyer, buyer.email AS email, event.type AS typeForm, event.name AS name_event, event.id AS id_event, transaction.id_booking AS id_booking, transaction.create_date, transaction.id, transaction.total, transaction.payment_receipt, transaction.status
        FROM ((transaction
        INNER JOIN buyer ON transaction.id_buyer = buyer.id)
        INNER JOIN event ON transaction.id_event = event.id)";
        return $this->execute($query);
    }
    function getTransactionByIdEvent($idEvent)
    {
        $query = "SELECT buyer.name AS name_buyer, buyer.phone_number AS phoneBuyer, buyer.email AS email, event.type AS typeForm, event.name AS name_event, event.id AS id_event, transaction.id_booking AS id_booking, transaction.create_date, transaction.id, transaction.total, transaction.payment_receipt, transaction.status
        FROM ((transaction
        INNER JOIN buyer ON transaction.id_buyer = buyer.id)
        INNER JOIN event ON transaction.id_event = event.id)
        WHERE (transaction.id_event  = '$idEvent')";
        return $this->execute($query);
    }

    function getAllTransactionByOrganizerId($id_organizer)
    {
        $query = "SELECT buyer.name AS name_buyer, buyer.phone_number AS phoneBuyer, buyer.email AS email, event.type AS typeForm, event.name AS name_event, event.id AS id_event, transaction.id_booking AS id_booking, transaction.create_date, transaction.id, transaction.total, transaction.payment_receipt, transaction.status, event_category.type
        FROM (((transaction
        INNER JOIN buyer ON transaction.id_buyer = buyer.id)
        INNER JOIN event ON transaction.id_event = event.id)
        INNER JOIN event_category ON event.id_event_category = event_category.id)
        WHERE (event.create_by = '$id_organizer') AND (event_category.type = 'Private');";
        return $this->execute($query);
    }
    function getAllTransactionByOrganizerIdByIdEvent($id_organizer,$idEvent)
    {
        $query = "SELECT buyer.name AS name_buyer, buyer.phone_number AS phoneBuyer, buyer.email AS email, event.type AS typeForm, event.name AS name_event, event.id AS id_event, transaction.id_booking AS id_booking, ticket_category.price AS priceTicket, transaction.create_date, transaction.id, transaction.total, transaction.payment_receipt, transaction.status, event_category.type
        FROM ((((transaction
        INNER JOIN buyer ON transaction.id_buyer = buyer.id)
        INNER JOIN event ON transaction.id_event = event.id)
        INNER JOIN event_category ON event.id_event_category = event_category.id)
        INNER JOIN ticket_category ON transaction.id_event = ticket_category.id_event)
        WHERE ((event.create_by = '$id_organizer') AND (transaction.id_event  = '$idEvent')) AND (event.id_form != '' )  AND (event_category.type = 'Private' OR ticket_category.price = '0');";
        return $this->execute($query);
    }
    function getTotalTicket($tabel){
        $query = "SELECT COUNT(`QRcode`) AS total 
                FROM `$tabel` 
                WHERE `QRcode` IS NOT NULL AND `QRcode` != ''";
        return $this->execute($query);
    }
    
    function getRecapAttendance($tabel){
        $query ="SELECT COUNT(IF(QRcode = 'ready', QRcode, NULL)) AS TotalReady, 
        COUNT(IF(QRcode = 'check-in', QRcode, NULL)) AS TotalCheckin, 
        COUNT(IF(QRcode = 'check-out', QRcode, NULL)) AS TotalCheckout 
        FROM `$tabel`";
        return $this->execute($query);
    }
    function getIdtTicketByIdCustomPartisipant($id)
    {
        $query = "SELECT * FROM `detail_transaction` WHERE `id_custome_partisipant` = '$id'";
        return $this->execute($query);
    }

    function getEmailInformationByIdEvent($id)
    {
        $query = "SELECT * FROM `email_information` WHERE `id_event` = '$id'";
        return $this->execute($query);
    }

    function getBiggesNoPendaftaran($category, $idEvent)
    {
        // $query = "SELECT MAX(nomor_pendaftaran) AS maxNo FROM `ticket_$idEvent` WHERE nomor_pendaftaran LIKE '$category%'";
		$query = "SELECT MAX(nomor_pendaftaran) AS maxNo FROM `ticket_$idEvent`";
        return $this->execute($query);
    }

    function getDetailTransaction($idTransaction)
    {
        $query = "SELECT custome_partisipants.id AS id_custome_partisipants, custome_partisipants.json_data AS json_data
        FROM (detail_transaction
        INNER JOIN custome_partisipants ON detail_transaction.id_custome_partisipant = custome_partisipants.id)
        WHERE `id_transaction` = '$idTransaction'";
        return $this->execute($query);
    }
    function getDataBuyerById($id)
    {
        $query = "SELECT * FROM buyer WHERE `id`='$id'";
        return $this->execute($query);
    }

    function getTransactionByIdBooking($id_booking)
    {
        $query = "SELECT * FROM `transaction` WHERE `id_booking` = '$id_booking'";
        return $this->execute($query);
    }

    function getEventById($id)
    {
        $query = "SELECT * FROM `event` WHERE `id`='$id'";
        return $this->execute($query);
    }
    function getFormDetailById($id)
    {
        $query = "SELECT * FROM `form_detail` WHERE `id_form`='$id'";
        return $this->execute($query);
    }
    function getAllCategoryEvent()
    {
        $query = "SELECT * FROM event_category";
        return $this->execute($query);
    }
    function getAllForm()
    {
        $query = "SELECT * FROM form";
        return $this->execute($query);
    }

    function getAllFormByGuestId($id_guest)
    {
        $query = "SELECT * FROM form WHERE `create_by`='$id_guest'";
        return $this->execute($query);
    }

    function getAllBanner()
    {
        $query = "SELECT * FROM banner";
        return $this->execute($query);
    }

    function getAllTalent()
    {
        $query = "SELECT * FROM talent";
        return $this->execute($query);
    }

    function getFormById($id)
    {
        $query = "SELECT * FROM form WHERE `id`='$id'";
        return $this->execute($query);
    }

    function getCategoryEventById($id_category)
    {
        $query = "SELECT * FROM `event_category` WHERE `id`='$id_category' ";
        return $this->execute($query);
    }

    function getTicketCategoryByEventId($id_event)
    {
        $query = "SELECT event.name, ticket_category.sold, ticket_category.stock AS available FROM ticket_category INNER JOIN event on event.id = ticket_category.id_event WHERE id_event = '$id_event'";
        return $this->execute($query);
    }

    function checking_email($email)
    {
        $query = "SELECT * FROM admin_bete WHERE email='$email'";
        return $this->execute($query);
    }
    function checking_email_organizer($email)
    {
        $query = "SELECT * FROM organizers WHERE email='$email'";
        return $this->execute($query);
    }

    function login_admin($email, $password)
    {
        $query = "SELECT * FROM admin_bete WHERE email='$email' and otp='$password'";
        return $this->execute($query);
    }
    function login_organizer($id_organizer, $password)
    {
        $query = "SELECT * FROM auth WHERE id_actor='$id_organizer' and otp='$password'";
        return $this->execute($query);
    }

    function checking_otp($email, $otp)
    {
        $query = "SELECT * FROM admin_bete WHERE email='$email' and otp='$otp'";
        return $this->execute($query);
    }

    function getGuestById($id_guest)
    {
        $query = "select * from `guest` where `id_guest`='$id_guest'";
        return $this->execute($query);
    }

    function insertGuest($nik, $name, $photo, $qr_code)
    {
        $query = "INSERT INTO `guest` (`nik`,`name`,`photo`,`qr_code`) VALUES ('$nik', '$name', '$photo', '$qr_code')";
        return $this->execute($query);
    }
    function insertOrganizer($id_guest, $name, $email, $address, $phone, $id_npwp)
    {
        $query = "INSERT INTO `organizers` (`id`,`name`,`address`,`email`,`phone_number`,`npwp`) VALUES ('$id_guest','$name','$address','$email','$phone','$id_npwp')";
        return $this->execute($query);
    }
    function insertCategoryEvent($id_guest, $name)
    {
        $query = "INSERT INTO `event_category` (`id`,`name`) VALUES ('$id_guest','$name')";
        return $this->execute($query);
    }
    function insertForm($id_form, $name, $create_by)
    {
        $query = "INSERT INTO `form` (`id`,`form_name`,`create_by`) VALUES ('$id_form','$name','$create_by')";
        return $this->execute($query);
    }
	
	function insertEmailSendInformation($id, $email, $idEvent, $category, $status)
    {
        $query = "INSERT INTO `email_send_information`(`id`, `email`, `note`, `category`, `status`) 
                  VALUES ('$id','$email','$idEvent','$category','$status')";
        return $this->execute($query);
    }
	
    function insertCategoryTicket($id_ticket, $name, $idEvent, $price, $stock, $status)
    {
        $query = "INSERT INTO `ticket_category` (`id`, `id_event`, `name`, `price`, `stock`, `status`) VALUES ('$id_ticket', '$idEvent', '$name', '$price', '$stock', '$status')";
        return $this->execute($query);
    }
    function updateCategoryTicket($id, $name, $price, $stock, $status)
    {
        $query = "UPDATE `ticket_category` SET `name`='$name',`price`='$price',`stock`='$stock',`status`='$status' WHERE `ticket_category`.`id` = '$id'";
        return $this->execute($query);
    }
    function insertDataFormDetail($id, $idForm, $label, $type, $state, $placeholder, $minlength, $maxlength)
    {
        $query = "INSERT INTO `form_detail` (`id`, `id_form`, `label`, `type`, `state`, `placeholder`, `minlength`, `maxlength`) VALUES ('$id', '$idForm', '$label', '$type', '$state', '$placeholder', '$minlength', '$maxlength')";
        return $this->execute($query);
    }
    function updateDataFormDetail($id, $label, $type, $state, $placeholder, $minlength, $maxlength)
    {
        $query = "UPDATE `form_detail` SET `label`='$label',`type`='$type',`state`='$state',`placeholder`='$placeholder',`minlength`='$minlength',`maxlength`='$maxlength' WHERE `form_detail`.`id` = '$id'";

        return $this->execute($query);
    }

    function updateStatus($idTransaction, $status)
    {
        $query = "UPDATE `transaction` SET `status`='$status' WHERE `transaction`.`id` = '$idTransaction'";
        return $this->execute($query);
    }

    function updateStatusEvent($idEvent, $status)
    {
        $query = "UPDATE `event` SET `status`='$status' WHERE `event`.`id` = '$idEvent'";
        return $this->execute($query);
    }

    function getPartisipantByIdTicket($id)
    {
        $query = "SELECT *
        FROM detail_transaction
        INNER JOIN partisipants ON detail_transaction.id_partisipant = partisipants.id
        WHERE `id_ticket` = '$id'";
        return $this->execute($query);
    }
    function getCustomPartisipantByIdTicket($id)
    {
        $query = "SELECT *
        FROM detail_transaction
        INNER JOIN custome_partisipants ON detail_transaction.id_custome_partisipant = custome_partisipants.id
        WHERE `id_ticket` = '$id'";
        return $this->execute($query);
    }

    function updateQrCodeTicket($tabel, $id, $qrCode, $nomor_pendaftaran)
    {
        $query = "UPDATE `$tabel` SET `QRcode`='$qrCode',`nomor_pendaftaran`='$nomor_pendaftaran' WHERE `$tabel`.`id` = '$id'";
        return $this->execute($query);
    }

    function updateStatusTicket($tabel, $id_guest, $status)
    {
        $query = "UPDATE `$tabel` SET `QRcode`='$status' WHERE `$tabel`.`id` = '$id_guest'";
        return $this->execute($query);
    }

    function updateNomorPendaftaranTicket($tabel, $id, $nomor_pendaftaran)
    {
        $query = "UPDATE `$tabel` SET `nomor_pendaftaran`='$nomor_pendaftaran' WHERE `$tabel`.`id` = '$id'";
        return $this->execute($query);
    }


    function createTabelTicket($tabel)
    {
        $query = "CREATE TABLE `$tabel` (id varchar(255), id_event varchar(255), QRcode longtext NULL,id_ticket_category varchar(255), id_booking varchar(255) NULL, nomor_pendaftaran varchar(100) NULL, PRIMARY KEY (id))";
        return $this->execute($query);
    }
    function insertTicket($tabel, $id, $idEvent, $id_ticket)
    {
        $query = "INSERT INTO `$tabel` (`id`, `id_event`, `id_ticket_category`) VALUES ('$id', '$idEvent', '$id_ticket')";
        return $this->execute($query);
    }
    function cekTabel($tabel)
    {
        $query = "SELECT * FROM `$tabel` LIMIT 1";
        return $this->execute($query);
    }

    function getDataTicketByIdBooking($tabel, $id_booking)
    {
        $query = "SELECT * FROM `$tabel` WHERE `id_booking` = '$id_booking'";
        return $this->execute($query);
    }
    function getDataTicketById($tabel, $id)
    {
        $query = "SELECT * FROM `$tabel` WHERE `id` = '$id'";
        return $this->execute($query);
    }

    function insertEvent($id_event, $name, $category, $type, $minPlayer, $maxPlayer, $description, $termCondition, $venue, $location, $poster, $startDate, $endDate, $maps, $create_by, $formSelect)
    {
        $query = "INSERT INTO `event` (`id`,`name`, `id_event_category`, `type`, `min_player`, `max_player`, `description`, `term_and_condition`, `venue`, `location`, `image`, `start_date`, `end_date`, `maps`, `create_by`, `id_form`) 
        VALUES ('$id_event','$name','$category','$type','$minPlayer','$maxPlayer','$description','$termCondition','$venue','$location','{$poster}','$startDate','$endDate','$maps','$create_by','$formSelect')";
        return $this->execute($query);
    }

    function updateOrganizer($id, $name, $email, $address, $phone, $id_npwp)
    {
        $query = "UPDATE `organizers` SET `email`='$email',`name`='$name',`address`='$address',`phone_number`='$phone',`npwp`='$id_npwp' WHERE `id` = '$id'";
        var_dump($query);
        return $this->execute($query);
    }
    function updateCategoryEvent($id, $name)
    {
        $query = "UPDATE `event_category` SET `name`='$name' WHERE `id` = '$id'";
        return $this->execute($query);
    }

    function updateEvent($id, $name, $category, $type, $minPlayer, $maxPlayer, $description, $termCondition, $venue, $location, $startDate, $endDate, $maps, $create_by, $formSelect)
    {
        $query = "UPDATE `event` SET `name`='$name',`id_event_category`='$category',`type`='$type',`min_player`='$minPlayer',`max_player`='$maxPlayer',`description`='$description',`term_and_condition`='$termCondition',`venue`='$venue',`location`='$location',`start_date`='$startDate',`end_date`='$endDate',`maps`='$maps',`create_by`='$create_by',`id_form`='$formSelect' WHERE `id` = '$id'";
        return $this->execute($query);
    }
    function updateImgEvent($id, $poster)
    {
        $query = "UPDATE `event` SET `image`='$poster' WHERE `id` = '$id'";
        return $this->execute($query);
    }
    function updateBanner($id, $name, $link, $image)
    {
        $query = "UPDATE `banner` SET `name`='$name',`link`='$link',`image`='$image' WHERE `banner`.`id` = '$id'";
        return $this->execute($query);
    }

    function updateTalent($id, $name, $subtitle, $image)
    {
        $query = "UPDATE `talent` SET `name`='$name',`subtitle`='$subtitle',`image`='$image' WHERE `talent`.`id` = '$id'";
        return $this->execute($query);
    }

    function insertGuestByQrCode($id_guest, $qr_code)
    {
        $query = "UPDATE `guest` SET `qr_code`='$qr_code' WHERE `guest`.`id_guest` = '$id_guest'";
        return $this->execute($query);
    }

    function insertGuestByPhoto($id_guest, $photo)
    {
        $query = "UPDATE `guest` SET `photo`='$photo' WHERE `guest`.`id_guest` = '$id_guest'";
        return $this->execute($query);
    }

    function insertBanner($id, $name, $link, $image)
    {
        $query = "INSERT INTO `banner` (`id`,`name`,`link`,`image`) VALUES ('$id', '$name', '$link', '{$image}')";
        return $this->execute($query);
    }

    function insertTalent($id, $name, $subtitle, $image)
    {
        $query = "INSERT INTO `talent` (`id`,`name`,`subtitle`,`image`) VALUES ('$id', '$name', '$subtitle', '{$image}')";
        return $this->execute($query);
    }

    function insertGuestByAttend($id_guest, $attend)
    {
        $query = "UPDATE `guest` SET `attend`='$attend' WHERE `guest`.`id_guest` = '$id_guest'";
        return $this->execute($query);
    }

    function updateGuest($id_guest, $nik, $name, $photo, $qr_code)
    {
        $query = "UPDATE `guest` SET `nik`='$nik',`name`='$name',`photo`='$photo',`qr_code`='$qr_code' WHERE `guest`.`id_guest` = '$id_guest";
        return $this->execute($query);
    }

    function getAdminLogin($email, $password)
    {
        $query = "SELECT * FROM `admin` WHERE email='$email' AND password='$password'";
        return $this->execute($query);
    }

    function loadingHtml()
    {
        echo "<html>
        <head>
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
            <style>
            .loader {
                position: absolute;
                left: 50%;
                top: 50%;
                z-index: 1;
                width: 150px;
                height: 150px;
                margin: -75px 0 0 -75px;
                border: 16px solid #f3f3f3;
                border-radius: 50%;
                border-top: 16px solid #FFB103;
                border-bottom: 16px solid #FFB103;
                width: 120px;
                height: 120px;
                -webkit-animation: spin 2s linear infinite;
                animation: spin 2s linear infinite;
            }
            /* Safari */
            @-webkit-keyframes spin {
                0% {
                    -webkit-transform: rotate(0deg);
                }
                100% {
                    -webkit-transform: rotate(360deg);
                }
            }
            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
            </style>
        </head>
        <body>
            <div class=\"loader\"></div>
        </body>
        </html>";
    }


    function fetch($result)
    {
        return mysqli_fetch_array($result);
    }

    function __destruct()
    {
    }
}
