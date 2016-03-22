<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
	$id_cust = $_GET['id'];
	$status_jobs = $_GET['status'];
	$nama_jobs = $_GET['job'];
	$res = $col_user->find(array("id_user"=>$id_cust));
	foreach($res as $row)
	{ 
		$email_cust = $row['email'];
        $nama_cust = $row['nama'];
        $notelp_cust = $row['phone'];
        $tempat_cust = $row['tempat'];
        $kota_cust = $row['kota'];
        $alamat_cust = $row['alamat'];
        $keterangan_cust = $row['keterangan'];
        $paket_cust = $row['paket'];
if (isset($_POST['save'])){
	$note = $_POST['inputNote'];
	$date = date("Y/m/d");
	$update_user = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("tanggal_aktivasi"=>$date, "status"=>"aktif"))); 
	$update_jobs = $col_history->update(array("id_customer"=>$id_cust, "status"=>$status_jobs, "hal"=>$nama_jobs),array('$set'=>array("catatan"=>$note, "status"=>"done", "tanggal_selesai"=>$date)));
} 

if ($update_user && $update_jobs){ ?>
				<script type="" language="JavaScript">
				document.location='<?php echo $base_url_member; ?>/?hal=jobs-list-pending'</script>	
<?php } }
$res = $col_history->find(array("id_customer"=>$id_cust, "status"=>$status_jobs, "hal"=>$nama_jobs));
foreach ($res as $row) {
	$jobs_report = $row['catatan'];
	$no_box = $row['no_box'];
	$nama_field = $row['field_engineer'];
	$nama_assfield = $row['ass_field'];
	$tanggal_kerja = $row['tanggal_kerja'];
		$thn = substr($tanggal_kerja, 0,4);
		$bln = substr($tanggal_kerja, 5,2);
		$tgl = substr($tanggal_kerja, 8,10);
		$month = bulan($bln);
	$tanggal_selesai= $row['tanggal_selesai'];
		$thn1 = substr($tanggal_selesai, 0,4);
		$bln1 = substr($tanggal_selesai, 5,2);
		$tgl1 = substr($tanggal_selesai, 8,10);
		$month1 = bulan($bln1);
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
    	$(document).ready(function(){
        $("#inputDate").hide();
        $("#inputStatus").change(function(){
	        var sts =  $("#inputStatus").val();
	        var done = "Selesai";
	        var prog = "Tunda";
	        if (sts==done){
	        	$("#inputDate").show();
        	} else if (sts==prog){
        		$("#inputDate").hide();
        	}

    })});
    </script>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;" >
  				<div class="panel-heading" style="background-color:#263238">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">JOBS - REPORT JOBS</h3>
  				</div>
  				<div class="panel-body">
  					<br/>
  					<?php if ($nama_field<>'') { ?>
					<div class="col-sm-12">	
						<form class="form-horizontal">
						  <fieldset>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Customer ID : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $id_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Customer : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $nama_cust.' / '.$email_cust.' / '.$notelp_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Location : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $tempat_cust.' / '.$keterangan_cust.' / '.$alamat_cust.' / '.$kota_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Package : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $paket_cust; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Jobs : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $nama_jobs; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">No Box Tv : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $no_box; ?></h4>
						      </div>
						    </div>	
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Jobs Date : </label>
						      <div class="col-lg-9">
						        <h4><td><?php echo $tgl.' '.$month.' '.$thn; ?></td></h4>
						      </div>
						    </div>	
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Status : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $status_jobs; ?></h4>
						      </div>
						    </div>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Support : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $nama_field.' / '.$nama_assfield; ?></h4>
						      </div>
						    </div>
						    <?php
						    	if($status_jobs=="done"){ ?>
						    		<div class="form-group">
								      <label class="col-lg-3 control-label">Jobs Report : </label>
								      <div class="col-lg-9">
								        <h4><?php echo $jobs_report; ?></h4>
								      </div>
								    </div> 
								    <div class="form-group">
								      <label class="col-lg-3 control-label">Date Jobs Report : </label>
								      <div class="col-lg-9">
								        <h4><?php echo $tgl1.' '.$month1.' '.$thn1; ?></h4>
								      </div>
								    </div> 
							<?php
						    	} else if($level=="301" && $status_jobs=="progress" && $nama_field==$nama){
						     ?>			    					    		    						    						    		
						    <div class="form-group">
						      <label for="inputNote" class="col-lg-3 control-label">Note</label>
						      <div class="col-lg-9">
						        <textarea type="text" class="form-control" id="inputNote" name="inputNote" placeholder="Note"></textarea>
						        <br/>
						        <div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>
						        <br/>
						      	<input type="submit" class="btn btn-default" name="save" id="save" value="SELESAI">
						      </div>
						    </div>	
						    <?php
						    	}
						    ?>	
						  </fieldset>	
						</form>    		
					</div>	
					<?php } ?>
 				</div>
			</div>
		</div>
	</div>	
</section>
</form>