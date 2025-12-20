<?php
http_response_code(404);

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
$osRelease = file_get_contents("/etc/os-release");
$osRelease = explode("\n", $osRelease);
$osName = 'Unknown OS';
$osLike = 'Unknown OS';
foreach ($osRelease as $line) {
    if (strpos($line, 'NAME=') === 0 && strpos($line, 'PRETTY_NAME') === false) {
        $osName = str_replace('NAME=', '', $line);
        $osName = trim($osName, '"');
    }
    if (strpos($line, 'ID_LIKE=') === 0) {
        $osLike = str_replace('ID_LIKE=', '', $line);
        $osLike = trim($osLike, '"');
        $osLike = str_split($osLike);
        $osLike[0] = strtoupper($osLike[0]);
        $osLike = implode('', $osLike);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once __DIR__ .  '/../applets/createHeadSection.php';
  createHeadSection('404 Not Found');
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
<div class="mediumApplet" style="text-align: center; margin: auto;">
    <h1>404 - Page not found</h1>
    <p>The requested URL could not be found on the webserver.</p>
    <hr>
    <oblique><?php echo $osName . ' server (like ' . $osLike . ') @ ' . $_SERVER['SERVER_NAME'] . '.'; ?></oblique>
</div>
</div>
</body>
</html>
