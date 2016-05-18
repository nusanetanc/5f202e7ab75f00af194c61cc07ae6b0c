<style>
    .datepicker{z-index:1151;}
</style>
    <script>
    	$(function(){
        $("#inputPaymentdate").datepicker({
      	format:'yyyy/mm/dd'
        });
        $("#inputTerminationdate").datepicker({
      	format:'yyyy/mm/dd'
        });
            });
    </script>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
$id_cust = $_GET['id_cust'];
$date = date("Y/m/d");
$date_month = date("d");
$date_month = date("y");
						$res = $col_user->find(array("id_user"=>$id_cust, "level"=>"0"));
						foreach($res as $row)
											{
												$tanggal_registrasi = $row['tanggal_registrasi'];
												$thn_registrasi = substr($tanggal_registrasi, 0,4);
												$bln_registrasi = substr($tanggal_registrasi, 5,2);
												$tgl_registrasi = substr($tanggal_registrasi, 8,10);
												$month_registrasi = bulan($bln_registrasi);

												$tanggal_akhir = $row['tanggal_akhir'];
												$thn_akhir = substr($tanggal_akhir, 0,4);
												$bln_akhir = substr($tanggal_akhir, 5,2);
												$tgl_akhir = substr($tanggal_akhir, 8,10);
												$month_akhir = bulan($bln_akhir);

												$registrasi_cust = $row['registrasi'];
												$sales =$row['sales'];
												$nama_cust = $row['nama'];
												$email_cust = $row['email'];
												$phone_cust = $row['phone'];
												$package_cust = $row['paket'];
												$tempat_cust = $row['tempat'];
                        $kota_cust = $row['kota'];
                        $status_cust = $row['status'];
                        $alamat_cust = $row['alamat'];
                        $ket_cust = $row['keterangan'];
                        $tanggal_akhir = $row['tanggal_akhir'];
                        $tanggal_aktif = $row['tanggal_aktif'];
                        $harga_paket = $row['harga'];
                        $no_virtual = $row['no_virtual'];
                        $pembayaran = $row['pembayaran'];
                        $proraide = $row['proraide'];
                        $move_paket_cust = $row['move_paket'];
                        $move_harga_cust = $row['move_harga'];
	                                        }
	if ($bln_akhir=="12"){
		$next_month="01";
		$next_years=$thn_akhir+1;
	} else {
		$next_month=$bln_akhir+1;
		$next_years=$thn_akhir;
		if ($next_month<10){
			$next_month='0'.$next_month;
		}
	}

	if($move_paket_cust<>""){
		$paket_bayar = $move_paket_cust;
		$harga_bayar = $move_harga_cust;
		$pindah_paket = "PINDAH PAKET";
	}else if($move_paket_cust==""){
		$paket_bayar = $package_cust;
		$harga_bayar = $harga_paket;
		$pindah_paket = "PAKET AKTIF";
	}
	$total_bayar =$harga_paket - $proraide;
	            $res_pack = $col_package->find(array("nama"=>$package_cust));
	            foreach($res_pack as $row_pack) { $harga_hari = $row_pack['harga_hari']; }
$res = $col_package->find(array("nama"=>$package_cust));
	foreach($res as $row)
	{
		$deskripsi_paket0=$row['deskripsi'];
	}
$res = $col_package->find(array("nama"=>$move_paket_cust));
	foreach($res as $row)
	{
		$deskripsi_paket1=$row['deskripsi'];
	}
