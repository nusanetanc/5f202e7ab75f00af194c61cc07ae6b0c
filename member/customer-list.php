<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">List Support Groovy</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row"> 
	  				    	<div class="col-sm-12">
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="35%">Customer</th>
									      <th width="35%">Tempat</th>
									      <th width="10%">Status</th>
									      <th width="5%">Detail</th>
									    </tr>
									  </thead>
									<?php 
										  	if ($level=="501"){
										  		$sales=$id;
											}elseif($level=="5"){
												$sales=$_GET['sales'];
											}
											  		$rslt = $col_user->find(array("level"=>"0", "id_sales"=>$sales, "registrasi"=>"sales"));
										  		foreach ($rslt as $row) {
									   ?>
									  <tbody>
									  	<td><?php echo $row['id_user'].' / '.$row['nama'].' / '.$row['phone'].' / '.$row['email']; ?></td>
									  	<td><?php echo $row['tempat'].' / '.$row['alamat'].' / '.$row['kota'].' / '.$row['keterangan']; ?></td>
									  	<td><?php echo $row['status']; ?></td>
									  	<td><a href="<?php echo $base_url_member; ?>/customer-profile&id_cust=<?php echo $row['id_user']; ?>" class="btn btn-primary btn-xs">Show</a></td>
									  </tbody>
									  <?php } $res_aktif = $col_user->find(array("level"=>"0", "id_sales"=>$sales, "registrasi"=>"sales", "status"=>"aktif"))->count(); 
									  		  $res_registrasi = $col_user->find(array("level"=>"0", "id_sales"=>$sales, "registrasi"=>"sales", "status"=>"registrasi"))->count(); 
									  		  $res_konregistrasi = $col_user->find(array("level"=>"0", "id_sales"=>$sales, "registrasi"=>"sales", "status"=>"konfirmasi registrasi"))->count(); 
									  ?>
								</table>
								<h6 style="font-weight:600;">Jumlah Customer (aktif : <?php echo $res_aktif; ?> ), (registrasi : <?php echo $res_registrasi; ?> ), (Konfirmasi registrasi : <?php echo $res_konregistrasi; ?> )</h6>	  
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
		  	</div>
		</div>
	</div>
</section>		  				    	