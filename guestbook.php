<?php // This starts a PHP block, indicating that the following code will be written in PHP
$mysqli = require __DIR__ . "/db.php"; // Includes and executes the 'db.php' file, which likely connects to a MySQL database, and assigns the connection to the $mysqli variable
session_start(); // Starts a new session or resumes the current session based on a session identifier passed via a request (cookie or URL)
if (isset($_SESSION["user_id"])) { // Checks if a "user_id" is set in the session, indicating a logged-in user
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}"; // Creates a SQL query to fetch the username of the logged-in user based on the user_id in the session
  $result = $mysqli->query($sql); // Executes the SQL query on the database connection and stores the result
  $user = $result->fetch_assoc(); // Fetches the result as an associative array, where the 'username' is stored in the $user variable
}

session_start(); // Starts a new session or resumes the current session again (this line might be redundant, as session_start() has already been called earlier)
$mysqli = require __DIR__ . "/db.php"; // Re-assigns the database connection to $mysqli again by requiring the 'db.php' file (again, redundant here)


// Get the client's IP address
if (array_key_exists('HTTP_CF_CONNECTING_IP', $_SERVER)) { // Checks if 'HTTP_CF_CONNECTING_IP' is present in the $_SERVER array (this is Cloudflare’s forwarded IP header)
    // Using Cloudflare
    $clientIP = $_SERVER['HTTP_CF_CONNECTING_IP']; // If Cloudflare is used, get the client's real IP from the header
} else { // If Cloudflare is not used, proceed with the else block
    // Not using Cloudflare
    $clientIP = $_SERVER['REMOTE_ADDR']; // Otherwise, get the client's IP from the standard 'REMOTE_ADDR' server variable
}

?>

<!DOCTYPE html> <!-- Defines the document type, which is HTML5 here -->
<html lang="en"> <!-- Opens the HTML document with the language attribute set to English (en) -->
<head> <!-- The head element contains metadata and other resources for the webpage -->
  <meta charset="UTF-8"> <!-- Specifies that the character encoding for the webpage is UTF-8 -->
  <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Sets the favicon (small icon shown on the browser tab) for the website -->
  <title>Matei's Homepage!</title> <!-- Sets the title of the webpage, which appears in the browser tab -->
  <meta content="a cool website all about me, Matei!" property="og:title" /> <!-- Open Graph meta tag to define the title of the page when shared on social media -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" /> <!-- Open Graph meta tag for a description of the page for social media -->
  <meta content="https://mateishome.page" property="og:url" /> <!-- Open Graph meta tag for the URL of the page when shared -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" /> <!-- Open Graph meta tag for the image that represents the page when shared -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" /> <!-- Defines the theme color of the page for mobile browsers (affects the status bar color) -->
  <?php include_once __DIR__ . "/applets/style.php";?> <!-- Includes the 'style.php' file once, likely to inject CSS styles into the page -->
</head>
<body> <!-- Starts the body of the webpage, where visible content is placed -->
<script> <!-- Opens a JavaScript block -->
if ( window !== window.parent ) // Checks if the current window is inside an iframe (by comparing the window object with the parent window object)
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // If the page is in an iframe, redirects to a special page
      //window.location.replace("about:inducebrowsercrashforrealz"); // Commented out line; this would crash the browser if it were active
}
</script> <!-- Closes the JavaScript block -->
<div class="page"> <!-- Starts a div with the class "page", used to group the content inside the webpage -->
<?php
include_once __DIR__ . "/applets/navigation_bar.php"; // Includes the 'navigation_bar.php' file, likely for the navigation menu of the website
?>
<br> <!-- Adds a line break (new line) -->
<div class="largeApplet" style="margin: auto; text-align: center;"> <!-- Defines a div with the class "largeApplet" and centers it horizontally and text content -->
    <h1>Guestbook</h1> <!-- Displays a large header with the text "Guestbook" -->
    This is where anyone can post anything they like. <!-- Describes the purpose of the guestbook -->
