<?php
	$base_url="http://groovy.id/beta";
	$base_url_member="http://groovy.id/beta/member";
	$email_dens="yudi.nurhandi@nusa.net.id";
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
				header("location:".$base_url_member."/303");
	} else {

			if($hal<>"editprofile"){
										include('../member/sidebar.php');
						}
if(!file_exists('../member/'.$hal.'.php')){
	header("location:".$base_url_member."/303");
}
					include('../member/'.$hal.'.php');
			}
				}
?>
