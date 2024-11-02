<?php

require_once('./dompdf/autoload.inc.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$id_booking = "021938947";
$nomorPendaftaran = "A0089";

$html = '
        
<div style="background:#FFB103; padding: 16px; max-width: 80rem; margin-left: auto; margin-right: auto;">

<div style="background-color:#ffffff; margin-left: 1.5rem; margin-right: 1.5rem; padding-top: 1rem; padding-bottom: 1rem; text-align: center; border-radius: 0.5rem;">
    <div style="font-weight: 700; font-size: 24px;">Booking ID</div>
    <div style="font-weight: 700; font-size: 24px;">
        ' . $id_booking . '
    </div>
</div>
<br>
<div style="background-color:#ffffff; margin-left: 1.5rem; margin-right: 1.5rem; padding-top: 1rem; padding-bottom: 1rem; text-align: center; border-radius: 0.5rem;">
    <div style="font-weight: 700; font-size: 24px;">Nomor Pendaftaran</div>
    <div style="font-weight: 700; font-size: 40px;">
        ' . $nomorPendaftaran . '
    </div>
</div>

</div>

';

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream();

?>