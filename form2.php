<?php
require('./content/srcpdf/fpdf.php');
require('./con/koneksi.php');
require('./con/function.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,20, 'PT Media Andalan Nusa (Nusanet)', '0', 1, 'R');
$pdf->SetFont('Arial','B','14');
$pdf->Cell(0,10, 'FORMULIR PENUTUPAN REKENING', '0', 5, 'C');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'DATA PELANGGAN', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Nama Lengkap                   : John Dor', '0', 1, 'L');
$pdf->Cell(0,7, 'No ID Pelanggan                : 8595768', '0', 1, 'L');
$pdf->Cell(0,7, 'Nomor Telepon                   : 0895634748', '0', 1, 'L');
$pdf->Cell(0,7, 'Alamat Email                       : nurhandiy@gmail.com', '0', 1, 'L');
$pdf->Cell(0,7, 'Layanan yang Digunakan   : Paket Diamond', '0', 1, 'L');
$pdf->Cell(0,7, 'Layanan Add-ons                : No', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'PENUTUPAN / TERMINASI', '0', 1, 'L');
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Tanggal Penutupan : 18 Maret 2016', '0', 1, 'L');
$pdf->Cell(0,7, 'Alasan Penutupan   : Harga Mahal', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'Tanggal : 08 Maret 2015', '0', 1, 'R');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Image('./img/tanda_tangan.jpg','165','150','33','33');
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'John Doe              ', '0', 1, 'R');
$pdf->Cell(0,7, 'Customer Relation Officer', '0', 1, 'R');
$pdf->Cell(0,7, 'PT Media Andalan Nusa ', '0', 1, 'R');

$pdf->output();
?>
