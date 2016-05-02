<section>
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
		<?php
		$date=date("Y/m/d");
		$date_days=date("d");
		$date_month=date("m");
		$date_years=date("Y");
		$month_date = bulan($date_month);
			$addon="";
				if(isset($_POST['search_addon'])){
					$addon=$_POST['select_addon'];
				}
				if(isset($_POST['add'])){
					$addon=$_POST['addon'];
					$msg=array(
								"tanggal"=>$date,
								"add_on"=>$addon,
								"status"=>"permintaan"
							);
					$pushaddon = $col_user->update(
													array("id_user"=>$id),
										   		array('$push'=>array("addon"=>$msg)));
			  $to="yudi.nurhandi@nusa.net.id";
		    $subject = 'Request Add On';

		    $message = '
		    <html>
		    <body>
		      <p>Customer : '.$id.'/'.$nama.'<br/>
						 Paket:'.$paket.'<br/>
		      	 Add On : '.$addon.'<br/>
		      </p>
		      <br/>
		      <br/>
		      <p>groovy.id</p>
		    </body>
		    </html>
		    ';

		    $headers  = 'MIME-Version: 1.0' . "\r\n";
		    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    		$headers .= 'From: '.$email . "\r\n";
		    $headers .= 'Cc: cs@groovy.id' . "\r\n";

		    $email_sup=mail($to, $subject, $message, $headers);

				// mail for customer to addon
					$to1 = $email;

					$subject1 = 'Add On Service';

					$message1 = '
					<html>
						<body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
								<div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
										<div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
												<a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
										</div>
										<div style="padding:20px;color:#333;">
												<p style="font-size:20px;font-weight:bold;line-height:1px">Permintaan Pindah Paket</p>
												<p>ID Customer : '.$id.'<br/>
												Nama : '.$nama.'<br/>
												Paket Aktif : '.$paket.'<br/>
												Email : '.$email.'<br/>
												Phone : '.$notelp.'<br/>
												Tempat : '.$tempat.' '.$keterangan.' '.$alamat.' '.$kota.'<br/>
												Permitaan penambahan layanan : '.$addon.'<br/>
												Tanggal permintaan : '.$date_days.' '.$month_date.' '.$date_years.'</p>
												<br/>
												<p>Silahkan untuk melakukan pembayaran agar kami bisa memproses untuk penambahan layanan, info pembayaran terdapat pada billing di halaman member anda.</p>
												<p>Paket baru akan aktif, setelah masa waktu paket lama habis.</p>
												<br/>
										</div>
										</div>
								</div>
						</body>
						</html>
					';
					$headers1  = 'MIME-Version: 1.0' . "\r\n";
					$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

					$headers1 .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
					$headers1 .= 'Cc: cs@groovy.id, billing@groovy.id' . "\r\n";

					$kirimemail=mail($to1, $subject1, $message1, $headers1);
				if($pushaddon && $email_sup && $kirimemail){ ?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/add-on'</script>
			<?php	} } ?>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#FC9822">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Add On Service</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<div class="col-sm-12">
						<li class="list-group-item">
						  	<select class="form-control" id="select_addon" name="select_addon">
										<?php
										$rslt0 = $col_service->find(array("paket"=>$paket))->sort(array("nama_group"));
										foreach ($rslt0 as $row0) {
										?>
					          <option><?php echo $row0['nama_group']; ?></option>
										<?php } ?>
					      </select><br/>
								<input type="submit" name="search_addon" id="search_addon" value="Submit" class="btn btn-warning btn-sm">
						</li>
						<?php
						$rslt = $col_service->find(array("group"=>$addon))->sort(array("nama"));
						foreach ($rslt as $row) {
						?>
						<li class="list-group-item" style="border:2;">
							<p><strong><?php echo $row['nama']; ?></strong></p>
							<p class="text-primary"><?php echo $row['harga']; ?></p>
								<?php  $rslt0 = $col_service->findOne(array("nama"=>$row['nama']));
								foreach ($rslt0['layanan'] as $row0) { ?>
							<p>- <?php echo $row0; ?></p>
								<?php  } ?>
						</li>
						<?php } $count_result = $rslt->count();
						if ($count_result<>"0") { ?>
						<li class="list-group-item" style="border:2;">
							<select class="form-control" id="addon" name="addon">
									<?php
									$rslt0 = $col_service->find(array("group"=>$addon))->sort(array("nama"));
									foreach ($rslt0 as $row0) {
									?>
									<option><?php echo $row0['nama']; ?></option>
									<?php } ?>
							</select><br/>
							<input type="submit" name="add" id="add" value="Add On" class="btn btn-warning btn-sm">
						</li>
						<?php } ?>
						<br/>
					</div>
 				</div>
			</div>
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#FC9822">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Histori Add On Service</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<div class="col-sm-12">
							<ul class="list-group">
								<?php
								$res = $col_user->findOne(array("id_user"=>$id));
								foreach ($res['addon'] as $rin_addon => $rao) {
									$thn1 = substr($rao['tanggal'], 0,4);
									$bln1 = substr($rao['tanggal'], 5,2);
									$tgl1 = substr($rao['tanggal'], 8,10);
									$month1 = bulan($bln1); ?>
							  <li class="list-group-item">
									Tanggal : <strong><?php echo $tgl1.' '.$month1.' '.$thn1; ?></strong><br/>
									Add On Service : <strong><?php echo $rao['add_on']; ?></strong><br/>
									Status : <strong><?php echo $rao['status']; ?></strong>
							  </li>
								<?php } ?>
							</ul>
						</div>
 				</div>
			</div>
		</div>
	</div>
</form>
</section>
