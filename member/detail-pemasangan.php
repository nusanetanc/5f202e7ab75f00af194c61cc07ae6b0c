<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
$id_cust = $_GET['id'];
$date = date("Y/m/d");
$date_days = date("d");
$date_years = date("Y");
$date_month = date("m");
$date_month1 = bulan($date_month);
$res = $col_user->find(array("id_user"=>$id_cust,"tanggal_aktivasi"=>"","status"=>"bayar","level"=>"0"));	
						foreach ($res as $row) {
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
						                        $status_cust = $row['status'];
						                        $alamat_cust = $row['alamat'];
						                        $ket_cust = $row['keterangan'];
						                        $harga_paket = $row['harga'];
	                                            $no_virtual = $row['no_virtual'];
	                                            $pembayaran = $row['pembayaran'];
	                                            $proraide = $row['proraide'];
	                                        }
$res1 = $col_package->find(array("nama"=>$package_cust));	
						foreach ($res1 as $row1) {
							$deskripsi_paket=$row1['deskripsi'];
						}                                         
	                                                	
if (isset($_POST['save'])){
	$tanggal_pasang = $_POST['inputTanggal'];
	$boxtv = $_POST['inputKodebox'];
	$support_field = $_POST['inputField'];
	$support_Assfield = $_POST['inputAssfield'];
	$note = $_POST['inputNote'];
		$thn_psng = substr($tanggal_pasang, 0,4);
		$bln_psng = substr($tanggal_pasang, 5,2);
		$tgl_psng = substr($tanggal_pasang, 8,10);
		$month_psng = bulan($bln_psng);
$update_user = $col_user->update(array("id_user"=>$id_cust),array('$set'=>array("tanggal_pasang"=>$tanggal_pasang, "field_engginer"=>$support_field, "ass_field"=>$support_Assfield, "status"=>"progress pasang", "no_box"=>$boxtv)));
$insert_activty = $col_history->insert(array("hal"=>"pasang","tanggal_kerja"=>$tanggal_pasang, "field_engineer"=>$support_field, "ass_field"=>$support_Assfield, "status"=>"progress", "id_customer"=>$id_cust, "nama_customer"=>$nama_cust, "tempat_customer"=>$tempat_cust, "alamat_customer"=>$alamat_cust, "kota_customer"=>$kota_cust ,"keterangan_customer"=>$keterangan_cust, "phone_customer"=>$notelp_cust, "paket"=>$nama_paket, "status"=>"progress", "no_box"=>$boxtv));
		// mail for field engineer
		$to = $support_field.', '.$support_Assfield;

		$subject = 'Info Pemasangan';

		$message = '
		<html>
		<body>
		  <p>Lakukan pemasangan dengan rincian customer berikut : </p>
		  <br/>
		  <p>Customer : '.$id_cust.' / '.$nama_cust.' / '.$notelp_cust.'</p>
		  <p>Paket : '.$nama_paket.'</p>
		  <p>Tanggal Registrasi : '.$tgl_regis.' '.$bln_regis.' '.$thn_regis.'</p>
		  <p>Tempat : '.$tempat_cust.' '.$keterangan_cust.' '.$alamat_cust.' '.$kota_cust.'</p>
		  <p>No STB : '.$boxtv.'</p>
		  <p>Tanggal Pemasangan : '.$tgl_psng.' '.$bln_psng.' '.$thn_psng.'</p>
		  <p>Support : '.$support_field.' dan '.$support_Assfield.'</p>
		  <br/>
		  <p>Mohon untuk melakukan report pada halaman member di groovy.id setelah TV customer aktif</p>
		</body>
		</html>
		';

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
		$headers .= 'Cc: cs@groovy.id' . "\r\n";

		$kirim_email=mail($to, $subject, $message, $headers);
			// mail for customer to pemasangan
			$to1 = $email_cust;

			$subject1 = 'Info Pemasangan dan Aktivasi groovy';

			$message1 = '
			<html>
			<body>
			  <p>Terima kasih sudah menjadi customer groovy,<br/>
			  kami akan melakukan pemasangan dan aktivasi pada tanggal : '.$tgl_psng.' '.$bln_psng.' '.$thn_psng.',<br/>
			  untuk info lebih lanjut bisa membuat pengaduan pada halaman member anda.<br>
			  Selamat menikmati layanan tv dari groovy.
			</p>
			  <br/>
			  <br/>
			  <p>Best Regards</p>
			  <p>Customer Service</p>
			  <p>groovy.id</p>
			</body>
			</html>
			';

			$headers1  = 'MIME-Version: 1.0' . "\r\n";
			$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			$headers1 .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
			$headers1 .= 'Cc: cs@groovy.id' . "\r\n";

			$kirim_email1=mail($to1, $subject1, $message1, $headers1);
							require('../content/scrpdf/fpdf.php');
							$pdf = new FPDF();
							$pdf->AddPage();
							$pdf->SetFont('Arial','B','10');
							$pdf->Cell(0,20, 'PT Media Andalan Nusa (Nusanet)', '0', 1, 'R');
							$pdf->SetFont('Arial','B','14');
							$pdf->Cell(0,10, 'FORMULIR PENDAFTRAN', '0', 5, 'C');
							$pdf->Ln();
							$pdf->SetFont('Arial','B','10');
							$pdf->Cell(0,7, 'DATA PELANGGAN', '0', 1, 'L');
							$pdf->Ln();
							$pdf->SetFont('Arial','','10');
							$pdf->Cell(0,7, 'Jenis Pendaftaran        : Baru', '0', 1, 'L');
							$pdf->Cell(0,7, 'Nama Lengkap             : '.$nama_cust, '0', 1, 'L');
							$pdf->Cell(0,7, 'No ID Pelanggan          : '.$id_cust, '0', 1, 'L');
							$pdf->Cell(0,7, 'Alamat Pemasangan    : '.$tempat_cust.' '.$keterangan_cust.' '.$alamat_cust.' '.$kota_cust, '0', 1, 'L');
							$pdf->Cell(0,7, 'Nomor Telepon             : '.$phone_cust, '0', 1, 'L');
							$pdf->Ln();
							$pdf->SetFont('Arial','B','10');
							$pdf->Cell(0,7, 'LAYANAN', '0', 1, 'L');
							$pdf->Ln();
							$pdf->SetFont('Arial','','10');
							$pdf->Cell(0,7, 'Jenis Layanan               : '.$package_cust.' - '.$deskripsi_paket, '0', 1, 'L');
							$pdf->Cell(0,7, 'Layanan Tembahan      : No', '0', 1, 'L');
							$pdf->Cell(0,7, 'Nomor SN STB             : '.$boxtv, '0', 1, 'L');
							$pdf->Cell(0,7, 'Alamat Email                 : '.$email_cust, '0', 1, 'L');
							$pdf->Cell(0,7, 'Kata Sandi                    : g456789', '0', 1, 'L');
							$pdf->Ln();
							$pdf->Ln();
							$pdf->Ln();
							$pdf->SetFont('Arial','B','10');
							$pdf->Cell(0,7, 'Tanggal : '.$date_days.' '.$date_month1.' '.$date_years, '0', 1, 'R');
							$pdf->SetFont('Arial','','10');
							$pdf->Ln();
							$pdf->Ln();
							$pdf->Ln();
							$pdf->Ln();
							$pdf->Image('./img/tanda_tangan.jpg','165','185','33','33');
							$pdf->SetFont('Arial','','10');
							$pdf->Cell(0,7, 'John Doe              ', '0', 1, 'R');
							$pdf->Cell(0,7, 'Customer Relation Officer', '0', 1, 'R');
							$pdf->Cell(0,7, 'PT Media Andalan Nusa ', '0', 1, 'R');

							// Filename that will be used for the file as the attachment
							$fileatt_name = $id_cust.'-'.$tanggal_pasang.'-'.$boxtv.".pdf";
							$dir='pasang/';
							// save pdf in directory
							$pdf ->Output($dir.$fileatt_name);

							//....................

							$data = $pdf->Output("", "S");

							//..................

							$email_subject = "[REGISTRATION] - Nusanet - ".$nama_cust; // The Subject of the email
							$email_to = "nurhandiy@gmail.com"; // Who the email is to


							$semi_rand = md5(time());
							$data = chunk_split(base64_encode($data));

							$fileatt_type = "application/pdf"; // File Type
							$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

							// set header ........................
							$headers = "From: cs@groovy.id";
							$headers .= "\nMIME-Version: 1.0\n" .
							"Content-Type: multipart/mixed;\n" .
							" boundary=\"{$mime_boundary}\"";

							// set email message......................
							$email_message = "Mohon segera diaktivasi STB dengan serial number  : ".$boxtv."<br>";
							$email_message .= "Work Order : Instalasi<br>";// Message that the email has in it
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

							$sent_aktivasi = mail($email_to, $email_subject, $email_message, $headers);
if ($update_user && $insert_activty && $kirim_email1 && $kirim_email && $sent_aktivasi){ ?>
	<script type="" language="JavaScript">
	document.location='<?php echo $base_url_member; ?>/?hal=setup-progress'</script>
<?php }
}
?>
<style>
    .datepicker{z-index:1151;}
