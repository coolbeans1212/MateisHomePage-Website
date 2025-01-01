<?php
    session_start();
    session_destroy();
    header("Location: /");
    exit;
?>
<html lang="en">
<head>
  <link rel="stylesheet" href="webpage.css">
  <meta charset="UTF-8">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <title>Some random testing page.</title>
  <meta content="Login to Matei's Home Page" property="og:title" />
  <meta content="" property="og:description" />
  <meta content="http://mateishome.page" property="og:url" />
  <meta content="https://mateishome.page/welcome.gif" property="og:image" />
  <meta content="#43B581" data-react-helmet="true" name="theme-color" />

  <style>
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #EEEEEE;
   color: #303030;
   text-align: center;
} 
</style> 
</head>
<body>
  <center>
    <h1>Logout.</h1>
  </center>
<div class="footer">
  <a href="/">Go Back</a>
</div>
</body>
</html>
   
