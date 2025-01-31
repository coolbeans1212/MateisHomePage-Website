<?php  // Opens PHP block

$mysqli = require_once __DIR__ . "/../../db.php";  // Includes the database connection file and assigns it to the $mysqli variable
session_start();  // Starts a session or resumes the current session, allowing session variables to be accessed
if (isset($_SESSION["user_id"])) {  // Checks if the session contains a "user_id" (i.e., the user is logged in)
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";  // Prepares a SQL query to get the username of the logged-in user based on their session ID
  $result = $mysqli->query($sql);  // Executes the query and stores the result in the $result variable
  $user = $result->fetch_assoc();  // Fetches the resulting row as an associative array and stores it in the $user variable
}

?>

<!DOCTYPE html>  <!-- Declares that this is an HTML5 document -->
<html lang="en">  <!-- Starts the HTML document and sets the language to English -->
<head>  <!-- Opens the head section of the HTML document -->
  <meta charset="UTF-8">  <!-- Specifies the character encoding as UTF-8 (to support a wide range of characters) -->
  <link rel="icon" href="favicon.ico" type="image/x-icon">  <!-- Sets the favicon (small icon in the browser tab) -->
  <title>Matei's Homepage!</title>  <!-- Sets the title of the webpage, which appears in the browser tab -->
  <meta content="a cool website all about me, Matei!" property="og:title" />  <!-- Open Graph metadata for social media sharing (title) -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" />  <!-- Open Graph metadata for social media sharing (description) -->
  <meta content="https://mateishome.page" property="og:url" />  <!-- Open Graph metadata for social media sharing (URL) -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" />  <!-- Open Graph metadata for social media sharing (image) -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" />  <!-- Specifies the theme color for mobile browsers (background color of address bar) -->
  <?php include_once __DIR__ . "/../../applets/style.php";?>  <!-- Includes a CSS style file for the page's layout and design -->
</head>  <!-- Ends the head section -->
<body>  <!-- Opens the body section of the HTML document -->
<script>  <!-- Starts a JavaScript block -->
if ( window !== window.parent )  // Checks if the page is inside an iframe (i.e., it’s not the top-level window)
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html");  // If the page is inside an iframe, it redirects to a page that warns against embedding in an iframe
      //window.location.replace("about:inducebrowsercrashforrealz");  // (Commented out) This would cause the browser to crash if enabled (EVIL!)
}
</script>  <!-- Ends the script block -->

<div class="page">  <!-- Opens a div with a class of "page" to contain the main content of the webpage -->
<?php
include_once __DIR__ . "/../../applets/navigation_bar.php";  // Includes the navigation bar from an external PHP file
?>  <!-- Ends the PHP block for including the navigation bar -->

<br>  <!-- Adds a line break -->
  <div class="largeApplet">  <!-- Creates a div for a large applet (content block) -->
      <h1>API Documentation: Quote API</h1>  <!-- Displays the main heading for the API documentation section -->
      <p>To use the quote API, send a GET request to <span class="codeBlock">https://mateishome.page/api/getMHPQuote.php</span>.</p>  <!-- Describes the API endpoint and how to access it, showing the URL -->
      <h2>Usage</h2>  <!-- Subheading for the usage section -->
      <p>There is one optional parameter that can be passed to the API named <span class="codeBlock">type</span>. This can be set to either nothing, <span class="codeBlock">plaintext</span>,
      <span class="codeBlock">json</span>, or <span class="codeBlock">complete</span>. If <span class="codeBlock">type</span>
      is set to nothing or <span class="codeBlock">plaintext</span>, it will return only the quote with no quotation marks around it. If <span class="codeBlock">type</span>
      is set to <span class="codeBlock">json</span>, it will return the quote and the date in JSON format.
      If <span class="codeBlock">type</span> is set to <span class="codeBlock">complete</span>, it will return the date and the quote.</p>  <!-- Explains the different options for the API's "type" parameter -->
      <h2>Examples</h2>  <!-- Subheading for the examples section -->
      <p>All examples are written in the best language ever, PHP.</p>  <!-- Explains that the examples are written in PHP -->
      <div class="codeBlock">  <!-- Creates a div to display code examples in a styled block -->
        // Method 1: Get a quote in plaintext<br>
        echo file_get_contents("https://mateishome.page/api/getMHPQuote.php"); // Will return something like `i use arch btw`<br>
        <br>
        // Method 2: Get a quote in JSON format<br>
        $MHPQuote = json_decode(file_get_contents("https://mateishome.page/api/getMHPQuote.php?type=json"));<br>
        echo 'The quote at MateisHomePage on ' . $MHPQuote->date . ' is: ' . $MHPQuote->quote; // Will return something like `The quote at MateisHomePage on January 56th, 1984 is: i use arch btw`<br>
        <br>
        // Method 3: Get a complete quote<br>
        echo file_get_contents("https://mateishome.page/api/getMHPQuote.php?type=complete"); // Will return something like `January 56th, 1984's quote is: 'i use arch btw'`<br>
      </div>  <!-- Ends the code block div -->
  </div>  <!-- Ends the large applet div -->
  <br>  <!-- Adds a line break -->
  <a href="/api/docs/"><button class="navigationButton">Go Back</button></a>  <!-- Creates a button that links back to the API documentation page -->
</div>  <!-- Ends the page div -->
</body>  <!-- Ends the body section -->
</html>  <!-- Ends the HTML document -->
