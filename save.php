<?php
include "controller/controllerGuest.php";
$main = new controllerGuest();

if (isset($_POST['buttonCreateOrganizer'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $id_npwp = $_POST["id_npwp"];
    $hasil = $main->insertDataOrganizer(
        $name,
        $email,
        $address,
        $phone,
        $id_npwp,
    );

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=createOrganizer.php">';
    exit;
} elseif (isset($_POST['addCategory'])) {
    $name = $_POST["name"];
    $hasil = $main->insertDataCategoryEvent(
        $name
    );

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageCategoryEvent.php">';
    exit;
} elseif (isset($_POST['addForm'])) {
    $name = $_POST["name"];
    $create_by = $_POST["create_by"];
    $hasil = $main->insertDataForm(
        $name,
        $create_by,
    );

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageForm.php">';
    exit;
} elseif (isset($_POST['buttonCreateEvent'])) {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $type = $_POST["type"];
    $maxPlayer = $_POST["maxPlayer"];
    $minPlayer = $_POST["minPlayer"];
    $formSelect = $_POST["formSelect"];
    $description = $_POST["description"];
    $termCondition = $_POST["termCondition"];
    $venue = $_POST["venue"];
    $location = $_POST["location"];
    $status = $_POST["status"];
    // $banner = $_POST["banner"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $maps = $_POST["maps"];
    $create_by = $_POST["create_by"];

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

            while (file_exists($banner)) {
                $saved_file_name = "2-" . $saved_file_name;
                $banner = "assets/images/document/poster/" . $saved_file_name;
                $banner2 = $serv . $banner;

            }
            if (empty($errors) == true) { // if no error, uploaded image is valid
                move_uploaded_file($uploaded_file_tmp, SAVED_DIRECTORY . $saved_file_name);
                $hasil = $main->insertDataEvent(
                    $name,
                    $category,
                    $type,
                    $minPlayer,
                    $maxPlayer,
                    $description,
                    $termCondition,
                    $venue,
                    $location,
                    $poster2,
                    $startDate,
                    $endDate,
                    $maps,
                    $create_by,
                    $formSelect,
                );
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=createEvent.php">';
                exit;
            } else {
                print_r($errors);
            }
        }
    }
} elseif (isset($_POST['saveTicket'])) {
    $name = $_POST["name"];
    $idEvent = $_POST["idEvent"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $status = $_POST["status"];



    $hasil = $main->insertDataCategoryTicket(
        $name,
        $idEvent,
        $price,
        $stock,
        $status,
    );

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=addTicket.php?event=' . $idEvent . '">';
    exit;
} elseif (isset($_POST['saveField'])) {
    $idForm = $_POST["idForm"];
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

    $hasil = $main->insertDetailForm(
        $idForm,
        $label,
        $type,
        $state,
        $placeholder,
        $minlength,
        $maxlength,
    );
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=detail-form.php?formDetail=' . $idForm . '">';
    exit;

} elseif (isset($_POST['saveBanner'])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $link = $_POST["link"];
    // $image = $_POST["image"];

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
                $hasil = $main->insertDataBanner(
                    $id,
                    $name,
                    $link,
                    $banner2,
                );
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageBanner.php">';
                exit;
            } else {
                print_r($errors);
            }
        }
    }
} elseif (isset($_POST['addTalent'])) {
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
                $hasil = $main->insertDataTalent(
                    $id,
                    $name,
                    $subtitle,
                    $image2,
                );
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=manageTalent.php">';
                exit;
            } else {
                print_r($errors);
            }
        }
    }

    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=detail-form.php?formDetail=' . $idForm . '">';
    exit;
}