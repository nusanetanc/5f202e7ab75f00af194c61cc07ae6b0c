<?php
	if(isset($_POST['submit'])){
		$id_sup=$_POST['inputId'];
		$nama_sup=$_POST['inputNama'];
		$email_sup=$_POST['inputEmail'];
		$phone_sup=$_POST['inputPhone'];
	$lokasifile= $_FILES['inputPhoto']['tmp_name'];
	$fileName = $_FILES['inputPhoto']['name']; 
	$dir = "<?php echo $base_url_member; ?>/foto/";
	$move = move_uploaded_file($lokasifile, "$dir".$fileName);
if ($fileName==""){
	$fileName="staff.jpg";
}
$add_support = $col_user->insert(array("id_user"=>$id_sup, "nama"=>$nama_sup, "email"=>$email_sup, "sm"=>$id, "level"=>"501", "password"=>"g56789", "aktif"=>"1", "phone"=>$phone_sup, "foto"=>$fileName));
if ($add_support){ 
	$to=$email_sup;
    $subject = 'User untuk groovy.id';

    $message = '
    <html>
    <body>
      <p>Nama : '.$nama_sup.'<br/>
      	 Email : '.$email_sup.'<br/>
      	 Level Akses : Sales<br/>
      	 Password : g56789 <br/>
      	 Karena password default, silahkan login dan ganti password anda.<br/>
      </p>
      <br/>
      <br/>
      <p>groovy.id</p>
    </body>
    </html>
    ';

    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
    $headers .= 'Cc: cs@groovy.id' . "\r\n";

    mail($to, $subject, $message, $headers);
	?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/?hal=sales-list'</script>
<?php	}
}
?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Tambah Sales Groovy</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>"  method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<form class="form-horizontal">
								  <fieldset>
									<div class="form-group">
									  <label class="control-label" for="inputNama">No Id Karyawan</label>
									  <input type="number" class="form-control" id="inputId" name="inputId" placeholder="Masukan Id Support">
									</div>								  
									<div class="form-group">
									  <label class="control-label" for="inputNama">Nama</label>
									  <input type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Masukan Nama Support">
									</div>
									<div class="form-group">
									  <label class="control-label" for="inputEmail">Email</label>
									  <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Masukan Email Support">
									</div>	
									<div class="form-group">
									  <label class="control-label" for="inputPhone">No Telpon</label>
									  <input type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Masukan No Telpon Support">
									</div>	
									<div class="form-group">
									  <label class="control-label" for="inputPhone">Photo</label>
									  <input type="File" name="inputPhoto" id="inputPhoto">
									</div>
									<div class="form-group">
									<input type="submit" id="submit" name="submit" class="btn btn-block" style="background-color:#FF6D20; color:white; font-weight:600;" value="Submit">
									</div>
								   </fieldset>
								</form>    
		  				    </div>
		  				 </div>
		  				 </form>
		  				 </div>
		  	</div>
		</div>
	</div>
</section>		  				    	