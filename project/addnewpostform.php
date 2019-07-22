<?php
require "session_auth.php";
require "database.php";
//Implementing secret token.
$rand = bin2hex(openssl_random_pseudo_bytes(16));
$_SESSION["nocsrftoken"] = $rand;
?>
<html>
      <h1>Share some thoughts with your friends</h1>
<!-- <?php
  //echo "Current time: " . date("Y-m-d h:i:sa");
?> -->
          <form action="addnewpost.php" method="POST" class="form login">
                Name:<?php echo htmlentities($_SESSION["username"]); ?> <br>
                <input type = "hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
                Message: <input type="textarea" class="textarea" name="postmessage" /> <br>
                <button class="button" type="submit">
                  Post!
                </button>
                <a href="index.php"> Back </a>
                <a href="logout.php"> Logout </a>
          </form>
  </html>