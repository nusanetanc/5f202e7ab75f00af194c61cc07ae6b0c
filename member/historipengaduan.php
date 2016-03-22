										  	
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#F1453C">
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
										  	  $res = $col_ticket->find(array("id_user"=>$id))->sort(array("tanggal"));
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
									      <td><a href="<?php echo $base_url_member; ?>/?hal=pengaduan&c=<?php echo $row['idchat'] ?>" style=" text-decoration:none"><?php echo $row['subject']; ?><a></td>
									      <?php $action = $row['status'];
										         switch ($action) { 
										         	case close: ?>
										         <td><span class="label label-success">Terselesaikan</span></td>
											<?php 	break;
												 	case open: ?>
										         <td><span class="label label-warning">On Progrress</span></td>
											<?php  	break;
													case solved: ?>
										         <td><span class="label label-warning">Solved</span></td>										         
											<?php break;
														 } ?>
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
