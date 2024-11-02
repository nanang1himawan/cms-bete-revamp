<?php 
if(isset($_SESSION['status'])){
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=dashboard">';
    exit;
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::BETE ADMIN:: Signin</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/cryptoon.style.min.css">
</head>

<body>
    <div id="cryptoon-layout" class="theme-orange">

        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5">

            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">
                    <div class="row g-3">
                        <div class="d-flex justify-content-center align-items-center auth-h100">
                            <div class="d-flex flex-column w-50">
                                <center>
                                    <h1>Admin Login</h1>
                                </center>
                                <div class="tab-content mt-4 mb-3">
                                    <div class="tab-pane fade show active">
                                        <div class="card">
                                            <div class="card-body p-4">
                                                <form action="loginWithOtp" method="POST" enctype="multipart/form-data">
                                                    <div class="mb-3">
                                                        <label class="form-label fs-6">PIN</label>
                                                        <input required name="otp" placeholder="PIN" type="number" class="form-control">
                                                    </div>
                                                    <!-- <div class="mb-3">
                                                        <label class="form-label fs-6">Password</label>
                                                        <input required name="password" type="password" class="form-control">
                                                    </div> -->
                                                    <button type="submit" name="submitLogin" class="btn btn-primary text-uppercase py-2 fs-5 w-100 mt-2">log in</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <a href="auth-password-reset.html" title="#" class="text-primary text-decoration-underline">Forgot password?</a>
                                <a href="auth-signup.html" title="#" class="text-primary text-decoration-underline">Register now</a> -->
                            </div>
                        </div>
                    </div> <!-- End Row -->

                </div>
            </div>

        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script src="js/template.js"></script>
</body>

</html>