<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
$id_cust = $_GET['id_cust'];
$res = $col_user->find(array("id_user"=>$id_cust, "level"=>"0"));
foreach($res as $row)
					{
						$tanggal_registrasi = $row['tanggal_registrasi'];
						$thn_registrasi = substr($tanggal_registrasi, 0,4);
						$bln_registrasi = substr($tanggal_registrasi, 5,2);
						$tgl_registrasi = substr($tanggal_registrasi, 8,10);
						$month_registrasi = bulan($bln_registrasi);

						$registrasi_cust = $row['registrasi'];
						$sales =$row['sales'];
						$nama_cust = $row['nama'];
						$email_cust = $row['email'];
						$phone_cust = $row['phone'];
						$package_cust = $row['paket'];
						$tempat_cust = $row['tempat'];
						$kota_cust = $row['kota'];
						$alamat_cust = $row['alamat'];
															}
$res = $col_package->find(array("nama"=>$package_cust));
foreach($res as $row)
				{
					$ket_paket = $row['isi'];
					$harga_paket = $row['harga'];
				}
if(isset($_POST['send'])){
	$stb=$_POST['stb'];
	$router=$_POST['router'];
	$instal=$_POST['instalasi'];
	$pjkbl=$_POST['pjkbl'];
	$kabel=$_POST['kabel'];
	$update_user=$col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("no_virtual"=>$kode_perusahaan.$id_cust, "router"=>$router, "stb"=>$stb, "kabel"=>$kabel, "panjang_kabel"=>$pjkbl, "instalasi"=>$instal)));
$ppn_paket=$harga_paket*0.1;
$total_harga_paket=$harga_paket+$ppn_paket;
require('../content/srcpdf/fpdf.php');
$header = array(
    array("label"=>"Pembayaran", "length"=>80, "align"=>"C"),
    array("label"=>"Harga", "length"=>30, "align"=>"C"),
    array("label"=>"Prorate", "length"=>30, "align"=>"C"),
    array("label"=>"Sub Total", "length"=>30, "align"=>"C")
  );
$kol_paket = array(
    array("label"=>$package_cust, "length"=>80, "align"=>"C"),
    array("label"=>rupiah($harga_paket), "length"=>30, "align"=>"C"),
    array("label"=>rupiah($proraide), "length"=>30, "align"=>"C"),
    array("label"=>rupiah($total_paket), "length"=>30, "align"=>"C")
  );
$kol_router = array(
    array("label"=>"Sewa Router", "length"=>80, "align"=>"C"),
    array("label"=>rupiah($biaya_router), "length"=>30, "align"=>"C"),
    array("label"=>rupiah($proraide_router), "length"=>30, "align"=>"C"),
    array("label"=>rupiah($biaya_router-$proraide_router), "length"=>30, "align"=>"C")
  );
$kol_stb = array(
    array("label"=>"Sewa STB", "length"=>80, "align"=>"C"),
    array("label"=>rupiah($biaya_stb), "length"=>30, "align"=>"C"),
    array("label"=>rupiah($proraide_stb), "length"=>30, "align"=>"C"),
    array("label"=>rupiah($biaya_stb-$proraide_stb), "length"=>30, "align"=>"C")
  );
	$kol_kabel = array(
	    array("label"=>"Kabel / ".$pjkbl." Meter", "length"=>80, "align"=>"C"),
	    array("label"=>rupiah($biaya_cable*$pjkbl), "length"=>30, "align"=>"C"),
	    array("label"=>rupiah($proraide_kabel), "length"=>30, "align"=>"C"),
	    array("label"=>rupiah($biaya_cable*$pjkbl-$proraide_stb), "length"=>30, "align"=>"C")
	  );
  $kol_instalasi = array(
      array("label"=>"Instalasi", "length"=>80, "align"=>"C"),
      array("label"=>rupiah($biaya_instalasi), "length"=>30, "align"=>"C"),
      array("label"=>rupiah(), "length"=>30, "align"=>"C"),
      array("label"=>rupiah($biaya_instalasi), "length"=>30, "align"=>"C")
    );
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Image($base_url.'/img/groovy-logo-orange.png','140','15','60');
$pdf->SetFont('Arial','B','20');
$pdf->Cell(0,30, '', '0', 5, 'L');
$pdf->Cell(0,10, 'INVOICE PEMBAYARAN', '0', 5, 'C');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'DATA PELANGGAN', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Nama Lengkap            : '.$id_cust, '0', 1, 'L');
$pdf->Cell(0,7, 'No ID Pelanggan         : '.$nama_cust, '0', 1, 'L');
$pdf->Cell(0,7, 'Alamat Pemasangan   : '.$tempat_cust.', '.$ket_cust.', '.$alamat_cust.', '.$kota_cust, '0', 1, 'L');
$pdf->Cell(0,7, 'Nomor Telepon           : '.$phone_cust, '0', 1, 'L');
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->Cell(0,7, 'DATA PEMBAYRAN - PAYMENT DATA', '0', 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial','B','10');
$pdf->SetFillColor(255,110,64);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(255,110,64);
foreach ($header as $kolom) {
  $pdf->Cell($kolom['length'], 10, $kolom['label'], 1, '0', $kolom['align'], true);
}
$jmlon=0;
$res = $col_addon->find(array("id_user"=>$id_cust));
			foreach($res as $row) {
				$jmlon=$jmlon+1; }
$pdf->Ln();
$pdf->SetFont('Arial','','10');
$pdf->SetFillColor(255,158,128);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(255,158,128);
foreach ($kol_paket as $kolom_paket) {
  $pdf->Cell($kolom_paket['length'], 8, $kolom_paket['label'], 1, '0', $kolom_paket['align'], true);
}
$w = array(80, 30, 40, 45);
if($jmlon<>"0"){
  $res = $col_addon->find(array("id_user"=>$id_cust));
           foreach($res as $row) {
  $pdf->Ln();
  $pdf->Cell($w[0],6,$row[0],'LR',0,'C');
 } }
 if($router=="1"){
$pdf->Ln();
foreach ($kol_router as $kolom_router) {
  $pdf->Cell($kolom_router['length'], 8, $kolom_router['label'], 1, '0', $kolom_router['align'], true);
} }
if($kabel=="1"){
$pdf->Ln();
foreach ($kol_kabel as $kolom_kabel) {
 $pdf->Cell($kolom_kabel['length'], 8, $kolom_kabel['label'], 1, '0', $kolom_kabel['align'], true);
} }
	if($stb=="1"){
$pdf->Ln();
foreach ($kol_stb as $kolom_stb) {
  $pdf->Cell($kolom_stb['length'], 8, $kolom_stb['label'], 1, '0', $kolom_stb['align'], true);
} } if($instal=="1"){
$pdf->Ln();
foreach ($kol_instalasi as $kolom_instalasi) {
  $pdf->Cell($kolom_instalasi['length'], 8, $kolom_instalasi['label'], 1, '0', $kolom_instalasi['align'], true);
} }
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','','10');
$pdf->Cell(0,7, 'Kode Virtual     : '.$kode_perusahaan.$id_cust, '0', 1, 'L');
$pdf->Cell(0,7, 'Total Harga      : '.$total_harga_paket, '0', 1, 'L');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,7, '* Tata cara pembayaran dapat dilihat pada FAQ web groovy.id', '0', 1, 'R');
$pdf->Image($base_url.'/img/a.jpg','170','220','30');
// Filename that will be used for the file as the attachment
$fileatt_name = $kode_perusahaan.$id_cust.'.pdf';
$dir='invoice/';
// save pdf in directory
$pdf ->Output($dir.$fileatt_name);

