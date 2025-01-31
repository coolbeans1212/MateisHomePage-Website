<?php  // This opens the PHP code block

$mysqli = require_once "/var/www/html/db.php";  // Includes the database connection file and assigns the connection to $mysqli variable
session_start();  // Starts a session or resumes an existing session. This is required to manage user data across multiple pages.

if (isset($_SESSION["user_id"])) {  // Checks if the "user_id" session variable is set (i.e., the user is logged in)
  $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";  // Prepares a SQL query to fetch all user details based on the "user_id" session variable
  $result = $mysqli->query($sql);  // Executes the SQL query and stores the result in $result
  $user = $result->fetch_assoc();  // Fetches the result as an associative array, which is stored in $user (contains user data like username, profile picture, etc.)
} else {  // If the "user_id" session variable is not set (i.e., the user is not logged in)
    header("Location: https://mateishome.page/account/login.php");  // Redirects the user to the login page
}

?>  <!-- Closes the PHP block -->

<!DOCTYPE html>  <!-- Declares the document type as HTML5 -->
<html lang="en">  <!-- Opens an HTML document with the language set to English -->
<head>  <!-- Opens the head section of the HTML document -->
  <meta charset="UTF-8">  <!-- Specifies the character encoding to be UTF-8 (allows special characters) -->
  <link rel="icon" href="favicon.ico" type="image/x-icon">  <!-- Sets the website's favicon (icon shown in browser tabs) -->
  <title>Matei's Homepage!</title>  <!-- Sets the title of the webpage that appears in the browser tab -->
  <meta content="a cool website all about me, Matei!" property="og:title" />  <!-- Open Graph metadata for social media sharing (title) -->
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" />  <!-- Open Graph metadata for social media sharing (description) -->
  <meta content="https://mateishome.page" property="og:url" />  <!-- Open Graph metadata for social media sharing (URL) -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" />  <!-- Open Graph metadata for social media sharing (image) -->
  <meta content="#24589E" data-react-helmet="true" name="theme-color" />  <!-- Specifies the theme color of the website for mobile browsers -->
  <?php include_once __DIR__ . "/../applets/style.php";?>  <!-- Includes the "style.php" file from a parent directory to apply styles to the page -->
</head>  <!-- Closes the head section -->

<body>  <!-- Opens the body section of the HTML document -->
<script>  <!-- Begins JavaScript block -->
if ( window !== window.parent )  // Checks if the page is inside an iframe (window !== window.parent means it is inside an iframe)
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html");  // Redirects the user to a special page if the page is inside an iframe
      //window.location.replace("about:inducebrowsercrashforrealz");  // (Commented out) This would be an "evil" line that could cause browser issues if enabled
}
</script>  <!-- Ends the script block -->

<div class="page">  <!-- Begins the main content of the page -->
<?php
include_once __DIR__ . "/../applets/navigation_bar.php";  // Includes the navigation bar from the "navigation_bar.php" file in a parent directory
?>  <!-- Closes the PHP block for the navigation bar inclusion -->

<br>  <!-- Adds a line break -->

<div class="largeApplet" style="display: flex;">  <!-- Creates a div with a class "largeApplet" and sets its display to flex (to organize elements horizontally) -->
    <div style="text-align: center;">  <!-- Creates a div with center-aligned text -->
    <img onerror="this.onerror=null; this.src='/files/images/pfps/error.png'" class="pfpLarge" src="  <!-- Displays the user's profile picture, with error handling to display a fallback image if the image doesn't load properly -->
    <?php
    if (isset($user['pfp']) && $user['pfp'] > 100) {  // Checks if the user has a profile picture (pfp) and if its ID is greater than 100
        echo 'https://assetdelivery.roblox.com/v1/asset/?id=' . htmlspecialchars($user['pfp']);  // If the pfp ID is valid, fetches the profile picture from Roblox's asset delivery server
    } elseif ($user['pfp'] < 100) {  // If the pfp ID is less than 100
        echo '/files/images/pfps/' . htmlspecialchars($user['pfp']) . '.png';  // Displays the user's profile picture from the local server
    } else {  // If no valid pfp ID is found
        echo '/files/images/pfps/error.png';  // Displays an error image as a fallback
    }
    ?>" alt="Your profile">  <!-- Closes the image tag with the dynamically selected source (src) and alt text -->
    <div>  <!-- Begins a new div container -->
        <form action="customisationProcessing.php" method="GET">  <!-- Begins a form that sends data to "customisationProcessing.php" using GET method -->
            <label for="pfp">ROBLOX Image ID:</label><br>  <!-- Label for the input field that allows setting a new Roblox profile picture -->
            <input type="text" id="image" name="image" value="<?php echo $user['pfp'] ?>"><br>  <!-- Text input field for entering the new Roblox Image ID, pre-filled with the current pfp ID -->
            <input type="hidden" name="type" id="type" value="profileImage">  <!-- Hidden input that indicates the type of customization (profile image) -->
            <input type="submit" value="Submit"><br>  <!-- Submit button to submit the form -->
        </form>
            OR<br>  <!-- Adds a line break with the text "OR" -->
            <form action="presetImageSelection.php">  <!-- Form to allow the user to select a preset profile picture from another page -->
            <input type="submit" value="Use preset image">  <!-- Submit button to navigate to the preset image selection page -->
            </form>
        </div>
    </div>
    <div style="margin: 5px;">  <!-- Creates a div with a margin of 5px -->
        <div style="display: flex; flex-direction: column;">  <!-- Creates a flex container with vertical layout -->
            <?php echo '<span class="username">' . $user['username'] . '</span>' ?>  <!-- Displays the user's username in a span element -->
            <div style="display: flex">  <!-- Creates a flex container for additional options -->
                <div style="margin-right: 15px;">  <!-- Adds a margin of 15px to the right of this div -->
                    <form action="customisationProcessing.php" method="GET">  <!-- Form to submit a custom status (short bio) to the server -->
                        <label for="status">Set a custom status:</label><br>  <!-- Label for the custom status input -->
                        <input type="text" id="status" name="status" value="<?php echo $user['shortbio'] ?>" style="width: 300px;" maxlength="50">  <!-- Text input field for setting a custom status, pre-filled with the current status -->
                        <input type="hidden" name="type" id="type" value="customStatus"><br>  <!-- Hidden input to indicate the action type (custom status) -->
                        <input type="submit" value="Submit" style="margin-left: 0px;">  <!-- Submit button to submit the custom status form -->
                    </form>
                    <form action="customisationProcessing.php" method="GET">  <!-- Another form to submit a description -->
                        <label for="status">Describe yourself:</label><br>  <!-- Label for the description input -->
                        <textarea id="description" name="description" maxlength="5000"><?php echo $user['bigdescription']; ?></textarea>  <!-- Textarea input for the user to write a description, pre-filled with the current description -->
                        <input type="hidden" name="type" id="type" value="description">  <!-- Hidden input to indicate the action type (description) -->
                        <input type="submit" value="Submit" style="margin-left: 0px;">  <!-- Submit button to submit the description form -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>  <!-- Closes the page div -->
</body>  <!-- Closes the body section of the document -->
</html>  <!-- Closes the HTML document -->
