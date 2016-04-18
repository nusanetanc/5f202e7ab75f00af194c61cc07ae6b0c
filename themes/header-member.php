<script>
 $(document).ready(function(){
});
</script>
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
<nav class="navbar navbar-primary">
<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar" style="background-color:#FF3D23;"></span>
        <span class="icon-bar" style="background-color:#FF3D23;"></span>
        <span class="icon-bar" style="background-color:#FF3D23;"></span>
      </button>
      <a href="<?php echo $base_url_member; ?>"><img height="60px" src="<?php echo $base_url; ?>/img/groovy-logo-colour.png"/></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php
             $res = $col_menu->find(array("hakakses"=>$level));
             foreach($res as $row)
                      {
      ?>
      <ul class="nav navbar-nav">
        <title><?php echo $hal; ?></title>
        <li ><a href="<?php echo $base_url_member; ?>/<?php echo $row['file']; ?>"  style="font-size:14px;padding-top:20px;padding-bottom:19px;font-weight:500; color:gray;"><i style="padding-right:10px;" class="fa fa-<?php echo $row['image']; ?> fa-lg"></i><?php echo $row['title'].' '; ?></a></li>
      </ul>
      <?php } ?>
      <ul class="dropdown nav navbar-nav navbar-right navbar-primary">
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
      } }
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Permintaan Berhenti Berlanganan</h4>
      </div>
      <div class="modal-body">
        <p>
        <select class="form-control" name="selectalasantermination" id="selectalasantermination">
          <option disabled="true" selected="true">Alasan Penutupan</option>
          <option>Harga Mahal</option>
          <option>Jaringan Internet Tidak Stabil</option>
          <option>Chanel Tv Bermasalah</option>
          <option value="Other">Other</option>
        </select>
        </p>
        <p><input type="text" class="form-control" name="textalasantermination" id="textalasantermination" placeholder="Alasan Penutupan"></p>
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
          <p>Paket : '.$_POST['selectpackageaktiv'].'</p>
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
      } $update_user = $col_user->update(array("id_user"=>$id, "level"=>"0"), array('$set'=>array("status"=>"registrasi", "paket"=>$_POST['selectpackageaktiv'])));
if($emailaktivasi && $update_user){ ?>
      <script type="" language="JavaScript">
    document.location='<?php echo $base_url_member; ?>'</script>
<?php } } ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Permintaan Berlanganan Kembali</h4>
      </div>
      <div class="modal-body">
        <p>
        <select class="form-control" name="selectpackageaktiv" id="selectpackageaktiv">
          <option disabled="true" selected="true">Selected Package</option>
            <?php
                $res = $col_package->find();
                foreach($res as $row)
                            {
                              ?>
            <option><?php echo $row['nama']; ?></option>
            <?php } ?>
        </select>
        </p>
        <p><div style="margin-bottom:7px;" class="g-recaptcha" data-sitekey="6Ldx_BsTAAAAAOYrQegHLVhslSvd6z78zAr-4Knc"></div></p>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-default" data-dismiss="modal" value="Batal">
        <input type="submit" class="btn btn-primary" value="Kirim" name="activeback" id="terminationsend">
      </div>
    </div>
    </form>
  </div>
</div>
