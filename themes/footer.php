</body>
<?php if ($_GET['hal']<>"signin" && $_GET['hal']<>"forgot-password" && $_GET['hal']<>"signup"){ ?>
<!-- Footer --></div>
    <div style="background: linear-gradient(to right, #FF3D23 , #FF931E);height:2px;"><!--trosd -->
    </div>
    <div class="container footerContent" style="padding:0 20px 50px 20px">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-3 text-left">
                <h5 style="font-size:17px;margin-top:40px;margin-bottom:15px;">SUPPORT</h5>
                <p style="line-height:25px;">
                    <a href="<?php echo $base_url; ?>/support#support-services">Services</a><br/>
                    <a href="<?php echo $base_url; ?>/support#support-getting-started">Getting Started</a><br/>
                    <a href="<?php echo $base_url; ?>/support#support-billing">Billing &amp; Membership</a>
                </p>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 text-left">
                <h5 style="font-size:17px;margin-top:40px;margin-bottom:15px;">FEATURES</h5>
                <p style="line-height:25px;">
                    <a href="<?php echo $base_url; ?>/features#feature-internet">Internet</a><br/>
                    <a href="<?php echo $base_url; ?>/features#feature-livetv">Live TV</a><br/>
                    <a href="<?php echo $base_url; ?>/features#feature-vod">Video on Demand</a><br/>
                    <a href="<?php echo $base_url; ?>/features#feature-socialtv">Social TV</a><br/>
                    <a href="<?php echo $base_url; ?>/features#feature-catchuptv">Catch-Up TV Channel</a><br/>
                    <a href="<?php echo $base_url; ?>/features#feature-radio">Radio Streaming</a>
                </p>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 text-left">
                <h5 style="font-size:17px;margin-top:40px;margin-bottom:15px;">ABOUT</h5>
                <p style="line-height:25px;">
                    <a href="<?php echo $base_url; ?>/career">Career</a><br/>
                    <a href="<?php echo $base_url; ?>/events">Events</a><br/>
                    <a href="<?php echo $base_url; ?>/contact-us">Contact Us</a><br/>
                    <a href="<?php echo $base_url; ?>/support">Help Center</a><br/>
                    <a href="<?php echo $base_url; ?>/privacy-policy">Privacy Policy</a><br/>
                    <a href="<?php echo $base_url; ?>/term-of-use">Term of Use</a>
                </p>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 text-left">
                <h5 style="font-size:17px;margin-top:40px;margin-bottom:15px;">STAY CONNECTED</h5>
                <p style="line-height:25px;">
                    <a href="http://www.facebook.com/groovyplay" target="_blank"><i class="fa fa-facebook-square fa-3x footer-facebook"></i></a>&nbsp;
                    <a href="http://www.instagram.com/groovy_play" target="_blank"><i class="fa fa-instagram fa-3x footer-instagram"></i></a>&nbsp;
                    <a href="http://www.twitter.com/groovy_play" target="_blank"><i class="fa fa-twitter-square fa-3x footer-twitter"></i></a>&nbsp;
                    <a href="https://www.youtube.com/channel/UCHeXAn6Z0ynGxFakYVvQSLA" target="_blank"><i class="fa fa-youtube-square fa-3x footer-youtube"></i></a>
                </p>
            </div>
        </div>
    </div>
    <div class="centerAtMobile" style="height:50px;background-color:#e0e0e0;">
        <div class="container" style="padding:15px 0 15px 0;color:#777;font-size:14px;">
            Copyright &copy; 2016 Groovy. All Right Reserved.
        </div>
    </div>
    <!-- /Footer -->
    <?php } ?>