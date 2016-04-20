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
						      <th width="20%">Nama</th>
                  <th width="10%">Paket</th>
						      <th width="50%">Tempat</th>
						      <th width="20%">Kota</th>
						    </tr>
						  </thead>
						  <?php
						  $status=$_GET['status'];
								$res = $col_demand->find()->sort(array("kota"));
								foreach($res as $row)
								{
						?>
						  <tbody>
						    <tr>
						      <td><?php echo $row['nama']; ?></td>
						      <td><?php echo $row['paket']; ?></td>
                  <td><?php echo $row['alamat']; ?></td>
						      <td><?php echo $row['kota']; ?></td>
						    </tr>
						   </tbody>
						<?php
							}
						?>
						</table>
					</div>
 				</div>
			</div>
		</div>
	</div>
</section>
