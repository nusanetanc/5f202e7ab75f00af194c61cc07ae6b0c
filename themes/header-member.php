<script >
  $(document).ready(function(){
      $('#account').modal('show');
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
                        $invoice = $row['invoice'];
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
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <h1><b><a class="navbar-brand" style = "color:black;margin-top:-21px;font-size:40px;padding-right:50px;" href="<?php echo $base_url_member; ?>"  >groovy</a></b></h1>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <?php
             $res = $col_menu->find(array("hakakses"=>$level));
             foreach($res as $row)
                      {  
      ?>
        <?php if ($row['title']<>"PAYMENT"){ ?>
      <ul class="nav navbar-nav">  
        <li ><a href="<?php echo $base_url_member; ?>/?hal=<?php echo $row['file']; ?>"  style="font-size:14px;padding-top:20px;padding-bottom:19px;font-weight:500; color:gray;"><i style="padding-right:10px;" class="fa fa-<?php echo $row['image']; ?> fa-lg"></i><?php echo $row['title'].' '; ?></a></li>
      </ul>   
        <?php } else { ?>
      <ul class="nav navbar-nav dropdown navbar-primary">  
        <li class="dropdown-toggle" data-toggle="dropdown" style="font-size:14px;padding-top:20px;padding-bottom:17px;font-weight:500; color:gray; cursor:pointer;"><i style="padding-right:10px;" class="fa fa-<?php echo $row['image']; ?> fa-lg"></i><?php echo $row['title']; ?></li>
          <ul class="dropdown-menu nav navbar-nav navbar-primary">
            <li style="font-size:14px;font-weight:500; color:gray;"><a href="<?php echo $base_url_member; ?>?hal=payment">Verification Payment</a></li>
            <li style="font-size:14px;font-weight:500; color:gray;"><a href="<?php echo $base_url_member; ?>?hal=listpayment">List Payment</a></li>
          </ul>
      </ul>    
      <?php } } ?>
      <ul class="dropdown nav navbar-nav navbar-right navbar-primary">
        <li><a href="<?php echo $base_url; ?>"  style="color:gray;"><i style="padding-right:0px;" class="fa fa-bell-o fa-2x"></i></a></li>
          <li class="dropdown-toggle" data-toggle="dropdown">    
              <?php if ($foto=="" || $foto==null){ ?>
                          <img style="width:45px;height:45px;margin-top:7px;margin-left:10px;cursor:pointer" class="profile-img-card profile-img-card-mdm" src="<?php echo $base_url; ?>/img/Avatar_member.png"/>
       <?php } else { ?>
                  <img style="width:45px;height:45px;margin-top:7px;margin-left:10px;cursor:pointer" class="profile-img-card profile-img-card-mdm" src="<?php echo $base_url_member; ?>/foto/<?php echo $foto; ?>"/>
       <?php } ?>
          </li>
            <ul class="dropdown-menu">
              <li><a href="<?php echo $base_url_member; ?>/?hal=editprofile">Edit Profile</a></li>
              <li><a href="<?php echo $base_url_member; ?>/?hal=logout">Logout</a></li>
            </ul>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
  <div class="col-sm-12 grey-background">