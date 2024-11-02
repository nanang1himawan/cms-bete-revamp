<?php
    session_start();    
    if(isset($_SESSION['status'])){
        include "home-admin.php";
    }else{
        include "page-organizer-email.php";
    }
?>