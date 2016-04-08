<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">List Sales Groovy</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
	  				    	<?php if($level=="5"){ ?>
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="20%">Nomor Id</th>
									      <th width="20%">Nama</th>
									      <th width="20%">No Telepon</th>
									      <th width="20%">Email</th>
									      <th width="20%">Customer</th>
									    </tr>
									  </thead>
									  <?php 

									  		$rslt = $col_user->find(array("level"=>"501", "sm"=>$id));
									  		foreach ($rslt as $row) {
									   ?>
									  <tbody>
									  	<td><?php echo $row['id_user']; ?></td>
									  	<td><?php echo $row['nama']; ?></td>
									  	<td><?php echo $row['phone']; ?></td>
									  	<td><?php echo $row['email']; ?></td>
									  	<td><a href="<?php echo $base_url_member; ?>/customer-list/<?php echo $row['id_user']; ?>" class="btn btn-primary btn-xs">View</a></td>
									  </tbody>
									  <?php } ?>
								</table>	  
		  				    	<?php } elseif($level=="1"){ ?>
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="20%">Id</th>
									      <th width="40%">Nama</th>
									      <th width="40%">Customer</th>
									    </tr>
									  </thead>
									  <?php 

									  		$rslt = $col_user->find(array("level"=>"501"));
									  		foreach ($rslt as $row) {
									  			$count_customer=$col_user->find(array("id_sales"=>$row['id_user']))->count();
									   ?>
									  <tbody>
									  	<td><?php echo $row['id_user']; ?></td>
									  	<td><?php echo $row['nama']; ?></td>
									  	<td><?php echo $count_customer; ?></td>
									  </tbody>
									  <?php } ?>
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