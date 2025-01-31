<?php // Opening PHP tag: tells the server that PHP code will follow.
$mysqli = require_once "/var/www/html/db.php"; // Loads the database configuration from a file located at /var/www/html/db.php, and stores the result in the $mysqli variable.
session_start(); // Starts a new session or resumes the current one to allow access to session variables.
if (isset($_SESSION["user_id"])) { // Checks if the session variable "user_id" is set, which indicates that the user is logged in.
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}"; // Constructs a SQL query to select the "username" field from the "users" table where the "id" matches the "user_id" from the session.
  $result = $mysqli->query($sql); // Executes the SQL query on the database and stores the result in $result.
  $user = $result->fetch_assoc(); // Fetches the result of the query as an associative array and stores it in $user. This gives us the username of the logged-in user.
}
?> <!-- Closing PHP tag: ends the PHP block. -->

<!DOCTYPE html> <!-- Declares the document type as HTML5. -->
<html lang="en"> <!-- Starts the HTML document and specifies that the language is English. -->
<head> <!-- Opens the head section of the HTML document. -->
  <meta charset="UTF-8"> <!-- Specifies the character encoding for the document as UTF-8, which includes most characters from all languages. -->
  <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Links to the website's favicon (the small image that appears in the browser tab). -->
  <title>Matei's Homepage!</title> <!-- Sets the title of the webpage that will appear in the browser tab. -->
  <meta content="a cool website all about me, Matei!" property="og:title" /> <!-- Defines an Open Graph meta tag with the title of the page for social media sharing. -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" /> <!-- Defines a description of the page for Open Graph, enhancing how the page appears when shared on social media. -->
  <meta content="https://mateishome.page" property="og:url" /> <!-- Provides the URL of the page for Open Graph. -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" /> <!-- Specifies an image to be used when the page is shared via Open Graph. -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" /> <!-- Defines a theme color for the webpage, which can change the color of the browser's address bar on mobile devices. -->
  <?php include_once __DIR__ . "/../applets/style.php";?> <!-- Includes the PHP file located at "../applets/style.php" to add CSS styles to the page. -->
</head> <!-- Closes the head section of the HTML document. -->
<body> <!-- Starts the body of the HTML document, where the content of the page will go. -->
<script> <!-- Opens a script block for JavaScript. -->
if ( window !== window.parent ) { // Checks if the page is being viewed inside an iframe by comparing the current window object to the parent window object.
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // Redirects the user to a different page if the page is inside an iframe.
      //window.location.replace("about:inducebrowsercrashforrealz"); // This line is commented out, but would crash the browser if it were activated. It's a "evil" example.
}
</script> <!-- Closes the script block for JavaScript. -->
<div class="page"> <!-- Creates a div container with the class "page". -->
<?php
include_once __DIR__ . "/../applets/navigation_bar.php"; // Includes the PHP file located at "../applets/navigation_bar.php", which likely contains the website's navigation bar.
?> <!-- Closes the PHP block. -->
<br> <!-- Inserts a line break in the HTML document. -->
  <div class="largeApplet"> <!-- Creates a div container with the class "largeApplet". -->
      <h1>Pick your favourite profile picture.</h1> <!-- Displays a heading with the text "Pick your favourite profile picture." -->
      <span id="loadingIndicator">Loading images, please wait...</span><br> <!-- Displays a loading indicator message with the ID "loadingIndicator" to inform the user that images are being loaded. -->
      <?php
      for ($pfps = 1; $pfps <= 78; $pfps++) { // Starts a loop that will iterate 78 times, each time incrementing $pfps by 1, creating links to profile pictures.
          echo '<a href="customisationProcessing.php?set=true&image=' . $pfps . '"><img src="/files/images/pfps/thumbnails/' . $pfps . '.jpg" width="80px;" height="80px;"></img></a> '; // For each iteration, it generates an anchor tag with a link to "customisationProcessing.php" with a query parameter for setting the profile picture image, and includes an image thumbnail.
      }
      ?>
      <script> <!-- Opens a script block for JavaScript. -->
          const element = document.getElementById("loadingIndicator"); // Gets the HTML element with the ID "loadingIndicator" and assigns it to the variable "element".
          element.remove(); // Removes the "loadingIndicator" element from the webpage once the images have been loaded.
      </script> <!-- Closes the script block for JavaScript. -->
  </div> <!-- Closes the div container with the class "largeApplet". -->
  <br> <!-- Inserts a line break in the HTML document. -->
  <a href="customise.php"> <!-- Creates an anchor tag that links to "customise.php". -->
    <div class="smallApplet" style="text-align: center; margin: auto; width: 10%;"> <!-- Creates a div container with the class "smallApplet" and some inline CSS to center it and make it 10% of the page width. -->
        Cancel <!-- Displays the text "Cancel" inside the div. -->
    </div> <!-- Closes the div container with the class "smallApplet". -->
  </a> <!-- Closes the anchor tag linking to "customise.php". -->
</div> <!-- Closes the div container with the class "page". -->
</body> <!-- Closes the body section of the HTML document. -->
</html> <!-- Closes the HTML document. -->
