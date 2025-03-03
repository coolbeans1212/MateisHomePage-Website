<?php
session_start();
include_once __DIR__ . "/../account/checkAccountIsModerated.php";
$mysqli = require __DIR__ . "/../db.php";
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require "/var/www/html/db.php"; //require_once fails for some reason? i have no idea why, please make pr if you know
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    if ($stmt === false) {
        die("SQL prepare failed: " . $mysqli->error);
    }
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
   
   if ($user) {
      if (password_verify($_POST["password"], $user["hashed_password"])) {
         session_start();
         session_regenerate_id();
         $_SESSION["user_id"] = $user["id"];
         $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
         if (!$user['first_ip']) {
          $sql = "UPDATE users SET first_ip = ? WHERE username = ?";  //prepare statement
          $stmt = $mysqli->stmt_init();
          $stmt->prepare($sql);
          $stmt->bind_param('ss', $ip, $_POST["username"]); //bind paramaters ready to be executed
          $stmt->execute();
        }
         $sql = "UPDATE users SET last_ip = ? WHERE username = ?";  //prepare statement
         $stmt = $mysqli->stmt_init();
         $stmt->prepare($sql);
         $stmt->bind_param('ss', $ip, $_POST["username"]); //bind paramaters ready to be executed
         $stmt->execute();
         header("Location: /");
         exit;
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  require_once __DIR__ . "/../applets/createHeadSection.php";
  createHeadSection('Log in', 'Log in to your MateisHomePage account', 'WOAH! You can have an account on my awesome website??? Awhaaaaat????? Tubular!');
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
      <h1>Log in</h1>
    <form method="post">
        <label for="username">Username</label><br>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($_POST["username"] ?? "") ?>"><br>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="Log in">
        <?php if (isset($_POST['password'])): //if this is set and the user is still on the login page, it means the credentials are incorrect ?>
          <br><oblique>Invalid login</oblique>
        <?php endif; ?>
    </form>
    </div>
</div>
</body>
</html>
