<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel panel-danger" >
  				<div class="panel-heading">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PENGADUAN</h3>
  				</div>
  					<br/>
  				    <div class="panel-body">
  				    	<div class="panel panel-default">
		    					<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="15%">Date</th>
									      <th width="65%">Subject</th>
									      <th width="30%">Status</th>
									    </tr>
									  </thead>
									  <tbody>
									  		  <?php
										  	  $res = $col_ticket->find()->sort(array("tanggal"));
											  foreach($res as $row)
											  { 
											  	$tanggal = $row['dateopen'];
											  	$thn = substr($tanggal, 0,4);
											    $bln = substr($tanggal, 5,2);
												$tgl = substr($tanggal, 8,10);
											    $month = bulan($bln);
											  	?>
 										<tr>
									      <td><?php echo $tgl.' '.$month.' '.$thn; ?></td>
									      <td><a style=" text-decoration:none" href="<?php echo $base_url_member; ?>/?hal=chatpengaduan&c=<?php echo $row['idchat'] ?>"><?php echo $row['subject']; ?><a></td>
									      <?php $action = $row['status'];
										         if($action == "close"){ ?>
										         <td><span class="label label-success">Terselesaikan</span></td>
																<?php } 
											else if ($action == "open")
																		{ ?>
										         <td><span class="label label-warning">On Progrress</span></td>
																	<?php } ?>
									    </tr>
									    	  <?php
									    		} ?>
									   </tbody>
								</table> 
						</div>
					</div>
 				</div>
			</div>
		</div>
	</div>	
</section>
