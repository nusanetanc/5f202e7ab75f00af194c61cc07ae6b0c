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

						$nama_cust = $row['nama'];
						$email_cust = $row['email'];
						$phone_cust = $row['phone'];
						$tempat_cust = $row['tempat'];
						$kota_cust = $row['kota'];
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
); } /*
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
			} } */
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
                  <td style="border:1px solid #bbb;padding:5px">14C02F767</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">No. Virtual Account</td>
                  <td style="border:1px solid #bbb;padding:5px">991821212812312</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Tanggal Tagihan</td>
                  <td style="border:1px solid #bbb;padding:5px">12 Juni 2016</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Tanggal Jatuh Tempo</td>
                  <td style="border:1px solid #bbb;padding:5px">12 Juni 2016</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">ID Customer</td>
                  <td style="border:1px solid #bbb;padding:5px">121231412</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Nama</td>
                  <td style="border:1px solid #bbb;padding:5px">John Doe</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Tempat</td>
                  <td style="border:1px solid #bbb;padding:5px">Apartemen Laguna, dsf, Jl. Pluit Timur Raya, Blok MM, Jakarta Utara</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Status</td>
                  <td style="border:1px solid #bbb;padding:5px">-</td>
              </tr>
          </table>
          <br/>
          <table style="margin-top:20px;margin-bottom:20px;float:right;border:0px solid #ccc;color:#333;background-color:#eee;#ddd;width:100%;font-size:14px;">
              <tr style="border:1px solid #bbb;">
                  <td style="border:2px solid #666;padding:10px;color:#666;text-align:center;font-size:15px;">DESCRIPTION</td>
                  <td style="border:2px solid #666;padding:10px;color:#666;text-align:center;font-size:15px;">PRICE (Rp.)</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">NUSANET provider Broadband Wireless, Broadband SOHO, Dedicated Wireless Unlimited, Fiber Optic, Rack Space, Colocation Server, Dedicated Server, Web and Mail Hosting in Medan, Lampung, Jakarta, Surabaya and Malang. Please visit our website for details.</td>
                  <td style="border:1px solid #bbb;padding:5px">500.000</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">NUSANET provider Broadband Wireless, Broadband SOHO, Dedicated Wireless Unlimited, Fiber Optic, Rack Space, Colocation Server, Dedicated Server, Web and Mail Hosting in Medan, Lampung, Jakarta, Surabaya and Malang. Please visit our website for details.</td>
                  <td style="border:1px solid #bbb;padding:5px">500.000</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">NUSANET provider Broadband Wireless, Broadband SOHO, Dedicated Wireless Unlimited, Fiber Optic, Rack Space, Colocation Server, Dedicated Server, Web and Mail Hosting in Medan, Lampung, Jakarta, Surabaya and Malang. Please visit our website for details.</td>
                  <td style="border:1px solid #bbb;padding:5px">500.000</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">NUSANET provider Broadband Wireless, Broadband SOHO, Dedicated Wireless Unlimited, Fiber Optic, Rack Space, Colocation Server, Dedicated Server, Web and Mail Hosting in Medan, Lampung, Jakarta, Surabaya and Malang. Please visit our website for details.</td>
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
          <h4>Tata Cara Pembayaran</h4>
          <ol>
              <li>asdfsdf</li>
              <li>asdfsdf</li>
              <li>asdfsdf</li>
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
