<?php if($level=="3"){ ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#F1453C">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">CUSTOMER - <?php echo $_GET['status']; ?></h3>
  				</div>
  				<div class="panel-body">
  					<br/>
					<div class="col-sm-12">
						<table class="table table-striped table-hover ">
						  <thead>
						    <tr>
						      <th width="10%">ID Cust</th>
						      <th width="20%">Customer</th>
						      <th width="15%">Paket</th>
						      <th width="35%">Location</th>
						      <th width="20%">Action</th>
						    </tr>
						  </thead>
						  <?php
						  $status=$_GET['status'];
								$res = $col_user->find(array("status"=>$status, "level"=>"0"))->sort(array("tanggal_registrasi"));
								foreach($res as $row)
								{
						?>
						  <tbody>
						    <tr>
						      <td><?php echo $row['id_user']; ?></td>
						      <td><?php echo $row['nama'].' / '.$row['phone'].' / '.$row['email']; ?></td>
						      <td><?php echo $row['paket']; ?></td>
						      <td><?php echo $row['tempat'].', '.$row['keterangan'].', '.$row['kota']; ?></td>
						      <?php if($status=="registrasi"){ ?>
						      <td><b><a href="<?php echo $base_url_member; ?>/detail-pemasangan/<?php echo $row['id_user']; ?>" class="btn btn-warning btn-sm">Pasang</a></b></td>
						      <?php } elseif($status=="aktif"){ ?>
						      <td><b><a href="<?php echo $base_url_member; ?>/detail-maintenance/<?php echo $row['id_user']; ?>" class="btn btn-warning btn-sm">Maintanance/Update</a></b></td>
						      <?php } elseif($status=="unaktif"){ ?>
						      <td><b><a href="<?php echo $base_url_member; ?>/detail-bongkar/<?php echo $row['id_user']; ?>" class="btn btn-warning btn-sm">Bongkar</a></b></td>
						      <?php } ?>
						    </tr>
						   </tbody>
						<?php
							}
						?>
						</table>
					</div>
 				</div>
			</div>
		</div>
	</div>
</section>
<?php } elseif($level=="401"){ ?>
	<section>
		<div class="col-sm-9" style="font-family:Arial;">
			<div class="list-group">
				<div class="panel" style="border:0px;" >
	  				<div class="panel-heading" style="background-color:#F1453C">
	    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">CUSTOMER - <?php echo $_GET['status']; ?></h3>
	  				</div>
	  				<div class="panel-body">
	  					<br/>
						<div class="col-sm-12">
							<table class="table table-striped table-hover ">
							  <thead>
							    <tr>
							      <th width="20%">ID Cust</th>
							      <th width="50%">Customer</th>
							      <th width="20%">Status</th>
							      <th width="10%">Action</th>
							    </tr>
							  </thead>
							  <?php
									$res = $col_user->find(array("level"=>"0"))->sort(array("status"));
									foreach($res as $row)
									{
							?>
							  <tbody style="height:10em; overflow:scroll;"/>
							    <tr>
							      <td><?php echo $row['id_user']; ?></td>
							      <td><?php echo $row['nama'].' / '.$row['phone'].' / '.$row['email']; ?></td>
							      <td>
											<?php if($row['status']=="aktif"){ ?>
										<span class="label label-default"><?php echo $row['status']; ?></span>
											<?php } elseif($row['status']=="registrasi"){ ?>
										<span class="label label-primary"><?php echo $row['status']; ?></span>
											<?php } elseif($row['status']=="unaktif"){ ?>
										<span class="label label-success"><?php echo $row['status']; ?></span>
											<?php } ?>
										</td>
							      <td><b><a href="<?php echo $base_url_member; ?>/detail-customer/<?php echo $row['id_user']; ?>" class="btn btn-warning btn-sm">Detail</a></b></td>
							    </tr>
							   </tbody>
							<?php
								}
							?>
							</table>
						</div>
	 				</div>
				</div>
			</div>
		</div>
	</section>
	<?php } ?>
