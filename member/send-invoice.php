<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-body"  style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">SEND INVOICE</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
					<div class="col-sm-12">
						<table class="table table-striped table-hover">
						  <thead>
						    <tr>
						      <th width="40%">Customer</th>
						      <th width="40">NO Virtual Acount</th>
						      <th width="20%"></th>
						    </tr>
						  </thead>
						  <?php
					$res = $col_user->find(array("level"=>"0"));
					foreach($res as $row)
                      {
                      	if($row['no_virtual']==""){
                      	?>
						  <tbody>
						    <tr>
						      <td><a href="<?php echo $base_url_member.'/customer-profile/'.$row['id_user']; ?>"><?php echo $row['id_user']; ?></a> / <?php echo $row['nama']; ?> <span class="label label-success"> New Customer</span></td>
						      <td><?php echo $kode_perusahaan.$row['id_user']; ?></td>
									<td><a href="<?php echo $base_url_member.'/invoice-customer/'.$row['id_user']; ?>">Kirim Invoice</a></td>
						    </tr>
						   </tbody>
							 <?php } }
							 $res = $col_user->find(array("level"=>"0"));
							 foreach($res as $row)
													 {
							  if($row['no_virtual']<>""){
												 ?>
							 <tbody>
								 <tr>
									 <td><a href="<?php echo $base_url_member.'/verification-payment/'.$row['id_user']; ?>"><?php echo $row['id_user']; ?></a> / <?php echo $row['nama']; ?></td>
									 <td><?php echo $kode_perusahaan.$row['id_user']; ?></td>
									 <td><a href="<?php echo $base_url_member.'/invoice-customer/'.$row['id_user']; ?>">Kirim Invoice</a></td>
								 </tr>
								</tbody>
					<?php } } ?>
						</table>
					</div>
 				</div>
 			  </form>
			</div>
		</div>
	</div>
</section>
