<?php
$mysqli = require_once __DIR__ . "/db.php";
session_start();
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT admin FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <title>Matei's Homepage!</title>
  <meta content="a cool website all about me, Matei!" property="og:title" />
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" />
  <meta content="https://mateishome.page" property="og:url" />
  <meta content="https://mateishome.page/welcome.gif" property="og:image" />
  <meta content="#24589E" data-react-helmet="true" name="theme-color" />
  <?php include_once __DIR__ . "/applets/style.php";?>
</head>
<body>
<script>
if ( window !== window.parent )
{
      window.location.replace("https://mateishome.page/dontputmeinaniframe!.html"); // The page is in an iframe
      //window.location.replace("about:inducebrowsercrashforrealz"); // EVIL The page is in an iframe

}
</script>
<div class="page">
<?php
include_once __DIR__ . "/applets/navigation_bar.php"; // :3
?>
<hr style="width: 0px;">
<?php
$sql = "SELECT id from blog_entries WHERE visibility = 'public' ORDER BY id DESC LIMIT 1";
$lastBlogPostID = $mysqli->query($sql);
$lastBlogPostID = $lastBlogPostID->fetch_assoc();
?>
<?php
function isMinimumBlogPost($id) {
  if ($id == 1) {
    echo 'Disabled';
  }
}
function isMaximumBlogPost($id) {
  global $lastBlogPostID;
  if ($id == $lastBlogPostID['id']) {
    echo 'Disabled';
  }
}
?>
<div class="appletContainer">
  <a href="?id=<?php echo $_GET['id'] - 1; ?>"><button class="navigationButton<?php isMinimumBlogPost($_GET['id']); ?>"<?php isMinimumBlogPost($_GET['id']);?>>Previous</button></a> <a href="?id=<?php echo $_GET['id'] + 1; ?>"><button class="navigationButton<?php isMaximumBlogPost($_GET['id']); ?>" <?php isMaximumBlogPost($_GET['id']); ?>>Next</button></a>
</div>
<hr style="width: 0px;">
<?php
if ($_GET['id']) {
  $sql = "SELECT * FROM blog_entries WHERE id = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('i', $_GET['id']);
  $stmt->execute();
  $blogs = $stmt->get_result();
  $blogs = $blogs->fetch_assoc();
  if ($blogs['visibility'] == 'public' || ($blogs['visibility'] == 'admin' && $user['admin'] == 1)) {
    echo '<div class="longApplet">' . '<oblique>#' . $blogs['id'] . ', published ' . $blogs['date'] . ' by ' . $blogs['author'] . '.</oblique>'; //give information about the blog post
    echo '<h2>' . $blogs['title'] . '</h2>' . '<p>' . $blogs['body'] . '</p>' . '</div><br>'; //main body and title of the blog post
  } else {
    echo '<div class="longApplet"><h2>Oh no! An error occured.</h2><p>We couldn\'t access this blog post. You may not have the appropriate permissions, or it may have never existed it all.</p></div>';
  }
} else {
  echo '<div class="longApplet">Please wait, you are being redirected...</div>';
  echo '<script>parent.self.location=\'blog.php?id=' . $lastBlogPostID['id'] . '\';</script>';
}

?>

</div>
</body>
</html>
