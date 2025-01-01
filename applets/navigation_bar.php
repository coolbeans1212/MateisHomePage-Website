<div class="header" id="header">
  <div class="headerOptions">
    <div class="navigationPanelOption" id="home">
      <a href="/">
      <img src="/files/images/HouseIcon.png" alt="Home 3d render">
      Home
      </a>
    </div>
    <div class="navigationPanelOption" id="photography">
      <a href="/soonTM.php">
      <img src="/files/images/camera.png" alt="Camera 3d render">
      Photography
      </a>
    </div>
    <div class="navigationPanelOption" id="software">
      <a href="/soonTM.php">
      <img src="/files/images/MonitorIcon.png" alt="Monitor 3d render">
      Software
      </a>
    </div>
    <div class="navigationPanelOption" id="users">
      <a href="/users.php">
      <img src="/files/images/user.png" alt="User 3d render">
      Users
      </a>
    </div>
    <div class="navigationPanelOption" id="guestbook">
      <a href="/guestbook.php">
      <img src="/files/images/GuestbookIcon.png" alt="Book 3d render">
      Guestbook
      </a>
    </div>
    <div class="navigationPanelOption" id="blog">
      <a href="/blog.php">
      <img src="/files/images/BlogIcon.png" alt="Newspaper 3d render">
      Blog
      </a>
    </div>
    <div class="navigationPanelOption" id="contact">
      <a href="/contact.php">
      <img src="/files/images/MessageExclamationIcon.png" alt="Speech bubble 3d render">
      Contact
      </a>
    </div>
    <div class="navigationPanelOption" id="limbo by mindcap and more">
      <img src="/files/images/AndMore.png" alt="Limbo by Mindcap">
      More
    </div>
  </div>
  <div class="headerReactiveText" id="headerReactiveText">
  <?php
  $mysqli = require "/var/www/html/db.php";
  if (!isset($_POST["password"])) { //if this is set, it means the user is currently logging in and things will break if this tries to load
    if (isset($_SESSION["user_id"]) && (!$user['username'])) { //yeah thats right. even the HEADER has to have a database connection. take that
      $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";
      $result = $mysqli->query($sql);
      $user = $result->fetch_assoc();
    }
    if ($user) {
      echo 'You are logged in as ' . $user['username'] . '. <a href="/logout.php">Sign out here</a> or <a href="/account/customise.php">customise your account here</a>.';
    } else {
      echo 'You are not logged in! <a href="/account/login.php">Log in here</a> or <a href="/account/signup.php">sign up here</a>';
    }
  }
  ?>
  </div>
</div>
<script>
const headerReactiveText = document.getElementById('headerReactiveText');
const startingText = headerReactiveText.innerHTML;

document.getElementById('home').addEventListener('mouseover', function() {
    headerReactiveText.innerHTML = startingText;
});
document.getElementById('photography').addEventListener('mouseover', function() {
    headerReactiveText.innerHTML = 'I\'m an amatuer photographer! Look at some of my photos here.';
});
document.getElementById('software').addEventListener('mouseover', function() {
    headerReactiveText.innerHTML = 'I make software from time to time. Go here to download it or view the source code.';
});
document.getElementById('users').addEventListener('mouseover', function() {
    headerReactiveText.innerHTML = 'Where you can find the people who have signed up to my website.<?php if (!$user) {echo ' You can be here too by signing up!';}?>';
});
document.getElementById('guestbook').addEventListener('mouseover', function() {
    headerReactiveText.innerHTML = '<a href="/guestbook.php">Guestbook</a> &bull; <a href="/msgboard.php">Message board (members exclusive)</a>';
});
document.getElementById('blog').addEventListener('mouseover', function() {
    headerReactiveText.innerHTML = 'Where the site administrators or I post things about us or the website.';
});
document.getElementById('contact').addEventListener('mouseover', function() {
    headerReactiveText.innerHTML = 'Reach out to me here for any reason you like.';
});
document.getElementById('limbo by mindcap and more').addEventListener('mouseover', function() {
    headerReactiveText.innerHTML = 'Nothing here yet, sorry :(.';
});
document.getElementById('header').addEventListener('mouseleave', function() {
    headerReactiveText.innerHTML = startingText;
});
</script>