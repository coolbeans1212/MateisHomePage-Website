<?php // Beginning of PHP block

$mysqli = require_once __DIR__ . "/db.php"; // Line 1: Loads the database connection from db.php and assigns the resulting object to the $mysqli variable. 'require_once' ensures the file is included only once, and '__DIR__' refers to the current directory of the script.

session_start(); // Line 2: Starts or resumes the current session, allowing you to store and retrieve session data.

if (isset($_SESSION["user_id"])) { // Line 3: Checks if the session variable "user_id" is set. If it is, the block of code inside will execute.

  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}"; // Line 4: Constructs a SQL query to select the "username" from the "users" table, where the "id" matches the session's user ID.

  $result = $mysqli->query($sql); // Line 5: Executes the SQL query using the $mysqli object (the database connection), and stores the result in the $result variable.

  $user = $result->fetch_assoc(); // Line 6: Fetches a single row from the query result as an associative array, and stores it in the $user variable.

} // Line 7: Closes the 'if' block.

?> // End of PHP code block

<!DOCTYPE html> <!-- Line 8: This declares the document type and version (HTML5 in this case). It tells the browser how to interpret the HTML structure. -->

<html lang="en"> <!-- Line 9: Starts the HTML document, setting the language of the document to English (en). -->

<head> <!-- Line 10: The head section of the HTML document starts here. This section contains metadata, title, and external links for the document. -->
  <meta charset="UTF-8"> <!-- Line 11: Specifies the character encoding as UTF-8 (supports a wide range of characters). -->
  <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Line 12: Defines the favicon (the small icon shown in the browser tab) using the "favicon.ico" file. -->
  <title>Matei's Homepage!</title> <!-- Line 13: Sets the title of the web page, which appears in the browser tab. -->
  <meta content="a cool website all about me, Matei!" property="og:title" /> <!-- Line 14: Open Graph metadata specifying the title of the page for social media sharing. -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" /> <!-- Line 15: Open Graph metadata describing the website for social media sharing. -->
  <meta content="https://mateishome.page" property="og:url" /> <!-- Line 16: Open Graph metadata specifying the URL of the website for social media sharing. -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" /> <!-- Line 17: Open Graph metadata specifying an image to display when shared on social media. -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" /> <!-- Line 18: Specifies the theme color for the browser (used in mobile browsers to color the address bar). -->
  <?php include_once __DIR__ . "/applets/style.php";?> <!-- Line 19: Includes the "style.php" file from the "applets" directory for additional styles. The 'include_once' ensures it’s included only once. -->
</head> <!-- Line 20: Closing the <head> tag. -->

<body> <!-- Line 21: Starts the body of the HTML document, where the visible content is displayed. -->
<script> <!-- Line 22: Starts the JavaScript block. -->
if ( window !== window.parent ) // Line 23: Checks if the current window is inside an iframe (the current window object is different from its parent window). If it is inside an iframe, the code will execute.
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // Line 24: Redirects the browser to a different page if the current page is in an iframe.
      //window.location.replace("about:inducebrowsercrashforrealz"); // Line 25: Commented-out line that would force the browser to crash (evil example).
}
</script> <!-- Line 26: Closes the <script> tag. -->
<div class="page"> <!-- Line 27: Starts a <div> element with the class "page", a container for page content. -->
<?php
include_once __DIR__ . "/applets/navigation_bar.php"; // Line 28: Includes the navigation bar from "navigation_bar.php" in the "applets" directory. The 'include_once' ensures it's included only once.
?> <!-- Line 29: PHP closing tag. -->
<br> <!-- Line 30: Line break for spacing. -->
<div class="appletContainer"> <!-- Line 31: Starts a container <div> with the class "appletContainer". -->
  <a href="users.php?offset=<?php if($_GET['offset'] < 6) { echo '0';} else { echo $_GET['offset'] - 6;} ?>&search=<?php echo $_GET['search'] ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Previous</button></a> <!-- Line 32: Creates a "Previous" button. The 'href' dynamically calculates the offset value for pagination, and the button uses a class "navigationButton". -->
  <div class="mediumApplet" style="text-align: center; margin: auto;"> <!-- Line 33: Creates a <div> with the class "mediumApplet", centering the text and content. -->
    <h1>Users</h1> <!-- Line 34: Displays a heading (H1) with the text "Users". -->
    <form method="get"> <!-- Line 35: Starts a form with the GET method, which sends data via the URL (query string). -->
      <label for="search">Search by username:</label><br> <!-- Line 36: Label for the search input field. -->
      <input type="text" id="search" name="search" placeholder="admin" value="<?php echo $_GET['search']; ?>"> <!-- Line 37: Input field for the search query. The 'value' attribute populates it with the current search term if available. -->
      <input type="submit"> <!-- Line 38: Submit button for the search form. -->
    </form> <!-- Line 39: Ends the form tag. -->
  </div> <!-- Line 40: Closing the "mediumApplet" div. -->
  <a href="users.php?offset=<?php echo $_GET['offset'] + 6; ?>&search=<?php echo $_GET['search'] ?>" style="margin-top: auto; margin-bottom: auto;"><button style="margin: 0px;" class="navigationButton">Next</button></a> <!-- Line 41: Creates a "Next" button for pagination. -->
