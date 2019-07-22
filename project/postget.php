<?php
	require "session_auth.php";
	require "database.php";
	$currentuser = $_SESSION["username"];
	$postID = $_POST["postID"];
	$postmessage = $_POST["postmessage"];
	$nocsrftoken = $_POST["nocsrftoken"];

	if(!isset($nocsrftoken) or ($nocsrftoken != $_SESSION['nocsrftoken'])) {
  		echo "<script>alert('Cross-Site Request Frogery is DETECTED!!');</script>";
  		header("Refresh:0; url=logout.php");
  		die();
  	}

	if(isset($postID) AND isset($postmessage)){
		//echo "DEBUG> postget.php ->Got: postID=$postID;postmessage=$postmessage\n";
		if(edit_posts($postID,$postmessage,$currentuser)){
			echo "<h4> The new message has been set.</h4>";
		}else{
			echo "<h4> Error: Cannot edit the message.</h4>";
		}
	}else{
		echo "No message provided to change.";
		exit();
	}
?>
	