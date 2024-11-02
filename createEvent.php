<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::BETE:: Manage Organizer </title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/cryptoon.style.min.css">
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['status'])) {
    } else {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=auth-signin.php">';
        exit;
    }
    ?>
    <div id="cryptoon-layout" class="theme-orange">

        <!-- sidebar -->
        <?php include "inc/slidebar.php" ?>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <?php include "inc/header.php" ?>

            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-1">

                <div class="body-header border-bottom d-flex py-3">
                    <div class="container-xxl">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Pretitle -->
                                <center>
                                    <h1 class="h4 mt-1">Create Event</h1>
                                </center>
                            </div>

                        </div> <!-- Row end  -->

                    </div>
                </div>
                <div class="card mb-3">

                    <div class="card-body">
                        <form action="save.php" id="basic-form" method="post" enctype="multipart/form-data">
                            <?php
                            $id_user = $_SESSION['id_user'];
                            echo "
                            <input name=\"create_by\" type=\"hidden\" value=\"" . $id_user . "\">
                            <input name=\"status\" type=\"hidden\" value=\"Upcoming\">
                            ";
                            ?>
                            <input name="type" type="hidden" value="">
                            <input name="maxPlayer" type="hidden" value="">
                            <input name="minPlayer" type="hidden" value="">
                            <input name="formSelect" type="hidden" value="">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <input name="name" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="validationCustom04" class="form-label">Category Event</label>
                                    <select name="category" class="form-select" onchange="checkCategory()"
                                        id="categoryCheck" required>
                                        <option selected disabled value="">Choose...</option>
                                        <?php
                                        include "controller/controllerGuest.php";
                                        $main = new controllerGuest();
                                        $hasil = $main->getDataCategoryEvent();
                                        foreach ($hasil as $data) {
                                            $id = $data["id"];
                                            $name = $data["name"];
                                            $type = $data["type"];
                                            if ($_SESSION['status'] == 'ORGANIZER') {
                                                if ($type == 'Private') {
                                                    echo "
                                                        <option id=\"categoryCheck" . $id . "\" data=\"" . $name . "\"value=\"" . $id . "\">". $type. " " . $name. "</option>
                                                    ";
                                                }
                                            } else {
                                                    echo "
                                                        <option id=\"categoryCheck" . $id . "\" data=\"" . $name . "\"value=\"" . $id . "\">". $type. " " . $name. "</option>
                                                    ";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-md-4" id="typeComp" style="display: none;">
                                    <label for="validationCustom04" class="form-label">Type Competition</label>
                                    <select name="type" class="form-select" onchange="checkPlayer(this)" id="type2">
                                        <option selected disabled value="">Choose Player...</option>
                                        <option value="Team Player" data="team">Team Player</option>
                                        <option value="Single Player" data="single">Single Player</option>
                                    </select>
                                </div>
                                <div class="col-md-4" id="formSelect" style="display: none;">
                                    <label for="validationCustom04" class="form-label">Form Event</label>
                                    <select id="formSelect2" name="formSelect" class="form-select">
                                        <option selected disabled value="">Choose Form...</option>
                                        <?php
                                        // $idGuest = $_SESSION['id_user'];
                                        if ($_SESSION['status'] == 'BETE') {
                                            $hasil2 = $main->getDataForm();
                                        } else {
                                            $hasil2 = $main->getDataFormByGuestId($id_user);
                                        }
                                        foreach ($hasil2 as $data2) {
                                            $id2 = $data2["id"];
                                            $name2 = $data2["form_name"];

                                            echo "
                                                <option data=\"" . $name2 . "\"value=\"" . $id2 . "\">" . $name2 . "</option>
                                            ";
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-md-4" id="mnPly" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Min Player/Team</label>
                                        <input id="minPlayer2" name="minPlayer" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4" id="mxPly" style="display: none;">
                                    <div class="form-group">
                                        <label class="form-label">Max Player/Team</label>
                                        <input id="maxPlayer2" name="maxPlayer" type="text" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <textarea name="description" class="form-control" rows="5" cols="30"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Term & Condition</label>
                                        <textarea name="termCondition" class="form-control" rows="5" cols="30"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Venue</label>
                                        <input name="venue" type="text" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Location</label>
                                        <textarea name="location" class="form-control" rows="5" cols="30"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="formFileMultiple" class="form-label">Poster</label>
                                    <input name="poster" class="form-control" type="file" id="formFileMultiple"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="admitdate" class="form-label">Start Date</label>
                                    <input name="startDate" type="date" class="form-control" id="admitdate" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="admitdate" class="form-label">End Date</label>
                                    <input name="endDate" type="date" class="form-control" id="admitdate" required>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Maps(link embed)</label>
                                        <textarea name="maps" class="form-control" rows="5" cols="30"
                                            required></textarea>
                                    </div>
                                </div>
                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Nomor Telepon</label>
                                        <input name="phone" type="text" class="form-control" required>
                                    </div>
                                </div> -->
                                <!-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">NPWP</label>
                                        <input name="id_npwp" type="text" class="form-control" required>
                                    </div>
                                </div> -->
                            </div>
                            <center>
                                <button name="buttonCreateEvent" type="submit" class="btn btn-primary">Create</button>
                            </center>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <script>
        function checkPlayer(selectObject) {
            var name = selectObject.value;
            if (name == "Team Player") {
                document.getElementById("mxPly").style.display = "block";
                document.getElementById("mnPly").style.display = "block";
            } if (name == "Single Player") {
                document.getElementById("mxPly").style.display = "none";
                document.getElementById("mnPly").style.display = "none";
                document.getElementById("minPlayer2").value = "";
                document.getElementById("maxPlayer2").value = "";
            }
        }

        function checkCategory() {
            var nameCategory = document.getElementById("categoryCheck").value;
            var nameCategory2 = document.getElementById("categoryCheck" + nameCategory);
            let name = nameCategory2.getAttribute("data");

            if (name == "Competition") {
                document.getElementById("typeComp").style.display = "block";
                document.getElementById("mxPly").style.display = "block";
                document.getElementById("mnPly").style.display = "block";
                document.getElementById("formSelect").style.display = "block";
            } else {
                document.getElementById("typeComp").style.display = "none";
                document.getElementById("mxPly").style.display = "none";
                document.getElementById("mnPly").style.display = "none";
                document.getElementById("formSelect").style.display = "none";
                document.getElementById("type2").value = "";
                document.getElementById("minPlayer2").value = "";
                document.getElementById("maxPlayer2").value = "";
                document.getElementById("formSelect2").value = "";
            }
        }

    </script>

    <!-- Plugin Js -->
    <!-- <script src="assets/bundles/dataTables.bundle.js"></script> -->
    <!-- <script src="assets/bundles/apexcharts.bundle.js"></script> -->

    <!-- Jquery Page Js -->
    <script src="js/template.js"></script>
    <!-- <script src="js/page/index.js"></script> -->
</body>

</html>