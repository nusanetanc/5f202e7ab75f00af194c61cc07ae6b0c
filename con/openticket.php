<?php
session_start();
$email=$_SESSION['emailuser'];
$subject=$_POST['subject'];
$kategori=$_POST['kategori'];
$message=$_POST['message'];
$to=$_POST['to'];
 $text = 'abcdefghijklmnopqrstuvwxyz123457890';
  $panjang = 45;
 
  $txtlen = strlen($text)-1;
  $result = '';
  for($i=1; $i<=$panjang; $i++){
    $result .= $text[rand(0, $txtlen)];
  }
$tanggal = date("d/m/Y h:i:s");
$res = $col_groovy->find(array("email"=>$email));
foreach($res as $row)
  { 
  	$nama=$row['nama'];
  	$level=$row['level'];
  }	
if ($to=="" && $to==null){
	$to="";
}
$insert = $col_ticket->insert(array("idchat"=>$result, "email"=>$email, "nama"=>$nama, "level"=>$level, "subject"=>$subject, "kategori"=>$kategori, "message"=>$message, "to"=>$to,"tanggal"=>$tanggal, "action"=>"open"));
if ($insert) {?>
				<script type="" language="JavaScript">
				document.location='../member/profile.php'</script>
<?php }
?>