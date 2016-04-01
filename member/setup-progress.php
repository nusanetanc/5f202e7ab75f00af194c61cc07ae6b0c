<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#F1453C">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PEMASANGAN</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
					<div class="col-sm-12">	
						<table class="table table-striped table-hover ">
						  <thead>
						    <tr>
						      <th width="20%">Customer</th>
						      <th width="15%">Paket</th>
						      <th width="35%">Location</th>
						      <th width="20%">Jobs</th>
						    </tr>
						  </thead>
						  <?php
								$res = $col_history->find(array("status"=>"progress", "hal"=>"pasang"))->sort(array("tanggal_kerja"));
								foreach($res as $row)
								{ 
						?>
						  <tbody>
						    <tr>
						      <td><?php echo $row['id_cust'].' / '.$row['nama_cust'].' / '.$row['phone_customer']; ?></td>
						      <td><?php echo $row['paket']; ?></td>
						      <td><?php echo $row['tempat_customer'].', '.$row['keterangan_customer'].', '.$row['kota_customer']; ?></td>
						      <td><b><a href="<?php echo $base_url_member; ?>/report-jobs&id=<?php echo $row['id_cust']?>&status=progress&job=pasang" class="btn btn-success">Progress</a></b></td>						      
						    </tr>
						   </tbody>
						<?php
							}
						?>   
						</table>    
					</div>	
 				</div>
			</div>
		</div>
	</div>	
</section>