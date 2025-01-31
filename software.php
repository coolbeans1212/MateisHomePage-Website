<?php
/*
==========Uncomment if you want this page to have database functionality==========
$mysqli = require_once __DIR__ . "/db.php"; // This line includes the 'db.php' file, which is assumed to contain database connection details. It assigns the connection to the variable $mysqli. '__DIR__' ensures the correct directory is used to locate 'db.php'.
session_start(); // Starts a new session or resumes an existing session, allowing data to be preserved across different pages for the same user.
if (isset($_SESSION["user_id"])) { // Checks if there is a session variable called "user_id". If it's set, that means the user is logged in.
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}"; // Creates an SQL query to get the 'username' from the 'users' table where the 'id' matches the 'user_id' stored in the session.
  $result = $mysqli->query($sql); // Executes the SQL query using the database connection stored in $mysqli and stores the result in $result.
  $user = $result->fetch_assoc(); // Fetches the results of the query as an associative array and stores it in the $user variable. This will contain the 'username' for the logged-in user.
}
*/
?> <!-- Ends the PHP block, so the rest of the file is in HTML. -->
<!DOCTYPE html> <!-- Declares that this is an HTML5 document, informing the browser how to interpret the content. -->
<html lang="en"> <!-- Starts the HTML document and specifies that the content is in English (en). -->
<head> <!-- The opening tag for the head section of the HTML document, where metadata and links to external files are placed. -->
  <meta charset="UTF-8"> <!-- Specifies the character encoding for the page. UTF-8 is used here, which supports most characters and symbols worldwide. -->
  <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Specifies the small icon (favicon) shown in the browser tab. It links to 'favicon.ico'. -->
  <title>Matei's Homepage!</title> <!-- Sets the title of the page, which will appear in the browser tab and search engine results. -->
  <meta content="a cool website all about me, Matei!" property="og:title" /> <!-- This is an Open Graph (OG) meta tag for sharing on social media, specifically setting the title that appears when the page is shared. -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" /> <!-- The description shown when the page is shared on social media. It includes some SEO keywords for better search engine optimization. -->
  <meta content="https://mateishome.page" property="og:url" /> <!-- Specifies the URL for Open Graph. This is the link people will be directed to when they click on the shared content. -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" /> <!-- Provides an image (welcome.gif) to display as a preview when the page is shared on social media. -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" /> <!-- Sets the browser’s theme color to a shade of blue (#24589E), often used in mobile browsers to affect the color of the browser's UI. -->
  <?php include_once __DIR__ . "/applets/style.php";?> <!-- Includes the PHP file 'style.php' from the 'applets' folder. This likely contains CSS or additional styling for the page. '__DIR__' ensures it gets the correct directory. -->
</head> <!-- Closes the head section of the HTML document. -->
<body> <!-- Opens the body section of the HTML document, where the actual content of the page goes. -->
<script> <!-- This is the opening tag for a JavaScript block that will run on the page. -->
if ( window !== window.parent ) // Checks if the current page is inside an iframe. If true, it means the page is being viewed within another webpage.
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // Redirects the user to a page that says the content shouldn't be in an iframe if it detects the page is inside one.
      //window.location.replace("about:inducebrowsercrashforrealz"); // This line is commented out, but it would (if uncommented) try to crash the browser if the page was inside an iframe (EVIL).
}
</script> <!-- Closes the JavaScript block. -->
<div class="page"> <!-- Opens a div with the class "page", which is likely used for styling the main content of the page. -->
<?php
include_once __DIR__ . "/applets/navigation_bar.php"; // Includes the 'navigation_bar.php' file from the 'applets' directory. This file probably contains the navigation menu or header for the website.
?> <!-- Ends the PHP block. -->
<br> <!-- Inserts a line break for spacing between elements. -->
<div class="largeApplet"> <!-- Opens a div with the class "largeApplet", which might be used to style a larger section of the page. -->
<h1>My software</h1> <!-- Creates a level-1 heading with the text "My software". This is the main title for the section. -->
Nothing here yet, sorry :(. <!-- Displays a simple text message informing the user that there is nothing available yet in this section, followed by a sad face emoticon. -->
<a href="coolstuff.html">View the archive (bad software).</a> <!-- Creates a hyperlink to another page, 'coolstuff.html', which might contain an archive of software or content. The link text suggests the software might be not-so-good (bad software). -->
</div> <!-- Closes the 'largeApplet' div. -->
</div> <!-- Closes the 'page' div. -->
</body> <!-- Closes the body section of the HTML document. -->
</html> <!-- Closes the HTML document. -->
