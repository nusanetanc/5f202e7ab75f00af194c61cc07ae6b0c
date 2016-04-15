<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
							$idchat=$_GET['c'];
if(isset($_POST['kirim'])) {	
							$inputStatus=$_POST['inputStatus'];
							$message=$_POST['message'];
							$date = date("Y/m/d H:i:s");
	if (empty($message)){
										?>
										<div class="col-sm-9">
											<p class="text-danger">Message Empty.</p>
										</div>	
									<?php	} else {
													$res = $col_user->find(array("id_user"=>$id));
													foreach($res as $row)
																		{ 
																			$fromname=$row['nama'];
																		} 
$msg=array(
			"reply_id"=>$id,
			"message"=>$message,
			"date"=>$date
		);	
$insert = $col_ticket->update(
								array("idchat"=>$idchat),
					   			array('$push'=>array("message"=>$msg)));
if ($inputStatus<>""){
						$update = $col_ticket->update(
														array("idchat"=>$idchat),
														array('$set'=>array("status"=>$inputStatus)));
}
						if ($insert || $update){
								  		?>
										<script type="" language="JavaScript">
										document.location='<?php echo $base_url_member; ?>/chatpengaduan/<?php echo $idchat; ?>'</script>
							<?php 	} 						
								}
								}	
$res = $col_ticket->find(array("idchat"=>$idchat));
foreach($res as $row)
					{ 
						$subject=$row['subject'];
						$kategori=$row['kategori'];
						$status_pengaduan=$row['status'];
					} 
								?>					
<section>
	<div class="col-sm-9">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-body"  style="background-color:#F1453C">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PENGADUAN - <?php echo $subject; ?></h3>
  				</div>
  					<br/>
  					<div class="panel-body container-full-center">
  				    	<div class="panel panel-default container-full-center">
  				    		<ul class="list-group">
							<li class="list-group-item">
							<?php if (($level=="401" && $kategori<>"Billing") || ($level=="3" && $kategori=="Billing")) { ?>
								<div class="row">
									<div class="col-sm-12">
										<div class="col-lg-15">
        									<textarea class="form-control" rows="3" id="message" name="message" placeholder="Message"></textarea>
        								</div>
        								<br/>
        								<select class="form-control" id="inputStatus" name="inputStatus" required>
        								<?php if($status_pengaduan<>"close") { ?>
									        <option disabled="disabled" selected>Status</option>
									        <option>solved</option>
									        <?php } ?>
									        <option value="close">terselesaikan</option>
									    </select> 
        								<br/>
        								<button class="btn btn-default background-btn-red" type="submit" name="kirim" id="kirim">REPLY</button>
									</div>
								</div>	
								<?php } ?>
							</li>
							</ul>
  				    	<div class="pic-container down">
							<ul class="list-group">
									<?php
										$res = $col_ticket->findOne(array("idchat"=>$idchat));	
										foreach ($res['message'] as $message => $msg) {
																						$reply_id = $msg['reply_id'];
																						$tanggal = $msg['date'];
																					  	$thn = substr($tanggal, 0,4);
																					    $bln = substr($tanggal, 5,2);
																						$tgl = substr($tanggal, 8,2);
																						$jam = substr($tanggal, 10,9);
																						$month = bulan($bln);
										$res0 = $col_user->find(array("id_user"=>$reply_id ));
										foreach($res0 as $row0)
													{ 
														$name_user_chat=$row0['nama'];
														$level_user_chat=$row0['level'];
													} 
														$lvl = lev($level_user_chat);
											  					?>
							<li class="list-group-item">
								<div class="row">
								<?php if($level_user_chat==$level) { ?>

									<blockquote>
										<div class="col-sm-12">
											<h5 class="list-group-item-heading"><b>
											<?php if ($level_user_chat=="0" && $level<>"0") { ?>
												<a style="text-decoration:none;" href="<?php echo $base_url_member; ?>/customer-profile/<?php echo $reply_id; ?>"><?php echo $name_user_chat.' ('.$lvl.')'?></a>

											<?php } else if ($level_user_chat=="2" || $level_user_chat=="3" || $level_user_chat=="4" ||$level_user_chat=="401" || $level=="0")  { ?>

												<?php echo $name_user_chat.' ('.$lvl.')'?> <?php } ?>
											</b></h5>
											<h6 class="list-group-item-text"><b><?php echo $msg['message']; ?></b></h6>
											<br/>
											<h6><p class="list-group-item-text"><?php echo 'Dikirim '.$tgl.' '.$month.' '.$thn.', '.$jam.' WIB'; ?></p></h6>
										</div>

								<?php } else { ?>

									<blockquote  class="blockquote-reverse">
										<div class="col-sm-12">
											<h5 class="list-group-item-heading"><b>
											<?php if ($level_user_chat=="0"  && $level<>"0") { ?>

												<a style="text-decoration:none;" href="<?php echo $base_url_member; ?>/customer-profile/<?php echo $reply_id; ?>"><?php echo $name_user_chat.' ('.$lvl.')'?></a>

											<?php } else if ($level_user_chat=="2" || $level_user_chat=="3" || $level_user_chat=="4" ||$level_user_chat=="401" || $level=="0")  { ?>

												<?php echo $name_user_chat.' ('.$lvl.')'?> <?php } ?>

											</b></h5>
											<h6 class="list-group-item-text"><b><?php echo $msg['message']; ?></b></h6>
											<br/>
											<h6><p class="list-group-item-text"><?php echo 'Dikirim '.$tgl.' '.$month.' '.$thn.', '.$jam.' WIB'; ?></p></h6>
										</div>

								<?php } ?>		
									  	
									</blockquote>	
								</div>	
							</li>
							
																				<?php
																						}
																				?>
							</ul>
						</div>
						</div>
					</div>		
			</div>
		</div>
	</div>	
</section>

