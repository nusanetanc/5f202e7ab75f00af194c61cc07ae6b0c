<?php if ($level=="0"){ ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#9E9E9E;" >
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">INFORMASI</h3>
  				</div>
  					<br/>
  				    <div class="panel-body">
		    					<table class="table table-striped table-hover ">
								<?php
									$res = $col_info->find()->sort(array("tanggal_update"=>-1));
									foreach($res as $row)
									  { 
									  	if($row['tempat']==$tempat || $row['tempat']=="All" || $row['for']==$id) {
										$tanggal = $row['tanggal_update'];
										$thn = substr($tanggal, 0,4);
										$bln = substr($tanggal, 5,2);
										$tgl = substr($tanggal, 8,10);
										$month = bulan($bln);
								?>		    					
									  <tbody>
 										<td width="20%"><?php echo $tgl.' '.$month.' '.$thn; ?></td>
									    <td width="50%"><a href="<?php echo $base_url_member; ?>/?hal=complete-information&i=<?php echo $row['id_info'] ?>" style="text-decoration:none"> <?php echo $row['subject']; ?></td>
									    <td width="30%"> 
									    				<?php switch ($row['status']) {
									    						case 'on schedule':
									    				?> 
									    				<span class="label label-primary">
									    				<?php 	break; 		
									    						case 'on progress':
									    				 ?> 
									    				<span class="label label-warning">
									    				<?php 	break;
									    						case 'done':
									    					?>
									    				<span class="label label-success">	
									    					<?php break; 
									    					} ?>

									    				<?php echo $row['status']; ?></span></td>
									  </tbody>
								<?php } } ?>	  
								</table> 
					</div>
 				</div>
			</div>
		</div>
	</div>	
</section>
<?php } else if($level=="1" || $level=="3" || $level=="4" || $level=="401") { ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#9E9E9E;" >
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">INFO MAINTENANCE</h3>
  				</div>
  				<div class="panel-body">
  					<?php if ($level=="401"){ ?>
  					<br/>
					<a href="<?php echo $base_url_member; ?>/?hal=write-maintenance-info" class="btn" role="button" style="background-color:#757575; color:#fff">Tulis Info Maintenance</a>
					<?php } ?>
					<br/>
					<table class="table table-striped table-hover">
						<thead><tr><th></th></tr></thead>
											<?php 
												$res = $col_info->find();
												foreach($res as $row)
												  { 
												  	if(!(empty($row['tanggal_maintenance']))){
									  			$tanggal=$row['tanggal_maintenance'];
									  			$thn = substr($tanggal, 0,4);
											    $bln = substr($tanggal, 5,2);
												$tgl = substr($tanggal, 8,10);
												$month = bulan($bln);
					 ?> 
						<tbody>
						    <tr>
						      <td>
						      <h4><b><?php echo $row['tempat'].', '.$row['kota']; ?></b></h4>
						      <h5><?php switch ($row['status']) {
																case 'on schedule':
									    				?> 
									    				<span class="label label-primary">
									    				<?php 	break; 		
									    						case 'on progress':
									    				 ?> 
									    				<span class="label label-warning">
									    				<?php 	break;
									    						case 'done':
									    					?>
									    				<span class="label label-success">	
									    					<?php break; 
									    					} ?>

									<?php echo $row['status']; ?></span><a href="<?php echo $base_url_member; ?>/?hal=complete-information&i=<?php echo $row['id_info']; ?>" style="text-decoration:none"><b><?php echo ' '.$row['subject']; ?></b></a></h5>
						      <h5><?php echo 'Tanggal Maintenance : '.$tgl.' '.$month.' '.$thn; ?></h5>
						      </td>
						    </tr>
						    <?php } } ?> 
						</tbody>   
					</table>	    
 				</div>
			</div>
		</div>
	</div>	
</section>
<?php } ?>