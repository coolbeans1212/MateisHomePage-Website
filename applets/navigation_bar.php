<div class="header" id="header"> <!-- This starts a div element with the class "header" and ID "header". It likely represents the header section of the webpage. -->
  <div class="headerOptions"> <!-- This starts a div container for the navigation options inside the header. -->
    <div class="navigationPanelOption" id="home"> <!-- This creates a navigation option with the class "navigationPanelOption" and ID "home". -->
      <a href="https://mateishome.page/"> <!-- This creates a hyperlink pointing to the homepage. -->
      <img src="/files/images/HouseIcon.png" alt="Home 3d render"> <!-- This displays an image (a 3D house icon) for the "Home" link. -->
      Home <!-- This is the text displayed next to the image. -->
      </a> <!-- This closes the anchor tag. -->
    </div> <!-- This closes the "home" div. -->
    <div class="navigationPanelOption" id="photography"> <!-- This creates a navigation option for the "Photography" section with ID "photography". -->
      <a href="/soonTM.php"> <!-- This creates a hyperlink pointing to "/soonTM.php" (a placeholder page). -->
      <img src="/files/images/camera.png" alt="Camera 3d render"> <!-- This displays an image (a 3D camera icon) for the "Photography" link. -->
      Photography <!-- This is the text displayed next to the image. -->
      </a> <!-- This closes the anchor tag. -->
    </div> <!-- This closes the "photography" div. -->
    <div class="navigationPanelOption" id="software"> <!-- This creates a navigation option for the "Software" section with ID "software". -->
      <a href="/soonTM.php"> <!-- This creates a hyperlink pointing to "/soonTM.php". -->
      <img src="/files/images/MonitorIcon.png" alt="Monitor 3d render"> <!-- This displays an image (a 3D monitor icon) for the "Software" link. -->
      Software <!-- This is the text displayed next to the image. -->
      </a> <!-- This closes the anchor tag. -->
    </div> <!-- This closes the "software" div. -->
    <div class="navigationPanelOption" id="users"> <!-- This creates a navigation option for the "Users" section with ID "users". -->
      <a href="/users.php"> <!-- This creates a hyperlink pointing to the "users.php" page. -->
      <img src="/files/images/user.png" alt="User 3d render"> <!-- This displays an image (a 3D user icon) for the "Users" link. -->
      Users <!-- This is the text displayed next to the image. -->
      </a> <!-- This closes the anchor tag. -->
    </div> <!-- This closes the "users" div. -->
    <div class="navigationPanelOption" id="guestbook"> <!-- This creates a navigation option for the "Guestbook" section with ID "guestbook". -->
      <?php if(!$user): ?> <!-- This PHP block checks if the $user variable is not set (i.e., the user is not logged in). -->
      <a href="/guestbook.php"> <!-- This creates a hyperlink pointing to the guestbook page for users who aren't logged in. -->
      <img src="/files/images/GuestbookIcon.png" alt="Book 3d render"> <!-- This displays an image (a 3D guestbook icon) for the guestbook link. -->
      Guestbook <!-- This is the text displayed next to the image. -->
      </a> <!-- This closes the anchor tag. -->
      <?php else: ?> <!-- If the user is logged in, the following block will be executed instead. -->
        <a href="/msgboard.php"> <!-- This creates a hyperlink pointing to the message board page for logged-in users. -->
      <img src="/files/images/GuestbookIcon.png" alt="Book 3d render"> <!-- This displays the same guestbook icon, but this time for the message board link. -->
      Msg Board <!-- This is the text displayed next to the image, indicating a message board link. -->
      </a> <!-- This closes the anchor tag. -->
      <?php endif; ?> <!-- This ends the PHP conditional block. -->
    </div> <!-- This closes the "guestbook" div. -->
    <div class="navigationPanelOption" id="blog"> <!-- This creates a navigation option for the "Blog" section with ID "blog". -->
      <a href="/blog.php"> <!-- This creates a hyperlink pointing to the "blog.php" page. -->
      <img src="/files/images/BlogIcon.png" alt="Newspaper 3d render"> <!-- This displays an image (a 3D blog icon) for the "Blog" link. -->
      Blog <!-- This is the text displayed next to the image. -->
      </a> <!-- This closes the anchor tag. -->
    </div> <!-- This closes the "blog" div. -->
    <div class="navigationPanelOption" id="contact"> <!-- This creates a navigation option for the "Contact" section with ID "contact". -->
      <a href="/contact.php"> <!-- This creates a hyperlink pointing to the "contact.php" page. -->
      <img src="/files/images/MessageExclamationIcon.png" alt="Speech bubble 3d render"> <!-- This displays an image (a 3D message icon) for the "Contact" link. -->
      Contact <!-- This is the text displayed next to the image. -->
      </a> <!-- This closes the anchor tag. -->
    </div> <!-- This closes the "contact" div. -->
    <div class="navigationPanelOption" id="limbo-by-mindcap-and-more"> <!-- This creates a navigation option with ID "limbo-by-mindcap-and-more", likely representing additional options. -->
      <img src="/files/images/AndMore.png" alt="Limbo by Mindcap"> <!-- This displays an image (representing something called "Limbo by Mindcap" or more options). -->
      More <!-- This is the text displayed next to the image. -->
    </div> <!-- This closes the "limbo-by-mindcap-and-more" div. -->
  </div> <!-- This closes the "headerOptions" div, which contains all navigation options. -->
  <div class="headerReactiveText" id="headerReactiveText"> <!-- This creates a div that holds reactive text, with the ID "headerReactiveText". This text will change based on user interactions. -->
  <?php
  session_start(); // Starts the session to access session variables.
  $mysqli = require "/var/www/html/db.php"; // This requires the database connection script and assigns the connection to the $mysqli variable.
  if (isset($_SESSION["user_id"])) { // Checks if the user is logged in by looking for the "user_id" in the session.
    $stmt = $mysqli->prepare("SELECT * FROM users WHERE id = ?"); // Prepares an SQL query to select all columns from the "users" table where the ID matches the session's "user_id".
    $stmt->bind_param("i", $_SESSION["user_id"]); // Binds the session "user_id" as an integer to the prepared statement.
    $stmt->execute(); // Executes the prepared SQL query.
    $result = $stmt->get_result(); // Fetches the result of the executed query.
    $user = $result->fetch_assoc(); // Fetches the associative array of the user data and assigns it to $user.
  }
  if (!isset($_POST["password"])) { // Checks if the "password" field is not set, which indicates the user is not logging in.
    if ($user) { // If a user is logged in (i.e., $user is set), this block displays a personalized message.
      echo 'You are logged in as ' . $user['username'] . '. <a href="/logout.php">Sign out here</a> or <a href="/account/customise.php">customise your account here</a>.';
    } else { // If the user is not logged in, this block displays a message with login and signup options.
      echo 'You are not logged in! <a href="/account/login.php">Log in here</a> or <a href="/account/signup.php">sign up here</a>';
    }
  }
  ?>
  </div> <!-- This closes the div containing the dynamic header text based on the session. -->
