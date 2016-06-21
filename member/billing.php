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
									<?php
									$total=0;
									$res = $col_user->findOne(array("id_user"=>$id));
									foreach ($res['payment_data'] as $payment => $pay) {
										if ($pay<>null){
										?>
									<li class="list-group-item">
										<p><h4><?php echo $pay['layanan']; ?><h4></p><p>
												<span class="badge">Harga : <?php echo rupiah($pay['harga']); ?></span>
												<span class="badge">Prorate : <?php echo rupiah($pay['prorate']); ?></span>
												<span class="badge">Sub Total : <?php echo rupiah($pay['total']); ?></span>
										</p>
									</li>
									<?php $total = $total+$pay['total'];
								 				} } ?>
									<li class="list-group-item active">
										<p><h4>Total Harga : <?php echo rupiah($total); ?><h4></p>
										<p><h4>PPN 10 % : <?php echo rupiah($total*0.1); ?><h4></p>
									</li>
									<li class="list-group-item active">
										<p><h3>Total Pembayaran : <?php echo rupiah($total*0.1+$total); ?><h3></p>
									</li>
								</ul>
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
				<form method="post">
				<div class="row">
					<div class="col-sm-12">
						<table class="table table-striped table-hover ">
					 <thead>
							<tr>
								<th width="10%">No</th>
								<th width="30%">Pembayaran</th>
								<th width="30%">Konfirmasi</th>
								<th width="30%"></th>
							</tr>
						</thead>
						<?php
							$res = $col_payment->find(array("id_user"=>$id));
						foreach ($res as $byr) {
							$thn_konfirmasi = substr($byr['tanggal_konfirmasi'], 0,4);
							$bln_konfirmasi = substr($byr['tanggal_konfirmasi'], 5,2);
							$tgl_konfirmasi = substr($byr['tanggal_konfirmasi'], 8,10);
							$month_konfirmasi = bulan($bln_konfirmasi);

							$thn_bayar = substr($byr['tanggal_bayar'], 0,4);
							$bln_bayar = substr($byr['tanggal_bayar'], 5,2);
							$tgl_bayar = substr($byr['tanggal_bayar'], 8,10);
							$month_bayar = bulan($bln_bayar);
						 ?>
						<tbody class="pic-container down">
							<td><?php echo $byr['no']; ?></td>
							<td><?php echo $tgl_bayar.' '.$month_bayar.' '.$thn_bayar; ?></td>
							<td><?php echo $tgl_konfirmasi.' '.$month_konfirmasi.' '.$thn_konfirmasi; ?></td>
							<td><a href="#" data-toggle="modal" data-target="#<?php echo $byr['no']; ?>">Deskripsi</a></td>
						</tbody>
						<div class="modal" name=<?php echo $byr['no']; ?> id=<?php echo $byr['no']; ?>>
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title">Data Pembayaran</h4>
									</div>
									<div class="modal-body">
											<div class="panel panel-default">
												<?php foreach ($byr['pembayaran'] as $pmbyr) { ?>
													<div class="panel-body">
														<strong><?php print_r($pmbyr['deskripsi']); ?></strong>=>Harga<b>(<?php print_r(rupiah($pmbyr['harga'])); ?>)</b> - Prorate<b>(<?php print_r(rupiah($pmbyr['prorate'])); ?>)</b> = Subtotal<b>(<?php print_r(rupiah($pmbyr['total_harga'])); ?>)</b>
													</div>
													<?php } ?>
												</div>
									</div>
									<div class="modal-footer">
										<p>Total Tagihan : <b><?php echo rupiah($byr['total_tagihan']); ?></b></p>
										<p>PPN 10% : <b><?php echo rupiah($byr['ppn']); ?></b></p>
										<p>Total Pembayaran : <b><?php echo rupiah($byr['total_pembayaran']); ?></b></p>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
				</table>
					</div>
			 </div>
			 </form>
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
									  		<td><?php echo rupiah($revenue); ?></td>
									  </tbody>
								</table>
							</div>
						</div>
			</div>
		</div>
 	</div>
</section>
 <?php } ?>
