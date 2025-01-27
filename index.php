<?php
session_start();
$mysqli = require_once __DIR__ . "/db.php";
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}

$sql = "SELECT * FROM blog_entries WHERE visibility = 'public' ORDER BY id DESC LIMIT 1";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$blog = $stmt->get_result();
$blog = $blog->fetch_assoc();
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

if (window.location.href == 'https://eatmoreram.com/') {
  window.location.replace("https://eatmoreram.com/top100modureasons.php");
}
</script>
<div class="page">
  <?php
  include_once __DIR__ . "/applets/navigation_bar.php"; // :3
  ?>
  <br>
  <div class="largeApplet">
    <h1><span id="datetime">Good day, </span>
      <script defer>
        // Will get the current time for the user and greet them based on it.
        var now = new Date();
        var hour = now.getHours();
        console.log(hour);
        if (hour >= 17) {
          document.getElementById('datetime').innerHTML = 'Good evening, ';
        } else if (hour >= 12) {
          document.getElementById('datetime').innerHTML = 'Good afternoon, ';
        } else {
          document.getElementById('datetime').innerHTML = 'Good morning, ';
        }
      </script>
    <?php
    // Will add on the username of the current logged in user to the greeting or 'guest'.
    if ($user) {
      echo $user['username'] . '.';
    } else {
      echo 'guest.';
    }
    ?>
    </h1>
    Welcome to my website! This page was redesigned in December 2024 for it's 1 year anniversary (the website was made 09/12/2023) so that it looked actually good. I tried to make it look like
    it was from ~2005 because I think websites from that era look super awesome, but I promise I could make a modern website if I tried.
    <h2>A bit about myself & the website.</h2>
    Sometime in late 2023/early 2024, I decided that PHP was awesome and that I should make a website using it. It looked <i>really</i> bad (think 1990s) but it had a lot of functions, like
    a user account system and a guestbook (which are still on the website today!). Because it looked really bad, I started to redesign the website on 07/12/2024 and people thought
    it looked really nice! So, I continued coding and making art until I finished the main page on <b>01/01/2025</b>!
    <br>
    More about myself. I live in the United Kingdom of Great Britain and Northern Ireland. My favourite operating systems are Microsoft Windows 7 and Arch Linux and my favourite colours
    are <span style="color: #560dfd">this</span> and <span style="color: #02c46c">this</span>. I am an avid Geometry Dash player (as of 08/12/2024 I have 537 hours on it :O) but I also play
    Webfishing, Minecraft, and Roblox from time to time.
  </div>
  <br>
  <div class="appletContainer">
    <a href="blog.php" class="smallApplet" style="background: url('/files/images/blog_applet_background.png') no-repeat 0px 0px; background-size: cover;">
    <div>
      <h2>Latest blog entry:</h2> <?php echo $blog['title']; ?><br>
      <span style="font-size: 10px; line-height: initial;"><?php echo htmlspecialchars(substr($blog['body'], 0, 150)) . '...';?></span><br>
      <span>Posted by <?php echo $blog['author'];?> on <?php echo $blog['date'];?></span>
    </div>
    </a>
    <div class="smallApplet" style="background: url('/files/images/website_health_applet_background.png') no-repeat 0px 0px; background-size: cover;">
      <h2>Website health:</h2>
      Uptime:
      <?php //get website uptime :3
      $data = shell_exec('uptime');
      $uptime = explode(' up ', $data);
      $uptime = explode(',', $uptime[1]);
      $uptime = $uptime[0] . ', '. strtok($uptime[1], ':') . ' hours, ' . strtok(':') . ' minutes.';
      echo $uptime;
      ?>
      Packages installed:
      <?php //get packages installed :3
      $packages = shell_exec('dpkg --get-selections'); //scary!
      echo substr_count($packages, 'install');
      ?><br>
      System memory:
      <?php //i hate it but it works :ε
      $freemem = shell_exec('free'); //command to get system memory
      $freemem2 = preg_split("/\r\n|\n|\r/", $freemem); //weird regular expression thing that cuts up the output of the command
      //black magic dont touch
      $important_line = $freemem2[1];
      $memory_parts = preg_split('/\s+/', trim($important_line)); //more weird regex
      echo $memory_parts[3] . ' / ' . $memory_parts[1];
      ?><br>
      Storage:
      <?php
      //this gets the available disk space in the MateisHomePage server and prints it (because some users are curious :P)
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
      //use the API to get the daily quote
      echo file_get_contents('https://mateishome.page/api/getMHPQuote.php?type=plaintext') . '\'';
      ?>
    </div>
  </div>
  <br>
  <div class="largeApplet">
    <h1>Quick Links</h1>
    <div class="appletContainer">
      <div style="width: 33%;">
        <h2>MateisHomePages</h2>
        <a href="/">Home</a><br>
        <a href="/soonTM.php">Photography</a><br>
        <a href="/soonTM.php">Software</a><br>
        <a href="/users.php">Users</a><br>
        <a href="/guestbook.php">Guestbook</a><br>
        <a href="/msgboard.php">Message board</a><br>
        <a href="/blog.php">Blog</a><br>
        <a href="/contact.php">Contact</a><br>
        <a href="https://status.mateishome.page">Website uptime</a><br>
      </div>
      <div style="width: 33%;">
        <h2>Cool websites</h2>
        <a target="_blank" rel="noopener noreferrer" href="https://zakkcarpenter.com">ZakksGames</a><br>
        <a target="_blank" rel="noopener noreferrer" href="https://www.is-a-furry.dev/">PlOszukiwacz's website</a><br>
        <a target="_blank" rel="noopener noreferrer" href="https://cyteon.tech/">Cyteon's website</a><br>
        <a target="_blank" rel="noopener noreferrer" href="https://paintdev.co.uk">Paintdev's website</a><br>
        <a target="_blank" rel="noopener noreferrer" href="https://computerblade.is-a.dev/">Computerblade's website</a><br>
        <a target="_blank" rel="noopener noreferrer" href="https://aquiffoo.vercel.app/">Aquiffoo's website</a><br>
        <a target="_blank" rel="noopener noreferrer" href="http://gizzy.pro/">Gizzy's website</a><br>
        <a target="_blank" rel="noopener noreferrer" href="http://fartoo.com/">Fartoo Search</a><br>
        <a target="_blank" rel="noopener noreferrer" href="https://amigaos.net">AmigaOS</a><br>
      </div>
      <div style="width: 33%;">
        <h2>External links</h2>
        <a target="_blank" rel="noopener noreferrer" href="https://discord.com/users/712004994995322952">Discord</a><br>
        <a target="_blank" rel="noopener noreferrer" href="mailto:matei@mateishome.page">Email</a><br>
        <a target="_blank" rel="noopener noreferrer" href="https://github.com/coolbeans1212">GitHub</a><br>
        <a target="_blank" rel="noopener noreferrer" href="https://mattamatt.newgrounds.com">Newgrounds</a><br>
        <a target="_blank" rel="noopener noreferrer" href="https://stats.foldingathome.org/donor/id/729534072">Folding@Home (user)</a><br>
        <a target="_blank" rel="noopener noreferrer" href="https://stats.foldingathome.org/team/1066116">Folding@Home (team)</a><br>
      </div>
    </div>
</div>
</div>
</body>
</html>
