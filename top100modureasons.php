<?php //this is the page that https://eatmoreram.com redirects to
$mysqli = require_once __DIR__ . "/db.php"; // Include the db.php file and return the database connection. '__DIR__' gets the current script directory path.
session_start(); // Starts a new session or resumes the existing session for tracking user state.
if (isset($_SESSION["user_id"])) { // Checks if the 'user_id' key exists in the session data.
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}"; // Constructs an SQL query to select the 'username' from 'users' table where the 'id' matches the user's session id.
  $result = $mysqli->query($sql); // Executes the SQL query and stores the result in the '$result' variable.
  $user = $result->fetch_assoc(); // Fetches the result of the query as an associative array (mapping column names to their values).
}
?>

<!DOCTYPE html> <!-- This defines the document type as HTML5. -->
<html lang="en"> <!-- Defines the start of the HTML document and specifies the language as English. -->
<head>
  <meta charset="UTF-8"> <!-- Sets the character encoding to UTF-8, which supports most characters and symbols. -->
  <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Sets the favicon (small image shown in browser tab). -->
  <title>Matei's Homepage!</title> <!-- Sets the title of the webpage, displayed in the browser tab. -->
  <meta content="EAT. MORE. RAM." property="og:title" /> <!-- Open Graph metadata for the title, used for social media sharing. -->
  <meta content="eat more ram eat more ram..." property="og:description" /> <!-- Open Graph metadata for the description, used for social media sharing. -->
  <meta content="https://mateishome.page" property="og:url" /> <!-- Open Graph metadata for the URL, used for social media sharing. -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" /> <!-- Open Graph metadata for the image, used for social media sharing. -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" /> <!-- Specifies the theme color for the browser’s address bar. -->
  <?php include_once __DIR__ . "/applets/style.php";?> <!-- Includes the 'style.php' file once for CSS or other styles. -->
