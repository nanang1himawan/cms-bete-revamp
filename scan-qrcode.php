<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="Beli Tiket Event - Adalah layanan penjualan tiket berbasis online">
	<meta name="author" content="Ansonika">
	<title>Attendance</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
		href="img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
		href="img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
		rel="stylesheet">

	<!-- SCAN QRcode -->
	<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.4/html5-qrcode.min.js" integrity="sha512-k/KAe4Yff9EUdYI5/IAHlwUswqeipP+Cp5qnrsUjTPCgl51La2/JhyyjNciztD7mWNKLSXci48m7cctATKfLlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->



	<!-- BASE CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/menu.css" rel="stylesheet">
	<link href="css/style_wedding.css" rel="stylesheet">
	<link href="css/vendors.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="css/custom.css" rel="stylesheet">

	<!-- MODERNIZR MENU -->
	<script src="js/modernizr.js"></script>

	<style>
		body,
		html {
			height: 100%;
			margin: 0;
			/* overflow: hidden !important; */
		}

		footer {
			position: absolute;
			bottom: 0;
			width: 100%;
		}

		.bg {
			/* The image used */
			background-image: url("img/1569677.webp");

			/* Full height */
			height: 100%;

			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}

		header {
			padding: 30px;
			text-align: center;
			font-size: 35px;
			color: black;
		}

		.container {
			align-items: center;
		}

		#reader {
			/* height: 100%;
			width: 100%; */
			left: 0;
			top: 0;
			/* overflow: hidden; */
			border: none !important;
			/* position: fixed; */
		}

		#html5-qrcode-button-camera-stop {
			color: #fff;
			background-color: #dc3545;
			border-color: #dc3545;
			font-size: 1rem;
			border-radius: 0.25rem;
			padding: .375rem .75rem;
		}

		#html5-qrcode-button-camera-stop:hover {
			color: #fff;
			background-color: #dc3545;
			border-color: #dc3545;
			font-size: 1rem;
			border-radius: 0.25rem;
			padding: .375rem .75rem;
		}

		#html5-qrcode-button-camera-start {
			color: #fff;
			background-color: #198754;
			border-color: #198754;
			font-size: 1rem;
			border-radius: 0.25rem;
			padding: .375rem .75rem;
		}

		#result {
			text-align: center;
			font-size: 1.5rem;
		}

		.hex {
			color: white;
			background-color: #fb7500;
			display: flex;
			align-items: center;
		}

		@media only screen and (min-device-width: 320px) and (max-device-width: 480px) and (max-height: 1200px) {
			[class*="col-"] {
				width: 100%;
			}

			.col-res {
				display: flex;
				flex-direction: row-reverse;
				justify-content: space-evenly;
				margin-bottom: 20px;
			}

			.hex {
				font-size: 0;
				display: flex;
				align-items: center;
			}

			h1 {
				text-align: center;
				margin-bottom: 0 !important;
			}
		}
	</style>

</head>

<body class="bg">
	<div>
		<header>Attendance</header>
	</div>

	<div class="container my-5  align-items-center">
		<div class="row align-items-center">
			<?php
			include "controller/controllerGuest.php";
			$main = new controllerGuest();

			if (isset($_GET['event'])) {
				$id_event = $_GET['event'];
				$hasil = $main->getDataEventById($id_event);
				foreach ($hasil as $dataEvent) {
					$nameEvent = $dataEvent["name"];
					echo "
								<div class=\"col-6 col-res\"><h1>$nameEvent</h1>
									<form action=\"attendance.php\" id=\"formAttendance" . $id_event . "\" name=\"formAttendance\"  										method=\"GET\">
									
								</form>
									<button type=\"button\" class=\"btn hex\" style=\"\" onclick=\"formSubmit('" . $id_event . "')\">
										<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" fill=\"white\" class=\"bi bi-arrow-left\" viewBox=\"0 0 16 16\">
										<path fill-rule=\"evenodd\" d=\"M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z\"/>
										</svg>
									Back to attendance list
									</button>
							  	</div>
								";
				}
				// echo "<script> var nameEvent = '" . $id_event . "';</script>";
			
				// $cookie_name = "idEvent";
				// $cookie_value = $id_event;
			
				// // Set cookie
				// setcookie($cookie_name, $cookie_value);
			
				// if (!isset($_COOKIES[$cookie_name])) {
				// 	print("Cookie created | ");
				// }
			}
			?>
			<div class="col-6" id="reader"></div>
		</div>
	</div>
	<footer>
		<div class="my-5 text-center text-white">Copyright © 2023 Beli Tiket Event</div>
	</footer>
	<script>
		function formSubmit(id) {
			document.getElementById("formAttendance" + id).submit();
		}
		const scanner = new Html5QrcodeScanner("reader", {
			qrbox: {
				width: 350,
				height: 350,
			},
			fps: 30,
		});
		scanner.render(success, error);

		function success(result) {

			var nameEvent = "<?php echo $id_event; ?>"
			console.log("halooooo");
			var url = 'index-welcome.php';
			var form = $('<form name="guest" action="' + url + '" method="GET">' +
				'<input type="text" name="id_guest" value="' + result + '" />' +
				'<input type="text" name="id_event" value="' + nameEvent + '" />' +
				'</form>');
			$('body').append(form);
			form.submit();


			// document.getElementById("result").innerHTML = `
			//   <p><a href="${result}">${result}</a></p>
			//   `;
			scanner.clear();
			document.getElementById("reader").remove();
		}

		function error(err) {
			// console.error(err);
		}
	</script>
	<script src="js/jquery-3.6.0.min.js"></script>
	<script src="js/common_scripts.min.js"></script>
	<script src="js/velocity.min.js"></script>
	<script src="js/functions.js"></script>
	<!-- <script src="js/scan-qrcode.js"></script> -->
	<script src="phpmailer/validate.js"></script>
</body>

</html>