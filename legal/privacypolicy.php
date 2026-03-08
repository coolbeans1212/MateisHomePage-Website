<?php

session_set_cookie_params([
    'secure' => true,
    'httponly' => true,
    'samesite' => 'None'
]);
ini_set('session.cookie_domain', '.mateishome.page');
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
  createHeadSection('Privacy Policy', 'MateisHomePage Privacy Policy (boring)', 'Boring legal stuff, don\'t worry about it. We probably aren\'t evil.');
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
  <h1>Privacy Policy</h1>
  <p>"please dont sue me" -me when i realised that GDPR exists</p>
  <h2>Part 1: Cookies</h2>
  <p>When you access this website, 2 cookies are created and checked:</p>
  <table>
    <tr>
      <th>Cookie name</th>
      <th>Function</th>
    </tr>
    <tr>
      <td>PHPSESSID</td>
      <td>Used to identify your session and login. Deleting this cookie will sign you out, if you are signed in.</td>
    </tr>
    <tr>
      <td>cf_clearance</td>
      <td>Used by Cloudflare to protect the website from bot attacks. Used to identify that you have passed the security check.</td>
    </tr>
  </table>
  <p>If you disable johnvertisements, another cookie is created:</p>
  <table>
    <tr>
      <th>Cookie name</th>
      <th>Function</th>
    </tr>
    <tr>
      <td>nomorejohn</td>
      <td>If this cookie exists, you will not be shown johnvertisements.</td>
    </tr>
  </table>
  <h2>Part 2a: Data we <!--- what "we" bro it's literally just me 😭😭 -->collect - data linked to your account.</h2>
  <p>When you create an account on this website, we store the following information:</p>
  <ul>
    <li>Your username.</li>
    <li>Your e-mail address.</li>
    <li>Your password (hashed with the bcrypt algorithm, 10 rounds).</li>
    <li>Your account creation date and time.</li>
    <li>The IP address you used to sign up and the IP address you last used to log in.</li>
    <li>Any data that you have given to us by customising your account (for example, profile picture).</li>
  </ul>
  <h2>Part 2b: Data we collect - data not linked to your account.</h2>
  <p>Software used to make this website possible (i.e. Apache) may log some information that might be linked to your IP address or be fully anonymised. This includes:</p>
  <ul>
    <li>IP address.</li>
    <li>Browser information and user agent.</li>
    <li>Date and time of requests.</li>
    <li>Requested resources.</li>
    <li>Referrer.</li>
  </ul>
  <h2>Part 3: Data shared with 3rd parties</h2>
  <p>Yes, that's right! MateisHomePage Technologies is EVIL!!!!!! :O</p>
  <p>We share the following information with 3rd parties:</p>
  <ul>
    <li>IP and e-mail address - shared with StopForumSpam to prevent spam accounts</li>
    <li>IP address and browser information - processed by Cloudflare for security and performance reasons</li>
  </ul>
  <p>No personal data is sold or shared for advertising purposes, however there are advertisements on the website. These are johnvertisements, and unlike other advertisements, they are awesome. You can easily
  <a href="/nomorejohn.php">disable johnvertisements</a> if you don't like them. Johnvertisements only store your IP address. You can contact the johnvertisements administrator <a href="https://citrons.xyz/citrons/">here</a>.</p>
  </p>
  <p>Privacy policy last updated: 2026-03-08. You can view the changes on <a href="https://github.com/coolbeans1212/MateisHomePage-Website">GitHub</a>.</p>
</div>
</div>
</body>
</html>
