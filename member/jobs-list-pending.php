<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#263238;">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Jobs List Pending</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  						<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
  							<?php
  							if($level=="301"){
  							$res = $col_history->find(array("field_engineer"=>$nama));
  						} elseif($level=="302"){
  							$res = $col_history->find(array("ass_field"=>$nama));
  						}
  								if(isset($_POST['view'])){
  									$jobs=$_POST['jobs'];
  									$status=$_POST['status'];
										header('Location:'.$base_url_member.'/report-jobs/'.$jobs.'/'.$status);
  								}
  							?>
	  						<div class="col-sm-4">
	  							<select class="form-control" id="jobs" name="jobs">
						          <option selected="true" disabled="true" value="">Jobs</option>
						          <option>pasang</option>
						          <option>maintenance</option>
						        </select>
	  						</div>
	  						<div class="col-sm-4">
	  							<select class="form-control" id="status" name="status">
						          <option selected="true" disabled="true" value="">Status</option>
						          <option>progress</option>
						          <option>done</option>
						        </select>
	  						</div>
	  						<div class="col-sm-4">
	  							<input name="view" id="view" type="submit" class="btn btn-default" value="View">
	  						</div>
	  					</form>
  					<br/>
					<div class="col-sm-12">
						<table class="table table-striped table-hover ">
						  <thead>
						    <tr>
						      <th width="20%">Customer</th>
						      <th class="desktop-only" width="25%">Location</th>
						      <th class="desktop-only" width="10%">Jobs</th>
						      <th class="desktop-only" width="10%">Status</th>
						      <th class="desktop-only" width="15%">Date Jobs</th>
						      <th class="desktop-only" width="15%">Support</th>
						      <th width="5%">Action</th>
						    </tr>
						  </thead>
						  <tbody>
						  <?php
									foreach($res as $row)
								{
								$tanggal = $row['tanggal_kerja'];
								$thn = substr($tanggal, 0,4);
								$bln = substr($tanggal, 5,2);
								$tgl = substr($tanggal, 8,10);
								$month = bulan($bln);
						  ?>
						    <tr>
						      <td><?php echo $row['id_cust'].' / '.$row['nama_cust'].' / '.$row['phone_customer']; ?></td>
						      <td class="desktop-only" ><?php echo $row['tempat_customer'].' / '.$row['keterangan_customer'].' / '.$row['alamat_customer'].' / '.$row['kota_customer']; ?></td>
						      <td class="desktop-only" ><?php echo $row['hal']; ?></td>
						      <td class="desktop-only" ><?php echo $row['status']; ?></td>
						      <td class="desktop-only" ><?php echo $tgl.' '.$month.' '.$thn; ?></td>
						      <td class="desktop-only" ><?php echo $row['field_engineer'].' / '.$row['ass_field']; ?></td>
						      <td><b><a href="<?php echo $base_url_member; ?>/report-jobs/<?php echo $row['_id']; ?>" class="btn btn-default btn-sm">Report</a></b></td>
						    </tr>
						<?php } ?>
						   </tbody>
						</table>
					</div>
 				</div>
			</div>
		</div>
	</div>
</section>
