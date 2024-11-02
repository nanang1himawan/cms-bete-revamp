<?php
$name = "";
$tamu = "";
foreach ($data as $value) {
	$name = $value['name'];
	$tamu = $value['tamu'];
	$photo = $value['photo'];
}
if ($tamu == "keluarga") {
	$tamu = "(KELUARGA)";
} else {
	$tamu = "";
}

?>


<div class="wrapper d-flex align-items-center text-center justify-content-center" data-opacity-mask="rgba(0, 0, 0, 0.05)" style="height: 90%;">

	<div class="social">

	</div>

	<div>
		<h1>
			Selamat Datang<br><em><?php echo $name ?></em>
			<h2><?php echo $tamu ?></h2>
		</h1>
		<h2>Thanks For Coming to Our Wedding</h2>

	</div>
	<!-- <a class="smoothscroll btn_scroll_to Bounce infinite" href="#wizard_container"><i class="bi bi-arrow-down-short"></i></a> -->

</div>
<div class="d-flex align-items-end flex-column bd-highlight mb-3" style="height: fit-content;">
	<div class="mt-auto p-2 bd-highlight">
		<a href="scan-qrcode.php"><button id="cancel" type="button" class="btn btn-danger">Cancel</button></a>
		<button type="button" id="check" class="btn btn-success" onclick="simpan()">Check-in</button>
	</div>
</div>