//....................

$data = $pdf->Output("", "S");

//..................
$email_subject = "INVOICE"; // The Subject of the email
$email_to = $email_cust; // Who the email is to


$semi_rand = md5(time());
$data = chunk_split(base64_encode($data));

$fileatt_type = "application/pdf"; // File Type
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

// set header ........................
$headers = "From: billing@groovy.id";
$headers .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/mixed;\n" .
" boundary=\"{$mime_boundary}\"";

// set email message......................
$email_message = "No virtual pembayaran anda adalah :".$kode_perusahaan.$id_cust.", proraide pembayaran ke dua dapat dilihat pada halaman billing di akun groovy.id anda.<br>";
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

	if($sent && $update_user){ ?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/send-invoice'</script>
<?php	} }
?>
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
								<label class="col-lg-3 control-label">Lokasi : </label>
								<div class="col-lg-9">
								<h4><?php echo $tempat_cust.', '.$kota_cust; ?></h4>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Tanggal Registrasi : </label>
								<div class="col-lg-9">
								<h4><?php echo $tgl_registrasi.' '.$month_registrasi.' '.$thn_registrasi; ?></h4>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Paket Aktif/Harga : </label>
								<div class="col-lg-9">
								<h4><?php echo $package_cust.'/'.rupiah($harga_paket); ?></h4>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Tambahan Layanan/Harga : </label>
								<?php
								$res = $col_addon->find(array("id_user"=>$id_cust));
								foreach($res as $row)
													{ ?>
								<div class="col-lg-9">
								<h4><?php echo $row['layanan'].'/'.rupiah($row['harga']); ?></h4>
								</div>
								<div class="col-lg-3">
								</div>
								<?php } ?>
							</div>
						</div>
							</fieldset>
						</form>
					</div>
				</div>
				<div class="panel" style="border:0px;" >
					<div class="panel-body" style="background-color:#1B5E12;">
						<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">KIRIM INVOICE</h3>
					</div>
					<div class="panel-body">
						<br/>
						<div class="col-sm-12">
								<fieldset>
									<div class="checkbox">
											<label>
													<?php if($ket_paket=="internet+tv"){ ?>
												<input type="checkbox" name="stb" id="stb" checked="true" value="1"> STB (45.000/Bulan) <br/>
													<?php } else if($ket_paket=="internet"){ ?>
												<input type="checkbox" name="stb" id="stb" value="1"> STB (45.000/Bulan) <br/>
													<?php } ?>
												<input type="checkbox" name="router" id="router" checked="true" value="1"> Router (40.000/Bulan) <br/>
												<input type="checkbox" name="kabel" id="kabel" value="1"> Tambahan Kabel (10.000/Meter) <br/>
												<input type="number" class="form-control" id="pjkbl" name="pjkbl" placeholder="Panjang Kabel (Meter)"><br/>
												<input type="checkbox" name="instal" id="instal" value="1"> Instalasi (500.000)<br/>
											</label>
										</div>
										<input type="submit" class="btn btn-success btn-sm" name="send" id="send" value="KIRIM">
								</fieldset>
							</div>
						</div>
					</div>
		</div>
	</div>
</section>
</form>
