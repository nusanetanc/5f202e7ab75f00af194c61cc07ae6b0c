<?php if ($level=="0"){  ?>
<section>
	<div class="col-sm-12" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-body" style="background-color:#FF5722;">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">MEMBER - EDIT PROFILE</h3>
  				</div>
  				<div class="panel-body">
  					<form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
  						<?php if(isset($_POST['save'])) {
  								$lokasifile= $_FILES['editFoto']['tmp_name'];
								$fileName = $_FILES['editFoto']['name']; 
								$dir = "foto/";
							if($fileName<>"" || $fileName<>null){
								$move = move_uploaded_file($lokasifile, "$dir".$fileName);
								$update_user=$col_user->update(array("id_user"=>$id, "level"=>$level),array('$set'=>array("foto"=>$fileName)));
								$_SESSION["fotoedit"]="1";
  							} if($_POST['editEmail']<>"" || $_POST['editEmail']<>$email){
  								$update_user=$col_user->update(array("id_user"=>$id, "level"=>$level),array('$set'=>array("email"=>$_POST['editEmail']))); 
  								$_SESSION["emailedit"]="1";
  							} if($_POST['editPhone']<>"" || $_POST['editPhone']<>$notelp){
  								$update_user=$col_user->update(array("id_user"=>$id, "level"=>$level),array('$set'=>array("phone"=>$_POST['editPhone'])));	
  								$update_user=$col_history->update(array("id_cust"=>$id),array('$set'=>array("phone_customer"=>$_POST['editPhone'])));
  								$_SESSION["phoneedit"]="1";
  							} if($_POST['editPasswordlama']<>"" && $_POST['editPasswordbaru1']<>"" && $_POST['editPasswordbaru2']<>"" && $_POST['editPasswordbaru1']==$_POST['editPasswordbaru2'] && $_POST['editPasswordlama']==$password && $_POST['editPasswordlama']<>$_POST['editPasswordbaru1']){
  								$update_user=$col_user->update(array("id_user"=>$id, "level"=>$level),array('$set'=>array("password"=>$_POST['editPasswordbaru1'])));
  								$_SESSION["passwordedit"]="1";
  							} ?>
  								<script type="" language="JavaScript">
								document.location='<?php echo $base_url_member; ?>/edit-profile'</script>
  						<?php } ?>
  					<div class="col-sm-3">
  						<?php if ($foto=="" || $foto==null){ ?>
  						<img class="profile-img-card profile-img-card-xlrg" src="../img/default-avatar-groovy2.png"/>
  						<?php } else { ?>
  						<img class="profile-img-card profile-img-card-xlrg" src="./foto/<?php echo $foto ?>"/>
  						<?php } ?>
						<br/><br/><br/>
						<h4>Profile Photo</h4>
						<input type="file" id="editFoto" name="editFoto">							
					</div>	
					<div class="col-sm-9">	
						<fieldset>
						   	<div class="form-group">
						      <label for="editEmail" class="col-lg-2 control-label">Email</label>
						      <div class="col-lg-10">
						        <input type="email" class="form-control" id="editEmail" name="editEmail" value="<?php echo $email; ?>">
						        <br/>
						      </div>
						    </div>	
						   	<div class="form-group">
						      <label for="editPhone" class="col-lg-2 control-label">Phone Number</label>
						      <div class="col-lg-10">
						        <input type="text" class="form-control" id="editPhone" name="editPhone" value="<?php echo $notelp; ?>">
						        <br/>
						      </div>
						    </div>
						   	<div class="form-group">
						      <label class="col-lg-2 control-label">Ganti Password</label>
						      <div class="col-lg-10">
						        <input type="password" class="form-control" id="editPasswordlama" name="editPasswordlama" placeholder="Masukan Password Lama Anda">
						        <br/>
						        <input type="password" class="form-control" id="editPasswordbaru1" name="editPasswordbaru1" placeholder="Masukan Password Baru Anda">
						        <br/>
						        <input type="password" class="form-control" id="editPasswordbaru2" name="editPasswordbaru2" placeholder="Masukan Lagi Password Baru Anda">
						        <br/>
						        <div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>	
						        <br/>
						        <input type="submit" class="btn btn-default" type="submit" name="save" id="save" value="Save Change">
						        <br/>
						      </div>
						    </div>			    						    						    						    						    						    
						  </fieldset>
						</form>    		
					</div>	
 				</div>
			</div>
		</div>
	</div>	
</section>
<?php } else {
if(isset($_POST['save0'])){  
	if($_POST['editPasswordlama']<>"" && $_POST['editPasswordbaru1']<>"" && $_POST['editPasswordbaru2']<>"" && $_POST['editPasswordbaru1']==$_POST['editPasswordbaru2'] && $_POST['editPasswordlama']==$password && $_POST['editPasswordlama']<>$_POST['editPasswordbaru1']){
			$update_user=$col_user->update(array("id_user"=>$id, "level"=>$level),array('$set'=>array("password"=>$_POST['editPasswordbaru1'])));
			unset($_SESSION["id"]);
			unset($_SESSION["level"]); ?>
	<script type="" language="JavaScript">
		document.location='<?php echo $base_url; ?>/signin'</script>
	<?php } }?>
<section>
<div class="col-sm-12" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-body" style="background-color:#FF5722;">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">STAFF - EDIT PROFILE</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<div class="col-sm-2">
  						<img class="profile-img-card profile-img-card-xlrg" src="./foto/<?php echo $foto ?>"/>						
					</div>	
						<form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
						  <fieldset>
						    <div class="form-group">
						      <label for="editPassword" class="col-lg-2 control-label">Password</label>
						      <div class="col-lg-10">
						        <input type="password" class="form-control" id="editPasswordlama" name="editPasswordlama" placeholder="Masukan Password Lama Anda">
						        <br/>
						        <input type="password" class="form-control" id="editPasswordbaru1" name="editPasswordbaru1" placeholder="Masukan Password Baru Anda">
						        <br/>
						        <input type="password" class="form-control" id="editPasswordbaru2" name="editPasswordbaru2" placeholder="Masukan Lagi Password Baru Anda">
						        <br/>
						        <div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>	
						        <br/>
						        <button class="btn btn-default" type="submit" name="save0" id="save0">Save Change</button>
						      </div>
						    </div>			    						    						    						    						    						    
						  </fieldset>	
						</form>    		
					</div>	
 				</div>
			</div>
		</div>
	</div>	
</section>
<?php }?>