<?php
include('con/koneksi.php');
$res = $col_user->find(array("invoice"=>$_GET['invoice']));
foreach ($res as $user) {
  $tanggal_akhir=$user['tanggal_akhir'];
  $thn_akhir = substr($tanggal_akhir, 0,4);
  $bln_akhir = substr($tanggal_akhir, 5,2);
  $tgl_akhir = substr($tanggal_akhir, 8,10);
  $month_akhir = bulan($bln_akhir);
?>
<html>
<body style="background-color:#ddd;padding:0px 0 50px 0;font-family:arial;font-size:15px;">
  <div style="margin:0 auto;background-color:#eee;">
      <div style="background: linear-gradient(to right, #f9a825 , #fdd835);padding:5px 0 2px 0;text-align:center;">
          <a href="http://www.groovy.id"><img src="http://groovy.id/beta/img/groovy-logo-white.png" height="50px;"/></a>
      </div>
      <div style="padding:20px 20px 20px 20px;color:#333;">
          <p style="font-size:24px;font-weight:bold;line-height:30px;text-align:center">Rincian Tagihan</p>
          <span></span>
          <table style="margin-top:20px;margin-bottom:20px;border:0px solid #ccc;color:#333;background-color:#eee;#ddd;width:100%;font-size:14px;">
              <tr style="border:1px solid #bbb;">
                  <td style="border:1px solid #bbb;padding:5px;color:#777;">ID Invoice</td>
                  <td style="border:1px solid #bbb;padding:5px"><?php echo $user['invoice']; ?></td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">No. Virtual Account</td>
                  <td style="border:1px solid #bbb;padding:5px"><?php echo $user['no_virtual']; ?></td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Tanggal Jatuh Tempo</td>
                  <td style="border:1px solid #bbb;padding:5px"><?php echo $tgl_akhir.' '.$month_akhir.' '.$thn_akhir; ?></td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">ID Customer</td>
                  <td style="border:1px solid #bbb;padding:5px"><?php echo $user['id_user']; ?></td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Nama</td>
                  <td style="border:1px solid #bbb;padding:5px"><?php echo $user['nama']; ?></td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Tempat</td>
                  <td style="border:1px solid #bbb;padding:5px"><?php echo $user['tempat'].' '.$user['keterangan'].' '.$user['kota']; ?></td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">Status</td>
                  <td style="border:1px solid #bbb;padding:5px"><?php echo $user['status']; ?></td>
              </tr>
          </table>
          <br/>
          <table style="width:100%; margin-top:20px;margin-bottom:20px;float:right;border:0px solid #ccc;color:#333;background-color:#eee;#ddd;width:100%;font-size:14px;">
              <tr style="border:1px solid #bbb;">
                  <td style="border:2px solid #666;padding:10px;color:#666;text-align:center;font-size:15px;">DESCRIPTION</td>
                  <td style="border:2px solid #666;padding:10px;color:#666;text-align:center;font-size:15px;">PRICE (Rp.)</td>
              </tr>
              <tr>
                  <td style="border:1px solid #bbb;padding:5px;color:#777">'.$pay['layanan'].'</td>
                  <td style="border:1px solid #bbb;padding:5px">'.rupiah($pay['harga']).'</td>
              </tr>
              <tr>
                  <td style="border:0px solid #bbb;padding:5px;color:#777;text-align:right;">TOTAL HARGA</td>
                  <td style="border:1px solid #bbb;padding:5px">'.rupiah($total).'</td>
              </tr>
              <tr>
                  <td style="border:0px solid #bbb;padding:5px;color:#777;text-align:right;">PPN 10%</td>
                  <td style="border:1px solid #bbb;padding:5px">'.rupiah($total*0.1).'</td>
              </tr>
              <tr>
                  <td style="border:0px solid #bbb;padding:5px;color:#777;text-align:right;">TOTAL PEMBAYARAN</td>
                  <td style="border:1px solid #bbb;padding:5px">'.rupiah($total*0.1+$total).'</td>
              </tr>
          </table>

          <br/>
          <h3>Tata Cara Pembayaran</h3>
					<h4>MELALUI TRANSFER ATM BANK BCA</h4>
          <ol>
              <li>Masukkan Kartu ATM dan PIN ATM Anda</li>
              <li>Kemudian Tampil Menu Utama, pilih “TRANSAKSI LAINNYA”</li>
              <li>Pilih “TRANSFER”</li>
							<li>Pilih “KE REK BCA”</li>
							<li>Masukkan jumlah nominal sesuai total tagihan. Pilih “YA”</li>
							<li>Masukkan nomor rekening Virtual Account pembayaran. Pilih “BENAR”.</li>
							<li>Periksa kembali data yang tampil. Pilih “BENAR”</li>
							<li>Transkasi selesai. Pilih “TIDAK”</li>
          </ol>
					<h4>MELALUI KLIK BCA</h4>
          <ol>
              <li>Masukkan User ID dan PIN Anda</li>
							<li>Pilih Menu “Transfer Dana”</li>
							<li>ilih Menu “Transfer ke BCA Virtual Account”</li>
							<li>Masukkan nomor BCA Virtual Account </li>
							<li>Masukkan "Pembyaran groovy [nama paket] [id customer]", klik “Lanjut” </li>
							<li>Masukkan nomor Response Key BCA appli 1, klik “kirim” </li>
          </ol>
					<h4>MELALUI TRANSFER ATM NON BANK BCA</h4>
					<ol>
							<li>Masukkan Kartu ATM dan PIN ATM Anda</li>
							<li>Kemudian Tampil Menu Utama, pilih “TRANSAKSI LAINNYA”</li>
							<li>Pilih “TRANSFER”</li>
							<li>Pilih “ANTAR BANK ONLINE”</li>
							<li>Masukkan nomor rekening Virtual Account pembayaran dengan diawali Kode Bank pada tiga digit pertama, adapun kode Bank BCA adalah “014”, setelah itu pilih “BENAR”</li>
							<li>Pada tahapan ini nomor referensi dikosongkan. Pilih “BENAR”</li>
							<li>Masukkan jumlah nominal sesuai total tagihan. Pilih “BENAR”</li>
							<li>Periksa kembali data yang tampil. Pilih “BENAR”</li>
					</ol>
					<h4>MELALUI SETOR TUNAI BANK BCA</h4>
					<ol>
							<li>Isikan kolom Tanggal Bulan serta Tahun pada saat mengisi formulir Slip setoran</li>
							<li>Pada kolom No.Rekening/Customer isikan dengan Nomor Virtual Account pembayaran</li>
							<li>Pada kolom Nama Pemilik Rekening isikan PT. Media Andalan Nusa</li>
							<li>Pada kolom Berita/ Keterangan isikan keterangan pembayaran groovy</li>
							<li>Pada kolom Nama Penyetor isikan nama lengkap penyetor</li>
							<li>Pada kolom Alamat Penyetor & Telepon isikan alamat & nomor telepon penyetor</li>
							<li>Pada pilihan Informasi Penyetor, beri centang kotak Nasabah lalu tuliskan nomor rekening yang akan di debet untuk pembayaran, jika Anda bukan nasabah bank BCA, beri centang kotak Non Nasabah lalu tuliskan nomor tanda penyenal (KTP/SIM/KITAS/PASPOR)</li>
							<li>Pada kolom Mata Uang beri centang kotak Rupiah</li>
							<li>Pada kolom Tunai/No.Warkat tulis Tunai jika sumber dana berupa uang tunai. Apabila sumber dana berupa cek / BG BCA yang telah jatuh tempo maka isikan nomor warkat</li>
							<li>Pada kolom Jumlah Rupiah isikan jumlah uang yang akan di setor</li>
							<li>Pada kolom Total isikan jumlah total yang akan di setor.</li>
							<li>Pada kolom Terbilang tuliskan dalam huruf jumlah total yang akan di bayarkan, contoh : “Satu Juta Sembilan Ratus Ribu Rupiah”</li>
							<li>Beri tanda tangan dan nama jelas penyetor di bagian penyetor</li>
					</ol>
					<h4>MELALUI SETOR TUNAI NON BANK BCA</h4>
					<ol>
							<li>Isikan kolom Tanggal Bulan serta Tahun pada saat mengisi formulir Slip setoran</li>
							<li>Pada pilihan Jenis transaksi, beri centang Transfer</li>
							<li>Pada Pilihan Penerima, beri centang kotak Penduduk</li>
							<li>Pada kolom Nama isikan nama pelanggan</li>
							<li>Pada Kolom Nomor Rekening isikan nomor virtual account dengan didahului kode bank BCA pada tiga digit pertama, adapun kode bank BCA adalah “014”</li>
							<li>Pada kolom Alamat & Nomor Telpon isikan alamat & nomor telepon penerima</li>
							<li>Pada kolom Berita Untuk Penerima isikan keterangan pembayaran groovy dan Nomor Virtual Account pembayaran</li>
							<li>Pada Pilihan Pengirim Beri centang kotak Penduduk</li>
							<li>Pada kolom Nama isikan nama penyetor</li>
							<li>Pada kolom Alamat & Nomor Telpon isikan alamat & nomor telepon penyetor</li>
							<li>Pada pilihan sumber dana Transaksi, beri centang kotak Tunai jika anda membayar tunai, sedangkan jika anda membayar dengan debet rekening maka beri centang kotak debet rekening lalu tuliskan nomor rekening yang akan di debet untuk pembayaran</li>
							<li>Pada kolom Nominal isikan nilai nominal sesuai dengan total tagihan</li>
							<li>Pada kolom Jumlah Setoran Isikan jumlah sesuai dengan total tagihan</li>
							<li>Pada kolom Terbilang Tuliskan dalam huruf jumlah yang akan di bayarkan, contoh : “Satu Juta Sembilan Ratus Ribu Rupiah”</li>
							<li>Pada pilihan Biaya transaksi beri centang kotak Tunai jika anda ingin membayar tunai biaya transaksi, sedangkan jika anda membayar dengan debet rekening maka beri centang kotak Debet rekening lalu tuliskan nomor rekening yang akan di debet untuk biaya transaksi</li>
							<li>Pada kolom Tujuan Transaksi isikan Berita Pembayaran, contoh : “Pembayaran groovy disertai dengan id pelanggan dan nama pelanggan”</li>
							<li>Beri tanda tangan dan nama jelas penyetor di bagian pemohon</li>
					</ol>
          <p>groovy.id</p>
      </div>
      </div>
  </div>
</body>
</html>
<?php } ?>