</head>
<body>
<script>
if ( window !== window.parent ) // Checks if the current window is not the top-level window (meaning it is inside an iframe).
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // If the page is inside an iframe, redirect to a different page (this avoids being embedded).
      //window.location.replace("about:inducebrowsercrashforrealz"); // A commented-out line of code that would crash the browser if uncommented.
}
</script>
<div class="page"> <!-- Creates a container div with the class 'page'. -->
<?php
include_once __DIR__ . "/applets/navigation_bar.php"; // Includes the 'navigation_bar.php' file once, likely containing a navigation bar for the page.
?>
<br> <!-- This is an HTML line break, adding vertical space between elements. -->
<div class="largeApplet"> <!-- Creates a div container with the class 'largeApplet', likely for styling purposes. -->
    <h1 style="text-align: center;">Top 100 reasons why Modu is the best programming language and you should use it.</h1> <!-- An H1 header with text centered, introducing the list of reasons why Modu is the best language. -->
    <ol> <!-- Starts an ordered list (numbered list). -->
    <li>Beautiful syntax</li> <!-- Each list item starts with <li>, describing reasons why Modu is great. -->
    <li>Fast for an interpreted language</li> <!-- Second reason for why Modu is great. -->
    <li>Active development</li> <!-- Another reason, stating Modu has ongoing improvements. -->
    <li>Steamlined error messages for easy debugging</li> <!-- Reason explaining the debugging benefits of Modu. -->
    <li>Easy to learn</li> <!-- Reason explaining Modu's accessibility for beginners. -->
    <li>Modern library system</li> <!-- Reason stating Modu has up-to-date libraries for developers. -->
    <li>Open source</li> <!-- Reason saying that Modu is open source, meaning it's freely available to modify. -->
    <li>You get to say "i use modu btw" (like i use arch btw but less cringe)</li> <!-- A humorous reason to mention that using Modu is cool. -->
    <li>Package manager built in</li> <!-- A reason stating that Modu has a package manager built in, simplifying library installation. -->
    <li>It is made by Cyteon</li> <!-- A reason saying that the creator of Modu is Cyteon. -->
    <li>Cyteon is awesome, therefore Modu is awesome</li> <!-- A playful reason saying Cyteon’s awesomeness makes Modu great. -->
    <li>I said so</li> <!-- Another playful reason asserting Modu's greatness. -->
    <li>Made with love and care 😊</li> <!-- A fun and lighthearted reason showing the love and care put into Modu. -->
    <li>Easy to run and install: just download the latest binary from Github Actions and put it in your PATH folder.</li> <!-- Practical reason explaining how to install Modu easily. -->
    <li>F*cedev has not made a video about it</li> <!-- Reason poking fun at F*cedev not covering Modu yet. -->
    <li>Modu moment</li> <!-- A meme-like reason referencing a popular internet phrase. -->
    <li>It's just the goat</li> <!-- Reason saying Modu is the "GOAT" (Greatest of All Time). -->
    <li>It's Modu, who wouldn't use it</li> <!-- A rhetorical question making Modu seem irresistible. -->
    <li>I agree with the point above</li> <!-- An agreement with the previous point, for emphasis. -->
    <li>Modu is love</li> <!-- A simple statement showing affection for Modu. -->
    <li>Modu is life</li> <!-- Another statement emphasizing the importance of Modu. -->
    <li>Modu is Modu</li> <!-- A self-referential statement, emphasizing Modu's uniqueness. -->
    <li>The best community (join it right now for free robux >>>>> <a href="https://discord.gg/VvPqNkAUU7">https://discord.gg/VvPqNkAUU7</a> <<<<<)</li> <!-- A promotional reason urging people to join the Modu community on Discord. -->
    <li>It's only existed for a month and it's already perfect</li> <!-- A statement saying Modu is already perfect even though it’s brand new. -->
    <li>Everyone is preparing to rewrite everything in modu</li> <!-- A reason suggesting that Modu is so great that everyone is switching to it. -->
    <li>Modu is almost as good as php</li> <!-- A humorous comparison saying Modu is almost as good as PHP. -->
    <li>It's not Go</li> <!-- A reason stating Modu is better because it’s not Go (a joke about not being another language). -->
    <li>It's not Java</li> <!-- Another reason saying Modu is better because it’s not Java. -->
    <li>It's not javascript</li> <!-- Another reason saying Modu is better because it’s not JavaScript. -->
    <li>It's almost as good as php (I've said this twice now)</li> <!-- Repeating the previous reason for comedic effect. -->
    <li>It's not malware</li> <!-- A reason reassuring users that Modu is not harmful software. -->
    <li>You can make malware in it</li> <!-- A joke saying Modu is powerful enough to make malware (in a humorous tone). -->
    <li>I have power in the community discord server</li> <!-- A playful boast about having power in the Modu community Discord server. -->
    <li>I abuse my power and give permissions to ping @everyone to everyone from time to time</li> <!-- A joke about misusing the power to annoy the community. -->
    <li>I can't think of any more reasons and there are still 65 I need to fill in please help.</li> <!-- A playful self-deprecating statement asking for help to complete the list. -->
    <li>Modu is the best programming language</li> <!-- A strong statement claiming Modu is the best programming language. -->
    <li>Wireless charging: Modu eliminates the need for cables and simplifies charging with its innovative wireless charging technology.</li> <!-- A joke about Modu's ability to "wirelessly charge," using humorous exaggeration. -->
    <li>Apparently you can nuke France with it (but don't tell anyone I told you that)</li> <!-- A silly and exaggerated claim about what you can do with Modu. -->
    <li>The OS library makes it even easier to remove the French language pack from your Linux system</li> <!-- Another humorous and exaggerated claim about Modu's capabilities. -->
    <li>You can learn Modu easily with <a href="https://learnmodu.org">https://learnmodu.org</a></li> <!-- A practical reason directing users to resources to learn Modu. -->
    <li>If something basic breaks in Modu and it's not your fault you get to watch Cyteon suffer as he spends days trying to fix it (nesting)</li> <!-- A funny reason about watching the creator struggle to fix bugs. -->
    <li>Modu's second package ever was made by me and it is awesome.</li> <!-- A boast about the speaker's contribution to Modu’s packages. -->
    <li>The peak-functions Modu package makes it even easier to find Fred!</li> <!-- A playful claim about a Modu package making certain tasks easier. -->
    </ol> <!-- Ends the ordered list. -->
</div> <!-- Ends the div for 'largeApplet'. -->
</div> <!-- Ends the div for 'page'. -->
</body>
</html>
