<?php
require('./content/srcpdf/fpdf.php');
$header = array(
		array("label"=>"DESKRIPSI PEMBAYARAN", "length"=>130, "align"=>"L"),
		array("label"=>"HARGA", "length"=>55, "align"=>"L")
	);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('./img/groovy-logo-orange.png','140','15','60');
$pdf->SetFont('Arial','B','20');
$pdf->Cell(0,30, '', '0', 5, 'L');
$pdf->Cell(0,10, 'BUKTI PEMBAYARAN', '0', 5, 'C');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'DATA PELANGGAN', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Nama Lengkap            : John Dor', '0', 1, 'L');
$pdf->Cell(0,7, 'No ID Pelanggan         : 8595768', '0', 1, 'L');
$pdf->Cell(0,7, 'Alamat Pemasangan   : Simprug Residence, Blok 3C No 10, Jl. Teuku Nyak Arief, Jakarta Selatan', '0', 1, 'L');
$pdf->Cell(0,7, 'Nomor Telepon           : 0895634748', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'DATA PEMBAYARAN', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','','10');
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
foreach ($header as $kolom) {
	$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill=false;
foreach ($data as $baris) {
	$i = 0;
	foreach ($baris as $cell) {
		$pdf->Cell($header[$i]['length'], 5, $cell, 1, '0', $kolom['align'], $fill);
		$i++;
	}
	$fill = !$fill;
	$pdf->Ln();
}
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'KONFIRMASI PEMBAYRAN - PAYMENT CONFIRMATION', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Tanggal Bayar                : 12 Maret 2016', '0', 1, 'L');
$pdf->Cell(0,7, 'Kode Virtual                   : 9388476347374627', '0', 1, 'L');
$pdf->Cell(0,7, 'Jumlah Pembayaran      : 750.000', '0', 1, 'L');
$pdf->Ln();
$pdf->Ln();
$pdf->Image('./img/denstv-logo.png','10','250','50');
$pdf->Image('./img/logo-nusanet.png','65','250','50');
$pdf->Image('./img/a.jpg','170','240','30');
$pdf->output();
?>
