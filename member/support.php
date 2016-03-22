<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#757575">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Pemasangan/Maintenance</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<div class="col-sm-4">
			  				    	<select class="form-control" id="select">
							          <option>All</option>
							          <option>Pasang</option>
							          <option>Maintenance</option>
							        </select>
							    </div>      
					    		<div class="col-sm-4">
			  				      <select name="month" id="month" class="form-control" id="select">
								  <option value="" selected="true" disabled="true">Select Month</option>
						          <option value="01">Januari</option>
						          <option value="02">Februari</option>
						          <option value="03">Maret</option>
						          <option value="04">April</option>
						          <option value="05">Mei</option>
						          <option value="06">Juni</option>
						          <option value="07">Juli</option>
						          <option value="08">Agustus</option>
						          <option value="09">September</option>
						          <option value="10">Oktober</option>
						          <option value="11">November</option>
						          <option value="12">Desember</option>
							        </select>
						        </div>
						       	<div class="col-sm-3">
							        <select name="year" id="year" class="form-control" id="select">
							          <option value="" selected="true" disabled="true">Select Years</option>
							          <option>2016</option>
							          <option>2017</option>
							          <option>2018</option>
							          <option>2019</option>
							          <option>2020</option>
							          <option>2021</option>
							          <option>2022</option>
							          <option>2022</option>
							          <option>2023</option>
							          <option>2024</option>
							          <option>2025</option>
							        </select>
							    </div>
							   	<div class="col-sm-1">
							   		<input name="search" id="search" type="submit" class="btn btn-primary" value="Search">
							   	</div> 
							</div>
						</div>	
						</form>   	
						<?php
				    	$month=$_POST['month'];
				    	$year=$_POST['year'];
				    	if (empty($month)){
				    		$month=date(m);
				    	}
				    	if (empty($year)){
				    		$year=date(Y);
				    	}
				    	$bln= bulan($month);
				    	?>
					    <div class="col-sm-12">      				    		
  				    		<br/>
		    					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
									 <thead>
									    <tr>
									      <th width="40%">Customer</th>
									      <th width="40%">Tempat</th>
									      <th width="20%">Support/Tanggal</th>
									    </tr>
									  </thead>
										<?php
										$res = $col_user->find(array("status"=>"aktif","level"=>"0"));
										foreach($res as $row)
										  { 
										  	$month_pasang = substr($row['tanggal_pasang'], 5,2);
											$year_pasang = substr($row['tanggal_pasang'], 0,4);
												if ($month_pasang==$month){
													$thn = substr($tanggal, 0,4);
												    $bln = substr($tanggal, 5,2);
													$tgl = substr($tanggal, 8,10);
												    $month = bulan($bln);
											?>	
									  <tbody>
									  	<td><?php echo $row['id_user'].' - '.$row['nama'].' - '.$row['email'].' - '.$row['phone']; ?></td>
									  	<td><?php echo $row['tempat'].' - '.$row['alamat'].' - '.$row['kota'].' - '.$row['keterangan']; ?></td>
									  	<td><?php echo $row['support'].' - '.$row['tanggal_pasang']; ?></td>
									  </tbody>
									  <?php } } ?>
								</table> 							
						</div>	
					</div>
 				</div>
			</div>
		</div>
	</div>	
</section>