<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">List User Staff Groovy</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="10%">Nomor Id</th>
									      <th width="20%">Nama</th>
									      <th width="20%">No Telepon</th>
									      <th width="20%">Email</th>
									      <th width="20%">Jabatan</th>
									      <th width="10%"></th>
									    </tr>
									  </thead>
									  <?php

									  		$rslt = $col_user->find()->sort(array("level"));
									  		foreach ($rslt as $row) {
									  			if($row['level']<>"0" && $row['level']<>"7"){
									   ?>
									  <tbody>
									  	<td><?php echo $row['id_user']; ?></td>
									  	<td><?php echo $row['nama']; ?></td>
									  	<td><?php echo $row['phone']; ?></td>
									  	<td><?php echo $row['email']; ?></td>
									  	<td><?php
									  			$level_share=$row['level'];
												$lvl = lev($level_share);
									  	echo $lvl; ?></td>
									  	<td><a href="" data-toggle="modal" data-target="#confirmdelete<?php echo $row['id_user']; ?>"><i class="fa fa-trash-o"></i></a></td>
									  </tbody>
									      <form  action="<?php $_SERVER['PHP_SELF'] ?>"  method="post">
									      	<?php
									      		if(isset($_POST['deleteuser'])){
									      			$delete_user = $col_user->remove(array("id_user"=>$row['id_user']));
									      		}
									      	?>
										  	<div class="modal" name="confirmdelete<?php echo $row['id_user']; ?>" id="confirmdelete<?php echo $row['id_user']; ?>">
											  <div class="modal-dialog">
											    <div class="modal-content">
											      <div class="modal-header">
											        <h4 class="modal-title">Delete User <?php echo $row['id_user'].' '.$row['nama'].' '.$lvl; ?></h4>
											      </div>
											      <div class="modal-footer">
											        <input name="deleteuser" id="deleteuser" type="submit" class="btn btn-default" data-dismiss="modal" value="Delete"/>
											        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cancel</button>
											      </div>
											    </div>
											  </div>
											</div>
										   </form>
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
