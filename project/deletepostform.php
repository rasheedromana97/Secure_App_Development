<?php
require "session_auth.php";
require "database.php";
$rand = bin2hex(openssl_random_pseudo_bytes(16));
$_SESSION["nocsrftoken"] = $rand;
$postID = $_GET["postID"];
?>
<html>
      <h1>Delete Post</h1>
          <form action="deletepost.php" method="POST" class="form login">
                Name:<?php echo htmlentities($_SESSION["username"]); ?> <br>
                <input type="hidden" name="postID" value="<?php echo htmlentities("$postID");?>"> <br>
                <input type="hidden" name="nocsrftoken" value="<?php echo $rand;?>"> </input>
                <textarea readonly name="postmessage"> <?php echo showsinglepost($postID); ?> </textarea> <br>
                <button class="button" type="submit">
                  Delete Post
                </button>
                  <a href="index.php"> Back </a>
                  <a href="logout.php"> Logout </a>
          </form>
  </html>