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
		if ($move_paket<>""){
			$paket=$move_paket;
			$harga=$move_harga;
		}
	?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
				<div class="panel-body" style="background-color:#FF6D20;">
					<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">BILLING - TAGIHAN</h3>
				</div>
				<div class="panel-body">
						<div class="col-sm-12">
							<fieldset>
								<ul class="list-group">
  								<li class="list-group-item">
										<p>No Virtual Pembayaran : <strong><?php echo $no_virtual; ?></strong>.</p>
									</li>
								  <li class="list-group-item">
								  	<h4 class="list-group-item-heading"><strong>#<?php echo $paket; ?></strong></h4>
										<p>Tanggal Mulai Aktif : <strong><?php echo $tgl_aktif.' '.$month_aktif.' '.$thn_aktif; ?></strong>.</p>
										<p>Tanggal Akhir Pembayaran : <strong><?php echo $tgl_akhir.' '.$month_akhir.' '.$thn_akhir; ?></strong>.</p>
										<p>Harga : <strong><?php echo rupiah($harga); ?></strong></p>
										<p>Prorate : <strong><?php echo $proraide.'.00'; ?></strong></p>
										<?php $total_harga = $harga-$proraide; ?>
										<p>Total Pembayaran : <strong><?php echo rupiah($total_harga).'.000'; ?></strong></p>
								  </li>
									<?php $res = $col_addon->find(array("id_user"=>$id));
												foreach ($res as $add) {
													$thn_aktif0 = substr($add['tanggal_aktif'], 0,4);
													$bln_aktif0 = substr($add['tanggal_aktif'], 5,2);
													$tgl_aktif0 = substr($add['tanggal_aktif'], 8,10);
													$month_aktif0 = bulan($bln_aktif0);

													$thn_akhir0 = substr($add['tanggal_aktif'], 0,4);
													$bln_akhir0 = substr($add['tanggal_akhir'], 5,2);
													$tgl_akhir0 = substr($add['tanggal_akhir'], 8,10);
													$month_akhir0 = bulan($bln_akhir0);
													 ?>
									<li class="list-group-item">
										<h4 class="list-group-item-heading"><strong class="text-primary">#<?php echo $add['layanan']; ?></strong></h4>
										<?php if($add['status']=="unaktif"){ ?>
										<span class="label label-warning"><?php echo $add['status']; ?></span>
									<?php } elseif($add['status']=="aktif"){ ?>
										<span class="label label-primary"><?php echo $add['status']; ?></span>
										<p>Tanggal Mulai Aktif : <strong><?php echo $tgl_aktif0.' '.$month_aktif0.' '.$thn_aktif0; ?></strong>.</p>
										<p>Tanggal Akhir Aktif : <strong><?php echo $tgl_akhir0.' '.$month_akhir0.' '.$thn_akhir0; ?></strong>.</p>
										<?php } ?>
										<p>Harga : <strong><?php echo rupiah($add['harga']); ?></strong></p>
										<p>Prorate : <strong><?php echo rupiah($add['proraide']); ?></strong></p>
										<?php $total_harga = $add['harga']-$add['proraide']; ?>
										<p>Total Pembayaran : <strong><?php echo rupiah($total_harga); ?></strong></p>
									</li>
								<?php } ?>
								</div>
						</fieldset>
					</div>
				</div>
			</div>
			<div class="panel" style="border:0px;" >
				<div class="panel-body" style="background-color:#FF6D20;">
					<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">BILLING - DATA</h3>
				</div>
  				    <div class="panel-body">
  				    	<ul class="list-group">
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

  									<li class="list-group-item" style="border:2;">
										Tanggal Pembayaran : <b><?php echo $tgl.' '.$month.' '.$thn; ?></b><br/>
										Tanggal Konfirmasi Billing : <b><?php echo $tgl1.' '.$month1.' '.$thn1; ?></b><br/>
								    	Pembayaran Paket : <b><?php echo $payment['paket']; ?></b><br/>
								    	Total Harga : <b><?php echo rupiah($payment['harga']).',-'; ?></b>
									</li>
									  <?php } ?>
						</ul>
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
  				<div class="panel-heading" style="background-color:#1b5e20">
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
																	if ($month_revenue==$month && $year_revenue==$year){
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
</section>
 <?php } ?>
