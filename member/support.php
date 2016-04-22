<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Support</h3>
  				</div>
  					<br/>
	  				    <div class="panel-body">
			    			<form method="post">
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
							<div class="col-lg-6">
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
						        <br/>
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
						        <br/>
						        <input name="search" id="search" type="submit" class="btn btn-primary" value="Search">
						        <br/>
						    </div>
							</form>
  				    		<div class="col-sm-6">
	  				    		<table class="table table-striped table-hover ">
									  <?php
									  		$jml_pasang=0;
												$jml_maintenance=0;
												$jml_update=0;
												$jml_bongakar=0;
											$res_history = $col_histrory->find();
												foreach ($res_history as $row_history) {
																	$month_kerja = substr($row_history['tanggal_kerja'], 5,2);
																	$year_kerja = substr($row_history['tanggal_kerja'], 0,4);
																	$month_update = substr($row_history['tanggal_update'], 5,2);
																	$year_update = substr($row_history['tanggal_update'], 0,4);
																	if ($month_kerja==$month && $year_kerja==$year && $row_history['hal']=="pasang"){
																		$jml_pasang=$jml_pasang+1;
																	}
																	if ($month_kerja==$month && $year_kerja==$year && $row_history['hal']=="maintenance"){
																		$jml_pasang=$jml_pasang+1;
																	}
																	if ($month_update==$month && $year_update==$year && $row_history['hal']=="update"){
																		$jml_pasang=$jml_pasang+1;
																	}
																	if ($month_kerja==$month && $year_kerja==$year && $row_history['hal']=="bongkar"){
																		$jml_pasang=$jml_pasang+1;
																	}
																}

									   ?>
									   <tbody>
									  		<td>Data Bulan</td>
									  		<td><?php echo $bln.' '.$year; ?></td>
									  </tbody>
									  <tbody>
									  		<td>Total Pasang</td>
									  		<td><?php echo $revenue; ?></td>
									  </tbody>
										<tbody>
									  		<td>Total Update</td>
									  		<td><?php echo $revenue; ?></td>
									  </tbody>
										<tbody>
									  		<td>Total Maintenance</td>
									  		<td><?php echo $revenue; ?></td>
									  </tbody>
										<tbody>
									  		<td>Total Bongkar</td>
									  		<td><?php echo $revenue; ?></td>
									  </tbody>
								</table>
							</div>
						</div>
			</div>
		</div>
 	</div>
<section>
