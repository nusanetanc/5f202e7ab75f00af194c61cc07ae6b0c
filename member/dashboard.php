<?php if ($level=="0") { ?>
<section>
	<div class="col-sm-12 col-md-12 col-lg-9" style="font-family:Arial;">
		<div class="row">
			<div class="col-sm-12 col-md-4 col-lg-4">
				<a href="<?php echo $base_url_member; ?>/pengaduan" style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#F1453C;">
					  <h4 style="color:white;"><b>PENGADUAN</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-flag fa-5x"></i></b>
					  </div>
					</div>
				</a>	
			</div>	
			<div class="col-sm-12 col-md-4 col-lg-4" >
				<a href="<?php echo $base_url_member; ?>/billing"  style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#FF6D20;">
					  <h4 style="color:white;"><b>BILLING</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-file-text fa-5x"></i></b>
					  </div>
					</div>
				</a>
			</div>	
			<div class="col-sm-12 col-md-4 col-lg-4">
				<a href="<?php echo $base_url_member; ?>/change-package"  style=" text-decoration:none">
					<div class="well well-lg background-btn-yellow" style=" text-decoration:none">
					  <h4 style="color:white;"><b>CHANGE PACKAGE</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-arrow-up fa-5x"></i></b>
					  </div>
					</div>
				</a>	
			</div>	
		</div>
	</div>
	<?php include('../member/information-dashboard-customer.php'); ?>	
</section>	
<?php } else if ($level=="1") { ?>
<section>
	<div class="col-sm-12 col-md-12 col-lg-9" style="font-family:Arial;">
		<div class="row">
			<div class="col-sm-6">
				<div class="well well-lg" style="background-color:#FF5F21;">
				  <h3 style="color:white;"><b>Customer</b></h3>
				  	<div class="text-center">
					  	<div class="row">
					  		<div class="col-sm-4">
								<h5 style="color:white;"><b>Total Registrasi</b></h5>
				  					<div class="text-center">
				  						<?php
											$res = $col_user->find(array("tanggal_aktivasi"=>"","level"=>"0","status"=>"registrasi"));
											$length = $res->count();
															  { 

									   ?>
								  		<b style="color:white; font-size:3em;"><?php echo $length; ?></b>
								  		<?php } ?>
								  	</div>
							</div> 						
					  		<div class="col-sm-4">
								<h5 style="color:white;"><b>Total Close</b></h5>
				  					<div class="text-center">
								  		<?php
											$res = $col_user->find(array("level"=>"0","aktif"=>"1","status"=>"close"));
											$length = $res->count();
															  { 

									   ?>
								  		<b style="color:white; font-size:3em;"><?php echo $length; ?></b>
								  		<?php } ?>
								  	</div>
							</div> 						
					  		<div class="col-sm-4">
								<h5 style="color:white;"><b>Total Customer</b></h5>
				  					<div class="text-center">
								  		<?php
											$res = $col_user->find(array("level"=>"0","aktif"=>"1","status"=>"aktif"));
											$length = $res->count();
															  { 

									   ?>
								  		<b style="color:white; font-size:3em;"><?php echo $length; ?></b>
								  		<?php } ?>
								  	</div>
							</div> 							
					 	</div>
					</div>
				</div>	
			</div>	
			<div class="col-sm-3" >
				<a href="<?php echo $base_url_member; ?>/pengaduan"  style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#d32f2f ;">
					  <h3 style="color:white;"><b>Total Pengaduan</b></h3>
					  <br/>
					  <div class="text-center">
					  					<?php
											$res = $col_ticket->find();
											$length = $res->count();
															  { 

									   ?>
								  		<b style="color:white; font-size:3em;"><?php echo $length; ?></b>
								  		<?php } ?>
					  </div>
					  <br/>
					</div>
				</a>
			</div>	
			<div class="col-sm-3" >
				<a href="<?php echo $base_url_member; ?>/information"  style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#546e7a;">
					<br/>
					  <h4 style="color:white;"><b>Total Maintenance</b></h4>
					  <br/>
					  <div class="text-center">
					  	<?php
						$res = $col_info->find(array("status"=>"on progrress"));
						$length = $res->count();
										  { 
				   ?>
			  		<b style="color:white; font-size:3em;"><?php echo $length; ?></b>
			  		<?php } ?>
					  </div>
					  <br/>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>	
<section>
<div class="col-sm-9">
	<div class="row">	
		<section>
			<div class="col-sm-6">
				<div id="chart_div1" style="height: 270px; width: auto;"></div>	
			</div>
		</section>
		<?php include('../member/information-dashboard-staff.php'); ?>	
		<div class="col-sm-3">
		</div>
		<section>
			<div class="col-sm-9">
				<div id="chart_div2" style="height: 300px; width: auto;"></div>	
			</div>
		</section>	
	</div>	
</div>
</section>			
<?php } else if ($level=="2") { ?>
<section>
	<div class="col-sm-12 col-md-12 col-lg-9" style="font-family:Arial;">
		<div class="row">
			<div class="col-sm-4">
				<a href="<?php echo $base_url_member; ?>/send-invoice" style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#263238;">
					  <h4 style="color:white;"><b>New Customer</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-check-square-o fa-5x"></i></b>
					  </div>
					</div>
				</a>	
			</div>
			<div class="col-sm-4">
				<a href="<?php echo $base_url_member; ?>/payment" style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#263238;">
					  <h4 style="color:white;"><b>List Customer</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-navicon fa-5x"></i></b>
					  </div>
					</div>
				</a>	
			</div>	
		</div>
	</div>
	<?php include('../member/pengaduan-dashboard-staff.php'); ?>
</section>	
<?php } else if ($level=="3") { ?>
<section>
	<div class="col-sm-12 col-md-12 col-lg-9" style="font-family:Arial;">
		<div class="row">	
			<div class="col-sm-4">
				<div class="well well-lg" style="background-color:#FF6D20;">
				  <h5 style="color:white;"><b>SUPPORT</b></h5>
				  	<div class="text-center">
				  	<br/>
					  	<div class="row">
					  		<div class="col-sm-5">
					  			<a href="<?php echo $base_url_member; ?>/support-add" style=" text-decoration:none">
								  	<b style="color:white; font-size:2em;"><i class="fa fa-user-plus fa-2x"></i></b>
								  	<h5 style="color:white;">Tambah Support</h5>
								</a>  	
							</div>	
							<div class="col-sm-2">								
							</div>						
							<div class="col-sm-5">  
								<a href="<?php echo $base_url_member; ?>/support-list" style=" text-decoration:none">
								  	<b style="color:white; font-size:2em;"><i class="fa fa-users fa-2x"></i></b>
								  	<h5 style="color:white;">Lihat Semua Support</h5>
								</a>  	
							</div>  	
					 	</div>
					</div>
				</div>	
			</div>		
			<div class="col-sm-4">
				<div class="well well-lg background-btn-red">
				  <h5 style="color:white;"><b>Jobs</b></h5>
				  	<div class="text-center">
				  	<br/>
					  	<div class="row">
							<div class="col-sm-4">  
								<a href="<?php echo $base_url_member; ?>/setup-progress" style=" text-decoration:none">
									<h5 style="color:white;">PROGRESS</h5>
								  	<?php
										$res = $col_history->find(array("status"=>"progress", "hal"=>"pasang"));
										$length = $res->count();
														  { 

								   ?>
								  	<b style="color:white; font-size:3em;"><?php echo $length; ?></b>
								  	<?php } ?>
								</a>  	
							</div>  						
							<div class="col-sm-4">  
								<a href="<?php echo $base_url_member; ?>/setup-done" style=" text-decoration:none">
									<h5 style="color:white;">DONE</h5>
								  	<?php
										$res = $col_history->find(array("status"=>"done", "hal"=>"pasang"));
										$length = $res->count();
														  { 

								   ?>
								  	<b style="color:white; font-size:3em;"><?php echo $length; ?></b>
								  	<?php } ?>
								</a>  	
							</div>  	
					 	</div>
					</div>
				</div>	
			</div>		
		</div>
	</div>
	<?php include('../member/pengaduan-dashboard-staff.php'); ?>	
</section>	
<?php } else if ($level=="301" || $level=="302") { ?>
<section>
	<div class="col-sm-12 col-md-12 col-lg-9" style="font-family:Arial;">
		<div class="row">
			<div class="col-sm-4">
				<a href="<?php echo $base_url_member; ?>/jobs-list-pending" style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#263238;">
					  <h4 style="color:white;"><b>JOBS</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-list-alt fa-5x"></i></b>
					  </div>
					</div>
				</a>	
			</div>
			<div class="col-sm-4">
				<a href="<?php echo $base_url_member; ?>/information" style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#263238;">
					  <h4 style="color:white;"><b>INFORMATION</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-bell fa-5x"></i></b>
					  </div>
					</div>
				</a>	
			</div>	
		</div>
	</div>
</section>	
<?php } else if ($level=="4") { ?>
<section>
	<div class="col-sm-12 col-md-12 col-lg-9" style="font-family:Arial;">
		<div class="row">
			<div class="col-sm-12 col-md-4 col-lg-4">
				<a href="<?php echo $base_url_member; ?>/pengaduan" style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#FF3224;">
					  <h4 style="color:white;"><b>PENGADUAN</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-flag fa-4x"></i></b>
					  </div>
					</div>
				</a>	
			</div>	
			<div class="col-sm-4">
				<a href="<?php echo $base_url_member; ?>/information" style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#263238;">
					  <h4 style="color:white;"><b>INFORMATION</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-bell fa-4x"></i></b>
					  </div>
					</div>
				</a>	
			</div>	
			<div class="col-sm-4">
				<div class="well well-lg" style="background-color:#FF6D20;">
				  <h5 style="color:white;"><b>HELPDESK</b></h5>
				  	<div class="text-center">
				  	<br/>
					  	<div class="row">
					  		<div class="col-sm-5">
					  			<a href="<?php echo $base_url_member; ?>/helpdesk-add" style=" text-decoration:none">
								  	<b style="color:white; font-size:2em;"><i class="fa fa-user-plus fa-2x"></i></b>
								  	<h5 style="color:white;">Tambah Helpsdesk</h5>
								</a>  	
							</div>	
							<div class="col-sm-2">								
							</div>						
							<div class="col-sm-5">  
								<a href="<?php echo $base_url_member; ?>/helpdesk-list" style=" text-decoration:none">
								  	<b style="color:white; font-size:2em;"><i class="fa fa-users fa-2x"></i></b>
								  	<h5 style="color:white;">Lihat Semua Helpdesk</h5>
								</a>  	
							</div>  	
					 	</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<?php include('../member/pengaduan-dashboard-staff.php'); ?>
</section>	
<?php } else if ($level=="401") { ?>
<section>
	<div class="col-sm-12 col-md-12 col-lg-9" style="font-family:Arial;">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-6">
				<a href="<?php echo $base_url_member; ?>/pengaduan" style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#FF3224;">
					  <h4 style="color:white;"><b>PENGADUAN</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-flag fa-5x"></i></b>
					  </div>
					</div>
				</a>	
			</div>	
			<div class="col-sm-12 col-md-6 col-lg-6" >
				<a href="<?php echo $base_url_member; ?>/information"  style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#9E9E9E;">
					  <h4 style="color:white;"><b>INFORMATION</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-list fa-5x"></i></b>
					  </div>
					</div>
				</a>
			</div>	
		</div>
	</div>
	<?php include('../member/pengaduan-dashboard-staff.php'); ?>
</section>	
<?php } else if ($level=="5") { ?>
<section>
	<div class="col-sm-12 col-md-12 col-lg-9" style="font-family:Arial;">
		<div class="row">	
			<div class="col-sm-12 col-md-6 col-lg-4">
				<a href="<?php echo $base_url_member; ?>/verification-registrasi" style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#FF3E23;">
					  <h4 style="color:white;"><b>Verifikasi</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa fa-check-square-o fa-5x"></i></b>
					  </div>
					</div>
				</a>	
			</div>
			<div class="col-sm-12 col-md-6 col-lg-4">
				<div class="well well-lg" style="background-color:#FF6D20;">
				  <h5 style="color:white;"><b>SALES</b></h5>
				  	<div class="text-center">
				  	<br/>
					  	<div class="row">
					  		<div class="col-sm-5">
					  			<a href="<?php echo $base_url_member; ?>/sales-add" style=" text-decoration:none">
								  	<b style="color:white; font-size:2em;"><i class="fa fa-user-plus fa-2x"></i></b>
								  	<h5 style="color:white;">Tambah Sales</h5>
								</a>  	
							</div>	
							<div class="col-sm-2">								
							</div>						
							<div class="col-sm-5">  
								<a href="<?php echo $base_url_member; ?>/sales-list" style=" text-decoration:none">
								  	<b style="color:white; font-size:2em;"><i class="fa fa-users fa-2x"></i></b>
								  	<h5 style="color:white;">Lihat Semua Sales</h5>
								</a>  	
							</div>  	
					 	</div>
					</div>
				</div>	
			</div>	
		</div>
	</div>
</section>	
<?php } else if ($level=="501") { ?>
<section>
	<div class="col-sm-12 col-md-12 col-lg-9" style="font-family:Arial;">
		<div class="row">
			<div class="col-sm-12 col-md-4 col-lg-4">
				<a href="<?php echo $base_url_member; ?>/registration-add" style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#FF5A21;">
					  <h4 style="color:white;"><b>Registrasi</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-user-plus fa-5x"></i></b>
					  </div>
					</div>
				</a>	
			</div>	
			<div class="col-sm-12 col-md-4 col-lg-4">
				<a href="<?php echo $base_url_member; ?>/customer-list" style=" text-decoration:none">
					<div class="well well-lg" style="background-color:#FF3E23;">
					  <h4 style="color:white;"><b>List Customer</b></h4>
					  <div class="text-center">
					  	<b style="color:white; font-size:2em;"><i class="fa fa-list-alt fa-5x"></i></b>
					  </div>
					</div>
				</a>	
			</div>	
		</div>
	</div>
</section>	
<?php } else if ($level=="7") { ?>
<section>
	<div class="col-sm-12 col-md-12 col-lg-9" style="font-family:Arial;">
		<div class="row">
			<div class="col-sm-12 col-md-6 col-lg-4">
				<div class="well well-lg" style="background-color:#FF6D20;">
				  <h5 style="color:white;"><b>User Staff</b></h5>
				  	<div class="text-center">
				  	<br/>
					  	<div class="row">
					  		<div class="col-sm-5">
					  			<a href="<?php echo $base_url_member; ?>/user-add" style=" text-decoration:none">
								  	<b style="color:white; font-size:2em;"><i class="fa fa-user-plus fa-2x"></i></b>
								  	<h5 style="color:white;">Tambah User Staff</h5>
								</a>  	
							</div>	
							<div class="col-sm-2">								
							</div>						
							<div class="col-sm-5">  
								<a href="<?php echo $base_url_member; ?>/user-list" style=" text-decoration:none">
								  	<b style="color:white; font-size:2em;"><i class="fa fa-users fa-2x"></i></b>
								  	<h5 style="color:white;">Lihat Semua User Staff</h5>
								</a>  	
							</div>  	
					 	</div>
					</div>
				</div>	
			</div>	
			<div class="col-sm-12 col-md-6 col-lg-4">
				<div class="well well-lg" style="background-color:#FF6D21;">
				  <h5 style="color:white;"><b>Paket</b></h5>
				  	<div class="text-center">
				  	<br/>
					  	<div class="row">
					  		<div class="col-sm-5">
					  			<a href="<?php echo $base_url_member; ?>/package-add" style=" text-decoration:none">
								  	<b style="color:white; font-size:2em;"><i class="fa fa-cart-plus fa-2x"></i></b>
								  	<h5 style="color:white;">Tambah Paket</h5>
								</a>  	
							</div>	
							<div class="col-sm-2">								
							</div>						
							<div class="col-sm-5">  
								<a href="<?php echo $base_url_member; ?>/package-list" style=" text-decoration:none">
								  	<b style="color:white; font-size:2em;"><i class="fa fa-shopping-cart fa-2x"></i></b>
								  	<h5 style="color:white;">Lihat Semua Paket</h5>
								</a>  	
							</div>  	
					 	</div>
					</div>
				</div>	
			</div>
			<div class="col-sm-12 col-md-6 col-lg-4">
				<div class="well well-lg" style="background-color:#FF6D22;">
				  <h5 style="color:white;"><b>Tempat</b></h5>
				  	<div class="text-center">
				  	<br/>
					  	<div class="row">
					  		<div class="col-sm-5">
					  			<a href="<?php echo $base_url_member; ?>/location-add" style=" text-decoration:none">
								  	<b style="color:white; font-size:2em;"><i class="fa fa-map-marker fa-2x"></i></b>
								  	<h5 style="color:white;">Tambah Tempat</h5>
								</a>  	
							</div>	
							<div class="col-sm-2">								
							</div>						
							<div class="col-sm-5">  
								<a href="<?php echo $base_url_member; ?>/location-list" style=" text-decoration:none">
								  	<b style="color:white; font-size:2em;"><i class="fa fa-map-signs fa-2x"></i></b>
								  	<h5 style="color:white;">Lihat Semua Tempat</h5>
								</a>  	
							</div>  	
					 	</div>
					</div>
				</div>	
			</div>		
		</div>
	</div>
</section>	
<?php } ?>