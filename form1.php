<?php
require('./content/srcpdf/fpdf.php');
require('./con/koneksi.php');
require('./con/function.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,20, 'PT Media Andalan Nusa (Nusanet)', '0', 1, 'R');
$pdf->SetFont('Arial','B','14');
$pdf->Cell(0,10, 'FORMULIR PERUBAHAN JENIS LAYANAN', '0', 5, 'C');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'DATA PELANGGAN', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Nama Lengkap                     : John Dor', '0', 1, 'L');
$pdf->Cell(0,7, 'No ID Pelanggan                  : 8595768', '0', 1, 'L');
$pdf->Cell(0,7, 'Nomor Telepon                    : 0895634748', '0', 1, 'L');
$pdf->Cell(0,7, 'Alamat Email                        : john@doe.com', '0', 1, 'L');
$pdf->Cell(0,7, 'Layanan yang Digunakan    : Paket Diamond', '0', 1, 'L');
$pdf->Cell(0,7, 'Layanan Add-ons                 : No', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'I. PERGANTIAN LAYANAN', '0', 1, 'L');
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Merubah Layanan Menjadi    :', '0', 1, 'L');
$pdf->Cell(0,7, '- Diamond', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'II. PENAMBAHAN / PERGANTIAN Add-ons', '0', 1, 'L');
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Menambahkan Layanan Add-ons Menjadi    :', '0', 1, 'L');
$pdf->Cell(0,7, '- Fun', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'II. PENAMBAHAN JUMLAH Dens.TV SmartBox', '0', 1, 'L');
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Jumlah unit    : 1', '0', 1, 'L');
$pdf->Cell(0,7, 'SN : 32433-4342234-23434', '0', 1, 'L');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'Tanggal : 08 Maret 2015', '0', 1, 'R');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Image('./img/tanda_tangan.jpg','165','220','33','33');
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'John Doe              ', '0', 1, 'R');
$pdf->Cell(0,7, 'Customer Relation Officer', '0', 1, 'R');
$pdf->Cell(0,7, 'PT Media Andalan Nusa ', '0', 1, 'R');

$pdf->output();
?>
