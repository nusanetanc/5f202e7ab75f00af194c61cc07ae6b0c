<style>
    .datepicker{z-index:1151;}
</style>
    <script>
    	$(function(){
        $("#inputPaymentdate").datepicker({
      	format:'yyyy/mm/dd'
        });
        $("#inputPaymentdate").datepicker({
      	format:'yyyy/mm/dd'
        });
            });
    </script>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
$id_cust = $_GET['id_cust'];
$date = date("Y/m/d");
						$res = $col_user->find(array("id_user"=>$id_cust));
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
	                                            	$no_invoice = $row['invoice'];
	                                            	$noinvoice_3 = substr($no_invoice, 4,7);
													$inovice_3last = substr($no_invoice, 4,7)+1;
	                                                $date_month = substr($tanggal_akhir, 5,2);
	                                                $date_years = substr($tanggal_akhir, 2,2);
	                                                $count_no = count($inovice_3last);
	                                        }
$count_revenue = $col_revenue->find(array("date"=>$date));
foreach ($count_revenue as $row_revenue) {
                                        	$total_revenue=$row_revenue['total'];
                                        }                                        
						$res = $col_package->find(array("nama"=>$package_cust));
						    foreach($res as $row)
						    { 
						        $harga=$row['harga'];
						    }                                        
if ($date_month=="12"){
	$date_month = "01";
	$date_years1 = substr($tanggal_akhir, 0,4)+1;
} else {
	$date_month = substr($tanggal_akhir, 5,2)+1;
	$count_month = count($count_month);
	if ($count_no=="1"){
		$date_month='0'.$date_month;
	}
	$date_years1 = substr($tanggal_akhir, 0,4);
}	   
	$last_aktif = $date_years1.'/'.$date_month.'/'.'01';                                          
	                                                
						if ($count_no=="1"){
							$last_noinvoice = $date_month.$date_years.'00'.$inovice_3last;
						} else if ($count_no=="2"){
							$last_noinvoice = $date_month.$date_years.'0'.$inovice_3last;
						} else {
							$last_noinvoice = $date_month.$date_years.$inovice_3last;
						}										

