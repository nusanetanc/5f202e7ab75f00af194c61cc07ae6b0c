<?php
$id_cust = $_GET['id'];
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
					<div class="panel-heading" style="background-color:#F1453C">
						<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">DATA MAINTENANCE</h3>
					</div>
					<div class="panel-body">
						<br/>
						<div class="col-sm-12">
							<table class="table table-striped table-hover ">
								<thead>
									<tr>
										<th width="15%">Tanggal kerja</th>
										<th width="20%">Maintenance</th>
										<th width="20%">Support</th>
										<th width="10%">Status</th>
										<th width="15%">Tanggal Selesai</th>
										<th width="20%">Catatan</th>
									</tr>
								</thead>
								<?php
								$status=$_GET['status'];
									$res = $col_history->find(array("hal"=>"maintenance", "id_cust"=>$id_cust))->sort(array("tanggal_kerja"));
									foreach($res as $row)
									{
							?>
								<tbody>
									<tr>
										<td><?php echo $row['tanggal_kerja']; ?></td>
										<td><?php echo $row['maintenance']; ?></td>
										<td><?php echo $row['field_engineer'].'-'.$row['ass_field']; ?></td>
										<td><?php echo $row['status']; ?></td>
										<td><?php echo $row['tanggal_selesai']; ?></td>
										<td><?php echo $row['catatan']; ?></td>
									</tr>
								 </tbody>
							<?php
								}
							?>
							</table>
						</div>
					</div>
			</div>
			<div class="panel" style="border:0px;">
					<div class="panel-heading" style="background-color:#F1453C">
						<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">DATA UPDATE</h3>
					</div>
					<div class="panel-body">
						<br/>
						<div class="col-sm-12">
							<table class="table table-striped table-hover ">
								<thead>
									<tr>
										<th width="15%">Tanggal Update</th>
										<th width="20%">Paket Lama</th>
										<th width="20%">Paket Baru</th>
									</tr>
								</thead>
								<?php
								$status=$_GET['status'];
									$res = $col_history->find(array("hal"=>"update", "id_cust"=>$id_cust))->sort(array("tanggal_update"));
									foreach($res as $row)
									{
							?>
								<tbody>
									<tr>
										<td><?php echo $row['tanggal_update']; ?></td>
										<td><?php echo $row['paket_lama']; ?></td>
										<td><?php echo $row['paket_baru']; ?></td>
									</tr>
								 </tbody>
							<?php
								}
							?>
							</table>
						</div>
					</div>
			</div>
		</div>
	</div>
</section>
