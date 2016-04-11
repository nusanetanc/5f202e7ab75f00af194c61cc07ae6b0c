<?php
require('./content/srcpdf/fpdf.php');
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
				$pdf->Cell(0,7, 'Nama Lengkap                     : '.$nama_cust, '0', 1, 'L');
				$pdf->Cell(0,7, 'No ID Pelanggan                  : '.$id_cust, '0', 1, 'L');
				$pdf->Cell(0,7, 'Nomor Telepon                    : '.$phone_cust, '0', 1, 'L');
				$pdf->Cell(0,7, 'Alamat Email                        : '.$email_cust, '0', 1, 'L');
				$pdf->Cell(0,7, 'Layanan yang Digunakan    : '.$package_cust.' ('.$deskripsi_paket0.')', '0', 1, 'L');
				$pdf->Cell(0,7, 'Layanan Add-ons                 : No', '0', 1, 'L');
				$pdf->Ln();
				$pdf->SetFont('Arial','B','10');
				$pdf->Cell(0,7, 'PERGANTIAN LAYANAN', '0', 1, 'L');
				$pdf->SetFont('Arial','','10');
				$pdf->Cell(0,7, 'Pergantian Layanan : '.$move_paket_cust.' ('.$deskripsi_paket1.')', '0', 1, 'L');
				$pdf->Ln();
				$pdf->Ln();
				$pdf->Ln();
				$pdf->Ln();
				$pdf->Image('./img/tanda_tangan.jpg','165','130','33','33');
				$pdf->SetFont('Arial','','10');
				$pdf->Cell(0,7, 'John Doe', '0', 1, 'R'); 
				$pdf->Cell(0,7, 'Customer Relation Officer', '0', 1, 'R'); 
				$pdf->Cell(0,7, 'PT Media Andalan Nusa ', '0', 1, 'R');

$pdf->output();
?>
