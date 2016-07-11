<style>
    .datepicker{z-index:1151;}
</style>
    <script>
    	$(function(){
        $("#inputPaymentdate").datepicker({
      	format:'yyyy/mm/dd'
        });
        $("#inputTerminationdate").datepicker({
      	format:'yyyy/mm/dd'
        });
        $("#inputRequestdate").datepicker({
      	format:'yyyy/mm/dd'
        });
            });
         $(document).ready(function(){
           $("#kolpostchange").hide();
           $("#kolpostrequest").hide();
           $("#kol_term").hide();
           $("#select_kol").change(function(){
            var sel_kol =  $("#select_kol").val();
            var pil1 = "change";
            var pil2 = "request";
      if (sel_kol == pil1) {
        $("#kolpostrequest").hide();
        $("#kolpostchange").show();
  } else if(sel_kol == pil2) {
    $("#kolpostchange").hide();
    $("#kolpostrequest").show();
}
})
$("#select_kol1").change(function(){
   var sel_kol1 =  $("#select_kol1").val();
   var pil1 = "change";
   var pil2 = "request";
if (sel_kol1 == pil2) {
    $("#kol_term").show();
} else if(sel_kol1 == pil1) {
    $("#kol_term").hide();
}
})
 });
    </script>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
$id_cust = $_GET['id_cust'];
$date = date("Y/m/d");
$date_month = date("d");
$date_month = date("y");
						$res = $col_user->find(array("id_user"=>$id_cust, "level"=>"0"));
						foreach($res as $row)
											{
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

												$registrasi_cust = $row['registrasi'];
												$sales =$row['sales'];
                        $addon_cust =$row['addon'];
												$nama_cust = $row['nama'];
												$email_cust = $row['email'];
												$phone_cust = $row['phone'];
												$package_cust = $row['paket'];
												$tempat_cust = $row['tempat'];
                        $kota_cust = $row['kota'];
                        $status_cust = $row['status'];
                        $alamat_cust = $row['alamat'];
                        $ket_cust = $row['keterangan'];
                        $tanggal_akhir = $row['tanggal_akhir'];
                        $tanggal_aktif = $row['tanggal_aktif'];
                        $harga_paket = $row['harga'];
                        $kode_invoice = $row['invoice'];
                        $pembayaran = $row['pembayaran'];
                        $proraide = $row['proraide'];
                        $move_paket_cust = $row['move_paket'];
                        $move_harga_cust = $row['move_harga'];
	                                        }
	if ($bln_akhir=="12"){
		$next_month="01";
		$next_years=$thn_akhir+1;
	} else {
		$next_month=$bln_akhir+1;
		$next_years=$thn_akhir;
		if ($next_month<10){
			$next_month='0'.$next_month;
		}
	}

$res = $col_package->find(array("nama"=>$package_cust));
	foreach($res as $row)
	{
		$deskripsi_paket0=$row['deskripsi'];
    $isi_paket0=$row['isi'];
	}
$res = $col_package->find(array("nama"=>$move_paket_cust));
	foreach($res as $row)
	{
		$deskripsi_paket1=$row['deskripsi'];
	}
