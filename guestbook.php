<?php
session_start();
include_once __DIR__ . "/account/checkAccountIsModerated.php";
$mysqli = require __DIR__ . "/db.php";
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}

// Get the client's IP address
if (array_key_exists('HTTP_CF_CONNECTING_IP', $_SERVER)) {
    // Using Cloudflare
    $clientIP = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else {
    // Not using Cloudflare
    $clientIP = $_SERVER['REMOTE_ADDR'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  require_once __DIR__ . "/applets/createHeadSection.php";
  createHeadSection('The Awesome Guestbook', 'The Awesome Guestbook', 'The awesome guestbook page. Anyone can post anything* here!!! :D (*don\'t be mean though)');
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
<div class="largeApplet" style="margin: auto; text-align: center;">
    <h1>Guestbook</h1>
    This is where anyone can post anything they like.
<br><a href="/msgboard.php">Click here to go to the message board (members only).</a>
</div>
<br>
<div class="appletContainer">
    <a href="guestbook.php?offset=<?php echo $_GET['offset'] + 6; ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Previous</button></a>
    <div class="mediumApplet" style="margin: auto; text-align: center;">
        <form method="POST">
        <h2>Leave a message</h2>
        <label for="username" value="Username:">Username:</label><br>
        <input type="text" name="username" id="username" placeholder="Your username here!"><br>
        <label for="message" value="Message:">Message:</label><br>
        <input type="text" name="message" id="message" placeholder="Your message here!"><br>
        <input type="submit">
        </form>
    </div>
    <a href="guestbook.php?offset=<?php if($_GET['offset'] < 6) { echo '0';} else { echo $_GET['offset'] - 6;} ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Next</button></a>
</div>

<?php
$offset = (int) $_GET['offset']; //integer :P
if ($offset) {
    //fetch teh last 6 messages after teh offset :D
    $sql = "SELECT * FROM guestbook ORDER BY id DESC LIMIT 6 OFFSET ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $offset); // 'i' for integer parameter type
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM guestbook ORDER BY id DESC LIMIT 6";
    $result = $mysqli->query($sql);
}


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<br>';
        echo '<div class="largeApplet" style="display: flex;">';
        echo '<div style="margin-left: 10px; display: flex; flex-direction: column; position: relative;">';
        echo '<div style="display: flex; justify-content: space-between; width: 1040px;">';
        echo '<span class="username" style="overflow: visible;">' . htmlspecialchars($row['username']) . '</span>';
        echo '<oblique>#' . htmlspecialchars($row['id']) . '</oblique>';
        echo '</div>';
        echo '<span>' . htmlspecialchars($row['message']) . '</span>';
        echo '<span style="alignSelf: end;">Sent by ' . htmlspecialchars($row['username']) . ' on ' . htmlspecialchars($row['date'])  . '</span>';
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

    // Check if the client exists in the rate_limits_guestbook table
    $stmt = $mysqli->prepare("SELECT request_count, last_request_time FROM rate_limits_guestbook WHERE client_id = ?");
    $stmt->bind_param("s", $clientIP);
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
        $stmt = $mysqli->prepare("UPDATE rate_limits_guestbook SET request_count = request_count + 1, last_request_time = ? WHERE client_id = ?");
        $stmt->bind_param("is", $currentTime, $clientIP);
        $stmt->execute();
        $stmt->close();
    } else {
        // Insert a new entry
        $stmt = $mysqli->prepare("INSERT INTO rate_limits_guestbook (client_id, request_count, last_request_time) VALUES (?, 1, ?)");
        $stmt->bind_param("si", $clientIP, $currentTime);
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
    if($_POST['username'] == 'admin' || $_POST['username'] == 'administrator') {
        die("<script>alert(\"Please don't try to impersonate staff.\");</script>");
    }
    //teh checks are all done :DDDD time to add your message :PPP
    $sql = "INSERT INTO guestbook (username, message) VALUES (?, ?)";
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($sql);
    if (!$stmt->prepare($sql)) {
        die("SQL Error: " . $mysqli->error);
    }
    $stmt->bind_param("ss", $_POST['username'], $_POST["message"]);
    if ($stmt->execute()) {
        echo '<script>alert("Your message was successfully added!"); window.location.href = "http://mateishome.page/guestbook.php";</script>';
    } else {
        echo '<script>alert("There was an error: ' . $mysqli->error . '");</script>';
    }
}
?>

