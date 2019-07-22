<?php
		$mysqli = new mysqli('localhost','rasheedr1','S3cuReA99','secad_sm19');
		if($mysqli->connect_errno){
			echo "Connection to the database failed.."; 
			exit();
	} 
	function getpostowner($postID){
		global $mysqli;
		$prepared_sql = "SELECT postowner FROM posts WHERE postID = ?;";
		//echo "Postid : $postID";
		if(!$stmt = $mysqli->prepare($prepared_sql)){	
			echo "Cannot prepare a statement";
			return;
		}
		$stmt->bind_param("i",$postID);
		
		if(!$stmt->execute()){
			echo "Execute Error";
			return;
		}
		
		if(!$stmt->bind_result($postowner)){
			echo "Binding FAILED";
			return;
		}

		while($stmt->fetch()){
		echo htmlentities($postowner);
		return;
		}
	}
	function changepassword($username, $newpassword) {
		global $mysqli;
		$prepared_sql = "UPDATE users SET  password = password(?) where username = ?;";
		if(!$stmt = $mysqli->prepare($prepared_sql))	return FALSE;
		$stmt->bind_param("ss",$newpassword,$username);
		if(!$stmt->execute())	return FALSE;
		return TRUE;
	}

	function addnewuser($username, $password) {
		global $mysqli;
		$prepared_sql = "INSERT INTO users VALUES (?, password(?));";
		if(!$stmt = $mysqli->prepare($prepared_sql))	return FALSE;
		$stmt->bind_param("ss",$username,$password);
		if(!$stmt->execute())	return FALSE;
		return TRUE;
	}
	
	function addnewpost($postowner, $postmessage) {
		global $mysqli;
		$prepared_sql = "INSERT INTO posts(postowner,postmessage) VALUES (?,?);";
		//echo "DEBUG: got postowner = $postowner; postmessage = $postmessage";
		//echo "Inserting values soon";
		if(!$stmt = $mysqli->prepare($prepared_sql))	return FALSE;
		$stmt->bind_param("ss",$postowner,$postmessage);
		if(!$stmt->execute())	return FALSE;
		return TRUE;
	}
	function addcomment($postID,$commentmessage,$commentowner){
		global $mysqli;
		$prepared_sql = "INSERT into comments (commentmessage,commentowner,postID) VALUES (?,?,?);";
		if(!$stmt=$mysqli->prepare($prepared_sql))
			echo "prepared statement error";
			$stmt->bind_param("ssi",$commentmessage,$commentowner,$postID);
			if(!$stmt->execute()){
				echo "Execute error";
				return FALSE;
			}
		return TRUE;
	}
	
	function edit_posts($postID,$postmessage,$postowner){
		global $mysqli;
		$prepared_sql = "UPDATE posts SET postmessage=? WHERE postID=? AND postowner=?;";
		if(!$stmt=$mysqli->prepare($prepared_sql))
		echo "prepared statement error";
		$stmt->bind_param("sis",$postmessage,$postID,$postowner);
		if(!$stmt->execute()){
		echo "Execute error"; return FALSE;
		}
		return TRUE;
	}

	function delete_posts($postID,$postowner){
		global $mysqli;
		$prepared_sql = "DELETE FROM posts WHERE postID =? AND postowner=?;";
		if(!$stmt=$mysqli->prepare($prepared_sql))
		echo "prepared statement error";
		$stmt->bind_param("is",$postID,$postowner);
		if(!$stmt->execute()){
		echo "Execute error"; return FALSE;
		}
		return TRUE;
	}
	function showsinglepost($postID) {
		global $mysqli;
		$prepared_sql = "SELECT postmessage FROM posts WHERE postID = ?;";
		if(!$stmt = $mysqli->prepare($prepared_sql)){	
		echo "Cannot prepare a statement";
		return;
		}
		$stmt->bind_param("i",$postID);
		if(!$stmt->execute()){
		echo "DEBUG > Execute Error";
		return;
		}
		if(!$stmt->bind_result($postmessage)){
		echo "Binding FAILED";
		return;
		}
		while($stmt->fetch()){
		echo htmlentities($postmessage);
		return;
		}
	}

	function showallposts($username) {
		global $mysqli;
		$prepared_sql = "SELECT postID,postmessage,posttime,postowner FROM posts;";
		if(!$stmt = $mysqli->prepare($prepared_sql)){	
		echo "Cannot prepare a statment";
		return;
		}
		if(!$stmt->execute()){
		echo "DEBUG > Execute Error";
		return;
		}
		if(!$stmt->bind_result($postID, $postmessage, $posttime, $postowner)){
		echo "Binding FAILED";
		return;
		}
		$postcount=0;
		while($stmt->fetch()){
			echo "On " . htmlentities($posttime) . "<br>" . htmlentities($postowner) . "</b> Wrote: <br>".htmlentities($postmessage) . "<br>\n";

			if($username == $postowner){
			echo "<a href = 'editpostform.php?postID=" . htmlentities($postID) . "'> Edit..</a><br>\n";
			echo "<a href = 'deletepostform.php?postID=" . htmlentities($postID) . "'> Delete..</a><br>\n";
			
			$postcount++;
			}
			echo "<a href = 'commentform.php?postID=" . htmlentities($postID) ."'> Comment..</a><br>\n";
		}

		if($postcount==0){
			echo "There is no post. <a href = 'addnewpostform.php'>Add a new one. </a><br>\n";
		}else{
			echo "<a href='addnewpostform.php'>Add a new post. </a><br>\n";
		}
	}
?>