<?php
$mysqli = require_once __DIR__ . "/../db.php";

session_set_cookie_params([
    'secure' => true,
    'httponly' => true,
    'samesite' => 'None'
]);
ini_set('session.cookie_domain', '.mateishome.page');
session_start();
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT username,admin FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}
if (!$user['admin']) {
    header("Location: /");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <title>Matei's Homepage!</title>
  <meta content="a cool website all about me, Matei!" property="og:title" />
  <meta content="my website coded with HTML (html is awesome) and CSS (css is awesome) and with PHP (i love recursive acronyms). one secon gotta be SEO: Matei's Home Page Matei'sHomePage MateisHomePage" property="og:description" />
  <meta content="https://mateishome.page" property="og:url" />
  <meta content="https://mateishome.page/welcome.gif" property="og:image" />
  <meta content="#24589E" data-react-helmet="true" name="theme-color" />
  <?php include_once __DIR__ . "/../applets/style.php";?></head>
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
    include_once __DIR__ . "/../applets/navigation_bar.php"; // :3
    ?>
    <br>
    <div class="largeApplet">
        <h1><oblique>manage blog posts.</oblique></h1>
        <?php
        if ($_GET['id'] == -1) {
            $sql = "SELECT id FROM blog_entries ORDER BY id DESC LIMIT 1";
            $result = $mysqli->query($sql);
            $latestId = $result->fetch_assoc();
            ?>
            <form>Crafting a new blog post with id <?php echo $latestId['id'] + 1; ?>.</form>
            <input type="hidden" id="id" name="id" value="<?php echo $latestId['id'] + 1;?>"></input>
        <?php
        } elseif ($_GET['id']) {
            $sql = "SELECT * FROM blog_entries WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('i', $_GET['id']);
            $stmt->execute();
            $blogs = $stmt->get_result();
            $blogs = $blogs->fetch_assoc();
            if ($blogs) {
                echo '<form> Editting blog with id ' . $blogs['id'] . ', published ' . $blogs['date'] . '.<br>';
                echo '<input type="hidden" id="id" name="id" value="' . $blogs['id'] . '"></input>';
                echo '<label for="title">Title: </label>';
                echo '<input type="text" id="title" name="title" value="' . $blogs['title'] . '"><br>';
                echo '<input type="submit" value="Submit">';
                echo '</form>';
            } else {
                echo '<script>parent.self.location=\'edit_blog.php\';</script>';
            }
            print_r($blogs);
        } else {
            echo '<p>select a blog post to edit or write a new one.</p>';
            echo '<a class="shaded" href="?id=-1"><h2>✎ new blog post!</h2>id X, where X is a real number from 0-65535, crafted by YOU, today!</a>';
            $sql = "SELECT id,title,author,date FROM blog_entries ORDER BY id DESC";
            $result = $mysqli->query($sql);
            $blogs = $result->fetch_all();
            foreach ($blogs as $blog) {
                echo '<a class="shaded" href="?id=' . $blog[0] . '"><h2>' . $blog[1] . '</h2>id ' . $blog[0] . ', crafted by ' . $blog[2] . ' on ' . $blog[3] . '.</a>'; // my english teacher loves to say craft instead of create/write.
            }
        }
        ?>
    </div>
    <br>
    <div class="longApplet">
        <h1>Preview Window:</h1>
        <?php if (!$_GET['id']): ?>
            A preview will appear here after you select a blog post.
        <?php else: ?>
            <h2>postTitle</h2>
            <span>postBody</span>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
