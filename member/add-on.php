<section>
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
					          <option>TV Chanel</option>
										<option>Video on Demand</option>
										<option>Cinema Box HD</option>
					      </select>
						</li>
						<?php
						$rslt = $col_service->find(array("group"=>addon))->sort(array("nama"));
						foreach ($rslt as $row) {
						?>
						<li class="list-group-item" style="border:2;">
							<p><strong><?php echo $row['nama']; ?></strong></p>
							<p class="text-primary"><?php echo $row['harga']; ?></p>
								<?php  $rslt0 = $col_service->findOne(array("nama"=>$row['nama']));
								foreach ($rslt0['layanan'] as $row0) { ?>
							<p>- <?php echo $row0; ?></p>
								<?php  } ?>
							<i class="fa fa-plus fa-lg" aria-hidden="true"></i>
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
</section>
<script type="text/javascript">
	  $(document).ready(function() {
    $("#select_addon").change(function(){
			var addon =  $("#select_addon").val();
	});
		});
		    $('.timer').countTo();
</script>
