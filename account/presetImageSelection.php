<?php
session_start();
include_once __DIR__ . "/../account/checkAccountIsModerated.php";
$mysqli = require __DIR__ . "/../db.php";
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
  require_once __DIR__ . "/../applets/createHeadSection.php";
  createHeadSection('Pick your favourite profile picture', 'Pick a profile picture for your MateisHomePage account', 'What\'s that? You can have an AWESOME image to represent yourself? Wow! That\'s so cool!');
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
include_once __DIR__ . "/../applets/navigation_bar.php"; // :3
?>
<br>
  <div class="largeApplet">
      <h1>Pick your favourite profile picture.</h1>
      <span id="loadingIndicator">Loading images, please wait...</span><br>
      <?php
      for ($pfps = 1; $pfps <= 78; $pfps++) {
          echo '<a href="customisationProcessing.php?set=true&image=' . $pfps . '"><img src="/files/images/pfps/thumbnails/' . $pfps . '.jpg" width="80px;" height="80px;"></img></a> ';
      }
      ?>
      <script>
          const element = document.getElementById("loadingIndicator");
          element.remove();
      </script>
  </div>
  <br>
  <a href="customise.php">
    <div class="smallApplet" style="text-align: center; margin: auto; width: 10%;">
        Cancel
    </div>
  </a>
</div>
</body>
</html>
