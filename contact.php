<?php
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
  You can contact me for any reason you would like to, just please don't stalk or harass me. The contact methods are listed in order of most preferred to least preferred.<br><hr>
  Discord: @bmpimg<br>
  E-mail: matei@mateishome.page<br>
  Newgrounds: Mattamatt<br>
  Breaking into my server and leaving a note on the desktop: ssh pi@192.168.0.25<br>
</div>
</div>
</body>
</html>
