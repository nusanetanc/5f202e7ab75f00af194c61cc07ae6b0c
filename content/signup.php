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

                                            if ($name=="" || $email=="" || $phone=="" || $package=="-- Select Package --" || $location=="-- Location --"){
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
                                    //$userid=new userId();
                                    //$id=$userid->baru();


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
                                              if($location<>"0"){
                                                    $res = $col_location->find(array("name"=>$location));
                                                    foreach($res as $row)
                                                    {
                                                        $city=$row['city'];
                                                        $place=$row['place'];
                                                    }
                                                 }

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
                                                                  } else {
                                                                    if($location<>"0"){
                                                                          $insert_customer=$col_user->insert(array("id_user"=>"9384758","nama"=>$name,"email"=>$email, "phone"=>$phone, "foto"=>"","level"=>"0","password"=>$result, "aktif"=>"0", "registrasi"=>"personal",
                                                                                                                "tanggal_registrasi"=>$date, "paket"=>$package, "harga"=>$harga, "tanggal_akhir"=>$add_date_2days,"tanggal_aktivasi"=>"",
                                                                                                                "tempat"=>$location, "kota"=>$city, "keterangan"=>$decription, "alamat"=>$place, "pembayaran"=>"0", "invoice"=>$date_month.$date_years.'001',"status"=>"registrasi"));
                                                                              $to=$email;
                                                                              $subject = "Activation Order groovy";
                                                                              $message = '
                                                                                          <!DOCTYPE html>
                                                                                          <html>
                                                                                          <title>Activation Order groovy.id</title>
                                                                                          <meta name="viewport" content="width=device-width, initial-scale=1">
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
                                                                                          <p><a class="w3-btn w3-blue" href="http://jkt.nusa.net.id/groovy/member/?a='.$result.' ">verification</a></p>
                                                                                          <p>You have to pay this order at the latest on January 11th 2016 , otherwise we will close your account groovy</p>
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
                                                                            <script >
                                                                                $(document).ready(function(){
                                                                                    $('#registersuccsesModal').modal('show');
                                                                         }); </script>  <?php
                                                                      } elseif ($location=="0"){
                                                                        $insert_customer=$col_demand->insert(array("nama"=>$name, "phone"=>$phone, "email"=>$email, "tanggal_registrasi"=>$date, "paket"=>$package, "alamat"=>$place, "kota"=>$city));
                                                                            $to=$email;
                                                                              $subject = "Activation Order groovy";
                                                                              $message = '
                                                                                          <!DOCTYPE html>
                                                                                          <html>
                                                                                          <title>Order groovy.id</title>
                                                                                          <meta name="viewport" content="width=device-width, initial-scale=1">
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
                                                                                          <div class="w3-card"><h4>Hi '.$nama.' </h4>
                                                                                          <br/>
                                                                                          <p>sorry we did not get in because our service has not come to your address</p>
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
                                                                            <script >
                                                                                $(document).ready(function(){
                                                                                    $('#LocationnotvalidModal').modal('show');
                                                                         }); </script>  <?php
                                                                      } } } } ?>
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
