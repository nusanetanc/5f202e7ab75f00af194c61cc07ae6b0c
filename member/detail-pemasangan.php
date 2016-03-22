<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
$id_cust = $_GET['id'];
$res = $col_user->find(array("id_user"=>$id_cust,"tanggal_aktivasi"=>"","status"=>"bayar","level"=>"0"));	
						foreach ($res as $row) {
					  $email_cust = $row['email'];
                      $nama_cust = $row['nama'];
                      $notelp_cust = $row['phone'];
                      $tempat_cust = $row['tempat'];
                      $kota_cust = $row['kota'];
                      $alamat_cust = $row['alamat'];
                      $keterangan_cust = $row['keterangan'];
        $tanggal_akhir = $row['tanggal_akhir'];
		$tanggal_aktiv = $row['tanggal_aktivasi'];
		$tanggal_registrasi = $row['tanggal_registrasi'];
		$nama_paket = $row['paket'];
		$harga_paket = $row['harga'];
	    $no_invoice = $row['invoice'];
		$inovice_3last = substr($no_invoice, 4,7)+1;
	    $date_month = substr($tanggal_akhir, 5,2);
	    $date_years = substr($tanggal_akhir, 2,2);
	    $count_no = count($inovice_3last);
	$thn_regis = substr($tanggal_registrasi, 0,4);
	$bln_regis = substr($tanggal_registrasi, 5,2);
	$tgl_regis = substr($$tanggal_registrasi, 8,10);
	$month_regis = bulan($bln_regis);
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
					$tgl = substr($tanggal_pasang, 8,10);
					$kurangtgl = 30-$tgl;
					$paketperhari = $harga_paket/30;
					$prorate = $paketperhari*$kurangtgl;
					echo $tgl;
					echo $kurangtgl;
					echo $prorate;
$update_user = $col_user->update(array("id_user"=>$id_cust),array('$set'=>array("harga"=>"$prorate"."000", "tanggal_pasang"=>$tanggal_pasang, "field_engginer"=>$support_field, "ass_field"=>$support_Assfield, "status"=>"progress pasang","invoice"=>$last_noinvoice, "tanggal_akhir"=>$last_aktif, "no_box"=>$boxtv)));
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
if ($update_user && $insert_activty && $kirim_email1 && $kirim_email){ ?>
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