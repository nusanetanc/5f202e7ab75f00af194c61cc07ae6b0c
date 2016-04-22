  <?php
                            if(isset($_POST['login'])) {
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
                            header('location:'.$base_url_member);                                                    
                             } else { ?>
                                                <script >
                                                $(document).ready(function(){
                                                    $('#loginfailedModal').modal('show');
                                            });</script>
                            <?php } } } ?>
 <section>
     <!-- Content1 -->
    <div class="container">
      <div class="row" style="margin-top:90px">
        <h3 style="text-align:center;color:#555;margin-bottom:40px;">Sign in with Groovy Account</h3>
        <div class="signInCard" style="background-color:#fff;margin:0 auto;padding-top:35px;padding-bottom:10px;border-radius:5px;text-align:center">
            <img style="width:70px;margin-bottom:20px;" src="<?php echo $base_url; ?>/img/default-avatar-groovy.png"/>
            <form style="form-group" method="post">
                <input name="loginemail" id="loginemail" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Email" type="email" class="form-control">
                <input name="loginpassword" id="loginpassword" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Password" type="password" class="form-control">
                <!-- <label style="float:left;color:#555;" class="checkbox-inline"><input type="checkbox" value="">Remember Password</label> -->
                <a href="<?php echo $base_url; ?>/?hal=forgot-password" style="float:right;color:#ff1d25;font-size:14px;text-decoration:underline;text-align:right">Forgot Password?</a><br/>
                <center><input id="login" name="login" type="submit" style="background-color:#ff1d25;border:0px;color:#fff;height:40px;padding:0 40px 0 40px;margin-top:15px;border-radius:3px;font-weight:bold;" value="SIGN IN"/><br/><br/>
                <a href="<?php echo $base_url; ?>/?hal=signup" style="color:#ff1d25;font-size:14px;text-decoration:underline;text-align:right" data-toggle="modal" data-target="#signupModal" data-dismiss="modal">Create Account</a><br/><br/></center>
            </form>
        </div>
      </div>
    </div>
    <!-- /Content1 -->
 </section>
