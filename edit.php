<?php
include "controller/controllerGuest.php";
$main = new controllerGuest();

if (isset($_POST['editOrganize'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone_number"];
    $id_npwp = $_POST["npwp"];
    $id = $_POST["id"];


    $hasil = $main->updateDataOrganizer(
        $id,
        $name,
        $email,
        $address,
        $phone,
        $id_npwp,
    );

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageOrganizer.php">';
    exit;
} elseif (isset($_POST['editCategoryEvent'])) {
    $name = $_POST["name"];
    $id = $_POST["id"];

    $hasil = $main->updateDataCategoryEvent(
        $id,
        $name,
    );

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageCategoryEvent.php">';
    exit;
} elseif (isset($_POST['editEvent'])) {
    $name = $_POST["name"];
    $id = $_POST["id"];
    $category = $_POST["category"];
    $type = $_POST["type"];
    $maxPlayer = $_POST["maxPlayer"];
    $minPlayer = $_POST["minPlayer"];
    $description = $_POST["description"];
    $termCondition = $_POST["termCondition"];
    $venue = $_POST["venue"];
    $location = $_POST["location"];
    // $banner = $_POST["banner"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $maps = $_POST["maps"];
    $create_by = $_POST["create_by"];
    $formSelect = $_POST["formSelect"];


    $hasil = $main->updateDataEvent(
        $id,
        $name,
        $category,
        $type,
        $minPlayer,
        $maxPlayer,
        $description,
        $termCondition,
        $venue,
        $location,
        $startDate,
        $endDate,
        $maps,
        $create_by,
        $formSelect,
    );

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageEvent.php">';
    exit;
} elseif (isset($_POST['editDataField'])) {
    $idForm = $_POST["idForm"];
    $id = $_POST["idDetail"];
    $label = $_POST["label"];
    $type = $_POST["type"];
    $state = $_POST["state"];
    $placeholder = $_POST["placeholder"];
    $minlength = $_POST["minlength"];
    $maxlength = $_POST["maxlength"];

    if ($minlength == "" && $maxlength == "") {
        $minlength = 3;
        $maxlength = 255;
    } else if ($minlength == "" && $maxlength != "") {
        $minlength = 0;
    }

    $hasil = $main->UpdateFormDetail(
        $id,
        $label,
        $type,
        $state,
        $placeholder,
        $minlength,
        $maxlength,
    );

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=detail-form.php?formDetail=' . $idForm . '">';
    exit;
} elseif (isset($_POST['editFoto'])) {
    $id = $_POST["id"];
    // $banner = addslashes(file_get_contents($_FILES['banner']['tmp_name']));

    define("ALLOWED_SIZE", 2097152); // CHANGE ALLOWED SIZE AS YOUR NEED
    define("SAVED_DIRECTORY", "assets/images/document/poster/"); // CHANGE SAVED DIRECTORY AS YOUR NEED

    $allowed_extensions = array("jpeg", "jpg", "png"); // CHANGE allowed extension AS YOUR NEED

    if (isset($_FILES['poster'])) {
        $errors = array();

        $uploaded_file_name = $_FILES['poster']['name'];
        $uploaded_file_name = preg_replace("/[^a-zA-Z0-9.]/", "", $uploaded_file_name);
        $uploaded_file_size = $_FILES['poster']['size'];
        $uploaded_file_tmp = $_FILES['poster']['tmp_name'];
        $uploaded_file_type = $_FILES['poster']['type'];

        $file_compositions = explode('.', $uploaded_file_name);
        $file_ext = strtolower(end($file_compositions));

        $saved_file_name = $uploaded_file_name; // CHANGE FILE NAME AS YOUR NEED
        $serv = "";
        $serv="https://dashboard.belitiketevent.com/cms-bete/";
        // $serv="https://dashboard.belitiketevent.com/dev-cms/";

        $poster = "assets/images/document/poster/" . $saved_file_name;
        $poster2 = $serv . $poster;
        if (in_array($file_ext, $allowed_extensions) === false)
            $errors[] = 'Extension not allowed, please choose a JPEG or PNG file';

        if ($uploaded_file_size > ALLOWED_SIZE)
            $errors[] = 'File size is too big';
        else {

            while (file_exists($poster)) {
                $saved_file_name = "2-" . $saved_file_name;
                $poster = "assets/images/document/poster/" . $saved_file_name;
                $banner2 = $serv . $poster;
            }
            if (empty($errors) == true) { // if no error, uploaded image is valid
                move_uploaded_file($uploaded_file_tmp, SAVED_DIRECTORY . $saved_file_name);
                $hasil = $main->updateDataImgEvent(
                    $id,
                    $poster2,
                );
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageEvent.php">';
                exit;
            } else {
                print_r($errors);
            }
        }
        echo $saved_file_name;
    }
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageEvent.php">';
    exit;
}
if (isset($_POST['updateStatus'])) {

    $idTransaction = $_POST["idTransaction"];
    $idTicket = $_POST["idTicket"];
    $status = $_POST["status"];
    $idEvent = $_POST["idEvent"];
    $idBooking = $_POST["id_booking"];
    $nameBuyer = $_POST["nameBuyer"];
    $email = $_POST["email"];
    $tabel = "ticket_$idEvent";
    $category = $_POST["categoryHuruf"];

    $hasil = $main->updateTransactionStatus(
        $idTransaction,
        $status
    );

    // echo $email;

    $hasil2 = $main->updateQRcodeTicket(
        $tabel,
        $idTicket,
        $category,
        $idBooking,
        $email,
        $idEvent,
        $nameBuyer

    );

    // echo $category;

        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=verify-orders?event='.$idEvent.'">';
    exit;
}
if (isset($_POST['updateStatusEvent'])) {

    $idEvent = $_POST["id"];
    $status = $_POST["selectedStatus"];

    $hasil = $main->updateEventStatus(
        $idEvent,
        $status
    );

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manage-event">';
    exit;
}

if (isset($_POST['updateStatusInvalid'])) {

    $idTransaction = $_POST["idTransaction"];
    $idTicket = $_POST["idTicket"];
    $status = $_POST["status"];
    $idEvent = $_POST["idEvent"];
    $tabel = "ticket_$idEvent";

    $hasil = $main->updateTransactionStatus(
        $idTransaction,
        $status
    );

    $hasil2 = $main->updateQRcodeTicketInvalid(
        $tabel,
        $idTicket
    );

        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=verify-orders?event='.$idEvent.'">';
    exit;
}

if (isset($_POST['editDataBanner'])) {


    define("ALLOWED_SIZE", 2097152); // CHANGE ALLOWED SIZE AS YOUR NEED
    define("SAVED_DIRECTORY", "assets/images/document/banner/"); // CHANGE SAVED DIRECTORY AS YOUR NEED
    $allowed_extensions = array("jpeg", "jpg", "png"); // CHANGE allowed extension AS YOUR NEED
    if (isset($_FILES['image'])) {
        $errors = array();

        $uploaded_file_name = $_FILES['image']['name'];
        $uploaded_file_name = preg_replace("/[^a-zA-Z0-9.]/", "", $uploaded_file_name);
        $uploaded_file_size = $_FILES['image']['size'];
        $uploaded_file_tmp = $_FILES['image']['tmp_name'];
        $uploaded_file_type = $_FILES['image']['type'];

        $file_compositions = explode('.', $uploaded_file_name);
        $file_ext = strtolower(end($file_compositions));

        $saved_file_name = $uploaded_file_name; // CHANGE FILE NAME AS YOUR NEED
        $serv = "";
        $serv="https://dashboard.belitiketevent.com/cms-bete/";
        // $serv="https://dashboard.belitiketevent.com/dev-cms/";

        $banner = "assets/images/document/banner/" . $saved_file_name;
        $banner2 = $serv . $banner;

        if (in_array($file_ext, $allowed_extensions) === false)
            $errors[] = 'Extension not allowed, please choose a JPEG or PNG file';

        if ($uploaded_file_size > ALLOWED_SIZE)
            $errors[] = 'File size is too big';
        else {
            while (file_exists($banner)) {
                $saved_file_name = "(2)-" . $saved_file_name;
                $banner = "assets/images/document/banner/" . $saved_file_name;
                $banner2 = $serv . $banner;
            }
            if (empty($errors) == true) { // if no error, uploaded image is valid
                move_uploaded_file($uploaded_file_tmp, SAVED_DIRECTORY . $saved_file_name);
                $id = $_POST["id"];
                $name = $_POST["name"];
                $link = $_POST["link"];
                $hasil = $main->updateDataBanner(
                    $id,
                    $name,
                    $link,
                    $banner2
                );
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageBanner.php">';
                exit;
            } else {
                print_r($errors);
            }
        }
    }
}

if (isset($_POST['editDataTalent'])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $subtitle = $_POST["subtitle"];

    define("ALLOWED_SIZE", 2097152); // CHANGE ALLOWED SIZE AS YOUR NEED
    define("SAVED_DIRECTORY", "assets/images/document/talent/"); // CHANGE SAVED DIRECTORY AS YOUR NEED
    $allowed_extensions = array("jpeg", "jpg", "png"); // CHANGE allowed extension AS YOUR NEED
    if (isset($_FILES['image'])) {
        $errors = array();

        $uploaded_file_name = $_FILES['image']['name'];
        $uploaded_file_name = preg_replace("/[^a-zA-Z0-9.]/", "", $uploaded_file_name);
        $uploaded_file_size = $_FILES['image']['size'];
        $uploaded_file_tmp = $_FILES['image']['tmp_name'];
        $uploaded_file_type = $_FILES['image']['type'];

        $file_compositions = explode('.', $uploaded_file_name);
        $file_ext = strtolower(end($file_compositions));

        $saved_file_name = $uploaded_file_name; // CHANGE FILE NAME AS YOUR NEED
        $serv = "";
        $serv="https://dashboard.belitiketevent.com/cms-bete/";
        // $serv="https://dashboard.belitiketevent.com/dev-cms/";

        $image = "assets/images/document/talent/" . $saved_file_name;
        $image2 = $serv . $image;

        if (in_array($file_ext, $allowed_extensions) === false)
            $errors[] = 'Extension not allowed, please choose a JPEG or PNG file';

        if ($uploaded_file_size > ALLOWED_SIZE)
            $errors[] = 'File size is too big';
        else {
            while (file_exists($image)) {
                $saved_file_name = "(2)-" . $saved_file_name;
                $image = "assets/images/document/talent/" . $saved_file_name;
                $image2 = $serv . $image;
            }
            if (empty($errors) == true) { // if no error, uploaded image is valid
                move_uploaded_file($uploaded_file_tmp, SAVED_DIRECTORY . $saved_file_name);
                $hasil = $main->updateDataTalent(
                    $id,
                    $name,
                    $subtitle,
                    $image2
                );
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageTalent.php">';
                exit;
            } else {
                print_r($errors);
            }
        }
    }
}
if (isset($_POST['UpadateStatusCheckin'])) {
    $id_guest = $_POST["id_guest"];
    $id_event = $_POST["id_event"];
    $status = $_POST["status"];
    $tabel = $_POST["tabel"];

    echo $status;
    echo $id_event;
    echo $tabel;

    $hasil = $main->updateStatusTicket(
        $tabel,
        $id_guest,
        $status
    );

    var_dump($hasil);

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=scan-qrcode.php?event=' . $id_event . '">';
    exit;
}
if (isset($_POST['UpadateStatusCheckout'])) {
    $id_guest = $_POST["id_guest"];
    $id_event = $_POST["id_event"];
    $status = $_POST["status"];
    $tabel = $_POST["tabel"];

    echo $status;
    echo $id_event;
    echo $tabel;

    $hasil = $main->updateStatusTicket(
        $tabel,
        $id_guest,
        $status
    );

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=scan-qrcode.php?event=' . $id_event . '">';
    exit;
}
if (isset($_POST['updateTicketCategory'])) {
    $id = $_POST["idTicket"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $newStock = $_POST["newStock"];
    $currentStock = $_POST["currentStock"];
    $status = $_POST["status"];
    $idEvent = $_POST["idEvent"];
    $stockGap = $newStock - $currentStock;

    if ($newStock >= $currentStock) {
        $hasil = $main->updateDataTicketCategory(
            $id,
            $idEvent,
            $name,
            $price,
            $newStock,
            $status,
            $stockGap
        );
    } else {
        echo '<script>alert("Ticket stock cannot be reduced.")</script>';
    }

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=addTicket.php?event=' . $idEvent . '">';
    exit;
}
