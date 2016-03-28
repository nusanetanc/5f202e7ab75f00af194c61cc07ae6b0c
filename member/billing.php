<?php
if ($level=="0"){ 
												$thn_akhir = substr($tanggal_akhir, 0,4);
												$bln_akhir = substr($tanggal_akhir, 5,2);
												$tgl_akhir = substr($tanggal_akhir, 8,10);
												$month_akhir = bulan($bln_akhir);

												$thn_aktif = substr($tanggal_aktivasi, 0,4);
												$bln_aktif = substr($tanggal_aktivasi, 5,2);
												$tgl_aktif = substr($tanggal_aktivasi, 8,10);
												$month_aktif = bulan($bln_aktif);
	?>
	?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
				<div class="panel-body" style="background-color:#FF6D20;">
					<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">BILLING</h3>
				</div>
				<div class="panel-body">
					<br/>
					<div class="col-sm-12">	
						  <fieldset>
						<p>No Virtual Pembayaran : <strong><?php echo $no_virtual; ?></strong>.</p><br/>
						<p>Tanggal Mulai Aktif : <strong><?php echo $tgl_aktif.' '.$month_aktif.' '.$thn_aktif; ?></strong>.</p><br/>
						<p>Tanggal Akhir Pembayaran : <strong><?php echo $tgl_akhir.' '.$month_akhir.' '.$thn_akhir; ?></strong>.</p><br/>
						</div>
							<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="50%">Deskripsi Pembayaran</th>
									      <th width="50%">Harga</th>
									    </tr>
									  </thead>
									  <tbody>
 										<td>Paket <?php echo $paket; ?></td>
 										<td><?php echo $harga; ?></td>
									  </tbody>
								</table> 
						<p>Proraide : <strong><?php echo $proraide; ?></strong>.</p><br/>
						<?php 
							$total_harga = $harga-$proraide;
						?>
						<p>Total Harga : <strong><?php echo $total_harga.'000,-'; ?></strong>.</p><br/>	
						</fieldset>
				</div>
			</div>				
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">History Payment</h3>
  				</div>
  					<br/>
  				    <div class="panel-body">
  				    	<div class="panel panel-default">
		    					<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="20%">Tanggal Pembayaran</th>
									      <th width="20%">Tanggal Konfirmasi</th>
									      <th width="30%">Deskripsi</th>
									      <th width="15%">Total</th>
									    </tr>
									  </thead>
									  <?php
										$res = $col_user->findOne(array("id_user"=>$id, "level"=>$level));	
										foreach ($res['payment'] as $byr => $payment) {
												$tanggal = $payment['tanggal_bayar'];
											  	$thn = substr($tanggal, 0,4);
											    $bln = substr($tanggal, 5,2);
												$tgl = substr($tanggal, 8,10);
											    $month = bulan($bln);
												    $tanggal1 = $payment['tanggal_konfirmasi'];
												  	$thn1 = substr($tanggal1, 0,4);
												    $bln1 = substr($tanggal1, 5,2);
													$tgl1 = substr($tanggal1, 8,10);
												    $month1 = bulan($bln1);
										?>
									  <tbody>
 										<td><?php echo $tgl.' '.$month.' '.$thn; ?></td>
 										<td><?php echo $tgl1.' '.$month1.' '.$thn1; ?></td>
									    <td>Pembayaran Paket <?php echo $payment['paket']; ?> </td>
									    <td><?php echo $payment['harga'].',-'; ?></td>
									  </tbody>
									  <?php } ?>
								</table> 
						</div>
					</div>
 				</div>
			</div>
		</div>
	</div>	
</section>
<?php } else if ($level=="1") { ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Billing</h3>
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
									  		$revenue=0;
											$res_revenue = $col_revenue->find();
												foreach ($res_revenue as $row_revenue) {
																	$month_revenue = substr($row_revenue['date'], 5,2);
																	$year_revenue = substr($row_revenue['date'], 0,4);
																	if ($month_revenue==$month){
																		$revenue=$revenue+$row_revenue['total'];
																	}
																}							

									   ?>
									   <tbody>
									  		<td>Data Bulan</td>
									  		<td><?php echo $bln.' '.$year; ?></td>
									  </tbody>
									  <tbody>
									  		<td>Total Pendapatan</td>
									  		<td><?php echo $revenue.'.000,-'; ?></td>
									  </tbody>
								</table>  
							</div>	
						</div>	  
			</div>
		</div>
 	</div>
 <?php } ?>
