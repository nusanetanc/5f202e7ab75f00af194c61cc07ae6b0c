
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-body"  style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">List Customer</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
					<div class="col-sm-12">	
						<table class="table table-striped table-hover ">
						  <thead>
						    <tr>
						      <th width="10%">ID Cust</th>
						      <th width="25%">Customer</th>
						      <th width="10">No Virtual</th>
						      <th width="10">Pembayaran</th>
						      <th width="25%">Waktu Akhir Pembayaran</th>
						      <th width="10%">Status</th>
						      <th width="10%">Detail</th>
						    </tr>
						  </thead>
						  <?php
					$res = $col_user->find(array("level"=>"0"));
					foreach($res as $row) 
                      { if($row['no_virtual']<>""){ 
                      		$thn = substr($row['tanggal_akhir'], 0,4);
						    $bln = substr($row['tanggal_akhir'], 5,2);
							$tgl = substr($row['tanggal_akhir'], 8,10);
							$month = bulan($bln);
							$date_days = date("d");
							$date_years = date("Y");
							$date_month = date("m");
                      	?>
						  <tbody  style="position:center;">
						<?php  if ($date_days<=$tgl && $date_month<=$bln && $date_years<=$thn){ 
						    '<tr class="warning">' } elseif($row['status']=="tidak aktif"){'<tr class="info">'} elseif($row['status']=="registrasi"){'<tr class="success">'} else{'<tr>'} ?>
						      <td><?php echo $row['id_user']; ?></td>
						      <td><?php echo $row['nama'].' / '. $row['phone'].' / '.$row['email']; ?></td>
						      <td><?php echo $row['no_virtual']; ?></td>
						      <td><?php echo $row['pembayaran']; ?></td>
						      <td><?php echo $tgl.' '.$month.' '.$thn; ?></td>
						      <td><?php echo $row['status']; ?></td>
						      <td><b><a href="<?php echo $base_url_member; ?>/verification-payment/<?php echo $row['id_user']; ?>" class="btn btn-primary btn-xs">Show</a></b></td>						      
						    </tr>
						   </tbody>
					<?php } } ?>	   
						</table>    
					</div>	
 				</div>
			</div>
		</div>
	</div>	
</section>