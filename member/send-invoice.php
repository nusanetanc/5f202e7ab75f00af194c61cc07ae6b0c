<?php
	if(isset($_GET['kirim'])){
		
		$id_cust = $_GET['kirim'];
		$update_user=$col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("no_virtual"=>$kode_perusahaan.$id_cust)));
		$res0 = $col_user->find(array("id_user"=>$id_cust,"level"=>"0"));
	$pdf = new FPDF();
	$pdf->AddPage();
	$header = array(
		array("label"=>"DESKRIPSI PEMBAYARAN", "length"=>130, "align"=>"L"),
		array("label"=>"HARGA", "length"=>55, "align"=>"L")
	);
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->Image('./img/groovy-logo-orange.png','140','15','60');
		$pdf->SetFont('Arial','B','20');
		$pdf->Cell(0,30, '', '0', 5, 'L');
		$pdf->Cell(0,10, 'INVOICE PEMBAYARAN', '0', 5, 'C');
		$pdf->Ln();
		$pdf->SetFont('Arial','B','10');
		$pdf->Cell(0,7, 'DATA PELANGGAN', '0', 1, 'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','','10');
		$pdf->Cell(0,7, 'Nama Lengkap            : '.$res0['id_user'], '0', 1, 'L');
		$pdf->Cell(0,7, 'No ID Pelanggan         : '.$res0['nama'], '0', 1, 'L');
		$pdf->Cell(0,7, 'Alamat Pemasangan   : '.$res0['tempat'].', '.$res0['keterangan'].', '.$res0['alamat'].', '.$res0['kota'], '0', 1, 'L');
		$pdf->Cell(0,7, 'Nomor Telepon           : '.$res0['phone'], '0', 1, 'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','','10');
		$pdf->SetFillColor(255,255,255);
		$pdf->SetTextColor(0);
		$pdf->SetDrawColor(0,0,0);
		foreach ($header as $kolom) {
			$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
		}
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','B','10');
		$pdf->Cell(0,7, 'DATA PEMBAYRAN - PAYMENT DATA', '0', 1, 'L');
		$pdf->Ln();
		$pdf->SetFont('Arial','','10');
		$pdf->Cell(0,7, 'Kode Virtual     : '.$kode_perusahaan.$res0['id_user'], '0', 1, 'L');
		$pdf->Cell(0,7, 'Total Harga      : '.$res0['harga'], '0', 1, 'L');
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
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(0,7, '* Tata cara pembayaran dapat dilihat pada FAQ web groovy.id', '0', 1, 'R');
		$pdf->Image('./img/denstv-logo.png','10','230','50');
		$pdf->Image('./img/logo-nusanet.png','65','230','50');
		$pdf->Image('./img/a.jpg','170','220','30');

// Filename that will be used for the file as the attachment
$fileatt_name = $kode_perusahaan.$id_cust;
$dir='invoice/';
// save pdf in directory
$pdf ->Output($dir.$fileatt_name);

//....................

$data = $pdf->Output("", "S");

//..................

$email_subject = "INVOICE"; // The Subject of the email
$email_to = $res0['email']; // Who the email is to


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
$email_message = "No virtual pembayaran anda adalah :".$kode_perusahaan.$res0['id_user'].", proraide pembayaran ke dua dapat dilihat pada halaman billing di akun groovy.id anda.<br>";
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

$sent = mail($email_to, $email_subject, $email_message, $headers);?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/?hal=send-invoice'</script>
<?php } ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-body"  style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">SEND INVOICE</h3>
  				</div>
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
						      <th width="10%">Detail</th>
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
						      <td><?php echo $row['id_user']; ?></td>
						      <td><?php echo $row['nama'].' / '. $row['phone'].' / '.$row['email']; ?></td>
						      <td><?php echo $kode_perusahaan.$row['id_user']; ?></td>
						      <td><?php echo $row['paket']; ?></td>
						      <td><?php echo $row['tanggal_registrasi']; ?></td>
						      <td><?php echo $row['registrasi']; ?></td>
						      <td><b><a href="<?php echo $base_url_member; ?>/?hal=send-invoice&kirim=<?php echo $row['id_user']; ?>" class="btn btn-primary btn-xs">Kirim Invoice</a></b></td>						      
						    </tr>
						   </tbody>
					<?php } } ?>	   
						</table>    
					</div>	
 				</div>
			</div>
		</div>
	</div>	
</section>