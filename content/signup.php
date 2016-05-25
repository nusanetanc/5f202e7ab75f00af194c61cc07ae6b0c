<?php
                                if (isset($_POST['register'])){
                                                                  $name= $_POST['regisname'];
                                                                  $email=$_POST['regisemail'];
                                                                  $phone=$_POST['regisphone'];
                                                                  $package=$_POST['regispackage'];
                                                                  $location=$_POST['regislocation'];
                                                                  $city=$_POST['regiscity'];
                                                                  $decription=$_POST['regisdescription'];
                                                                  $place=$_POST['regisplace'];
                                                                  $date = date("Y/m/d");
                                                                  $add_date_2days = date('Y/m/d', strtotime("+2 days"));
                                                                  $date_month = date("m");
                                                                  $date_years = date("y");

                                            if ($name=="" || $email=="" || $phone=="" || $package=="-- Select Package --" || $location=="-- Location --" || empty($_POST['g-recaptcha-response'])){
                                                                                       ?>
                                                                                          <script >
                                                                                                $(document).ready(function(){
                                                                                                    $('#registerfailedModal').modal('show');
                                                                                            });</script>
                                                                                        <?php  }
                                        else if ($location=="0" && $city=="" && $place==""){
                                                                                       ?>
                                                                                          <script >
                                                                                                $(document).ready(function(){
                                                                                                    $('#registerfailedModal').modal('show');
                                                                                            });</script>
                                                                                        <?php  }
                                         else if ($location<>"0" && $decription==""){
                                                                                       ?>
                                                                                          <script >
                                                                                                $(document).ready(function(){
                                                                                                    $('#registerfailedModal').modal('show');
                                                                                            });</script>
                                                                                        <?php   }   else {
                                                                          $res = $col_user->find(array("email"=>$email, "level"=>"0"));
                                                                          foreach($res as $row)
                                                                          {
                                                                          $email1=$row['email'];
                                                                          }

                                                                          if ($email1==$email){
                                                                          ?>
                                                                          <script >
                                                                          $(document).ready(function(){
                                                                          $('#registeremailfailedModal').modal('show');
                                                                          });</script>
                                                                          <?php

                                                                          } elseif ($location=="0"){
                                                                          $insert_customer=$col_demand->insert(array("nama"=>$name, "phone"=>$phone, "email"=>$email, "tanggal_registrasi"=>$date, "paket"=>$package, "alamat"=>$place, "kota"=>$city));
                                                                          ?>
                                                                          <script >
                                                                          $(document).ready(function(){
                                                                          $('#LocationnotvalidModal').modal('show');
                                                                          }); </script>  <?php
                                                                          } elseif($location<>"0"){
                                                                          //membuat id user
                                                                          /**
                                                                          * Luhn algorithm
                                                                          *
                                                                          * The Luhn algorithm or Luhn formula, also known as the "modulus 10" or
                                                                          * "mod 10" algorithm, is a simple checksum formula used to validate a
                                                                          * variety of identification numbers, such as credit card numbers,
                                                                          * IMEI numbers, National Provider Identifier numbers in the US, and
                                                                          * Canadian Social Insurance Numbers. It was created by IBM scientist
                                                                          * Hans Peter Luhn and described in U.S. Patent No. 2,950,048, filed
                                                                          * on January 6, 1954, and granted on August 23, 1960.
                                                                          *
                                                                          * @author odan
                                                                          * @copyright 2015-2016 odan
                                                                          * @license http://opensource.org/licenses/MIT The MIT License (MIT)
                                                                          * @link https://github.com/odan/luhn
                                                                          */
                                                                          class userId
                                                                          {
                                                                          /**
                                                                          * Returns the luhn check digit
                                                                          *
                                                                          * @param string $s numbers as string
                                                                          * @return int checksum digit
                                                                          */
                                                                          public function baru(){
                                                                          $six_digit_random_number = mt_rand(000001, 999999);
                                                                          $s=new userId;
                                                                          $userid = $s->create($six_digit_random_number);
                                                                          return $six_digit_random_number.$userid;
                                                                          }
                                                                          public function create($s)
                                                                          {
                                                                          // Add a zero check digit
                                                                          $s = $s . '0';
                                                                          $sum = 0;
                                                                          // Find the last character
                                                                          $i = strlen($s);
                                                                          $odd_length = $i % 2;
                                                                          // Iterate all digits backwards
                                                                          while ($i-- > 0) {
                                                                          // Add the current digit
                                                                          $sum+=$s[$i];
                                                                          // If the digit is even, add it again. Adjust for digits 10+ by subtracting 9.
                                                                          ($odd_length == ($i % 2)) ? ($s[$i] > 4) ? ($sum+=($s[$i] - 9)) : ($sum+=$s[$i]) : false;
                                                                          }
                                                                          return (10 - ($sum % 10)) % 10;
                                                                          }
                                                                          public function validate($number)
                                                                          {
                                                                          $sum = 0;
                                                                          $numDigits = strlen($number) - 1;
                                                                          $parity = $numDigits % 2;
                                                                          for ($i = $numDigits; $i >= 0; $i--) {
                                                                          $digit = substr($number, $i, 1);
                                                                          if (!$parity == ($i % 2)) {
                                                                          $digit <<= 1;
                                                                          }
                                                                          $digit = ($digit > 9) ? ($digit - 9) : $digit;
                                                                          $sum += $digit;
                                                                          }
                                                                          return (0 == ($sum % 10));
                                                                          }
                                                                          }
                                                                          $userid=new userId();
                                                                          $newid=$userid->baru();
                                                                          //generate password and code activation
                                                                          $text = 'abcdefghijklmnopqrstuvwxyz123457890';
                                                                          $panjang = 40;
                                                                          $txtlen = strlen($text)-1;
                                                                          $result = '';
                                                                          for($i=1; $i<=$panjang; $i++){
                                                                                        $result .= $text[rand(0, $txtlen)];
                                                                                        }

                                                                          $res = $col_package->find(array("nama"=>$package));
                                                                          foreach($res as $row)
                                                                          {
                                                                          $harga=$row['harga'];
                                                                          }
                                                                          $res = $col_location->find(array("name"=>$location));
                                                                          foreach($res as $row)
                                                                          {
                                                                          $city=$row['city'];
                                                                          $place=$row['place'];
                                                                          }

                                                                          $insert_customer=$col_user->insert(array("id_user"=>$newid,"nama"=>$name,"email"=>$email, "phone"=>$phone, "foto"=>"","level"=>"0","password"=>$result, "aktif"=>"0", "registrasi"=>"personal",
                                                                                        "tanggal_registrasi"=>$date, "paket"=>$package, "harga"=>$harga, "tanggal_akhir"=>"","tanggal_aktivasi"=>"",
                                                                                        "tempat"=>$location, "kota"=>$city, "keterangan"=>$decription, "alamat"=>$place, "pembayaran"=>"0", "no_virtual"=>"","status"=>"registrasi"));
                                                                          // mail for customer to registrasi
                                                                          $to = $email;

                                                                          $subject = 'Pendaftaran Akun Groovy';

                                                                          $message = '
                                                                          <html>
                                                                          <body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
                                                                          <div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
                                                                          <div style="background: linear-gradient(to right, #FF3D23 , #fc742f);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
                                                                          <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
                                                                          </div>
                                                                          <div style="padding:20px;color:#333;">
                                                                          <p style="font-size:20px;font-weight:bold;line-height:1px">Hai '.$name.',</p>

                                                                          <p>Terimakasih telah mendaftarkan akun Groovy. Berikut adalah rincian akun yang anda daftarkan.</p>
                                                                          <table style="margin-top:20px;margin-bottom:20px;border:0px solid #ccc;color:#333;background-color:#fff;#ddd;width:100%;font-size:14px;">
                                                                            <tr style="border:1px solid #bbb;">
                                                                                <td style="border:1px solid #bbb;padding:5px;color:#777;">ID Customer</td>
                                                                                <td style="border:1px solid #bbb;padding:5px">'.$newid.'</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="border:1px solid #bbb;padding:5px;color:#777">Nama</td>
                                                                                <td style="border:1px solid #bbb;padding:5px">'.$name.'</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="border:1px solid #bbb;padding:5px;color:#777">Email</td>
                                                                                <td style="border:1px solid #bbb;padding:5px">'.$email.'</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="border:1px solid #bbb;padding:5px;color:#777">Telepon</td>
                                                                                <td style="border:1px solid #bbb;padding:5px">'.$phone.'</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="border:1px solid #bbb;padding:5px;color:#777">Paket</td>
                                                                                <td style="border:1px solid #bbb;padding:5px">'.$package.'</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="border:1px solid #bbb;padding:5px;color:#777">Tanggal Registrasi</td>
                                                                                <td style="border:1px solid #bbb;padding:5px">'.$date_days.' '.$month1.' '.$date_years.'</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="border:1px solid #bbb;padding:5px;color:#777">Tipe Akun</td>
                                                                                <td style="border:1px solid #bbb;padding:5px">Personal</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="border:1px solid #bbb;padding:5px;color:#777">Tempat</td>
                                                                                <td style="border:1px solid #bbb;padding:5px">'.$location.', '.$decription.', '.$place.', '.$city.'</td>
                                                                            </tr>
                                                                          </table>
                                                                          <p>Untuk mengaktifkan akun silahkan klik tombol aktivasi ini.</p>
                                                                          <div style="text-align:center;margin:30px 0 30px 0;">
                                                                            <a href="'.$base_url.'/?a='.$result.'" style="text-decoration:none;color:#fff;"><span style="background-color:#FF3D23;border:0;border-radius:5px;padding:10px 40px 10px 40px;color:#fff;font-size:17px;">Aktivasi Akun</span></a>
                                                                          </div>
                                                                          <p>Jika tombol tidak berfungsi silahkan copy link berikut <a href="'.$base_url.'/?a='.$result.'">'.$base_url.'/?a='.$result.'</a></p>
                                                                          </div>
                                                                          </div>
                                                                          </div>
                                                                          </body>
                                                                          </html>
                                                                          ';

                                                                          $headers  = 'MIME-Version: 1.0' . "\r\n";
                                                                          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                                                                          $headers .= 'From: Groovy <no-reply@groovy.id>' . "\r\n";
                                                                          $headers .= 'Cc: cs@groovy.id, billing@groovy.id' . "\r\n";

                                                                          mail($to, $subject, $message, $headers);

                                                                          ?>
                                                                          <script >
                                                                          $(document).ready(function(){
                                                                          $('#registersuccsesModal').modal('show');
                                                                          }); </script>  <?php
                                                                          } } } ?>
    <!-- Content1 -->
    <div class="container">
      <div class="row" style="margin-top:90px">
        <h3 style="text-align:center;color:#555;margin-bottom:40px;">Get Started! Sign Up</h3>
        <div class="signInCard" style="background-color:#fff;margin:0 auto;margin-bottom:50px;padding-top:35px;padding-bottom:70px;border-radius:5px;text-align:center">
                        <form style="form-group" method="post" id = "register_form">
                            <input name="regisname" id="regisname" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Full Name" type="text" class="form-control">
                            <input name="regisemail" id="regisemail" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Email" type="email" class="form-control">
                            <input name="regisphone" id="regisphone" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Phone Number" type="number" class="form-control">
                            <select id="regispackage" name="regispackage" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" class="form-control">
                                <option disabled="disabled" selected="true">-- Select Package --</option>
                                <?php
                                    $res = $col_package->find();
                                    foreach($res as $row)
                                                {
                                                  ?>
                                <option><?php echo $row['nama']; ?></option>
                                <?php } ?>
                            </select>
                            <ul class="list-group"  name="regisaddon1" id="regisaddon1" disabled>
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
                                    <input type="checkbox" name="addon[]" id="addon[]" value="<?php echo $row1['nama']; ?>"><?php echo ' '.$row1['nama']; ?><br>
                                    <?php } ?>
                                <?php } } ?>
                              </li>
                            </ul>
                            <ul class="list-group"  name="regisaddon2" id="regisaddon2" disabled>
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
                                    <input type="checkbox" name="addon[]" id="addon[]" value="<?php echo $row1['nama']; ?>"><?php echo ' '.$row1['nama']; ?><br>
                                    <?php } ?>
                                <?php } } ?>
                              </li>
                            </ul>
                            <select id="regislocation" name="regislocation" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" class="form-control">
                                <option disabled="disabled" selected="true">-- Location --</option>
                                <?php
                                    $res = $col_location->find();
                                    foreach($res as $row)
                                                {
                                                  ?>
                                <option><?php echo $row['name']; ?></option>
                                <?php } ?>
                                <option value= "0">Other</option>
                            </select>
                            <input name="regisdescription" id="regisdescription" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" name ="ket" id = "ket" type="text" class="form-control form-group-lg" placeholder="Specific Location (Block/Tower/Floor)">
                            <textarea name="regisplace" id="regisplace" name ="alamat" id = "alamat" rows="5" class="form-control" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:100px;width:100%;" placeholder="Complete Address"></textarea>
                            <select name="regiscity" id="regiscity" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" name = "kota" id="kota" class="form-control form-group-lg">
                                <option disabled="disabled" selected>City</option>
                                <option>Jakarta Pusat</option>
                                <option>Jakarta Selatan</option>
                                <option>Jakarta Barat</option>
                                <option>Jakarta Timur</option>
                                <option>Jakarta Utara</option>
                                <option>Bandung</option>
                            </select>
                             <div style="margin-bottom:7px;" class="g-recaptcha" data-sitekey="6Ldx_BsTAAAAAOYrQegHLVhslSvd6z78zAr-4Knc"></div>
                            <input id="register" name="register" type="submit" style="float:left;margin-top:5px;;text-align:center;background-color:#ff1d25;border:0px;color:#fff;height:40px;padding:0 40px 0 40px;border-radius:3px;font-weight:bold;" value="SIGN UP"/>
                            <a href="<?php echo $base_url; ?>/?hal=signin" style="margin-top:10px;float:right;color:#ff1d25;font-size:14px;text-decoration:underline;text-align:right">Sign In</a>
                        </form>
        </div>
      </div>
    </div>
    <!-- /Content1 -->
