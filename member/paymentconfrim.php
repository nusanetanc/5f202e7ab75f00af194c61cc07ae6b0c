<form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php 
if(isset($_POST['kirim'])) {
	$inputBank=$_POST['bank'];
	$lokasifile= $_FILES['struk']['tmp_name'];
	$fileName = $_FILES['struk']['name']; 
	$dir = "./struk/";
	$move = move_uploaded_file($lokasifile, "$dir".$fileName);
	$date = date("Y/m/d"); 
$bayar=array(
			"no_invoice"=>$invoice,
			"tanggal_pembayaran"=>$date,
			"tanggal_konfirmasi"=>"",
			"struk"=>$fileName,
			"paket"=>$paket,
			"bank"=>$inputBank,
			"harga"=>$harga
		);	
$insert = $col_user->update(
								array("id_user"=>$id),
								array('$set'=>array("pembayaran"=>"1"),
					   			'$push'=>array("bayar"=>$bayar))); 
if ($insert){
		  		?>
				<script type="" language="JavaScript">
				document.location='<?php echo $base_url_member; ?>/?hal=listpayment'</script>
	<?php 	} }
?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PAYMENT - KONFIRMASI PEMBAYARAN</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<div class="col-sm-12">
						<li class="list-group-item">
						  Nama : <?php echo $nama; ?>
						</li>	
						<li class="list-group-item">
						  Customer ID : <?php echo $id; ?>
						</li>	
						<li class="list-group-item">
						  Email : <?php echo $email; ?>
						</li>
						<li class="list-group-item">
						  Paket : <?php echo $paket; ?>
						</li>
						<li class="list-group-item">
						  Harga : <?php echo $harga.',-'; ?>
						</li>
						<li class="list-group-item">
						  Transfer Ke Bank : 
						   <select class="form-control" id="bank" name="bank">
					          <option>Mandiri</option>
					          <option>Bri</option>
					          <option>Bca</option>
					       </select>
						</li>						
						<li class="list-group-item">
						  Struk Pembayaran : <input type="file" id="struk" name="struk">
						</li>	
						<br/>	
						<button class="btn btn-warning" type="submit" name="kirim" id="kirim">KONFIRMASI</button>									
					</div>	
 				</div>
			</div>
		</div>
	</div>	
</section>
</form>