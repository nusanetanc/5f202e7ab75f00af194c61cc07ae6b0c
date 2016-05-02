<section>
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
		<?php
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
				if($pushaddon && $email_sup){ ?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/add-on'</script>
			</php	} } ?>
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
								foreach ($res['addon'] as $rin_addon => $rao) { ?>
							  <li class="list-group-item">
									Tanggal : <?php echo $rao['tanggal']; ?>
									Add On Service : <?php echo $rao['add_on']; ?>
									Status : <?php echo $rao['status']; ?>
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
