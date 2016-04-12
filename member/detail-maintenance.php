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
				      	<button class="btn btn-primary btn-sm" type="submit" name="save" id="save"><b>MAINTENANCE</b></button>	
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
				      <label for="inputDate" class="col-lg-3 control-label">Paket</label>
				      <div class="col-lg-9">
				        <select class="form-control" id="select">
				          <option disabled="true" selected="true">Selected Package</option>
				          <?php
					         $res = $col_package->find();	
							foreach ($res as $row) { if($row['nama']<>$package_cust){ ?>  
				          <option><?php echo $row['nama'].' / '.$row['deskripsi']; ?></option>
				          <?php } } ?>
				        </select>
				        <br/>
				      </div>
				    </div>	
				    <div class="col-lg-9">	
				        <div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>
				        <br/>
				      	<button class="btn btn-primary btn-sm" type="submit" name="save" id="save"><b>Update</b></button>	
				    </div>
 				</div>
			</div>
		</div>
	</div>	
</section>
</form> 