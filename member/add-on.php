<section>
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
		<?php
			$addon="";
				if(isset($_POST['search_addon'])){
					$addon=$_POST['select_addon'];
				}
		?>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#FC9822">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Add On Service</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<div class="col-sm-12">
						<li class="list-group-item">
						  	Add On :
						  	<select class="form-control" id="select_addon" name="select_addon">
						  			<option disabled="true" selected="true">Selected Service</option>
										<?php
										$rslt0 = $col_service->find(array("paket"=>$paket))->sort(array("nama_group"));
										foreach ($rslt0 as $row0) {
										?>
					          <option><?php echo $row0['nama_group']; ?></option>
										<?php } ?>
					      </select><br/>
								<input type="submit" name="search_addon" id="search_addon" value="Submit" class="btn btn-warning btn-sm">
						</li>
						<?php
						$rslt = $col_service->find(array("group"=>$addon))->sort(array("nama"));
						foreach ($rslt as $row) {
						?>
						<li class="list-group-item" style="border:2;">
							<p><strong><?php echo $row['nama']; ?></strong></p>
							<p class="text-primary"><?php echo $row['harga']; ?></p>
								<?php  $rslt0 = $col_service->findOne(array("nama"=>$row['nama']));
								foreach ($rslt0['layanan'] as $row0) { ?>
							<p>- <?php echo $row0; ?></p>
								<?php  } ?>
							<a href="#" data-toggle="modal" data-target="#addon"><i class="fa fa-plus fa-lg" aria-hidden="true"></i></a>
						</li>
						<?php } ?>
						<br/>
					</div>
 				</div>
			</div>
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#FC9822">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Histori Add On Service</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<div class="col-sm-12">
					</div>
 				</div>
			</div>
		</div>
	</div>
</form>
<div class="modal" name="addon" id="addon">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">ADD ON</h4>
      </div>
      <div class="modal-body">
        <p><?php echo $service_name; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</section>
