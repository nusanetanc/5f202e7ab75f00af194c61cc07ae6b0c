<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF5722">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">HISTORI</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body" style="height:550px; overflow:auto;">
									<table class="table table-striped table-hover">
											<?php
												$res = $col_user->findOne(array("id_user"=>$id));
											foreach ($res['histori'] as $histori => $log) {
												$thn_log = substr($log['tanggal'], 0,4);
												$bln_log = substr($log['tanggal'], 5,2);
												$tgl_log = substr($log['tanggal'], 8,10);
												$month_log = bulan($bln_log);
											 ?>
											<tbody class="pic-container down">
												<td><?php echo $tgl_log.' '.$month_log.' '.$thn_log; ?></td>
												<td><?php echo $log['hal']; ?></td>
												<td><?php echo $log['keterangan']; ?></td>
											</tbody> <?php } ?>
										</tbody>
									</table>
		  				 </div>
		  	</div>
		</div>
	</div>
</section>
