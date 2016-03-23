<script >
$(document).ready(function(){
    $('#updateinfo').modal('hide');
    $('#editsukses').modal('hide');
    $('#editgagal').modal('hide');
}); </script> 
<?php
	$id_info=new mongoId($_GET['i']);
	$res = $col_info->find(array("_id"=>$id_info));
	foreach($res as $row)
{ 
	$subject=$row['subject'];
}
?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-body" style="background-color:#9E9E9E;">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">INFORMASI - <?php echo $subject ?></h3>
  				</div>
  					<br/>
  				    <div class="panel-body">
  				    <?php 
  				    $res = $col_info->findOne(array("id_info"=>$id_info));
  				    $tempatinfo=$res['tempat'];
  				    foreach ($res['informasi'] as $informasi => $info) {
  				    													$tanggal = $info['date'];
  				    													$thn = substr($tanggal, 0,4);
																	    $bln = substr($tanggal, 5,2);
																		$tgl = substr($tanggal, 8,2);
																		$jam = substr($tanggal, 10,9);
																		$month = bulan($bln);
  				    ?>	
  				    	<blockquote>
						  <p><b><h5><?php echo $info['description']; ?></h5></b></p>
						  <small><b> Last update : <?php echo $tgl.' '.$month.' '.$thn.', '.$jam.' WIB'; ?></b></small>
						  <?php
						  $res = $col_user->find(array("id_user"=>$info['share_id']));
								foreach($res as $row)
							{ 
								$nama_share=$row['nama'];
								$level_share=$row['level'];
								$lvl = lev($level_share);
							}
							?>
						  <small>Update By : <?php echo $nama_share. '('.$lvl.')'; ?></small>
						</blockquote>	
					<?php } ?> <?php if ($level=="3" || $level=="4" || $level=="401"){ ?>
						<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateinfo">Update Informasi</button>
						 <?php } ?>
						<!-- Modal Update Info -->
								<div class="modal" name="updateinfo" id="updateinfo">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								        <h4 class="modal-title">Update Informasi</h4>
								      </div>
								      	<form method="post">
									      <?php
									      				if(isset($_POST['save'])) {
															      					$inputDescription=$_POST['textInformation'];
															      					$inputStatus=$_POST['inputStatus'];
															      					$date = date("Y/m/d H:i:s");
															      					$info=array(
																								"share_id"=>$id,
																								"description"=>$inputDescription,
																								"date"=>$date
																								);	
																					$insert = $col_info->update(
																												array("id_info"=>$id_info),
																									   			array('$push'=>array("informasi"=>$info)), array('$set'=>array("status"=>$inputStatus)));
																					$update = $col_info->update(
																												array("id_info"=>$id_info),
																									   			array('$set'=>array("status"=>$inputStatus)));	
																					if ($tempatinfo=="All"){
																						$res0 = $col_user->find(array("level"=>"0"));
																					} else{
																						$res0 = $col_user->find(array("tempat"=>$tempatinfo, "level"=>"0"));
																					}
																						foreach($res0 as $row0)
																						  { 
																																							// mail for customer to info
																						$to = $row0['email'];

																						$subject = 'Update Info groovy ('.$inputSubject.')';

																						$message = '
																						<html>
																						<body>
																						  <p>Update Info untuk pengguna layanan groovy.id, <br/>
																						  	 '.$inputDescription.'<br/>
																						  	 Mohon Maaf Atas Ketidaknyamanan.
																						  </p>
																						  <br/>
																						  <br/>
																						  <p>Best Regards</p>
																						  <p>Helpdesk</p>
																						  <p>groovy.id</p>
																						</body>
																						</html>
																						';

																						$headers  = 'MIME-Version: 1.0' . "\r\n";
																						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

																						$headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";

																						$share_email = mail($to, $subject, $message, $headers);
																							}		
														if ($insert && $update){ ?>
																				<script >
																				$(document).ready(function(){
																				    $('#editsukses').modal('show');
																				}); </script> 
													<?php	} else { ?>
																				<script >
																				$(document).ready(function(){
																				    $('#editgagal').modal('show');
																				}); </script> 
													<?php	}
									      			}
									      			?>								      	
									      <div class="modal-body">
										        <textarea name="textInformation" id="textInformation" class="form-control" rows="3" placeholder="Informasi" required></textarea>
										        <br/>
										        <select class="form-control" id="inputStatus" name="inputStatus" required>
										        <option value="" disabled="disabled" selected>Status</option>
											        <option>on schedule</option>
											        <option>on progress</option>
											        <option>done</option>
										       </select>  
									      </div>
									      <div class="modal-footer">
									        <button name="save" id="save" type="submit" class="btn btn-primary">Update</button>
									      </div>
								     	</form>  
								    </div>
								  </div>
								</div>
								<!-- /Modal Update Info -->
								<!-- Modal Update Info sukses -->
								<div class="modal" name="editsukses" id="editsukses">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								        <h4 class="modal-title">Edit Informasi Sukses</h4>
								      </div>
								    </div>
								  </div>
								</div>
								<!-- /Modal Update Info sukses -->
								<!-- Modal Update Info gagal -->
								<div class="modal" name="editgagal" id="editgagal">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
								        <h4 class="modal-title">Edit Informasi Gagal</h4>
								      </div>
								    </div>
								  </div>
								</div>
								<!-- /Modal Update Info gagal -->
					</div>
 				</div>
			</div>
		</div>
	</div>	
</section>