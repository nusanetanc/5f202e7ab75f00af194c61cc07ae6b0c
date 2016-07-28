
<?php
if (!isset($_SESSION["id"]))
{ ?>
    <script type="" language='javascript'>
    document.location='<?php echo $base_url; ?>'</script>
<?php }
        $id =$_SESSION["id"];
        $level = $_SESSION["level"];
  $res = $col_user->find(array("id_user"=>$id));
  foreach($res as $row)
                      {
                        $email = $row['email'];
                        $nama = $row['nama'];
                        $notelp = $row['phone'];
                        $password = $row['password'];
                        $foto = $row['foto'];
if ($level=="0"){
                        $tempat = $row['tempat'];
                        $kota = $row['kota'];
                        $alamat = $row['alamat'];
                        $pembayaran = $row['pembayaran'];
                        $keterangan = $row['keterangan'];
                        $paket = $row['paket'];
                        $harga = $row['harga'];
                        $foto = $row['foto'];
                        $ktp = $row['ktp'];
                        $tanggal_akhir = $row['tanggal_akhir'];
                        $tanggal_aktivasi = $row['tanggal_aktivasi'];
                        $no_virtual = $row['no_virtual'];
                        $registrasi = $row['registrasi'];
                        $status = $row['status'];
                        $proraide = $row['proraide'];
                        $move_paket = $row['move_paket'];
                        $move_harga = $row['move_harga'];
                        $move_request = $row['move_request'];
                        $no_invoice = $row['invoice'];
                      }
if($level=="501"){
                      $sm=$row['sm'];
}
                    }

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Groovy-<?php echo lev($level); ?></title>
<link rel="icon" href="<?php echo $base_url; ?>/img/groovy-favicon.png" type="image/png">
<nav class="navbar navbar-primary">
<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button style="float:left;margin-top:8px;" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar" style="background-color:#f9a825;"></span>
        <span class="icon-bar" style="background-color:#f9a825;"></span>
        <span class="icon-bar" style="background-color:#f9a825;"></span>
      </button>
      <a href="<?php echo $base_url_member; ?>"><img height="60px" src="<?php echo $base_url; ?>/img/groovy-logo-colour.png"/></a>
      <ul style="float:right;margin-right:15px;" class="dropdown nav navbar-nav navbar-right navbar-primary mobile-only">
          <li class="dropdown-toggle" data-toggle="dropdown">
              <?php if ($foto=="" || $foto==null){ ?>
                          <img style="width:35px;height:35px;margin-top:3px;margin-left:10px;cursor:pointer" class="profile-img-card profile-img-card-mdm" src="<?php echo $base_url; ?>/img/default-avatar-groovy.png"/>
       <?php } else { ?>
                  <img style="width:35px;height:35px; margin-top:3px;margin-left:10px;cursor:pointer" class="profile-img-card profile-img-card-mdm" src="<?php echo $base_url_member; ?>/foto/<?php echo $foto; ?>"/>
       <?php } ?>
          </li>
            <ul style="margin-left:-140px;" class="dropdown-menu">
              <li><a href="<?php echo $base_url_member; ?>/edit-profile">Edit Profile</a></li>
              <?php if ($level=="0" && $status=="aktif"){ ?>
              <li><a href="#" data-toggle="modal" data-target="#confrimtermination">Berhenti Berlanganan</a></li>
              <?php } elseif($level=="0" && $status=="unaktif"){ ?>
              <li><a href="#" data-toggle="modal" data-target="#confrimbackakctiv">Berlangganan kembali</a></li>
              <?php } ?>
              <li><a href="<?php echo $base_url_member; ?>/logout">Logout</a></li>
            </ul>
        </ul>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php
             $res = $col_menu->find(array("hakakses"=>$level));
             foreach($res as $row)
                      {
      ?>
      <ul class="nav navbar-nav">
        <li ><a href="<?php echo $base_url_member; ?>/<?php echo $row['file']; ?>"  style="font-size:14px;padding-top:20px;padding-bottom:19px;font-weight:500; color:gray;"><i style="padding-right:10px;" class="fa fa-<?php echo $row['image']; ?> fa-lg"></i><?php echo $row['title'].' '; ?></a></li>
      </ul>
      <?php } ?>
      <ul  class="dropdown nav navbar-nav navbar-right navbar-primary desktop-only">
          <li class="dropdown-toggle" data-toggle="dropdown">
              <?php if ($foto=="" || $foto==null){ ?>
                          <img style="width:45px;height:45px;margin-top:7px;margin-left:10px;cursor:pointer" class="profile-img-card profile-img-card-mdm" src="<?php echo $base_url; ?>/img/default-avatar-groovy.png"/>
       <?php } else { ?>
                  <img style="width:45px;height:45px;margin-top:7px;margin-left:10px;cursor:pointer" class="profile-img-card profile-img-card-mdm" src="<?php echo $base_url_member; ?>/foto/<?php echo $foto; ?>"/>
       <?php } ?>
          </li>
            <ul class="dropdown-menu">
              <li><a href="<?php echo $base_url_member; ?>/edit-profile">Edit Profile</a></li>
              <?php if ($level=="0" && $status=="aktif"){ ?>
              <li><a href="#" data-toggle="modal" data-target="#confrimtermination">Berhenti Berlanganan</a></li>
              <?php } elseif($level=="0" && $status=="unaktif"){ ?>
              <li><a href="#" data-toggle="modal" data-target="#confrimbackakctiv">Berlangganan kembali</a></li>
              <?php } ?>
              <li><a href="<?php echo $base_url_member; ?>/logout">Logout</a></li>
            </ul>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  <div class="col-sm-12 grey-background">
