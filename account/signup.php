<?php
$mysqli = require_once "/var/www/html/db.php";
session_start();
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}
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
    <div class="mediumApplet" style="text-align: center; margin: auto;">
        <?php if ($_SERVER["REQUEST_METHOD"] === "GET"): ?>
            <h1>Sign up</h1>
            <form action="signup.php" method="post" id="signup">
                <label for="username">Username</label><br>
                <input type="text" id="username" name="username" required><br>
                <label for="email">Email (optional)</label><br>
                <input type="email" id="email" name="email"><br>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br>
                <label for="cpassword">Confirm Password</label><br>
                <input type="password" id="cpassword" name="cpassword" required><br>
                <input type="submit" value="Sign up">
            </form>
            Powered by <img src="/files/images/stopforumspam.png" height="20px;" style="vertical-align: middle;" alt="Stop Forum Spam">.
        <?php endif; ?>
        <?php

//rate limit

// Rate limiting parameters
$rateLimit = 10; // Maximum requests per minute
$rateLimitDuration = 60; // Duration in seconds

// Get the client's IP address
if (array_key_exists('HTTP_CF_CONNECTING_IP', $_SERVER)) {
    // Using Cloudflare
    $clientIP = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else {
    // Not using Cloudflare
    $clientIP = $_SERVER['REMOTE_ADDR'];
}

$mysqli = require "/var/www/html/db.php";

// Check if the client exists in the rate_limits table
$stmt = $mysqli->prepare("SELECT request_count, last_request_time FROM rate_limits WHERE client_id = ?");
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
    echo 'Too many requests in the specified time. If you are an organisation and would like to request a higher ratelimit, please contact matei@mateishome.page.';
    exit;
}
// Get the client's IP address
if (array_key_exists('HTTP_CF_CONNECTING_IP', $_SERVER)) {
    // Using Cloudflare
    $clientIP = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else {
    // Not using Cloudflare
    $clientIP = $_SERVER['REMOTE_ADDR'];
}
function isPasswordValid($password, $confirmationpassword) { //runs check to see if the password is valid
    if ($password != $confirmationpassword) {
        return "the passwords do not match.";
    }
    $commonpasswords = explode("\n", file_get_contents('/var/www/html/files/txt/passlist.txt'));
    foreach ($commonpasswords as $check) {
        if ($password == $check) {
            return "the password is an extremely common password. If you use this password on any websites, please change it.";
        }
    }
    if (strlen($password) < 8) {
        return "the password must be 8 characters or more.";
    }
    return 200; //sorry im just used to http response codes
}
function isUsernameValid($username) {
    if(!ctype_alnum($username)) {
        return "the username can only have alphanumeric characters (standard English letters and numbers, no spaces or punctuation).";
    }
    if(strlen($username) > 25) {
        return "the username cannot have more than 50 characters.";
    }
    require '/var/www/html/db.php'; //require_once fails for some reason? i have no idea why, please make pr if you know

    $sql = 'SELECT id FROM users WHERE username = ?'; //see if the username is taken
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $check = $stmt->get_result();
    
    if($check->num_rows) {
        return "the username is taken.";
    }

    return 200; //all is swell!
}
function isIpValid($ip) {
    $result = file_get_contents('https://api.stopforumspam.org/api?ip=' . $ip);
    if(strpos($result, '<appears>yes</appears>') !== false) { //same as if(str_contains($ip, '<appears>yes</appears>')) except i dont have php 8
        return "the IP address is a known spam source. Stop spamming my website! >:(";
    }
    return 200; //all is swell!
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo '<h1>Processing your sign up...</h1>';
    $isPasswordValid = isPasswordValid($_POST['password'], $_POST['cpassword']);
    $isUsernameValid = isUsernameValid($_POST['username']);
    $isIpValid = isIpValid($clientIP);
    
    if ($isPasswordValid === 200 && $isUsernameValid === 200 && $isIpValid === 200) {
        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT); //securidad
        require '/var/www/html/db.php'; //require_once fails for some reason? i have no idea why, please make pr if you know
        
        $sql = "INSERT INTO users (username, hashed_password, email) VALUES (?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        
        if (!$stmt) {
            die('An error occurred while trying to sign up and it\'s my fault: ' . $mysqli->error);
        }
        
        $stmt->bind_param("sss", $_POST["username"], $password_hash, $_POST["email"]);
        
        if ($stmt->execute()) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
            $sql = "UPDATE users SET first_ip = ? WHERE username = ?";  //prepare statement
            $stmt = $mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('ss', $ip, $_POST["username"]); //bind paramaters ready to be executed
            $stmt->execute();
            echo 'Congregations! You have successfully signed up for MateisHomePage. Please login with your specified password to access your account.';
        } else {
            die('An error occurred while trying to sign up and it\'s probably my fault: ' . $mysqli->error . ' <a href=""><strong>Click here to retry.</strong></a>');
        }
    } else {
        if ($isUsernameValid !== 200) {
            $error = $isUsernameValid;
        } elseif ($isPasswordValid !== 200) {
            $error = $isPasswordValid;
        } elseif ($isIpValid !== 200) {
            $error = $isIpValid;
        } else {
            $error = "an unknown error occurred.";
        }
        echo 'An error occurred while trying to sign up and it\'s probably your fault: ' . $error . ' <a href=""><strong>Click here to retry.</strong></a>';
    }
}
?>
    </div>
</div>
</body>
</html>
