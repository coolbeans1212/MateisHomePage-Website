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
    die();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['new']) {
        $sql = "INSERT INTO blog_entries (title, body, visibility, author) VALUES (?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ssss', $_POST['title'], $_POST['body'], $_POST['visibility'], $user['username']);
        if ($stmt->execute()) {
            header('Location: /blog.php');
            die();
        }
    } else {
        $sql = "UPDATE blog_entries SET title = ?, body = ?, visibility = ?, edited = 1 WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('sssi', $_POST['title'], $_POST['body'], $_POST['visibility'], $_POST['id']);
        if ($stmt->execute()) {
            header('Location: /blog.php?id=' . $_POST['id']);
            die();
        }
    }
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
    <?php if ($user['username'] != 'admin') {
    ?>
        <div class="warningBanner">Your account is classified as an admin, but you are not Matei. Please only edit blog posts to correct things such as unintentional spelling mistakes, dead links, or broken images.
        <b>Only create a blog post in the event of my death or if I am seriously harmed & cannot access/use a computer.</b> If you do not follow these instructions, your admin privileges will be revoked.</div><?php
        } else {
            echo '<br>';
        }
    ?>
    <div class="largeApplet">
        <h1><oblique>manage blog posts.</oblique></h1>
        <?php
        if ($_GET['id'] == -1) {
            $sql = "SELECT id FROM blog_entries ORDER BY id DESC LIMIT 1";
            $result = $mysqli->query($sql);
            $latestId = $result->fetch_assoc();
            $latestId = $latestId['id'] + 1;
            $blogs = ['id' => $latestId, 'title' => '', 'body' => '', 'date' => date('Y-m-d'), 'visibility' => 'public', 'author' => $user['username'], 'edited' => false];
        } elseif ($_GET['id']) {
            $sql = "SELECT * FROM blog_entries WHERE id = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('i', $_GET['id']);
            $stmt->execute();
            $blogs = $stmt->get_result();
            $blogs = $blogs->fetch_assoc();
        } else {
            ?><p>select a blog post to edit or write a new one.</p>
            <a class="shaded nounderline" href="?id=-1"><h2>✎ new blog post!</h2>id X, where X is a real number from 0-65535, crafted by YOU, today!</a><?php
            $sql = "SELECT id,title,author,date FROM blog_entries ORDER BY id DESC";
            $result = $mysqli->query($sql);
            $blogs = $result->fetch_all();
            foreach ($blogs as $blog) {
                echo '<a class="shaded nounderline" href="?id=' . $blog[0] . '"><h2>' . $blog[1] . '</h2>id ' . $blog[0] . ', crafted by ' . $blog[2] . ' on ' . $blog[3] . '.</a>'; // my english teacher loves to say craft instead of create/write.
            }
        }
        if ($_GET['id']) {
            if ($latestId) {
                ?><form method="POST">Crafting a new blog post with id <?php echo $blogs['id']; ?>.
                <input type="hidden" id="new" name="new" value="true"></input><?php
            } else {
                ?><form method="POST">Editting blog with id <?php echo $blogs['id'];?>, published <?php echo $blogs['date'];?>.<?php
            }?>
            <br>
            <input type="hidden" id="id" name="id" value="<?php echo $blogs['id'];?>"></input>
            <label for="title">Title: </label>
            <input type="text" id="title" name="title" value="<?php echo $blogs['title'];?>"><br>
            <textarea id="body" name="body"><?php echo htmlspecialchars($blogs['body']);?></textarea><br>
            <label for="visibility">Visibility:</label>
            <select name="visibility" id="visibility">
                <option value="public" <?php if ($blogs['visibility'] == 'public') {echo 'selected';}?> >Public</option>
                <option value="admin" <?php if ($blogs['visibility'] == 'admin') {echo 'selected';}?> >Admins-only</option>
                <option value="private" <?php if ($blogs['visibility'] == 'private') {echo 'selected';}?> >Unlisted</option>
            </select><br>
            <div class="flex-space-between">
                <a href="/admin/edit_blog.php"><button type="button" id="cancel">Cancel</button></a>
                <input type="submit" id="submit" value="Submit">
            </div>
            </form><?php
        }
        ?>
    </div>
    <br>
    <div class="longApplet">
        <h1>Preview Window:</h1>
        <?php if (!$_GET['id']): ?>
            A preview will appear here after you select a blog post.
        <?php else: ?>
            <h2 id="titlePreview">postTitle</h2>
            <span id="bodyPreview">postBody</span>
            <script>
                const titleInput = document.getElementById('title');
                const bodyInput = document.getElementById('body');
                const titleOutput = document.getElementById('titlePreview');
                const bodyOutput = document.getElementById('bodyPreview');
                titleOutput.innerHTML = titleInput.value != '' ? titleInput.value : 'Title'; // IF titleInput has a value THEN the value is innerHTML of output
                bodyOutput.innerHTML = bodyInput.value != '' ? bodyInput.value : 'Body';
                titleInput.addEventListener('input', () => {
                    titleOutput.innerHTML = titleInput.value != '' ? titleInput.value : 'Title';
                });
                bodyInput.addEventListener('input', () => {
                    bodyOutput.innerHTML = bodyInput.value != '' ? bodyInput.value : 'Body';
                });

                const cancelButton = document.getElementById('cancel');
                const submitButton = document.getElementById('submit');
                cancelButton.addEventListener('mouseover', () => {
                    cancelButton.style.color = '#f00';
                });
                cancelButton.addEventListener('mouseout', () => {
                    cancelButton.style.color = '#fff';
                });
                submitButton.addEventListener('mouseover', () => {
                    submitButton.style.color = '#0f0';
                });
                submitButton.addEventListener('mouseout', () => {
                    submitButton.style.color = '#fff';
                });
            </script>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