if(isset($_POST['verifikasi'])){
		$tanggal_bayar = $_POST['inputPaymentdate'];
		$thn_bayar = substr($tanggal_bayar, 0,4);
		$bln_bayar = substr($tanggal_bayar, 5,2);
		$tgl_bayar = substr($tanggal_bayar, 8,10);
		$month_bayar = bulan($bln_bayar);
		$last_pembayaran = $pembayaran + 1;
if ($total_revenue=="" || empty($total_revenue)){
	$update_revenue = $col_revenue->insert(array("date"=>$date, "total"=>$total_bayar));
} else {
	$revenue=$total_revenue+$total_bayar;
	$update_revenue = $col_revenue->update(array("date"=>$date), array('$set'=>array("total"=>$revenue)));
}
if ($status_cust=="aktif"){
  $biaya_instalasi=0;
}
//mail to bukti pembayaran

require('../content/srcpdf/fpdf.php');
$header = array(
    array("label"=>"Pembayaran", "length"=>80, "align"=>"C"),
    array("label"=>"Harga", "length"=>30, "align"=>"C"),
    array("label"=>"Prorate", "length"=>30, "align"=>"C"),
    array("label"=>"Sub Total", "length"=>30, "align"=>"C")
  );
$kol_paket = array(
    array("label"=>$paket_bayar, "length"=>80, "align"=>"C"),
    array("label"=>rupiah($harga_bayar), "length"=>30, "align"=>"C"),
    array("label"=>rupiah($proraide), "length"=>30, "align"=>"C"),
    array("label"=>rupiah($total_bayar), "length"=>30, "align"=>"C")
  );
$kol_router = array(
    array("label"=>"Sewa Router", "length"=>80, "align"=>"C"),
    array("label"=>rupiah($biaya_router), "length"=>30, "align"=>"C"),
    array("label"=>rupiah($proraide_router), "length"=>30, "align"=>"C"),
    array("label"=>rupiah($biaya_router+$proraide_router), "length"=>30, "align"=>"C")
  );
$kol_stb = array(
    array("label"=>"Sewa STB", "length"=>80, "align"=>"C"),
    array("label"=>rupiah($biaya_stb), "length"=>30, "align"=>"C"),
    array("label"=>rupiah($proraide_stb), "length"=>30, "align"=>"C"),
    array("label"=>rupiah($biaya_stb+$proraide_stb), "length"=>30, "align"=>"C")
  ); if($status_cust=="registrasi"){
  $kol_instalasi = array(
      array("label"=>"Instalasi", "length"=>80, "align"=>"C"),
      array("label"=>rupiah($biaya_instalasi), "length"=>30, "align"=>"C"),
      array("label"=>rupiah($proraide_instalasi), "length"=>30, "align"=>"C"),
      array("label"=>rupiah($biaya_instalasi+$proraide_instalasi), "length"=>30, "align"=>"C")
    ); }
    $jmlon=0;
  $res = $col_addon->find(array("id_user"=>"$id_cust"));
          foreach($res as $row) {
            $jmlon=$jmlon+1;
    $liston = array(
        array("label"=>$row['layanan'], "length"=>80, "align"=>"C"),
        array("label"=>rupiah($row['harga']), "length"=>30, "align"=>"C"),
        array("label"=>rupiah($row['proraide']), "length"=>30, "align"=>"C"),
        array("label"=>rupiah($row['harga']+$row['proraide']), "length"=>30, "align"=>"C")
      );  }
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image('../img/groovy-logo-orange.png','140','15','60');
$pdf->SetFont('Arial','B','20');
$pdf->Cell(0,30, '', '0', 5, 'L');
$pdf->Cell(0,10, 'BUKTI PEMBAYARAN', '0', 5, 'C');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'DATA PELANGGAN', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Nama Lengkap            : '.$nama_cust, '0', 1, 'L');
$pdf->Cell(0,7, 'No ID Pelanggan         : '.$id_cust, '0', 1, 'L');
$pdf->Cell(0,7, 'Alamat Pemasangan   : '.$tempat_cust.', '.$ket_cust.', '.$alamat_cust.', '.$kota_cust, '0', 1, 'L');
$pdf->Cell(0,7, 'Nomor Telepon            : '.$phone_cust, '0', 1, 'L');
$pdf->Cell(0,7, 'Alamat Email               : '.$email_cust, '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'DATA PEMBAYARAN', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->SetFillColor(255,110,64);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(255,110,64);
foreach ($header as $kolom) {
  $pdf->Cell($kolom['length'], 10, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();
$pdf->SetFont('Arial','B','7');
$pdf->SetFillColor(255,158,128);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(255,158,128);
foreach ($kol_paket as $kolom_paket) {
  $pdf->Cell($kolom_paket['length'], 8, $kolom_paket['label'], 1, '0', $kolom_paket['align'], true);
}
if($jmlon<>"0"){
$pdf->Ln();
foreach ($liston as $kolom_addon) {
  $pdf->Cell($kolom_addon['length'], 8, $kolom_addon['label'], 1, '0', $kolom_addon['align'], true);
} }
$pdf->Ln();
foreach ($kol_router as $kolom_router) {
  $pdf->Cell($kolom_router['length'], 8, $kolom_router['label'], 1, '0', $kolom_router['align'], true);
}
$pdf->Ln();
foreach ($kol_stb as $kolom_stb) {
  $pdf->Cell($kolom_stb['length'], 8, $kolom_stb['label'], 1, '0', $kolom_stb['align'], true);
} if($status_cust=="registrasi"){
$pdf->Ln();
foreach ($kol_instalasi as $kolom_instalasi) {
  $pdf->Cell($kolom_instalasi['length'], 8, $kolom_instalasi['label'], 1, '0', $kolom_instalasi['align'], true);
} }
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'KONFIRMASI PEMBAYRAN - PAYMENT CONFIRMATION', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Tanggal Bayar               : '.$tgl_bayar.' '.$month_bayar.' '.$thn_bayar, '0', 1, 'L');
$pdf->Cell(0,7, 'Kode Virtual                   : '.$no_virtual, '0', 1, 'L');
$pdf->Cell(0,7, 'Jumlah Pembayaran      : '.rupiah($total_bayar), '0', 1, 'L');
$pdf->Ln();
$pdf->Ln();
$pdf->Image('../img/denstv-logo.png','10','250','50');
$pdf->Image('../img/logo-nusanet.png','65','250','50');
$pdf->Image('../img/a.jpg','170','240','30');
// Filename that will be used for the file as the attachment
$fileatt_name = $no_virtual.$last_pembayaran.'.pdf';
$dir='bukti/';
// save pdf in directory
$pdf ->Output($dir.$fileatt_name);
//....................

$data = $pdf->Output("", "S");

//..................

$email_subject1 = "Bukti Pembayaran groovy"; // The Subject of the email
$email_to1 = $email_cust; // Who the email is to


$semi_rand = md5(time());
$data = chunk_split(base64_encode($data));

$fileatt_type = "application/pdf"; // File Type
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

// set header ........................
$headers1 = "From: billing@groovy.id";
$headers1.= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/mixed;\n" .
" boundary=\"{$mime_boundary}\"";

// set email message......................
$email_message1 = "Terimakasih ".$nama_cust." sudah menggunakan layanan Tv groovy.id.<br>";
$email_message1 .= "Bukti pembayaran ini menandakan bahwa pembayaran anda sudah kami konfirmasi dan terima.<br>";// Message that the email has in it
$email_message1 .= "Untuk pelanggan baru kami akan segera memberi inforamsi untuk jadwal pemasangan.<br>";
$email_message1 .= "Terimakasih sudah menggunakan layanan Tv groovy.id.<br>";
$email_message1 .= "Selamat menikamati layanan TV dari groovy.id.<br>";
$email_message1 .= "Untuk info lebih lanjut bisa membuat pengaduan pada halaman member anda di groovy.id.\n\n" .
"--{$mime_boundary}\n" .
"Content-Type:text/html; charset=\"iso-8859-1\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" .
$email_message1 .= "\n\n";
$email_message1 .= "--{$mime_boundary}\n" .
"Content-Type: {$fileatt_type};\n" .
" name=\"{$fileatt_name}\"\n" .
"Content-Disposition: attachment;\n" .
" filename=\"{$fileatt_name}\"\n" .
"Content-Transfer-Encoding: base64\n\n" .
$data .= "\n\n" .
"--{$mime_boundary}--\n";

$emailinvoice = mail($email_to1, $email_subject1, $email_message1, $headers1);
$pay = array("deskripsi"=>$package_cust, "harga"=>$harga_bayar, "prorate"=>$prorate, "total_harga"=>$harga_bayar);
//$update_bayar = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$push'=>array("payment"=>$pay)));
$insert_bayar = $col_payment->insert(array("id_user"=>$id_cust, "tanggal_bayar"=>$tanggal_bayar, "tanggal_konfirmasi"=>$date,"pembayaran"=>$pay, "total_tagihan"=>$total_bayar, "ppn"=>$ppn, "no"=>$last_pembayaran, "total_pembayaran"=>$total_pembayaran));
	if ($status_cust=="registrasi"){
		$sisa_hari = 30-$date_month;
		$last_proraide = $sisa_hari*$harga_hari;
		$update_user = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"), array('$set'=>array("pembayaran"=>$last_pembayaran, "proraide"=>$last_proraide)));
				// mail for supevisior teknik
				$subject = 'Atur Jadwal Pemasangan';
				$message = '
				<html>
				<body>
				  <p>Mohon segera diatur jadwal pemasangan untuk customer berikut : </p>
				  <br/>
				  <p>ID Customer : '.$id_cust.'</p>
				  <p>Nama : '.$nama_cust.'</p>
				  <p>Tempat : '.$tempat_cust.', '.$ket_cust.', '.$kota_cust.'</p>
				  <p>Tanggal Registrasi : '.$tgl_registrasi.' '.$month_registrasi.' '.$thn_registrasi.'</p>
				  <p>Registrasi : '.$registrasi_cust.' '.$sales.'</p>
				  <p>Paket : '.$package_cust.'('.$deskripsi_paket0.')</p>
				  <br/>
				</body>
				</html>
				';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
				$headers .= 'Cc: cs@groovy.id' . "\r\n";
			$res = $col_user->find(array("level"=>"3"));
						foreach($res as $row)
											{
				$emailpasang=mail($row['email'], $subject, $message, $headers);
			}
	} else {
		$update_user = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"), array('$set'=>array("tanggal_akhir"=>$next_years.'/'.$next_month.'/01', "pembayaran"=>$last_pembayaran, "proraide"=>"0")));
	}
		if($move_paket_cust<>""){
			// mail for supevisior teknik
				$subject = 'Pindah Paket';
				$message = '
				<html>
				<body>
				  <p>Customer pindah paket : </p>
				  <br/>
				  <p>ID Customer : '.$id_cust.'</p>
				  <p>Nama : '.$nama_cust.'</p>
				  <p>Tempat : '.$tempat_cust.', '.$ket_cust.', '.$kota_cust.'</p>
				  <p>Paket Aktif : '.$package_cust.'('.$deskripsi_paket0.')</p>
				  <p>Pindah Paket : '.$move_paket_cust.'('.$deskripsi_paket1.')</p>
				  <p>Tanggal Pindah Paket : '.$tgl_akhir.' '.$month_akhir.' '.$thn_akhir.'</p>
				  <br/>
				</body>
				</html>
				';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
				$headers .= 'Cc: cs@groovy.id' . "\r\n";
			$res = $col_user->find(array("level"=>"3"));
						foreach($res as $row)
											{
				$emailpindah=mail($row['email'], $subject, $message, $headers);
			}
					// mail for customer
				$subject1 = 'Pemberitahuan Pindah Paket';
				$message1 = '
				<html>
					<body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
					    <div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
					        <div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
					            <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
					        </div>
					        <div style="padding:20px;color:#333;">
					            <p style="font-size:20px;font-weight:bold;line-height:1px">Pemberitahuan Pindah Paket</p>
					            <p>Kami akan mengganti paket anda dari paket : '.$package_cust.' ('.$deskripsi_paket0.'), ke paket : '.$move_paket_cust.' ('.$deskripsi_paket1.'),pada tanggal : '.$tgl_akhir.' '.$month_akhir.' '.$thn_akhir.'.</p>
					        </div>
					        </div>
					    </div>
					</body>
					</html>
				';
				$headers1  = 'MIME-Version: 1.0' . "\r\n";
				$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers1 .= 'From: cs@groovy.id' . "\r\n";
				$headers1 .= 'Cc: cs@groovy.id' . "\r\n";
				$emailcust_pindah=mail($email_cust, $subject1, $message1, $headers1);
}
if ($update_user && $update_bayar && $emailinvoice){
	?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/verification-payment/<?php echo $id_cust; ?>'</script>
<?php } }
if(isset($_POST['terminasi'])){
	$termination_date=$_POST['inputTerminationdate'];
	$textalasanberhenti=$_POST['textalasanberhenti'];
		$thn_tutup = substr($termination_date, 0,4);
		$bln_tutup = substr($termination_date, 5,2);
		$tgl_tutup = substr($termination_date, 8,10);
		$month_tutup = bulan($bln_tutup);
	$term=array("tanggal_berhenti"=>$termination_date, "alasan"=>$textalasanberhenti);
	$update_user = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"), array('$set'=>array("tanggal_akhir"=>$termination_date, "status"=>"unaktif"))); echo yudi;
	$push_termiansi = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"), array('$push'=>array("termination"=>$term)));echo yudi0;
				// mail for supevisior teknik
				$subject0 = 'Request Ambil Perangkat';
				$message0 = '
				<html>
				<body>
				  <p>Mohon segera diatur Support untuk pengambilan perangkat untuk customer berikut : </p>
				  <br/>
				  <p>ID Customer : '.$id_cust.'</p>
				  <p>Nama : '.$nama_cust.'</p>
				  <p>Tempat : '.$tempat_cust.', '.$ket_cust.', '.$kota_cust.'</p>
				  <p>Tanggal Tutup : '.$tgl_tutup.' '.$month_tutup.' '.$thn_tutup.'</p>
				  <br/>
				</body>
				</html>
				';
				$headers0  = 'MIME-Version: 1.0' . "\r\n";
				$headers0 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers0 .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
				$headers0 .= 'Cc: cs@groovy.id' . "\r\n";
				$res = $col_user->find(array("level"=>"3"));
			foreach($res as $row) {
				$emailbongkar=mail($row['email'], $subject0, $message0, $headers0);
			}
			// mail for customer
				$subject1 = 'Berhenti Berlangganan';
				$message1 = '
				<html>
					<body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
					    <div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
					        <div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
					            <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
					        </div>
					        <div style="padding:20px;color:#333;">
					            <p style="font-size:20px;font-weight:bold;line-height:1px">Hai '.$nama_cust.',</p>
					            <p>Terimakasih sudah berlangganan Groovy.</p>
					            <p>Layanan anda akan berakhir pada tanggal '.$tgl_tutup.' '.$month_tutup.' '.$thn_tutup.'<br/><br/>
					            Kami akan segera memberikan informasi terkait pengambilan perangkat yang Anda gunakan. Untuk Melakukan aktivasi kembali layanan kami bisa di halaman member anda.</p>
					            <p style="color:#888;">Terimakasih.</p>
					        </div>
					        </div>
					    </div>
					</body>
					</html>

				';
				$headers1  = 'MIME-Version: 1.0' . "\r\n";
				$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers1 .= 'From: cs@groovy.id' . "\r\n";
				$headers1 .= 'Cc: billing@groovy.id' . "\r\n";
				$emailnotice=mail($email_cust, $subject1, $message1, $headers1);

				require('../content/srcpdf/fpdf.php');
				$pdf = new FPDF();
				$pdf->AddPage();
				$pdf->SetFont('Arial','B','10');
				$pdf->Cell(0,20, 'PT Media Andalan Nusa (Nusanet)', '0', 1, 'R');
				$pdf->SetFont('Arial','B','14');
				$pdf->Cell(0,10, 'FORMULIR PENUTUPAN LAYANAN', '0', 5, 'C');
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
				$pdf->Cell(0,7, 'PENUTUPAN / TERMINASI', '0', 1, 'L');
				$pdf->SetFont('Arial','','10');
				$pdf->Cell(0,7, 'Tanggal Penutupan : '.$tgl_tutup.' '.$month_tutup.' '.$thn_tutup, '0', 1, 'L');
				$pdf->Cell(0,7, 'Alasan Penutupan   : '.$textalasanberhenti, '0', 1, 'L');
				$pdf->Ln();
				$pdf->SetFont('Arial','B','10');
				$pdf->Cell(0,7, 'Tanggal : '.$tgl_tutup.' '.$month_tutup.' '.$thn_tutup, '0', 1, 'R');
				$pdf->Ln();
				$pdf->Ln();
				$pdf->Ln();
				$pdf->Ln();
				$pdf->Image('../img/tanda_tangan.jpg','165','150','33','33');
				$pdf->SetFont('Arial','','10');
				$pdf->Cell(0,7, 'John Doe              ', '0', 1, 'R');
				$pdf->Cell(0,7, 'Customer Relation Officer', '0', 1, 'R');
				$pdf->Cell(0,7, 'PT Media Andalan Nusa ', '0', 1, 'R');

				// Filename that will be used for the file as the attachment
				$fileatt_name = $tgl_tutup.$month_tutup.$thn_tutup.$id_cust."termination.pdf";
				$dir='bukti/';
				$pdf ->Output($dir.$fileatt_name);

				$data = $pdf->Output("", "S");

				$email_from = "cs@groovy.id"; // Who the email is from
				$email_subject = "[SERVICE TERMINATION REQUEST] - Nusanet - ".$nama_cust; // The Subject of the email
				$email_to = $email_dens; // Who the email is to


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

				$sent = mail($email_to, $email_subject, $email_message, $headers);
if ($update_user && $emailbongkar && $emailnotice && $sent){
	?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/verification-payment/<?php echo $id_cust; ?>'</script>
<?php }  } ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
				<div class="panel-body" style="background-color:#1B5E12;">
					<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">CUSTOMER</h3>
				</div>
				<div class="panel-body">
					<br/>
					<div class="col-sm-12">
						<form class="form-horizontal">
						  <fieldset>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Nama : </label>
							  <div class="col-lg-9">
								<h4><?php echo $nama_cust; ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Email : </label>
							  <div class="col-lg-9">
								<h4><?php echo $email_cust; ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Custommer ID : </label>
							  <div class="col-lg-9">
								<h4><?php echo $id_cust ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Phone Number : </label>
							  <div class="col-lg-9">
								<h4><?php echo $phone_cust; ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Paket Aktif/Harga : </label>
							  <div class="col-lg-9">
								<h4><?php echo $package_cust.'/'.rupiah($harga_paket); ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Lokasi : </label>
							  <div class="col-lg-9">
								<h4><?php echo $tempat_cust.', '.$ket_cust.', '.$kota_cust; ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Tanggal Registrasi : </label>
							  <div class="col-lg-9">
								<h4><?php echo $tgl_registrasi.' '.$month_registrasi.' '.$thn_registrasi; ?></h4>
							  </div>
							</div>	<?php if($status_cust<>"registrasi"){ ?>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Tanggal Akhir Pembayaran : </label>
							  <div class="col-lg-9">
								<h4><?php echo $tgl_akhir.' '.$month_akhir.' '.$thn_akhir; ?></h4>
              </div></option>
                <?php } ?><br/>
								<input type="text" class="form-control" id="inputPaymentdate" name="inputPaymentdate" placeholder="Payment Date" required>
								<br/>
								<div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>
								<br/>
								<input type="submit" class="btn" style="background-color:#1B5E12; color:#FFFFFF" name="verifikasi" id="verifikasi" value="Vertifikasi">
							  </div>
							</div>
						  </fieldset>
						</form>
					</div>
				</div>
		<div class="col-sm-12">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">BILLING - <?php echo $pindah_paket; ?></h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="40%">Deskripsi Pembayaran</th>
									      <th width="20%">Harga</th>
									      <th width="20%">Prorate</th>
									      <th width="20%">Total Bayar</th>
									    </tr>
									  </thead>
									  <tbody>
									  	<td><?php echo $paket_bayar; ?></td>
									  	<td><?php echo rupiah($harga_bayar); ?></td>
									  	<td><?php echo rupiah($proraide); ?></td>
									  	<td><?php echo rupiah($total_bayar); ?></td>
									  </tbody>
                    <?php	$res = $col_addon->find(array("id_user"=>"$id_cust"));
                          foreach($res as $row) { ?>
                    <tbody>
									  	<td><?php echo $row['layanan']; ?></td>
									  	<td><?php echo rupiah($row['harga']); ?></td>
									  	<td><?php echo rupiah($row['proraide']); ?></td>
                      <?php $total_bayar0=$row['harga']-$row['proraide'];
                            $total_harga_addon=$total_harga_addon+$total_bayar0;  ?>
									  	<td><?php echo rupiah($total_bayar0); ?></td>
									  </tbody>
                    <?php } ?>
                    <tbody>
                      <td>Sewa Router</td>
                      <td></td>
                      <td></td>
                      <td><?php echo rupiah($biaya_router); ?></td>
                    </tbody>
                    <?php $rslt = $col_package->find(array("nama"=>$package_cust));
                    foreach ($rslt as $row) {
                      $isi_paket = $row['isi'];
                    }
                    if($isi_paket=="internet+tv"){ ?>
                    <tbody>
                      <td>Sewa STB</td>
                      <td></td>
                      <td></td>
                      <td><?php echo rupiah($biaya_stb); ?></td>
                    </tbody>
                    <?php } ?>
                    <?php if($status_cust=="unaktif" || $status_cust=="registrasi"){ ?>
                    <tbody>
                      <td>Instalasi</td>
                      <td></td>
                      <td></td>
                      <td><?php echo rupiah($biaya_instalasi); ?></td>
                    </tbody>
                    <tbody>
                      <td><strong>Total Tagihan</strong></td>
                      <td></td>
                      <td></td> <?php if($isi_paket=="internet+tv"){
                          $harga_total = $biaya_instalasi+$biaya_router+$biaya_stb+$total_bayar+$total_harga_addon;
                        } elseif($isi_paket=="internet"){
                          $harga_total = $biaya_instalasi+$biaya_router+$total_bayar+$total_harga_addon;
                        }
                        $ppn=$harga_total*0.1;
                        ?>
                      <td><strong><?php echo rupiah($harga_total); ?></strong></td>
                    </tbody>
                    <tbody>
                      <td>PPN 10%</td>
                      <td></td>
                      <td></td>
                      <td><?php echo rupiah($ppn); ?></td>
                    </tbody>
                    <tbody>
                      <td><strong>Total Pembayaran</strong></td>
                      <td></td>
                      <td></td>
                      <td><strong><?php echo rupiah($harga_total+$ppn); ?></strong></td>
                    </strong></tbody>
                    <?php } elseif($status_cust=="aktif"){ ?>
                      <tbody>
                        <td><strong>Total Tagihan</strong></td>
                        <td></td>
                        <td></td>
                        <?php if($isi_paket=="internet+tv"){
                            $harga_total = $biaya_router+$biaya_stb+$total_bayar+$total_harga_addon;
                          } elseif($isi_paket=="internet"){
                            $harga_total = $biaya_router+$total_bayar+$total_harga_addon;
                          }
                          $ppn=$harga_total*0.1;
                          ?>
                        <td><strong><?php echo rupiah($harga_total); ?></strong></td>
                      </tbody>
                      <tbody>
                        <td>PPN 10%</td>
                        <td></td>
                        <td></td>
                        <td><?php echo rupiah($ppn); ?></td>
                      </tbody>
                      <tbody>
                        <td><strong>Total Pembayaran</strong></td>
                        <td></td>
                        <td></td>
                        <td><strong><?php echo rupiah($harga_total+$ppn); ?></strong></td>
                      </strong></tbody>
                    <?php } ?>
								</table>
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
					  	</div>
					</div>
				</div>
		<div class="col-sm-12">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">DATA PEMBAYARAN - <?php echo $pembayaran; ?></h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="10%">No</th>
									      <th width="30%">Pembayaran</th>
									      <th width="30%">Konfirmasi</th>
									      <th width="30%"></th>
									    </tr>
									  </thead>
									  <?php
									  	$res = $col_payment->find(array("id_user"=>$id_cust));
										foreach ($res as $byr) {
											$thn_konfirmasi = substr($byr['tanggal_konfirmasi'], 0,4);
											$bln_konfirmasi = substr($byr['tanggal_konfirmasi'], 5,2);
											$tgl_konfirmasi = substr($byr['tanggal_konfirmasi'], 8,10);
											$month_konfirmasi = bulan($bln_konfirmasi);

											$thn_bayar = substr($byr['tanggal_bayar'], 0,4);
											$bln_bayar = substr($byr['tanggal_bayar'], 5,2);
											$tgl_bayar = substr($byr['tanggal_bayar'], 8,10);
											$month_bayar = bulan($bln_bayar);
									   ?>
									  <tbody class="pic-container down">
									  	<td><?php echo $byr['no']; ?></td>
									  	<td><?php echo $tgl_bayar.' '.$month_bayar.' '.$thn_bayar; ?></td>
									  	<td><?php echo $tgl_konfirmasi.' '.$month_konfirmasi.' '.$thn_konfirmasi; ?></td>
									  	<td><a href="#" data-toggle="modal" data-target="#<?php echo $byr['no']; ?>">Deskripsi</a></td>
									  </tbody>
                    <div class="modal" name=<?php echo $byr['no']; ?> id=<?php echo $byr['no']; ?>>
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Data Pembayaran</h4>
                          </div>
                          <div class="modal-body">
                              <div class="panel panel-default">
                                <?php foreach ($byr['pembayaran'] as $pmbyr) { ?>
                                  <div class="panel-body">
                                    <strong><?php print_r($pmbyr['deskripsi']); ?></strong>=>Harga<b>(<?php print_r(rupiah($pmbyr['harga'])); ?>)</b> - Prorate<b>(<?php print_r(rupiah($pmbyr['prorate'])); ?>)</b> = Subtotal<b>(<?php print_r(rupiah($pmbyr['total_harga'])); ?>)</b>
                                  </div>
                                  <?php } ?>
                                </div>
                          </div>
                          <div class="modal-footer">
                            <p>Total Tagihan : <b><?php echo rupiah($byr['total_tagihan']); ?></b></p>
                            <p>PPN 10% : <b><?php echo rupiah($byr['ppn']); ?></b></p>
                            <p>Total Pembayaran : <b><?php echo rupiah($byr['total_pembayaran']); ?></b></p>
                          </div>
                        </div>
                      </div>
                    </div>
									  <?php } ?>
								</table>
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
					  	</div>
					</div>
				</div>
		<div class="col-sm-12">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">TERMINASI LAYANAN</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
								<input type="text" class="form-control" id="inputTerminationdate" name="inputTerminationdate" placeholder="Termination Date" required> <br/>
								<input type="text" class="form-control" name="textalasanberhenti" id="textalasanberhenti" placeholder="Alasan Penutupan"><br/>
								<div style="margin-bottom:7px;" class="g-recaptcha" data-sitekey="6Ldx_BsTAAAAAOYrQegHLVhslSvd6z78zAr-4Knc"></div>
									<br/>
								<input type="submit" class="btn" style="background-color:#1B5E12; color:#FFFFFF" name="terminasi" id="terminasi" value="TUTUP">
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</form>
