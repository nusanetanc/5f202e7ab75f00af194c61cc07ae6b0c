<?php
if ($level=="0"){
	if (isset($_GET['a']){
	$update = $col_ticket->update(
								array("id_user"=>$id),
								array('$set'=>array("status"=$_GET['a']))); 
							}
 $res = $col_ticket->findOne(array("id_user"=>$id));
if ($res['status']=="solved" || $res['status']=="open" || $_GET['c']<>''){
						$idchat=$res['idchat'];
						if ($_GET['c']<>""){
 							$idchat=$_GET['c'];
 						}
}						
	if (empty($idchat)){ ?>
							<section>
							<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
							<?php
							if(isset($_POST['kirim'])){
														$subject=$_POST['subject'];
														$kategori=$_POST['kategori'];
														$message=$_POST['message'];
														$captcha=$_POST['g-recaptcha-response'];
														$to=$_POST['to'];
														$date = date("Y/m/d H:i:s");
														$dateopen = date("Y/m/d");
														$text = 'abcdefghijklmnopqrstuvwxyz123457890';
														$panjang = 45;
														$txtlen = strlen($text)-1;
														$result = '';
							if ($subject=="" || $kategori=="" || $message=="" || !$captcha){ ?>
										<div class="col-sm-9">
											<div class="alert alert-dismissible alert-warning">
							  					<button type="button" class="close" data-dismiss="alert">x</button>
							  					Gagal Membuat Pengaduan, silahkan lengkapi pengaduan anda.
											</div>
										</div>	
									<?php	} else {
							for($i=1; $i<=$panjang; $i++){
															$result .= $text[rand(0, $txtlen)];
														 }
							$msg=array(
										"reply_id"=>$id,
										"message"=>$message,
										"date"=>$date,
										"read"=>array(
												"$id"
											)
									  );	
							$insert = $col_ticket->insert(array("idchat"=>$result, "id_user"=>$id, "subject"=>$subject, "kategori"=>$kategori, "dateopen"=>$dateopen, 
																 "status"=>"open", "message"=>(array($msg))));
							if ($insert) { ?>
											<script type="" language="JavaScript">
											document.location='./pengaduan'</script>
							<?php } } } ?>
								<div class="col-sm-12 col-md-12 col-lg-9">
									<div class="list-group">
										<div class="panel" style="border:0px;" >
							  				<div class="panel-heading"  style="background-color:#F1453C" >
							    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PENGADUAN-TULIS PENGADUAN</h3>
							  				</div>
							  						<div class="panel-body container">
									  					<br/>
									  						<a href="<?php echo $base_url_member; ?>/histori-pengaduan" class="btn btn-primary">Histori Pengaduan</a>	
									  					<br/>
									  				</div>	
								  					<div class="panel-body">		
							  							<div class="col-sm-4">	
								       						<select class="form-control" id="kategori" name="kategori">
														       <option disabled selected="selected" value="">Pilih Kategori</option>
														       <option>Tv</option>
														       <option>Internet</option>
														       <option>Billing</option>
														     </select>
								      					</div>
								      					<div class="col-sm-8">	
								       						 <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
								      					</div>
								      					<div class="col-sm-12">
								      						<br/>
								       						<textarea class="form-control" rows="3" id="message" name="message" placeholder="Message"></textarea>
								       						<br/>
															<div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>
															<br/>
															<input type="submit" class="btn btn-default background-btn-red" type="submit" name="kirim" id="kirim" value="KIRIM">
														</div>	
												</div>				
										</div>
									</div>
								</div>
							</form>		
							</section>
<?php
 } else { 
 	?>				
			<section>
			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
			<?php 
			$res = $col_ticket->find(array("idchat"=>$idchat));
			foreach($res as $row)
								{ 
									$subjectchat=$row['subject'];
									$statuschat=$row['status'];
								} 
			if (empty($subjectchat)){	?>

					<script type="" language="JavaScript">
					document.location='./pengaduan'</script>

			<?php }				
			if(isset($_POST['kirim'])) {	
										$captcha=$_POST['g-recaptcha-response'];
										$message=$_POST['message'];
										$date = date("Y/m/d H:i:s");
				if (!$captcha || empty($message)){
								?>
								<div class="col-sm-9">
									<div class="alert alert-dismissible alert-warning">
					  					<button type="button" class="close" data-dismiss="alert">x</button>
					  					There is an error in processing your request.
									</div>
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
			if ($insert){
					  		?>
							<script type="" language="JavaScript">
							document.location='./pengaduan'</script>
				<?php 	} 						
							}
								}	
											?>
				<div class="col-sm-9">
					<div class="list-group">
						<div class="panel" style="border:0px;" >
			  				<div class="panel-heading" style="background-color:#F1453C">
			    					<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PENGADUAN - <?php echo $subjectchat; ?></h3>
			  				</div>
			  				<div class="panel-body container">
			  					<br/>
			  						<a href="<?php echo $base_url_member; ?>/histori-pengaduan" class="btn btn-primary">Histori Pengaduan</a>	
			  					<br/>
			  				</div>	
			  					<div class="panel-body container-pull-center">
			  				    	<?php if($statuschat=="open" || $_GET['a']=="open") { ?>
			  				    		<div class="panel panel-default container-full-center">
			  				    		<ul class="list-group">
										<li class="list-group-item">
											<div class="row">
												<div class="col-sm-12">
													<div class="col-lg-15">
			        									<textarea class="form-control" rows="3" id="message" name="message" placeholder="Message"></textarea>
			        								</div>
			        								<br/>
			        								<div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>	
			        								<br/>
			        								<input type="submit" class="btn btn-default background-btn-red" type="submit" name="kirim" id="kirim" value="REPLY">
												</div>
											</div>	
										</li>
										</ul>
									<?php } else if ($statuschat=="solved") {
									?>	
										<div class="alert alert-dismissible alert-success">
										  <strong>Our complaint has been solved !</strong> Do you want to <a href="<?php echo $base_url_member; ?>/pengaduan/close" class="alert-link">close</a> or still <a href="<?php echo $base_url_member; ?>/pengaduan/open" class="alert-link">open</a> this complaint.
										</div>
										<div class="panel panel-default container-full-center">
									  	<ul class="list-group">
										<li class="list-group-item">
											<div class="row">
												<div class="col-sm-10">
													<div class="col-lg-15">
			        									<textarea class="form-control" rows="3" id="message" name="message" placeholder="Message" readonly="true"></textarea>
			        								</div>
			        								<br/>
			        								<div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8" disabled="true"></div>	
			        								<br/>
			        								<input type="submit" class="btn btn-default background-btn-red" type="submit" name="kirim" id="kirim" disabled="true" value="REPLY">
												</div>
											</div>	
										</li>
										</ul>
									<?php } ?>								
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
											<h6><p class="list-group-item-text"><?php echo 'Dikirim '.$tgl.' '.$month.' '.$thn.', '.$jam.' WIB'.', Dilihat Oleh : '; ?></p></h6>
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
											<h6><p class="list-group-item-text"><?php echo 'Dikirim '.$tgl.' '.$month.' '.$thn.', '.$jam.' WIB'.', Dilihat Oleh : '; ?></p></h6>
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
				</form>
			</section>
<?php } } else if ($level=="3" || $level=="4" || $level=="401") { ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#F1453C">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PENGADUAN</h3>
  				</div>
  					<br/>
  				    <div class="panel-body">
  				    	<div class="panel panel-default">
		    					<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="15%">Date</th>
									      <th width="65%">Subject</th>
									      <th width="30%">Status</th>
									    </tr>
									  </thead>
									  <tbody>
									  		  <?php
										  	  $res = $col_ticket->find()->sort(array("tanggal"));
											  foreach($res as $row)
											  { 
											  	if ($row['kategori']=="Internet" || $row['kategori']=="Tv") {
											  	$tanggal = $row['dateopen'];
											  	$thn = substr($tanggal, 0,4);
											    $bln = substr($tanggal, 5,2);
												$tgl = substr($tanggal, 8,10);
											    $month = bulan($bln);
											  	?>
 										<tr>
									      <td><?php echo $tgl.' '.$month.' '.$thn; ?></td>
									      <td><a style=" text-decoration:none" href="<?php echo $base_url_member; ?>/chat-pengaduan/<?php echo $row['idchat'] ?>"><?php echo $row['subject']; ?><a></td>
									      <?php $action = $row['status'];
										         switch ($action) { 
										         	case close: ?>
										         <td><span class="label label-success">Terselesaikan</span></td>
											<?php 	break;
												 	case open: ?>
										         <td><span class="label label-warning">On Progrress</span></td>
											<?php  	break;
													case solved: ?>
										         <td><span class="label label-primary">Solved</span></td>										         
											<?php break;
														 } ?>
									    </tr>
									    	  <?php
									    		} } 
									    			?>
									   </tbody>
								</table> 
						</div>
					</div>
 				</div>
			</div>
		</div>
	</div>	
</section>
<?php } else if ($level=="2") { ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#F1453C">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PENGADUAN</h3>
  				</div>
  					<br/>
  				    <div class="panel-body">
  				    	<div class="panel panel-default">
		    					<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="15%">Date</th>
									      <th width="65%">Subject</th>
									      <th width="30%">Status</th>
									    </tr>
									  </thead>
									  <tbody>
									  		  <?php
										  	  $res = $col_ticket->find(array("kategori"=>"Billing"))->sort(array("tanggal"));
											  foreach($res as $row)
											  { 
											  	$tanggal = $row['dateopen'];
											  	$thn = substr($tanggal, 0,4);
											    $bln = substr($tanggal, 5,2);
												$tgl = substr($tanggal, 8,10);
											    $month = bulan($bln);
											  	?>
 										<tr>
									      <td><?php echo $tgl.' '.$month.' '.$thn; ?></td>
									      <td><a style=" text-decoration:none" href="<?php echo $base_url_member; ?>/chat-pengaduan/<?php echo $row['idchat'] ?>"><?php echo $row['subject']; ?><a></td>
 											<?php $action = $row['status'];
										         switch ($action) { 
										         	case close: ?>
										         <td><span class="label label-success">Terselesaikan</span></td>
											<?php 	break;
												 	case open: ?>
										         <td><span class="label label-warning">On Progrress</span></td>
											<?php  	break;
													case solved: ?>
										         <td><span class="label label-primary">Solved</span></td>										         
											<?php break;
														 } ?>
									    </tr>
									    	  <?php
									    		} ?>
									   </tbody>
								</table> 
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
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#D32F2F;">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PENGADUAN</h3>
  				</div>
  					<br/>
  					<div class="panel-body">
  				    	<form method="post">
				    		<div class="form-group">
				    			<div class="row">
				    				<div class="col-lg-6">
				    					<form method="post">
									    <div class="col-lg-5">
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
								        </div>
								       	<div class="col-lg-4">
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
								        </div>
								        <div class="col-lg-3">
								        <input name="search" id="search" type="submit" class="btn btn-primary" value="Search">
								        </div>
								        </form>
			       					<div class="col-lg-12">
								    <div class="panel-body">
								    	<form>
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
								    		<h6><b>Tabel Pengaduan <?php echo $bln.' '.$year ?></b></h6>
								    		<div class="form-group">
						  				    	<div class="panel panel-default">
						  				    		<table class="table table-striped table-hover ">
														 <thead>
														    <tr>
														      <th width="65%">Status</th>
														      <th width="30%">Jumlah</th>
														    </tr>
														  </thead>
														  <?php 
														  	$jml_open = 0;												
																$res_open = $col_ticket->find(array("status"=>"open"));
																foreach ($res_open as $row_open) {
																	$monthopen = substr($row_open['dateopen'], 5,2);
																	$yearopen = substr($row_open['dateopen'], 0,4);
																	if ($monthopen==$month){
																		$jml_open = $jml_open + 1;
																	}
																}
														  	$jml_solved = 0;												
																$res_solved = $col_ticket->find(array("status"=>"solved"));
																foreach ($res_solved as $row_solved) {
																	$monthsolved = substr($row_solved['dateopen'], 5,2);
																	$yearsolved = substr($row_solved['dateopen'], 0,4);
																	if ($monthsolved==$month){
																		$jml_solved = $jml_solved + 1;
																	}
																}
														  	$jml_close = 0;												
																$res_close = $col_ticket->find(array("status"=>"close"));
																foreach ($res_close as $row_close) {
																	$monthclose = substr($row_close['dateopen'], 5,2);
																	$yearclose = substr($row_close['dateopen'], 0,4);
																	if ($monthclose==$month){
																		$jml_close = $jml_close + 1;
																	}
																}
														   ?>
														  <tbody>
														  		<td>Open</td>
														  		<td><?php echo $jml_open; ?></td>
														  </tbody>
														  <tbody>
														  		<td>Solved</td>
														  		<td><?php echo $jml_solved; ?></td>
														  </tbody>
														  <tbody>
														  		<td>Close</td>
														  		<td><?php echo $jml_close; ?></td>
														  </tbody>
													</table> 
												</div>
											</div>	
										</form>	
									</div>	
									</div>
									</div>
									<div class="col-sm-6">
										<div id="chart_div3" style="height: 300px; width: auto;"></div>	
									</div>				
								</div>
			 				</div>
						</div>
					</div>
				</div>	
			</section>
			<?php } ?>