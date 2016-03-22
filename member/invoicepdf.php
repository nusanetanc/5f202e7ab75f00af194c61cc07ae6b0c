<?php
require('../content/srcpdf/fpdf.php');
require('../con/koneksi.php');
require('../con/function.php');
session_start();
$id = $_SESSION["id"];
$date = date("Y/m/d");
$res = $col_user->find(array("id_user"=>$id));
foreach($res as $row)
{ 
  $id = $row['id_user'];
  $nama = $row['nama'];
  $email = $row['email'];
  $alamat = $row['alamat'];
  $keterangan = $row['keterangan'];
  $tempat = $row['tempat'];
  $kota = $row['kota'];
  $paket = $row['paket'];
  $harga = $row['harga'];
  $tanggal = $row['tanggal_akhir'];
} 
  $thn = substr($date, 0,4);
  $bln = substr($date, 5,2);
  $tgl = substr($date, 8,10);
  $month = bulan($bln);
$thn1 = substr($tanggal, 0,4);
$bln1 = substr($tanggal, 5,2);
$tgl1 = substr($tanggal, 8,2);
$month1 = bulan($bln1);

$header = array(
array("label"=>"Description", "length"=>95, "align"=>"C"),
array("label"=>"Jumlah", "length"=>95, "align"=>"C"),
);
$header1 = array(
array("label"=>'Pembayaran'.' '.$paket.'(1 Bulan)', "length"=>95, "align"=>"C"),
array("label"=>' Rp. '.$harga, "length"=>95, "align"=>"C"),
);
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B','50');
$pdf->Cell(0,20, 'groovy', '0', 1, 'L');
$pdf->Image('../img/a.jpg','165','5','33','33');
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,20, 'INVOICE ID #231234', '150', 10, 'R');
$pdf->SetFont('Arial','B','14');
$pdf->Cell(0,10, 'TAGIHAN PEMBAYARAN', '0', 1, 'C');
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,10, 'Bayar Kepada', '100', 10, 'R');
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'PT Media Andalan Nusa', '0', 1, 'R');
$pdf->Cell(0,7, 'Cyber Building 7th Floor,', '0', 1, 'R');
$pdf->Cell(0,7, 'Jl Kuningan Barat,', '0', 1, 'R');
$pdf->Cell(0,7, 'Jakarta 12710, Indonesia', '0', 1, 'R');
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,10, 'Ditagihkan Kepada', '0', 1, 'L');
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'ID Pelanggan : '.$id, '0', 1, 'L');
$pdf->Cell(0,7, 'Nama : '.$nama, '0', 1, 'L');
$pdf->Cell(0,7, 'Email : '.$email, '0', 1, 'L');
$pdf->Cell(7,8, 'Tempat : '.$tempat.', '.$keterangan.', '.$alamat.', '.$kota, '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B','12');
$pdf->Cell(0,10, 'INVOICE ID #231234', '0', 1, 'L');
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Tanggal Invoice : '.$tgl.' '.$month.' '.$thn, '0', 1, 'L');
$pdf->Cell(0,7, 'Tanggal Jatuh tempo : '.$tgl1.' '.$month1.' '.$thn1, '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
foreach ($header as $kolom) {
$pdf->Cell($kolom['length'], 7, $kolom['label'], 1, '0',
$kolom['align'], true);
}
$pdf->Ln();
$pdf->SetFont('Arial','','10');
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
foreach ($header1 as $kolom1) {
$pdf->Cell($kolom1['length'],15,$kolom1['label'], 1, '0',
$kolom1['align'], true);
}
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,20, 'Total Tagihan'.' Rp. '.$harga, '0', 5, 'R');
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,15, 'Cara Melakukan Pembayaran', '0', 5, 'L');
$pdf->SetFont('Arial','','9');
$pdf->Cell(0,5, '1. Pembayaran Dapat Dilakukan Dengan Melakukan Transfer Pada No Rekening Kami', '0', 5, 'L');
$pdf->Cell(0,5, '   - BCA (NO REK : 3453 xxxx xxx)', '0', 5, 'L');
$pdf->Cell(0,5, '   - BRI (NO REK : 3453 xxxx xxx)', '0', 5, 'L');
$pdf->Cell(0,5, '2. Login Di groovyplay.com Kemudian Konfirmasi Pembayaran Pada Dasboard Anda<', '0', 5, 'L');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B','8');
$pdf->Cell(0,5, '* Keterangan : Mohon Untuk Melakukan Pembayaran Sebelum Tanggal Jatuh Tempo', '0', 5, 'R');
$pdf->output();
?>
