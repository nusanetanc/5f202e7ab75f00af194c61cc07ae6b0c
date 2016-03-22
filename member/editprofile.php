<?php if ($level=="0"){  ?>
<?php	 
if(isset($_SESSION['groovy_message'])){ 
	?>
	<script>
		$(document).ready(function(){
		$("#validate").show();
	});
	</script> <?php 
					$groovy_message_status=$_SESSION['groovy_message_status'];
					$groovy_message=$_SESSION['groovy_message'];
				unset($_SESSION["groovy_message"]); 
				unset($_SESSION["groovy_message_status"]);
		} else { ?>
	<script>
	 $(document).ready(function(){
		$("#validate").hide();
	});	
	</script> <?php } ?>
<?php
	if(isset($_POST['save'])){
								$editNama=$_POST['editNama'];
								$editEmail=$_POST['editEmail'];
								$editPhone=$_POST['editPhone'];
								$editPasswordlama=$_POST['editPasswordlama'];
								$editPasswordbaru1=$_POST['editPasswordbaru1'];
								$editPasswordbaru2=$_POST['editPasswordbaru2'];
								
if($editNama=="" || $editEmail=="" || $editPhone==""){	
				$_SESSION['groovy_message_status']="danger";
				$_SESSION['groovy_message']="Edit profile data failed";
 } 
 else if (($editPasswordlama<>"" || $editPasswordbaru1<>"" || $editPasswordbaru2<>"") && ($editPasswordlama=="" || $editPasswordbaru1=="" || $editPasswordbaru2=="" || $editPasswordbaru1<>$editPasswordbaru2 || $password<>$editPasswordlama)) { 
				$_SESSION['groovy_message_status']="danger";
				$_SESSION['groovy_message']="Edit profile data failed";
 } else {
 	if ($editPasswordlama=="" || $editPasswordbaru1=="" || $editPasswordbaru2==""){
 		$editPasswordbaru1=$password;
 	}

				$lokasifile= $_FILES['editKTP']['tmp_name'];
				$fileName = $_FILES['editKTP']['name']; 
				$dir = "./ktp/";
				$move = move_uploaded_file($lokasifile, "$dir".$fileName);
	$lokasifile1= $_FILES['editFoto']['tmp_name'];
	$fileName1 = $_FILES['editFoto']['name']; 
	$dir1 = "./foto/";
	$move1 = move_uploaded_file($lokasifile1, "$dir1".$fileName1);
	if ($fileName==""){
	$fileName = $ktp;	
	}
if ($fileName1==""){
$fileName1 = $foto;	
}
	$update_user=$col_user->update(array("id_user"=>$id),array('$set'=>array("nama"=>$editNama,"email"=>$editEmail, "password"=>$editPasswordbaru1,"phone"=>$editPhone,"ktp"=>$fileName, "foto"=>$fileName1)));
if ($update_user){ 
					$_SESSION['groovy_message_status']="success";
					$_SESSION['groovy_message']="Edit profile data success";
 } }
 					?>
						<script type="" language="JavaScript">
						document.location='<?php echo $base_url_member; ?>/?hal=editprofile'</script>
					<?php }
  ?>
<section>
	<div class="col-sm-12" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-body" style="background-color:#FF5722;">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">MEMBER - EDIT PROFILE</h3>
  				</div>
  				<div class="panel-body">
  					<form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
  					<div class="col-sm-3">
  						<?php if ($foto=="" || $foto==null){ ?>
  						<img class="profile-img-card profile-img-card-xlrg" src="../img/Avatar_member.png"/>
  						<?php } else { ?>
  						<img class="profile-img-card profile-img-card-xlrg" src="./foto/<?php echo $foto ?>"/>
  						<?php } ?>
						<br/><br/><br/>
						<h4>Change Profile Photo</h4>
						<input type="file" id="editFoto" name="editFoto">								
					</div>	
					<div class="col-sm-9">	
			  				<div name="validate" id="validate" class="alert alert-dismissible alert-<?php echo $groovy_message_status; ?>">
							  	<button type="button" class="close" data-dismiss="alert">x</button>
							  	<p><?php echo $groovy_message; ?></p>
							</div>
									  <fieldset>
						    <div class="form-group">
						      <label for="editNama" class="col-lg-2 control-label">Nama Lengkap</label>
						      <div class="col-sm-10">
						        <input type="text" class="form-control" id="editNama" name="editNama" value="<?php echo $nama; ?>">
						      	<br/>
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="editEmail" class="col-lg-2 control-label">Email</label>
						      <div class="col-lg-10">
						        <input type="email" class="form-control" id="editEmail" name="editEmail" value="<?php echo $email; ?>">
						        <br/>
						      </div>
						    </div>	
						    <div class="form-group">
						      <label class="col-lg-2 control-label">Customer ID</label>
						      <div class="col-lg-10">
						        <h4><?php echo $id; ?></h4>
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
						      <label class="col-lg-2 control-label">Password</label>
						      <div class="col-lg-10">
						        <input type="password" class="form-control" id="editPasswordlama" name="editPasswordlama" placeholder="Masukan Password Lama Anda">
						        <br/>
						        <input type="password" class="form-control" id="editPasswordbaru1" name="editPasswordbaru1" placeholder="Masukan Password Baru Anda">
						        <br/>
						        <input type="password" class="form-control" id="editPasswordbaru2" name="editPasswordbaru2" placeholder="Masukan Lagi Password Baru Anda">
						        <br/>
						      </div>
						    </div>							    
						    <div class="form-group">
						      <label for="editKTP" class="col-lg-2 control-label">KTP</label>
						      <div class="col-lg-10">
						        <input type="file" id="editKTP" name="editKTP">
						        <br/>
						      </div>
						    </div>
						    <br/>
						    <div class="form-group">
						      <label for="editTempat" class="col-lg-2 control-label">Tempat Pemasangan</label>
						      <div class="col-lg-9">
						      	<h5><?php echo $tempat.', '.$keterangan.', '.$kota; ?></h5>
						       	<br/>
						        <div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>	
						        <br/>
						        <button class="btn btn-default" type="submit" name="save" id="save">Save Change</button>
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
<?php } else { ?>
<?php	 
if(isset($_SESSION['groovy_message'])){ 
	?>
	<script>
		$(document).ready(function(){
		$("#validate").show();
	});
	</script> <?php 
					$groovy_message_status=$_SESSION['groovy_message_status'];
					$groovy_message=$_SESSION['groovy_message'];
				unset($_SESSION["groovy_message"]); 
				unset($_SESSION["groovy_message_status"]);
		} else { ?>
	<script>
	 $(document).ready(function(){
		$("#validate").hide();
	});	
	</script> <?php } ?>
<?php
	if(isset($_POST['save'])){
							$editPhone=$_POST['editPhone'];
							$editPasswordlama=$_POST['editPasswordlama'];
							$editPasswordbaru1=$_POST['editPasswordbaru1'];
							$editPasswordbaru2=$_POST['editPasswordbaru2'];

if ($editPhone==""){
	$_SESSION['groovy_message_status']="danger";
	$_SESSION['groovy_message']="Edit profile data failed";
}							
	 else if (($editPasswordlama<>"" || $editPasswordbaru1<>"" || $editPasswordbaru2<>"") && ($editPasswordlama=="" || $editPasswordbaru1=="" || $editPasswordbaru2=="" || $editPasswordbaru1<>$editPasswordbaru2 || $password<>$editPasswordlama)) { 
				$_SESSION['groovy_message_status']="danger";
				$_SESSION['groovy_message']="Edit profile data failed";
 } else {
 	if ($editPasswordlama=="" || $editPasswordbaru1=="" || $editPasswordbaru2==""){
 		$editPasswordbaru1=$password;
 	}
$update_user=$col_user->update(array("id_user"=>$id),array('$set'=>array("password"=>$editPasswordbaru1,"phone"=>$editPhone)));							
if ($update_user){ 
					$_SESSION['groovy_message_status']="success";
					$_SESSION['groovy_message']="Edit profile data success";
 } } 
 					?>
						<script type="" language="JavaScript">
						document.location='<?php echo $base_url_member; ?>/?hal=editprofile'</script>
					<?php } ?>
<section>
	<div class="col-sm-12" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel panel-success" >
  				<div class="panel-heading">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">STAFF - EDIT PROFILE</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<div class="col-sm-2">
  						<img class="profile-img-card profile-img-card-xlrg" src="./foto/<?php echo $foto ?>"/>						
					</div>	
					<div class="col-sm-10">	
							<div name="validate" id="validate" class="alert alert-dismissible alert-<?php echo $groovy_message_status; ?>">
							  	<button type="button" class="close" data-dismiss="alert">x</button>
							  	<p><?php echo $groovy_message; ?></p>
							</div>
						<form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
						  <fieldset>
						    <div class="form-group">
						      <label for="editNama" class="col-lg-2 control-label">Nama Lengkap</label>
						      <div class="col-lg-10">
						        <h4><?php echo $nama; ?></h4>
						      	
						      	<br/>
						      </div>
						    </div>
						    <div class="form-group">
						      <label for="editEmail" class="col-lg-2 control-label">Email</label>
						      <div class="col-lg-10">
						        <h4><?php echo $email; ?></h4>
						        <br/>
						      </div>
						    </div>	
						    <div class="form-group">
						      <label class="col-lg-2 control-label">ID</label>
						      <div class="col-lg-10">
						        <h4><?php echo $id; ?></h4>
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
						        <button class="btn btn-default" type="submit" name="save" id="save">Save Change</button>
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