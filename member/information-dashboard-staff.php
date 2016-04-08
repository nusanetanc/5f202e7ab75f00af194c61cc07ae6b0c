<section>
	<div class="col-sm-6" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel panel-default" >
    				<div class="panel-heading"><h4><b style="font-color:#e0e0e0;">INFORMATION</b></h4></div>
  				    <div class="panel-body">
		    					<table class="table table-striped table-hover ">
								<?php
									$res = $col_info->find()->limit(5);
									foreach($res as $row)
									  { 
									if($row['tempat']<>""){
										$tanggal = $row['tanggal_maintenance'];
										$thn = substr($tanggal, 0,4);
										$bln = substr($tanggal, 5,2);
										$tgl = substr($tanggal, 8,10);
										$month = bulan($bln);
								?>		    					
									  <tbody>
 										<td width="35%"><?php echo $tgl.' '.$month.' '.$thn; ?></td>
									    <td width="50%"><a href="<?php echo $base_url_member; ?>/complete-information/<?php echo $row['_id'] ?>" style=" text-decoration:none"> <?php echo $row['subject']; ?></td>
									    <td width="15%"> 
									    				<?php switch ($row['status']) {
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
								<a href="<?php echo $base_url_member; ?>/information" class="btn btn-link">View All</a>
					</div>
 				</div>
			</div>
		</div>
	</div>	
</section>