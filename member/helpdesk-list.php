<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">List Helpdesk Groovy</h3>
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
									      <th width="30%">Nama</th>
									      <th width="30%">No Telepon</th>
									    </tr>
									  </thead>
									  <?php
									  		$rslt = $col_user->find(array("level"=>"401"));
									  		foreach ($rslt as $row) {
									   ?>
									  <tbody>
									  	<td><?php echo $row['id_user']; ?></td>
									  	<td><?php echo $row['nama']; ?></td>
									  	<td><?php echo $row['phone']; ?></td>
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
