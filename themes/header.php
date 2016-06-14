 <?php if ($_GET['hal']=="signin" || $_GET['hal']=="forgot-password" || $_GET['hal']=="signup"){ ?>
<body data-spy="scroll" data-target=".supportMenuWrapper" data-offset="50" style="position:relative;background-color:#e0e0e0;">
    <!-- Header -->
    <div class="container-fluid" style="position:fixed;width:100%;background: linear-gradient(to right, #f57f17 , #fbc02d);height:50px;box-shadow: -4px 0 10px rgba(0, 0, 0, 0.2);-webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.5);
     -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.5);
    -moz-box-shadow:    0px 2px 5px rgba(0, 0, 0, 0.5);
    box-shadow:         0px 2px 5px rgba(0, 0, 0, 0.5);
    z-index:1000;">
        <div class="logoWrapper">
            <!--
            <button class="menuToggleMobile navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="fa fa-bars fa-lg"></i>
            </button>
            -->

            <a href="<?php echo $base_url; ?>"><img src="<?php echo $base_url; ?>/img/groovy-logo-white-drop-shadow.png" height="50px"/></a>
        </div>
        <div style="float:right;margin-left:15px;margin-top:14px;">
            <a href="<?php echo $base_url; ?>/features" class="navMenu" style="color:#fff;">FEATURES</a>
            <a href="<?php echo $base_url; ?>/packages" class="navMenu" style="color:#fff;">PACKAGES</a>
            <a href="<?php echo $base_url; ?>/support" class="navMenu" style="color:#fff;">SUPPORT</a>
            <div class="dropdown">
                <button class="dropdown-toggle navButtonMobile" data-toggle="dropdown"><i class="fa fa-ellipsis-v fa-lg"></i></button>
                <ul class="dropdown-menu pull-right">
                    <li><a href="<?php echo $base_url; ?>/features.html" data-toggle="modal">FEATURES</a></li>
                    <li><hr style="margin:5px 0 5px 0;"/></li>
                    <li><a href="<?php echo $base_url; ?>/packages.html" data-toggle="modal">PACKAGES</a></li>
                    <li><hr style="margin:5px 0 5px 0;"/></li>
                    <li><a href="<?php echo $base_url; ?>/support.html" data-toggle="modal">SUPPORT</a></li>
                    <li><hr style="margin:5px 0 5px 0;"/></li>
                </ul>
            </div>
        </div>
    </div>
<?php } else { ?>
<body>
    <!-- Header -->
    <div class="container-fluid" style="position:fixed;width:100%;background: linear-gradient(to right, #f9a825 , #fdd835);height:50px;
    -webkit-box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.5);
    -moz-box-shadow:    0px 2px 5px rgba(0, 0, 0, 0.5);
    box-shadow:         0px 2px 5px rgba(0, 0, 0, 0.5);
    z-index:1000;
    ">
        <div class="logoWrapper">
            <a href="<?php echo $base_url; ?>"><img src="<?php echo $base_url; ?>/img/groovy-logo-white-drop-shadow.png"  height="50px"/></a>
        </div>
        <div style="float:right;margin-left:15px;margin-top:14px;">
            <a href="<?php echo $base_url; ?>/features" class="navMenu" style="color:#000;">FEATURES</a>
            <a href="<?php echo $base_url; ?>/packages" class="navMenu" style="color:#000;">PACKAGES</a>
            <a href="<?php echo $base_url; ?>/support" class="navMenu" style="color:#000;">SUPPORT</a>
            <a href="" data-toggle="modal" data-target="#signinModal" class="navMenu navButton"><span style="color:#fff;text-decoration:none;">SIGN IN</span></a>
            <div class="dropdown">
                <button class="dropdown-toggle navButtonMobile" data-toggle="dropdown"><i class="fa fa-ellipsis-v fa-lg"></i></button>
                <ul class="dropdown-menu pull-right">
                    <li><a href="<?php echo $base_url; ?>/?hal=features" data-toggle="modal">FEATURES</a></li>
                    <li><hr style="margin:5px 0 5px 0;"/></li>
                    <li><a href="#" data-toggle="modal">PACKAGES</a></li>
                    <li><hr style="margin:5px 0 5px 0;"/></li>
                    <li><a href="#" data-toggle="modal">SUPPORT</a></li>
                    <li><hr style="margin:5px 0 5px 0;"/></li>
                    <li><a href="#" data-toggle="modal" data-target="#signinModal">Sign In</a></li>
                </ul>
            </div>
        </div>
    </div>
