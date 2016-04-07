<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#F1453C">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">List Jobs Supoort <?php echo $_GET['status']; ?></h3>
  				</div>
  				<div class="panel-body">
  					<br/>
					<div class="col-sm-12">	
						<table class="table table-striped table-hover ">
						  <thead>
						    <tr>
						      <th width="20%">Customer</th>
						      <th width="20%">Tanggal Jobs</th>
						      <th width="20%">Location</th>
						      <th width="10%">Jobs</th>
						      <th width="20%">Support</th>
						      <th width="10%"></th>
						    </tr>
						  </thead>
						  <?php
						  	if(isset($_GET['status'])){
								$res = $col_history->find(array("status"=>$_GET['status']))->sort(array("tanggal_kerja"));
								foreach($res as $row)
								{ 

									$thn_kerja = substr($row['tanggal_kerja'], 0,4);
									$bln_kerja = substr($row['tanggal_kerja'], 5,2);
									$tgl_kerja = substr($row['tanggal_kerja'], 8,10);
									$month_kerja = bulan($bln_kerja);
						?>
						  <tbody>
						    <tr>
						      <td><?php echo $row['id_cust'].' / '.$row['nama_cust'].' / '.$row['phone_customer']; ?></td>
						      <td><?php echo $tgl_kerja.' '.$bln_kerja.' '.$thn_kerja; ?></td>
						      <td><?php echo $row['tempat_customer'].', '.$row['keterangan_customer'].', '.$row['kota_customer']; ?></td>
						      <td><?php echo $row['hal']; ?></td>
						      <td><?php echo $row['field_engineer'].', '.$row['ass_field']; ?></td>
						      <td><b><a href="<?php echo $base_url_member; ?>/report-jobs/<?php echo $row['_id']?>/" class="btn btn-primary btn-sm">view</a></b></td>						      
						    </tr>
						   </tbody>
						<?php
							} }
						?>  
						<?php
						  	if(isset($_GET['support'])){
								$res = $col_history->find()->sort(array("tanggal_kerja"));
								foreach($res as $row)
								{  
									$support = str_replace('-',' ', $_GET['support']);
									if($row['field_engineer']==$support || $row['ass_field']==$support)
										{
										$thn_kerja = substr($row['tanggal_kerja'], 0,4);
										$bln_kerja = substr($row['tanggal_kerja'], 5,2);
										$tgl_kerja = substr($row['tanggal_kerja'], 8,10);
										$month_kerja = bulan($bln_kerja);
						?>
						  <tbody>
						    <tr>
						      <td><?php echo $row['id_cust'].' / '.$row['nama_cust'].' / '.$row['phone_customer']; ?></td>
						      <td><?php echo $tgl_kerja.' '.$bln_kerja.' '.$thn_kerja; ?></td>
						      <td><?php echo $row['tempat_customer'].', '.$row['keterangan_customer'].', '.$row['kota_customer']; ?></td>
						      <td><?php echo $row['hal']; ?></td>
						      <td><?php echo $row['field_engineer'].', '.$row['ass_field']; ?></td>
						      <td><b><a href="<?php echo $base_url_member; ?>/report-jobs/<?php echo $row['_id']?>/" class="btn btn-primary btn-sm">view</a></b></td>						      
						    </tr>
						   </tbody>
						<?php
							} } }
						?> 
						</table>    
					</div>	
 				</div>
			</div>
		</div>
	</div>	
</section>