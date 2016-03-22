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
                                            if (empty($res['id_user'])) { ?>
                                                    <script >
                                                    $(document).ready(function(){
                                                        $('#emailnotfoundModal').modal('show');
                                                });</script> 
                                <?php
                                            } else { 
                                            $to=$email;
                                            $subject = "Request Reset Password";
                                            $message = '
                                                      <!DOCTYPE html>
                                                      <html>
                                                      <title>Reset Password</title>
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
                                                      <div class="w3-card"><h4>Dear '.$nama.' </h4>
                                                      <br/>
                                                      <p>User : '.$nama.' has filed a request for a password reset, to reset the password click the following link :</p>
                                                      <p><a class="w3-btn w3-blue" href="http://jkt.nusa.net.id/groovy/member/?a='.$result.' ">verification</a></p>
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
                                                        $('#emailforgetModal').modal('show');
                                                });</script> 
                                <?php
                             }   }
                         } 
?>           
    <!-- Content1 -->
    <div class="container">
      <div class="row" style="margin-top:90px">
        <h3 style="text-align:center;color:#555;margin-bottom:40px;">Reset Your Groovy Password</h3>
        <div class="signInCard" style="background-color:#fff;margin:0 auto;padding-top:35px;padding-bottom:20px;border-radius:5px;text-align:center">
            <form style="form-group" method="post">
                <input name="forgetemail" id="forgetemail" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Email" type="email" class="form-control">
                <a href="./?hal=signup" style="float:left;color:#ff1d25;font-size:14px;text-decoration:underline;text-align:left">Create Account</a>
                <a href="./?hal=signin" style="float:right;color:#ff1d25;font-size:14px;text-decoration:underline;text-align:right">Sign In</a><br/>
                <center><input id="send" name="send" type="submit" style="background-color:#ff1d25;border:0px;color:#fff;height:40px;padding:0 40px 0 40px;margin-top:15px;border-radius:3px;font-weight:bold;" value="SEND"/></center>
            </form>
        </div>
      </div>
    </div>
    <!-- /Content1 -->