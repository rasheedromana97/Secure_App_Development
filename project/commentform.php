<?php
require "database.php";
require "session_auth.php";
$rand = bin2hex(openssl_random_pseudo_bytes(16));
$_SESSION["nocsrftoken"] = $rand;
?>
<?php
$postID = $_GET["postID"];
$postmessage = $_GET["postmessage"];
?>


<html>
      <h1>Comment on Post</h31>
       <form action="showcomment.php" method="POST" class="form login">
          <input type = "hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
          <input type ="hidden" name ="postID" value="<?php echo htmlentities($postID); ?>"> </input> <br>
          <input name="postowner" value="<?php echo htmlentities(getpostowner($postID)); ?>"> </input> <br>
          <textarea readonly name="postmessage">  <?php echo showsinglepost($postID); ?> </textarea> <br>
          <textarea name="commentmessage"> </textarea><br>
          <button class="button" type="submit">
            Comment
          </button>
          <a href="index.php"> Back </a>
      </form>
  </html>