</style>
    <script>
    	$(function(){
        $("#inputTanggal").datepicker({
      	format:'yyyy/mm/dd'
        });
            });
    </script>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#F1453C">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PEMASANGAN - DETAIL PEMASANGAN</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<?php if ($nama_cust<>"") { ?>
					<div class="col-sm-12">	
						<form class="form-horizontal">
						  <fieldset>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Nama</label>
						      <div class="col-lg-9">
						        <h4>:<?php echo $nama_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Email</label>
						      <div class="col-lg-9">
						        <h4>:<?php echo $email_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Custommer ID</label>
						      <div class="col-lg-9">
						        <h4>:<?php echo $id_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Phone Number</label>
						      <div class="col-lg-9">
						        <h4>:<?php echo $notelp_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Paket</label>
						      <div class="col-lg-9">
						        <h4>:<?php echo $nama_paket; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Lokasi</label>
						      <div class="col-lg-9">
						        <h4>:<?php echo $tempat_cust.', '.$keterangan_cust.', '.$kota_cust; ?></h4>
						      </div>
						    </div>					    						    						    						    
						    <div class="form-group">
						      <label for="inputDate" class="col-lg-3 control-label">Tanggal Pemasangan</label>
						      <div class="col-lg-9">
						        <input type="text" class="form-control" id="inputTanggal" name="inputTanggal" placeholder="Date" readonly>
						        <br/>
						      </div>
						    </div>	
						  	<div class="form-group">
						      <label for="inputDate" class="col-lg-3 control-label">No Kode Box Tv</label>
						      <div class="col-lg-9">
						        <input type="text" class="form-control" id="inputKodebox" name="inputKodebox">
						        <br/>
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="inputField" class="col-lg-3 control-label">Support</label>
						      <div class="col-lg-4">
						            <select class="form-control" id="inputField" name="inputField">
							          <option disabled selected>Select Field Engineer</option>
							          <?php
							          $res = $col_user->find(array("level"=>"301"));	
										foreach ($res as $row) {  ?>  
									  <option><?php echo $row['nama']; ?></option>	 
									  <?php } ?>
							        </select>
							        <br/>
						      </div>
						      <div class="col-lg-4">
						            <select class="form-control" id="inputAssfield" name="inputAssfield">
							          <option disabled selected>Select Ass Field Engineer</option>
							          <?php
							          $res = $col_user->find(array("level"=>"302"));	
										foreach ($res as $row) {  ?>  
									  <option><?php echo $row['nama']; ?></option>	 
									  <?php } ?>
							        </select>
							        <br/>
						      </div>
						    </div>	
						    <div class="col-lg-9">	
						        <div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>
						        <br/>
						      	<button class="btn btn-success" type="submit" name="save" id="save"><b>PASANG</b></button>	
						    </div>
						  </fieldset>	
						</form>    		
					</div>	
					<?php } ?>
 				</div>
			</div>
		</div>
	</div>	
</section>
</form>