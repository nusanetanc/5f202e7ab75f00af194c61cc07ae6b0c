<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
$id_cust = $_GET['id'];
$date = date("Y/m/d");
$date_days = date("d");
$date_years = date("Y");
$date_month = date("m");
$date_month1 = bulan($date_month);
$res = $col_user->find(array("id_user"=>$id_cust,"status"=>"unaktif","level"=>"0"));	
						foreach ($res as $row) {
												$tanggal_akhir = $row['tanggal_akhir'];
												$thn_akhir = substr($tanggal_akhir, 0,4);
												$bln_akhir = substr($tanggal_akhir, 5,2);
												$tgl_akhir = substr($tanggal_akhir, 8,10);
												$month_akhir = bulan($bln_akhir);

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
						                        $no_box = $row['no_box'];
	                                        }                                   	                                                	
if(isset($_POST['save'])){
$tanggal_bongkar = $_POST['inputTanggal'];
$support_field = $_POST['inputField'];
$support_Assfield = $_POST['inputAssfield'];
$res2 = $col_user->find(array("nama"=>$support_field, "level"=>"301"));	
						foreach ($res2 as $row2) {
							$email_field=$row2['email'];
						} 	
$res3 = $col_user->find(array("nama"=>$support_Assfield, "level"=>"302"));	
						foreach ($res3 as $row3) {
							$email_Assfield=$row3['email'];
						} 
	$histori=array("hal"=>"bongkar", "tanggal_bongkar"=>$tanggal_bongkar, "field_engineer"=>$support_field, "ass_filed"=>$support_Assfield);
	$update_user = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$push'=>array("histori"=>$histori)));
	$insert_activty = $col_history->insert(array("hal"=>"bongkar","tanggal_kerja"=>$tanggal_bongkar, "field_engineer"=>$support_field, "ass_field"=>$support_Assfield, "status"=>"progress", "id_cust"=>$id_cust, "nama_cust"=>$nama_cust, "tempat_customer"=>$tempat_cust, "alamat_customer"=>$alamat_cust, "kota_customer"=>$kota_cust ,"keterangan_customer"=>$ket_cust, "phone_customer"=>$phone_cust, "paket"=>$package_cust, "status"=>"progress", "no_box"=>$no_box));
	// mail for field engineer
	$to = $email_field.', '.$email_Assfield;

	$subject = 'Info Bongkar Perangkat';

	$message = '
	<html>
	<body>
	  <p>Ambil perangkat dengan rincian customer berikut : </p>
	  <br/>
	  <p>Customer : '.$id_cust.' / '.$nama_cust.' / '.$phone_cust.' / '.$email_cust.'</p>
	  <p>Paket : '.$package_cust.'</p>
	  <p>Tempat : '.$tempat_cust.' '.$ket_cust.' '.$alamat_cust.' '.$kota_cust.'</p>
	  <p>No STB : '.$no_box.'</p>
	  <p>Tanggal Kerja : '.$tgl_psng.' '.$month_psng.' '.$thn_psng.'</p>
	  <p>Support : '.$support_field.' dan '.$support_Assfield.'</p>
	  <br/>
	  <p>Mohon untuk melakukan report pada halaman member di groovy.id setelah selesai kerja</p>
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

		$subject1 = 'Info Pengambilan perangkat';

		$message1 = '
		<html>
		<body>
		  <p>Terima kasih sudah menjadi customer groovy,<br/>
		  kami akan melakukan pengambilan perangkat pada tanggal : '.$tgl_akhir.' '.$month_akhir.' '.$thn_akhir.'.
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
}
if ($update_user && $insert_activty && $kirim_email1 && $kirim_email && $sent_aktivasi){ ?>
	<script type="" language="JavaScript">
	document.location='<?php echo $base_url_member; ?>/setup-progress'</script>
<?php } ?>
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
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">BONGKAR - AMBIL PERANGKAT</h3>
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
						      <label class="col-lg-3 control-label">Paket</label>
						      <div class="col-lg-9">
						        <h4>:<?php echo $package_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Lokasi</label>
						      <div class="col-lg-9">
						        <h4>:<?php echo $tempat_cust.', '.$ket_cust.', '.$kota_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">No STB</label>
						      <div class="col-lg-9">
						        <h4>:<?php echo $no_box; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Tanggal Akhir Aktif</label>
						      <div class="col-lg-9">
						        <h4>:<?php echo $tgl_akhir.' '.$month_akhir.' '.$thn_akhir; ?></h4>
						      </div>
						    </div>
							<div class="form-group">
						      <label for="inputDate" class="col-lg-3 control-label">Tanggal Pengambilan</label>
						      <div class="col-lg-9">
						        <input type="text" class="form-control" id="inputTanggal" name="inputTanggal" placeholder="Date" readonly>
						        <br/>
						      </div>
						    </div>	<br/>						    
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
						      	<button class="btn btn-success" type="submit" name="save" id="save"><b>AMBIL PERANGKAT</b></button>	
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