<?php if($level=="0"){ ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">History Payment</h3>
  				</div>
  					<br/>
  				    <div class="panel-body">
  				    	<div class="panel panel-default">
		    					<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="15%">No Virtual</th>
									      <th width="20%">Tanggal Pembayaran</th>
									      <th width="20%">Tanggal Konfirmasi</th>
									      <th width="30%">Deskripsi</th>
									      <th width="15%">Total</th>
									    </tr>
									  </thead>
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
									  <tbody>
									  	<td><?php echo $payment['invoice']; ?></td>
 										<td><?php echo $tgl.' '.$month.' '.$thn; ?></td>
 										<?php 
 										if ($tanggal1 == ""){ ?>
 												<td style="color:red;">waiting for payment activation</td> 
 												<?php
 										}else{ 
 										?>
 												<td><?php echo $tgl1.' '.$month1.' '.$thn1; ?></td>
 											<?php } ?>	
									    <td>Pembayaran Paket <?php echo $payment['paket']; ?> </td>
									    <td><?php echo $payment['harga'].',-'; ?></td>
									  </tbody>
									  <?php } ?>
								</table> 
						</div>
					</div>
 				</div>
			</div>
		</div>
	</div>	
</section>
<?php } else if ($level=="2"){ ?>
<style>
    .datepicker{z-index:1151;}
</style>
    <script>
    	$(function(){
        $("#inputStartdate").datepicker({
      	format:'yyyy/mm/dd'
        });
        $("#inputEnddate").datepicker({
      	format:'yyyy/mm/dd'
        });
            });
    </script>
	<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">List Payment</h3>
  				</div>
  					<br/>
  				    <div class="panel-body">
  				    <?php if (isset($_POST['submitdate'])) { 
  				    	$inputStartdate = $_POST['inputStartdate'];
  				    	$inputEnddate = $_POST['inputEnddate'];
  				    	?>
  				    	<ul class="pager">
						  <li class="previous"><a href="<?php echo $base_url_member; ?>/?hal=listpayment">&larr; Back To Search</a></li>
						</ul>
						<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="25%">Pelanggan</th>
									      <th width="20%">Tanggal Pembayaran</th>
									      <th width="20%">Tanggal Konfirmasi</th>
									      <th width="25%">Deskripsi Pembayaran</th>
									      <th width="25%"></th>
									    </tr>
									  </thead>
									  <?php
										$res = $col_user->findOne(array("level"=>"0", "payment"=>array('$elemMatch'=>array("tanggal_bayar"=>array('$lte'=>$inputEnddate, '$gt'=>$inputStartdate)))));	
										foreach ($res['payment'] as $byr => $bayar) {
											if ($bayar['tanggal_konfirmasi']<>""){
												$tanggal = $bayar['tanggal_bayar'];
											  	$thn = substr($tanggal, 0,4);
											    $bln = substr($tanggal, 5,2);
												$tgl = substr($tanggal, 8,10);
											    $month = bulan($bln);
												    $tanggal1 = $bayar['tanggal_konfirmasi'];
												  	$thn1 = substr($tanggal1, 0,4);
												    $bln1 = substr($tanggal1, 5,2);
													$tgl1 = substr($tanggal1, 8,10);
												    $month1 = bulan($bln1);
										?>
									  <tbody>
									  	<td></td>
 										<td><?php echo $tgl.' '.$month.' '.$thn; ?></td>
 										<td><?php echo $tgl1.' '.$month1.' '.$thn1; ?></td>
									    <td><?php echo $bayar['invoice']; ?>/<?php echo $bayar['paket']; ?>/<?php echo $bayar['harga']; ?>/<?php echo $bayar['bank']; ?></td>
									  </tbody>
									  <?php } }?>
								</table> 
					<?php } else { ?>	
  				    	<form method="post">
				    		<div class="form-group">
							      <div class="col-lg-5">
							        <input type="text" class="form-control" id="inputStartdate" name="inputStartdate" placeholder="Start Date" required>
							      </div>
						      <div class="col-lg-5">
						        <input type="text" class="form-control" id="inputEnddate" name="inputEnddate" placeholder="End Date" required>
						      </div>
						      <div class="col-lg-2">
						        <input name="submitdate" id="submitdate" type="submit" class="btn btn-primary" value"Submit">
						      </div>
					   		</div>
					   	</form>	 
					<?php } ?>   	
					</div>
					<br/>
 				</div>
			</div>
		</div>
</section>
<?php } ?>