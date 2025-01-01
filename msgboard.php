<?php
$mysqli = require __DIR__ . "/db.php";
session_start();
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}

session_start();
$mysqli = require __DIR__ . "/db.php";

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
  <?php include_once __DIR__ . "/applets/style.php";?></head>
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
<div class="largeApplet" style="margin: auto; text-align: center;">
    <h1>Message Board</h1>
    This is where website members can post anything they like.
    <?php
    if($user) {
        echo 'You can post here too, ' . $user['username'] . '!';
    } else {
        echo 'You can post here too by <a href="/signup.php">signing up!</a>';
    }
    ?>
<br><a href="/guestbook.php">Click here to go to the guestbook.</a>
</div>
<?php if($user): ?>
<br>
<div class="appletContainer">
    <a href="msgboard.php?offset=<?php echo $_GET['offset'] + 6; ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Previous</button></a>
    <div class="mediumApplet" style="margin: auto; text-align: center;">
        <form method="POST">
        <h2>Leave a message</h2>
        <input type="text" name="message" id="message" placeholder="Your message here!">
        <input type="submit">
        </form>
    </div>
    <a href="msgboard.php?offset=<?php if($_GET['offset'] < 6) { echo '0';} else { echo $_GET['offset'] - 6;} ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Next</button></a>
</div>
<?php else: ?>
<br>
<div class="appletContainer">
<a href="msgboard.php?offset=<?php echo $_GET['offset'] + 6; ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Previous</button></a>
<a href="msgboard.php?offset=<?php if($_GET['offset'] < 6) { echo '0';} else { echo $_GET['offset'] - 6;} ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Next</button></a>
</div>
<?php endif; ?>

<?php
$offset = (int) $_GET['offset']; //integer :P
if ($offset) {
    //fetch teh last 6 messages after teh offset :D
    $sql = "SELECT * FROM msgboard ORDER BY id DESC LIMIT 6 OFFSET ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $offset); // 'i' for integer parameter type
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM msgboard ORDER BY id DESC LIMIT 6";
    $result = $mysqli->query($sql);
}

require_once '/var/www/html/api/internalFunctions.php';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<br>';
        echo '<div class="largeApplet" style="display: flex;">';
        echo '<img onerror="this.onerror=null; this.src=\'/files/images/pfps/error.png\'" src="' . getPfpFromUsername($row['username']) . '" class="pfpLarge" alt="profile" style="height: 120px; width: 120px;">';
        echo '<div style="margin-left: 10px; display: flex; flex-direction: column; position: relative;">';
        echo '<div style="display: flex; justify-content: space-between; width: 910px;">';
        echo '<span class="username" style="overflow: visible;">' . htmlspecialchars($row['username']). '</span>';
        echo '<oblique>#' . htmlspecialchars($row['id']) . '</oblique>';
        echo '</div>';
        echo '<span>' . htmlspecialchars($row['message']) . '</span>';
        echo '<span style="position: absolute; bottom: 0; width: 750px;">Sent by ' . htmlspecialchars($row['username']) . ' on ' . htmlspecialchars($row['date'])  . '</span>';
        echo '</div></div>';
    }
}
?>
<br>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //////////////
    //rate limit//
    //////////////
    // Rate limiting parameters
    $rateLimit = 1; // Maximum requests per duration
    $rateLimitDuration = 15; // Duration in seconds

    // Connect to the MySQL database
    $mysqli = require __DIR__ . "/db.php";

    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $user = $user['username'];
    } else {
        // Handle the case where the user is not found in the database
        echo '<script>alert("Please log in to add a message.");</script>';
        exit;
    }

    $stmt->close();

    // Check if the client exists in the rate_limits_msgboard table
    $stmt = $mysqli->prepare("SELECT request_count, last_request_time FROM rate_limits_msgboard WHERE client_id = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->bind_result($requestCount, $lastRequestTime);
    $stmt->fetch();
    $stmt->close();

    // Get the current timestamp
    $currentTime = time();

    // Check if the client has exceeded the rate limit
    if ($requestCount >= $rateLimit && $currentTime - $lastRequestTime < $rateLimitDuration) {
        // Rate limit exceeded
        http_response_code(429);
        echo '<script>alert("Please wait before sending another message.");</script>';
        exit;
    }

    // Update or insert the client entry
    if ($requestCount > 0) {
        // Update the existing entry
        $stmt = $mysqli->prepare("UPDATE rate_limits_msgboard SET request_count = request_count + 1, last_request_time = ? WHERE client_id = ?");
        $stmt->bind_param("is", $currentTime, $user);
        $stmt->execute();
        $stmt->close();
    } else {
        // Insert a new entry
        $stmt = $mysqli->prepare("INSERT INTO rate_limits_msgboard (client_id, request_count, last_request_time) VALUES (?, 1, ?)");
        $stmt->bind_param("si", $user, $currentTime);
        $stmt->execute();
        $stmt->close();
    }

    //////////////////
    //not rate limit//
    //////////////////
    if (empty($_POST['message'])) {
        die("<script>alert(\"Please don't try to leave empty messages.\");</script>");
    }
    if (rand(1,10000) == 2893) {
        die("<script>alert(\"Hello! I am an alert box!! (your message wasnt added because i rolled a 10,000 sided dice and it landed on 2893, try again)\");</script>");
        //have a random chance of not working for some reason
    }
    if(strlen($_POST['message']) > 500) {
        die("<script>alert(\"Sorry, your message can be no longer than 500 characters.\");</script>");
    }
    if(!isset($_SESSION['user_id'])) {
        die("<script>alert(\"You must log in before adding a message.\");</script>"); //i shouldnt have to tell you that
    }
    //teh checks are all done :DDDD time to add your message :PPP
    $sql = "INSERT INTO msgboard (username, message) VALUES (?, ?)";
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($sql);
    if (!$stmt->prepare($sql)) {
        die("SQL Error: " . $mysqli->error);
    }
    $stmt->bind_param("ss", $user, $_POST["message"]);
    if ($stmt->execute()) {
        echo '<script>alert("Your message was successfully added!"); window.location.href = "http://mateishome.page/msgboard.php";</script>';
    } else {
        echo '<script>alert("There was an error: ' . $mysqli->error . '");</script>';
    }
}
?>

