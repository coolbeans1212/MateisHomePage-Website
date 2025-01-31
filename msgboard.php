<?php
$mysqli = require __DIR__ . "/db.php";  // This line includes the database connection by requiring the db.php file. The result is assigned to the $mysqli variable.
session_start();  // Starts the session. This is necessary to access session variables like $_SESSION.
if (isset($_SESSION["user_id"])) {  // Checks if a session variable "user_id" exists (i.e., the user is logged in).
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";  // Queries the database for the username of the user with the ID stored in the session.
  $result = $mysqli->query($sql);  // Executes the query to get the user data.
  $user = $result->fetch_assoc();  // Fetches the result as an associative array and stores it in $user.
}

session_start();  // Starts another session (duplicated; this might be unnecessary).
$mysqli = require __DIR__ . "/db.php";  // Reconnects to the database. It's redundant since it's already done earlier.

?>

<!DOCTYPE html>  <!-- Declares the document type and starts the HTML document -->
<html lang="en">  <!-- Specifies the language of the page as English -->
<head>  <!-- Starts the head section of the HTML document -->
  <meta charset="UTF-8">  <!-- Sets the character encoding for the document to UTF-8 -->
  <link rel="icon" href="favicon.ico" type="image/x-icon">  <!-- Specifies the website's favicon (the small icon in the browser tab) -->
  <title>Matei's Homepage!</title>  <!-- Sets the title of the page (shown in the browser tab) -->
  <meta content="a cool website all about me, Matei!" property="og:title" />  <!-- Specifies the title for social media sharing (Open Graph metadata) -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" />  <!-- Description for social media sharing (Open Graph metadata) -->
  <meta content="https://mateishome.page" property="og:url" />  <!-- URL for the website (Open Graph metadata) -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" />  <!-- Image used for social media sharing (Open Graph metadata) -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" />  <!-- Sets the theme color of the browser bar (used on mobile browsers) -->
  <?php include_once __DIR__ . "/applets/style.php";?>  <!-- Includes an external PHP file to apply styles -->
</head>
<body>  <!-- Starts the body section of the HTML document -->

<script>  <!-- Starts the script block -->
if ( window !== window.parent )  <!-- Checks if the page is inside an iframe (if the window's parent is not the window itself) -->
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html");  // Redirects to another page if it's inside an iframe
      //window.location.replace("about:inducebrowsercrashforrealz"); // This is a commented-out line that could cause a browser crash (just an evil idea)
}
</script>  <!-- Ends the script block -->

<div class="page">  <!-- Creates a div element with a class of "page" -->
<?php
include_once __DIR__ . "/applets/navigation_bar.php"; // Includes the navigation bar from an external PHP file
?>
<br>
<div class="largeApplet" style="margin: auto; text-align: center;">  <!-- A div with styling to center the content and align text in the center -->
    <h1>Message Board</h1>  <!-- Heading for the message board -->
    This is where website members can post anything they like.  <!-- Description of the message board -->
    <?php
    if($user) {  // If the user is logged in (the $user variable is set)
        echo 'You can post here too, ' . $user['username'] . '!';  // Displays a personalized message including the user's username
    } else {  // If the user is not logged in
        echo 'You can post here too by <a href="/signup.php">signing up!</a>';  // Prompts the user to sign up if they are not logged in
    }
    ?>
<br><a href="/guestbook.php">Click here to go to the guestbook.</a>  <!-- Link to the guestbook page -->
</div>

<?php if($user): ?>  <!-- If the user is logged in -->
<br>
<div class="appletContainer">  <!-- Creates a container for the applet -->
    <a href="msgboard.php?offset=<?php echo $_GET['offset'] + 6; ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Previous</button></a>  <!-- Button to go to the previous page of messages -->
    <div class="mediumApplet" style="margin: auto; text-align: center;">  <!-- Centered content for the form -->
        <form method="POST">  <!-- Starts a form that submits via POST method -->
        <h2>Leave a message</h2>  <!-- Heading for the message input form -->
        <input type="text" name="message" id="message" placeholder="Your message here!">  <!-- Input field for the message -->
        <input type="submit">  <!-- Submit button for the form -->
        </form>
    </div>
    <a href="msgboard.php?offset=<?php if($_GET['offset'] < 6) { echo '0';} else { echo $_GET['offset'] - 6;} ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Next</button></a>  <!-- Button to go to the next page of messages -->
