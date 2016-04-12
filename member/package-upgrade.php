<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
	$date = date("Y/m/d"); 
  	$thn0 = substr($date, 0,4);
    $bln0 = substr($date, 5,2);
	$tgl0 = substr($date, 8,10);
    $month0 = bulan($bln0);
		if (isset($_POST['upgrade'])){
$upgrade_paket=$_POST['upgrade_paket']; 
$res = $col_package->find(array("nama"=>$upgrade_paket));
foreach($res as $row)
{ 
    $upgrade_harga=$row['harga'];
} 
	$update_user=$col_user->update(array("id_user"=>$id, "level"=>"0"),array('$set'=>array("move_paket"=>$upgrade_paket, "move_harga"=>$upgrade_harga, "move_request"=>$date)));
			// mail for customer to update paket
				$to = $email;

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
				  Permitaan pindah paket ke : '.$upgrade_paket.'<br/>
				  Tanggal permintaan : '.$tgl0.' '.$month0.' '.$thn0.'</p>
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
				$headers .= 'Cc: cs@groovy.id, billing@groovy.id' . "\r\n";

				$kirimemail=mail($to, $subject, $message, $headers);		
	if ($update_user && $kirimemail){ ?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/change-package'</script>
<?php } } ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#FC9822">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PACKAGE - MOVE</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<?php if($move_paket=="") { ?>
  					<div class="col-sm-12">
						<li class="list-group-item">
						  	Upgrade Paket : 
						  	<select class="form-control" id="upgrade_paket" name="upgrade_paket">
						  	<option disabled="true" selected="true">Selected Package</option>
						  	<?php
					$res = $col_package->find();
					foreach($res as $row) 
                      {  if($row['nama']<>$paket) {
                      	?>
					          <option><?php echo $row['nama']; ?></option>
					        <?php } } ?>
					        </select>
						</li>
						<li class="list-group-item">
							<div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>	
						</li>	
						<br/>	
						<input type="submit" class="btn btn-warning" name="upgrade" id="upgrade" value="Konfirmasi">	
						<br/>							
					</div>	
					<?php } elseif($move_paket<>"") { 
					  	$move_thn = substr($move_request, 0,4);
					    $move_bln = substr($move_request, 5,2);
						$move_tgl = substr($move_request, 8,10);
					    $move_month = bulan($move_bln); ?>
					<div class="col-sm-12">
						<li class="list-group-item">
						  	Upgrade Paket/Harga : <?php echo $move_paket.' / '.$move_harga; ?> 
						</li>
						<li class="list-group-item">
						  	Tanggal Permintaan : <?php echo $move_tgl.' '.$move_month.' '.$move_thn; ?> 
						</li>
						<br/>							
					</div>	
					<?php } ?>
 				</div>
			</div>
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#FC9822">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PACKAGE - HISTORI</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<div class="col-sm-12">
						<?php
						$res = $col_user->findOne(array("id_user"=>$id, "level"=>"0"));	
						foreach ($res['histori'] as $res_paket => $row_paket) {
							if($row_paket['hal']=="update"){
								$tanggal = $row_paket['tanggal_update'];
							  	$thn = substr($tanggal, 0,4);
							    $bln = substr($tanggal, 5,2);
								$tgl = substr($tanggal, 8,10);
							    $month = bulan($bln);
						?>
							<li class="list-group-item" style="border:2;">
								Tanggal Pindah Paket : <b><?php echo $tgl.' '.$month.' '.$thn; ?></b><br/>
								Paket Lama : <b><?php echo $row_paket['paket_lama']; ?></b><br/>
						    	Paket Baru : <b><?php echo $row_paket['paket_baru']; ?></b><br/>
							</li>	
						<?php } } ?>					
					</div>	
 				</div>
			</div>
		</div>
	</div>	
</section>