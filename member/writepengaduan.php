<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
if ($_GET['a']=="close"){
	$a = $_GET['a'];
$update = $col_ticket->update(
								array("id_user"=>$id),
								array('$set'=>array("status"=>$a))); 
}
if ($update){ ?>
				<script type="" language="JavaScript">
				document.location='<?php echo $base_url_member; ?>/?hal=writepengaduan'</script>
<?php }
if(isset($_POST['kirim'])){
							$subject=$_POST['subject'];
							$kategori=$_POST['kategori'];
							$message=$_POST['message'];
							$to=$_POST['to'];
							$date = date("Y/m/d H:i:s");
							$dateopen = date("Y/m/d");
							$text = 'abcdefghijklmnopqrstuvwxyz123457890';
							$panjang = 45;
							$txtlen = strlen($text)-1;
							$result = '';
for($i=1; $i<=$panjang; $i++){
								$result .= $text[rand(0, $txtlen)];
							 }
$res = $col_user->find(array("id_user"=>$id));
foreach($res as $row)
					{ 
					  $fromname=$row['nama'];
					}
$msg=array(
			"reply_level"=>"0",
			"reply_name"=>$fromname,
			"reply_id"=>$id,
			"message"=>$message,
			"date"=>$date
		  );	
$insert = $col_ticket->insert(array("idchat"=>$result, "id_user"=>$id, "subject"=>$subject, "kategori"=>$kategori, "dateopen"=>$dateopen,
									"name"=>$fromname, "status"=>"open", "message"=>(array($msg))));
if ($insert) { ?>
				<div class="col-sm-9">
					<div class="alert alert-dismissible alert-success">
						<button type="button" class="close" data-dismiss="alert">X</button>
						<strong>Well done! </strong>You send a complaint successful <a href="./?hal=listpengaduan" class="alert-link">Please see the list of your complaints</a>.
					</div>
				</div>	
<?php 
			}		
				}
?>
<section>
	<div class="col-sm-9">
		<div class="list-group">
			<div class="panel panel-danger" >	
  				<div class="panel-heading">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">PENGADUAN-TULIS PENGADUAN</h3>
  				</div>
  				<br/>	
  					<div class="panel-body">		
  							<div class="col-sm-4">	
	       						<select class="form-control" id="kategori" name="kategori">
							       <option disabled selected="selected">Pilih Kategori</option>
							       <option>Tv</option>
							       <option>Internet</option>
							       <option>Billing</option>
							     </select>
	      					</div>
	      					<div class="col-sm-8">	
	       						 <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
	      					</div>
	      					<div class="col-sm-12">
	      						<br/>
	       						<textarea class="form-control" rows="3" id="message" name="message" placeholder="Message" required></textarea>
	       						<br/>
								<div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>
								<br/>
								<button class="btn btn-default background-btn-red" type="submit" name="kirim" id="kirim">KIRIM</button>
							</div>	
					</div>				
			</div>
		</div>
	</div>		
</section>
</form>