</div>
<?php else: ?>  <!-- If the user is not logged in -->
<br>
<div class="appletContainer">  <!-- Creates a container for the applet -->
<a href="msgboard.php?offset=<?php echo $_GET['offset'] + 6; ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Previous</button></a>  <!-- Button to go to the previous page of messages -->
<a href="msgboard.php?offset=<?php if($_GET['offset'] < 6) { echo '0';} else { echo $_GET['offset'] - 6;} ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Next</button></a>  <!-- Button to go to the next page of messages -->
</div>
<?php endif; ?>  <!-- End of the if statement for checking if the user is logged in -->

<?php
$offset = (int) $_GET['offset'];  // Converts the "offset" URL parameter to an integer
if ($offset) {  // If the offset is set (indicating that the user is viewing a specific page of messages)
    // Fetches the last 6 messages after the offset
    $sql = "SELECT * FROM msgboard ORDER BY id DESC LIMIT 6 OFFSET ?";  // Prepares an SQL query to get 6 messages starting at the offset
    $stmt = $mysqli->prepare($sql);  // Prepares the SQL statement
    $stmt->bind_param('i', $offset);  // Binds the offset parameter as an integer
    $stmt->execute();  // Executes the query
    $result = $stmt->get_result();  // Gets the result of the query
} else {  // If there is no offset (the user is viewing the first page of messages)
    $sql = "SELECT * FROM msgboard ORDER BY id DESC LIMIT 6";  // Fetches the first 6 messages
    $result = $mysqli->query($sql);  // Executes the query
}

require_once '/var/www/html/api/internalFunctions.php';  // Includes an external PHP file with functions

