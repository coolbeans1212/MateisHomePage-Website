<?php
include_once __DIR__ . "/../account/checkAccountIsModerated.php";
$mysqli = require __DIR__ . "/../db.php";
session_start();
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
} else {
    header("Location: https://mateishome.page/account/login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  require_once __DIR__ . "/../applets/createHeadSection.php";
  createHeadSection('Customise your profile', 'Customise your MateisHomePage user account', 'You can change your profile?! And it will make you look not like a spam account?! Sign me up!!!');
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
    <div class="largeApplet" style="display: flex;">
        <div style="text-align: center;">
        <img onerror="this.onerror=null; this.src='/files/images/pfps/error.png'" class="pfpLarge" src="
        <?php
        if (isset($user['pfp']) && $user['pfp'] > 100) {
            echo 'https://assetdelivery.roblox.com/v1/asset/?id=' . htmlspecialchars($user['pfp']);
        } elseif ($user['pfp'] < 100) {
            echo '/files/images/pfps/' . htmlspecialchars($user['pfp']) . '.png';
        } else {
            echo '/files/images/pfps/error.png';
        }
        ?>" alt="Your profile">
        <div>
            <form action="customisationProcessing.php" method="GET" style="margin-bottom: 0px;">
                <label for="pfp">ROBLOX Image ID:</label><br>
                <input type="text" id="image" name="image" value="<?php echo $user['pfp'] ?>"><br>
                <input type="hidden" name="type" id="type" value="profileImage">
                <input type="submit" value="Submit"><br>
            </form>
                OR<br>
                <form action="presetImageSelection.php">
                <input type="submit" value="Use preset image">
                </form>
            </div>
        </div>
        <div style="margin: 5px;">
            <div style="display: flex; flex-direction: column;">
                <?php echo '<span class="username">' . $user['username'] . '</span>' ?>
                <div style="display: flex">
                    <div style="margin-right: 15px;">
                        <form action="customisationProcessing.php" method="GET">
                            <label for="status">Set a custom status:</label><br>
                            <input type="text" id="status" name="status" value="<?php echo $user['shortbio'] ?>" style="width: 300px;" maxlength="50">
                            <input type="hidden" name="type" id="type" value="customStatus"><br>
                            <input type="submit" value="Submit" style="margin-left: 0px;">
                        </form>
                        <form action="customisationProcessing.php" method="GET">
                            <label for="status">Describe yourself:</label><br>
                            <textarea id="description" name="description" maxlength="5000"><?php echo $user['bigdescription']; ?></textarea>
                            <input type="hidden" name="type" id="type" value="description">
                            <input type="submit" value="Submit" style="margin-left: 0px;">
                        </form>
                    </div>
                    <!--
                    <div style="margin-left: 15px;">
                        <form action="customisationProcessing.php" method="GET">
                            <label for="website">Website:</label><br>
                            <input type="text" id="website" name="website" value="<?php echo $user['website'] ?>" style="width: 300px;" maxlength="50">
                            <input type="hidden" name="type" id="type" value="website"><br>
                            <input type="submit" value="Submit" style="margin-left: 0px;">
                        </form>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
