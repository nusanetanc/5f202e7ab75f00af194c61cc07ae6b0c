<section>
	<form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
							<?php
									$id_cust=$_GET['id_cust'];
									$res = $col_user->find(array("id_user"=>$_GET['id_cust'],"level"=>"0"));
									foreach($res as $row)
										  {
										  	 $nama_cust=$row['nama'];
										  	 $email_cust=$row['email'];
										  	 $paket_cust=$row['paket'];
										  	 $phone_cust=$row['phone'];
										  	 $tempat_cust=$row['tempat'];
										  	 $alamat_cust=$row['alamat'];
										  	 $kota_cust=$row['kota'];
										  	 $ket_cust=$row['keterangan'];
										  	 $ktp_cust=$row['ktp'];
										  	 $tglregis_cust=$row['tanggal_registrasi'];
										  	 $tglakhir_cust=$row['tanggal_akhir'];
										  	 $tglaktiv_cust=$row['tanggal_aktivasi'];
										  	 $status_cust=$row['status'];
										  	 $regis_cust=$row['registrasi'];
										  	 $sales_cust=$row['nama_sales'];
										  	 $invoice_cust=$row['invoice'];
										  	 $harga_cust=$row['harga'];
												 $addon_cust =$row['addon'];
										  	 $email_sales=$row['email_sales'];
										  	 $password_sales=$row['password'];
									$tanggal = $tglregis_cust;
										  	$thn = substr($tanggal, 0,4);
										    $bln = substr($tanggal, 5,2);
											$tgl = substr($tanggal, 8,10);
										    $month = bulan($bln);
									$tanggal1 = $tglakhir_cust;
										  	$thn1 = substr($tanggal1, 0,4);
										    $bln1 = substr($tanggal1, 5,2);
											$tgl1 = substr($tanggal1, 8,10);
										    $month1 = bulan($bln1);
									$tanggal2 = $tglaktiv_cust;
										  	$thn2 = substr($tanggal2, 0,4);
										    $bln2 = substr($tanggal2, 5,2);
											$tgl2 = substr($tanggal2, 8,10);
										    $month2 = bulan($bln2);
										  } 
											$res = $col_addon->find(array("id_user"=>$_GET['id_cust']));
											foreach($res as $row)
												  {
														$addon_cust=$row['layanan'];
													}
									if(isset($_POST['konfirmregis'])){
                                        $date = date("Y/m/d");
										$konfirmasi = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("status"=>"registrasi", "aktif"=>"10.
										")));
										$detail_info=array("share_id"=>"00000000","description"=>"Selamat Bergabung dengan groovy tv, Selamat Menikmati Layanan Kami","date"=>$date);
                    $write_info = $col_info->insert(array("for"=>$id_cust, "subject"=>"Selamat Bergabung Dengan groovy", "tanggal_update"=>$date, "informasi"=>array($detail_info)));
	                                    	  //mail for sales manager
	                                          $to1 = $email_sales;
	                                          $subject1 = 'Veririfikasi Registrasi Sales';

	                                          $message1 = '
	                                          <html>
	                                          <body>
	                                            <p>Regisrtrasi sudah di validasi oleh sales manager</p>
	                                            <br/>
	                                            <p>ID Customer : '.$id_cust.'</p>
	                                            <p>Nama : '.$nama_cust.'</p>
	                                            <p>Alamat : '.$email_cust.'</p>
	                                            <p>Tanggal Registrasi : '.$tgl.' '.$month.' '.$thn.'</p>
	                                            <p>Sales : '.$sales_cust.'</p>
	                                            <br/>
	                                          </body>
	                                          </html>
	                                          ';

	                                          $headers1  = 'MIME-Version: 1.0' . "\r\n";
	                                          $headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	                                          $headers1 .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
	                                          $headers1 .= 'Cc: cs@groovy.id' . "\r\n";

	                                          $kirimemail1 = mail($to1, $subject1, $message1, $headers1);

                                        $status_cust = "registrasi";
									if ($konfirmasi && $write_info && $kirimemail1 && $kirimemail2){ ?>
										<p class="text-muted text-primary">Registrasi Customer telah di konfirmasi.!!</p>
								<?php } }
								?>
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
										<h4><?php	echo $addon_cust; ?></h4>
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
							      <a href="#imagektp" class="btn btn-primary btn-xs">Open</a>
								  	<a href="" class="JesterBox">
									  <div id="imagektp"><img src="<?php echo $base_url_member; ?>/ktp/<?php echo $ktp_cust; ?>"></div>
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
							  		echo $regis_cust;
							  	} elseif ($regis_cust=="sales") {
							  		echo $regis_cust.' / '.$sales_cust;
							  	}
							  ?></h4></label>
						      </div>
						   </div>
							  </fieldset>
							<?php
							if($level=="5" && $status_cust=="permintaan registrasi" && $regis_cust=="sales"){ ?>
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
