<!DOCTYPE html>
<html lang="en">

<head>
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
	<!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> -->
	<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

	<!-- BASE CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/menu.css" rel="stylesheet" />
	<link href="css/style_wedding.css" rel="stylesheet" />
	<link href="css/vendors.css" rel="stylesheet" />

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet" />

	<!-- MODERNIZR MENU -->
	<script src="js/modernizr.js"></script>
	<style>
		@media only screen and (min-device-width: 320px) and (max-device-width: 480px) and (max-height: 1200px) {
			.div-res {
				display: flex !important;
				flex-direction: column;
				align-items: center;
			}

			.div-res>form {
				width: 100%;
				display: block;
				margin-top: .25em;
			}

			.div-res>form>button {
				width: 100%;
				display: block;
			}
		}
	</style>
</head>

<body>
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- /Preload -->

	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div>
	<!-- /loader_form -->

	<div class="container-fluid" style="background-image: url(img/asset-0111.jpg); background-size: cover; margin-top: .75rem;">
		<div class="row">
			<?php

			include "controller/controllerGuest.php";
			$main = new controllerGuest();
			if (isset($_GET['id_guest'])) {
				$id_guest = $_GET['id_guest'];
				$id_event = $_GET['id_event'];
			} else {
				$id_guest = "null";
			}

			$tabel = "ticket_$id_event";
			$hasil = $main->getTicketByid($tabel, $id_guest);


			if ($hasil->num_rows != 0) {
				foreach ($hasil as $dataTicket) {
					$status = $dataTicket["QRcode"];
				}
				$hasil4 = $main->getDataEventById($id_event);
				foreach ($hasil4 as $dataEvent) {
					$idCategoryEvent = $dataEvent["id_event_category"];
				}
				$hasil5 = $main->getDataCategoryEventById($idCategoryEvent);
				foreach ($hasil5 as $dataCategoryEvent) {
					$category = $dataCategoryEvent["name"];
				}
				if ($category == "Concert") {
					$hasil2 = $main->getDataPartisipantByIdTicket($id_guest);
					foreach ($hasil2 as $dataPartisipant) {
						$name = $dataPartisipant["name"];
						$ktp = $dataPartisipant["ktp_id"];
						$email = $dataPartisipant["email"];
					}

					echo "
						<center style=\"align-self: center;\">
						<div>
								<h1>
									Information <br><em>
									Name : " . $name . "<br></em>
									NIK : " . $ktp . "<br></em>
									Email : " . $email . "<br></em>
								</h1>
						</div>
						</center>
						
						";
				} else {

					$hasil6 = $main->getDataCustomePartisipantByIdTicket($id_guest);
					echo "<div class=\"container table-responsive\">
							<table class=\"table table-striped\">";
					foreach ($hasil6 as $dataCustomePartisipant) {
						$jsonCust = json_decode($dataCustomePartisipant["json_data"])->player;
						$header = $jsonCust[0]->data;
						usort($header, function ($a, $b) {
							return $a->state <=> $b->state;
						});
						for ($i = 0; $i < count($header); $i++) {
							echo "<th scope=\"col\" style=\"text-align: left;\">" . $header[$i]->state . "</th>";
						}
						echo "
                                                        </tr>
                                                    </thead>
                                                    <tbody>";


						$head = $jsonCust[0]->data;
						for ($i = 0; $i < count($jsonCust); $i++) {
							foreach ($jsonCust[$i] as $keyField) {
								usort($keyField, function ($a, $b) {
									return $a->state <=> $b->state;
								});
								echo "<tr>";
								for ($j = 0; $j < count($keyField); $j++) {
									$dataField = $keyField[$j]->data;
									echo "<td>" . $dataField . "</td>";
								}
								echo "</tr>";
							}
						}
						// echo "<tr>";
						// for ($s = 0; $s < count($head); $s++) {
						// 	$state = $head[$s]->state;
						// 	echo "
						// 			<th>" . $state . "</th>
						// 	";
						// }
						// echo "</tr>";
						// for ($i = 0; $i < count($jsonCust); $i++) {
						// 	echo "<tr>";
						// 	for ($j = 0; $j < count($jsonCust[$i]->data); $j++) {
						// 		$data = $jsonCust[$i]->data[$j]->data;
						// 		echo "
						// 		<td>$data</td>
						// 		";
						// 	}
						// 	echo "</tr>";
						// }
					}
					echo "</table>
						</div>";
				}



				echo "
				<div class=\"div-res\" style=\"display: inline-flex; justify-content: center;\">
				<form action=\"edit.php\" id=\"UpadateStatusCheckin\" name=\"UpadateStatusCheckin\" method=\"POST\">
					<input type=\"hidden\" name=\"id_guest\" value=\"$id_guest\"/>
					<input type=\"hidden\" name=\"tabel\" value=\"$tabel\"/>
					<input type=\"hidden\" name=\"id_event\" value=\"$id_event\"/>
					<input type=\"hidden\" name=\"status\" value=\"check-in\"/>";

				if ($status == "ready") {
					echo "
					<button type=\"submit\" name=\"UpadateStatusCheckin\" class=\"btn btn-sm btn-outline-danger\" style=\"margin-left: 0.25em; margin-right: 0.25em;\">CHECK IN</button>
					";
				} else {
					echo "
					<button class=\"btn btn-sm btn-outline-danger\" style=\"margin-left: 0.25em; margin-right: 0.25em;\">ALREADY CHECK IN </button>
					";
				}

				echo "
					</form>
					<form action=\"edit.php\" id=\"UpadateStatusCheckout\" name=\"UpadateStatusCheckout\"  method=\"POST\">
					<input type=\"hidden\" name=\"id_guest\" value=\"$id_guest\"/>
					<input type=\"hidden\" name=\"id_event\" value=\"$id_event\"/>
					<input type=\"hidden\" name=\"tabel\" value=\"$tabel\"/>
					<input type=\"hidden\" name=\"status\" value=\"check-out\"/>";

				if ($status == "check-in") {
					echo "
					<button type=\"submit\" name=\"UpadateStatusCheckout\" class=\"btn btn-sm btn-outline-danger\" style=\"margin-left: 0.25em; margin-right: 0.25em;\">CHECK OUT</button>
					";
				} else if ($status == "ready") {
					echo "
					<button class=\"btn btn-sm btn-outline-danger\" style=\"margin-left: 0.25em; margin-right: 0.25em;\">CAN'T CHECK OUT</button>
					";
				} else {
					echo "
					<button class=\"btn btn-sm btn-outline-danger\" style=\"margin-left: 0.25em; margin-right: 0.25em;\">ALREADY CHECK OUT</button>
					";
				}
				echo "
                </form>
				<form action=\"scan-qrcode.php\" id=\"formAttendance" . $id_event . "\" name=\"formAttendance\"  method=\"GET\">
                    <input type=\"hidden\" name=\"event\" value=\"$id_event\"/>
                </form>
				<div class=\"btn btn-sm btn-outline-secondary\" style=\"margin-left: 0.25em; margin-right: 0.25em;\" type=\"submit\" onclick=\"formSubmit('" . $id_event . "')\" class=\"btn btn-primary\">Back</div>
				</div>
				";
			} else {
				echo "<div class=\"card text-center\">
						<div class=\"card-body\">
						<h5 class=\"card-title\">Data tidak ditemukan!</h5>
						<form action=\"scan-qrcode.php\" id=\"formAttendance" . $id_event . "\" name=\"formAttendance\"  method=\"GET\">
                            <input type=\"hidden\" name=\"event\" value=\"$id_event\"/>
                    	</form>
						<div type=\"submit\" onclick=\"formSubmit('" . $id_event . "')\" class=\"btn btn-primary\">Back</div>
						</div>
					</div>";
			}
			// if ($status == "ready") {

			// }
			// $hasil3 = $main->get_guest_by_id($id_guest);

			// 			foreach ($hasil3 as $dataQr) {
			// 				$qrcode = $dataQr["qr_code"];
			// 				$attend = $dataQr["attend"];
			// 				$name = $dataQr["name"];
			// 			}
			// 			if ($attend === "Y") {
			// 				echo "
			// 				<div class=\"wrapper d-flex align-items-center text-center justify-content-center\" data-opacity-mask=\"rgba(0, 0, 0, 0.05)\"  style=\"height: 90%;\">

			// 				<div class=\"social\">

			// 				</div>

			// 				<div>
			// 					<h1>
			// 						Anda Sudah Check-in<br><em>
			// 						" . $name . "</em>
			// 					</h1>
			// 					<h2>Thanks For Coming to Our Wedding</h2>

			// 				</div>

			// 			</div>

			// 			<div class=\"d-flex align-items-end flex-column bd-highlight mb-3\" style=\"height: fit-content;\">
			// 	<div class=\"mt-auto p-2 bd-highlight\">
			// 		<a href=\"scan-qrcode.php\"><button type=\"button\" class=\"btn btn-danger\">Back to Scan</button></a>
			// 	</div>
			// </div>

			// 				";
			// 			} else {
			// 				$hasil = $main->get_guest_view_by_id($id_guest);
			// 			}

			?>

			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js">
			</script>

			<script>
				function formSubmit(id) {
					document.getElementById("formAttendance" + id).submit();
				}

				function formSubmitCheckin() {
					document.getElementById("UpadateStatusCheckin").submit();
				}

				function formSubmitCheckout() {
					document.getElementById("UpadateStatusCheckout").submit();
				}

				$(document).keypress(function(event) {

					var key = (event.keyCode ? event.keyCode : event.which);
					var ch = String.fromCharCode(key)

					// if (ch == "t" || ch == "T") {
					// 	document.getElementById("take").click();
					// }
					if (ch == "c" || ch == "C") {
						if (document.getElementById('cancel').style.display == '') {
							document.getElementById("check").click();
						} else {
							alert("wrong key");
						}

					}
					// if (ch == "r" || ch == "R") {
					// 	if (document.getElementById('simpan').style.display == '') {
					// 		document.getElementById("removeP").click();
					// 	} else {
					// 		alert("belom take foto");
					// 	}
					// }
					if (ch == "b" || ch == "B") {
						window.location.href = "scan-qrcode.php";
					}
				});
			</script>

		</div>
		<!-- /row -->
	</div>


	<div class="cd-overlay-nav">
		<span></span>
	</div>
	<!-- /cd-overlay-nav -->

	<div class="cd-overlay-content">
		<span></span>
	</div>


	<!-- COMMON SCRIPTS -->
	<script src="webcam.min.js"></script>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/common_scripts.min.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/functions.js"></script>
	<script src="phpmailer/validate.js"></script>

	<script language="Javascript">
		var data_uri2 = "";

		function simpan() {
			var url2 = 'save.php';
			var form2 = $('<form action="' + url2 + '" method="POST">' +
				'<input type="text" name="attend" value="Y" />' +
				'<input type="text" name="id_guest" value="<?php echo $id_guest; ?>" />' +
				'</form>');
			$('body').append(form2);

			form2.submit();
		}
	</script>
</body>

</html>