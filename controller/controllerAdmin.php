<?php

include "model/model.php";

class controllerAdmin
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

    function login2()
    {
        $dashboard = 0;
        if (isset($_POST['formLogin'])) {
            session_start();
            $email = $_POST["email"];
            // $password = md5($_POST['password']);
            $password   = $_POST['password'];
            $dataAdmin = $this->model->getAdminLogin($email, $password);
            $cekAdmin = mysqli_num_rows($dataAdmin);
            if ($cekAdmin > 0) {
                while ($dataAdmin2 = mysqli_fetch_assoc($dataAdmin)) {
                    $_SESSION['id_admin'] = $dataAdmin2['id_admin'];
                    $_SESSION['email'] = $dataAdmin2['email'];
                    $_SESSION['event'] = $dataAdmin2['event'];
                    $_SESSION['status'] = "login";
                }
                $dashboard = 1;
                return $dashboard;
            } else {
                return $dashboard;
            }
        } else {
            return $dashboard;
        }
    }

    function checkingEmail()
    {
        $status = 0;
        if (isset($_POST['checkingEmail'])) {
            session_start();
            $email                              = $_POST['email'];
            $email                              = strtolower($email);
            $_SESSION['checkingEmailGuest']     = $email;
            $_SESSION['statuslog']              = "BETElog";
            $dataCustomer                       = $this->model->checking_email($email);
            $jumlahDataCustomer                 = mysqli_num_rows($dataCustomer);
            if ($jumlahDataCustomer > 0) {
                $status = 0;
                // $otp = rand(1142,9999);
                $otp = 1111;

                $statusUpdate = $this->model->updateOtp($otp, $email);
                // $kirimEmail = $this->kirimOtp($otp, $email);
                if ($statusUpdate) {
                    $status = 1;
                } else {
                    $status = 0;
                }
            } else {
                $status = 0;
            }
            return $status;
        } else {
            return $status;
        }
    }

    function checkingEmailOrganizer()
    {
        $status = 0;
        if (isset($_POST['checkingEmailOrganizer'])) {
            session_start();
            $email                              = $_POST['email'];
            $email                              = strtolower($email);
            $_SESSION['checkingEmailGuest']     = $email;
            $_SESSION['statuslog']              = "ORGANIZERlog";
            $dataOrganizer                      = $this->model->checking_email_organizer($email);
            $jumlahDataOrganizer                = mysqli_num_rows($dataOrganizer);
            if ($jumlahDataOrganizer > 0) {
                $status = 0;
                // $otp = rand(1142,9999);
                $otp = 2143;
                while ($dataOrganizer2 = mysqli_fetch_assoc($dataOrganizer)) {
                    $id_organizer = $dataOrganizer2['id'];
                    $_SESSION['id_user'] = $id_organizer;

                }
                $id = $this->guidv4();
                $statusUpdate = $this->model->updateOtpOrganizer($id, $otp, $id_organizer);
                // $kirimEmail = $this->kirimOtp($otp, $email);
                if ($statusUpdate) {
                    $status = 1;
                } else {
                    $status = 0;
                }
            } else {
                $status = 0;
            }
            return $status;
        } else {
            return $status;
        }
    }

    function login()
    {
        $dashboard  = 0;
        if (isset($_POST['submitLogin'])) {
            $email      = $_SESSION['checkingEmailGuest'];
            $email      = strtolower($email);
            $password   = $_POST['otp'];
            $dataOwner  = $this->model->login_admin($email, $password);
            $cekOwner   = mysqli_num_rows($dataOwner);
            if ($cekOwner > 0) {
                while ($dataOwner2 = mysqli_fetch_assoc($dataOwner)) {
                    $_SESSION['id_user']    = $dataOwner2['id'];
                    $_SESSION['email']      = $dataOwner2['email'];
                    $_SESSION['status']     = "BETE";

                }
                $dashboard = 1;
                return $dashboard;
            } else {
                return $dashboard;
            }
        } else {
            return $dashboard;
        }
    }
    function login_organizer()
    {
        $dashboard  = 0;
        if (isset($_POST['submitLogin'])) {
            $email      = $_SESSION['checkingEmailGuest'];
            $id_organizer = $_SESSION['id_user'];
            $email      = strtolower($email);
            $password   = $_POST['otp'];
            $dataOwner  = $this->model->login_organizer($id_organizer, $password);
            $cekOwner   = mysqli_num_rows($dataOwner);
            if ($cekOwner > 0) {
                while ($dataOwner2 = mysqli_fetch_assoc($dataOwner)) {
                    $_SESSION['email']      = $email;
                    $_SESSION['status']     = "ORGANIZER";
                    $_SESSION['id_user']    = $id_organizer;
                }
                $dashboard = 1;
                return $dashboard;
            } else {
                return $dashboard;
            }
        } else {
            return $dashboard;
        }
    }

    function checkingOtp($email, $otp)
    {
        $data = $this->model->checking_otp($email, $otp);
        return $data;
    }

    function checkingOtpOrganizer($email, $otp)
    {
        $data = $this->model->checking_otp($email, $otp);
        return $data;
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
        return mysqli_fetch_assoc($result);
    }

    function __destruct()
    {
    }
}
