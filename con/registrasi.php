<?php
    if (isset($_POST['nama'])){
                              $nama= $_POST['nama'];
                              $email=$_POST['email'];
                              $notelp=$_POST['notelp'];
                              $paket=$_POST['paket'];
                              $tempat=$_POST['tempat'];
                              $kota=$_POST['kota'];
                              $ket=$_POST['ket'];
                              $alamat=$_POST['alamat'];
                              $tanggal = date("d/m/Y H:i:s");
$userid=new userId();
$id=$userid->baru();


        $text = 'abcdefghijklmnopqrstuvwxyz123457890';
        $panjang = 40;
        $txtlen = strlen($text)-1;
        $result = '';
        for($i=1; $i<=$panjang; $i++){
            $result .= $text[rand(0, $txtlen)];
            }

if ($tempat = "Apartemen Laguna") {
                                    $kota="Jakarta Utara";
                                    $alamat="Jl. Pluit Timur Raya, Blok MM";
}
else if ($tempat = "Apartemen Rajawali") {
                                          $kota="Jakarta Pusat";
                                          $alamat="Jl. Gn. Sahari No.11, Sawah Besar";
}
        if ($paket=="Fun Kids"){
                                $harga = '1.500.000';
        } else if ($paket=="Fun Fantasy"){
                                          $harga = '1.500.000';
        } else if ($paket=="Fun Film"){
                                          $harga = '1.000.000';
        }  
$res = $col_groovy>find(array("email"=>$email));
foreach($res as $row)
{ 
$email1=$row['email'];
}
      if ($email1==$email){
       ?>
      <h8 id = "valid2">Email Already Exist !</h8> 
      <?php
      }else {
      $insert=$col_groovy->insert(array("id"=>$id, "nama"=>$nama, "email"=>$email, "notelp"=>$notelp, "tempat"=>$tempat, "kota"=>$kota, "keterangan"=>$ket, "alamat"=>$alamat, "level"=>"0", "password" =>$result,
                                  "aktif"=>"TIDAK AKTIF","paket"=>$paket,"harga"=>$harga,"tanggalregistrasi"=>"$tanggal", "tanggalpembayaran"=>"", "status"=>"Tidak Aktif", "KTP"=>"", "buktipembayaran"=>"" ));
      $to=$email;
      $subject = "Activation Order groovy";
      $message = '
                  <!DOCTYPE html>
                  <html>
                  <title>Activation Order groovy.id</title>
                  <meta name="viewport" content="width=device-width, initial-scale=1">
                  <link rel="stylesheet"href="http://www.w3schools.com/lib/w3.css">
                  <style>
                  div {
                    width: 200px;
                    height: 200px;
                    margin: 5px;
                    padding: 5px
                  }
                  </style>
                  <body>
                  <div class="container">
                  <div class="w3-card"><h4>Welcome '.$nama.' </h4>
                  <br/>
                  <p>You can verify your email address, Click the button below:</p>
                  <p><a class="w3-btn w3-blue" href="http://jkt.nusa.net.id/groovy/member/activationorder.php?g='.$result.' ">verification</a></p>
                  <br/><br/><br/>
                  <p>Thank You</p>
                  <p>Best Regards</p>
                  <p>groovy.id</p></div>
                  </div>

                  </body>
                  </html> 
                  ';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <www-data@anc.jkt.nusa.net.id (www-data)>' . "\r\n";
$headers .= 'Cc: nurhandiy@gmail.com' . "\r\n";
mail($to,$subject,$message,$headers);
 ?> 
      <h9 id = "valid1">Success Doing Order, Please Check Your Email!</h9> 
      <?php
             } } ?>