<?php
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
  createHeadSection('"Real" People!', '"Real" People!', 'Here you can find all of the users who have made the mistake of signing up to my awesome website.');
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
<div class="appletContainer">
  <a href="users.php?offset=<?php if($_GET['offset'] < 6) { echo '0';} else { echo $_GET['offset'] - 6;} ?>&search=<?php echo $_GET['search'] ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Previous</button></a> <!--stolen from guestbook.php... mwahahaha-->
  <div class="mediumApplet" style="text-align: center; margin: auto;">
    <h1>Users</h1>
    <form method="get">
      <label for="search">Search by username:</label><br>
      <input type="text" id="search" name="search" placeholder="admin" value="<?php echo $_GET['search']; ?>">
      <input type="submit">
    </form>
  </div>
  <a href="users.php?offset=<?php echo $_GET['offset'] + 6; ?>&search=<?php echo $_GET['search'] ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Next</button></a>
</div>
<?php //i stole half of this code from guestbook.php and i dont care
$offset = (int) $_GET['offset']; //integer :P
$search = $_GET['search'];
$searchParameter = "%$search%"; // why not searchParakilometer??!?
require '/var/www/html/db.php';
if ($offset) {
  if($search) {
    $sql = "SELECT * FROM users WHERE username LIKE ? ORDER BY CHAR_LENGTH(`username`) LIMIT 6 OFFSET ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('si', $searchParameter, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
  } else {
    $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 6 OFFSET ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $offset);
    $stmt->execute();
    $result = $stmt->get_result();
  }
} else {
  if($search) {
    $sql = "SELECT * FROM users WHERE username LIKE ? ORDER BY CHAR_LENGTH(`username`) LIMIT 6";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $searchParameter);
    $stmt->execute();
    $result = $stmt->get_result();
  } else {
    $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 6";
    $result = $mysqli->query($sql);
  }
}

require_once '/var/www/html/api/internalFunctions.php';

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
      echo '<br>';
      echo '<div class="largeApplet" style="display: flex;">';
      echo '<img onerror="this.onerror=null; this.src=\'/files/images/pfps/error.png\'" src="' . getPfpFromUsername($row['username']) . '" class="pfpLarge" alt="profile" style="height: 120px; width: 120px;">';
      echo '<div style="margin-left: 10px; display: flex; flex-direction: column; position: relative;">';
      echo '<div style="display: flex; justify-content: space-between; width: 910px;">';
      echo '<span class="username" style="overflow: visible;">' . htmlspecialchars($row['username']) . '</span>';
      echo '<oblique>#' . htmlspecialchars($row['id']) . '</oblique>';
      echo '</div>';
      echo '<span>' . htmlspecialchars($row['shortbio']) . '</span>';
      echo '<span style="position: absolute; bottom: 0; width: 750px;">' . htmlspecialchars($row['username']) . ' signed up on ' . htmlspecialchars($row['date_created'])  . '</span>';
      echo '</div></div>';
  }
}

?>
</div>
</body>
</html>
