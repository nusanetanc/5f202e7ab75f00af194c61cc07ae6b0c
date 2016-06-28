<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
$id_cust = $_GET['id_cust'];
$res = $col_user->find(array("id_user"=>$id_cust, "level"=>"0"));
foreach($res as $row)
					{
						$tanggal_akhir = $row['tanggal_akhir'];
						$thn_akhir = substr($tanggal_akhir, 0,4);
						$bln_akhir = substr($tanggal_akhir, 5,2);
						$tgl_akhir = substr($tanggal_akhir, 8,10);
						$month_akhir = bulan($bln_akhir);

						$nama_cust = $row['nama'];
						$email_cust = $row['email'];
						$phone_cust = $row['phone'];
						$tempat_cust = $row['tempat'];
						$kota_cust = $row['kota'];
						$status_cust = $row['status'];
						$alamat_cust = $row['alamat'];
						$ket_tempat=$row['keterangan'];
															}
if(isset($_POST['send'])){
						//generate password and code activation
						$text = 'QWERTYUIOPASDFGHJKLZXCVBNM123457890';
						$panjang = 6;
						$txtlen = strlen($text)-1;
						$result = '';
						for($i=1; $i<=$panjang; $i++){
													$result .= $text[rand(0, $txtlen)];
													}
	$stb=$_POST['stb'];
	$router=$_POST['router'];
	$instal=$_POST['instal'];
	$pjkbl=$_POST['pjkbl'];
	$kabel=$_POST['kabel'];
	$package_cust=$_POST['paket'];
	$proraide_paket=$_POST['proraide_paket'];
	$res = $col_package->find(array("nama"=>$package_cust));
	foreach($res as $row)
					{
						$harga_paket = $row['harga'];
					}
	$payment_paket = array (
	"layanan"=>$package_cust,
	"harga"=>$harga_paket,
	"prorate"=>$proraide_paket,
	"total"=>$harga_paket-$proraide_paket
);
if($router=="1"){
$payment_router = array (
"layanan"=>"Sewa Router",
"harga"=>$biaya_router,
"total"=>$biaya_router
); }
if($stb=="1"){
$payment_stb = array (
"layanan"=>"Sewa STB",
"harga"=>$biaya_stb,
"total"=>$biaya_stb
); }
if($instal=="1"){
$payment_instal = array (
"layanan"=>"Instalasi",
"harga"=>$biaya_instalasi,
"total"=>$biaya_instalasi
); }
if($kabel=="1"){
$payment_kabel = array (
"layanan"=>"Kabel / ".$pjkbl." Meter",
"harga"=>$biaya_cable,
"total"=>$biaya_cable*$pjkbl
); }
			$update_user=$col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("no_virtual"=>$kode_perusahaan.$id_cust, "invoice"=>$result,"tanggal_tagihan"=>date("Y/m/d"),"payment_data"=>array($payment_paket, $payment_router, $payment_stb, $payment_kabel, $payment_instal))));
	if(!empty($_POST['addon'])){
			foreach($_POST['addon'] as $addon_select)
			{
				$res = $col_service->find(array("nama"=>$addon_select));
				foreach($res as $row)
									{
										$addon_harga=$row['harga'];
									}
				$update_user1= $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$push'=>array("payment_data"=>array("layanan"=>$addon_select, "harga"=>$addon_harga, "prorate"=>$addon_prorate, "total"=>$addon_harga-$addon_prorate))));
			} }
// mail for customer to addon
	$to = $email_cust;

	$subject = 'Invoice Pembayaran groovy ('.$result.')';

	$message = '