if(isset($_POST['verifikasi'])){
		$tanggal_bayar = $_POST['inputPaymentdate'];
		$thn_bayar = substr($tanggal_bayar, 0,4);
		$bln_bayar = substr($tanggal_bayar, 5,2);
		$tgl_bayar = substr($tanggal_bayar, 8,10);
		$month_bayar = bulan($bln_bayar);
		$last_pembayaran = $pembayaran + 1;
//mail to bukti pembayaran

$subject = 'Bukti Pembayaran groovy ('.$kode_invoice.')';

$message = '
<html>
<body style="background-color:#ddd;padding:0px 0 50px 0;font-family:arial;font-size:15px;">
    <div style="margin:0 auto;background-color:#eee;">
        <div style="background: linear-gradient(to right, #f9a825 , #fdd835);padding:5px 0 2px 0;text-align:center;">
            <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
        </div>
        <div style="padding:20px 20px 20px 20px;color:#333;">
            <div style="float:right;font-size:14px;">
                <img width="150px" height="150px" src="http://groovy.id/beta/member/bukti/'.$kode_invoice.'.png"/>
            </div>
            <p style="font-size:24px;font-weight:bold;line-height:30px;text-align:center">Bukti Pembayaran</p>
            <span></span>
            <table style="margin-top:20px;margin-bottom:20px;border:0px solid #ccc;color:#333;background-color:#eee;#ddd;width:100%;font-size:14px;">

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
                    <td style="border:1px solid #bbb;padding:5px">'.$tempat_cust.' '.$ket_cust.' '.$alamat_cust.' '.$kota_cust.'</td>
                </tr>
            </table>
            <br/>
            <h4>Detail Pembayaran</h4>
            <table style="margin-top:20px;margin-bottom:20px;float:right;border:0px solid #ccc;color:#333;background-color:#eee;#ddd;width:100%;font-size:14px;">
                <tr style="border:1px solid #bbb;">
                    <td style="border:2px solid #666;padding:10px;color:#666;text-align:center;font-size:15px;">DESCRIPTION</td>
                    <td style="border:2px solid #666;padding:10px;color:#666;text-align:center;font-size:15px;">PRICE (Rp.)</td>
                </tr>';
                $total=0;
            		$res = $col_user->findOne(array("id_user"=>$id_cust));
            		foreach ($res['payment_data'] as $payment => $pay) {
            			if ($pay<>null){
            				$total = $total+$pay['harga'];
$rincian_biaya[] =
  							'<tr>
                    <td style="border:1px solid #bbb;padding:5px;color:#777">'.$pay['layanan'].'</td>
                    <td style="border:1px solid #bbb;padding:5px">'.rupiah($pay['harga']).'</td>
                </tr>'; }}
$message1 =
                '<tr>
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
            <table style="margin-top:20px;margin-bottom:20px;border:0px solid #ccc;color:#333;background-color:#eee;#ddd;width:100%;font-size:14px;">

                <tr>
                    <td style="border:1px solid #bbb;padding:5px;color:#777">ID Invoice</td>
                    <td style="border:1px solid #bbb;padding:5px">'.$kode_invoice.'</td>
                </tr>
                <tr>
                    <td style="border:1px solid #bbb;padding:5px;color:#777">No Virtual Account</td>
                    <td style="border:1px solid #bbb;padding:5px">'.$kode_perusahaan.$id_cust.'</td>
                </tr>
                <tr>
                    <td style="border:1px solid #bbb;padding:5px;color:#777">Tanggal Bayar</td>
                    <td style="border:1px solid #bbb;padding:5px">'.$tgl_bayar.' '.$month_bayar.' '.$thn_bayar.'</td>
                </tr>
                <tr>
                    <td style="border:1px solid #bbb;padding:5px;color:#777">Tanggal Konfirmasi</td>
                    <td style="border:1px solid #bbb;padding:5px">'.date("d").' '.bulan(date("m")).' '.date("Y").'</td>
                </tr>
            </table>
            <p>groovy.id</p>
        </div>
        </div>
    </div>
</body>
</html>
';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From: billing@groovy.id' . "\r\n";

$ketrincian=implode("", $rincian_biaya);
	$sent=mail($email_cust, $subject, $message.$ketrincian.$message1, $headers);

	if ($status_cust=="registrasi"){
				// mail for supevisior teknik
				$subject = 'Atur Jadwal Pemasangan';
				$message = '
				<html>
				<body>
				  <p>Mohon segera diatur jadwal pemasangan untuk customer berikut : </p>
				  <br/>
				  <p>ID Customer : '.$id_cust.'</p>
				  <p>Nama : '.$nama_cust.'</p>
				  <p>Tempat : '.$tempat_cust.', '.$ket_cust.', '.$kota_cust.'</p>
				  <p>Tanggal Registrasi : '.$tgl_registrasi.' '.$month_registrasi.' '.$thn_registrasi.'</p>
				  <p>Registrasi : '.$registrasi_cust.' '.$sales.'</p>
				  <p>Paket : '.$package_cust.'('.$deskripsi_paket0.')</p>
				  <br/>
				</body>
				</html>
				';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
				$headers .= 'Cc: cs@groovy.id' . "\r\n";
			$res = $col_user->find(array("level"=>"3"));
						foreach($res as $row)
											{
				$emailpasang=mail($row['email'], $subject, $message, $headers);
			} 	$update_user = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"), array('$set'=>array("pembayaran"=>$last_pembayaran)));

	} else {
		$update_user = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"), array('$set'=>array("tanggal_akhir"=>$next_years.'/'.$next_month.'/01', "pembayaran"=>$last_pembayaran)));
	}
$add_payment = $col_payment->insert(array("id_user"=>$id_cust, "invoice"=>$kode_invoice, "tanggal_bayar"=>$tanggal_bayar, "tanggal_konfirmasi"=>$date, "total_tagihan"=>"", "ppn"=>"", "no"=>$last_pembayaran,"total_pembayaran"=>""));
$histori=array(
      "tanggal"=>$date,
      "hal"=> "Payment",
      "keterangan"=>"Konfirmasi Pembayaran Pada Tanggal ".$tgl_bayar." ".$month_bayar." ".$thn_bayar
    );
	$update_histori = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$push'=>array("histori"=>$histori)));
$total=0;
if($add_payment){
$res = $col_user->findOne(array("id_user"=>$id_cust));
foreach ($res['payment_data'] as $payment => $pay) {
  if ($pay<>null){
$bayar = $col_payment->update(array("id_user"=>$id_cust, "no"=>$last_pembayaran),array('$push'=>array("pembayaran"=>array("deskripsi"=>$pay['layanan'], "harga"=>$pay['harga'], "prorate"=>$pay['prorate'], "total_harga"=>$pay['total']))));
$total=$total+$pay['total'];
} }
$update_payment=$col_payment->update(array("id_user"=>$id_cust, "no"=>$last_pembayaran), array('$set'=>array("total_tagihan"=>$total, "ppn"=>$total*0.1, "total_pembayaran"=>$total*0.1+$total)));
}
if ($emailinvoice || $update_payment){
	?>
		<script type="" language="JavaScript">alert('Pembayaran sudah di konfirmasi');
		document.location='<?php echo $base_url_member; ?>/verification-payment/<?php echo $id_cust; ?>'</script>
<?php } }
if(isset($_POST['terminasi'])){
  $selterm=$_POST['select_kol1'];
	$termination_date=$_POST['inputTerminationdate'];
	$textalasanberhenti=$_POST['textalasanberhenti'];
		$thn_tutup = substr($termination_date, 0,4);
		$bln_tutup = substr($termination_date, 5,2);
		$tgl_tutup = substr($termination_date, 8,10);
		$month_tutup = bulan($bln_tutup);
    if($selterm=="request"){
				// mail for supevisior teknik
				$subject0 = 'Berhenti Berlangganan';
				$message0 = '
				<html>
				<body>
				  <p>Berikut Permintaan Customer Close : </p>
				  <br/>
				  <p>ID Customer : '.$id_cust.'</p>
				  <p>Nama : '.$nama_cust.'</p>
				  <p>Tanggal Tutup : '.$tgl_tutup.' '.$month_tutup.' '.$thn_tutup.'</p>
				  <br/>
				</body>
				</html>
				';
				$headers0  = 'MIME-Version: 1.0' . "\r\n";
				$headers0 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers0 .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
				$headers0 .= 'Cc: cs@groovy.id' . "\r\n";
				$res = $col_user->find(array("level"=>"3"));
			foreach($res as $row) {
				$emailbongkar=mail($row['email'], $subject0, $message0, $headers0);
			}
			// mail for customer
				$subject1 = 'Berhenti Berlangganan';
				$message1 = '
				<html>
					<body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
					    <div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
					        <div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
					            <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
					        </div>
					        <div style="padding:20px;color:#333;">
					            <p style="font-size:20px;font-weight:bold;line-height:1px">Hai '.$nama_cust.',</p>
					            <p>Terimakasih sudah berlangganan Groovy.</p>
					            <p>Layanan anda akan berakhir pada tanggal '.$tgl_tutup.' '.$month_tutup.' '.$thn_tutup.'<br/><br/>
					            Kami akan segera memberikan informasi terkait pengambilan perangkat yang Anda gunakan. Untuk Melakukan aktivasi kembali layanan kami bisa di halaman member anda.</p>
					            <p style="color:#888;">Terimakasih.</p>
					        </div>
					        </div>
					    </div>
					</body>
					</html>

				';
				$headers1  = 'MIME-Version: 1.0' . "\r\n";
				$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers1 .= 'From: cs@groovy.id' . "\r\n";
				$headers1 .= 'Cc: billing@groovy.id' . "\r\n";
				$emailnotice=mail($email_cust, $subject1, $message1, $headers1);
  $push_histori=$col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$push'=>array("histori"=>array("tanggal"=>date("Y/m/d"), "hal"=>"Berhenti Berlangganan", "keterangan"=>"Konfirmasi Permintaan Berhenti Berlangganan"))));
} else if($selterm=="change"){
  $update_user=$col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("status"=>"unaktif")));
  $push_histori=$col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$push'=>array("histori"=>array("tanggal"=>date("Y/m/d"), "hal"=>"Berhenti Berlangganan", "keterangan"=>"Layanan Sudah Berhenti")))); 
}
	?>
		<script type="" language="JavaScript">alert('Penutupan layanan sudah di konfirmasi');
		document.location='<?php echo $base_url_member; ?>/verification-payment/<?php echo $id_cust; ?>'</script>
<?php }
if(isset($_POST['request'])){
  $inputpaket=$_POST['inputpaket'];
  $inputaddon=implode(", ", $_POST['addon']);
  $daterequest=$_POST['inputRequestdate'];

  $thn_pindah = substr($daterequest, 0,4);
  $bln_pindah = substr($daterequest, 5,2);
  $tgl_pindah = substr($daterequest, 8,10);
  $month_pindah = bulan($bln_pindah);
  // mail for supevisior teknik
				$subject = 'Pindah Layanan';
				$message = '
				<html>
				<body>
				  <p>Request Customer Pindah Layanan : </p>
				  <br/>
				  <p>ID Customer : '.$id_cust.'</p>
				  <p>Nama : '.$nama_cust.'</p>
				  <p>Tempat : '.$tempat_cust.', '.$ket_cust.', '.$kota_cust.'</p>
				  <p>Pindah Paket : '.$inputpaket.'</p>
          <p>Layanan Tambahan : '.$inputaddon.'</p>
				  <p>Tanggal Pindah Layanan : '.$tgl_pindah.' '.$month_pindah.' '.$thn_pindah.'</p>
				  <br/>
          <p>Mohon Konfirmasi Setelah Di Lakukan Pindah Layanan</p>
          <br/>
				</body>
				</html>
				';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.$email_billing . "\r\n";
				$headers .= 'Cc: '.$email_cs . "\r\n";
			$res = $col_user->find(array("level"=>"3"));
						foreach($res as $row)
											{
				$emailpindah=mail($row['email'], $subject, $message, $headers);
			}
					// mail for customer
				$subject1 = 'Pemberitahuan Pindah Paket';
				$message1 = '
				<html>
					<body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
					    <div style="margin:0 auto;max-width:750px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
					        <div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
					            <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
					        </div>
					        <div style="padding:20px;color:#333;">
					            <p style="font-size:20px;font-weight:bold;line-height:1px">Pemberitahuan Pergantian Layanan</p>
                      <p>Sehubungan dengan permintaan pergantian layanan, dapat kami informasikan bahwa layanan yang anda gunakan saat ini :<br/>
                      Paket : '.$package_cust.'<br/>
                      Layanan Tambahan : '.$addon_cust.'<br/>
                      Akan kami lakukan pergantian layanan pada tanggal '.$tgl_pindah.' '.$month_pindah.' '.$thn_pindah.' menjadi : <br/>
                      Paket : '.$inputpaket.'<br/>
                      Layanan Tambahan : '.$inputaddon.'<br/>
                      Terima kasih telah menggunakan layanan groovy.</p><br/><br/>
					        </div>
                  <div style="padding:10px;color:#333;">
                      <img src="http://groovy.id/beta/img/groovy-logo-orange.png" height="20px;"/>
                      <p>Hormat Kami<br/>
                      Customer Service groovy<br/>
                      PT Media Andalan Nusa<p>
                  </div>
					        </div>
					    </div>
					</body>
					</html>
				';
				$headers1  = 'MIME-Version: 1.0' . "\r\n";
				$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers1 .= 'From: cs@groovy.id' . "\r\n";
				$headers1 .= 'Cc: cs@groovy.id' . "\r\n";
				$emailcust_pindah=mail($email_cust, $subject1, $message1, $headers1);
$res = $col_package->find(array("nama"=>$inputpaket));
	foreach($res as $row)
	{
		$isi_paket=$row['isi'];
	}
        if($emailpindah && $emailcust_pindah){ ?>
          <script type="" language="JavaScript">alert('Request pindah layanan sudah di konfirmasi');
      		document.location='<?php echo $base_url_member; ?>/verification-payment/<?php echo $id_cust; ?>'</script>
<?php } }
  if(isset($_POST['change'])){
    $inputpaket=$_POST['inputpaket'];
    $inputaddon=implode(", ", $_POST['addon']);
                // mail for customer
              $subject1 = 'Pemberitahuan Pindah Paket';
              $message1 = '
              <html>
                <body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
                    <div style="margin:0 auto;max-width:750px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
                        <div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
                            <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
                        </div>
                        <div style="padding:20px;color:#333;">
                            <p style="font-size:20px;font-weight:bold;line-height:1px">Pemberitahuan Pergantian Layanan</p>
                            <p>Sehubungan dengan permintaan pergantian layanan, dapat kami informasikan bahwa layanan yang anda gunakan saat ini :<br/>
                            Paket : '.$package_cust.'<br/>
                            Layanan Tambahan : '.$addon_cust.'<br/>
                            Kami sudah melakukan pergantian layanan pada tanggal '.$tgl_pindah.' '.$month_pindah.' '.$thn_pindah.' menjadi : <br/>
                            Paket : '.$inputpaket.'<br/>
                            Layanan Tambahan : '.$inputaddon.'<br/>
                            Terima kasih telah menggunakan layanan groovy.</p><br/><br/>
                        </div>
                        <div style="padding:10px;color:#333;">
                            <img src="http://groovy.id/beta/img/groovy-logo-orange.png" height="20px;"/>
                            <p>Hormat Kami<br/>
                            Customer Service groovy<br/>
                            PT Media Andalan Nusa<p>
                        </div>
                        </div>
                    </div>
                </body>
                </html>
              ';
              $headers1  = 'MIME-Version: 1.0' . "\r\n";
              $headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
              $headers1 .= 'From: cs@groovy.id' . "\r\n";
              $headers1 .= 'Cc: cs@groovy.id' . "\r\n";
              $emailcust=mail($email_cust, $subject1, $message1, $headers1);
              $update_user=$col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("paket"=>$inputpaket, "addon"=>$inputaddon)));
              $push_histori=$col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$push'=>array("histori"=>array("tanggal"=>$date, "hal"=>"Update Layanan", "keterangan"=>"Update layanan utama ".$inputpaket.", dan layanan tambahan ".$inputaddon))));