<?php
    if (isset($_GET['a'])) {
                            $a = $_GET['a'];
        $res = $col_user->find(array("password"=>$a, "level"=>"0", "aktif"=>"0"));
                                            foreach($res as $row)
                                            {
                                                $email_aktif=$row['email'];
                                                $id_aktif=$row['id_user'];
                                            }
    if(empty($email_aktif)){
?>
    <script type="" language="JavaScript">
    document.location='<?php echo $base_url; ?>'</script>
            <?php
    } else {
?>
    <script >
    $(document).ready(function(){
        $('#activationacountModal').modal('show');
    }); </script>
            <?php
                    } }
    if (isset($_GET['rp'])) {
                            $change_id = new MongoId($_GET['rp']);
        $res = $col_user->find(array("_id"=>$change_id, "aktif"=>"1"));
                                            foreach($res as $row)
                                            {
                                                $change_email=$row['email'];
                                            }
    if(empty($change_email)){
?>
    <script type="" language="JavaScript">
    document.location='<?php echo $base_url; ?>'</script>
            <?php
    } else {
?>
    <script >
    $(document).ready(function(){
        $('#replacepasswordModal').modal('show');
    }); </script>
            <?php
                    } }
            ?>
        <!-- /Modal Sign In-->
        <div class="modal fade" id="signinModal" role="dialog" data-toggle="modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color:#000;text-align:center;padding:8px 0 5px 0"><b>WELCOME!</b> SIGN IN</h4><br/>
                        <center><img src="<?php echo $base_url; ?>/img/default-avatar-groovy.png" width="80px" height="80px"/></center><br/>
                        <form method="post" style="form-group">
                            <input style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Email" type="email" class="form-control" name="loginemail" id="loginemail">
                            <input style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Password" type="password" class="form-control" name="loginpassword" id="loginpassword">
                            <!--<label style="float:left;color:#fff;" class="checkbox-inline"><input type="checkbox" value="">Remember Password</label> -->
                            <a href="" style="float:right;color:#000;font-size:14px;text-decoration:underline;text-align:right" data-toggle="modal" data-target="#forgotPasswordModal" data-dismiss="modal">Forgot Password?</a><br/>
                            <center><input id="login" name="login" type="submit" style="background-color:#ff5722;border:0px;color:#fff;height:40px;padding:0 40px 0 40px;margin-top:15px;border-radius:3px;font-weight:bold;" value="SIGN IN"/><br/><br/>
                            <a href="" style="color:#000;font-size:14px;text-decoration:underline;text-align:right" data-toggle="modal" data-target="#signupModal" data-dismiss="modal">Create Account</a><br/><br/></center>
                             <?php
                            if(isset($_POST['login'])) {
                                                        session_start();
                                                        $email = $_POST['loginemail'];
                                                        $password = $_POST['loginpassword'];
                                   if ($email=="" && $password==""){
                                                                    ?>
                                                            <script >
                                                            $(document).ready(function(){
                                                                $('#loginemailandpasswordfailedModal').modal('show');
                                                            }); </script>
                                                                    <?php
                                   }
                                   else if ($email==""){
                                                        ?>
                                                            <script >
                                                            $(document).ready(function(){
                                                                $('#loginemailfailedModal').modal('show');
                                                         }); </script>
                                                            <?php
                                    }  else if ($password==""){
                                                                ?>
                                                            <script >
                                                            $(document).ready(function(){
                                                                $('#loginpasswordfailedModal').modal('show');
                                                        }); </script>
                                                            <?php
                                    } else {
                            $res = $col_user->findOne(array("email"=>$email, "password"=>$password, "aktif"=>"1"));
                            if (!empty($res['email'])) {
                                                    $_SESSION["id"] = $res['id_user'];
                                                    $_SESSION["level"]=$res['level'];
                                                                                ?>
                            <script type="" language="JavaScript">
                            document.location='<?php echo $base_url; ?>/member'</script>
                            <?php } else { ?>
                                                <script >
                                                $(document).ready(function(){
                                                    $('#loginfailedModal').modal('show');
                                            });</script>
                            <?php } } } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Sign In-->
        <!-- Modal Forgot Password-->
        <div class="modal fade" id="forgotPasswordModal" role="dialog" data-toggle="modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color:#000;text-align:center;padding:8px 0 5px 0"><b>FORGOT PASSWORD</b></h4><br/>
                        <form style="form-group" method="post">
                            <input style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Email" type="email" class="form-control" name="forgetemail" id="forgetemail">
                            <a href="" style="float:left;color:#000;font-size:14px;text-decoration:underline;text-align:left" data-toggle="modal" data-target="#signupModal" data-dismiss="modal">Create Account</a>
                            <a href="" style="float:right;color:#000;font-size:14px;text-decoration:underline;text-align:right" data-toggle="modal" data-target="#signinModal" data-dismiss="modal">Sign In</a><br/>
                            <center><input name="send" id="send" type="submit" style="background-color:#ff5722;border:0px;color:#fff;height:40px;padding:0 40px 0 40px;margin-top:15px;border-radius:3px;font-weight:bold;" value="SEND"/></center>
                             <?php
                                    if(isset($_POST['send'])) {
                                                                $email = $_POST['forgetemail'];
                                                            if ($email==""){ ?>
                                                                                <script >
                                                                                $(document).ready(function(){
                                                                                    $('#loginemailfailedModal').modal('show');
                                                                            });</script>
                                                            <?php
                                                            }   else {
                                                                        $res = $col_user->findOne(array("email"=>$email));
                                                                        $user_id=$res['_id'];
                                                                        if (empty($res['email'])) { ?>
                                                                                <script >
                                                                                $(document).ready(function(){
                                                                                    $('#emailnotfoundModal').modal('show');
                                                                            });</script>
                                                            <?php
                                                                        } else {
                                                                        // mail for customer to forgote password

                                                                            $to=$email;
                                                                            $nama=$res['nama'];
                                                                            $subject = 'Atur Ulang Kata Sandi';

                                                                            $message = '
                                                                            <html>
                                                                                <body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
                                                                                    <div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
                                                                                        <div style="background: linear-gradient(to right, #f9a825 , #fbc02d);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
                                                                                            <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
                                                                                        </div>
                                                                                        <div style="padding:20px;color:#333;">
                                                                                            <p style="font-size:20px;font-weight:bold;line-height:1px">Hai '.$nama.',</p>
                                                                                            <p>Kami mendengar Anda perlu reset password. Klik link di bawah ini dan Anda akan diarahkan ke situs yang aman dari mana Anda dapat mengatur sandi baru.</p>

                                                                                            <div style="text-align:center;margin:30px 0 30px 0;">
                                                                                                <a href="'.$base_url.'/?rp='.$user_id.'" style="text-decoration:none;color:#fff;"><span style="background-color:#f9a825;border:0;border-radius:5px;padding:10px 40px 10px 40px;color:#fff;font-size:17px;">Reset Password</span></a>
                                                                                            </div>
                                                                                            <p style="color:#888;">Jika Anda tidak pernah meminta untuk mereset password, harap abaikan email ini.</p>
                                                                                        </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </body>
                                                                                </html>
                                                                            ';

                                                                            $headers  = 'MIME-Version: 1.0' . "\r\n";
                                                                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                                                                            $headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
                                                                            $headers .= 'Cc: cs@groovy.id' . "\r\n";

                                                                            mail($to, $subject, $message, $headers);
                                                                ?>
                                                                                <script >
                                                                                $(document).ready(function(){
                                                                                    $('#emailforgetModal').modal('show');
                                                                            });</script>
                                                            <?php
                                                         }   }
                                                     }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Forgot Password-->
        <!-- Modal Activation Acount Password-->
        <div class="modal fade" id="activationacountModal" role="dialog" data-toggle="modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <h4 class="modal-title" style="color:#000;text-align:center;padding:8px 0 5px 0"><b>Aktivasi Akun</b></h4><br/>
                        <form style="form-group" method="post">
                            <input style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Masukan Password Anda" type="password" class="form-control" name="activepassword1" id="activepassword1">
                            <input style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Masukan Lagi Password Anda" type="password" class="form-control" name="activepassword2" id="activepassword2">
                            <span style="color:#fff;font-weight:bold">Upload foto/scan KTP (Kartu Tanda Penduduk)<br/></span>
                            <input style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" type="file" class="form-control" name="regisktp" id="regisktp">
                            <?php
                            if (isset($_POST['active'])){
                                $passwordBaru1 = $_POST['activepassword1'];
                                $passwordBaru2 = $_POST['activepassword2'];
                                $lokasifilektp= $_FILES['regisktp']['tmp_name'];
                                $namaktp = $_FILES['regisktp']['name'];
                                echo $namaktp;
                                if ($passwordBaru1=="" || $passwordBaru2==""){ ?>
                                <b><h5 style="margin-top:10px;float:right;color:#000;font-size:14px;text-align:right">Please enter your password and photo id card!!</h5></b><br/>
                                <br/>
                            <?php    } else if ($passwordBaru1==$passwordBaru2){
                                    $date_time = date("Y/m/d H:i:s");
                                    $dirKtp = "./ktp/";
                                    $move = move_uploaded_file($lokasifilektp, "$dirKtp".$namaktp);
                                    $active_acount = $col_user->update(array("email"=>$email_aktif),
                                                                        array('$set'=>array("password"=>$passwordBaru1, "aktif"=>"1", "ktp"=>$namaktp)));
                                    $detail_info=array("share_id"=>"00000000","description"=>"Selamat Bergabung dengan groovy tv, Selamat Menikmati Layanan Kami","date"=>$date_time);
                                    $write_info = $col_info->insert(array("for"=>$id_aktif, "subject"=>"Selamat Bergabung Dengan groovy", "tanggal_update"=>$date_time, "informasi"=>array($detail_info)));
                                    if ($active_acount && $write_info){
                                                                                    ?>
                                                                                <script >
                                                                                $(document).ready(function(){
                                                                                    $('#activationacountModal').modal('hide');
                                                                                    $('#activationsuccsesModal').modal('show');
                                                                            });</script>
                                                                                <?php }
                                }  else  if ($passwordBaru1<>$passwordBaru2){
                                                                                ?>
                                                                           <b><h5 style="margin-top:10px;float:right;color:#fff;font-size:14px;text-align:right">Password don't macth !</h5></b><br/>
                                                                           <br/>
                                                                                <?php
                                }
                            }
                            ?>
                            <center><input name="active" id="active" type="submit" style="background-color:#ff5722;border:0px;color:#fff;height:40px;padding:0 40px 0 40px;margin-top:15px;border-radius:3px;font-weight:bold;" value="AKTIFKAN"/></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Forgot Password-->
         <!-- Modal Replace Password-->
        <div class="modal fade" id="replacepasswordModal" role="dialog" data-toggle="modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <h4 class="modal-title" style="color:#000;text-align:center;padding:8px 0 5px 0"><b>Change Password</b></h4><br/>
                        <form style="form-group" method="post">
                            <input style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Masukan Password Anda" type="password" class="form-control" name="changepassword3" id="changepassword3">
                            <input style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Masukan Lagi Password Anda" type="password" class="form-control" name="changepassword4" id="changepassword4">
                            <?php
                            if (isset($_POST['change'])){
                                $passwordBaru3 = $_POST['changepassword3'];
                                $passwordBaru4 = $_POST['changepassword4'];

                                if (empty($passwordBaru3) || empty($passwordBaru4)){ ?>
                                <b><h5 style="margin-top:10px;float:right;color:#000;font-size:14px;text-align:right">Please enter your password!</h5></b><br/>
                                <br/>
                            <?php    } else if ($passwordBaru3==$passwordBaru4){
                                    $change_password = $col_user->update(array("email"=>$change_email),
                                                                        array('$set'=>array("password"=>$passwordBaru3)));
                                    if ($change_password){
                                                                                    ?>
                                                                                <script >
                                                                                $(document).ready(function(){
                                                                                    $('#replacepasswordModal').modal('hide');
                                                                                    $('#changepasswordvalidModal').modal('show');
                                                                            });</script>
                                                                                <?php }
                                }  else  if ($passwordBaru3<>$passwordBaru4){
                                                                                ?>
                                                                           <b><h5 style="margin-top:10px;float:right;color:#000;font-size:14px;text-align:right">Password not match !</h5></b><br/>
                                                                           <br/>
                                                                                <?php
                                }
                            }
                            ?>
                            <center><input name="change" id="change" type="submit" style="background-color:#ff5722;border:0px;color:#fff;height:40px;padding:0 40px 0 40px;margin-top:15px;border-radius:3px;font-weight:bold;" value="CHANGE"/></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Replace Password-->
        <!-- Modal Sign Up-->
        <div class="modal fade" id="signupModal" role="dialog" data-toggle="modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="color:#000;text-align:center;padding:7px 0 5px 0"><b>GET STARTED!</b> SIGN UP</h4><br/>
                        <form style="form-group" method="post" id = "register_form">
                            <input style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Full Name" type="text" class="form-control" name="regisname" id="regisname">
                            <input style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Email" type="email" class="form-control" name="regisemail" id="regisremail">
                            <input style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Phone Number" type="text" class="form-control" name="regisphone" id="regisphone">
                            <select style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" class="form-control" name="regispackage" id="regispackage">
                                <option disabled="true" selected="true">-- Select Package --</option>
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
                            <select style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" class="form-control" name="regislocation" id="regislocation">
                                <option disabled="true" selected="true">-- Location --</option>
                                <?php
                                    $res = $col_location->find();
                                    foreach($res as $row)
                                                {

                                                  ?>
                                <option><?php echo $row['name']; ?></option>
                                <?php } ?>
                                <option value= "0">Other</option>
                            </select>
                            <p style="margin-top:10px;color:#000;font-size:14px;text-decoration:none;text-align:left">By clicking Sign Up, you agree to our <a href="<?php echo $base_url; ?>/term-of-use" style="text-decoration:underline;color:#000;">Terms of Use</a> and <a href="<?php echo $base_url; ?>/privacy-policy" style="text-decoration:underline;color:#000;">Privacy Policy</a></p>
                            <input style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" name ="regisdescription" id = "regisdescription" type="text" class="form-control form-group-lg" placeholder="Specific Location (Block/Tower/Floor)">
                            <textarea name ="regisplace" id = "regisplace" rows="5" class="form-control" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:100px;width:100%;" placeholder="Complete Address"></textarea>
                            <select style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" name = "regiscity" id="regiscity" class="form-control form-group-lg">
                                <option disabled="disabled" selected>City</option>
                                <option>Jakarta Pusat</option>
                                <option>Jakarta Selatan</option>
                                <option>Jakarta Barat</option>
                                <option>Jakarta Timur</option>
                                <option>Jakarta Utara</option>
                                <option>Bandung</option>
                            </select>
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
                                                                  //$add_date_2days = date('Y/m/d', strtotime("+2 days"));
                                                                  $date_days = date("d");
                                                                  $date_month = date("m");
                                                                  $date_years = date("y");
                                                                  $month1 = bulan($date_month);

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

                                          // insert add on
                                        if(!empty($_POST['addon'])){
                                            foreach($_POST['addon'] as $selectaddon){
                                        $res = $col_service->find(array("nama"=>$selectaddon));
                                        foreach($res as $row)
                                        {
                                            $harga_addon=$row['harga'];
                                        }
                                                $insert_addon=$col_addon->insert(array("id_user"=>$newid, "layanan"=>$selectaddon, "harga"=>$harga_addon, "status"=>"unaktif"));
                                            }
                                            $addon_service=implode(", ", $_POST['addon']);
                                          } elseif(empty($_POST['addon'])){
                                                $addon_service="No";
                                             }
                                                $history=array(
                                                			"tanggal"=>$date,
                                                			"hal"=> "Registrasi",
                                                      "keterangan"=>"Reistrasi via personal, dengan paket ".$package.", dan add on layanan ".$addon_service
                                                		);
                                                                  $insert_customer=$col_user->insert(array("id_user"=>$newid,"nama"=>$name,"email"=>$email, "phone"=>$phone, "foto"=>"","level"=>"0","password"=>$result, "aktif"=>"0", "registrasi"=>"personal",
                                                                                "tanggal_registrasi"=>$date, "paket"=>$package, "harga"=>$harga, "tanggal_akhir"=>"","tanggal_aktivasi"=>"","addon"=>$addon_service,
                                                                                "tempat"=>$location, "kota"=>$city, "keterangan"=>$decription, "alamat"=>$place, "pembayaran"=>"0", "no_virtual"=>"","status"=>"registrasi", "histori"=>array($history)));
                                                                              // mail for customer to registrasi
                                                                                $to = $email;

                                                                                $subject = 'Pendaftaran Akun Groovy';

                                                                                $message = '
                                                                                <html>
                                                                                    <body style="background-color:#ddd;padding:50px 0 50px 0;font-family:arial;font-size:15px;">
                                                                                        <div style="margin:0 auto;max-width:500px;background-color:#eee;-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 5px 5px;border-radius: 5px 5px 5px 5px;">
                                                                                            <div style="background: linear-gradient(to right, #f9a825 , #fdd835);-moz-border-radius: 0px;-webkit-border-radius: 5px 5px 0px 0px;border-radius: 5px 5px 0px 0px;padding:5px 0 2px 0;text-align:center;">
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
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777">Layanan Tambahan</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">'.$addon_service.'</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777">Tanggal Registrasi</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">'.$date_days.' '.$month1.' '.$date_years.'</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777">Registrasi</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">Personal</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td style="border:1px solid #bbb;padding:5px;color:#777">Tempat</td>
                                                                                                        <td style="border:1px solid #bbb;padding:5px">'.$location.', '.$decription.', '.$place.', '.$city.'</td>
                                                                                                    </tr>
                                                                                                </table>
                                                                                                <p>Untuk mengaktifkan akun silahkan klik tombol aktivasi ini.</p>
                                                                                                <div style="text-align:center;margin:30px 0 30px 0;">
                                                                                                    <a href="'.$base_url.'/?a='.$result.'" style="text-decoration:none;color:#fff;"><span style="background-color:#f9a825;border:0;border-radius:5px;padding:10px 40px 10px 40px;color:#fff;font-size:17px;">Aktivasi Akun</span></a>
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
                             <div style="margin-bottom:7px;" class="g-recaptcha" data-sitekey="6Ldx_BsTAAAAAOYrQegHLVhslSvd6z78zAr-4Knc"></div>
                            <input id="register" name="register" type="submit" style=";text-align:center;background-color:#ff5722;border:0px;color:#fff;height:40px;padding:0 40px 0 40px;border-radius:3px;font-weight:bold;" value="SIGN UP"/>
                            <a href="" style="margin-top:10px;float:right;color:#000;font-size:14px;text-decoration:underline;text-align:right" data-toggle="modal" data-target="#signinModal" data-dismiss="modal">Sign In</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <!-- /Modal Sign Up-->
        <!-- Modal Sign In Failed-->
        <div class="modal fade" id="loginfailedModal" role="dialog" >
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>The email and password you entered don't match !</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Sign In Failed-->
        <!-- Modal Login Email & Password Failed -->
        <div class="modal fade" id="loginemailandpasswordfailedModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>Please enter your email & password!</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Login Email & Password Failed -->
                <!-- Modal Login Email Failed-->
        <div class="modal fade" id="loginemailfailedModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>Please enter your email!</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Login Email Failed-->
        <!-- Modal Login Password Failed-->
        <div class="modal fade" id="loginpasswordfailedModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>Please enter your password!</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Login Password Failed-->
        <!-- Modal Register Failed-->
        <div class="modal fade" id="registerfailedModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>Registration failed, please try again!</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Register Failed-->
        <!-- Modal Register Succses-->
        <div class="modal fade" id="registersuccsesModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>Registration succeed, please check your email!</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Register Succses-->
        <!-- Modal Register Email Exsist -->
        <div class="modal fade" id="registeremailfailedModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>Email already exist! Please register with other email</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Email Exsist -->
                <!-- Modal Account Exsist -->
        <div class="modal fade" id="acountfailedModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>Acount already exist!</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Account Exsist -->
        <!-- Modal Email Not Found -->
        <div class="modal fade" id="emailnotfoundModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>Email was not found in the list costumer</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Email Not Found -->
        <!-- Modal Forget Email -->
        <div class="modal fade" id="emailforgetModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>Please check your email for reset password</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Forget Email -->
        <!-- Modal Passsword Baru sukses -->
        <div class="modal fade" id="activationsuccsesModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>Account has been active, please login</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Forget Email -->
        <!-- Modal Location not Valid -->
        <div class="modal fade" id="LocationnotvalidModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>Registration failed, because our services have not reached your</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Location not Valid -->
        <!-- Modal Location not Valid -->
        <div class="modal fade" id="changepasswordvalidModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content" style="background: linear-gradient(to right, #f9a825 , #fbc02d);">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h5 style="color:black;"><b>Password successfully changed</b></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal Location not Valid -->
    <!-- /Header -->

    <!-- Content1 -->
