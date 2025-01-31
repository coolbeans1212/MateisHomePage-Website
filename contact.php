<?php
$mysqli = require_once __DIR__ . "/db.php"; // Includes the database connection file (db.php) and stores the returned database connection in the $mysqli variable
session_start(); // Starts the PHP session, which is used to track user information across pages
if (isset($_SESSION["user_id"])) { // Checks if a user ID is set in the session (indicating the user is logged in)
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}"; // Constructs an SQL query to fetch the 'username' from the 'users' table where the user's ID matches the one in the session
  $result = $mysqli->query($sql); // Executes the SQL query on the database and stores the result in the $result variable
  $user = $result->fetch_assoc(); // Fetches the result as an associative array and stores it in the $user variable (contains the username of the logged-in user)
}
?>

<!DOCTYPE html>
<html lang="en"> <!-- Starts an HTML document with English as the language -->
<head>
  <meta charset="UTF-8"> <!-- Specifies the character encoding for the page (UTF-8) -->
  <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Sets the website's favicon to the file 'favicon.ico' -->
  <title>Matei's Homepage!</title> <!-- Sets the title of the webpage that will appear in the browser tab -->
  <meta content="a cool website all about me, Matei!" property="og:title" /> <!-- Open Graph meta tag for SEO, sets the title of the webpage when shared on social media -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" /> <!-- Open Graph description for SEO, used when the page is shared on social media -->
  <meta content="https://mateishome.page" property="og:url" /> <!-- Open Graph URL for SEO, specifies the webpage's URL -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" /> <!-- Open Graph image for SEO, specifies an image to represent the webpage when shared on social media -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" /> <!-- Specifies the theme color of the webpage (used for mobile browsers) -->
  <?php include_once __DIR__ . "/applets/style.php";?> <!-- Includes the 'style.php' file from the 'applets' folder to apply custom styles to the page -->
</head>
<body>
<script>
if ( window !== window.parent ) // Checks if the current window is inside an iframe (window !== window.parent checks if the current window is the same as its parent window)
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // If the page is in an iframe, redirect the user to a warning page
      //window.location.replace("about:inducebrowsercrashforrealz"); // Alternative comment-out line that could induce a browser crash (commented out)
}
</script>
<div class="page"> <!-- Starts the main content container for the webpage -->
<?php
include_once __DIR__ . "/applets/navigation_bar.php"; // Includes the 'navigation_bar.php' file to display the navigation bar at the top of the page
?>
<br>
<div class="largeApplet"> <!-- Starts a large content section (likely styled with CSS) -->
  <h1>Contact me!</h1> <!-- Displays a heading for the contact section -->
  You can contact me for any reason you would like to, just please don't stalk or harass me. The contact methods are listed in order of most preferred to least preferred.<br><hr> <!-- Text introducing the contact information -->
  Discord: @bmpimg<br> <!-- Displays the first preferred contact method (Discord) -->
  E-mail: matei@mateishome.page<br> <!-- Displays the second preferred contact method (E-mail) -->
  Newgrounds: Mattamatt<br> <!-- Displays the third preferred contact method (Newgrounds) -->
  Breaking into my server and leaving a note on the desktop: ssh pi@192.168.0.25<br> <!-- Displays a humorous and less preferred contact method (server access via SSH) -->
</div> <!-- Ends the large content section -->
</div> <!-- Ends the main content container -->
</body>
</html>