<br> <!-- Adds another line break -->
<a href="/msgboard.php">Click here to go to the message board (members only).</a> <!-- Creates a hyperlink to the "msgboard.php" page -->
</div>
<br> <!-- Another line break -->
<div class="appletContainer"> <!-- Defines a container for other elements with the class "appletContainer" -->
    <a href="guestbook.php?offset=<?php echo $_GET['offset'] + 6; ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Previous</button></a> <!-- Creates a link to the previous page in the guestbook, incrementing the offset by 6 for pagination -->
    <div class="mediumApplet" style="margin: auto; text-align: center;"> <!-- Defines a medium-sized applet and centers its content -->
        <form method="POST"> <!-- Starts a form that will send data using the POST method -->
        <h2>Leave a message</h2> <!-- Displays a smaller header prompting the user to leave a message -->
        <label for="username" value="Username:">Username:</label><br> <!-- Creates a label for the "username" input field -->
        <input type="text" name="username" id="username" placeholder="Your username here!"><br> <!-- Creates a text input field for the username, with a placeholder text -->
        <label for="message" value="Message:">Message:</label><br> <!-- Creates a label for the "message" input field -->
        <input type="text" name="message" id="message" placeholder="Your message here!"><br> <!-- Creates a text input field for the message, with a placeholder text -->
        <input type="submit"> <!-- Creates a submit button to send the form data -->
        </form> <!-- Closes the form -->
    </div>
    <a href="guestbook.php?offset=<?php if($_GET['offset'] < 6) { echo '0';} else { echo $_GET['offset'] - 6;} ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Next</button></a> <!-- Creates a link to the next page in the guestbook, decreasing the offset by 6 for pagination -->
</div>

<?php
$offset = (int) $_GET['offset']; // Converts the "offset" value from the URL query string to an integer and stores it in $offset
if ($offset) { // If there is an offset, meaning the user has navigated beyond the first set of messages
    //fetch teh last 6 messages after teh offset :D
    $sql = "SELECT * FROM guestbook ORDER BY id DESC LIMIT 6 OFFSET ?"; // Prepares a SQL query to fetch the next 6 messages starting from the given offset
    $stmt = $mysqli->prepare($sql); // Prepares the SQL statement for execution
    $stmt->bind_param('i', $offset); // Binds the integer parameter ($offset) to the SQL query
    $stmt->execute(); // Executes the prepared statement
    $result = $stmt->get_result(); // Gets the result of the query execution
} else { // If there is no offset (i.e., the user is on the first page)
    $sql = "SELECT * FROM guestbook ORDER BY id DESC LIMIT 6"; // Prepares a SQL query to fetch the first 6 messages
    $result = $mysqli->query($sql); // Executes the query and stores the result
}