<div class="modal" name="confrimtermination" id="confrimtermination">
  <div class="modal-dialog">
    <div class="modal-content">
     <form style="form-group" method="post">
        <?php
        if (isset($_POST['terminationsend'])) {
          if ($_POST['selectalasantermination']=="Other" && $_POST['textalasantermination']=="" ) { ?>
      <p class="text-danger">Tolong isi alasan anda berhenti berlangganan.</p>
<?php  } else {
        // mail for billing dan cs
        $subject = 'Permintaan Berhenti Berlanganan';
        $message = '
        <html>
        <body>
          <p>Permintaan berhenti berlangganan, berikut data customernya : </p>
          <br/>
          <p>ID Customer : '.$id.'</p>
          <p>Nama : '.$nama.'</p>
          <p>Tempat : '.$tempat.', '.$ket.', '.$kota.'</p>
          <p>Tanggal Permintaan : '.date("d-m-Y").'</p>
          <p>Paket : '.$paket.'</p>
          <p>Alasan Penutupan : '.$_POST['selectalasantermination'].'</p>
          <br/>
        </body>
        </html>
        ';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
        $headers .= 'Cc: cs@groovy.id' . "\r\n";
      $res = $col_user->find(array("level"=>"2"));
            foreach($res as $row)
                      {
        $emailpasang=mail($row['email'], $subject, $message, $headers);
      }

      // mail for customer to berhenti berlangganan

      $subject1 = 'Permintaan Berhenti Berlangganan';

      $message1 = '
      <html>
        <body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
            <div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
                <div style="background: linear-gradient(to right, #f9a825 , #fdd835);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
                    <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
                </div>
                <div style="padding:20px;color:#333;">
                    <p style="font-size:20px;font-weight:bold;line-height:1px">Terimakasih sudah menjadi customer Groovy</p>
                    <p>Anda melakukan permintaan berhenti berlangganan pada tanggal : '.date("d").' '.bulan(date("m")).' '.date("Y").'.</p>
                    <p style="color:#888;">Kami akan segera memproses permintaan anda</p>
                </div>
                </div>
            </div>
        </body>
        </html>

      ';

      $headers1  = 'MIME-Version: 1.0' . "\r\n";
      $headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

      $headers1 .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
      $headers1 .= 'Cc: cs@groovy.id' . "\r\n";

      $kirim_email1=mail($email, $subject1, $message1, $headers1);
      $histori=array(
            "tanggal"=>date("Y/m/d"),
            "hal"=> "Berhenti Berlangganan",
            "keterangan"=>"Permintaan Berhenti Berlangganan"
          );
        $update_user = $col_user->update(array("id_user"=>$id, "level"=>"0"),array('$push'=>array("histori"=>$histori)));
    } }  ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Permintaan Berhenti Berlanganan</h4>
      </div>
      <div class="modal-body">
        <p>Alasan Berhenti Berlangganan</p>
        <p>
        <select class="form-control" name="selectalasantermination" id="selectalasantermination">
          <option>Harga Mahal</option>
          <option>Jaringan Internet Tidak Stabil</option>
          <option>Chanel Tv Bermasalah</option>
          <option value="Other">Other</option>
        </select>
        </p>
        <p><input type="text" class="form-control" id="textalasantermination" name="textalasantermination" placeholder="Alasan Penutupan"></p>
        <p><div style="margin-bottom:7px;" class="g-recaptcha" data-sitekey="6Ldx_BsTAAAAAOYrQegHLVhslSvd6z78zAr-4Knc"></div></p>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-default" data-dismiss="modal" value="Batal">
        <input type="submit" class="btn btn-primary" value="Kirim" name="terminationsend" id="terminationsend">
      </div>
    </div>
    </form>
  </div>
