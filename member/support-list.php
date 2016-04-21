<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">List Support Groovy</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
	  				    	<?php if($level=="3"){ ?>
		  				    	<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="20%">Nomor Id</th>
									      <th width="20%">Nama</th>
									      <th width="20%">Jabatan</th>
									      <th width="20%">No Telepon</th>
									      <th width="20">Detail Pekerjaan</th>
									    </tr>
									  </thead>
									  <?php
									  		$rslt = $col_user->find();
									  		foreach ($rslt as $row) {
									  			if($row['level']=="301" || $row['level']=="302"){
									   ?>
									  <tbody>
									  	<td><?php echo $row['id_user']; ?></td>
									  	<td><?php echo $row['nama']; ?></td>
									  	<td><?php if($row['level']=="301"){
									  				echo "Field Engineer";
									  		} elseif($row['level']=="302"){
									  				echo "Ass Field Engineer"; } ?></td>
									  	<td><?php echo $row['phone']; ?></td>
									  	<?php $nama_support=str_replace(" ", "000", $row['nama'])?>
									  	<td><a href="<?php echo $base_url_member; ?>/jobs/support/<?php echo $nama_support; ?>" class="btn btn-primary btn-xs">Show</a></td>
									  </tbody>
									  <?php } } ?>
								</table>
								<?php } else if($level=="1"){ ?>
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

												   ?>
												   <tbody>
												  		<td>Data Bulan</td>
												  		<td><?php echo $bln.' '.$year; ?></td>
												  </tbody>
												  <tbody>
												  		<td>Update </td>
												  		<td><?php ?></td>
												  </tbody>
											</table>
										</div>
									</div>
									<br/>
								<table class="table table-striped table-hover ">
									 <thead>
									    <tr>
									      <th width="10%">Id</th>
									      <th width="25%">Nama</th>
									      <th width="20%">Jabatan</th>
									      <th width="15%">Pasang</th>
												<th width="15%">Maintenance</th>
									      <th width="15">Bongkar</th>
									    </tr>
									  </thead>
									  <?php
									  		$rslt = $col_user->find();
									  		foreach ($rslt as $row) {
									  			if($row['level']=="301" || $row['level']=="302"){
									  	$count_pasang=$col_history->find(array("fieldengineer"=>$row['nama'], "hal"=>"pasang"))->count();
											$count_maintenance=$col_history->find(array("fieldengineer"=>$row['nama'], "hal"=>"maintenance"))->count();
									  	$count_bongkar=$col_history->find(array("fieldengineer"=>$row['nama'], "hal"=>"bongkar"))->count();
									  	$count_pasang0=$col_history->find(array("ass_field"=>$row['nama'], "hal"=>"pasang"))->count();
											$count_maintenance0=$col_history->find(array("fieldengineer"=>$row['nama'], "hal"=>"maintenance"))->count();
									  	$count_bongkar0=$col_history->find(array("ass_field"=>$row['nama'], "hal"=>"bongkar"))->count();
									   ?>
									  <tbody>
									  	<td><?php echo $row['id_user']; ?></td>
									  	<td><?php echo $row['nama']; ?></td>
									  	<?php if($row['level']=="301"){ ?>
									  			<td><?php echo "Field Engineer"; ?></td>
									  			<td><?php echo $count_pasang; ?></td>
													<td><?php echo $count_maintenance; ?></td>
									  			<td><?php echo $count_bongkar; ?></td>
									  	<?php } elseif($row['level']=="302"){ ?>
									  			<td><?php echo "Ass Field Engineer"; ?></td>
											  	<td><?php echo $count_pasang0; ?></td>
													<td><?php echo $count_maintenance0; ?></td>
											  	<td><?php echo $count_bongkar0; ?></td>
										<?php } ?>
									  </tbody>
									  <?php } } ?>
								</table>
								<?php } ?>
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
		  	</div>
		</div>
	</div>
</section>
