<?php
$mysqli = require_once "/var/www/html/db.php";
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
  <?php include_once __DIR__ . "/../applets/style.php";?></head>
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
</div>
</body>
</html>
