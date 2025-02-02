<?php
$mysqli = require_once __DIR__ . "/../../db.php";
session_start();
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <title>Matei's Homepage!</title>
  <meta content="a cool website all about me, Matei!" property="og:title" />
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" />
  <meta content="https://mateishome.page" property="og:url" />
  <meta content="https://mateishome.page/welcome.gif" property="og:image" />
  <meta content="#24589E" data-react-helmet="true" name="theme-color" />
  <?php include_once __DIR__ . "/../../applets/style.php";?></head>
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
