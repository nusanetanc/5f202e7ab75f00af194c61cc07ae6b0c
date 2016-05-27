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
										$konfirmasi = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("status"=>"registrasi", "aktif"=>"0")));
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
	                                            <p>Paket : '.$paket_cust.'</p>
	                                            <br/>
	                                          </body>
	                                          </html>
	                                          ';

	                                          $headers1  = 'MIME-Version: 1.0' . "\r\n";
	                                          $headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	                                          $headers1 .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
	                                          $headers1 .= 'Cc: cs@groovy.id' . "\r\n";

	                                          $kirimemail1 = mail($to1, $subject1, $message1, $headers1);
																				// mail for customer to registrasi
                                                                                $to2 = $email;

                                                                                $subject2 = 'Registrasi groovy TV';

                                                                                $message2 = '
                                                                                <html>
                                                                                    <body style="background-color:#f0f0f0;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
                                                                                        <div style="margin:0 auto;max-width:500px;background-color:#fff;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
                                                                                            <div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
                                                                                                <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
                                                                                            </div>
                                                                                            <div style="padding:20px;color:#333;">
                                                                                                <p style="font-size:20px;font-weight:bold;line-height:1px">Hai John Doe,</p>
                                                                                                <p>Terimakasih telah mendaftarkan akun Groovy. Berikut adalah rincian akun yang anda daftarkan.</p>
                                                                                                <table style="margin-top:20px;margin-bottom:20px;border:0px solid #ccc;color:#333;background-color:#fff;#ddd;width:100%;font-size:14px;">
                                                                                                    <tr style="border:1px solid #bbb;">
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777;">ID Customer</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">'.$id_cust.'</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777">Nama</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">'.$nama_cust.'</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777">Email</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">'.$email_cust.'</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777">Telepon</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">'.$phone_cust.'</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777">Paket</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">'.$paket_cust.'</td>
                                                                                                    </tr>
																																																		<tr>
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777">Paket</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">'.$addon_cust.'</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777">Tanggal Registrasi</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">'.$date_days.' '.$month1.' '.$date_years.'</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777">Tipe Akun</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">Personal</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777">Tempat</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">'.$tempat_cust.', '.$ket_cust.', '.$alamat_cust.', '.$kota_cust.'</td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                                <p>Untuk mengaktifkan akun silahkan klik tombol aktivasi ini.</p>
                                                                                                <div style="text-align:center;margin:30px 0 30px 0;">
                                                                                                    <a href="'.$base_url.'/?a='.$password_sales.'" style="text-decoration:none;color:#fff;"><span style="background-color:#FF3D23;border:0;border-radius:5px;padding:10px 40px 10px 40px;color:#fff;font-size:17px;">Aktivasi Akun</span></a>
                                                                                                </div>
                                                                                                <p>Jika tombol tidak berfungsi silahkan copy link berikut <a href="'.$base_url.'/?a='.$password_sales.'">'.$base_url.'/?a='.$password_sales.'</a></p>
                                                                                            </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </body>
                                                                                    </html>

                                                                                ';

                                                                                $headers2  = 'MIME-Version: 1.0' . "\r\n";
                                                                                $headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                                                                                $headers2 .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
                                                                                $headers2 .= 'Cc: cs@groovy.id, billing@groovy.id' . "\r\n";

                                                                                $kirimemail2 = mail($to2, $subject2, $message2, $headers2);
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
							      <a href="#ktp" class="btn btn-primary btn-xs">Open</a>
								  	<a href="#" class="JesterBox">
									  <div id="ktp"><img src="<?php echo $base_url_member; ?>/ktp/<?php echo $ktp_cust; ?>"></div>
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
