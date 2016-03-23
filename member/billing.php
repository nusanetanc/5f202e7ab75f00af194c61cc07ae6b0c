<?php
if ($level=="0"){
	if($no_virtual=="" || $no_virtual==null){ ?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>'</script>
<?php	}
$date = date("Y/m/d");
	$thn = substr($date, 0,4);
	$bln = substr($date, 5,2);
	$tgl = substr($date, 8,10);
	$month = bulan($bln);
$thn1 = substr($tanggal_akhir, 0,4);
$bln1 = substr($tanggal_akhir, 5,2);
$tgl1 = substr($tanggal_akhir, 8,2);
$month1 = bulan($bln1);
?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">TAGIHAN PEMBAYARAN</h3>
  				</div>
  					<br/>
	  				    <div class="panel-body">
  				    	<div class="panel panel-default">
  				    		<div class="col-sm-5">
	  							<div class="well well-lg">
	 					 	<h5><b>Ditagihkan Kepada </b></h5>
	 					 	<br/>
	 					 	<h6><b>ID Pelanggan : <?php echo $id; ?></b></h6>
	 					 	<h6><b>Nama : <?php echo $nama; ?></b></h6>
	 					 	<h6><b>Email : <?php echo $email; ?></b></h6>
	 					 	<h6><b>Tempat : <?php echo $tempat.', '.$keterangan.', '.$alamat.', '.$kota; ?></b></h6>
								</div>
							</div>	
							 <div class="col-sm-5">
	  							<div class="well well-lg">
	 					 	<h5><b>Bayar Kepada </b></h5>
	 					 	<br/>
	 					 	<h6><b>PT Media Andalan Nusa </b></h6>
	 					 	<h6><b>Cyber Building 7th Floor, </b></h6>
	 					 	<h6><b>Jl Kuningan Barat,</b></h6>
	 					 	<h6><b>jakarta, Indonesia </b></h6>
								</div>
							</div>	
							<div class="col-sm-2">
								<img src="<?php echo $base_url; ?>/img/a.jpg" height="150px" width="150px"></img>
								<h1><b><?php echo $invoice; ?></b></h1>
							</div>
							<div class="col-sm-12">
							<h4>No Invoice : <b><?php echo $invoice; ?></b></h4>
							<h5>Tanggal Invoice : <b><?php echo $tgl.' '.$month.' '.$thn; ?></b></h5>
							<h5>Tanggal Jatuh Tempo : <b><?php echo $tgl1.' '.$month1.' '.$thn1; ?></b></h5>
							<br/>
							</div>
							<div class="col-sm-12">
								<table class="table table-striped table-hover ">
								  <thead>
								    <tr>
								      <th width="50%">Deskripsi</th>
								      <th width="50%">Jumlah</th>
								    </tr>
								  </thead>
								  <tbody>
								    <tr class="active">
								      <td><?php echo $paket. ' (1 Bulan)'; ?></td>
								      <td><?php echo $harga. ',-'; ?></td> 
								    </tr>
								  </tbody>
								</table>
								<div class="col-sm-7">
									<h5 style="text-align:right;"><b>Total : <?php echo $harga. ',-'; ?></b></h5>
									<br/>
									<h5><b>Cara Melakukan Pembayaran</b></h5>
									<h6><b>1. Pembayaran Dapat Dilakukan Dengan Melakukan Transfer Pada No Rekening Kami :</b></h6>
									<h6><b>   - BCA (No Rek : 3453 xxxx xxx)</b></h6>
									<h6><b>   - BRI (No Rek : 3453 xxxx xxx)</b></h6>
									<h6><b>2. Login Di groovyplay.com Kemudian Konfirmasi Pembayaran Pada Dasboard Anda</b></h6>
								</div>	
								<div class="col-sm-12">
									<p style="text-align:right;">
									<a href="<?php echo $base_url_member; ?>/?hal=listpayment" class="btn" role="button" style="background-color:#757575; color:#fff">History Paymment</a>
									<a href="<?php echo $base_url_member; ?>/invoicepdf.php" class="btn" role="button" style="background-color:#d50000; color:#fff">Print As PDF</a></p>
									<h6><b>* Keterangan : Mohon Untuk Melakukan Pembayaran Sebelum Tanggal Jatuh Tempo</b></h6>
								</div>
							</div>	  
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
