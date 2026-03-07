<?php
$mysqli = require_once __DIR__ . "/../db.php";

session_set_cookie_params([
    'secure' => true,
    'httponly' => true,
    'samesite' => 'None'
]);
ini_set('session.cookie_domain', '.mateishome.page');
session_start();
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT username,admin FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}
if (!$user['admin']) {
    header("Location: /");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
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
    <div class="appletContainer">
      <div class="mediumApplet" style="width: 49%;">
        <h1>Admin Panel</h1>
      </div>
      <div class="mediumApplet" style="width: 49%;">
        <h1>Inspect User</h1>
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
          $username = $_POST["username"];
          $sql = "SELECT * FROM users WHERE username = ?";
          $stmt = $mysqli->prepare($sql);
          $stmt->bind_param("s", $username);
          $stmt->execute();
          $result = $stmt->get_result();
          if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $userPFP = file_get_contents("https://mateishome.page/api/getMHPUser.php?id=" . $user["id"]);
            $userPFP = json_decode($userPFP, true);
            $userPFP = $userPFP["pfp_url"];
            echo '<div style="display: flex;">';
            echo '<img class="pfpLarge" src="' . $userPFP . '" alt="User Profile" style="margin-right: 10px;" onerror="this.onerror=null;this.src=\'https://mateishome.page/files/images/pfps/error.png\';">';
            echo '<div style="display: flex; flex-direction: column;">';
            echo '<h1>' . htmlspecialchars($user["username"]) . '</h1>';
            echo '<span>Date Created: ' . htmlspecialchars($user["date_created"]) . '</span>';
            echo '<span>Status: \'' . htmlspecialchars($user["shortbio"]) . '\'</span>';
            echo '<span>Bio: <a class="clicktoviewbio" style="cursor: pointer;">Click to view</a></span>';
            if ($user["email"] == "") {
              $emailIsValid = "Blank";
            } elseif (filter_var($user["email"], FILTER_VALIDATE_EMAIL)) {
              $emailIsValid = "Valid (Unverified)";
            } else {
              $emailIsValid = "Invalid";
            }
            echo '<span>Email address: ' . $emailIsValid . '</span>';
            echo '</div>';
            echo '</div>';
          } else {
            echo "<p>User not found.</p>";
          }
        }
        ?>
        <form action="." method="post">
          <input type="text" name="username" placeholder="admin" required>
          <input type="submit" value="Inspect User">
        </form>
        <script>
          document.querySelector('.clicktoviewbio').addEventListener('click', function() {
            alert(<?php echo json_encode($user['bigdescription']); ?>);
          });
        </script>
      </div>
</body>
</html>