if (mysqli_num_rows($result) > 0) {  // If there are messages in the result
    while ($row = mysqli_fetch_assoc($result)) {  // Loops through each message in the result
        echo '<br>';  // Line break for each message
        echo '<div class="largeApplet" style="display: flex;">';  // Creates a container with a flex display for each message
        echo '<img onerror="this.onerror=null; this.src=\'/files/images/pfps/error.png\'" src="' . getPfpFromUsername($row['username']) . '" class="pfpLarge" alt="profile" style="height: 120px; width: 120px;">';  // Displays the user's profile picture (fallback to error image if not found)
        echo '<div style="margin-left: 10px; display: flex; flex-direction: column; position: relative;">';  // Creates a container for the message text and user info
        echo '<div style="display: flex; justify-content: space-between; width: 910px;">';  // Creates a flex container for the username and message ID
        echo '<span class="username" style="overflow: visible;">' . htmlspecialchars($row['username']). '</span>';  // Displays the username with HTML escaping
        echo '<oblique>#' . htmlspecialchars($row['id']) . '</oblique>';  // Displays the message ID with HTML escaping
        echo '</div>';
        echo '<span>' . htmlspecialchars($row['message']) . '</span>';  // Displays the message with HTML escaping
        echo '<span style="position: absolute; bottom: 0; width: 750px;">Sent by ' . htmlspecialchars($row['username']) . ' on ' . htmlspecialchars($row['date'])  . '</span>';  // Displays the date the message was sent
        echo '</div></div>';
    }
}
?>
<br>
</body>
</html>  <!-- Ends the HTML document -->

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // If the form was submitted via POST
    //////////////
    // Rate limit//
    //////////////
    $rateLimit = 1;  // The maximum number of requests a user can make within the specified duration
    $rateLimitDuration = 15;  // The rate limit duration in seconds (15 seconds)

    // Connect to the database again (redundant, since it's already connected earlier)
    $mysqli = require __DIR__ . "/db.php";

    // SQL to fetch the username of the logged-in user
    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = $mysqli->prepare($sql);  // Prepares the SQL query
    $stmt->bind_param("i", $_SESSION["user_id"]);  // Binds the user ID parameter
    $stmt->execute();  // Executes the query
    $result = $stmt->get_result();  // Gets the result of the query

    if ($result->num_rows > 0) {  // If the user is found in the database
        $user = $result->fetch_assoc();  // Fetch the user details
        $user = $user['username'];  // Store the username in the $user variable
    } else {  // If the user is not found
        echo '<script>alert("Please log in to add a message.");</script>';  // Display an alert
        exit;  // Exit the script
    }

    $stmt->close();  // Close the prepared statement

    // Check if the user has exceeded the rate limit
    $stmt = $mysqli->prepare("SELECT request_count, last_request_time FROM rate_limits_msgboard WHERE client_id = ?");
    $stmt->bind_param("s", $user);  // Bind the username as a string parameter
    $stmt->execute();  // Execute the query
    $stmt->bind_result($requestCount, $lastRequestTime);  // Bind the result variables
    $stmt->fetch();  // Fetch the result of the query
    $stmt->close();  // Close the prepared statement

    // Get the current time
    $currentTime = time();

    // Check if the user has exceeded the rate limit
    if ($requestCount >= $rateLimit && $currentTime - $lastRequestTime < $rateLimitDuration) {
        // If the rate limit has been exceeded, send a 429 status code (too many requests)
        http_response_code(429);
        echo '<script>alert("Please wait before sending another message.");</script>';  // Display an alert
        exit;  // Exit the script
    }

    // Update or insert the rate limit entry
    if ($requestCount > 0) {  // If the user has made a previous request
        $stmt = $mysqli->prepare("UPDATE rate_limits_msgboard SET request_count = request_count + 1, last_request_time = ? WHERE client_id = ?");
        $stmt->bind_param("is", $currentTime, $user);  // Bind the current time and user
        $stmt->execute();  // Execute the update query
        $stmt->close();  // Close the prepared statement
    } else {  // If this is the user's first request
        $stmt = $mysqli->prepare("INSERT INTO rate_limits_msgboard (client_id, request_count, last_request_time) VALUES (?, 1, ?)");
        $stmt->bind_param("si", $user, $currentTime);  // Bind the parameters
        $stmt->execute();  // Execute the insert query
        $stmt->close();  // Close the prepared statement
    }

    //////////////////
    // Not rate limit//
    //////////////////

    if (empty($_POST['message'])) {  // If the message is empty
        die("<script>alert(\"Please don't try to leave empty messages.\");</script>");  // Display an alert and exit
    }
    if (rand(1,10000) == 2893) {  // Random chance to simulate an error
        die("<script>alert(\"Hello! I am an alert box!! (your message wasnt added because i rolled a 10,000 sided dice and it landed on 2893, try again)\");</script>");  // Display an alert with a random chance failure message
    }
    if(strlen($_POST['message']) > 500) {  // If the message is longer than 500 characters
        die("<script>alert(\"Sorry, your message can be no longer than 500 characters.\");</script>");  // Display an alert and exit
    }
    if(!isset($_SESSION['user_id'])) {  // If the user is not logged in
        die("<script>alert(\"You must log in before adding a message.\");</script>");  // Display an alert and exit
    }

    // Time to add the message to the database if all checks pass
    $sql = "INSERT INTO msgboard (username, message) VALUES (?, ?)";  // SQL query to insert the message
    $stmt = $mysqli->stmt_init();  // Initialize the statement
    $stmt->prepare($sql);  // Prepare the SQL query
    if (!$stmt->prepare($sql)) {  // If the query preparation fails
        die("SQL Error: " . $mysqli->error);  // Display an error message
    }
    $stmt->bind_param("ss", $user, $_POST["message"]);  // Bind the username and message parameters
    if ($stmt->execute()) {  // If the message is successfully inserted
        echo '<script>alert("Your message was successfully added!"); window.location.href = "http://mateishome.page/msgboard.php";</script>';  // Display a success message and reload the message board page
    } else {  // If the query execution fails
        echo '<script>alert("There was an error: ' . $mysqli->error . '");</script>';  // Display an error message
    }
}
?>
