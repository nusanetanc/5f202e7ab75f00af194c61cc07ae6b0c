 <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
 echo yudi0;
  $res = $col_user->find(array("id_user"=>$sm));
  foreach($res as $row)
                      { 
                          $email_sm = $row['email'];
                        }
echo yudi1;
if (isset($_POST['register'])){
                              $regisname= $_POST['regisname'];
                              $regisemail=$_POST['regisemail'];
                              $regisphone=$_POST['regisphone'];
                              $package=$_POST['regispackage'];
                              $location=$_POST['regislocation'];
                              $decription=$_POST['regisdescription'];
                              $date = date("Y/m/d");
                              $date_month = date("m");
                              $date_years = date("y");
                              $date_days = date("d");  
                              $bulan1 = bulan($date_month);

echo yudi2;
        if ($name=="" || $email=="" || $phone=="" || $package=="-- Select Package --" || $location=="-- Location --" || $decription==""){
                                                   echo '<p class="text-danger">Registration Failed, Please Try Again!</p>';
                                                    } else {     
        $lokasifile = $_FILES['regisktp']['tmp_name'];
				$fileName = $_FILES['regisktp']['name']; 
				$dir = "./ktp/";
				$move = move_uploaded_file($lokasifile, "$dir".$fileName);                  
$res = $col_location->find(array("name"=>$location));
        foreach($res as $row)
        { 
            $city=$row['city'];
            $place=$row['place'];
        }                                 
	    $res = $col_package->find(array("nama"=>$package));
	    foreach($res as $row)
		    { 
		        $harga=$row['harga'];
		    }   
$res = $col_user->find(array("email"=>$email, "level"=>"0"));
foreach($res as $row)
{ 
    $email1=$row['email'];
} 
echo yudi3;
                      //generate password and code activation
                    $text = 'abcdefghijklmnopqrstuvwxyz123457890';
                    $panjang = 10;
                    $txtlen = strlen($text)-1;
                    $result = '';
                    for($i=1; $i<=$panjang; $i++){
                                                    $result .= $text[rand(0, $txtlen)];
                                                    }
echo yudi4;
          if ($email1==$email){
                        echo '<p class="text-warning">Email already exist!!</p>';
                              } else {
                                      $insert_customer=$col_user->insert(array("id_user"=>$newid,"nama"=>$regisname,"email"=>$regisemail, "phone"=>$regisphone, "foto"=>"","level"=>"0","password"=>$result, "aktif"=>"0", "ktp"=>$fileName, "registrasi"=>"sales", "id_sales"=>$id, "nama_sales"=>$nama,
                                                                            "email_sales"=>$email, "tanggal_registrasi"=>$date, "paket"=>$package, "harga"=>$harga, "tanggal_akhir"=>"","tanggal_aktivasi"=>"",
                                                                             "tempat"=>$location, "kota"=>$city, "keterangan"=>$decription, "alamat"=>$place, "pembayaran"=>"0", "no_virtual"=>"""status"=>"permintaan registrasi")); 
                                          //mail for sales manager
                                          // multiple recipients
                                          $to1 = 'yudi.nurhandi@nusa.net.id';

                                          // subject
                                          $subject1 = 'Veririfikasi Registrasi Sales';

                                          // message
                                          $message1 = '
                                          <html>
                                          <body>
                                            <p>Mohon Segera di validasi customer baru</p>
                                            <br/>
                                            <p>ID Customer : '.$newid.'</p>
                                            <p>Nama : '.$regisname.'</p>
                                            <p>Alamat : '.$regisemail.'</p>
                                            <p>Tanggal Registrasi : '.$date.'</p>
                                            <p>Sales : '.$nama.'</p>
                                            <p>Paket : '.$package.'</p>
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
                                          $kirimemail = mail($to1, $subject1, $message1, $headers1);
                                          // mail for customer to registrasi
                                          $to = $regisemail;

                                          $subject = 'Registrasi groovy TV';

                                          $message = '
                                          <html>
                                          <body>
                                            <p>Terimakasih telah registrasi di groovy.id berikut rincian data anda : </p>
                                            <br/>
                                            <p>ID Customer : '.$newid.'</p>
                                            <p>Nama : '.$regisname.'</p>
                                            <p>Paket : '.$package.'</p>
                                            <p>Email : '.$regisemail.'</p>
                                            <p>Phone : '.$regisphone.'</p>
                                            <p>Tanggal Registrasi : '.$date_days.' '.$month1.' '.$date_years.'</p>
                                            <p>Registrasi : Personal</p>
                                            <p>Tempat : '.$location.', '.$decription.', '.$place.', '.$city.'</p>
                                            <br/>
                                            <p>Best Regards</p>
                                            <p>Customer Service</p>
                                            <p>groovy.id</p>
                                          </body>
                                          </html>
                                          ';

                                          $headers  = 'MIME-Version: 1.0' . "\r\n";
                                          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                                          $headers .= 'From: groovy.id <no_reply@groovy.id>' . "\r\n";
                                          $headers .= 'Cc: cs@groovy.id, billing@groovy.id' . "\r\n";

                                          $kirimemail1 =mail($to, $subject, $message, $headers); echo yudi5;
if($insert_customer && $kirimemail && $kirimemail){                                          
    echo '<p class="text-primary">Registration succeed, please wait for confirmation from the sales manager!</p>';
     } } } } ?>
<section>
	<div class="col-sm-9" style="font-family:Arial;">
		<div class="list-group">
			<div class="panel" style="border:0px;">
  				<div class="panel-heading" style="background-color:#FF6D20">
    				<h3 class="panel-title" style="font-weight:600; color:white; margin-top:10px; margin-bottom:10px;">Add Customer groovy</h3>
  				</div>
	  					<br/>
	  				    <div class="panel-body">
	  				    	<form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                            <input name="regisname" id="regisname" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Full Name" type="text" class="form-control">
                            <input name="regisemail" id="regisemail" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Email" type="email" class="form-control">
                            <input name="regisphone" id="regisphone" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="Phone Number" type="number" class="form-control">
                            <input name="regisktp" id="regisktp" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" placeholder="KTP" type="file" class="form-control">
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
                            </select>
                            <input name="regisdescription" id="regisdescription" style="background-color:rgba(255, 255, 255, 0.7);margin-bottom:9px;height:40px" name ="ket" id = "ket" type="text" class="form-control form-group-lg" placeholder="Specific Location (Block/Tower/Floor)">
                            <div class="g-recaptcha" data-sitekey="6LfARxMTAAAAADdReVu9DmgfmTQBIlZrUOHOjR-8"></div>	
                            <input id="register" name="register" type="submit" style="float:left;margin-top:5px;;text-align:center;background-color:#ff1d25;border:0px;color:#fff;height:40px;padding:0 40px 0 40px;border-radius:3px;font-weight:bold;" value="SIGN UP"/>
                        </form>
        </div>
		  				 </form>
		  				 </div>
		  	</div>
		</div>
	</div>
</section>		  				    	