</div> <!-- Line 42: Closing the "appletContainer" div. -->
<?php // Line 43: Comment explaining that part of the code was stolen from "guestbook.php". 
$offset = (int) $_GET['offset']; // Line 44: Retrieves and casts the 'offset' value from the URL query string to an integer for pagination.
$search = $_GET['search']; // Line 45: Retrieves the 'search' value from the query string (username search term).
$searchParameter = "%$search%"; // Line 46: Prepares the search term to be used in a SQL query, wrapping it in wildcards to perform a partial match in the database.

require '/var/www/html/db.php'; // Line 47: Requires the database connection again, probably because the previous connection might have been lost after including the HTML content.

if ($offset) { // Line 48: Checks if the offset is set (not zero or false).
  if($search) { // Line 49: Checks if a search term is provided.
    $sql = "SELECT * FROM users WHERE username LIKE ? ORDER BY CHAR_LENGTH(`username`) LIMIT 6 OFFSET ?"; // Line 50: Prepares a SQL query that selects users whose username matches the search term, ordered by username length, with pagination.
    $stmt = $mysqli->prepare($sql); // Line 51: Prepares the SQL statement for execution.
    $stmt->bind_param('si', $searchParameter, $offset); // Line 52: Binds the search parameter and offset to the SQL statement (s for string, i for integer).
    $stmt->execute(); // Line 53: Executes the prepared statement.
    $result = $stmt->get_result(); // Line 54: Retrieves the result of the query.
  } else { // Line 55: If no search term is provided...
    $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 6 OFFSET ?"; // Line 56: SQL query to get the latest 6 users with pagination.
    $stmt = $mysqli->prepare($sql); // Line 57: Prepares the SQL statement.
    $stmt->bind_param('i', $offset); // Line 58: Binds the offset to the SQL statement (i for integer).
    $stmt->execute(); // Line 59: Executes the query.
    $result = $stmt->get_result(); // Line 60: Retrieves the result set.
  }
} else { // Line 61: If offset is not set...
  if($search) { // Line 62: If there’s a search term...
    $sql = "SELECT * FROM users WHERE username LIKE ? ORDER BY CHAR_LENGTH(`username`) LIMIT 6"; // Line 63: SQL query for users with a matching username and pagination.
    $stmt = $mysqli->prepare($sql); // Line 64: Prepares the SQL statement.
    $stmt->bind_param('s', $searchParameter); // Line 65: Binds the search parameter to the SQL statement.
    $stmt->execute(); // Line 66: Executes the SQL query.
    $result = $stmt->get_result(); // Line 67: Retrieves the result.
  } else { // Line 68: If no search term...
    $sql = "SELECT * FROM users ORDER BY id DESC LIMIT 6"; // Line 69: SQL query to fetch the latest 6 users without pagination.
    $result = $mysqli->query($sql); // Line 70: Executes the query directly.
  }
}

require_once '/var/www/html/api/internalFunctions.php'; // Line 71: Includes a PHP file that might contain additional functions for internal use.

if (mysqli_num_rows($result) > 0) { // Line 72: Checks if any results were returned.
  while ($row = mysqli_fetch_assoc($result)) { // Line 73: Loops through each row in the result set.
      echo '<br>'; // Line 74: Outputs a line break for spacing.
      echo '<div class="largeApplet" style="display: flex;">'; // Line 75: Starts a <div> for displaying the user's information with flexbox styling.
      echo '<img onerror="this.onerror=null; this.src=\'/files/images/pfps/error.png\'" src="' . getPfpFromUsername($row['username']) . '" class="pfpLarge" alt="profile" style="height: 120px; width: 120px;">'; // Line 76: Displays the user's profile picture, using a fallback image in case of an error.
      echo '<div style="margin-left: 10px; display: flex; flex-direction: column; position: relative;">'; // Line 77: Starts another <div> for the user's details, with margin and flex styling.
      echo '<div style="display: flex; justify-content: space-between; width: 910px;">'; // Line 78: Creates a row with space between the username and user ID.
      echo '<span class="username" style="overflow: visible;">' . htmlspecialchars($row['username']) . '</span>'; // Line 79: Displays the username, sanitized for HTML output.
      echo '<oblique>#' . htmlspecialchars($row['id']) . '</oblique>'; // Line 80: Displays the user ID, in an oblique (italicized) style.
      echo '</div>'; // Line 81: Closes the inner div.
      echo '<span>' . htmlspecialchars($row['shortbio']) . '</span>'; // Line 82: Displays the user's short bio.
      echo '<span style="position: absolute; bottom: 0; width: 750px;">' . htmlspecialchars($row['username']) . ' signed up on ' . htmlspecialchars($row['date_created']) . '</span>'; // Line 83: Displays the user’s sign-up date.
      echo '</div></div>'; // Line 84: Closes the divs.
  }
}

?>
</div> <!-- Line 85: Closes the "page" div. -->
</body> <!-- Line 86: Closing the <body> tag. -->
</html> <!-- Line 87: Closing the <html> tag, marking the end of the document. -->
