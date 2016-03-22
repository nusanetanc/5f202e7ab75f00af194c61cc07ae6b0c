<?php
	if(isset($_POST['submit'])){
			$inputTempat=$_POST['inputTempat'];
			$inputKota=$_POST['inputKota'];
			$inputAlamat=$_POST['inputAlamat'];

$add_tempat = $col_location->insert(array("name"=>$inputTempat, "city"=>$inputKota, "place"=>$inputAlamat));
if ($add_tempat){ ?>
		<script type="" language="JavaScript">
		document.location='<?php echo $base_url_member; ?>/?hal=location-list'</script>
<?php	}
}
?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Tambah Paket Groovy</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>"  method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<form class="form-horizontal">
								  <fieldset>
									<div class="form-group">
									  <label class="control-label" for="inputTempat">Nama Tempat</label>
									  <input type="text" class="form-control" id="inputTempat" name="inputTempat" placeholder="Masukan Nama Tempat">
									</div>		
									<div class="form-group">
									  <label class="control-label" for="inputKota">Nama Kota</label>						  
										<select style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" name = "inputKota" id="inputKota" class="form-control form-group-lg">
			                                <option disabled="disabled" selected>Masukan Nama Kota</option>
			                                <option>Jakarta Pusat</option>
			                                <option>Jakarta Selatan</option>
			                                <option>Jakarta Barat</option>
			                                <option>Jakarta Timur</option>
			                                <option>Jakarta Utara</option>
			                                <option>Bandung</option>
			                            </select>
			                        </div>
									<div class="form-group">
									  <label class="control-label" for="inputAlamat">Alamat Tempat</label>
									  <textarea name="inputAlamat" id="inputAlamat" class="form-control" rows="3" placeholder="Masukan Alamat Tempat"></textarea>
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