if($emailcust && $update_user && $push_histori){ ?>
                <script type="" language="JavaScript">alert('Pindah layanan sudah di konfirmasi');
                document.location='<?php echo $base_url_member; ?>/verification-payment/<?php echo $id_cust; ?>'</script>
<?php } } ?>
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
							  <label class="col-lg-3 control-label">Paket Aktif/Layanan Tambahan: </label>
							  <div class="col-lg-9">
								<h4><?php echo $package_cust.'/'.$addon_cust; ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Lokasi : </label>
							  <div class="col-lg-9">
								<h4><?php echo $tempat_cust.', '.$ket_cust.', '.$kota_cust; ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Tanggal Registrasi : </label>
							  <div class="col-lg-9">
								<h4><?php echo $tgl_registrasi.' '.$month_registrasi.' '.$thn_registrasi; ?></h4>
							  </div>
							</div>	<?php if($status_cust<>"registrasi"){ ?>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Tanggal Akhir Pembayaran : </label>
							  <div class="col-lg-9">
								<h4><?php echo $tgl_akhir.' '.$month_akhir.' '.$thn_akhir; ?></h4>
              </div></option>
                <?php } ?><br/>
								<input type="text" class="form-control" id="inputPaymentdate" name="inputPaymentdate" placeholder="Payment Date" required>
								<br/>
								<input type="submit" class="btn" style="background-color:#1B5E12; color:#FFFFFF" name="verifikasi" id="verifikasi" value="Vertifikasi">
							  </div>
							</div>
						  </fieldset>
						</form>
					</div>
				</div>
		<div class="col-sm-12">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">BILLING - <?php echo $pindah_paket; ?></h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="40%">Deskripsi Pembayaran</th>
									      <th width="20%">Harga</th>
									      <th width="20%">Prorate</th>
									      <th width="20%">Total Bayar</th>
									    </tr>
									  </thead>
                    <?php
                    $total=0;
                    $res = $col_user->findOne(array("id_user"=>$id_cust));
										foreach ($res['payment_data'] as $payment => $pay) {
                      if ($pay<>null){
                      ?>
									  <tbody>
									  	<td><?php echo $pay['layanan']; ?></td>
									  	<td><?php echo rupiah($pay['harga']); ?></td>
									  	<td><?php echo rupiah($pay['prorate']); ?></td>
									  	<td><?php echo rupiah($pay['total']); ?></td>
									  </tbody>
                    <?php
                        $total = $total+$pay['total'];
                  } } ?>
                  <tbody>
                    <td><b>Total Harga</b></td>
                    <td></td>
                    <td></td>
                    <td><b><?php echo rupiah($total); ?></b></td>
                  </tbody>
                  <tbody>
                    <td>PPN 10%</td>
                    <td></td>
                    <td></td>
                    <td><?php echo rupiah($total*0.1); ?></td>
                  </tbody>
                  <tbody>
                    <td><b>Total Pembayaran</b></td>
                    <td></td>
                    <td></td>
                    <td><b><?php echo rupiah($total*0.1+$total); ?></b></td>
                  </tbody>
								</table>
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
					  	</div>
					</div>
				</div>
		<div class="col-sm-12">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">DATA PEMBAYARAN - <?php echo $pembayaran; ?></h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="10%">No</th>
                        <th width="20%">Invoice</th>
									      <th width="30%">Pembayaran</th>
									      <th width="30%">Konfirmasi</th>
									      <th width="10%"></th>
									    </tr>
									  </thead>
									  <?php
									  	$res = $col_payment->find(array("id_user"=>$id_cust));
										foreach ($res as $byr) {
											$thn_konfirmasi = substr($byr['tanggal_konfirmasi'], 0,4);
											$bln_konfirmasi = substr($byr['tanggal_konfirmasi'], 5,2);
											$tgl_konfirmasi = substr($byr['tanggal_konfirmasi'], 8,10);
											$month_konfirmasi = bulan($bln_konfirmasi);

											$thn_bayar = substr($byr['tanggal_bayar'], 0,4);
											$bln_bayar = substr($byr['tanggal_bayar'], 5,2);
											$tgl_bayar = substr($byr['tanggal_bayar'], 8,10);
											$month_bayar = bulan($bln_bayar);
									   ?>
									  <tbody class="pic-container down">
									  	<td><?php echo $byr['no']; ?></td>
                      <td><?php echo $byr['invoice']; ?></td>
									  	<td><?php echo $tgl_bayar.' '.$month_bayar.' '.$thn_bayar; ?></td>
									  	<td><?php echo $tgl_konfirmasi.' '.$month_konfirmasi.' '.$thn_konfirmasi; ?></td>
									  	<td><a href="#" data-toggle="modal" data-target="#<?php echo $byr['no']; ?>">Deskripsi</a></td>
									  </tbody>
                    <div class="modal" name=<?php echo $byr['no']; ?> id=<?php echo $byr['no']; ?>>
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Data Pembayaran (<?php echo $byr['invoice']; ?>)</h4>
                          </div>
                          <div class="modal-body">
                              <div class="panel panel-default">
                                <?php foreach ($byr['pembayaran'] as $pmbyr) { ?>
                                  <div class="panel-body">
                                    <strong><?php print_r($pmbyr['deskripsi']); ?></strong>=>Harga<b>(<?php print_r(rupiah($pmbyr['harga'])); ?>)</b> - Prorate<b>(<?php print_r(rupiah($pmbyr['prorate'])); ?>)</b> = Subtotal<b>(<?php print_r(rupiah($pmbyr['total_harga'])); ?>)</b>
                                  </div>
                                  <?php } ?>
                                </div>
                          </div>
                          <div class="modal-footer">
                            <p>Total Tagihan : <b><?php echo rupiah($byr['total_tagihan']); ?></b></p>
                            <p>PPN 10% : <b><?php echo rupiah($byr['ppn']); ?></b></p>
                            <p>Total Pembayaran : <b><?php echo rupiah($byr['total_pembayaran']); ?></b></p>
                          </div>
                        </div>
                      </div>
                    </div>
									  <?php } ?>
								</table>
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
					  	</div>
					</div>
				</div>
        <div class="col-sm-12">
    		<div class="list-group">
    			<div class="panel" style="border:0px;">
      				<div class="panel-heading" style="background-color:#1B5E12">
        				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">LAYANAN</h3>
      				</div>
    	  					<br/>
    	  				    <div class="panel-body">
    	  				    <form method="post">
    	  				    <div class="row">
    	  				    	<div class="col-sm-12">
                        <li class="list-group-item">
                          <select class="form-control" id="select_kol" name="select_kol">
                            <option disabled="true" selected="true">Select</option>
                            <option value="request">Request</option>
                            <option value="change">Change</option>
                          </select>
                        </li>
                        <li class="list-group-item">
                            Paket :
                            <select class="form-control" id="inputpaket" name="inputpaket">
                            <?php
                      $res = $col_package->find();
                      foreach($res as $row)
                                  {
                                    ?>
                                <option><?php echo $row['nama']; ?></option>
                              <?php } ?>
                              </select>
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
                          <br/>
                        <li class="list-group-item" name="kolpostchange" id="kolpostchange">
                          <input type="submit" class="btn" style="background-color:#1B5E12; color:#FFFFFF" name="change" id="change" value="Change">
                        </li>
                        <li class="list-group-item" name="kolpostrequest" id="kolpostrequest">
                          <input type="text" class="form-control" id="inputRequestdate" name="inputRequestdate" placeholder="Date Request Change Service"><br/>
                          <input type="submit" class="btn" style="background-color:#1B5E12; color:#FFFFFF" name="request" id="request" value="Request">
                        </li>
    		  				    </div>
    		  				 </div>
    		  				 </form>
    		  				 </div>
    					  	</div>
    					</div>
    				</div>
		<div class="col-sm-12">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">TERMINASI</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
                <select class="form-control" id="select_kol1" name="select_kol1">
                  <option disabled="true" selected="true">Select</option>
                  <option value="request">Request</option>
                  <option value="change">Change</option>
                </select>
                <li class="list-group-item" name="kol_term" id="kol_term">
      							<input type="text" class="form-control" id="inputTerminationdate" name="inputTerminationdate" placeholder="Termination Date" required> <br/>
      							<input type="text" class="form-control" name="textalasanberhenti" id="textalasanberhenti" placeholder="Alasan Penutupan"><br/>
                </li>
									<br/>
								<input type="submit" class="btn" style="background-color:#1B5E12; color:#FFFFFF" name="terminasi" id="terminasi" value="INPUT">
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
					  	</div>
					</div>
				</div>
        <div class="col-sm-12">
        <div class="list-group">
          <div class="panel" style="border:0px;">
              <div class="panel-heading" style="background-color:#1B5E12">
                <h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">LOG</h3>
              </div>
                  <br/>
                    <div class="panel-body">
                      <table class="table table-striped table-hover ">
      									 <thead>
      									    <tr>
      									      <th width="20%">Tanggal</th>
      									      <th width="20%">Log</th>
      									      <th width="60%">Keterangan</th>
      									    </tr>
      									  </thead>
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
                      </table>
                   </div>
                  </div>
              </div>
            </div>
			</div>
		</div>
	</div>
</section>
</form>