if(isset($_POST['verifikasi'])){  
	$tanggal_bayar = $_POST['inputPaymentdate'];
		$thn_bayar = substr($tanggal_bayar, 0,4);
		$bln_bayar = substr($tanggal_bayar, 5,2);
		$tgl_bayar = substr($tanggal_bayar, 8,10);
		$month_bayar = bulan($bln_bayar);
if ($total_revenue=="" || empty($total_revenue)){
	$update_revenue = $col_revenue->insert(array("date"=>$date, "total"=>$harga_paket));
} else {
	$revenue=$total_revenue+$harga_paket;
	$update_revenue = $col_revenue->update(array("date"=>$date), array('$set'=>array("total"=>$revenue.'.000')));
}
	if ($status_cust=="registrasi"){
		$update_user = $col_user->update(array("id_user"=>$id_cust), array('$set'=>array("status"=>"bayar")));
				// mail for supevisior teknik
				$to = 'yudi.nurhandi@nusa.net.id';
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
				  <p>Paket : '.$package_cust.'</p>
				  <br/>
				</body>
				</html>
				';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
				$headers .= 'Cc: cs@groovy.id' . "\r\n";
				$emailpasang=mail($to, $subject, $message, $headers); 
	} else {
		$update_user = $col_user->update(array("id_user"=>$id_cust), array('$set'=>array("invoice"=>$last_noinvoice, "tanggal_akhir"=>$last_aktif, "harga"=>$harga)));
	}
		$pay = array("tanggal_bayar"=>$tanggal_bayar, "tanggal_konfirmasi"=>$date, "paket"=>$package_cust, "harga"=>$harga_paket, "invoice"=>$no_invoice);
$update_bayar = $col_user->update(array("id_user"=>$id_cust),array('$push'=>array("payment"=>$pay))); 
				//mail to bukti pembayaran
				require('fpdf.php');
				$header = array(
						array("label"=>"DESKRIPSI PEMBAYARAN", "length"=>130, "align"=>"L"),
						array("label"=>"HARGA", "length"=>55, "align"=>"L")
					);
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
				$pdf->Cell(0,7, 'Nomor Telepon           : '.$phone_cust, '0', 1, 'L');
				$pdf->Cell(0,7, 'Alamat Email           : '.$email_cust, '0', 1, 'L');
				$pdf->Ln();
				$pdf->SetFont('Arial','B','10');
				$pdf->Cell(0,7, 'DATA PEMBAYARAN', '0', 1, 'L');
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
				$pdf->Cell(0,7, 'KONFIRMASI PEMBAYRAN - PAYMENT CONFIRMATION', '0', 1, 'L');
				$pdf->Ln();
				$pdf->SetFont('Arial','','10');
				$pdf->Cell(0,7, 'Tanggal Bayar                : '.$tgl_akhir.' '.$month_akhir.' '.$thn_akhir, '0', 1, 'L');
				$pdf->Cell(0,7, 'Kode Virtual                   : '.$no_invoice, '0', 1, 'L');
				$pdf->Cell(0,7, 'Jumlah Pembayaran      : '.$harga_paket, '0', 1, 'L');
				$pdf->Ln();
				$pdf->Ln();
				$pdf->Image('../img/denstv-logo.png','10','250','50');
				$pdf->Image('../img/logo-nusanet.png','65','250','50');
				$pdf->Image('../img/a.jpg','170','240','30');

				// Filename that will be used for the file as the attachment
				$fileatt_name = $id_cust."-".$no_invoice.".pdf";
				$dir='invoice/';
				// save pdf in directory
				$pdf ->Output($dir.$fileatt_name);

				//....................

				$data = $pdf->Output("", "S");

				//..................

				$email_subject = "Bukti Pembayaran groovy"; // The Subject of the email
				$email_to = $email_cust; // Who the email is to


				$semi_rand = md5(time());
				$data = chunk_split(base64_encode($data));

				$fileatt_type = "application/pdf"; // File Type
				$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

				// set header ........................
				$headers = "From: groovy.id <no_reply@groovy.id>";
				$headers .= "\nMIME-Version: 1.0\n" .
				"Content-Type: multipart/mixed;\n" .
				" boundary=\"{$mime_boundary}\"";

				// set email message......................
				$email_message = "Terimakasih ".$nama_cust." sudah menggunakan layanan Tv groovy.id.<br>";
				$email_message .= "Bukti pembayaran ini menandakan bahwa pembayaran anda sudah kami konfirmasi dan terima.<br>";// Message that the email has in it
				$email_message .= "Untuk pelanggan baru kami akan segera memberi inforamsi untuk jadwal pemasangan.<br>";
				$email_message .= "Terimakasih sudah menggunakan layanan Tv groovy.id.<br>";
				$email_message .= "Selamat menikamati layanan TV dari groovy.id.<br>";
				$email_message .= "Untuk info lebih lanjut bisa membuat pengaduan pada halaman member anda di groovy.id.\n\n" .
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

				$emailinvoice = @mail($email_to, $email_subject, $email_message, $headers);
if ($update_user && $update_bayar && $emailinvoice){
	?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/?hal=payment'</script>	
<?php } }
?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
				<div class="panel-body" style="background-color:#3FB618;">
					<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PAYMENT - VERIFIKASI PEMBAYARAN</h3>
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
							  <label class="col-lg-3 control-label">Paket/Harga : </label>
							  <div class="col-lg-9">
								<h4><?php echo $package_cust.'/'.$harga_paket; ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Lokasi : </label>
							  <div class="col-lg-9">
								<h4><?php echo $tempat_cust.', '.$ket_cust.', '.$kota_cust; ?></h4>
							  </div>
							</div>					    						    						    						    
							<div class="form-group">
							  <label class="col-lg-3 control-label">Tanggal registrasi : </label>
							  <div class="col-lg-9">
								<h4><?php echo $tgl_registrasi.' '.$month_registrasi.' '.$thn_registrasi; ?></h4>
							  </div>
							</div>	
							<div class="form-group">
						      <label class="col-lg-3 control-label"> Tanggal Akhir Pembayaran : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $tgl_akhir.' '.$month_akhir.' '.$thn_akhir; ?></h4>
						      </div>
						    </div>								
							<div class="form-group">
							  <label class="col-lg-3 control-label">No Virtual : </label>
							  <div class="col-lg-9">
								<h4><?php echo $no_invoice; ?></h4>
							  </div>
							</div>	
							<div class="form-group">
							  <label class="col-lg-3 control-label">Status : </label>
							  <div class="col-lg-9">
								<h4><?php echo $status_cust; ?></h4>
							  </div>
							</div>
								<input type="text" class="form-control" id="inputPaymentdate" name="inputPaymentdate" placeholder="Payment Date" required>
								<br/>
								<div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>	
								<br/>
								<input type="submit" class="btn btn-success" name="verifikasi" id="verifikasi" value="Vertifikasi">
							  </div>
							</div>	
						  </fieldset>	
						</form>    		
					</div>	
				</div>
			</div>
		</div>
	</div>	
</section>
</form>