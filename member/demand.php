<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#F1453C">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">DEMAND</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
					<div class="col-sm-12">
						<?php
						if(isset($_GET['k'])){
						?>
						<table class="table table-striped table-hover ">
							<thead>
								<tr>
									<th width="30%">Nama</th>
									<th width="30%">Paket</th>
									<th width="70%">Tempat</th>
								</tr>
							</thead>
							<?php
						?>
							<tbody>
								<?php
									$k = str_replace('00',' ', $_GET['k']);
									$res = $col_demand->find(array("kota"=>$k));
									foreach($res as $row)
									{
								?>
								<tr>
									<td><?php $row['nama']; ?></td>
									<td><?php $row['paket']; ?></td>
									<td><?php $row['alamat']; ?></td>
								</tr>
								<?php } ?>
							</tbody>
					 </table>
					 <?php } else { ?>
						<table class="table table-striped table-hover ">
						  <thead>
						    <tr>
						      <th width="30%">Kota</th>
									<th width="30%">Jumlah</th>
									<th width="30%">Detail</th>
						    </tr>
						  </thead>
						  <?php
								$res_jakut = $col_demand->find(array("kota"=>"Jakarta Utara"))->count();
								$res_jaksel = $col_demand->find(array("kota"=>"Jakarta Selatan"))->count();
								$res_jakbar = $col_demand->find(array("kota"=>"Jakarta Barat"))->count();
								$res_jaktim = $col_demand->find(array("kota"=>"Jakarta Timur"))->count();
								$res_jakpus = $col_demand->find(array("kota"=>"Jakarta Pusat"))->count();
								$res_bdg = $col_demand->find(array("kota"=>"Bandung"))->count();
						?>
						  <tbody>
						    <tr>
						      <td>Jakarta Utara</td>
									<td><?php echo $res_jakut; ?></td>
									<td><a href="<?php echo $base_url_member; ?>/demand/Jakarta00Utara" class="btn btn-primary btn-xs">Lihat</a></td>
						    </tr>
								<tr>
						      <td>Jakarta Selatan</td>
									<td><?php echo $res_jaksel; ?></td>
									<td><a href="<?php echo $base_url_member; ?>/demand/Jakarta00Selatan" class="btn btn-primary btn-xs">Lihat</a></td>
						    </tr>
								<tr>
						      <td>Jakarta Barat</td>
									<td><?php echo $res_jakbar; ?></td>
									<td><a href="<?php echo $base_url_member; ?>/demand/Jakarta00Barat" class="btn btn-primary btn-xs">Lihat</a></td>
						    </tr>
								<tr>
						      <td>Jakarta Timur</td>
									<td><?php echo $res_jaktim; ?></td>
									<td><a href="<?php echo $base_url_member; ?>/demand/Jakarta00Timur" class="btn btn-primary btn-xs">Lihat</a></td>
						    </tr>
								<tr>
						      <td>Jakarta Pusat</td>
									<td><?php echo $res_jakpus; ?></td>
									<td><a href="<?php echo $base_url_member; ?>/demand/Jakarta00Pusat" class="btn btn-primary btn-xs">Lihat</a></td>
						    </tr>
								<tr>
						      <td>Bandung</td>
									<td><?php echo $res_bdg; ?></td>
									<td><a href="<?php echo $base_url_member; ?>/demand/Bandung" class="btn btn-primary btn-xs">Lihat</a></td>
						    </tr>
						   </tbody>
						</table>
						<?php } ?>
					</div>
 				</div>
			</div>
		</div>
	</div>
</section>
