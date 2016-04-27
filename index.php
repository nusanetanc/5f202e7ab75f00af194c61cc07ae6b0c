<?php
	$base_url="http://groovy.id/beta";
	$base_url_member="http://groovy.id/beta/member";
/*	$base_url="http://localhost/groovy";
	$base_url_member="http://localhost/groovy/member"; */
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
			include('themes/footer.php');
} else {
?>
	<script type="" language="JavaScript">
	document.location='./member/'</script>
<?php } ?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/56f39d18f49b1f546d34d638/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
