<!-- Contact -->
<div style="background:url(<?php echo $base_url;?>/img/background-contact-us.jpg);background-position:center;margin-top:50px;padding-top:80px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 style="margin:0;font-size:33px;font-weight:bold;color:#333;">Contact Us</h3>
                <h6 style="font-size:18px;font-weight:400;line-height:24px;margin:25px 0 0 0;color:#333">Here are the ways you can contact us with any questions you have about groovy.</h6>
                <div style="background: linear-gradient(to right, #FF3D23 , #FF931E);height:2px;margin-top:30px;margin-bottom:5px;"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h5 style="font-size:17px;color:#777;margin-top:40px;margin-bottom:15px;">OUR OFFICE</h5>
                
                <p style="margin-top:27px;font-size:15px;color:#333;font-weight:light;line-height:1.5">Nusanet Office<br/>Cyber Building, 7th Floor<br/>
                Jl. Kuningan Barat 8<br/>
                Jakarta 12710, Indonesia</p>
                <h5 style="font-size:17px;color:#777;margin-top:40px;margin-bottom:15px;">SOCIAL MEDIA</h5>
                <p style="line-height:25px;">
                    <a href="" target="_blank"><i style="color:#3b5998" class="fa fa-facebook fa-2x footer-facebook"></i></a>&nbsp;&nbsp;&nbsp; 
                    <a href="" target="_blank"><i style="color:#517fa4" class="fa fa-instagram fa-2x footer-instagram"></i></a>&nbsp;&nbsp;&nbsp; 
                    <a href="" target="_blank"><i style="color:#00aced" class="fa fa-twitter fa-2x footer-twitter"></i></a>&nbsp;&nbsp;&nbsp; 
                    <a href="" target="_blank"><i style="color:#bb0000" class="fa fa-youtube-play fa-2x footer-youtube"></i></a>
                </p>
            </div>
            <div class="col-sm-12 col-md-6">                  
                <h5 style="font-size:17px;color:#777;margin-top:40px;margin-bottom:15px;">CONTACT FORM</h5>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" style="margin-top:30px;margin-bottom:100px;">
                    <?php
                        if (isset($post['send'])){
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $subject = $_POST['subject'];
                            $message = $_POST['message'];
                        if ($name<>"" || $email<>"" || $subject<>"" || $message<>""){
                        $insert=$col_contactus->insert(array("name"=>$name, "email"=>$email, "subject"=>$subject, "message"=>$message));
                                            $to1 = $email;

                                          // subject
                                          $subject1 = 'Contact Us groovy.id';

                                          // message
                                          $message1 = '
                                          <html>
                                          <body>
                                            <p>Dear :'.$name.'</p>
                                            <p>Dear : Thank you for writing to us. Our team will be responding to your query as soon as possible. </p>
                                            <br/>
                                            <p>Email : '.$email.'</p>
                                            <p>Subject : '.$subject.'</p>
                                            <p>Message : '.$message.'</p>
                                            <br/>
                                          </body>
                                          </html>
                                          ';

                                          // To send HTML mail, the Content-type header must be set
                                          $headers1  = 'MIME-Version: 1.0' . "\r\n";
                                          $headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                                          // Additional headers
                                          $headers1 .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
                                          $headers1 .= 'Cc: cs@groovy.id' . "\r\n";

                                          // Mail it
                                          $kirimemail1 = mail($to1, $subject1, $message1, $headers1);
                                $_SESSION['message-sent']="Message Sent";
                        } else {
                                $_SESSION['message-sent']="Message Not Sent";
                        } }
                    ?>
                    <input name ="name" id = "name" style="background-color:rgba(255, 255, 255, 1);margin-bottom:9px;height:40px" placeholder="Name" type="text" class="form-control" required>
                    <input name ="email" id = "email" style="background-color:rgba(255, 255, 255, 1);margin-bottom:9px;height:40px" placeholder="Email" type="email" class="form-control" required>
                    <input name ="subject" id = "subject" style="background-color:rgba(255, 255, 255, 1);margin-bottom:9px;height:40px" placeholder="Subject" type="text" class="form-control" require>
                    <textarea name ="message" id = "message" rows="5" class="form-control" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:100px;width:100%;" placeholder="Message" require></textarea>
                    <input id="send" name="send" type="submit" style=";text-align:center;background-color:#FF3D23;border:0px;color:#fff;height:40px;padding:0 40px 0 40px;border-radius:3px;font-weight:bold;" value="SEND"/>  
                    <?php if(isset($_SESSION['message-sent'])) { ?>
                    <!-- Notification -->
                    <span style="margin-left:20px;"><?php echo $_SESSION['message-sent']; ?></span>
                    <!-- /Notification -->
                    <?php unset($_SESSION["message-sent"]);  } ?>
                </form>
            </div>
            
        </div>
    </div>
</div>
<!-- /Contact -->