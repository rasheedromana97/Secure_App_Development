<?php
	require "session_auth.php";
	require "database.php";
	$postowner = $_SESSION["username"];
	$postmessage = $_POST["postmessage"];
	$nocsrftoken = $_POST["nocsrftoken"];

	if(!isset($nocsrftoken) or ($nocsrftoken != $_SESSION['nocsrftoken'])) {
  		echo "<script>alert('Cross-Site Request Frogery is DETECTED!!');</script>";
  		header("Refresh:0; url=logout.php");
  		die();
  	}

	if (!validatePmessage($postmessage)) {
	echo "ERROR!";
	die();
	}

	if(addnewpost($postowner,$postmessage)) {
		echo "<h4>" . htmlentities("New message= '$postmessage' has been added.") . "</h4>";
	} else {
		echo "<h4>" . htmlentities("Cannot add the message = '$postmessage'.") . "</h4>";
	}
	function validatePmessage($postmessage) {
		if($postmessage == ""){
			echo "The message cannot be empty\n";
			return FALSE;
		}
		else
			return TRUE;
	}
?>
	