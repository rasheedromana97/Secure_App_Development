<?php
	require "session_auth.php";
	require "database.php";
	$currentuser = $_SESSION["username"];
	$postID = $_POST["postID"];
	$commentmessage = $_POST["commentmessage"];
	$nocsrftoken = $_POST["nocsrftoken"];

	if(!isset($nocsrftoken) or ($nocsrftoken != $_SESSION['nocsrftoken'])) {
  		echo "<script>alert('Cross-Site Request Frogery is DETECTED!!');</script>";
  		header("Refresh:0; url=logout.php");
  		die();
  	}
								
	if(isset($postID) AND isset($commentmessage)){
	//echo "DEBUG> comment.php ->Got: postID=$postID;commentmessage=$commentmessage\n";
		if(addcomment($postID,$commentmessage,$currentuser)){
			echo "<h4> Your Comment has been successfully added.</h4>";
		}else{
			echo "<h4> Error: Cannot add your comment.</h4>";
		}
		if($commentmessage=="")
		echo "No message provided to change.";
		exit();
	}
?>