 <form enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<?php
  $res = $col_user->find(array("id_user"=>$sm));
  foreach($res as $row)
                      {
                          $email_sm = $row['email'];
                        }
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
        if ($regisname=="" || $regisemail=="" || $regisphone=="" || $package=="-- Select Package --" || $location=="-- Location --" || $decription==""){
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
                      //generate password and code activation
                    $text = 'abcdefghijklmnopqrstuvwxyz123457890';
                    $panjang = 10;
                    $txtlen = strlen($text)-1;
                    $result = '';
                    for($i=1; $i<=$panjang; $i++){
                                                    $result .= $text[rand(0, $txtlen)];
                                                    }
          if ($email1==$email){
                        echo '<p class="text-warning">Email already exist!!</p>';
                              } else {
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
                                      $insert_customer=$col_user->insert(array("id_user"=>$newid,"nama"=>$regisname,"email"=>$regisemail, "phone"=>$regisphone, "foto"=>"","level"=>"0","password"=>$result, "aktif"=>"0", "ktp"=>$fileName, "registrasi"=>"sales", "id_sales"=>$id, "nama_sales"=>$nama,
                                                                            "email_sales"=>$email, "tanggal_registrasi"=>$date, "paket"=>$package, "harga"=>$harga, "tanggal_akhir"=>"","tanggal_aktivasi"=>"",
                                                                             "tempat"=>$location, "kota"=>$city, "keterangan"=>$decription, "alamat"=>$place, "pembayaran"=>"0", "no_virtual"=>"","status"=>"permintaan registrasi"));
                                          //mail for sales manager
                                          // multiple recipients
                                          $to1 = $email_sm;

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
                                          $kirimemail1 = mail($to1, $subject1, $message1, $headers1);
if($insert_customer && $kirimemail1){
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
