<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-body"  style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">SEND INVOICE</h3>
  				</div>
  			  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
  			  	<?php
	if(isset($_POST['send'])){

		$id_cust = $_POST['id_cust'];
		$res0 = $col_user->find(array("id_user"=>$id_cust,"level"=>"0"));
		foreach($res0 as $row0)
					{

						$registrasi_cust = $row0['registrasi'];
						$sales =$row0['sales'];
						$nama_cust = $row0['nama'];
						$email_cust = $row0['email'];
						$phone_cust = $row0['phone'];
						$package_cust = $row0['paket'];
						$tempat_cust = $row0['tempat'];
                        $kota_cust = $row0['kota'];
                        $status_cust = $row0['status'];
                        $alamat_cust = $row0['alamat'];
                        $ket_cust = $row0['keterangan'];
                        $tanggal_akhir = $row0['tanggal_akhir'];
                        $tanggal_aktif = $row0['tanggal_aktif'];
                        $harga_paket = $row0['harga'];
                        $no_virtual = $row0['no_virtual'];
                        $pembayaran = $row0['pembayaran'];
                    }
			$ppn_paket=$harga_paket*0.1;
			$total_harga_paket=$harga_paket+$ppn_paket;
	require('../content/srcpdf/fpdf.php');
	$header = array(
		array("label"=>"Paket : ".$package_cust, "length"=>130, "align"=>"L"),
		array("label"=>"Harga : ".rupiah($harga_paket), "length"=>55, "align"=>"L"),
		array("label"=>"PPN 10% : ".rupiah($ppn_paket), "length"=>55, "align"=>"L")
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
		$pdf->SetFont('Arial','','10');
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetDrawColor(0,0,0);
		foreach ($header as $kolom) {
			$pdf->Cell($kolom['length'], 10, $kolom['label'], 1, '0', $kolom['align'], true);
		}
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
$update_user=$col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("no_virtual"=>$kode_perusahaan.$id_cust)));
?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/send-invoice'</script>
<?php } ?>
  				<div class="panel-body">
  					<br/>
					<div class="col-sm-12">
						<table class="table table-striped table-hover">
						  <thead>
						    <tr>
						      <th width="10%">ID Cust</th>
						      <th width="20%">Customer</th>
						      <th width="15">NO VA</th>
						      <th width="15%">Paket</th>
						      <th width="15%">Tgl Registrasi</th>
						      <th width="15%">Registrasi</th>
						      <th width="10%">Kirim</th>
						    </tr>
						  </thead>
						  <?php
					$res = $col_user->find(array("level"=>"0"));
					foreach($res as $row)
                      {
                      	if($row['no_virtual']==""){
                      	?>
						  <tbody>
						    <tr>
						      <td><?php echo $row['id_user']; ?><input type="hidden" value="<?php echo $row['id_user']; ?>" name="id_cust" id="id_cust"></td>
						      <td><?php echo $row['nama'].' / '. $row['phone'].' / '.$row['email']; ?></td>
						      <td><?php echo $kode_perusahaan.$row['id_user']; ?></td>
						      <td><?php echo $row['paket']; ?></td>
						      <td><?php echo $row['tanggal_registrasi']; ?></td>
						      <td><?php echo $row['registrasi']; ?></td>
						      <td><input type="submit" name="send" id="send" class="btn btn-primary btn-xs" value="Invoice"></td>
						    </tr>
						   </tbody>
					<?php } } ?>
						</table>
					</div>
 				</div>
 			  </form>
			</div>
		</div>
	</div>
</section>
