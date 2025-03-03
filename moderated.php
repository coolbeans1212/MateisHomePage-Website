<?php
$mysqli = require_once __DIR__ . "/db.php";
session_start();
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}
require_once __DIR__ . "/api/internalFunctions.php";
if (!$user || !isUserModerated($_SESSION["user_id"])) {
  header("Location: /");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  require_once __DIR__ . "/applets/createHeadSection.php";
  createHeadSection('MateisHomePage: Moderated', 'MateisHomePage: Moderated', 'If you can access this page, that means you\'ve been mean >:(.');
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
        <?php
        $moderationInfo = json_decode(isUserModerated($_SESSION["user_id"]));
        switch($moderationInfo->type) { // match block is php 8 only i swear im gonna crash out
            case "1d": $banType = "Banned for 1 day"; break;
            case "3d": $banType = "Banned for 3 days"; break;
            case "7d": $banType = "Banned for 7 days"; break;
            case "14d": $banType = "Banned for 14 days"; break;
            case "30d": $banType = "Banned for 30 days"; break;
            case "t": $banType = "Account terminated"; break;
            case "ip": $banType = "IP Banned"; break;
            default: $banType = "Unknown ban type";
        }
        ?>
        <h1><?php echo $banType; ?></h1>
        <p class="smallMargins">You have been moderated by a MateisHomePage admin for the following reason:</p>
        <?php echo $moderationInfo->reason; ?>
        <?php if ($moderationInfo->moderatornote): ?>
        <p class="smallMargins">The administrator who moderated you left this moderator note:</p>
        <?php echo $moderationInfo->moderatornote; ?>
        <?php elseif (!$moderationInfo->moderatornote): ?>
        <p class="smallMargins">The administrator who moderated you did not leave a moderator note.</p>
        <?php endif; ?>
        <br>
        <p>This moderation will expire on <strong><?php echo date("F j, Y, g:i a", strtotime($moderationInfo->expires)); ?></strong>. You will not be able to access any
        MateisHomePage services until then while you are logged in.
        <br>
        If you believe that this decision was made in error, please contact <a href="mailto:matei@mateishome.page">matei@mateishome.page</a> via email.</p>
    </div>
    <br>
    <button class="navigationButton" style="margin-bottom: 27.4px;"> <!-- for some reason <br> isnt working so margin-bottom woohooo!!!!! -->
        <a href="/logout.php">Log out</a>
    </button>
    <?php if (!$_COOKIE['nomorejohn']): ?>
        <div class="longApplet">
            <div style="display: flex;">
            <iframe src="https://john.citrons.xyz/embed?ref=mateishome.page" style="margin-left:auto;display:block;margin-right:auto;max-width:732px;width:100%;height:94px;border:none;" title="johnvertisement"></iframe>
                <div>
                <a href="nomorejohn.php">Click here</a> if you never want to see a johnvertisement again (for a decade or until you clear your cookies).</a>
                </div>
            </div>
        </div>
        <br>
  <?php endif; ?>
</div>
</body>
</html>
