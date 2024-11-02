<?php
$name = "";
$tamu = "";
foreach ($data as $value) {
	$name = $value['name'];
	$tamu = $value['tamu'];
	$photo = $value['photo'];
}
if ($tamu == "keluarga") {
	$tamu = "(dari KELUARGA)";
} else {
	$tamu = "";
}

?>
<!-- data-background="url(img/asset-01.jpg)" -->
<div class="col-lg-6 p-0">
	<div class="content-left-wrapper d-flex align-items-center
						text-center justify-content-center" data-opacity-mask="rgba(0, 0, 0, 0.05)">
		<!-- <a href="#0" id="logo"><img src="img/logo.png" alt="" width="44" height="44" /></a> -->
		<div class="social">
			<!-- <ul>
				<li>
					<a href="#0"><i class="bi bi-facebook"></i></a>
				</li>
				<li>
					<a href="#0"><i class="bi bi-twitter"></i></a>
				</li>
				<li>
					<a href="#0"><i class="bi bi-instagram"></i></a>
				</li>
			</ul> -->
		</div>
		<!-- /social -->
		<div>
			<h2>
				Mohon Maaf
			</h2>
			<h2> QRcode tidak terdaftar </h2>
			<h1>press (B) to scan again</h1>
			<!-- <div class="countdown">
	                        <h4>05 June 2023 at 2pm</h4>
	                        <div class="container_count">
	                            <div id="days">00</div>days
	                        </div>
	                        <div class="container_count">
	                            <div id="hours">00</div>hours
	                        </div>
	                        <div class="container_count">
	                            <div id="minutes">00</div>minutes
	                        </div>
	                        <div class="container_count last">
	                            <div id="seconds">00</div>seconds
	                        </div>
	                    </div> -->
			<!-- <p><a href="#panel_info" class="btn_info">Program and Info</a></p> -->
		</div>
		<a class="smoothscroll btn_scroll_to Bounce infinite" href="#wizard_container"><i class="bi bi-arrow-down-short"></i></a>
	</div>
</div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
	$(document).keypress(function(event) {

		var key = (event.keyCode ? event.keyCode : event.which);
		var ch = String.fromCharCode(key)

		if (ch == "b" || ch == "B") {
			window.location.href = "scan-qrcode.php";
		}
	});
</script>