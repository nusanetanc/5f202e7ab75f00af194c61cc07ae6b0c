<?php
// mail for customer to info
$to = 'yudi.nurhandi@nusa.net.id';

$subject = 'Berhenti berlangganan groovy.id';

$message = '
<html>
<body>
  <p>Terima kasih sudah menjadi customer groovy,<br/>
  Layanan TV anda kan berhenti pada tanggal : dan kami akan mengambil perangkat yang anda gunakan.<br/>
  Akun anda pada groovy.id akan aktif selama satu bulan, dan jika ingin mengaktifkan kembali layanan tv, bisa melalui akun groovy.id anda, tapi jika sistem sudah menutup akun anda, silahkan registrasi kembali.</p>
  <br/>
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
$headers .= 'Cc: cs@groovy.id' . "\r\n";

mail($to, $subject, $message, $headers);
?>