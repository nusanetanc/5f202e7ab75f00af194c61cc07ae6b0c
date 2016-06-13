<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
$id_cust = $_GET['id'];
$date = date("Y/m/d");
$date_days = date("d");
$date_years = date("Y");
$date_month = date("m");
$date_month1 = bulan($date_month);
$res = $col_user->find(array("id_user"=>$id_cust,"tanggal_aktivasi"=>"","status"=>"registrasi","level"=>"0"));
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
												$addon_cust = $row['addon'];
												$tempat_cust = $row['tempat'];
						                        $kota_cust = $row['kota'];
						                        $status_cust = $row['status'];
						                        $alamat_cust = $row['alamat'];
						                        $ket_cust = $row['keterangan'];
	                                        }
$res1 = $col_package->find(array("nama"=>$package_cust));
						foreach ($res1 as $row1) {
							$deskripsi_paket=$row1['deskripsi'];
								$isi_paket = $row['isi'];
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
$res2 = $col_user->find(array("nama"=>$support_field, "level"=>"301"));
						foreach ($res2 as $row2) {
							$email_field=$row2['email'];
						}
$res3 = $col_user->find(array("nama"=>$support_Assfield, "level"=>"302"));
						foreach ($res3 as $row3) {
							$email_Assfield=$row3['email'];
						}
$update_user = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("status"=>"progress pasang")));
$insert_activty = $col_history->insert(array("hal"=>"pasang","tanggal_kerja"=>$tanggal_pasang, "field_engineer"=>$support_field, "ass_field"=>$support_Assfield, "status"=>"progress", "id_cust"=>$id_cust, "nama_cust"=>$nama_cust, "tempat_customer"=>$tempat_cust, "alamat_customer"=>$alamat_cust, "kota_customer"=>$kota_cust ,"keterangan_customer"=>$ket_cust, "phone_customer"=>$phone_cust, "paket"=>$package_cust, "status"=>"progress", "no_box"=>$boxtv));

		// mail for field engineer
		$to = $email_field.', '.$email_Assfield;

		$subject = 'Info Pemasangan';

		$message = '
		<html>
		<body>
		  <p>pemasangan dengan rincian customer berikut : </p>
		  <br/>
		  <p>Customer : '.$id_cust.' / '.$nama_cust.' / '.$phone_cust.' / '.$email_cust.'</p>
		  <p>Paket : '.$package_cust.'</p>
		  <p>Tanggal Registrasi : '.$tgl_registrasi.' '.$bln_registrasi.' '.$thn_registrasi.'</p>
		  <p>Tempat : '.$tempat_cust.' '.$ket_cust.' '.$alamat_cust.' '.$kota_cust.'</p>
		  <p>No STB : '.$boxtv.'</p>
		  <p>Tanggal Pemasangan : '.$tgl_psng.' '.$month_psng.' '.$thn_psng.'</p>
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
				<body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
				    <div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
				        <div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
				            <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
				        </div>
				        <div style="padding:20px;color:#333;">
				            <p style="font-size:20px;font-weight:bold;line-height:1px">Terimakasih sudah menjadi pelanggan Groovy</p>
				            <p>Kami akan melakukan pemasangan dan aktivasi pada tanggal : '.$tgl_psng.' '.$month_psng.' '.$thn_psng.'.<br/><br/>
				            Jika ada pertanyaan lebih detail silahkan membuat pengaduan pada halaman member Anda. Selamat menikmati layanan Groovy</p>

				            <p style="color:#888;">Terimakasih.</p>
				        </div>
				        </div>
				    </div>
				</body>
				</html>
			';

			$headers1  = 'MIME-Version: 1.0' . "\r\n";
			$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			$headers1 .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";

			$kirim_email1=mail($to1, $subject1, $message1, $headers1);
		if($isi_paket=="internet+tv"){
			//mail to bukti pembayaran

			require('../content/srcpdf/fpdf.php');

			$header_table = array(
			array("label"=>"DESKRIPSI", "length"=>70, "align"=>"C"),
			array("label"=>"HARGA", "length"=>40, "align"=>"C"),
			array("label"=>"PRORATE", "length"=>40, "align"=>"C"),
			array("label"=>"TOTAL HARGA", "length"=>40, "align"=>"C")
			);
			$data = array();
			$res = $col_user->findOne(array("id_user"=>$id_cust));
			foreach ($res['payment_data'] as $payment => $pay) {
			  if ($pay<>null){
			    array_push($data, $pay);
			  }}
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
			$pdf->SetFont('Arial','','10');
			$pdf->SetFillColor(254,60,34);
			$pdf->SetTextColor(255);
			$pdf->SetDrawColor(254,60,34);
			foreach ($header_table as $kolom_table) {
			$pdf->Cell($kolom_table['length'], 10, $kolom_table['label'], 1, '0',
			$kolom['align'], true);
			}
			$pdf->Ln();
			#tampilkan data dari tabel
			$pdf->SetTextColor(0);
			$pdf->SetFont('');
			$pdf->SetDrawColor(254,60,34);
			foreach ($data as $baris) {
			$i = 0;
			foreach ($baris as $cell) {
			$pdf->Cell($header_table[$i]['length'], 8, $cell, 1, '0',
			$kolom['align'], false);
			$i++;
			}
			$fill = !$fill;
			$pdf->Ln();
			}
			$pdf->Ln();
			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetTextColor(0);
			$pdf->SetFont('Arial','B','10');
			$pdf->Cell(0,7, 'KONFIRMASI PEMBAYRAN - PAYMENT CONFIRMATION', '0', 1, 'L');
			$pdf->Ln();
			$pdf->SetFont('Arial','','10');
			$pdf->Cell(0,7, 'Tanggal Bayar               : '.$tgl_bayar.' '.$month_bayar.' '.$thn_bayar, '0', 1, 'L');
			$pdf->Cell(0,7, 'Kode Virtual                   : '.$no_virtual, '0', 1, 'L');
			$pdf->Cell(0,7, 'Jumlah Pembayaran      : '.rupiah($total_bayar), '0', 1, 'L');
			$pdf->Ln();
			$pdf->Ln();
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
			$email_message1 = "Terimakasih ".$nama_cust." sudah menggunakan layanan groovy.id.<br>";
			$email_message1 .= "Bukti pembayaran ini menandakan bahwa pembayaran anda sudah kami konfirmasi dan terima.<br>";
			$email_message1 .= "Untuk pelanggan baru kami akan segera memberi inforamsi untuk jadwal pemasangan.<br>";
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
}
if ($update_user && $insert_activty && $kirim_email1 && $kirim_email){ ?>
	<script type="" language="JavaScript"> alert('Info pemasangan sudah terkirim ke customer dan dens');
	document.location='<?php echo $base_url_member; ?>/customer/registrasi'</script>
<?php } } ?>
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
						        <h4>:<?php echo $phone_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Layanan</label>
						      <div class="col-lg-9">
						        <h4>:<b><?php echo $package_cust; ?></b> <?php echo $addon_cust; ?></h4>
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
