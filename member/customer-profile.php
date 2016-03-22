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
										  	 $ktp_cust=$row['ktp'];
										  	 $tglregis_cust=$row['tanggal_registrasi'];
										  	 $tglakhir_cust=$row['tanggal_akhir'];
										  	 $tglaktiv_cust=$row['tanggal_aktivasi'];
										  	 $status_cust=$row['status'];
										  	 $regis_cust=$row['registrasi'];
										  	 $sales_cust=$row['sales'];
										  	 $invoice_cust=$row['invoice'];
										  	 $harga_cust=$row['harga'];
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
									if(isset($_POST['konfirmregis'])){
										$text = 'abcdefghijklmnopqrstuvwxyz123457890';
                                        $panjang = 40;
                                        $txtlen = strlen($text)-1;
                                        $id_info = '';
                                        for($i=1; $i<=$panjang; $i++){
                                            $id_info .= $text[rand(0, $txtlen)];
                                        }    
                                        $date = date("Y/m/d");
                                    $lokasifile= $_FILES['regisktp']['tmp_name'];
                                    $fileName = $_FILES['regisktp']['name']; 
                                    $dir = "./ktp/";
                                    $move = move_uploaded_file($lokasifile, "$dir".$fileName);
										$konfirmasi = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("status"=>"konfirmasi registrasi", "aktif"=>"1")));
										$detail_info=array("share_id"=>"00000000","description"=>"Selamat Bergabung dengan groovy tv, Selamat Menikmati Layanan Kami","date"=>$date);
                                    	$write_info = $col_info->insert(array("id_info"=>$id_info, "for"=>$id, "subject"=>"Selamat Bergabung Dengan groovy", "informasi"=>array($detail_info)));
	                                    	  //mail for sales manager
	                                          $to = 'yudi.nurhandi@nusa.net.id';
	                                          $subject = 'Veririfikasi Registrasi Sales';

	                                          $message = '
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

	                                          $headers  = 'MIME-Version: 1.0' . "\r\n";
	                                          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	                                          $headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
	                                          $headers .= 'Cc: cs@groovy.id' . "\r\n";

	                                          $kirimemail1 = mail($to, $subject, $message, $headers);
	                                          // mail for customer to registrasi
												$to = $email_cust;

												$subject = 'Registrasi groovy TV';

												$message = '
												<html>
												<body>
												  <p>Terimakasih telah registrasi di groovy.id berikut rincian data anda : </p>
												  <br/>
												  <p>ID Customer : '.$id_cust.'</p>
												  <p>Nama : '.$nama_cust.'</p>
												  <p>Paket : '.$paket_cust.'</p>
												  <p>Email : '.$email_cust.'</p>
												  <p>Phone : '.$phone_cust.'</p>
												  <p>Tanggal Registrasi : '.$tgl.' '.$month.' '.$thn.'</p>
												  <p>Registrasi : '.$regis_cust.' '.$sales_cust.'</p>
												  <p>Tempat : '.$tempat_cust.', '.$alamat_cust.', '.$kota_cust.'</p>
												  <br/>
												  <p>Silahkan untuk melakukan pembayaran agar kami bisa memproses untuk pemasangan,</p>
												  <p>Kode pembayaran adalah : '.$invoice_cust.'</p>
												  <p>Anda harus melakukan pembyaran paling lambat : '.$tgl1.' '.$month1.' '.$thn1.'</p>
												  <p>Untuk mengaktifkan akun anda silahkan klik atau copy link berikut ini</p>
												  <p><a href="groovy.id/4328924hhvi432y432y3vh74bfid">Aktivasi</a></p>
												  <p>groovy.id/4328924hhvi432y432y3vh74bfid</p>
												  <br/>
												  <p>Best Regards</p>
												  <p>Customer Service</p>
												  <p>groovy.id</p>
												</body>
												</html>
												';

												$headers  = 'MIME-Version: 1.0' . "\r\n";
												$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

												$headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
												$headers .= 'Cc: cs@groovy.id' . "\r\n";

												mail($to, $subject, $message, $headers);
									if ($konfirmasi && $write_info && $kirimemail){ ?>
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
						        <h4><?php echo $email; ?></h4>
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
						      <label class="col-lg-3 control-label">Phone Number :</label>
						      <div class="col-lg-9">
						        <h4><?php echo $phone_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Alamat :</label>
						      <div class="col-lg-9">
						        <h4><?php echo $tempat_cust.', '.$alamat_cust.', '.$kota_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">KTP :</label>
						      <div class="col-lg-9">
							      <a href="#struk" class="btn btn-primary btn-xs">Open</a>
								  	<a href="" class="JesterBox">
									  <div id="struk"><img src="<?php echo $base_url_member; ?>/ktp/<?php echo $ktp_cust; ?>"></div>
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
							if($level=="5" && $status_cust=="registrasi" && $regis_cust=="sales"){ ?>
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