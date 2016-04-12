<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
$id_cust = $_GET['id'];
$date = date("Y/m/d");
$date_days = date("d");
$date_years = date("Y");
$date_month = date("m");
$date_month1 = bulan($date_month);
$res = $col_user->find(array("id_user"=>$id_cust,"status"=>"aktif","level"=>"0"));	
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
						                        $no_box = $row['no_box'];
	                                        }
$res1 = $col_package->find(array("nama"=>$package_cust));	
						foreach ($res1 as $row1) {
							$deskripsi_paket=$row1['deskripsi'];
						}  
if (isset($_POST['btnmaintenance'])){
	$inputTanggal=$_POST['inputTanggal'];
	$inputMaintenance=$_POST['inputMaintenance'];
	$inputField=$_POST['inputField'];
	$inputAssfield=$_POST['inputAssfield'];
		$thn_maintenance = substr($inputTanggal, 0,4);
		$bln_maintenance = substr($inputTanggal, 5,2);
		$tgl_maintenance = substr($inputTanggal, 8,10);
		$month_maintenance = bulan($bln_maintenance);
$res2 = $col_user->find(array("nama"=>$inputField, "level"=>"301"));	
						foreach ($res2 as $row2) {
							$email_field=$row2['email'];
						} 	
$res3 = $col_user->find(array("nama"=>$inputAssfield, "level"=>"302"));	
						foreach ($res3 as $row3) {
							$email_Assfield=$row3['email'];
						} 
	$histori=array("hal"=>"maintenance", "tanggal_maintenance"=>$inputTanggal, "maintenance"=>$inputMaintenance, "field_engineer"=>$inputField, "ass_filed"=>$inputAssfield);
	$update_user = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$push'=>array("histori"=>$histori)));
	$insert_activty = $col_history->insert(array("hal"=>"maintenance","tanggal_kerja"=>$inputTanggal, "field_engineer"=>$inputField, "ass_field"=>$inputAssfield, "status"=>"progress", "id_cust"=>$id_cust, "nama_cust"=>$nama_cust, "tempat_customer"=>$tempat_cust, "alamat_customer"=>$alamat_cust, "kota_customer"=>$kota_cust ,"keterangan_customer"=>$ket_cust, "phone_customer"=>$phone_cust, "paket"=>$package_cust, "no_box"=>$no_box));
	// mail for billing
	$$to = $email_field.', '.$email_Assfield;
	$subject = 'Jobs Maintenance';

	$message = '
	<html>
	<body>
	  <p>Maintenance Customer : </p>
	  <br/>
	  <p>Customer : '.$id_cust.' / '.$nama_cust.' / '.$phone_cust.' / '.$email_cust.'</p>
	  <p>Paket : '.$package_cust.'</p>
	  <p>Tempat : '.$tempat_cust.' '.$ket_cust.' '.$alamat_cust.' '.$kota_cust.'</p>
	  <p>No STB : '.$no_box.'</p>
	  <p>Support : '.$inputField.'-'.$inputAssfield.'</p>
	  <p>Maintenance : '.$inputMaintenance.'</p>
	  <p>Tanggal Maintenance : '.$tgl_maintenance.'-'.$month_maintenance.'-'.$thn_maintenance.'</p>
	  <br/>
	</body>
	</html>
	';

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'From: support@groovy.id' . "\r\n";
	$headers .= 'Cc: cs@groovy.id' . "\r\n";

	$kirim_email=mail($to, $subject, $message, $headers);

	// mail for customer to maintenance
		$to1 = $email_cust;

		$subject1 = 'Info Maintenance';

		$message1 = '
		<html>
			<body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
			    <div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
			        <div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
			            <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
			        </div>
			        <div style="padding:20px;color:#333;">
			            <p style="font-size:20px;font-weight:bold;line-height:1px">Terimakasih sudah menjadi customer Groovy</p>
			            <p>Kami akan melakukan perbaikan langsung pada tanggal : '.$tgl_maintenance.' '.$month_maintenance.' '.$thn_maintenance.'.</p>
			            <p>Untuk Maintenance : '.$inputMaintenance.'.</p>
			            
			            <p style="color:#888;">Terimakasih</p>
			        </div>
			        </div>
			    </div>        
			</body>
			</html>
		
		';

		$headers1  = 'MIME-Version: 1.0' . "\r\n";
		$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$headers1 .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
		$headers1 .= 'Cc: cs@groovy.id' . "\r\n";

		$kirim_email1=mail($to1, $subject1, $message1, $headers1);

if ($update_user && $update_user1 && $insert_activty && $kirim_email && $kirim_email1){ ?>
	<script type="" language="JavaScript">
	document.location='<?php echo $base_url_member; ?>/detail-maintenance/<?php echo $id_cust; ?>'</script>
<?php } } ?>

