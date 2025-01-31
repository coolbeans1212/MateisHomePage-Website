<?php // This starts the PHP block, indicating that PHP code will follow.
$mysqli = require_once __DIR__ . "/../../db.php"; // This line loads the database connection file (db.php), which is required to interact with the database. It uses a relative path to include the file, starting from the current directory (__DIR__ refers to the directory where this PHP file is located).
session_start(); // This function starts a new session or resumes an existing one, allowing you to access session variables (such as $_SESSION).
if (isset($_SESSION["user_id"])) { // This line checks if the 'user_id' key exists in the $_SESSION array, which indicates that the user is logged in.
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}"; // This line creates a SQL query to retrieve the 'username' from the 'users' table where the 'id' matches the user ID stored in the session.
  $result = $mysqli->query($sql); // This line sends the query to the database using the previously created $mysqli object, which represents the connection to the database. The result is stored in the $result variable.
  $user = $result->fetch_assoc(); // This line fetches the result as an associative array, which means you can access the 'username' using $user["username"]. The data is stored in the $user variable.
}
?> <!-- This closes the PHP block. -->

<!DOCTYPE html> <!-- This declares that the document is an HTML5 document. It helps the browser understand how to interpret the content. -->
<html lang="en"> <!-- This starts the HTML document and specifies that the language of the content is English. -->
<head> <!-- This starts the head section of the HTML document. The head contains metadata and links to external resources like stylesheets. -->
  <meta charset="UTF-8"> <!-- This specifies the character encoding for the document, ensuring that it can correctly display all characters, including special ones like accents. -->
  <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- This specifies the location of the favicon (the small icon in the browser tab) for the website. -->
  <title>Matei's Homepage!</title> <!-- This sets the title of the web page, which appears in the browser tab or title bar. -->
  <meta content="a cool website all about me, Matei!" property="og:title" /> <!-- This meta tag sets the title for social media sharing using Open Graph. When shared, this will be the title displayed. -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" /> <!-- This meta tag sets the description for social media sharing using Open Graph. -->
  <meta content="https://mateishome.page" property="og:url" /> <!-- This meta tag sets the URL for social media sharing. It tells where to link to when the page is shared. -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" /> <!-- This meta tag sets an image for social media sharing, showing the image when the page link is shared. -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" /> <!-- This meta tag sets the theme color for mobile browsers. It changes the color of the browser’s address bar. -->
  <?php include_once __DIR__ . "/../../applets/style.php";?> <!-- This includes the external PHP file style.php, which may contain CSS or additional styling code for the page. The 'include_once' ensures the file is included only once, preventing multiple inclusions. -->
</head> <!-- This closes the head section of the document. -->
<body> <!-- This starts the body section of the HTML document, where the visible content of the page goes. -->
<script> <!-- This starts a block of JavaScript code, which runs in the browser. -->
if ( window !== window.parent ) <!-- This checks if the current window is inside an iframe. 'window' refers to the current page, and 'window.parent' refers to the parent page that might have embedded the current page in an iframe. -->
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // If the page is inside an iframe, this line redirects the browser to a different URL, notifying the user that the page should not be in an iframe.
      //window.location.replace("about:inducebrowsercrashforrealz"); // This is a commented-out line that would, if enabled, attempt to cause the browser to crash. It's a malicious or joke line and is currently disabled.
}
</script> <!-- This ends the JavaScript block. -->
<div class="page"> <!-- This starts a div element with the class "page", which is likely used to style or group the content on the page. -->
<?php
include_once __DIR__ . "/../../applets/navigation_bar.php"; // This includes another PHP file (navigation_bar.php), which likely contains the HTML and PHP for the navigation bar of the website. The 'include_once' ensures it’s only included once.
?> <!-- This closes the PHP block. -->
<br> <!-- This creates a line break, moving content below it. -->
<div class="largeApplet"> <!-- This starts a div element with the class "largeApplet", which is probably used for styling or structuring a larger section of content. -->
    <h1>API Documentation</h1> <!-- This creates a heading (h1) element, which is typically the largest heading on the page. It says "API Documentation" on the page. -->
    <p>MateisHomePage Technologies provides many free APIs. The documentation for these APIs are listed here.</p> <!-- This creates a paragraph (p) element with text explaining the page content. -->
    <h2>Links to documentations</h2> <!-- This creates a smaller heading (h2) for the next section of content. -->
    <ul> <!-- This starts an unordered list (ul), which is typically used to create a list of items. -->
    <a href="quotes.php"><li>Quote API</li></a> <!-- This creates a link (a) to the "quotes.php" page. Inside the link is a list item (li) that says "Quote API". When clicked, it will take the user to the "quotes.php" page. -->
    </ul> <!-- This closes the unordered list. -->
</div> <!-- This closes the div with the class "largeApplet". -->
</div> <!-- This closes the div with the class "page". -->
</body> <!-- This closes the body section of the document. -->
</html> <!-- This closes the HTML document. -->
