<?php
$id_cust = $_GET['id_cust'];
$res = $col_user->find(array("id_user"=>$id_cust, "level"=>"0"));
foreach($res as $row)
					{
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
						$alamat_cust = $row['alamat'];
															}
?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
				<div class="panel-body" style="background-color:#1B5E12;">
					<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">CUSTOMER</h3>
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
								<label class="col-lg-3 control-label">Lokasi : </label>
								<div class="col-lg-9">
								<h4><?php echo $tempat_cust.', '.$kota_cust; ?></h4>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Tanggal Registrasi : </label>
								<div class="col-lg-9">
								<h4><?php echo $tgl_registrasi.' '.$month_registrasi.' '.$thn_registrasi; ?></h4>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Paket Aktif/Harga : </label>
								<div class="col-lg-9">
								<h4><?php echo $package_cust.'/'.rupiah($harga_paket); ?></h4>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Tambahan Layanan/Harga : </label>
								<?php
								$res = $col_addon->find(array("id_user"=>$id_cust));
								foreach($res as $row)
													{ ?>
								<div class="col-lg-9">
								<h4><?php echo $row['layanan'].'/'.rupiah($row['harga']); ?></h4>
								</div>
								<?php } ?>
							</div>
						</div>
							</fieldset>
						</form>
					</div>
				</div>
				<div class="panel" style="border:0px;" >
					<div class="panel-body" style="background-color:#1B5E12;">
						<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">KIRIM INVOICE</h3>
					</div>
					<div class="panel-body">
						<br/>
						<div class="col-sm-12">
							<form class="form-horizontal">
								<fieldset>
									<div class="checkbox">
											<label>
												<input type="checkbox"> STB (45.000/Bulan) <br/>
												<input type="checkbox"> Router (40.000/Bulan) <br/>
												<input type="checkbox"> Tambahan Kabel (10.000/Meter) <br/>
												<input type="number" class="form-control" id="pjkbl" name="pjkbl" placeholder="Panjang Kabel (Meter)"><br/>
												<input type="checkbox"> Instalasi (500.000)
											</label>
										</div>
								</fieldset>
							</div>
							</form>
						</div>
					</div>
		</div>
	</div>
</section>