<html>
<body style="background-color:#ddd;padding:0px 0 50px 0;font-family:arial;font-size:15px;">
  <div style="margin:0 auto;background-color:#eee;">
      <div style="background: linear-gradient(to right, #f9a825 , #fdd835);padding:5px 0 2px 0;text-align:center;">
          <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
      </div>
      <div style="padding:20px 20px 20px 20px;color:#333;">
          <div style="float:right;font-size:14px;">
              <img width="100px" height="100px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Wikipedia_mobile_en.svg/2000px-Wikipedia_mobile_en.svg.png"/>
          </div>
          <p style="font-size:24px;font-weight:bold;line-height:30px;text-align:center">Rincian Tagihan</p>
          <span></span>
          <table style="margin-top:20px;margin-bottom:20px;border:0px solid #ccc;color:#333;background-color:#eee;#ddd;width:100%;font-size:14px;">
              <tr style="border:1px solid #bbb;">
                  <td style="border:1px solid #bbb;padding:5px;color:#777;">ID Invoice</td>
                  <td style="border:1px solid #bbb;padding:5px">'.$result.'</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">No. Virtual Account</td>
                  <td style="border:1px solid #bbb;padding:5px">'.$kode_perusahaan.$id_user.'</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Tanggal Tagihan</td>
                  <td style="border:1px solid #bbb;padding:5px">'.date("d").' '.bulan(date("m")).' '.date("Y").'</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Tanggal Jatuh Tempo</td>
                  <td style="border:1px solid #bbb;padding:5px">'.$tgl_akhir.' '.$month_akhir.' '.$thn_akhir.'</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">ID Customer</td>
                  <td style="border:1px solid #bbb;padding:5px">'.$id_cust.'</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Nama</td>
                  <td style="border:1px solid #bbb;padding:5px">'.$nama_cust.'</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Tempat</td>
                  <td style="border:1px solid #bbb;padding:5px">'.$tempat_cust.' '.$ket_tempat.' '.$alamat_cust.' '.$kota_cust.'</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Status</td>
                  <td style="border:1px solid #bbb;padding:5px">'.$status_cust.'</td>
              </tr>
          </table>
          <br/>
          <table style="margin-top:20px;margin-bottom:20px;float:right;border:0px solid #ccc;color:#333;background-color:#eee;#ddd;width:100%;font-size:14px;">
              <tr style="border:1px solid #bbb;">
                  <td style="border:2px solid #666;padding:10px;color:#666;text-align:center;font-size:15px;">DESCRIPTION</td>
                  <td style="border:2px solid #666;padding:10px;color:#666;text-align:center;font-size:15px;">PRICE (Rp.)</td>
              </tr>
							<tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">'.$pay['layanan'].'.</td>
                  <td style="border:1px solid #bbb;padding:5px">500.000</td>
              </tr>
							<tr>
                  <td style="border:0px solid #bbb;padding:5px;color:#777;text-align:right;">JUMLAH</td>
                  <td style="border:1px solid #bbb;padding:5px">1.000.000</td>
              </tr>
              <tr>
                  <td style="border:0px solid #bbb;padding:5px;color:#777;text-align:right;">PPN 10%</td>
                  <td style="border:1px solid #bbb;padding:5px">100.000</td>
              </tr>
              <tr>
                  <td style="border:0px solid #bbb;padding:5px;color:#777;text-align:right;">TOTAL PEMBAYARAN</td>
                  <td style="border:1px solid #bbb;padding:5px">900.000</td>
              </tr>
          </table>

          <br/>
          <h3>Tata Cara Pembayaran</h3>
					<h4>MELALUI TRANSFER ATM BANK BCA</h4>
          <ol>
              <li>Masukkan Kartu ATM dan PIN ATM Anda</li>
              <li>Kemudian Tampil Menu Utama, pilih “TRANSAKSI LAINNYA”</li>
              <li>Pilih “TRANSFER”</li>
							<li>Pilih “KE REK BCA”</li>
							<li>Masukkan jumlah nominal sesuai total tagihan. Pilih “YA”</li>
							<li>Masukkan nomor rekening Virtual Account pembayaran. Pilih “BENAR”.</li>
							<li>Periksa kembali data yang tampil. Pilih “BENAR”</li>
							<li>Transkasi selesai. Pilih “TIDAK”</li>
          </ol>
					<h4>MELALUI KLIK BCA</h4>
          <ol>
              <li>Masukkan User ID dan PIN Anda</li>
							<li>Pilih Menu “Transfer Dana”</li>
							<li>ilih Menu “Transfer ke BCA Virtual Account”</li>
							<li>Masukkan nomor BCA Virtual Account </li>
							<li>Masukkan "Pembyaran groovy [nama paket] [id customer]", klik “Lanjut” </li>
							<li>Masukkan nomor Response Key BCA appli 1, klik “kirim” </li>
          </ol>
					<h4>MELALUI TRANSFER ATM NON BANK BCA</h4>
					<ol>
							<li>Masukkan Kartu ATM dan PIN ATM Anda</li>
							<li>Kemudian Tampil Menu Utama, pilih “TRANSAKSI LAINNYA”</li>
							<li>Pilih “TRANSFER”</li>
							<li>Pilih “ANTAR BANK ONLINE”</li>
							<li>Masukkan nomor rekening Virtual Account pembayaran dengan diawali Kode Bank pada tiga digit pertama, adapun kode Bank BCA adalah “014”, setelah itu pilih “BENAR”</li>
							<li>Pada tahapan ini nomor referensi dikosongkan. Pilih “BENAR”</li>
							<li>Masukkan jumlah nominal sesuai total tagihan. Pilih “BENAR”</li>
							<li>Periksa kembali data yang tampil. Pilih “BENAR”</li>
					</ol>
					<h4>MELALUI SETOR TUNAI BANK BCA</h4>
					<ol>
							<li>Isikan kolom Tanggal Bulan serta Tahun pada saat mengisi formulir Slip setoran</li>
							<li>Pada kolom No.Rekening/Customer isikan dengan Nomor Virtual Account pembayaran</li>
							<li>Pada kolom Nama Pemilik Rekening isikan PT. Media Andalan Nusa</li>
							<li>Pada kolom Berita/ Keterangan isikan keterangan pembayaran groovy</li>
							<li>Pada kolom Nama Penyetor isikan nama lengkap penyetor</li>
							<li>Pada kolom Alamat Penyetor & Telepon isikan alamat & nomor telepon penyetor</li>
							<li>Pada pilihan Informasi Penyetor, beri centang kotak Nasabah lalu tuliskan nomor rekening yang akan di debet untuk pembayaran, jika Anda bukan nasabah bank BCA, beri centang kotak Non Nasabah lalu tuliskan nomor tanda penyenal (KTP/SIM/KITAS/PASPOR)</li>
							<li>Pada kolom Mata Uang beri centang kotak Rupiah</li>
							<li>Pada kolom Tunai/No.Warkat tulis Tunai jika sumber dana berupa uang tunai. Apabila sumber dana berupa cek / BG BCA yang telah jatuh tempo maka isikan nomor warkat</li>
							<li>Pada kolom Jumlah Rupiah isikan jumlah uang yang akan di setor</li>
							<li>Pada kolom Total isikan jumlah total yang akan di setor.</li>
							<li>Pada kolom Terbilang tuliskan dalam huruf jumlah total yang akan di bayarkan, contoh : “Satu Juta Sembilan Ratus Ribu Rupiah”</li>
							<li>Beri tanda tangan dan nama jelas penyetor di bagian penyetor</li>
					</ol>
					<h4>MELALUI SETOR TUNAI NON BANK BCA</h4>
					<ol>
							<li>Isikan kolom Tanggal Bulan serta Tahun pada saat mengisi formulir Slip setoran</li>
							<li>Pada pilihan Jenis transaksi, beri centang Transfer</li>
							<li>Pada Pilihan Penerima, beri centang kotak Penduduk</li>
							<li>Pada kolom Nama isikan nama pelanggan</li>
							<li>Pada Kolom Nomor Rekening isikan nomor virtual account dengan didahului kode bank BCA pada tiga digit pertama, adapun kode bank BCA adalah “014”</li>
							<li>Pada kolom Alamat & Nomor Telpon isikan alamat & nomor telepon penerima</li>
							<li>Pada kolom Berita Untuk Penerima isikan keterangan pembayaran groovy dan Nomor Virtual Account pembayaran</li>
							<li>Pada Pilihan Pengirim Beri centang kotak Penduduk</li>
							<li>Pada kolom Nama isikan nama penyetor</li>
							<li>Pada kolom Alamat & Nomor Telpon isikan alamat & nomor telepon penyetor</li>
							<li>Pada pilihan sumber dana Transaksi, beri centang kotak Tunai jika anda membayar tunai, sedangkan jika anda membayar dengan debet rekening maka beri centang kotak debet rekening lalu tuliskan nomor rekening yang akan di debet untuk pembayaran</li>
							<li>Pada kolom Nominal isikan nilai nominal sesuai dengan total tagihan</li>
							<li>Pada kolom Jumlah Setoran Isikan jumlah sesuai dengan total tagihan</li>
							<li>Pada kolom Terbilang Tuliskan dalam huruf jumlah yang akan di bayarkan, contoh : “Satu Juta Sembilan Ratus Ribu Rupiah”</li>
							<li>Pada pilihan Biaya transaksi beri centang kotak Tunai jika anda ingin membayar tunai biaya transaksi, sedangkan jika anda membayar dengan debet rekening maka beri centang kotak Debet rekening lalu tuliskan nomor rekening yang akan di debet untuk biaya transaksi</li>
							<li>Pada kolom Tujuan Transaksi isikan Berita Pembayaran, contoh : “Pembayaran groovy disertai dengan id pelanggan dan nama pelanggan”</li>
							<li>Beri tanda tangan dan nama jelas penyetor di bagian pemohon</li>
					</ol>
          <p>Lorem Ipsum</p>
      </div>
      </div>
  </div>
