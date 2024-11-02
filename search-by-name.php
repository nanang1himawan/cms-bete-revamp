<?php
$koneksi = mysqli_connect("localhost", "root", "", "attendance");
// $koneksi = mysqli_connect("leokrisnoto.com", "leokrisn", "511MwrsBm2", "leokrisn_gwp");
// $koneksi = mysqli_connect("localhost", "id20741800_root", "123qweASD!@#", "id20741800_attendance");
// $koneksi = mysqli_connect("localhost","bxjpskoc","tarungDerajatS4","bxjpskoc_gwp-admin");
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
}
$searchErr = '';
$employee_details = '';
if (isset($_POST['save'])) {
    if (!empty($_POST['search'])) {
        $search = $_POST['search'];
        $employee_details = mysqli_query($koneksi, "select * from guest where name like '%$search%'");
        // $employee_details = mysqli_fetch_all($stmt);

        // var_dump($employee_details);
        //print_r($employee_details);

    } else {
        $searchErr = "Please enter the information";
    }
}

?>
<html>

<head>
    <title>Search By Name</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Beli Tiket Event - Adalah layanan penjualan tiket berbasis online" />
    <meta name="author" content="Ansonika" />
    <title>Beli Tiket Event</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png" />
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png" />
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png" />
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png" />


    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/menu.css" rel="stylesheet" />
    <link href="css/style_wedding.css" rel="stylesheet" />
    <link href="css/vendors.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>


    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet" />

    <!-- MODERNIZR MENU -->
    <script src="js/modernizr.js"></script>
    <style>
        .container {
            width: 90%;
            height: 30%;
            padding: 10px;
        }


        @import url('https://fonts.googleapis.com/css?family=Assistant');

        body {
            background: #eee;
            font-family: Assistant, sans-serif
        }

        .cell-1 {
            border-collapse: separate;
            border-spacing: 0 4em;
            background: #ffffff;
            border-bottom: 5px solid transparent;
            /*background-color: gold;*/
            background-clip: padding-box;
            cursor: pointer;
        }

        thead {
            background: #dddcdc;
        }


        .table-elipse {
            cursor: pointer;
        }

        #demo {
            -webkit-transition: all 0.3s ease-in-out;
            -moz-transition: all 0.3s ease-in-out;
            -o-transition: all 0.3s 0.1s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .row-child {
            background-color: #fff;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <br /><br />
        <form class="form-horizontal" action="#" method="post">
            <div class="row">
                <div class="form-group">
                    <label class="control-label col-sm-4" for="email"><b>Search Gueat Information:</b>:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="search" placeholder="search here">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" name="save" class="btn btn-success btn-sm">Submit</button>
                    </div>
                </div>

            </div>
        </form>
        <br /><br />
        <h3><u>Search Result</u></h3><br />
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    <?php
                    if (!$employee_details) {
                        echo '<tr>No data found</tr>';
                    } else {

                        foreach ($employee_details as $dataOwner2) {
                    ?>

                            <tr class="cell-1" data-toggle="collapse" data-target="#demo-<?php echo $dataOwner2['id_guest']; ?>">
                                <td colspan="1"><?php echo $dataOwner2['name']; ?></td>
                            </tr>
                            <tr id="demo-<?php echo $dataOwner2['id_guest']; ?>" class="collapse cell-1 row-child">
                                <td class="text-center" colspan="1"><i class="fa fa-angle-up"></i></td>
                                <td colspan="1"><?php echo "<img src=\"data:image/jpeg;base64,".$dataOwner2['qr_code']."\"/>"?></td>
                            </tr>

                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>


</body>

</html>