if (mysqli_num_rows($result) > 0) { // If there are any messages in the result (i.e., the query returned rows)
    while ($row = mysqli_fetch_assoc($result)) { // Loops through each message in the result set and stores it as an associative array ($row)
        echo '<br>'; // Adds a line break
        echo '<div class="largeApplet" style="display: flex;">'; // Starts a div for each message, using flexbox for layout
        echo '<div style="margin-left: 10px; display: flex; flex-direction: column; position: relative;">'; // Creates a column layout inside the message div
        echo '<div style="display: flex; justify-content: space-between; width: 1040px;">'; // Creates a flex container to position the username and message ID at opposite ends
        echo '<span class="username" style="overflow: visible;">' . htmlspecialchars($row['username']) . '</span>'; // Displays the username of the message sender, using htmlspecialchars to prevent XSS attacks
        echo '<oblique>#' . htmlspecialchars($row['id']) . '</oblique>'; // Displays the message ID in an oblique (italicized) style
        echo '</div>'; // Closes the flex container
        echo '<span>' . htmlspecialchars($row['message']) . '</span>'; // Displays the message itself
        echo '<span style="alignSelf: end;">Sent by ' . htmlspecialchars($row['username']) . ' on ' . htmlspecialchars($row['date'])  . '</span>'; // Displays the sender's username and the date the message was sent
        echo '</div></div>'; // Closes the inner divs for layout
    }
}
?>
<br> <!-- Adds a line break -->
</body>
</html> <!-- Closes the body and HTML tags -->

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Checks if the request method is POST, meaning the form was submitted
    //////////////
    //rate limit//
    //////////////
    // Rate limiting parameters
    $rateLimit = 1; // Maximum requests per duration
    $rateLimitDuration = 15; // Duration in seconds

    // Connect to the MySQL database
    $mysqli = require __DIR__ . "/db.php"; // Requires the 'db.php' file again to connect to the database

    // Check if the client exists in the rate_limits_guestbook table
    $stmt = $mysqli->prepare("SELECT request_count, last_request_time FROM rate_limits_guestbook WHERE client_id = ?"); // Prepares a query to fetch the request count and last request time from the database
    $stmt->bind_param("s", $clientIP); // Binds the client's IP address to the query as a parameter
    $stmt->execute(); // Executes the query
    $stmt->bind_result($requestCount, $lastRequestTime); // Binds the result columns to PHP variables
    $stmt->fetch(); // Fetches the result into the variables
    $stmt->close(); // Closes the prepared statement

    // Get the current timestamp
    $currentTime = time(); // Gets the current timestamp in seconds since the Unix epoch

    // Check if the client has exceeded the rate limit
    if ($requestCount >= $rateLimit && $currentTime - $lastRequestTime < $rateLimitDuration) { // If the client has exceeded the rate limit and the duration has not passed
        // Rate limit exceeded
        http_response_code(429); // Sends a 429 Too Many Requests HTTP response code to indicate rate limit exceeded
        echo '<script>alert("Please wait before sending another message.");</script>'; // Shows an alert to the user informing them to wait
        exit; // Exits the script to prevent further execution
    }

    // Update or insert the client entry
    if ($requestCount > 0) { // If there are previous requests from this client
        // Update the existing entry
        $stmt = $mysqli->prepare("UPDATE rate_limits_guestbook SET request_count = request_count + 1, last_request_time = ? WHERE client_id = ?"); // Prepares an update query to increment the request count and update the last request time
        $stmt->bind_param("is", $currentTime, $clientIP); // Binds the parameters (current time and client IP) to the query
        $stmt->execute(); // Executes the update
        $stmt->close(); // Closes the prepared statement
    } else { // If there are no previous requests from this client
        // Insert a new entry
        $stmt = $mysqli->prepare("INSERT INTO rate_limits_guestbook (client_id, request_count, last_request_time) VALUES (?, 1, ?)"); // Prepares an insert query for a new entry
        $stmt->bind_param("si", $clientIP, $currentTime); // Binds the client IP and current time to the query
        $stmt->execute(); // Executes the insert
        $stmt->close(); // Closes the prepared statement
    }

    //////////////////
    //not rate limit//
    //////////////////
    if (empty($_POST['message'])) { // If the 'message' field is empty
        die("<script>alert(\"Please don't try to leave empty messages.\");</script>"); // Shows an alert and stops further execution
    }
    if (rand(1,10000) == 2893) { // Randomly generates a number between 1 and 10000, and if it equals 2893
        die("<script>alert(\"Hello! I am an alert box!! (your message wasnt added because i rolled a 10,000 sided dice and it landed on 2893, try again)\");</script>"); // Simulates a random error by showing an alert
    }
    if(strlen($_POST['message']) > 500) { // If the message is longer than 500 characters
        die("<script>alert(\"Sorry, your message can be no longer than 500 characters.\");</script>"); // Shows an alert and stops further execution
    }
    if($_POST['username'] == 'admin' || $_POST['username'] == 'administrator') { // If the username is 'admin' or 'administrator'
        die("<script>alert(\"Please don't try to impersonate staff.\");</script>"); // Shows an alert and stops further execution
    }
    //teh checks are all done :DDDD time to add your message :PPP
    $sql = "INSERT INTO guestbook (username, message) VALUES (?, ?)"; // Prepares a SQL query to insert the username and message into the 'guestbook' table
    $stmt = $mysqli->stmt_init(); // Initializes a prepared statement
    $stmt->prepare($sql); // Prepares the SQL query
    if (!$stmt->prepare($sql)) { // If preparing the SQL query fails
        die("SQL Error: " . $mysqli->error); // Shows the MySQL error and stops execution
    }
    $stmt->bind_param("ss", $_POST['username'], $_POST["message"]); // Binds the 'username' and 'message' form fields to the SQL query
    if ($stmt->execute()) { // Executes the query
        echo '<script>alert("Your message was successfully added!"); window.location.href = "http://mateishome.page/guestbook.php";</script>'; // Shows an alert confirming the message was added and redirects the user to the guestbook page
    } else { // If the query fails
        echo '<script>alert("There was an error: ' . $mysqli->error . '");</script>'; // Shows an error message
    }
}
?> 