</div> <!-- This closes the header div. -->

<script> <!-- This starts the script block for JavaScript code. -->
const headerReactiveText = document.getElementById('headerReactiveText'); // This grabs the element with the ID "headerReactiveText" and stores it in a variable.
const startingText = headerReactiveText.innerHTML; // This stores the initial HTML content of the "headerReactiveText" element into a variable. This is the default text shown in the header.

const home = document.getElementById('home'); // This grabs the element with the ID "home" (the home navigation option).
const photography = document.getElementById('photography'); // This grabs the element with the ID "photography" (the photography navigation option).
const software = document.getElementById('software'); // This grabs the element with the ID "software" (the software navigation option).
const users = document.getElementById('users'); // This grabs the element with the ID "users" (the users navigation option).
const guestbook = document.getElementById('guestbook'); // This grabs the element with the ID "guestbook" (the guestbook navigation option).
const blog = document.getElementById('blog'); // This grabs the element with the ID "blog" (the blog navigation option).
const contact = document.getElementById('contact'); // This grabs the element with the ID "contact" (the contact navigation option).
const limboByMindcapAndMore = document.getElementById('limbo-by-mindcap-and-more'); // This grabs the element with the ID "limbo-by-mindcap-and-more" (the "more" navigation option).
const header = document.getElementById('header'); // This grabs the element with the ID "header" (the header container).

home.addEventListener('mouseover', function() { // This adds an event listener that triggers when the mouse hovers over the "home" element.
    headerReactiveText.innerHTML = startingText; // When hovered, it resets the header text to the default starting text.
});
document.getElementById('photography').addEventListener('mouseover', function() { // This adds an event listener for the "photography" option hover.
    headerReactiveText.innerHTML = 'I\'m an amatuer photographer! Look at some of my photos here.'; // This updates the header text when hovering over "photography".
});
document.getElementById('software').addEventListener('mouseover', function() { // This adds an event listener for the "software" option hover.
    headerReactiveText.innerHTML = 'I make software from time to time. Go here to download it or view the source code.'; // This updates the header text when hovering over "software".
});
document.getElementById('users').addEventListener('mouseover', function() { // This adds an event listener for the "users" option hover.
    headerReactiveText.innerHTML = 'Where you can find the people who have signed up to my website.<?php if (!$user) {echo ' You can be here too by signing up!';}?>'; // Updates header text dynamically for the "users" link. If the user is not logged in, it invites them to sign up.
});
document.getElementById('guestbook').addEventListener('mouseover', function() { // This adds an event listener for the "guestbook" option hover.
    headerReactiveText.innerHTML = '<a href="/guestbook.php">Guestbook</a> &bull; <a href="/msgboard.php">Message board (members exclusive)</a>'; // This updates the header text with links for the guestbook and message board.
});
document.getElementById('blog').addEventListener('mouseover', function() { // This adds an event listener for the "blog" option hover.
    headerReactiveText.innerHTML = 'Where the site administrators or I post things about us or the website.'; // This updates the header text when hovering over "blog".
});
document.getElementById('contact').addEventListener('mouseover', function() { // This adds an event listener for the "contact" option hover.
    headerReactiveText.innerHTML = 'Reach out to me here for any reason you like.'; // This updates the header text when hovering over "contact".
});
document.getElementById('limbo-by-mindcap-and-more').addEventListener('mouseover', function() { // This adds an event listener for the "more" option hover.
    headerReactiveText.innerHTML = 'Nothing here yet, sorry :('.; // This updates the header text with a "nothing here yet" message when hovering over "more".
});
document.getElementById('header').addEventListener('mouseleave', function() { // This adds an event listener that triggers when the mouse leaves the header.
    headerReactiveText.innerHTML = startingText; // This resets the header text to the default starting text when the mouse leaves the header.
});
</script> <!-- This closes the script block. -->
