<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Kirim Invoice Customer</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>"  method="post">
	  				    <div class="row">
	  				    	<div class="col-sm-12">
		  				    	<form class="form-horizontal">
								  <fieldset>
									<div class="form-group">
									  <label class="control-label" for="inputPaket">Nama Paket</label>
									  <input type="text" class="form-control" id="inputPaket" name="inputPaket" placeholder="Masukan Nama Paket">
									</div>
									<div class="form-group">
									  <label class="control-label" for="inputHarga">Harga</label>
									  <input type="text" class="form-control" id="inputHarga" name="inputHarga" placeholder="Masukan Harga Paket">
									</div>
									<div class="form-group">
									  <label class="control-label" for="inputHargahari>Harga/Hari</label>
									  <input type="text" class="form-control" id="inputHargahari" name="inputHargahari" placeholder="Masukan Harga Paket Perhari">
									</div>
									<div class="form-group">
									  <label class="control-label" for="inputDeskripsi">Deskripsi</label>
									  <textarea name="inputDeskripsi" id="inputDeskripsi" class="form-control" rows="3" id="textArea" placeholder="Masukan Deskripsi Paket"></textarea>
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
