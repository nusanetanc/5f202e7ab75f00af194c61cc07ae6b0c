<?php
require('fpdf.php');
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

// Filename that will be used for the file as the attachment
$fileatt_name = "test1.pdf";
$dir='pdffile/';
$pdf ->Output($dir.$fileatt_name);

$data = $pdf->Output("", "S");

$email_from = "cs@groovy.id"; // Who the email is from
$email_subject = "[SERVICE TERMINATION REQUEST] - Nusanet - John Dor"; // The Subject of the email
$email_to = "anc.nusanet@gmail.com"; // Who the email is to


$semi_rand = md5(time());
$data = chunk_split(base64_encode($data));

$fileatt_type = "application/pdf"; // File Type
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

// set header ........................
$headers = "From: ".$email_from;
$headers .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/mixed;\n" .
" boundary=\"{$mime_boundary}\"";

// set email message......................
$email_message .= "This is a multi-part message in MIME format.\n\n" .
"--{$mime_boundary}\n" .
"Content-Type:text/html; charset=\"iso-8859-1\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" .
$email_message .= "\n\n";
$email_message .= "--{$mime_boundary}\n" .
"Content-Type: {$fileatt_type};\n" .
" name=\"{$fileatt_name}\"\n" .
"Content-Disposition: attachment;\n" .
" filename=\"{$fileatt_name}\"\n" .
"Content-Transfer-Encoding: base64\n\n" .
$data .= "\n\n" .
"--{$mime_boundary}--\n";

$sent = @mail($email_to, $email_subject, $email_message, $headers);
if($sent) {
echo "Your email attachment send successfully.";
} else {
die("Sorry but the email could not be sent. Please try again!");
}
?>