<?php
	session_start();  
	require 'database.php'; 
	
	if(isset($_POST["username"]) and isset($_POST["password"])) {
		if (securechecklogin($_POST["username"],$_POST["password"])) {
			$_SESSION["logged"] = TRUE;
			$_SESSION["username"] = $_POST["username"];
			$_SESSION["browser"] = $_SERVER["HTTP_USER_AGENT"];
		} else {
			echo "<script>alert('Invalid username/password');</script>";
			unset($_SESSION["logged"]);
			header("Refresh:0; url=form.php");
			die();
		}
	} 
	// Check the session, if not logged then redirect the user back to the login page
	if(!isset($_SESSION["logged"]) or $_SESSION["logged"] != TRUE) {
		echo "<script>alert('You have not logged in. Please Login First!');</script>";
		header("Refresh:0; url=form.php");
		die();
	}

	//Check the information from the browser and the session
	if($_SESSION["browser"] != $_SERVER["HTTP_USER_AGENT"]) {
		echo "<script>alert('WARNING : Session Hijacking is Detected !!');</script>";
		header("Refresh:0; url=form.php");
		die();
	}
?>

	<h2> Welcome <?php echo htmlentities($_SESSION["username"]); ?> !</h2>
	<a href="logout.php">Logout</a><br>
	<a href="changepasswordform.php">Change password</a><br>
<?php
	showallposts($_SESSION['username']);
	function checklogin($username, $password) {
		$mysqli = new mysqli('localhost','rasheedr1','S3cuReA99','secad_sm19');
		if($mysqli->connect_errno){
			printf("Connect to the database failed: %s\n", $mysqli->connect_errno);
			exit();
		}
		$sql= "SELECT * FROM users WHERE username='". $username."'"; 
		$sql= $sql. "AND password=password('".$password."');";
		//echo htmlentities("DEBUG> sql=$sql");
		$result = $mysqli->query($sql);
		if ($result->num_rows==1){
			return TRUE;
		}
		return FALSE;
		
  	}

  	function securechecklogin($username, $password) {
		$mysqli = new mysqli('localhost','rasheedr1','S3cuReA99','secad_sm19');
		if($mysqli->connect_errno){
			printf("Connect to the database failed: %s\n", $mysqli->connect_errno);
			exit();
		}
		$prepared_sql= "SELECT * FROM users WHERE username=? AND password=password(?);";
		//echo htmlentities("DEBUG> prepared_sql=$prepared_sql");
		if (!$stmt=$mysqli->prepare($prepared_sql)){
			echo "Prepared Statement Error";
			return FALSE;
		}
		$stmt->bind_param("ss",$username,$password);
		if(!$stmt->execute()) {
			echo "DEBUG >Execute Error";
			return FALSE;
		}

		if(!$stmt->store_result()) {
			echo "DEBUG > Store Error";
			return FALSE;
		}
		$result = $stmt;
		if ($result->num_rows==1){
			return TRUE;
		}
		return FALSE;
	}
?>
