<?php
// Starting a session. This allows access to session variables, which can be used to store user data across different pages.
session_start(); // Starts a PHP session to maintain user-specific information across pages

// The following line includes and executes the file 'db.php' located in the same directory. 
// It establishes a connection to the database using the returned value and stores it in the variable $mysqli.
$mysqli = require_once __DIR__ . "/db.php"; // Includes the db.php file and assigns the database connection to $mysqli

// This line checks if a session variable "user_id" is set, which would indicate that a user is logged in.
if (isset($_SESSION["user_id"])) { // Checks if the user is logged in by verifying the presence of the "user_id" session variable
  // If the user is logged in, this SQL query selects the "username" from the "users" table where the user's "id" matches the session "user_id".
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}"; // Prepares a SQL query to fetch the username for the logged-in user
  // Executes the SQL query and stores the result in the $result variable.
  $result = $mysqli->query($sql); // Executes the query to fetch user information from the database
  // Fetches the result of the query as an associative array, storing it in the $user variable.
  $user = $result->fetch_assoc(); // Fetches the username from the query result and stores it in the $user array
}

// This SQL query selects all columns from the "blog_entries" table where the "visibility" is 'public'.
// It orders the blog entries by "id" in descending order and limits the result to 1 entry.
$sql = "SELECT * FROM blog_entries WHERE visibility = 'public' ORDER BY id DESC LIMIT 1"; // Prepares a SQL query to fetch the latest public blog entry
// Prepares the SQL query for execution, and stores the prepared statement in $stmt.
$stmt = $mysqli->prepare($sql); // Prepares the SQL query to be executed safely
// Executes the prepared statement.
$stmt->execute(); // Executes the prepared statement
// Gets the result set from the executed statement.
$blog = $stmt->get_result(); // Retrieves the result of the query execution
// Fetches the result as an associative array and stores it in the $blog variable.
$blog = $blog->fetch_assoc(); // Fetches the latest blog entry data into $blog array
?>

<!DOCTYPE html> 
<!-- Declares that this document is an HTML5 document -->
<html lang="en">
<head>
  <meta charset="UTF-8"> 
  <!-- Specifies the character encoding for the HTML document (UTF-8) -->
  <link rel="icon" href="favicon.ico" type="image/x-icon"> 
  <!-- Sets the website's favicon (the little icon in the browser tab) -->
  <title>Matei's Homepage!</title> 
  <!-- Sets the title of the webpage, which appears on the browser tab -->
  <meta content="a cool website all about me, Matei!" property="og:title" /> 
  <!-- Open Graph metadata for the title, used when sharing the page on social media -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" /> 
  <!-- Open Graph description used for social media sharing -->
  <meta content="https://mateishome.page" property="og:url" /> 
  <!-- URL of the page to be shared in social media -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" /> 
  <!-- Image shown when sharing the page on social media -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" /> 
  <!-- Defines the color for the browser’s theme (used in mobile browsers) -->
  <?php include_once __DIR__ . "/applets/style.php";?> 
  <!-- Includes the "style.php" file (most likely for styles or CSS) from the "applets" folder -->
</head>
<body>
<script>
  // The following JavaScript code checks if the page is inside an iframe (it is being embedded in another page)
  if ( window !== window.parent ) 
  { 
      // If the page is in an iframe, this line redirects the page to a different URL to prevent embedding
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); 
      //window.location.replace("about:inducebrowsercrashforrealz"); // EVIL The page is in an iframe
  }

  // If the current page URL matches 'https://eatmoreram.com/', it redirects to a different URL.
  if (window.location.href == 'https://eatmoreram.com/') { 
    window.location.replace("https://eatmoreram.com/top100modureasons.php"); 
  }
</script>

