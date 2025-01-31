<?php // Opening PHP tag: this tells the server that the following code is written in PHP.
$mysqli = require_once __DIR__ . "/db.php"; // Includes the database configuration file, which connects to the database, and stores the result in the $mysqli variable to handle database interactions.
session_start(); // Starts a new session or resumes the current one, enabling access to session variables.
if (isset($_SESSION["user_id"])) { // Checks if the session variable "user_id" is set, indicating that the user is logged in.
  $sql = "SELECT admin FROM users WHERE id = {$_SESSION["user_id"]}"; // Prepares a SQL query to select the "admin" field from the "users" table where the user ID matches the session's "user_id".
  $result = $mysqli->query($sql); // Executes the SQL query against the database and stores the result in $result.
  $user = $result->fetch_assoc(); // Fetches the query result as an associative array and stores it in $user, which contains the user's admin status.
}
?> <!-- Closing PHP tag: ends the PHP block. -->

<!DOCTYPE html> <!-- Declares the document type as HTML5. -->
<html lang="en"> <!-- Starts the HTML document and specifies the language is English. -->
<head> <!-- Opens the head section of the HTML document. -->
  <meta charset="UTF-8"> <!-- Specifies that the character encoding for the document is UTF-8, supporting most characters from all languages. -->
  <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Links to the favicon (the small icon displayed in the browser tab). -->
  <title>Matei's Homepage!</title> <!-- Sets the webpage's title, which will appear in the browser tab. -->
  <meta content="a cool website all about me, Matei!" property="og:title" /> <!-- Specifies the title for Open Graph, used for social media sharing. -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" /> <!-- Provides a description for Open Graph to be displayed when shared on social media. -->
  <meta content="https://mateishome.page" property="og:url" /> <!-- Specifies the URL of the page for Open Graph. -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" /> <!-- Provides an image URL for Open Graph when the page is shared. -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" /> <!-- Defines the theme color for mobile browsers. -->
  <?php include_once __DIR__ . "/applets/style.php";?> <!-- Includes the CSS file for styles, located in the "applets" folder, to style the webpage. -->
</head> <!-- Closes the head section of the HTML document. -->
<body> <!-- Opens the body section of the HTML document. -->
<script> <!-- Starts a script block for JavaScript. -->
if ( window !== window.parent ) { // Checks if the page is loaded inside an iframe by comparing the window object to the parent window object.
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // If the page is inside an iframe, it redirects the user to another page indicating that iframes are not allowed.
      //window.location.replace("about:inducebrowsercrashforrealz"); // This is a commented-out "evil" line that would crash the browser if activated.
}
</script> <!-- Ends the script block. -->
<div class="page"> <!-- Creates a div container with the class "page" that holds the main content of the page. -->
<?php
include_once __DIR__ . "/applets/navigation_bar.php"; // Includes the navigation bar, which is stored in the "applets" folder.
?> <!-- Ends the PHP block. -->
<hr style="width: 0px;"> <!-- Draws a horizontal rule with zero width (effectively invisible) as a separator. -->
<?php
$sql = "SELECT id from blog_entries WHERE visibility = 'public' ORDER BY id DESC LIMIT 1"; // Prepares a SQL query to retrieve the ID of the most recent public blog entry.
$lastBlogPostID = $mysqli->query($sql); // Executes the SQL query against the database.
$lastBlogPostID = $lastBlogPostID->fetch_assoc(); // Fetches the result as an associative array containing the ID of the most recent public blog post.
?>
<?php
function isMinimumBlogPost($id) { // Defines a function to check if the current blog post is the first one.
  if ($id == 1) { // If the current post ID is 1 (the first post).
    echo 'Disabled'; // Outputs the word "Disabled" (which disables the "Previous" button in the navigation).
  }
}
function isMaximumBlogPost($id) { // Defines a function to check if the current blog post is the latest one.
  global $lastBlogPostID; // Accesses the global variable $lastBlogPostID, which contains the ID of the latest public blog post.
  if ($id == $lastBlogPostID['id']) { // If the current blog post ID is the same as the latest blog post ID.
    echo 'Disabled'; // Outputs the word "Disabled" (which disables the "Next" button in the navigation).
  }
}
?>
<div class="appletContainer"> <!-- Creates a div container with the class "appletContainer" to hold the navigation buttons. -->
  <a href="?id=<?php echo $_GET['id'] - 1; ?>"><button class="navigationButton<?php isMinimumBlogPost($_GET['id']); ?>"<?php isMinimumBlogPost($_GET['id']);?>>Previous</button></a> <!-- Creates a link to the previous blog post with a button. The button's class includes the result of the isMinimumBlogPost function, which disables it if the first post is being viewed. -->
  <a href="?id=<?php echo $_GET['id'] + 1; ?>"><button class="navigationButton<?php isMaximumBlogPost($_GET['id']); ?>" <?php isMaximumBlogPost($_GET['id']); ?>>Next</button></a> <!-- Creates a link to the next blog post with a button. The button's class includes the result of the isMaximumBlogPost function, which disables it if the last post is being viewed. -->
</div> <!-- Closes the div container for navigation buttons. -->
<hr style="width: 0px;"> <!-- Draws another invisible horizontal rule as a separator. -->
<?php
if ($_GET['id']) { // Checks if the 'id' parameter is present in the URL query string (i.e., a specific blog post ID has been requested).
  $sql = "SELECT * FROM blog_entries WHERE id = ?"; // Prepares a SQL query to select all fields from the "blog_entries" table where the "id" matches the provided value.
  $stmt = $mysqli->prepare($sql); // Prepares the SQL statement to be executed.
  $stmt->bind_param('i', $_GET['id']); // Binds the 'id' parameter to the prepared statement, ensuring it is treated as an integer.
  $stmt->execute(); // Executes the prepared statement.
  $blogs = $stmt->get_result(); // Fetches the result of the query.
  $blogs = $blogs->fetch_assoc(); // Fetches the result as an associative array containing the blog entry data.
  if ($blogs['visibility'] == 'public' || ($blogs['visibility'] == 'admin' && $user['admin'] == 1)) { // Checks if the blog post is public or if the user is an admin and the post is restricted to admins.
    echo '<div class="longApplet">' . '<oblique>#' . $blogs['id'] . ', published ' . $blogs['date'] . ' by ' . $blogs['author'] . '.</oblique>'; // Displays blog post ID, publication date, and author in an oblique (italic) format.
    echo '<h2>' . $blogs['title'] . '</h2>' . '<p>' . $blogs['body'] . '</p>' . '</div><br>'; // Displays the title and body of the blog post inside the div with the class "longApplet".
  } else { // If the blog post is either not public or the user is not authorized to view it.
    echo '<div class="longApplet"><h2>Oh no! An error occured.</h2><p>We couldn\'t access this blog post. You may not have the appropriate permissions, or it may have never existed it all.</p></div>'; // Displays an error message to the user indicating that the blog post couldn't be accessed.
  }
} else { // If the 'id' parameter is not set in the URL.
  echo '<div class="longApplet">Please wait, you are being redirected...</div>'; // Displays a message indicating that the user is being redirected.
  echo '<script>parent.self.location=\'blog.php?id=' . $lastBlogPostID['id'] . '\';</script>'; // Redirects the user to the most recent blog post by using JavaScript to change the page location.
}
?>

</div> <!-- Closes the div container with the class "page". -->
</body> <!-- Closes the body section of the HTML document. -->
</html> <!-- Closes the HTML document. -->
