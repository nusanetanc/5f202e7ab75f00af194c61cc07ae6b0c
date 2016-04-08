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
	  				    	<?php if($level=="3"){ ?>
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
								<?php } else if($level=="1"){ ?>
								<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="10%">Nomor Id</th>
									      <th width="20%">Nama</th>
									      <th width="20%">Jabatan</th>
									      <th width="10%">Pasang</th>
									      <th width="10">Upddate</th>
									      <th width="10">Bongkar</th>
									    </tr>
									  </thead>
									  <?php 
									  		$rslt = $col_user->find();
									  		foreach ($rslt as $row) {
									  			if($row['level']=="301" || $row['level']=="302"){
									  	$count_pasang=$col_history->find(array("fieldengineer"=>$row['nama'], "hal"=>"pasang"))->count();
									  	$count_update=$col_history->find(array("fieldengineer"=>$row['nama'], "hal"=>"update"))->count();
									  	$count_bongkar=$col_history->find(array("fieldengineer"=>$row['nama'], "hal"=>"bongkar"))->count();
									  	$count_pasang0=$col_history->find(array("ass_field"=>$row['nama'], "hal"=>"pasang"))->count();
									  	$count_update0=$col_history->find(array("ass_field"=>$row['nama'], "hal"=>"update"))->count();
									  	$count_bongkar0=$col_history->find(array("ass_field"=>$row['nama'], "hal"=>"bongkar"))->count();
									   ?>
									  <tbody>
									  	<td><?php echo $row['id_user']; ?></td>
									  	<td><?php echo $row['nama']; ?></td>
									  	<?php if($row['level']=="301"){ ?>
									  			<td><?php echo "Field Engineer"; ?></td>
									  			<td><?php echo $count_pasang; ?></td>
									  			<td><?php echo $count_update; ?></td>
									  			<td><?php echo $count_bongkar; ?></td>
									  	<?php } elseif($row['level']=="302"){ ?>
									  			<td><?php echo "Ass Field Engineer"; ?></td>
											  	<td><?php echo $count_pasang0; ?></td>
											  	<td><?php echo $count_update0; ?></td>
											  	<td><?php echo $count_bongkar0; ?></td>
										<?php } ?>
									  </tbody>
									  <?php } } ?>
								</table>
								<?php } ?>	  	  
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
		  	</div>
		</div>
	</div>
</section>		  				    	