<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
	$id_jobs =new mongoId($_GET['id']);
	$res = $col_history->find(array("_id"=>$id_jobs));
foreach ($res as $row) {
	$id_cust = $row['id_cust'];
	$status_jobs = $row['status'];
	$nama_jobs = $row['hal'];
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
	$res = $col_user->find(array("id_user"=>$id_cust));
	foreach($res as $row)
	{
		$email_cust = $row['email'];
        $nama_cust = $row['nama'];
        $notelp_cust = $row['phone'];
        $package_cust = $row['paket'];
        $tempat_cust = $row['tempat'];
        $kota_cust = $row['kota'];
        $alamat_cust = $row['alamat'];
        $keterangan_cust = $row['keterangan'];
        $paket_cust = $row['paket'];
				$addon_cust = $row['addon'];
				$status_cust = $row['status'];
    }
		$date = date("Y/m/d");
		$date_years = date("Y");
		$date_month = date("m");
if(isset($_POST['aktif'])){
		if ($date_month=="12"){
			$next_month="01";
			$next_years=$date_years+1;
		} else {
			$next_month=$date_month+1;
			$next_years=$date_years;
		}
		if($next_month<10){
			$next_month = '0'.$next_month;
		}
		$histori=array(
					"tanggal"=>date("Y/m/d"),
					"hal"=> "Aktivasi Layanan",
					"keterangan"=>"Layanan sudah di aktivasi"
				);
$update_user1 = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$push'=>array("histori"=>$histori)));
$update_user = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$set'=>array("tanggal_aktivasi"=>$date, "status"=>"aktif", "tanggal_akhir"=>$next_years.'/'.$next_month.'/01')));
		// mail for customer to aktifasi
		$to1 = $email_cust;

		$subject1 = 'Aktivasi groovy';

		$message1 = '
		<html>
			<body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
					<div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
							<div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
									<a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
							</div>
							<div style="padding:20px;color:#333;">
									<p style="font-size:20px;font-weight:bold;line-height:1px">Terimakasih sudah menjadi pelanggan Groovy</p>
									<p>Kami sudah melakukan pemasangan dan aktivasi, terhitung dari tanggal : '.date("d").' '.bulan(date("m")).' '.date("Y").' layanan groovy anda sudah aktiv.<br/><br/>
									Jika ada pertanyaan lebih detail silahkan membuat pengaduan pada halaman member Anda. Selamat menikmati layanan Groovy</p>
									<p style="color:#888;">Terimakasih.</p>
							</div>
							</div>
					</div>
			</body>
			</html>
		';

		$headers1  = 'MIME-Version: 1.0' . "\r\n";
		$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$headers1 .= 'From: '.$email_support . "\r\n";

		$kirim_email1=mail($to1, $subject1, $message1, $headers1);

		// mail for billing or cs
		$to = $email_cs.', '.$email_billing;

		$subject = 'Info Aktivasi';

		$message = '
		<html>
		<body>
			<p>Customer Berikut Sudah aktiv: </p>
			<br/>
			<p>Customer : '.$id_cust.' / '.$nama_cust.' / '.$phone_cust.' / '.$email_cust.'</p>
			<p>Layanan : '.$package_cust.' / '.$addon_cust.'</p>
			<p>Tanggal Aktivasi : '.date("d/m/Y").'</p>
			<br/>
		</body>
		</html>
		';

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		$headers .= 'From: '.$email_support . "\r\n";

		$kirim_email=mail($to, $subject, $message, $headers);
if($kirim_email && $kirim_email1 && $update_user){ ?>
	<script type="" language="JavaScript"> alert('Layanan Customer Sudah Aktif');
	document.location='<?php echo $base_url_member; ?>/jobs/status/done'</script>
<?php } }
if (isset($_POST['save'])){
	$note = $_POST['inputNote'];
	$update_jobs = $col_history->update(array("id_cust"=>$id_cust, "status"=>$status_jobs, "hal"=>$nama_jobs),array('$set'=>array("catatan"=>$note, "status"=>"done", "tanggal_selesai"=>$date)));
				// mail for supevisior teknik
				$subject = 'Laporan Job Support - '.$nama_jobs.' - '.$nama.' - Coba Sistem';
				$message = '
				<html>
				<body>
				  <p>Berikut laporan kerja : </p>
				  <br/>
				  <p>ID Customer : '.$id_cust.'</p>
				  <p>Nama : '.$nama_cust.'</p>
				  <p>Tempat : '.$tempat_cust.', '.$ket_cust.', '.$kota_cust.'</p>
				  <p>Layanan : <b>'.$package_cust.'</b> '.$addon_cust.'</p>
				  <p>Paket : '.$no_box.'</p>
				  <p>Status : Done</p>
				  <p>Catatan Job : '.$note.'</p>
				  <br/>
				</body>
				</html>
				';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
				$headers .= 'Cc: cs@groovy.id' . "\r\n";
			$res = $col_user->find(array("level"=>"3"));
						foreach($res as $row) {
				$emailpasang=mail($row['email'], $subject, $message, $headers);
			}
	if($nama_jobs=="pasang"){
			$histori=array(
						"tanggal"=>date("Y/m/d"),
						"hal"=> "Pasang",
						"keterangan"=>"Pemasangan Selesai"
					); }
					if($nama_jobs=="maintenance"){
							$histori=array(
										"tanggal"=>date("Y/m/d"),
										"hal"=> "Maintenance",
										"keterangan"=>"Maintenance Selesai"
									); }
					if($nama_jobs=="bongkar"){
							$histori=array(
										"tanggal"=>date("Y/m/d"),
										"hal"=> "Ambil Perangkat",
										"keterangan"=>"Perangkat Yang di Gunakan Sudah di Ambil"
									); }
$update_user1 = $col_user->update(array("id_user"=>$id_cust, "level"=>"0"),array('$push'=>array("histori"=>$histori)));
}
if ($emailpasang && $update_jobs){ ?>
				<script type="" language="JavaScript"> alert('Laporan Kerja Tersimpan');
				document.location='<?php echo $base_url_member; ?>/jobs-list-pending'</script>
<?php }
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
						    </div><br/>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Customer : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $nama_cust.' / '.$email_cust.' / '.$notelp_cust; ?></h4>
						      </div>
						    </div><br/>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Location : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $tempat_cust.' / '.$keterangan_cust.' / '.$alamat_cust.' / '.$kota_cust; ?></h4>
						      </div>
						    </div><br/>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Layanan : </label>
						      <div class="col-lg-9">
						        <h4><b><?php echo $paket_cust; ?></b> <?php echo $addon_cust; ?></h4>
						      </div>
						    </div><br/>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Jobs : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $nama_jobs; ?></h4>
						      </div>
						    </div><br/>
								<?php if($no_box=="" || $no_box==null){ ?>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">No Box Tv : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $no_box; ?></h4>
						      </div>
						    </div><br/>
								<?php } ?>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Jobs Date : </label>
						      <div class="col-lg-9">
						        <h4><td><?php echo $tgl.' '.$month.' '.$thn; ?></td></h4>
						      </div>
						    </div><br/>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Status : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $status_jobs; ?></h4>
						      </div>
						    </div><br/>
						    <div class="form-group">
						      <label class="col-lg-3 control-label">Support : </label>
						      <div class="col-lg-9">
						        <h4><?php echo $nama_field.' / '.$nama_assfield; ?></h4>
						      </div>
						    </div><br/>
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
								    </div><br/>
							<?php	} else if($level=="301" && $status_jobs=="progress" && $nama_field==$nama){
						     ?>
						    <div class="form-group">
						      <label for="inputNote" class="col-lg-3 control-label">Note</label>
						      <div class="col-lg-9">
						        <textarea type="text" class="form-control" id="inputNote" name="inputNote" placeholder="Note"></textarea>
						        <br/>
						      	<input type="submit" class="btn btn-default" name="save" id="save" value="SELESAI">
						      </div>
						    </div>
						    <?php
							} if($status_jobs=="done" && $level=="3" && $status_cust=="progress pasang"){
						    ?>
								<br/>
								<input type="submit" class="btn btn-default" name="aktif" id="aktif" value="AKTIVASI">
						  </fieldset>
						</form>
					</div>
					<?php } } ?>
 				</div>
			</div>
		</div>
	</div>
</section>
</form>
