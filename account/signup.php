<?php
$mysqli = require_once "/var/www/html/db.php"; // Connects to the database by including the db.php file
session_start(); // Starts a new session or resumes an existing session
if (isset($_SESSION["user_id"])) { // Checks if the 'user_id' is set in the session (meaning the user is logged in)
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}"; // Prepares SQL query to get the username of the logged-in user by their user ID
  $result = $mysqli->query($sql); // Executes the SQL query
  $user = $result->fetch_assoc(); // Fetches the result of the query as an associative array and stores it in $user
}
?>

<!DOCTYPE html> <!-- Declares the document type as HTML5 -->
<html lang="en"> <!-- Sets the language of the page to English -->
<head>
  <meta charset="UTF-8"> <!-- Specifies the character encoding for the document as UTF-8 -->
  <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Sets the favicon for the webpage -->
  <title>Matei's Homepage!</title> <!-- Specifies the title of the webpage -->
  <meta content="a cool website all about me, Matei!" property="og:title" /> <!-- Open Graph meta tag for social media sharing (title) -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" /> <!-- Open Graph meta tag for social media sharing (description) -->
  <meta content="https://mateishome.page" property="og:url" /> <!-- Open Graph meta tag for social media sharing (URL) -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" /> <!-- Open Graph meta tag for social media sharing (image) -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" /> <!-- Specifies the theme color for mobile browsers -->
  <?php include_once __DIR__ . "/../applets/style.php";?> <!-- Includes a PHP file for styles (CSS) -->
</head>
<body>
<script> <!-- Start of a JavaScript block -->
if ( window !== window.parent ) // Checks if the page is inside an iframe (window.parent refers to the top-level window)
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // Redirects to a page if the page is in an iframe
      //window.location.replace("about:inducebrowsercrashforrealz"); // An alternative evil option to crash the browser (commented out)
}
</script> <!-- End of JavaScript block -->

<div class="page"> <!-- Start of the main page container -->
<?php
include_once __DIR__ . "/../applets/navigation_bar.php"; // Includes the navigation bar (HTML or PHP file) into the page
?>
<br> <!-- Adds a line break for spacing -->
    <div class="mediumApplet" style="text-align: center; margin: auto;"> <!-- Start of a div for styling and centering the signup form -->
        <?php if ($_SERVER["REQUEST_METHOD"] === "GET"): ?> <!-- Checks if the request method is GET (i.e., the form has not yet been submitted) -->
            <h1>Sign up</h1> <!-- Displays the heading for the signup form -->
            <form action="signup.php" method="post" id="signup"> <!-- Starts the form for submitting the signup data via POST to 'signup.php' -->
                <label for="username">Username</label><br> <!-- Label for the 'username' input field -->
                <input type="text" id="username" name="username" required><br> <!-- Text input for the username (required field) -->
                <label for="email">Email (optional)</label><br> <!-- Label for the 'email' input field -->
                <input type="email" id="email" name="email"><br> <!-- Email input for the email (optional) -->
                <label for="password">Password</label><br> <!-- Label for the 'password' input field -->
                <input type="password" id="password" name="password" required><br> <!-- Password input for the password (required field) -->
                <label for="cpassword">Confirm Password</label><br> <!-- Label for the 'confirm password' input field -->
                <input type="password" id="cpassword" name="cpassword" required><br> <!-- Password input for confirming the password (required field) -->
                <input type="submit" value="Sign up"> <!-- Submit button to submit the form -->
            </form> <!-- End of the signup form -->
            Powered by <img src="/files/images/stopforumspam.png" height="20px;" style="vertical-align: middle;" alt="Stop Forum Spam">. <!-- Footer with an image and a message -->
        <?php endif; ?> <!-- End of the condition that checks if the request method was GET -->
        <?php

// Rate limit section

// Rate limiting parameters
$rateLimit = 10; // Maximum requests allowed per minute
$rateLimitDuration = 60; // Duration in seconds (60 seconds = 1 minute)

// Get the client's IP address
if (array_key_exists('HTTP_CF_CONNECTING_IP', $_SERVER)) { // Checks if the 'HTTP_CF_CONNECTING_IP' header is set (this is a Cloudflare header for the real IP)
    $clientIP = $_SERVER['HTTP_CF_CONNECTING_IP']; // Sets the client IP to the value from Cloudflare
} else { // If Cloudflare is not used, fallback to the general REMOTE_ADDR header
    $clientIP = $_SERVER['REMOTE_ADDR']; // Sets the client IP to the REMOTE_ADDR (the default IP header)
}

$mysqli = require "/var/www/html/db.php"; // Re-initializes the database connection (the same as at the top of the file)

// Check if the client exists in the rate_limits table
$stmt = $mysqli->prepare("SELECT request_count, last_request_time FROM rate_limits WHERE client_id = ?"); // Prepares the SQL query to fetch the request count and last request time for this client
$stmt->bind_param("s", $clientIP); // Binds the client IP as a parameter to the prepared statement
$stmt->execute(); // Executes the query
$stmt->bind_result($requestCount, $lastRequestTime); // Binds the results of the query to variables ($requestCount and $lastRequestTime)
$stmt->fetch(); // Fetches the result from the executed query
$stmt->close(); // Closes the prepared statement

