<?php
	$base_url="http://groovy.id/beta";
	$base_url_member="http://groovy.id/beta/member";
	$email_dens="yudi.nurhandi@nusa.net.id";
	$biaya_instalasi=500000;
	$biaya_cable=10000;
	$biaya_router=40000;
	$biaya_stb=45000;
/*	$base_url="http://localhost/groovy";
	$base_url_member="http://localhost/groovy/member"; */
session_start();
include('../con/koneksi.php');
if (isset($_GET['hal'])){
	$hal=$_GET['hal'];
} else {
	$hal = "dashboard";
}
				if ($hal=="logout"){
						include('../con/'.$hal.'.php');
				} else {
						include('../con/function.php');
						include('../themes/header-member.php');
						include('../themes/linksrc.php');
			$res = $col_menu->find(array("hakakses"=>$level, "file"=>$hal));
			foreach($res as $row) {
			      					$file=$row['file'];
			}
			$res = $col_modul->find(array("hakakses"=>$level, "page"=>$hal));
			foreach($res as $row) {
			       					$page=$row['page'];
			}
	if (empty($file) && empty($page)) {
						include('../member/not-found.php');
	} else {

			if($hal<>"editprofile"){
										include('../member/sidebar.php');
						}

					include('../member/'.$hal.'.php');
			}
				}
?>
