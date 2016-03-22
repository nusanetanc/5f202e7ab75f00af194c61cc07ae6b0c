<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">List Tempat Groovy</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="30%">Nama Tempat</th>
									      <th width="30%">Alamat</th>
									      <th width="25%">Kota</th>
									      <th width="15%"></th>
									    </tr>
									  </thead>
									  <?php 

									  		$rslt = $col_location->find()->sort(array("name"));
									  		foreach ($rslt as $row) {
									   ?>
									  <tbody>
									  	<td><?php echo $row['name']; ?></td>
									  	<td><?php echo $row['place']; ?></td>
									  	<td><?php echo $row['city']; ?></td>
									  	<td><a href="" data-toggle="modal" data-target="#editdata"><i class="fa fa-pencil-square-o"></i></a>
									  	<a href="" data-toggle="modal" data-target="#confirmdelete"><i class="fa fa-trash-o"></i></a></td>
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
<div class="modal" name="confirmdelete" id="confirmdelete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Delete User ID </h4>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-default" data-dismiss="modal" value="Delete"/>
        <button type="button" class="btn btn-primary">Cancel</button>
      </div>
    </div>
  </div>
</div>
</section>
</section>		  				    	