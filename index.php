<?php
	$base_url="http://www.groovy.id/beta";
	$base_url_member="http://www.groovy.id/beta/member";
session_start();
if (!isset($_SESSION["id"])) { 
	if (isset($_GET['hal'])){	
		$hal=$_GET['hal'];
	} else if (isset($_GET['a'])) {
		$user = $_GET['a'];
		$hal = "index";
	} else {
		$hal = "index";
	}

			include('con/koneksi.php');
			include('con/function.php');
			include('themes/srclink.php');		
			include('themes/header.php');
			include('content/'.$hal.'.php');
			if (empty($hal)){
				include('content/not-found.php');
			}
			include('themes/footer.php');	
} else {			
?>
	<script type="" language="JavaScript">
	document.location='./member/'</script>
<?php } ?>

