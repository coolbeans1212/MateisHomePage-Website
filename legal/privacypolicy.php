<?php // This starts the PHP code block
$mysqli = require_once __DIR__ . "/../db.php"; // This line includes the db.php file (relative path), which likely contains the database connection. The returned value is stored in the variable $mysqli, which represents the database connection.
session_start(); // This starts the PHP session, allowing the server to track user activity and session data (e.g., user authentication) across different pages.
if (isset($_SESSION["user_id"])) { // Checks if the 'user_id' is set in the session, meaning the user is logged in.
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}"; // If a user is logged in, this query selects the 'username' field from the 'users' table where the user_id matches the one stored in the session.
  $result = $mysqli->query($sql); // Executes the SQL query using the database connection stored in $mysqli, and stores the result in the $result variable.
  $user = $result->fetch_assoc(); // Fetches the result as an associative array, where each field is a key-value pair (e.g., 'username' => 'Matei') and stores it in the $user variable.
} // This closes the if statement

?> // This closes the PHP code block

<!DOCTYPE html> <!-- This declares that the document is an HTML5 document -->
<html lang="en"> <!-- This starts the HTML document and specifies that the content is in English -->
<head> <!-- This starts the head section of the HTML document -->
  <meta charset="UTF-8"> <!-- Specifies the character encoding for the document as UTF-8, which supports all characters in the Unicode standard -->
  <link rel="icon" href="/favicon.ico" type="image/x-icon"> <!-- This sets the favicon of the webpage (the icon displayed in the browser tab) to the image located at /favicon.ico -->
  <title>Matei's Homepage!</title> <!-- This sets the title of the page, which appears in the browser tab -->
  <meta content="a cool website all about me, Matei!" property="og:title" /> <!-- This is part of the Open Graph protocol, which provides metadata for social media platforms to display when the page is shared -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" /> <!-- This provides a description for social media sharing (Open Graph), which will appear when the page is shared -->
  <meta content="https://mateishome.page" property="og:url" /> <!-- This sets the URL of the webpage for Open Graph purposes -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" /> <!-- This specifies an image to be used when the page is shared on social media (Open Graph) -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" /> <!-- This sets the theme color for mobile browsers (i.e., the color of the address bar on some mobile devices) -->
  <?php include_once __DIR__ . "/../applets/style.php";?> <!-- This includes the style.php file once, which likely contains CSS or other styling elements for the page -->
</head> <!-- This ends the head section -->
<body> <!-- This starts the body section of the HTML document -->
<script> <!-- This starts a JavaScript block -->
if ( window !== window.parent ) // This checks if the current window is being viewed inside an iframe (a browser window embedded within another page)
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // If the page is in an iframe, it redirects the user to a specific page (don't put me in an iframe)
      //window.location.replace("about:inducebrowsercrashforrealz"); // This is a commented-out line that would cause a browser crash (EVIL).
}
</script> <!-- This ends the JavaScript block -->
<div class="page"> <!-- This starts a div with the class "page", which likely groups the page's content -->
<?php // This starts the PHP code block again
include_once __DIR__ . "/../applets/navigation_bar.php"; // This includes the navigation_bar.php file once, which likely contains the website's navigation menu.
?> <!-- This ends the PHP code block -->
<br> <!-- This inserts a line break (a new line) in the HTML -->
<div class="largeApplet"> <!-- This starts a div with the class "largeApplet", which likely contains a large section of content -->
  <h1>Privacy Policy</h1> <!-- This creates a top-level heading with the text "Privacy Policy" -->
  <p>"please dont sue me" -me when i realised that GDPR exists</p> <!-- This creates a paragraph with the humorous text about GDPR -->
  <h2>Part 1: Cookies</h2> <!-- This creates a subheading (level 2) with the text "Part 1: Cookies" -->
  <p>This website uses cookies <strong><oblique>ONLY</oblique></strong> to store session and login information. No other information is stored in cookies. No cookie information is shared with 3rd parties.</p> <!-- This paragraph explains that cookies are only used for session and login info, and no information is shared with third parties -->
  <h2>Part 2a: Data we collect - data linked to your account.</h2> <!-- This creates another subheading (level 2) with the text "Part 2a: Data we collect - data linked to your account" -->
  <p>When you create an account on this website, we store the following information:</p> <!-- This paragraph explains that when an account is created, certain data is stored -->
  <ul> <!-- This starts an unordered list -->
    <li>Your username</li> <!-- List item: user’s username -->
    <li>Your email address</li> <!-- List item: user’s email address -->
    <li>Your password (hashed)</li> <!-- List item: user’s password (hashed for security) -->
    <li>Your account creation date</li> <!-- List item: the date the account was created -->
    <li>The IP address you used to sign up and the IP address you last used to log in</li> <!-- List item: the IP address used during sign-up and the last login IP address -->
    <li>Any data that you have given to us by customising your account (for example, profile picture).</li> <!-- List item: user-customized data like a profile picture -->
  </ul> <!-- This ends the unordered list -->
  <h2>Part 2b: Data we collect - data not linked to your account.</h2> <!-- This creates another subheading (level 2) with the text "Part 2b: Data we collect - data not linked to your account" -->
  <p>Software we use to make this site possible may log some information that might be linked to your IP address or be fully anonymised. This includes:</p> <!-- This paragraph explains that software used on the site might log information that could be linked to an IP address or anonymized -->
  <ul> <!-- This starts another unordered list -->
    <li>IP address</li> <!-- List item: IP address -->
    <li>Browser information and user agent</li> <!-- List item: browser and user agent information -->
    <li>Date and time of requests</li> <!-- List item: the date and time a request was made -->
    <li>Requested resources</li> <!-- List item: the resources requested (e.g., files or pages) -->
    <li>Referrer</li> <!-- List item: the referring URL (the webpage that linked to this page) -->
  </ul> <!-- This ends the unordered list -->
  <h2>Part 3: Data shared with 3rd parties</h2> <!-- This creates another subheading (level 2) with the text "Part 3: Data shared with 3rd parties" -->
  <p>Yes, that's right! MateisHomePage Technologies is EVIL!!!!!! :O</p> <!-- This paragraph humorously claims the website shares data with third parties -->
  <p>We share the following information with 3rd parties:</p> <!-- This paragraph explains what data is shared with third parties -->
  <ul> <!-- This starts another unordered list -->
    <li>IP address - shared with StopForumSpam to prevent spam accounts</li> <!-- List item: IP address shared with StopForumSpam to prevent spam -->
    <li>IP address and browser information - processed by Cloudflare for security and performance reasons</li> <!-- List item: IP and browser info processed by Cloudflare for security and performance -->
  </ul> <!-- This ends the unordered list -->
  <p>No personal data is sold or shared for advertising purposes. Yet. (no im just kidding ill probably never put ads on here unless im desperate)</p> <!-- This paragraph humorously clarifies that personal data is not shared for advertising purposes (yet) -->
</div> <!-- This ends the div with the class "largeApplet" -->
</div> <!-- This ends the div with the class "page" -->
</body> <!-- This ends the body section of the HTML -->
</html> <!-- This ends the HTML document -->
