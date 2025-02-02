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
    <h1>API Documentation: User API</h1>
    <p>To use the user API, send a GET request to <span class="codeBlock">https://mateishome.page/api/getMHPUser.php</span>.</p>
    <h2>Usage</h2>
    <p>There is one required paramater and one optional parameter: <span class="codeBlock">id</span> and <span class="codeBlock">type</span> respectively.
    You must set the value of ID to the ID of the user you want to get information on. The value of <span class="codeBlock">type</span> can be set to either
    nothing, <span class="codeBlock">plaintext</span> or <span class="codeBlock">json</span>. If <span class="codeBlock">type</span> is set to nothing or
    <span class="codeBlock">json</span>, it will return information on the user in JSON format. If it is set to <span class="codeBlock">plaintext</span>,
    then it will return information on the user in format <span class="codeBlock">key1:value1;key2:value2;</span>.</p>
    <h2>Returned Fields</h2>
    <p>It will return the following fields: <span class="codeBlock">id</span>, <span class="codeBlock">username</span>, <span class="codeBlock">date_created</span>, <span class="codeBlock">admin</span>,
    <span class="codeBlock">special</span>, <span class="codeBlock">shortbio</span>, <span class="codeBlock">bigdescription</span>, <span class="codeBlock">pfp</span>, <span class="codeBlock">website</span>,
    and <span class="codeBlock">pfp_url</span>.<br>
    <span class="codeBlock">id</span>: The ID of the user.<br>
    <span class="codeBlock">username</span>: The username of the user.<br>
    <span class="codeBlock">date_created</span>: The date the user signed up.<br>
    <span class="codeBlock">admin</span>: Whether the user is an admin or not (will return 1 or null).<br>
    <span class="codeBlock">special</span>: The user's badges (I haven't coded this yet but it's coming soon™).<br>
    <span class="codeBlock">shortbio</span>: The user's custom status.<br>
    <span class="codeBlock">bigdescription</span>: The user's description.<br>
    <span class="codeBlock">pfp</span>: The user's profile picture ID.<br>
    <span class="codeBlock">website</span>: The user's website (I haven't coded this yet but it's coming soon™).<br>
    <span class="codeBlock">pfp_url</span>: The URL of the user's profile picture.
    </p>
    <h2>Examples</h2>
    <p>All examples are written in the best language ever, PHP.</p>
    <div class="codeBlock">
      // Method 1: Get information on a user formatted in JSON.<br>
      $matei = json_decode(file_get_contents("https://mateishome.page/api/getMHPUser.php?id=1"));<br>
      echo $matei->username . '\'s profile picture is located at ' . $matei->pfp_url; // Will return something like `admin's profile picture is located at https://assetdelivery.roblox.com/v1/asset/?id=17512542782`<br>
      <br>
      // Method 2: Get information on a user in plaintext<br>
      $matei = file_get_contents("https://mateishome.page/api/getMHPUser.php?id=1&type=plaintext");<br>
      echo $matei; // Will return something like username:admin;id:1;admin:1;date_created:2024-03-10 11:05:42;...<br>
      //but why would you ever want to do it like this<br>
    </div>
  </div>
  <br>
  <a href="/api/docs/"><button class="navigationButton">Go Back</button></a>
</div>
</body>
</html>
