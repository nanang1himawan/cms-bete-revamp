<?php
    session_start();
    if ($_SESSION['statuslog']==="ORGANIZERlog") {
        include "controller/controllerAdmin.php";
    $main = new controllerAdmin();
    $main->loadingHtml();
    $hasil = $main->login_organizer();
    if($hasil == 1){
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=dashboard">';
        exit;
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=page-organizer-otp"><script>alert("OTP Tidak Sesuai")</script>';
        exit;
    }
    } 
    if($_SESSION['statuslog']==="BETElog") {
        include "controller/controllerAdmin.php";
    $main = new controllerAdmin();
    $main->loadingHtml();
    $hasil = $main->login();
    if($hasil == 1){
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=dashboard">';
        exit;
    }else{
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=page-admin-otp"><script>alert("OTP Tidak Sesuai")</script>';
        exit;
    }
    }
?>