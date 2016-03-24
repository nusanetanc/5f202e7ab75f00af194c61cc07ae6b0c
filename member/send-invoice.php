<?php
	if(isset($_GET['kirim'])){
		$id_cust = $_GET['kirim'];
		$update_user=$col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("nama"=>$editNama,"email"=>$editEmail)));
	}
?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-body"  style="background-color:#1B5E12">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">SEND INVOICE</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
					<div class="col-sm-12">	
						<table class="table table-striped table-hover ">
						  <thead>
						    <tr>
						      <th width="10%">ID Cust</th>
						      <th width="20%">Customer</th>
						      <th width="15">NO VA</th>
						      <th width="15%">Paket</th>
						      <th width="15%">Tgl Registrasi</th>
						      <th width="15%">Registrasi</th>
						      <th width="10%">Detail</th>
						    </tr>
						  </thead>
						  <?php
					$res = $col_user->find(array("level"=>"0"));
					foreach($res as $row) 
                      { 
                      	if($row['pembayaran']="0" && $row['no_virtual']==""){
                      	?>
						  <tbody>
						    <tr>
						      <td><?php echo $row['id_user']; ?></td>
						      <td><?php echo $row['nama'].' / '. $row['phone'].' / '.$row['email']; ?></td>
						      <td><?php echo $kode_perusahaan.$row['id_user']; ?></td>
						      <td><?php echo $row['paket']; ?></td>
						      <td><?php echo $row['tanggal_registrasi']; ?></td>
						      <td><?php echo $row['registrasi']; ?></td>
						      <td><b><a href="<?php echo $base_url_member; ?>/?hal=verification-payment&$kirim=<?php echo $row['id_user']; ?>" class="btn btn-primary btn-xs">Kirim Invoice</a></b></td>						      
						    </tr>
						   </tbody>
					<?php } } ?>	   
						</table>    
					</div>	
 				</div>
			</div>
		</div>
	</div>	
</section>