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
						<table class="table table-striped table-hover ">
						  <thead>
						    <tr>
						      <th width="30%">Kota</th>
									<th width="30%">Jumlah</th>
						    </tr>
						  </thead>
						  <?php
								$res_jakut = $col_demand->find(array("kota_customer"=>"Jakarta Utara"))->count();
								$res_jaksel = $col_demand->find(array("kota_customer"=>"Jakarta Selatan"))->count();
								$res_jakbar = $col_demand->find(array("kota_customer"=>"Jakarta Barat"))->count();
								$res_jaktim = $col_demand->find(array("kota_customer"=>"Jakarta Timur"))->count();
								$res_jakpus = $col_demand->find(array("kota_customer"=>"Jakarta Pusat"))->count();
								$res_bdg = $col_demand->find(array("kota_customer"=>"Bandung"))->count();
						?>
						  <tbody>
						    <tr>
						      <td>Jakarta Utara</td>
									<td><?php echo $res_jakut; ?></td>
						    </tr>
								<tr>
						      <td>Jakarta Selatan</td>
									<td><?php echo $res_jaksel; ?></td>
						    </tr>
								<tr>
						      <td>Jakarta Barat</td>
									<td><?php echo $res_jakbar; ?></td>
						    </tr>
								<tr>
						      <td>Jakarta Timur</td>
									<td><?php echo $res_jaktim; ?></td>
						    </tr>
								<tr>
						      <td>Jakarta Pusat</td>
									<td><?php echo $res_jakpus; ?></td>
						    </tr>
								<tr>
						      <td>Jakarta Bandung</td>
									<td><?php echo $res_bdg; ?></td>
						    </tr>
						   </tbody>
						</table>
					</div>
 				</div>
			</div>
		</div>
	</div>
</section>
