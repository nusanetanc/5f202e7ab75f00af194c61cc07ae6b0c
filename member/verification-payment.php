<style>
    .datepicker{z-index:1151;}
</style>
    <script>
    	$(function(){
        $("#inputPaymentdate").datepicker({
      	format:'yyyy/mm/dd'
        });
        $("#inputTerminationdate").datepicker({
      	format:'yyyy/mm/dd'
        });
            });
    </script>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
				<div class="panel-body" style="background-color:#1B5E12;">
					<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">CUSTOMER</h3>
				</div>
				<div class="panel-body">
					<br/>
					<div class="col-sm-12">
						<form class="form-horizontal">
						  <fieldset>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Nama : </label>
							  <div class="col-lg-9">
								<h4><?php echo $nama_cust; ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Email : </label>
							  <div class="col-lg-9">
								<h4><?php echo $email_cust; ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Custommer ID : </label>
							  <div class="col-lg-9">
								<h4><?php echo $id_cust ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Phone Number : </label>
							  <div class="col-lg-9">
								<h4><?php echo $phone_cust; ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Paket Aktif/Harga : </label>
							  <div class="col-lg-9">
								<h4><?php echo $package_cust.'/'.rupiah($harga_paket); ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Lokasi : </label>
							  <div class="col-lg-9">
								<h4><?php echo $tempat_cust.', '.$ket_cust.', '.$kota_cust; ?></h4>
							  </div>
							</div>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Tanggal Registrasi : </label>
							  <div class="col-lg-9">
								<h4><?php echo $tgl_registrasi.' '.$month_registrasi.' '.$thn_registrasi; ?></h4>
							  </div>
							</div>	<?php if($status_cust<>"registrasi"){ ?>
							<div class="form-group">
							  <label class="col-lg-3 control-label">Tanggal Akhir Pembayaran : </label>
							  <div class="col-lg-9">
								<h4><?php echo $tgl_akhir.' '.$month_akhir.' '.$thn_akhir; ?></h4>
              </div>$ppn0=$total_bayar0*0.1; ?></option>
                <?php } ?>
                <option>All</option>
              </select><br/>
								<input type="text" class="form-control" id="inputPaymentdate" name="inputPaymentdate" placeholder="Payment Date" required>
								<br/>
								<div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>
								<br/>
								<input type="submit" class="btn" style="background-color:#1B5E12; color:#FFFFFF" name="verifikasi" id="verifikasi" value="Vertifikasi">
							  </div>
							</div>
						  </fieldset>
						</form>
					</div>
				</div>
		<div class="col-sm-12">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">BILLING - <?php echo $pindah_paket; ?></h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="20%">Deskripsi Pembayaran</th>
									      <th width="20%">Harga</th>
									      <th width="20%">Prorate</th>
                        <th width="20%">PPN</th>
									      <th width="20%">Total Bayar</th>
									    </tr>
									  </thead>
									  <tbody>
									  	<td><?php echo $paket_bayar; ?></td>
									  	<td><?php echo rupiah($harga_bayar); ?></td>
									  	<td><?php echo rupiah($proraide); ?></td>
                      <td><?php echo rupiah($ppn); ?></td>
									  	<td><?php echo rupiah($total_bayar); ?></td>
									  </tbody>
                    <?php	$res = $col_addon->find(array("id_user"=>"$id_cust"));
                          foreach($res as $row) { ?>
                    <tbody>
									  	<td><?php echo $row['layanan']; ?></td>
									  	<td><?php echo rupiah($row['harga']); ?></td>
									  	<td><?php echo rupiah($row['proraide']); ?></td>
                      <?php $total_bayar0=$row['harga']-$row['proraide'];
                            $ppn0=$total_bayar0*0.1; ?>
                      <td><?php echo rupiah($ppn0); ?></td>
									  	<td><?php echo rupiah($total_bayar0+$ppn0); ?></td>
									  </tbody>
                    <?php } ?>
								</table>
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
					  	</div>
					</div>
				</div>
		<div class="col-sm-12">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">DATA PEMBAYARAN - <?php echo $pembayaran; ?></h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="5%">No</th>
									      <th width="15%">Pembayaran</th>
									      <th width="15%">Konfirmasi</th>
									      <th width="20%">Deskripsi Pembayaran</th>
                        <th width="20%">Harga/PPN</th>
									      <th width="20%">Total Pembayaran</th>
									    </tr>
									  </thead>
									  <?php
									  	$res = $col_user->findOne(array("id_user"=>$id_cust));
										foreach ($res['payment'] as $bayar => $byr) {
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
									  	<td><?php echo $byr['paket']; ?></td>
                      <td><?php echo rupiah($byr['harga'])./.rupiah($byr['ppn']); ?></td>
                      <td><?php echo rupiah($byr['total_bayar']); ?></td>
									  </tbody>
									  <?php } ?>
								</table>
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
					  	</div>
					</div>
				</div>
		<div class="col-sm-12">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">TERMINASI LAYANAN</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
								<input type="text" class="form-control" id="inputTerminationdate" name="inputTerminationdate" placeholder="Termination Date" required> <br/>
								<input type="text" class="form-control" name="textalasanberhenti" id="textalasanberhenti" placeholder="Alasan Penutupan"><br/>
								<div style="margin-bottom:7px;" class="g-recaptcha" data-sitekey="6Ldx_BsTAAAAAOYrQegHLVhslSvd6z78zAr-4Knc"></div>
									<br/>
								<input type="submit" class="btn" style="background-color:#1B5E12; color:#FFFFFF" name="terminasi" id="terminasi" value="TUTUP">
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</form>
