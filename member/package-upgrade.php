<?php
//tes 
	if($no_virtual=="" || $no_virtual==null){ ?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>'</script>
	<?php } ?>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
	$date = date("Y/m/d"); 
		$thn1 = substr($date, 0,4);
	    $bln1 = substr($date, 5,2);
		$tgl1 = substr($date, 8,10);
	    $month1 = bulan($bln1); 
			$thn = substr($tanggal_akhir, 0,4);
		    $bln = substr($tanggal_akhir, 5,2);
			$tgl = substr($tanggal_akhir, 8,10);
		    $month = bulan($bln);
		if (isset($_POST['upgrade'])){
			$upgrade_paket=$_POST['upgrade_paket']; 
$res = $col_package->find(array("nama"=>$upgrade_paket));
foreach($res as $row)
{ 
    $upgrade_harga=$row['harga'];
} 
	$upgrade=array(
			"date_request"=>$date,
			"paket"=>$upgrade_paket,
			"harga"=>$upgrade_harga
		);
		$update_user=$col_user->update(array("id_user"=>$id),array('$set'=>array("paket"=>$upgrade_paket, "harga"=>$upgrade_harga)));
		$upgrade_paket=$col_user->update(array("id_user"=>$id),array('$push'=>array("data_paket"=>$upgrade)));
			// mail for customer to update paket
				$to = 'yudi.nurhandi@nusa.net.id';

				$subject = 'Upgrade Paket';

				$message = '
				<html>
				<body>
				  <p>Anda Melakukan permintaan perubahan layanan dengan rincian berikut : </p>
				  <br/>
				  <p>ID Customer : '.$id.'<br/>
				  Nama : '.$nama.'<br/>
				  Paket Aktif : '.$paket.'<br/>
				  Email : '.$email.'<br/>
				  Phone : '.$notelp.'<br/>
				  Tempat : '.$tempat.' '.$keterangan.' '.$alamat.' '.$kota.'<br/>
				  Tanggal Akhir aktif : '.$tgl.' '.$month.' '.$thn.'<br/>
				  Permitaan pindah paket ke : '.$upgrade_paket.'<br/>
				  Tanggal permintaan : '.$tgl1.' '.$month1.' '.$thn1.'</p>
				  <br/>
				  <p>Silahkan untuk melakukan pembayaran agar kami bisa memproses untuk pindah paket, info pembayaran terdapat pada billing di halaman member anda.</p>
				  <p>Paket baru akan aktif, setelah masa waktu paket lama habis.</p>
				  <br/>
				  <p>Best Regards</p>
				  <p>Customer Service</p>
				  <p>groovy.id</p>
				</body>
				</html>
				';

				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				$headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
				$headers .= 'Cc: cs@groovy.id' . "\r\n";

				$kirimemail=mail($to, $subject, $message, $headers);		
	if ($update_user && $upgrade_paket && $kirimemail){

		}
	}
?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#FC9822">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PACKAGE - MOVE</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<div class="col-sm-12">
						<li class="list-group-item">
						  	Upgrade Paket : 
						  	<select class="form-control" id="upgrade_paket" name="upgrade_paket">
						  	<option disabled="true" selected="true">Selected Package</option>
						  	<?php
					$res = $col_package->find();
					foreach($res as $row) 
                      {   
                      	?>
					          <option><?php echo $row['nama']; ?></option>
					        <?php } ?>
					        </select>
						</li>
						<li class="list-group-item">
							<div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>	
						</li>	
						<br/>	
						<input type="submit" class="btn btn-warning" name="upgrade" id="upgrade" value="Konfirmasi">	
						<br/>							
					</div>	
 				</div>
			</div>
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#FC9822">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PACKAGE - MOVE</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<div class="col-sm-12">
						<li class="list-group-item" style="border:2;">
							Tanggal Permintaan : <b><?php echo $tgl.' '.$month.' '.$thn; ?></b><br/>
							Nama Paket : <b><?php echo $tgl1.' '.$month1.' '.$thn1; ?></b><br/>
					    	Status : <b><?php echo $payment['paket']; ?></b><br/>
					    	<input type="submit" name="batal" id="batal" class="label label-warning" value="Batal">
					    	Tanggal Aktif : <b><?php echo $payment['paket']; ?></b><br/>
					    	Tanggal Berhenti : <b><?php echo $payment['harga'].',-'; ?></b>
						</li>						
					</div>	
 				</div>
			</div>
		</div>
	</div>	
</section>