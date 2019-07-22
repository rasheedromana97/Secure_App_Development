<?php
require "session_auth.php";
$rand = bin2hex(openssl_random_pseudo_bytes(16));
$_SESSION["nocsrftoken"] = $rand;
?>
<html>
      <h1>Change Password</h1>
      <h4>SecAD-sm19 miniFB project Romana Rasheed </h4>
<!-- <?php
  //echo "Current time: " . date("Y-m-d h:i:sa")
?> -->
          <form action="changepassword.php" method="POST" class="form login">
                Username:<?php echo htmlentities($_SESSION["username"]); ?>
                <br>
                <input type = "hidden" name="nocsrftoken" value="<?php echo $rand; ?>" />
                New Password: <input type="password" class="text_field" name="newpassword" /> <br>
                <button class="button" type="submit">
                  Change Password
                </button>
                <a href="index.php"> Back </a>
          </form>
  </html>