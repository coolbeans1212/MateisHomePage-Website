<?php  // Opens PHP block

$mysqli = require_once "/var/www/html/db.php";  // Includes the database connection from the 'db.php' file and assigns it to the $mysqli variable
session_start();  // Starts a session or resumes an existing session, allowing session variables to be used
if (isset($_SESSION["user_id"])) {  // Checks if the "user_id" session variable is set (i.e., the user is logged in)
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";  // Prepares a SQL query to fetch the username of the logged-in user using their user ID
  $result = $mysqli->query($sql);  // Executes the query and stores the result in $result
  $user = $result->fetch_assoc();  // Fetches the result as an associative array (user data) and stores it in the $user variable
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {  // Checks if the form was submitted using the POST method (when the user tries to log in)
    
    $mysqli = require "/var/www/html/db.php";  // Re-includes the database connection again, because 'require_once' was causing issues
    $sql = "SELECT * FROM users WHERE username = ?";  // Prepares a SQL query to fetch all user details where the username matches a provided one (for login)
    $stmt = $mysqli->prepare($sql);  // Prepares the SQL statement for execution
    if ($stmt === false) {  // Checks if the statement preparation failed
        die("SQL prepare failed: " . $mysqli->error);  // If preparation fails, it stops and outputs the error message
    }
    $stmt->bind_param('s', $_POST['username']);  // Binds the 'username' parameter from the POST data to the prepared statement (the 's' means string)
    $stmt->execute();  // Executes the prepared statement
    $result = $stmt->get_result();  // Fetches the result of the executed query
    $user = $result->fetch_assoc();  // Fetches the user's details into the $user array

    if ($user) {  // If a user with that username exists in the database
      if (password_verify($_POST["password"], $user["hashed_password"])) {  // Verifies if the entered password matches the hashed password in the database
         session_start();  // Starts a new session or resumes the current session (to set session variables)
         session_regenerate_id();  // Regenerates the session ID to prevent session fixation attacks (this creates a new session)
         $_SESSION["user_id"] = $user["id"];  // Sets the session variable "user_id" to the ID of the logged-in user
         $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];  // Gets the user's real IP address from the 'HTTP_CF_CONNECTING_IP' header (used when the site is behind Cloudflare)

         if (!$user['first_ip']) {  // Checks if the user has not recorded a "first_ip" in the database (i.e., they are logging in for the first time)
          $sql = "UPDATE users SET first_ip = ? WHERE username = ?";  // Prepares a SQL query to update the user's "first_ip" field
          $stmt = $mysqli->stmt_init();  // Initializes the statement object for the query
          $stmt->prepare($sql);  // Prepares the SQL query
          $stmt->bind_param('ss', $ip, $_POST["username"]);  // Binds the user's IP and username to the query parameters
          $stmt->execute();  // Executes the query to set the first IP address
        }

         $sql = "UPDATE users SET last_ip = ? WHERE username = ?";  // Prepares a SQL query to update the user's "last_ip" field (most recent IP)
         $stmt = $mysqli->stmt_init();  // Initializes the statement object again
         $stmt->prepare($sql);  // Prepares the SQL query
         $stmt->bind_param('ss', $ip, $_POST["username"]);  // Binds the user's IP and username to the query parameters
         $stmt->execute();  // Executes the query to set the last IP address

         header("Location: /");  // Redirects the user to the home page after a successful login
         exit;  // Ensures that no further code is executed after the redirect
      }
    }
  }
?>

<!DOCTYPE html>  <!-- Declares the document type as HTML5 -->
<html lang="en">  <!-- Opens an HTML document with the language set to English -->
<head>  <!-- Begins the head section of the document -->
  <meta charset="UTF-8">  <!-- Specifies the character encoding as UTF-8 -->
  <link rel="icon" href="favicon.ico" type="image/x-icon">  <!-- Sets the favicon (small icon) for the webpage -->
  <title>Matei's Homepage!</title>  <!-- Sets the title of the webpage (displayed in the browser tab) -->
  <meta content="a cool website all about me, Matei!" property="og:title" />  <!-- Open Graph metadata for social media sharing (title) -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" />  <!-- Open Graph metadata for social media sharing (description) -->
  <meta content="https://mateishome.page" property="og:url" />  <!-- Open Graph metadata for social media sharing (URL) -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" />  <!-- Open Graph metadata for social media sharing (image) -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" />  <!-- Specifies the theme color for mobile browsers -->
  <?php include_once __DIR__ . "/../applets/style.php";?>  <!-- Includes an external PHP file that contains styling for the page -->
</head>  <!-- Ends the head section -->
<body>  <!-- Opens the body section of the HTML document -->
<script>  <!-- Begins a JavaScript block -->
if ( window !== window.parent )  // Checks if the page is inside an iframe (if it's not, the window is its own parent)
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html");  // If the page is inside an iframe, redirects the user to a warning page
      //window.location.replace("about:inducebrowsercrashforrealz");  // (Commented out) This would cause the browser to crash if enabled
}
</script>  <!-- Ends the script block -->
<div class="page">  <!-- Creates a div for the page's main content -->
<?php
include_once __DIR__ . "/../applets/navigation_bar.php";  // Includes a navigation bar from another file
?>  <!-- Closes the PHP block for navigation bar inclusion -->

<br>  <!-- Adds a line break -->
    <div class="mediumApplet" style="text-align: center; margin: auto;">  <!-- Creates a medium-sized applet for the login form with centered text and auto margin -->
      <h1>Log in</h1>  <!-- Displays the heading "Log in" -->
    <form method="post">  <!-- Begins a form that submits data to the same page using the POST method -->
        <label for="username">Username</label><br>  <!-- Label for the username input field -->
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($_POST["username"] ?? "") ?>"><br>  <!-- Text input for the username, pre-filled with the last submitted value (if any) -->
        <label for="password">Password</label><br>  <!-- Label for the password input field -->
        <input type="password" name="password" id="password"><br>  <!-- Password input for the user to enter their password -->
        <input type="submit" value="Log in">  <!-- Submit button for the form -->
        <?php if (isset($_POST['password'])): //if this is set and the user is still on the login page, it means the credentials are incorrect ?>
          <br><oblique>Invalid login</oblique>  <!-- Displays an error message if the login attempt failed (wrong username/password) -->
        <?php endif; ?>
    </form>
    </div>
</div>
</body>  <!-- Ends the body section -->
</html>  <!-- Ends the HTML document -->
