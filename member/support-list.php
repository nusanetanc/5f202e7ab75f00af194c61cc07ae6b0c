<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Support</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="20%">Nomor Id</th>
									      <th width="20%">Nama</th>
									      <th width="20%">Jabatan</th>
									      <th width="20%">No Telepon</th>
									      <th width="20">Detail Pekerjaan</th>
									    </tr>
									  </thead>
									  <?php
									  		$rslt = $col_user->find();
									  		foreach ($rslt as $row) {
									  			if($row['level']=="301" || $row['level']=="302"){
									   ?>
									  <tbody>
									  	<td><?php echo $row['id_user']; ?></td>
									  	<td><?php echo $row['nama']; ?></td>
									  	<td><?php if($row['level']=="301"){
									  				echo "Field Engineer";
									  		} elseif($row['level']=="302"){
									  				echo "Ass Field Engineer"; } ?></td>
									  	<td><?php echo $row['phone']; ?></td>
									  	<?php $nama_support=str_replace(" ", "000", $row['nama'])?>
									  	<td><a href="<?php echo $base_url_member; ?>/jobs/support/<?php echo $nama_support; ?>" class="btn btn-primary btn-xs">Show</a></td>
									  </tbody>
									  <?php } } ?>
								</table>
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
		  	</div>
		</div>
	</div>
</section>
