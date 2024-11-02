<?php
    // include "controller/controllerAdmin.php";
    // $main = new controllerAdmin();
    // $hasil = $main->login();
    // if($hasil == 1){
    //     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=home-admin.php">';
    //     exit;
    // }else{
    //     echo '<META HTTP-EQUIV="Refresh" Content="0; URL=auth-signin.php">';
    //     exit;
    // }
?>

<?php
    include "controller/controllerAdmin.php";
    $main = new controllerAdmin();
    $main->loadingHtml();
    // $hasil = $main->login();
    $hasil = $main->checkingEmail();
    if($hasil == 1){
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=page-admin-otp">';
        exit;
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=page-admin-email"><script>alert("Email Tidak Terdaftar")</script>';
        exit;
    }
?>