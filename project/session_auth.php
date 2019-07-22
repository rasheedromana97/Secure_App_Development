<?php
	session_start();  
	if(!isset($_SESSION["logged"]) or $_SESSION["logged"] != TRUE) {
		echo "<script>alert('You have not logged in. Please Login First!');</script>";
		header("Refresh:0; url=form.php");
		die();
	}

	if($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]) {
		echo "<script>alert('WARNING : Session Hijacking is Detected !!');</script>";
		header("Refresh:0; url=form.php");
		die();
	}
?>