</div>
<div class="modal" name="confrimbackakctiv" id="confrimbackakctiv">
  <div class="modal-dialog">
    <div class="modal-content">
     <form style="form-group" method="post">
        <?php
        if (isset($_POST['activeback'])) {
          if(!empty($_POST['addonaktiv'])){
              $addon_service=implode(", ", $_POST['addonaktiv']);
            } elseif(empty($_POST['addonaktiv'])){
                  $addon_service="No";
               }
                    // mail for billing dan cs
        $subject = 'Permintaan Berlanganan Kembali';
        $message = '
        <html>
        <body>
          <p>Permintaan berlangganan Kembali, berikut data customernya : </p>
          <br/>
          <p>ID Customer : '.$id.'</p>
          <p>Nama : '.$nama.'</p>
          <p>Tempat : '.$tempat.', '.$ket.', '.$kota.'</p>
          <p>Tanggal Permintaan : '.date("d-m-Y").'</p>
          <p>Paket : '.$_POST['regispackage'].'</p>
          <p>Layanan Tambahan : '.$addon_service.'</p>
          <br/>
        </body>
        </html>
        ';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
        $headers .= 'Cc: cs@groovy.id' . "\r\n";
      $res = $col_user->find(array("level"=>"2"));
            foreach($res as $row)
                      {
        $emailaktivasi=mail($row['email'], $subject, $message, $headers);
      }
      // mail for customer to berhenti berlangganan

      $subject1 = 'Permintaan Berlangganan Kembali';

      $message1 = '
      <html>
        <body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
            <div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
                <div style="background: linear-gradient(to right, #f9a825 , #fdd835);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
                    <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
                </div>
                <div style="padding:20px;color:#333;">
                    <p style="font-size:20px;font-weight:bold;line-height:1px">Terimakasih sudah menjadi customer Groovy</p>
                    <p>Anda melakukan permintaan berlangganan kembali pada tanggal : '.date("d").' '.bulan(date("m")).' '.date("Y").', dengan paket : '.$_POST['regispackage'].', layanan tambahan : '.$addon_service.'.</p>
                    <p style="color:#888;">Kami akan segera memproses permintaan anda</p>
                </div>
                </div>
            </div>
        </body>
        </html>

      ';

      $headers1  = 'MIME-Version: 1.0' . "\r\n";
      $headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

      $headers1 .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
      $headers1 .= 'Cc: cs@groovy.id' . "\r\n";

      $kirim_email1=mail($email, $subject1, $message1, $headers1);
$update_user = $col_user->update(array("id_user"=>$id, "level"=>"0"), array('$set'=>array("status"=>"registrasi", "paket"=>$_POST[' regispackage'], "addon"=>$addon_service)));
$histori=array(
      "tanggal"=>date("Y/m/d"),
      "hal"=> "Permintaan Berlangganan",
      "keterangan"=>"Permintaan berlangganan, dengan paket ".$_POST['regispackage'].", dan add on layanan ".$addon_service
    );
$push_histori = $col_user->update(array("id_user"=>$id, "level"=>"0"), array('$push'=>array("histori"=>$histori)));
if($emailaktivasi && $update_user && $kirim_email1 && $push_histori){ ?>
      <script type="" language="JavaScript">
    document.location='<?php echo $base_url_member; ?>'</script>
<?php } }  ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Permintaan Berlanganan Kembali</h4>
      </div>
      <div class="modal-body">
        <p>Pilih Paket</p>
        <p>
        <select class="form-control" id="regispackage" name="regispackage">
            <?php
                $res = $col_package->find();
                foreach($res as $row)
                            {
                              ?>
            <option><?php echo $row['nama']; ?></option>
            <?php } ?>
        </select>
        </p>
        <p>
          <ul class="list-group"  name="regisaddon1" id="regisaddon1">
            <h5>Add On Service</h5>
              <?php
                  $res = $col_service->find();
                  foreach($res as $row)
                              {
                      if($row['nama_group']=="Cinema Box HD" || $row['nama_group']=="TV Chanel"){
                                ?>
            <li class="list-group-item">
              <h6><?php echo $row['nama_group']; ?></h6>
                <?php $res1 = $col_service->find(array("group"=>$row['nama_group']));
                foreach($res1 as $row1)
                            { ?>
                  <input type="checkbox" name="addonaktiv[]" id="addonaktiv[]" value="<?php echo $row1['nama']; ?>"><?php echo ' '.$row1['nama']; ?><br>
                  <?php } ?>
              <?php } } ?>
            </li>
          </ul>
          <ul class="list-group"  name="regisaddon2" id="regisaddon2">
            <h5>Add On Service</h5>
              <?php
                  $res = $col_service->find();
                  foreach($res as $row)
                              {
                      if($row['nama_group']=="Cinema Box HD" || $row['nama_group']=="TV Chanel" || $row['nama_group']=="Video on Demand"){
                                ?>
            <li class="list-group-item">
              <h6><?php echo $row['nama_group']; ?></h6>
                <?php $res1 = $col_service->find(array("group"=>$row['nama_group']));
                foreach($res1 as $row1)
                            { ?>
                  <input type="checkbox" name="addonaktiv[]" id="addonaktiv[]" value="<?php echo $row1['nama']; ?>"><?php echo ' '.$row1['nama']; ?><br>
                  <?php } ?>
              <?php } } ?>
            </li>
          </ul>
        </p>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-default" data-dismiss="modal" value="Batal">
        <input type="submit" class="btn btn-primary" value="Kirim" name="activeback" id="terminationsend">
      </div>
    </div>
    </form>
  </div>
</div>
<?php
$count_info = $col_info->find(array("tempat"=>"All", "for"=>$id))->count();
    if($count_info<>0) {
 ?>
<div class="modal" name="modal-notif" id="modal-notif">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">Notification</h4>
      </div>
      <div class="modal-body">
        <p><a href="#" style="text-decoration:none;"><?php echo $col_info; ?> Informasi Belum Di Baca</a></p>
      </div>
    </div>
  </div>
</div>
<?php } ?>
