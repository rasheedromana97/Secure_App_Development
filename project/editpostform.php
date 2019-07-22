<?php
require "database.php";
require "session_auth.php";
$rand = bin2hex(openssl_random_pseudo_bytes(16));
$_SESSION["nocsrftoken"] = $rand;
?>
<?php
$postID = $_GET["postID"];
?>
<html>
      <h1>Edit Post</h31>
      <h4>SecAD-sm19 miniFB project Romana Rasheed </h4>

          <form action="postget.php" method="POST" class="form login">
                Name:<?php echo htmlentities($_SESSION["username"]); ?> <br>
                <input type="hidden" name="nocsrftoken" value="<?php echo "$postID";?>" /> <br>
                <textarea name="postmessage"> <?php echo showsinglepost($postID); ?> </textarea> <br>
                <button class="button" type="submit">
                  Edit Post
                </button>
                <a href="index.php"> Back </a>
                <a href="logout.php"> Logout </a>
          </form>
  </html>