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
  createHeadSection('Coming soon...', 'Coming soon... (very spooky)', 'This page is coming soon! (I promise 🤞)');
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
<div class="mediumApplet" style="margin:auto;">
    <h1>Coming soon!</h1>
    This hasn't been made yet, but I'm working on it! (trust me)
</div>
</div>
</body>
</html>
