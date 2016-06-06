<?php if($status=="aktif"){ ?>
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
			// mail for customer to update paket
				$to = $email;

				$subject = 'Perubahan Layanan Groovy';

				$message = '
				<html>
					<body style="background-color:#ddd;padding:20px 0 150px 0;font-family:arial;font-size:15px;">
					    <div style="margin:0 auto;max-width:800px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
					        <div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
					            <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
					        </div>
					        <div style="padding:20px;color:#333;">
					            <p style="font-size:20px;font-weight:bold;line-height:1px">Permintaan perubahan layanan</p>
											<p>ID Customer : '.$id.'<br/>
											Nama : '.$nama.'<br/>
											Paket Aktif : '.$paket.'<br/>
											Email : '.$email.'<br/>
											Phone : '.$notelp.'<br/>
											Tempat : '.$tempat.' '.$keterangan.' '.$alamat.' '.$kota.'<br/>
											Paket : '.$upgrade_paket.'<br/>';
	if(!empty($_POST['addon'])){
							$arr = array($_POST['addon']);
								$items=implode((",", $arr);
							$message1 = '
											Layanan Tambahan : '.$items.'<br/>';
							$message2 = '
											Tanggal permintaan : '.$tgl0.' '.$month0.' '.$thn0.'</p>
											<br/>';
							$message3 = '
											<p>Billing kami akan melakukan pergantian data pembayaran anda, dengan pengiriman invoice baru pada email anda.</p>
											<p>Pergantian data pembayaran di lakukan pada saat hari dan jam kerja.</p>
											<p>Paket baru akan aktif : </p>
											<p>1. Masa waktu layanan lama telah habis.</p>
											<p>2. Setelah anda melakukan pembayaran sesuai dengan data pembayaran yang baru.</p>
											<p>3. Apabila tidak ada proraide pada layanan sebelumnya</p>
											<p>Terima kasih telah menjadi pelanggan groovy</p>
											<br/>
					        </div>
					        </div>
					    </div>
					</body>
					</html>
				';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				$headers .= 'From: groovy.id' . "\r\n";
				$kirimemail=mail($to, $subject, $message.$message1.$message2.$message3, $headers);
				$kirimemail1=mail($email_billing, $subject, $message.$message1.$message2, $headers);
				$kirimemail2=mail($email_cs, $subject, $message.$message1.$message2, $headers);
	if ($update_user && $kirimemail){ ?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/change-package'</script>
<?php } } ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#FC9822">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">CHANGE SERVICE</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<?php if($move_paket=="") { ?>
  					<div class="col-sm-12">
						<li class="list-group-item">
						  	Upgrade Paket :
						  	<select class="form-control" id="upgrade_paket" name="upgrade_paket">
						  	<option selected="true"><?php echo $paket; ?></option>
						  	<?php
					$res = $col_package->find();
					foreach($res as $row)
                      {  if($row['nama']<>$paket) {
                      	?>
					          <option><?php echo $row['nama']; ?></option>
					        <?php } } ?>
					        </select>
						</li>
							<ul style="text-align:left;" class="list-group"  name="updateaddon1" id="updateaddon1" disabled>
								<h5>Add On Service</h5>
									<?php
											$res = $col_service->find();
											foreach($res as $row)
																	{
													if($row['nama_group']=="Cinema Box HD" || $row['nama_group']=="TV Chanel"){
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
						  	Upgrade Paket/Harga : <?php echo $move_paket.' / '.rupiah($move_harga); ?>
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
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">HISTORI SERVICE</h3>
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
<?php } elseif($status=="unaktif" || $status=="registrasi"){ ?>
	<script type="" language="JavaScript">
	document.location='<?php echo $base_url; ?>/member'</script>
	<?php } ?>
<script>
 $(document).ready(function(){
	 var p =  $("#upgrade_paket").val();
	 if(p == "Groovy Home 500" || p == "Groovy Home 800"){
		 $("#updateaddon1").hide();
		 $("#updateaddon2").show();
	 } else if(p == "Groovy Home 1700"){
		 $("#updateaddon1").show();
		 $("#updateaddon2").hide();
	 } else {
		 $("#updateaddon1").hide();
		 $("#updateaddon2").hide();
	 }
			$("#upgrade_paket").change(function(){
				var p =  $("#upgrade_paket").val();
			if(p == "Groovy Home 500" || p == "Groovy Home 800"){
				$("#updateaddon1").hide();
				$("#updateaddon2").show();
			} else if(p == "Groovy Home 1700"){
				$("#updateaddon1").show();
				$("#updateaddon2").hide();
			} else {
				$("#updateaddon1").hide();
				$("#updateaddon2").hide();
			}
		}) });
</script>
