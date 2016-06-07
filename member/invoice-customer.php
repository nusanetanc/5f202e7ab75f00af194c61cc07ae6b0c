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
	$instal=$_POST['instal'];
	$pjkbl=$_POST['pjkbl'];
	$kabel=$_POST['kabel'];
			$update_user=$col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("no_virtual"=>$kode_perusahaan.$id_cust, "router"=>$router, "stb"=>$stb, "kabel"=>$kabel, "panjang_kabel"=>$pjkbl, "instalasi"=>$instal)));
// mail for customer to addon
	$to = $email_cust;

	$subject = 'Invoice Pembayaran';

	$message = '
	<html>
		<body style="background-color:#ddd;padding:20px 0 150px 0;font-family:arial;font-size:15px;">
				<div style="margin:0 auto;max-width:1000px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
						<div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
								<a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
						</div>
						<div style="padding:10px;color:#333;">
								<p>Terimakasih telah menjadi pelanggan groovy.id<br/>
									No Virtual Pembayaran : '.$kode_perusahaan.$id_cust.'<br/><br/>
								<p style="font-size:20px;font-weight:bold;line-height:1px">DATA CUSTOMER</p>
								<p>ID Customer : '.$id_cust.'<br/>
								Nama : '.$nama_cust.'<br/>
								Email : '.$email_cust.'<br/>
								Phone : '.$phone_cust.'<br/>
								Tempat : '.$tempat_cust.' '.$ket_tempat.' '.$alamat_cust.' '.$kota_cust.'<br/>
								<br/>
	';
	$m_paket = '<p style="font-size:20px;font-weight:bold;line-height:1px">DATA PEMBAYARAN</p>
								<table style="width:100%;">
								  <tr>
								    <th width="50%" style="border:1px; text-align: left;">Deskripsi</th>
								    <th width="30%" style="border:1px; text-align: left;">Harga</th>
								    <th width="10%" style="border:1px; text-align: left;">Proraide</th>
										<th width="10%" style="border:1px; text-align: left;">Total Harga</th>
								  </tr>
								  <tr>
								    <td style="border:1px;">'.$package_cust.' - 1 Bulan</td>
								    <td style="border:1px;">'.rupiah($harga_paket).'</td>
								    <td style="border:1px;">'.rupiah($proraide).'</td>
										<td style="border:1px;">'.rupiah($harga_paket-$proraide).'</td>
								 </tr>';
								 $total=$harga_paket-$proraide;
	if($router=="1"){
		$m_router =	'<tr>
								    <td style="border:1px;">Router - 1 Bulan</td>
								    <td style="border:1px;">'.rupiah($biaya_router).'</td>
								    <td style="border:1px;">'.rupiah($proraide_router).'</td>
										<td style="border:1px;">'.rupiah($biaya_router-$proraide_router).'</td>
								  </tr>';
									$total_router=$biaya_router-$proraide_router;
									$total=$total+$total_router;
								}
	if($stb=="1"){
		$m_stb =	'<tr>
								    <td style="border:1px;">STB TV - 1 Bulan</td>
								    <td style="border:1px;">'.rupiah($biaya_stb).'</td>
								    <td style="border:1px;">'.rupiah($proraide_stb).'</td>
										<td style="border:1px;">'.rupiah($biaya_stb-$proraide_stb).'</td>
										</tr>';
										$total_stb=$biaya_stb-$proraide_stb;
										$total=$total+$total_stb;

		}
	if($instal=="1"){
		$m_instalasi =	'<tr>
								    <td style="border:1px;">Instalasi</td>
								    <td style="border:1px;"></td>
								    <td style="border:1px;">-</td>
										<td style="border:1px;">'.rupiah($biaya_instalasi).'</td>
								  </tr>';
									$total=$total+$biaya_instalasi;
}
if($kabel=="1"){
	$m_kabel =	'<tr>
									<td style="border:1px;">Kabel - '.$pjkbl.' Meter</td>
									<td style="border:1px;">'.rupiah($biaya_cable).'</td>
									<td style="border:1px;"></td>
									<td style="border:1px;">'.rupiah($biaya_cable*$pjkbl).'</td>
								</tr>';
								$total_cable=$biaya_cable*$pjkbl;
								$total=$total+$total_cable;
}
$ppn=$total*0.1;
$total_bayar=$total+$ppn;
$m_total=		 		'<br/>
									<tr>
										<td style="border:1px;"></td>
										<td style="border:1px;"></td>
										<td style="border:1px;"><b>Total Harga</b></td>
										<td style="border:1px;">'.rupiah($total).'</td>
									</tr>
									<tr>
										<td style="border:1px;"></td>
										<td style="border:1px;"></td>
										<td style="border:1px;"><b>PPN 10%</b></td>
										<td style="border:1px;">'.rupiah($ppn).'</td>
									</tr>
									<tr>
									<td style="border:1px;"></td>
									<td style="border:1px;"></td>
									<td style="border:1px;"><b>Total Tagihan</b></td>
									<td style="border:1px;">'.rupiah($total_bayar).'</td>
									</tr>
								</table>
								<br/><br/><br/>
								<p style="font-size:20px;font-weight:bold;line-height:1px">TATA CARA MELAKUKAN PEMBAYARAN</p>
								<p style="font-size:15px;font-weight:bold;line-height:1px">PEMBAYARAN MELALUI TRANSFER ATM BANK BCA</p>
								<p>1. Masukkan Kartu ATM dan PIN ATM Anda.<br/>
									2. Kemudian Tampil Menu Utama, pilih “TRANSAKSI LAINNYA”.<br/>  
									3. Pilih “TRANSFER”.<br/>  
									4. Pilih “KE REK BCA”.<br/>  
									5. Masukkan jumlah nominal sesuai total tagihan. Pilih “YA”.<br/>
									6. Masukkan nomor rekening Virtual Account pembayaran. Pilih “BENAR”.<br/>
									7. Periksa kembali data yang tampil. Pilih “BENAR”.<br/>
									8. Transkasi selesai. Pilih “TIDAK”.<br/><br/>
									<p style="font-size:15px;font-weight:bold;line-height:1px">PEMBAYARAN MELALUI TRANSFER ATM NON BANK BCA</p>
									<p>1. Masukkan Kartu ATM dan PIN ATM Anda.<br/>
										2. Kemudian Tampil Menu Utama, pilih “TRANSAKSI LAINNYA”.<br/>  
										3. Pilih “TRANSFER”.<br/>  
										4. Pilih “ANTAR BANK ONLINE”.<br/>  
										5. Masukkan nomor rekening Virtual Account pembayaran dengan diawali Kode Bank pada tiga digit pertama. Adapun kode Bank BCA adalah “014”. Setelah itu pilih “BENAR”.<br/>
										6. Pada tahapan ini nomor referensi dikosongkan. Pilih “BENAR”.<br/>
										7. Masukkan jumlah nominal sesuai total tagihan. Pilih “BENAR”.<br/>
										8. Periksa kembali data yang tampil. Pilih “BENAR”.<br/><br/>
									<p style="font-size:15px;font-weight:bold;line-height:1px">PEMBAYARAN MELALUI TRANSFER ATM NON BANK BCA</p>
									<p>1. Isikan kolom Tanggal  Bulan serta Tahun pada saat mengisi formulir Slip setoran. <br/>
										2. Pada kolom No.Rekening/Customer isikan dengan Nomor Virtual Account pembayaran. <br/>
										3. Pada kolom Nama Pemilik Rekening isikan  PT. Media Andalan Nusa. <br/>
										4. Pada kolom Berita/ Keterangan isikan keterangan pembayaran groovy.  <br/>
										5. Pada kolom Nama  Penyetor isikan nama lengkap penyetor. <br/>
										6. Pada kolom Alamat Penyetor & Telepon isikan alamat & nomor telepon penyetor. <br/>
										7. Pada pilihan Informasi  Penyetor, beri centang kotak Nasabah lalu tuliskan nomor rekening yang akan di debet  untuk pembayaran. Jika Anda bukan nasabah bank BCA, beri centang kotak Non Nasabah lalu tuliskan nomor tanda penyenal (KTP/SIM/KITAS/PASPOR). <br/>
										8. Pada kolom Mata Ua ng beri centang kotak Rupiah. <br/>
										9. Pada kolom Tunai/No.Warkat tulis Tunai jika sumber dana berupa uang tunai. Apabila sumber dana berupa cek / BG BCA yang telah jatuh tempo maka isikan nomor warkat. <br/>
										10. Pada kolom Jumlah Rupiah  isikan jumlah uang yang akan di setor. <br/>
										11. Pada kolom Total isikan  jumlah total yang akan di setor. <br/>
										12. Pada kolom Terbilang  tuliskan dalam huruf jumlah total yang akan di bayarkan, contoh : “Satu Juta Sembilan Ratus Ribu Rupiah”. <br/>
										13. Beri tanda tangan dan nama  jelas penyetor di bagian penyetor. <br/><br/>
										<p style="font-size:15px;font-weight:bold;line-height:1px">PEMBAYARAN MELALUI TRANSFER ATM NON BANK BCA</p>
										<p>1. Isikan kolom Tanggal Bulan serta Tahun pada saat mengisi formulir Slip setoran.<br/>
											 2.	Pada pilihan Jenis transaksi, beri centang Transfer.<br/>
											 3.	Pada Pilihan Penerima, beri centang kotak Penduduk.  <br/>
											 4. Pada kolom Nama  isikan nama pelanggan.<br/>
											 5. Pada Kolom Nomor  Rekening isikan No. VA dengan didahului ko de bank BCA pada tiga digit pertama, adapun  kode bank BCA adalah “014”.<br/>
												6.	Pada kolom Bank isikan dengan “BCA”.<br/>
												7.	Pada kolom Alamat  & Nomor Telpon isikan alamat & nomor telepon  penerima.<br/>
												8.	Pada kolom Berita Untuk Penerima isikan keterangan pembayaran groovy dan Nomor Virtual Account pembayaran.<br/>
												10. Pada Pilihan Pengirim Beri centang kotak Penduduk.<br/>
												11.	Pada kolom Nama isikan nama penyetor.<br/>
												12.	Pada kolom Alamat  & Nomor Telpon isikan alamat & nomor telepon penyetor.<br/>
												13.	Pada  pilihan sumber dana Transaksi, beri centang kotak Tunai jika anda  membayar tunai, sedangkan  jika anda membayar dengan debet rekening maka beri centang kotak debet rekening lalu  tuliskan nomor rekening yang akan di debet untuk pembayaran.<br/>
												14.	Pada  kolom Nominal  isikan nilai nominal sesuai dengan total tagihan.<br/>
												15.	Pada kolom Jumlah Setoran Isikan jumlah sesuai dengan total tagihan.<br/>
												16.	Pada kolom Terbilang Tuliskan dalam huruf jumlah  yang akan di bayarkan, contoh : “Satu Juta Sembilan Ratus Ribu Rupiah”.<br/>
												17.	Pada pilihan Biaya transaksi beri centang kotak Tunai jika anda ingin membayar tunai biaya transaksi,  sedangkan jika anda membayar dengan debet rekening maka beri centang kotak Debet rekening lalu tuliskan nomor rekening yang akan di debet untuk biaya transaksi.<br/>
												18.	Pada kolom Tujuan Transaksi isikan Berita Pembayaran,	contoh : “Pembayaran  groovy disertai dengan id pelanggan dan nama pelanggan”.<br/>
												19.	Beri tanda tangan dan nama jelas penyetor di bagian pemohon.<br/><br/><br/>
						</div>
				</div>
		</body>
		</html>
	';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'From: billing@groovy.id' . "\r\n";

	$sent=mail($to, $subject, $message.$m_paket.$m_router.$m_stb.$m_instalasi.$m_kabel.$m_total, $headers);

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
								<label class="col-lg-3 control-label">Paket/Harga : </label>
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
									<li class="list-group-item">
									  	Upgrade Paket :
									  	<select class="form-control" id="upgrade_paket" name="upgrade_paket">
									  	<option selected="true"><?php echo $package_cust; ?></option>
									  	<?php
								$res = $col_package->find();
								foreach($res as $row)
			                      {  if($row['nama']<>$package_cust) {
			                      	?>
								          <option><?php echo $row['nama']; ?></option>
								        <?php } } ?>
								        </select>
									</li>
										<ul style="text-align:left;" class="list-group"  name="updateaddon2" id="updateaddon2" disabled>
											<h5>Add On Service</h5>
												<?php
														$res = $col_service->find();
														foreach($res as $row)
																				{
																if($row['nama_group']=="Cinema Box HD" || $row['nama_group']=="TV Chanel" || $row['nama_group']=="Video on Demand"){
																					?>
											<li class="list-group-item">
												<h6><?php echo $row['nama_group']; ?></h6>
													<?php $res1 = $col_service->find(array("group"=>$row['nama_group']));
													foreach($res1 as $row1)
																			{ ?>
														<input type="checkbox" name="addon[]" id="addon[]" value="<?php echo $row1['nama']; ?>"><?php echo ' '.$row1['nama']; ?><br>
														<?php } ?>
												<?php } } ?>
											</li>
										</ul>
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