<?php if (isset($_POST['btnupdate'])){
	$input_paket=$_POST['paket_update'];
	$histori=array("hal"=>"update", "tanggal_update"=>$date, "paket_lama"=>$package_cust, "paket_baru"=>$input_paket);
	$update_user = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$push'=>array("histori"=>$histori)));
	$insert_activty = $col_history->insert(array("hal"=>"update","tanggal_update"=>$date, "status"=>"done", "paket_lama"=>$package_cust, "paket_baru"=>$input_paket, "id_cust"=>$id_cust, "nama_cust"=>$nama_cust, "tempat_customer"=>$tempat_cust, "alamat_customer"=>$alamat_cust, "kota_customer"=>$kota_cust ,"keterangan_customer"=>$ket_cust, "phone_customer"=>$phone_cust,"no_box"=>$no_box));
	$update_user1 = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("paket"=>$input_paket, "move_paket"=>"", "move_harga"=>"", "move_request"=>"")));
	// mail for billing
	$to = "yudi.nurhandi@nusa.net.id";
	$subject = 'Update Paket';

	$message = '
	<html>
	<body>
	  <p>Paket Telah Di Update : </p>
	  <br/>
	  <p>Customer : '.$id_cust.' / '.$nama_cust.' / '.$phone_cust.' / '.$email_cust.'</p>
	  <p>Paket Lama : '.$package_cust.'</p>
	  <p>Paket Baru : '.$input_paket.'</p>
	  <p>Tempat : '.$tempat_cust.' '.$ket_cust.' '.$alamat_cust.' '.$kota_cust.'</p>
	  <p>No STB : '.$no_box.'</p>
	  <p>Tanggal Update : '.$date_days.'-'.$date_month.'-'.$date_years.'</p>
	  <br/>
	</body>
	</html>
	';

	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'From: support@groovy.id' . "\r\n";
	$headers .= 'Cc: cs@groovy.id' . "\r\n";

	$kirim_email=mail($to, $subject, $message, $headers);
if ($update_user && $update_user1 && $insert_activty && $kirim_email){ ?>
	<script type="" language="JavaScript">
	document.location='<?php echo $base_url_member; ?>/detail-maintenance/<?php echo $id_cust; ?>'</script>
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
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">CUSTOMER</h3>
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
						        <h4>:<?php echo $package_cust.' - '.$deskripsi_paket; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Lokasi</label>
						      <div class="col-lg-9">
						        <h4>:<?php echo $tempat_cust.', '.$ket_cust.', '.$kota_cust; ?></h4>
						      </div>
						    </div>	
						    <div class="form-group">
						      <label class="col-lg-3 control-label">No SN Box Tv</label>
						      <div class="col-lg-9">
						        <h4>:<?php echo $no_box; ?></h4>
						      </div>
						    </div>				    						    						    						    
						  </fieldset>	
						</form>    		
					</div>	
					<?php } ?>
 				</div>
			</div>
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#F1453C">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">MAINTENANCE</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
					<div class="form-group">
				      <label for="inputDate" class="col-lg-3 control-label">Tanggal Maintenance</label>
				      <div class="col-lg-9">
				        <input type="text" class="form-control" id="inputTanggal" name="inputTanggal" placeholder="Date" readonly>
				        <br/>
				      </div>
				    </div>	
				  	<div class="form-group">
				      <label for="inputDate" class="col-lg-3 control-label">Maintenance</label>
				      <div class="col-lg-9">
				        <input type="text" class="form-control" id="inputMaintenance" name="inputMaintenance">
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
				      	<button class="btn btn-primary btn-sm" type="submit" name="btnmaintenance" id="btnmaintenance"><b>MAINTENANCE</b></button>	
				    </div>
 				</div>
			</div>
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#F1453C">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">UPDATE</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
					<div class="form-group">
				      <label for="paket_update" class="col-lg-3 control-label">Paket</label>
				      <div class="col-lg-9">
				        <select class="form-control" id="paket_update" name="paket_update">
				          <option disabled="true" selected="true" value="">Selected Package</option>
				          <?php
					         $res = $col_package->find();	
							foreach ($res as $row) { if($row['nama']<>$package_cust){ ?>  
				          <option value="<?php echo $row['nama']; ?>"><?php echo $row['nama'].' - '.$row['deskripsi']; ?></option>
				          <?php } } ?>
				        </select>
				        <br/>
				      </div>
				    </div>	
				    <div class="col-lg-9">	
				        <div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>
				        <br/>
				      	<button class="btn btn-primary btn-sm" type="submit" name="btnupdate" id="btnupdate"><b>UPDATE</b></button>	
				    </div>
 				</div>
			</div>
		</div>
	</div>	
</section>
</form> 