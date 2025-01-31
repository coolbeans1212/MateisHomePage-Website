<?php  // This starts the PHP code block, which means everything inside will be processed as PHP code.
    session_start();  // This function starts a new session or resumes an existing one, allowing you to store and retrieve session variables (basically data that can persist across different pages).
    session_destroy();  // This destroys the session data, essentially logging out the user by removing the session data on the server.
    header("Location: /");  // This tells the browser to redirect to the homepage ("/"). It's like telling the browser to go to a different page.
    exit;  // This stops the rest of the PHP code from running after the redirection. It's like saying "I'm done, no more actions should be taken."
?>  // This closes the PHP code block, meaning no more PHP code will be processed here.

<html lang="en">  <!-- This starts the HTML document and sets the language to English (so that search engines and browsers know the language). -->
<head>  <!-- The <head> section of the HTML, where metadata and external resources (like stylesheets or scripts) are linked. -->
  <link rel="stylesheet" href="webpage.css">  <!-- This links an external CSS (style) file named "webpage.css" to style the page. -->
  <meta charset="UTF-8">  <!-- This sets the character encoding to UTF-8, which supports most characters in any language. -->
  <link rel="icon" href="favicon.ico" type="image/x-icon">  <!-- This sets a small image (favicon.ico) to appear as the site's icon in the browser tab. -->
  <title>Some random testing page.</title>  <!-- This sets the text that will appear in the browser tab as the title of the page. -->
  <meta content="Login to Matei's Home Page" property="og:title" />  <!-- This is an Open Graph meta tag that specifies the title when this page is shared on social media (Facebook, etc.). -->
  <meta content="" property="og:description" />  <!-- This is an Open Graph meta tag for the description of the page, but it's left empty here. -->
  <meta content="http://mateishome.page" property="og:url" />  <!-- This specifies the URL of the page for Open Graph (what link to show when the page is shared). -->
  <meta content="https://mateishome.page/welcome.gif" property="og:image" />  <!-- This specifies the image to display when the page is shared on social media (a GIF image in this case). -->
  <meta content="#43B581" data-react-helmet="true" name="theme-color" />  <!-- This sets the color of the browser toolbar or the page’s theme color, when viewed on mobile devices. -->
  
  <style>  <!-- This section contains CSS styles directly inside the HTML file (instead of linking to an external file). -->
.footer {  /* This defines a CSS class called "footer", which will be applied to elements with that class. */
   position: fixed;  /* This makes the footer stay fixed at the bottom of the page, no matter how much content is above it. */
   left: 0;  /* This ensures the footer is aligned to the left edge of the page. */
   bottom: 0;  /* This positions the footer at the very bottom of the page. */
   width: 100%;  /* This makes the footer span the full width of the page. */
   background-color: #EEEEEE;  /* This sets the background color of the footer to a light gray. */
   color: #303030;  /* This sets the text color inside the footer to a dark gray. */
   text-align: center;  /* This centers the text inside the footer. */
} 
</style>  <!-- This ends the CSS block. -->

</head>  <!-- This closes the <head> section. -->

<body>  <!-- This starts the <body> section, which contains the content of the web page that users see. -->
  <center>  <!-- This centers the content inside it horizontally (though this tag is outdated in modern HTML). -->
    <h1>Logout.</h1>  <!-- This creates a heading (h1) that says "Logout." It’s usually used for important headings on the page. -->
  </center>  <!-- This closes the <center> tag, ending the centering effect. -->

<div class="footer">  <!-- This starts a <div> element with the class "footer" (which applies the CSS styles defined earlier). -->
  <a href="/">Go Back</a>  <!-- This creates a clickable link (anchor tag) that goes to the homepage ("/"). The text inside the link says "Go Back." -->
</div>  <!-- This closes the <div> element. -->

</body>  <!-- This closes the <body> section. -->
</html>  <!-- This closes the HTML document, meaning no more content follows. -->
