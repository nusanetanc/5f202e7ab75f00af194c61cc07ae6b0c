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
                        if (isset($_POST['contact_send'])){
                            $contact_name = $_POST['contact_name'];
                            $contact_email = $_POST['contact_email'];
                            $contact_subject = $_POST['contact_subject'];
                            $contact_message = $_POST['contact_message'];
                        if ($contact_name<>"" || $contact_email<>"" || $contact_subject<>"" || $contact_message<>""){
                        $insert_contact=$col_contactus->insert(array("name"=>$contact_name, "email"=>$contact_email, "subject"=>$contact_subject, "message"=>$contact_message));
                                            $to_contact = $contact_email;

                                          // subject
                                          $subject_contact = 'Contact Us groovy.id';

                                          // message customer
                                          $message_contact = '
                                          <html>
                                          <body>
                                            <p>Hi '.$contact_name.'</p>
                                            <p>Thank you for contact to us. Our team will be responding to your message as soon as possible. </p>
                                            <br/>
                                            <p>Email : '.$contact_email.'</p>
                                            <p>Subject : '.$contact_subject.'</p>
                                            <p>Message : '.$contact_message.'</p>
                                            <br/>
                                          </body>
                                          </html>
                                          ';

                                          // To send HTML mail, the Content-type header must be set
                                          $headers_contact  = 'MIME-Version: 1.0' . "\r\n";
                                          $headers_contact .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                                          // Additional headers
                                          $headers_contact .= 'From: groovy.id' . "\r\n";

                                          // message cs
                                          $message_contact1 = '
                                          <html>
                                          <body>
                                            <p>Berikut pertanyaan calon customer dari contact us groovy.id. </p>
                                            <br/>
                                            <p>Nama : '.$contact_name.'</p>
                                            <p>Email : '.$contact_email.'</p>
                                            <p>Subject : '.$contact_subject.'</p>
                                            <p>Message : '.$contact_message.'</p>
                                            <br/><br/>
                                            <p>Terimakasih</p>
                                          </body>
                                          </html>
                                          ';

                                          // To send HTML mail, the Content-type header must be set
                                          $headers_contact1  = 'MIME-Version: 1.0' . "\r\n";
                                          $headers_contact1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                                          // Additional headers
                                          $headers_contact1 .= 'From: groovy.id' . "\r\n";

                                          // Mail it
                                          $kirimemail_contact = mail($to_contact, $subject_contact, $message_contact, $headers_contact);
                                          $kirimemail_contact1 = mail($email_cs, $subject_contact, $message_contact1, $headers_contact1);
                                $_SESSION['message-sent']="Message Sent / Pesan Terkirim";
                        } else {
                                $_SESSION['message-sent']="Message Not Sent / Pesan Tidak Terkirim";
                        } }
                    ?>
                    <input name ="contact_name" id = "contact_name" style="background-color:rgba(255, 255, 255, 1);margin-bottom:9px;height:40px" placeholder="Name" type="text" class="form-control" required>
                    <input name ="contact_email" id = "contact_email" style="background-color:rgba(255, 255, 255, 1);margin-bottom:9px;height:40px" placeholder="Email" type="email" class="form-control" required>
                    <input name ="contact_subject" id = "contact_subject" style="background-color:rgba(255, 255, 255, 1);margin-bottom:9px;height:40px" placeholder="Subject" type="text" class="form-control" require>
                    <textarea name ="contact_message" id = "contact_message" rows="5" class="form-control" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:100px;width:100%;" placeholder="Message" require></textarea>
                    <div style="margin-bottom:7px;" class="g-recaptcha" data-sitekey="6Ldx_BsTAAAAAOYrQegHLVhslSvd6z78zAr-4Knc"></div>
                    <input id="contact_send" name="contact_send" type="submit" style=";text-align:center;background-color:#FF3D23;border:0px;color:#fff;height:40px;padding:0 40px 0 40px;border-radius:3px;font-weight:bold;" value="SEND"/>
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