</body>
</html>
	';
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'From: billing@groovy.id' . "\r\n";

	$sent=mail($to, $subject, $message.$m_paket.$m_addon.$m_router.$m_stb.$m_instalasi.$m_kabel.$m_total, $headers);

	if($sent && $update_user){ ?>
		<script type="" language="JavaScript">alert('Invoice Telah Terkirim');
		document.location='<?php echo $base_url_member; ?>/send-invoice'</script>
<?php	} }
?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
				<div class="panel" style="border:0px;" >
					<div class="panel-body" style="background-color:#1B5E12;">
						<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">KIRIM INVOICE</h3>
					</div>
					<div class="panel-body">
						<br/>
						<div class="col-sm-12">
							<li class="list-group-item">
							  	Paket :
							  	<select class="form-control" id="paket" name="paket">
							  	<?php
						$res = $col_package->find();
						foreach($res as $row)
	                      {
	                      	?>
						          <option><?php echo $row['nama']; ?></option>
						        <?php } ?>
						        </select>
										<input type="number" class="form-control" id="proraide_paket" name="proraide_paket" placeholder="Prorate Paket"><br/>
							</li>
								<ul style="text-align:left;" class="list-group">
									Add On Service
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
								<fieldset>
									<div class="checkbox">
											<label>
												<input type="checkbox" name="stb" id="stb" value="1"> STB (45.000/Bulan) <br/>
												<input type="checkbox" name="router" id="router" value="1"> Router (40.000/Bulan) <br/>
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