// Get the current timestamp
$currentTime = time(); // Retrieves the current timestamp (in seconds since January 1, 1970)

// Check if the client has exceeded the rate limit
if ($requestCount >= $rateLimit && $currentTime - $lastRequestTime < $rateLimitDuration) { // If the client has made more requests than allowed in the set time period
    http_response_code(429); // Sends an HTTP 429 status code (Too Many Requests)
    echo 'Too many requests in the specified time. If you are an organisation and would like to request a higher ratelimit, please contact matei@mateishome.page.'; // Displays a message to the user about the rate limit
    exit; // Stops further script execution
}
// Get the client's IP address (again, as it is needed for the subsequent checks)
if (array_key_exists('HTTP_CF_CONNECTING_IP', $_SERVER)) { // Checks if the 'HTTP_CF_CONNECTING_IP' header is set (Cloudflare)
    $clientIP = $_SERVER['HTTP_CF_CONNECTING_IP']; // Sets the client IP to the value from Cloudflare
} else { // Fallback to REMOTE_ADDR if Cloudflare is not used
    $clientIP = $_SERVER['REMOTE_ADDR']; // Sets the client IP to the REMOTE_ADDR
}

function isPasswordValid($password, $confirmationpassword) { // A function to validate the password and its confirmation
    if ($password != $confirmationpassword) { // Checks if the password and confirmation password match
        return "the passwords do not match."; // Returns an error message if passwords don't match
    }
    $commonpasswords = explode("\n", file_get_contents('/var/www/html/files/txt/passlist.txt')); // Loads common passwords from a file and splits them into an array
    foreach ($commonpasswords as $check) { // Loops through each common password
        if ($password == $check) { // Checks if the current password is in the list of common passwords
            return "the password is an extremely common password. If you use this password on any websites, please change it."; // Returns a warning if the password is common
        }
    }
    if (strlen($password) < 8) { // Checks if the password is shorter than 8 characters
        return "the password must be 8 characters or more."; // Returns an error if the password is too short
    }
    return 200; // Returns a success code (200) if the password is valid
}

function isUsernameValid($username) { // A function to validate the username
    if(!ctype_alnum($username)) { // Checks if the username is not alphanumeric (contains only letters and numbers)
        return "the username can only have alphanumeric characters (standard English letters and numbers, no spaces or punctuation)."; // Returns an error if the username is invalid
    }
    if(strlen($username) > 25) { // Checks if the username is longer than 25 characters
        return "the username cannot have more than 50 characters."; // Returns an error if the username is too long
    }
    require '/var/www/html/db.php'; // Includes the database connection (for the second time in this function)

    $sql = 'SELECT id FROM users WHERE username = ?'; // SQL query to check if the username is already taken
    $stmt = $mysqli->prepare($sql); // Prepares the SQL query
    $stmt->bind_param('s', $username); // Binds the username parameter to the prepared statement
    $stmt->execute(); // Executes the query
    $check = $stmt->get_result(); // Gets the result of the executed query
    
    if($check->num_rows) { // If a row is returned, the username is taken
        return "the username is taken."; // Returns an error if the username is already in use
    }

    return 200; // Returns a success code (200) if the username is valid
}

function isIpValid($ip) { // A function to validate the client's IP address
    $result = file_get_contents('https://api.stopforumspam.org/api?ip=' . $ip); // Makes a request to the stopforumspam API to check if the IP is flagged as a spammer
    if(strpos($result, '<appears>yes</appears>') !== false) { // Checks if the response contains "appears" as "yes"
        return "the IP address is a known spam source. Stop spamming my website! >:("; // Returns a warning if the IP is flagged
    }
    return 200; // Returns a success code (200) if the IP is valid
}

if ($_SERVER["REQUEST_METHOD"] === "POST") { // Checks if the form has been submitted (POST request)
    echo '<h1>Processing your sign up...</h1>'; // Displays a processing message
    $isPasswordValid = isPasswordValid($_POST['password'], $_POST['cpassword']); // Validates the password and confirmation password
    $isUsernameValid = isUsernameValid($_POST['username']); // Validates the username
    $isIpValid = isIpValid($clientIP); // Validates the IP address
    
    if ($isPasswordValid === 200 && $isUsernameValid === 200 && $isIpValid === 200) { // Checks if all validations passed
        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hashes the password for secure storage
        require '/var/www/html/db.php'; // Includes the database connection

        $sql = "INSERT INTO users (username, hashed_password, email) VALUES (?, ?, ?)"; // SQL query to insert the new user into the database
        $stmt = $mysqli->prepare($sql); // Prepares the SQL query
        
        if (!$stmt) { // Checks if the prepared statement failed
            die('An error occurred while trying to sign up and it\'s my fault: ' . $mysqli->error); // Displays an error message
        }
        
        $stmt->bind_param("sss", $_POST["username"], $password_hash, $_POST["email"]); // Binds the username, password hash, and email as parameters
        
        if ($stmt->execute()) { // Executes the SQL query to insert the new user
