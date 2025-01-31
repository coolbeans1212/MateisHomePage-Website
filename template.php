<?php // Beginning of PHP code block

$mysqli = require_once __DIR__ . "/db.php"; // Line 1: This loads the PHP file db.php and assigns the result to the variable $mysqli. The 'require_once' ensures that the file is included only once. '__DIR__' is a constant that refers to the directory where the current script is located.

session_start(); // Line 2: This starts a session or resumes the current session based on a session identifier passed via a cookie or URL parameter. This is needed to store and retrieve session variables.

if (isset($_SESSION["user_id"])) { // Line 3: Checks if the session variable "user_id" exists. If it does, the block of code inside the curly braces will be executed. 

  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}"; // Line 4: This creates a SQL query string that selects the "username" from the "users" table where the user's ID matches the one stored in the session. It inserts the value of $_SESSION["user_id"] into the query using curly braces.

  $result = $mysqli->query($sql); // Line 5: Executes the SQL query on the $mysqli object (which represents the connection to the database) and stores the result in the $result variable.

  $user = $result->fetch_assoc(); // Line 6: Fetches the next row from the result set as an associative array, where column names are keys. The result is stored in the $user variable.

} // Line 7: Closes the 'if' statement.

?> // End of PHP code block

<!DOCTYPE html> <!-- Line 8: This is the DOCTYPE declaration for HTML5, telling the browser this is an HTML5 document. -->

<html lang="en"> <!-- Line 9: This starts the HTML document and sets the language attribute of the document to English (en). -->

<head> <!-- Line 10: Opening <head> tag. Contains metadata and links for the webpage. -->
  <meta charset="UTF-8"> <!-- Line 11: Sets the character encoding for the document to UTF-8 (supports many characters, including special symbols). -->
  <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Line 12: Sets the website’s favicon (icon shown in browser tab) to "favicon.ico". -->
  <title>Matei's Homepage!</title> <!-- Line 13: Sets the title of the webpage (what appears on the browser tab) to "Matei's Homepage!". -->
  <meta content="a cool website all about me, Matei!" property="og:title" /> <!-- Line 14: Open Graph meta tag, used for social media sharing, setting the title to "a cool website all about me, Matei!". -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" /> <!-- Line 15: Open Graph description meta tag for social sharing, describing the website. -->
  <meta content="https://mateishome.page" property="og:url" /> <!-- Line 16: Open Graph URL meta tag, specifies the website's URL for social media platforms. -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" /> <!-- Line 17: Open Graph image meta tag, sets an image to be shown when the page is shared on social media. -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" /> <!-- Line 18: Sets the browser’s theme color to the hex color code #24589E (used for mobile browsers). -->
  <?php include_once __DIR__ . "/applets/style.php";?> <!-- Line 19: Includes the PHP file "style.php" located in the "applets" directory, which likely contains styling for the webpage. 'include_once' ensures it's included only once. -->
</head> <!-- Line 20: Closing </head> tag. -->

<body> <!-- Line 21: Opening <body> tag. The body contains the visible content of the webpage. -->
<script> <!-- Line 22: Opening <script> tag, starts a JavaScript block. -->
if ( window !== window.parent ) <!-- Line 23: Checks if the current window is inside an iframe. The 'window' refers to the current window object, and 'window.parent' refers to the parent window. If they are different, the page is inside an iframe. -->
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // Line 24: If the page is inside an iframe, it redirects the browser to the URL "https://mateishome.page/dontputmeinaniframe!.html" to prevent it from being framed.
      //window.location.replace("about:inducebrowsercrashforrealz"); // Line 25: Commented-out code. If used, it would redirect to a URL that crashes the browser. (This is an evil or malicious example and shouldn't be used in real applications.)
}
</script> <!-- Line 26: Closing </script> tag. -->
<div class="page"> <!-- Line 27: Opening <div> tag with a class of "page". This is a container for the content of the page. -->
<?php
include_once __DIR__ . "/applets/navigation_bar.php"; // Line 28: Includes the "navigation_bar.php" file, which likely contains the website's navigation bar (menu). 'include_once' ensures it’s included only once.
?> <!-- Line 29: PHP closing tag. Ends the PHP block. -->
<br> <!-- Line 30: A line break (<br>) tag to add spacing between elements. -->
</div> <!-- Line 31: Closing </div> tag for the "page" container. -->
</body> <!-- Line 32: Closing </body> tag, ending the body of the HTML document. -->
</html> <!-- Line 33: Closing </html> tag, marking the end of the HTML document. -->
