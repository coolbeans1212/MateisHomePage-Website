<?php
session_start();
include_once __DIR__ . "/../../account/checkAccountIsModerated.php";
$mysqli = require __DIR__ . "/../../db.php";
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
  require_once __DIR__ . "/../../applets/createHeadSection.php";
  createHeadSection('API Documentation', 'MateisHomePage API Documentation', 'Documentation for the MateisHomePage APIs. They are awesome and you WILL use them (I\'m not asking).');
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
include_once __DIR__ . "/../../applets/navigation_bar.php"; // :3
?>
<br>
<div class="largeApplet">
    <h1>API Documentation</h1>
    <p>MateisHomePage Technologies provides many free APIs. The documentation for these APIs are listed here.</p>
    <h2>Links to documentations</h2>
    <ul>
    <a href="quotes.php"><li>Quote API</li></a>
    <a href="users.php"><li>User API</li></a>
    </ul>
</div>
</div>
</body>
</html>