<div class="page"> 
  <!-- This div container holds the main page content -->
  <?php
  include_once __DIR__ . "/applets/navigation_bar.php"; // Includes the navigation bar from the "applets" folder
  ?>
  <br>
  <div class="largeApplet"> 
    <!-- This div container holds a large applet (probably a main content box) -->
    <h1><span id="datetime">Good day, </span> 
      <script defer>
        // This script gets the current time of the user and greets them based on the hour of the day.
        var now = new Date(); 
        var hour = now.getHours(); 
        console.log(hour); // Logs the current hour to the console for debugging
        if (hour >= 17) {
          document.getElementById('datetime').innerHTML = 'Good evening, '; // Changes the greeting to 'Good evening'
        } else if (hour >= 12) {
          document.getElementById('datetime').innerHTML = 'Good afternoon, '; // Changes the greeting to 'Good afternoon'
        } else {
          document.getElementById('datetime').innerHTML = 'Good morning, '; // Changes the greeting to 'Good morning'
        }
      </script>
    <?php
    // If the user is logged in, show their username; otherwise, show 'guest.'
    if ($user) { 
      echo $user['username'] . '.'; 
    } else {
      echo 'guest.'; 
    }
    ?>
    </h1>
    <!-- More content follows... -->
    Welcome to my website! This page was redesigned in December 2024 for its 1-year anniversary...
  </div>
  <br>
  <div class="appletContainer">
    <!-- This div container holds several smaller applets (mini sections) -->
    <a href="blog.php" class="smallApplet" style="background: url('/files/images/blog_applet_background.png') no-repeat 0px 0px; background-size: cover;">
      <div>
        <h2>Latest blog entry:</h2> <?php echo $blog['title']; ?><br>
        <!-- Displays the latest blog entry's title -->
        <span class="miniText"><?php echo htmlspecialchars(substr($blog['body'], 0, 150)) . '...';?></span><br>
        <!-- Displays the first 150 characters of the blog post body (and escapes HTML characters to prevent XSS) -->
        <span>Posted by <?php echo $blog['author'];?> on <?php echo $blog['date'];?></span>
        <!-- Displays who wrote the post and the date it was posted -->
      </div>
    </a>
    <div class="smallApplet" style="background: url('/files/images/website_health_applet_background.png') no-repeat 0px 0px; background-size: cover;">
      <h2>Website health:</h2>
      Uptime:
      <?php // Retrieves the system uptime and calculates it in days, hours, and minutes
      $uptime = shell_exec('cat /proc/uptime | awk \'{print int($1)}\'');
      echo floor($uptime / 86400) . ' days, ' . floor($uptime / 3600 % 24) . ' hours, ' . floor($uptime / 60 % 60) . ' minutes.';
      ?>
      Packages installed:
      <?php // Counts and displays the number of installed packages on the server
      $packages = shell_exec('dpkg --get-selections'); // Executes a shell command to get the installed packages
      echo substr_count($packages, 'install');
      ?><br>
      System memory:
      <?php // Retrieves and processes memory usage information
      $freemem = shell_exec('free'); // Executes the 'free' command to get memory usage
      $freemem2 = preg_split("/\r\n|\n|\r/", $freemem); // Splits the command output by line breaks
      $important_line = $freemem2[1]; // Selects the line containing memory information
      $memory_parts = preg_split('/\s+/', trim($important_line)); // Splits the line into separate parts (e.g., total memory, free memory)
      echo $memory_parts[3] . ' / ' . $memory_parts[1];
      ?><br>
      Storage:
      <?php // Retrieves and processes disk space information
      $diskspace = shell_exec('df -T /');
      $diskspacebutseperated = preg_split("/\r\n|\n|\r/", $diskspace); 
      $diskspaceimportantline = $diskspacebutseperated[1]; 
      $thedisk = preg_split('/\s+/', trim($diskspaceimportantline));
      $totaldisk = $thedisk[4] + $thedisk[3];
      echo $thedisk[4] . ' / ' . $totaldisk . ' (' . $thedisk[5] . ')';
      ?>
    </div>
    <div class="smallApplet" style="background: url('/files/images/daily_quote_applet_background.png') no-repeat 0px 0px; background-size: cover;">
      <h2>Quote of the day:</h2>
      <?php
      echo date('F jS, Y') . '\'s quote is:<br>\'';
      // Uses an external API to get the daily quote and display it.
      echo file_get_contents('https://mateishome.page/api/getMHPQuote.php?type=plaintext') . '\'';
      ?>
    </div>
  </div>
  <br>
  <div class="largeApplet">
    <h1>Quick Links</h1>
    <!-- Following content defines links to different sections of the website and external resources. -->
  </div>
</div>
</div>
</body>
</html>
