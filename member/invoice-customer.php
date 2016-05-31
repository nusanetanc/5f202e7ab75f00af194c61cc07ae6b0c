<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
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
						$ket_tempat=$row['keterangan'];
															}
$res = $col_package->find(array("nama"=>$package_cust));
foreach($res as $row)
				{
					$ket_paket = $row['isi'];
					$harga_paket = $row['harga'];
				}
if(isset($_POST['send'])){
	$stb=$_POST['stb'];
	$router=$_POST['router'];
	$instal=$_POST['instalasi'];
	$pjkbl=$_POST['pjkbl'];
	$kabel=$_POST['kabel'];
	//$update_user=$col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("no_virtual"=>$kode_perusahaan.$id_cust, "router"=>$router, "stb"=>$stb, "kabel"=>$kabel, "panjang_kabel"=>$pjkbl, "instalasi"=>$instal)));
$ppn_paket=$harga_paket*0.1;
$total_harga_paket=$harga_paket+$ppn_paket;
// mail for customer to addon
	$to = $email_cust;

	$subject = 'Invoice Pembayaran';

	$message = '
	<html>
		<body style="background-color:#ddd;padding:50px 0 150px 0;font-family:arial;font-size:15px;">
				<div style="margin:0 auto;max-width:1000px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
						<div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
								<a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
						</div>
						<div style="padding:10px;color:#333;">
								<p style="font-size:20px;font-weight:bold;line-height:1px">DATA CUSTOMER</p>
								<p>ID Customer : '.$id_cust.'<br/>
								Nama : '.$nama_cust.'<br/>
								Email : '.$email_cust.'<br/>
								Phone : '.$phone_cust.'<br/>
								Tempat : '.$tempat_cust.' '.$ket_tempat.' '.$alamat_cust.' '.$kota_cust.'<br/>
								<br/>
								<p style="font-size:20px;font-weight:bold;line-height:1px">DATA PEMBAYARAN</p>
								<style>
								table, th, td {
								    border: 1px solid black;
								    border-collapse: collapse;
								}
								th, td {
								    padding: 5px;
								}
								</style>
								</head>
								<body>

								<table style="width:100%">
								  <tr>
								    <th width="40%">Deskripsi</th>
								    <th width="20%">Harga</th>
								    <th width="20%">Proraide</th>
										<th width="20%">Total Harga</th>
								  </tr>
								  <tr>
								    <td>Jill</td>
								    <td>Smith</td>
								    <td>50</td>
										<td>50</td>
								  </tr>
								</table>
								<br/>
						</div>
						</div>
				</div>
		</body>
		</html>
	';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
	$headers .= 'Cc: cs@groovy.id, billing@groovy.id' . "\r\n";

	$sent=mail($to, $subject, $message, $headers);

	if($sent && $update_user){ ?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/send-invoice'</script>
<?php	} }
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
								<div class="col-lg-3">
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
								<fieldset>
									<div class="checkbox">
											<label>
													<?php if($ket_paket=="internet+tv"){ ?>
												<input type="checkbox" name="stb" id="stb" checked="true" value="1"> STB (45.000/Bulan) <br/>
													<?php } else if($ket_paket=="internet"){ ?>
												<input type="checkbox" name="stb" id="stb" value="1"> STB (45.000/Bulan) <br/>
													<?php } ?>
												<input type="checkbox" name="router" id="router" checked="true" value="1"> Router (40.000/Bulan) <br/>
												<input type="checkbox" name="kabel" id="kabel" value="1"> Tambahan Kabel (10.000/Meter) <br/>
												<input type="number" class="form-control" id="pjkbl" name="pjkbl" placeholder="Panjang Kabel (Meter)"><br/>
												<input type="checkbox" name="instal" id="instal" value="1"> Instalasi (500.000)<br/>
											</label>
										</div>
										<input type="submit" class="btn btn-success btn-sm" name="send" id="send" value="KIRIM">
								</fieldset>
							</div>
						</div>
					</div>
		</div>
	</div>
</section>
</form>
