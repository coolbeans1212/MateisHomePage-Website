<?php

session_set_cookie_params([
    'secure' => true,
    'httponly' => true,
    'samesite' => 'None'
]);
ini_set('session.cookie_domain', '.mateishome.page');
session_start();
include_once __DIR__ . "/account/checkAccountIsModerated.php";
$mysqli = require __DIR__ . "/db.php";
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  require_once __DIR__ . "/applets/createHeadSection.php";
  createHeadSection('Contact Matei', 'Contact Matei', 'The awesome contact page. I don\'t know what else to say.');
  ?>
</head>
<body>
<script>
if ( window !== window.parent )
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // The page is in an iframe
      //window.location.replace("about:inducebrowsercrashforrealz"); // EVIL The page is in an iframe

}
</script>
<div class="page">
<?php
include_once __DIR__ . "/applets/navigation_bar.php"; // :3
?>
<br>
<div class="largeApplet">
  <h1>Contact me!</h1>
  You can contact me for any reason you would like to, but don't be mean. The contact methods are listed in order of most preferred to least preferred.<br><hr>
  Discord: @bmpimg<br>
  E-mail: matei@mateishome.page<br>
  Newgrounds: Mattamatt<br>
  Breaking into my server and leaving a note on the desktop: ssh pi@192.168.0.25<br>
  <hr>
  Tinfoil hat? <a href="/files/txt/Matei%5Bmatei%40mateishome.page%5D%2826DFDD3029FB44C8%29_pub.asc">Click here to download my PGP public key</a>.
</div>
</div>
</body>
</html>
