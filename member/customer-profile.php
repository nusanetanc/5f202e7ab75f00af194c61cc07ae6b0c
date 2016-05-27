<section>
	<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
						
		<div class="col-sm-9" style="font-family:Arial;">
			<div class="list-group">
				<div class="panel" style="border:0px;" >
	  				<div class="panel-heading" style="background-color:#3FB618">
	    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PROFILE CUSTOMER</h3>
	  				</div>
	  				<div class="panel-body">
	  					<br/>
						<div class="col-sm-12">
							  <fieldset>
							<div class="form-group">
						      <label class="col-lg-3 control-label">Nama Lengkap :</label>
						      <div class="col-lg-9">
						        <h4><?php echo $nama_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Email :</label>
						      <div class="col-lg-9">
						        <h4><?php echo $email_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Customer ID :</label>
						      <div class="col-lg-9">
						        <h4><?php echo $id_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Paket :</label>
						      <div class="col-lg-9">
						        <h4><?php echo $paket_cust; ?></h4>
						      </div>
						    </div>
								<div class="form-group">
						      <label class="col-lg-3 control-label">Layanan Tambahan :</label>
						      <div class="col-lg-9">
								<h4><?php	$res = $col_addon->find(array("id_user"=>$_GET['id_cust']));
													foreach($res as $row)
														  {
																echo $row['layanan'].', ';
															} ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Phone Number :</label>
						      <div class="col-lg-9">
						        <h4><?php echo $phone_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Tempat :</label>
						      <div class="col-lg-9">
						        <h4><?php echo $tempat_cust.', '.$alamat_cust.', '.$kota_cust; ?></h4>
						      </div>
						    </div>
								<div class="form-group">
						      <label class="col-lg-3 control-label">Keterangan Tempat :</label>
						      <div class="col-lg-9">
						        <h4><?php echo $ket_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">KTP :</label>
						      <div class="col-lg-9">
							      <a href="" class="btn btn-primary btn-xs">Open</a>
								  	<a href="" class="JesterBox">
									  <div id=""><img src="<?php echo $base_url_member; ?>/ktp/<?php echo $ktp_cust; ?>"></div>
									</a>
							  </div>
							  </label>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Tanggal Registrasi : </label>
						      <div class="col-lg-9"><h4>
						      <?php
						  			 echo $tgl.' '.$month.' '.$thn; ?></label>
						      </h4></div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Status : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $status_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Registrasi : </label>
						      <div class="col-lg-9"><h4>
							  <?php
							  	if ($regis_cust=="personal") {
							  		echo $row['registrasi'];
							  	} elseif ($regis_cust=="sales") {
							  		echo $regis_cust.' / '.$sales_cust;
							  	}
							  ?></h4></label>
						      </div>
						   </div>
							  </fieldset>
							<?php
							if($level=="5" && $status_cust=="permintaan registrasi" &1 HD Movie, Winning Time,& $regis_cust=="sales"){ ?>
							 		<td><input type="submit" name="konfirmregis" id="konfirmregis" class="btn btn-primary btn-sm" value="Konfirmasi Registrasi"></td>
							<?php } elseif($regis_cust=="konfirmasi registrasi") { ?>
							<div class="form-group">
						      <label class="col-lg-3 control-label"> Pembayaran : </label>
						      <div class="col-lg-9">
						        <h4><?php echo 'No Virtual Pembayaran('.$invoice_cust.'), Total Harga('.$harga_cust.')'; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label"> Tanggal Akhir Pembayaran : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $tgl1.' '.$month1.' '.$thn1; ?></h4>
						      </div>
						    </div>
						<?php } elseif($status_cust=="aktif") { ?>
							<div class="form-group">
						      <label class="col-lg-3 control-label"> Tanggal Mulai Aktif : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $tgl2.' '.$month2.' '.$thn2; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label"> Tanggal Akhir Aktif : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $tgl1.' '.$month1.' '.$thn1; ?></h4>
						      </div>
						    </div>
						<?php } ?>
						</div>
	 				</div>
				</div>
			</div>

		</div>
	</form>
</section>
