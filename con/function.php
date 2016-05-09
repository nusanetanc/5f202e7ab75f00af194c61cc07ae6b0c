<?php
$kode_perusahaan ="123456";
	function bulan($bln) {
switch ($bln) {
				case '12':
						$bln="Desember";
					break;
				case '11':
						$bln="November";
					break;
				case '10':
						$bln="Oktober";
					break;
				case '09':
						$bln="September";
					break;
				case '08':
						$bln="Agustus";
					break;
				case '07':
						$bln="Juli";
					break;
				case '06':
						$bln="Juni";
					break;
				case '05':
						$bln="Mei";
					break;
				case '04':
						$bln="April";
					break;
				case '03':
						$bln="Maret";
					break;
				case '02':
						$bln="Febuari";
					break;
				case '01':
						$bln="Januari";
					break;
			}
				return $bln;
				}
function lev($level) {
switch ($level) {
				case 0:
						$level="Member";
					break;
				case 1:
						$level="Admin";
					break;
				case 2:
						$level="Billing";
					break;
				case 3:
						$level="Admin Support";
					break;
				case 301:
						$level="Field Engineer";
				case 302:
						$level="Ast Field Engineer";
					break;
				case 4:
						$level="Admin Helpdesk";
					break;
				case 401:
						$level="Helpdesk";
					break;
				case 5:
						$level="Sales Manager";
					break;
				case 501:
						$level="Sales";
					break;
				case 6:
						$level="Customer Service";
						break;
				case 7:
						$level="Web Admin";
						break;
			}
				return $level;
				}
function rupiah($nilai, $pecahan = 0) { return number_format($nilai, $pecahan, ',', '.'); }				
?>
