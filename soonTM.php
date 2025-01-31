<?php
$mysqli = require_once __DIR__ . "/db.php"; 
// This line includes a PHP file (db.php) that is expected to return a MySQLi connection. The connection is stored in the variable $mysqli.

session_start(); 
// This function starts a new session or resumes an existing session. It allows access to session variables (e.g., $_SESSION).

if (isset($_SESSION["user_id"])) { 
// This checks if there is a session variable "user_id" (i.e., if the user is logged in).

  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}"; 
  // If a user is logged in, this SQL query selects the "username" field from the "users" table where the "id" matches the logged-in user's ID.

  $result = $mysqli->query($sql); 
  // Executes the query stored in $sql and stores the result in the $result variable.

  $user = $result->fetch_assoc(); 
  // Fetches the results of the query as an associative array and stores it in the $user variable.

}
?>

<!DOCTYPE html> 
<!-- Declares that this document is an HTML5 document. -->

<html lang="en">
<head>
  <meta charset="UTF-8">
  <!-- Specifies that the character encoding for the document is UTF-8. This is important for proper encoding of characters. -->

  <link rel="icon" href="favicon.ico" type="image/x-icon"> 
  <!-- Sets the website's favicon (the small icon shown in the browser tab) to "favicon.ico". -->

  <title>Matei's Homepage!</title>
  <!-- Sets the title of the webpage as displayed in the browser tab. -->

  <meta content="a cool website all about me, Matei!" property="og:title" />
  <!-- This is an Open Graph meta tag, which helps improve the preview of the website when shared on social media (e.g., Facebook). -->

  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" />
  <!-- Another Open Graph meta tag to define the description of the website for social media sharing. -->

  <meta content="https://mateishome.page" property="og:url" />
  <!-- This meta tag specifies the URL of the website for Open Graph. -->

  <meta content="https://mateishome.page/welcome.gif" property="og:image" />
  <!-- Defines the image to be used in social media previews when sharing the website (a GIF in this case). -->

  <meta content="#24589E" data-react-helmet="true" name="theme-color" />
  <!-- Sets the browser's theme color to a specific shade of blue (#24589E), which can change the color of the toolbar on some mobile browsers. -->

  <?php include_once __DIR__ . "/applets/style.php";?>
  <!-- Includes a PHP file that presumably contains styles (CSS) for the website. -->
</head>
<body>
<script>
if ( window !== window.parent ) 
// This checks if the current window is inside an iframe (e.g., being embedded into another webpage). If true, the code inside the block executes.

{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); 
      // If the page is in an iframe, it redirects the user to a specific page (possibly an error or warning page).
      //window.location.replace("about:inducebrowsercrashforrealz"); // EVIL The page is in an iframe
      // This is a commented-out line that suggests a more extreme action (crashing the browser) if the page is in an iframe.

}
</script>
<div class="page">
<!-- Starts a div container with the class "page" for the main content of the website. -->

<?php
include_once __DIR__ . "/applets/navigation_bar.php"; 
// This line includes a PHP file for a navigation bar, likely containing HTML structure for site navigation. The ":3" is a playful comment.

?>
<br>
<div class="mediumApplet" style="margin:auto;">
  <!-- Creates a div with the class "mediumApplet", and centers it horizontally with CSS inline styling ("margin:auto"). -->

    <h1>Coming soon!</h1> 
    <!-- Displays a large heading with the text "Coming soon!". -->

    This hasn't been made yet, but I'm working on it! (trust me) 
    <!-- A short text message below the heading, assuring users that the content is being worked on. -->
</div>
</div>
</body>
</html>
