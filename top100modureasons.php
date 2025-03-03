<?php //this is the page that eatmoreram.com redirects to
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
  createHeadSection('EAT. MORE. RAM.', 'EAT. MORE. RAM.', 'eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram eat more ram ');
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
    <h1 style="text-align: center;">Top 100 reasons why Modu is the best programming language and you should use it.</h1>
    <ol>
    <li>Beautiful syntax</li>
    <li>Fast for an interpreted language</li>
    <li>Active development</li>
    <li>Steamlined error messages for easy debugging</li>
    <li>Easy to learn</li>
    <li>Modern library system</li>
    <li>Open source</li>
    <li>You get to say "i use modu btw" (like i use arch btw but less cringe)</li>
    <li>Package manager built in</li>
    <li>It is made by Cyteon</li>
    <li>Cyteon is awesome, therefore Modu is awesome</li>
    <li>I said so</li>
    <li>Made with love and care 😊</li>
    <li>Easy to run and install: just download the latest binary from Github Actions and put it in your PATH folder.</li>
    <li>F*cedev has not made a video about it</li>
    <li>Modu moment</li>
    <li>It's just the goat</li>
    <li>It's Modu, who wouldn't use it</li>
    <li>I agree with the point above</li>
    <li>Modu is love</li>
    <li>Modu is life</li>
    <li>Modu is Modu</li>
    <li>The best community (join it right now for free robux >>>>> <a href="https://discord.gg/VvPqNkAUU7">https://discord.gg/VvPqNkAUU7</a> <<<<<)</li>
    <li>It's only existed for a month and it's already perfect</li>
    <li>Everyone is preparing to rewrite everything in modu</li>
    <li>Modu is almost as good as php</li>
    <li>It's not Go</li>
    <li>It's not Java</li>
    <li>It's not javascript</li>
    <li>It's almost as good as php (I've said this twice now)</li>
    <li>It's not malware</li>
    <li>You can make malware in it</li>
    <li>I have power in the community discord server</li>
    <li>I abuse my power and give permissions to ping @everyone to everyone from time to time</li>
    <li>I can't think of any more reasons and there are still 65 I need to fill in please help.</li>
    <li>Modu is the best programming language</li>
    <li>Wireless charging: Modu eliminates the need for cables and simplifies charging with it's innovative wireless charging technology.</li>
    <li>Apparently you can nuke France with it (but don't tell anyone I told you that)</li>
    <li>The OS library makes it even easier to remove the French language pack from your Linux system</li>
    <li>You can learn Modu easily with <a href="https://learnmodu.org">https://learnmodu.org</a></li>
    <li>If something basic breaks in Modu and it's not your fault you get to watch Cyteon suffer as he spends days trying to fix it (nesting)</li>
    <li>Modu's second package ever was made by me and it is awesome.</li>
    <li>The peak-functions Modu package makes it even easier to find Fred!</li>
    </ol>
</div>
</div>
</body>
</html>
