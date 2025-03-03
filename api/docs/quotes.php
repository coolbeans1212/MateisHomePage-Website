<?php
session_start();
include_once __DIR__ . "/../../account/checkAccountIsModerated.php";
$mysqli = require __DIR__ . "/../../db.php";
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT username FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  require_once __DIR__ . "/../../applets/createHeadSection.php";
  createHeadSection('API Documentation', 'MateisHomePage API Documentation', 'Documentation for the MateisHomePage APIs. They are awesome and you WILL use them (I\'m not asking).');
  ?>
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
include_once __DIR__ . "/../../applets/navigation_bar.php"; // :3
?>
<br>
  <div class="largeApplet">
      <h1>API Documentation: Quote API</h1>
      <p>To use the quote API, send a GET request to <span class="codeBlock">https://mateishome.page/api/getMHPQuote.php</span>.</p>
      <h2>Usage</h2>
      <p>There is one optional paramater than can be passed to the API named <span class="codeBlock">type</span>. This can be set to either nothing, <span class="codeBlock">plaintext</span>,
      <span class="codeBlock">json</span>, or <span class="codeBlock">complete</span>. If <span class="codeBlock">type</span>
      is set to nothing or <span class="codeBlock">plaintext</span>, it will return only the quote with no quotation marks around it. If <span class="codeBlock">type</span>
      is set to <span class="codeBlock">json</span>, it will return the quote and the date in JSON format.
      If <span class="codeBlock">type</span> is set to <span class="codeBlock">complete</span>, it will return the date and the quote.</p>
      <h2>Examples</h2>
      <p>All examples are written in the best language ever, PHP.</p>
      <div class="codeBlock">
        // Method 1: Get a quote in plaintext<br>
        echo file_get_contents("https://mateishome.page/api/getMHPQuote.php"); // Will return something like `i use arch btw`<br>
        <br>
        // Method 2: Get a quote in JSON format<br>
        $MHPQuote = json_decode(file_get_contents("https://mateishome.page/api/getMHPQuote.php?type=json"));<br>
        echo 'The quote at MateisHomePage on ' . $MHPQuote->date . ' is: ' . $MHPQuote->quote; // Will return something like `The quote at MateisHomePage on January 56th, 1984 is: i use arch btw`<br>
        <br>
        // Method 3: Get a complete quote<br>
        echo file_get_contents("https://mateishome.page/api/getMHPQuote.php?type=complete"); // Will return something like `January 56th, 1984's quote is: 'i use arch btw'`<br>
      </div>
  </div>
  <br>
  <a href="/api/docs/"><button class="navigationButton">Go Back</button></a>
</div>
</body>
</html>
