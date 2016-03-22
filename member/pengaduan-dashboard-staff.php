<section>
	<div class="col-sm-12 col-md-12 col-lg-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel panel-default" >
    				<div class="panel-heading"><h4><b style="font-color:#e0e0e0;">PENGADUAN</b></h4></div>
  				    <div class="panel-body">
		    					<table class="table table-striped table-hover ">	    					
										 <tbody>
									  		  <?php
									  		  if($level=="2"){
										  	  $res = $col_ticket->find(array("kategori"=>"Billing"))->sort(array("tanggal"));
										  	}elseif($level=="3" || $level=="4" || $level=="401"){
										  		$res = $col_ticket->find(array("kategori"=>"TV", "kategori"=>"Internet"))->sort(array("tanggal"));
										  	}
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
										         switch ($action) { 
										         	case close: ?>
										         <td><span class="label label-success">Terselesaikan</span></td>
											<?php 	break;
												 	case open: ?>
										         <td><span class="label label-warning">On Progrress</span></td>
											<?php  	break;
													case solved: ?>
										         <td><span class="label label-primary">Solved</span></td>										         
											<?php break;
														 } ?>
									    </tr>
									   </tbody>
								<?php } ?>	  
								</table> 
					</div>
 				</div>
			</div>
		</div>
	</div>	
</section>