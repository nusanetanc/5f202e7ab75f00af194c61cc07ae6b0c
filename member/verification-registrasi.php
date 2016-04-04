<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Verifikasi Registrasi</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form>
	  				    <div class="row"> 
	  				    	<div class="col-sm-12">
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="35%">Customer</th>
									      <th width="35%">Tempat</th>
									      <th width="10%">Status</th>
									      <th width="15%">Sales</th>
									      <th width="5%">Detail</th>
									    </tr>
									  </thead>
									<?php 
											  		$rslt = $col_user->find(array("level"=>"0", "registrasi"=>"sales", "status"=>"permintaan registrasi"));
										  		foreach ($rslt as $row) {
									   ?>
									  <tbody>
									  	<td><?php echo $row['id_user'].' / '.$row['nama'].' / '.$row['phone'].' / '.$row['email']; ?></td>
									  	<td><?php echo $row['tempat'].' / '.$row['alamat'].' / '.$row['kota'].' / '.$row['keterangan']; ?></td>
									  	<td><?php echo $row['status']; ?></td>
									  	<td><?php echo $row['nama_sales']; ?></td>
									  	<td><a href="<?php echo $base_url_member; ?>/?hal=customer-profile/<?php echo $row['id_user']; ?>" class="btn btn-primary btn-xs">Show</a></td>
									  </tbody>
									  <?php } ?>
								</table>	  
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
		  	</div>
		</div>
	</div>
</section>		  				    	