
<?php
	require "database.php";
	$username = $_POST["username"];
	$password = $_POST["password"];
	if (!validateUsername($username) or !validatePassword($password)) {
		echo "TODO: error";
		die();
	}
	echo "DEBUG: got username = $username; password = $password";
	
	if(addnewuser($username, $password)) {
		echo "<h4>" . htmlentities("New account with username = '$username' has been added.") . "</h4>";
	} else {
		echo "<h4>" . htmlentities("Cannot add new account with username = '$username'.") . "</h4>";
	}	
	
	function validateUsername($username) {
		if(!isset($username)) {
			return FALSE;
		}
		
		return TRUE;
	}

	function validatePassword($password) {
		if(!isset($password)) {
			return FALSE;
		}
		
		return TRUE;
	}
?>
	