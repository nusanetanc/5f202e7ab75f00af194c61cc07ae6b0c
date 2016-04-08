<script >
    $(document).ready(function(){
        $('#share-succses').hide();
});</script> 
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
if(isset($_POST['share'])){
				$text = 'abcdefghijklmnopqrstuvwxyz123457890';
		        $panjang = 40;
		        $txtlen = strlen($text)-1;
		        $id_info = '';
		        for($i=1; $i<=$panjang; $i++){
		            $id_info .= $text[rand(0, $txtlen)];
		        }    
				$inputTanggal = $_POST['inputTanggal'];
				$inputTempat = $_POST['inputTempat'];
				$inputSubject = $_POST['inputSubject'];
				$inputDescription = $_POST['inputDescription'];
				$inputStatus = $_POST['inputStatus'];
				$date = date("Y/m/d H:i:s");
					$thn = substr($inputTanggal, 0,4);
				    $bln = substr($inputTanggal, 5,2);
					$tgl = substr($inputTanggal, 8,10);
				    $month = bulan($bln);
$info=array(
			"share_id"=>$id,
			"description"=>$inputDescription,
			"date"=>$date
		);					
$insert = $col_info->insert(array("id_info"=>$id_info, "tempat"=>$inputTempat, "subject"=>$inputSubject, "tanggal_update"=>$date,
									"tanggal_maintenance"=>$inputTanggal, "status"=>$inputStatus, "informasi"=>array($info)));
			if ($inputTempat=="All"){
				$res0 = $col_user->find(array("level"=>"0"));
			} else{
				$res0 = $col_user->find(array("tempat"=>$inputTempat, "level"=>"0"));
			}
				foreach($res0 as $row0)
				  { 
			// mail for customer to info
			$to = $row0['email'];

			$subject = 'Info groovy ('.$inputSubject.')';

			$message = '
			<html>
				<body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
				    <div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
				        <div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
				            <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
				        </div>
				        <div style="padding:20px;color:#333;"> 
				            <p style="font-size:20px;font-weight:bold;line-height:1px">Info untuk pengguna layanan Groovy</p>
				            <p>Pada tanggal '.$tgl.' '.$month.' '.$thn.', ada  '.$inputDescription.'<br/>
				            Mohon maaf atas ketidaknyamananya.</p> 
				            <p style="color:#888;">Terimakasih<br/>
				            Helpdesk</p>
				        </div>
				        </div>
				    </div>        
				</body>
				</html>
			';

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			$headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";

			$share_email = mail($to, $subject, $message, $headers);
		}
if ($insert && $share_email){
	?>
	<script >
    	$(document).ready(function(){
        $('#share-succses').show();
});</script>
<?php	}
}
?>
<style>
    .datepicker{z-index:1151;}
</style>
    <script>
    	$(function(){
        $("#inputTanggal").datepicker({
      	format:'yyyy/mm/dd'
        });
            });
    </script>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-body" style="background-color:#37474f;">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">INFO MAINTENANCE - SHARE</h3>
  				</div>
  				<div class="panel-body">
  				<div name="share-succses" id="share-succses" class="alert alert-dismissible alert-success">
				  <button type="button" class="close" data-dismiss="alert">x</button>
				  <strong>Well done!</strong> Share information successful <a href="<?php echo $base_url_member; ?>/?hal=information" class="alert-link">See the list of information</a>.
				</div>
  					<div class="col-sm-4">
						<div class="form-group">
						  <input type="text" class="form-control" id="inputTanggal" name="inputTanggal" placeholder="Date" required>
						</div>
					</div>	
  					<div class="col-sm-8">
						<div class="form-group">
						  <select class="form-control" id="inputTempat" name="inputTempat" required>
					        <option value="" disabled="disabled" selected>Location</option>
					                                        <?php
                                    $res = $col_location->find();
                                    foreach($res as $row) 
                                                {   
                                                  ?>
                                <option><?php echo $row['name']; ?></option>
                                <?php } ?>
                                <option>All</option>
					       </select>
						</div>
					</div>	
					<div class="col-sm-12">
						<div class="form-group">
							<input type="text" class="form-control" id="inputSubject" name="inputSubject" placeholder="Subject" required>
						</div>
					</div>		
					<div class="col-sm-12">
						<div class="form-group">
							<textarea class="form-control" rows="3" id="inputDescription" name="inputDescription" placeholder="Description" required></textarea>
						</div>
					</div>	
  					<div class="col-sm-4">
						<div class="form-group">
						  <select class="form-control" id="inputStatus" name="inputStatus" required>
					        <option value="" disabled="disabled" selected>Status</option>
					        <option>on schedule</option>
					        <option>on progress</option>
					        <option>done</option>
					       </select>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<button name="share" id="share" class="btn btn-success">SHARE</button>		
						</div>
					</div>																	
 				</div>
			</div>
		</div>
	</div>	
</section>