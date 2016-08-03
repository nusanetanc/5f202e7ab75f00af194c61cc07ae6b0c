<?php
$id_cust = $_GET['id'];
$res = $col_user->find(array("id_user"=>$id_cust, "level"=>"0"));
						foreach ($res as $row) {
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
												$regis_cust = $row['registrasi'];
												$sales_cust =$row['nama_sales'];
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
						} ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#F1453C">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">CUSTOMER</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
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
									<label class="col-lg-3 control-label">Status</label>
									<div class="col-lg-9">
										<h4>:<?php echo $status_cust; if ($status_cust=="aktif"){ echo $tgl_akhir.' '.$month_akhir.' '.$thn_akhir; }?></h4>
									</div>
								</div>
								<div class="form-group">
						      <label class="col-lg-3 control-label">Registrasi : </label>
						      <div class="col-lg-9"><h4>
							  <?php
							  	if ($regis_cust=="personal") {
							  		echo $regis_cust;
							  	} elseif ($regis_cust=="sales") {
							  		echo $regis_cust.' / '.$sales_cust;
							  	}
							  ?></h4></label>
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
 				</div>
			</div>
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF5722">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">HISTORI</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body scroll-570">
									<table class="table table-striped table-hover">
											<?php
												$res = $col_user->findOne(array("id_user"=>$id_cust));
											foreach ($res['histori'] as $histori => $log) {
												$thn_log = substr($log['tanggal'], 0,4);
												$bln_log = substr($log['tanggal'], 5,2);
												$tgl_log = substr($log['tanggal'], 8,10);
												$month_log = bulan($bln_log);
											 ?>
											<tbody class="pic-container down">
												<td><?php echo $tgl_log.' '.$month_log.' '.$thn_log; ?></td>
												<td><?php echo $log['hal']; ?></td>
												<td><?php echo $log['keterangan']; ?></td>
											</tbody> <?php } ?>
										</tbody>
									</table>
		  				 </div>
		  	</div>
		</div>
	</div>
</section>
