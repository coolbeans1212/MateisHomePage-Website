<style> /* Defines the beginning of a block that contains CSS styling rules. */
  body { /* Starts the CSS rule block for the <body> element */
    margin: 6px 0px; /* Sets the outer margin of the body to 6px on the top and bottom, 0px on the left and right. */
    padding: 0; /* Sets the inner padding of the body to 0px, removing any space between the content and the body’s edges. */
    font-family: Verdana, Arial, sans-serif; /* Specifies the fonts to be used for the body text, with Verdana first, Arial second, and any generic sans-serif font as a fallback. */
    font-size: 15px; /* Sets the font size for the body text to 15px. */
    line-height: 1.9em; /* Sets the space between lines of text to 1.9 times the font size, making the text easier to read. */
    background-color: #001310; /* Sets the background color of the body to a very dark color (hex code #001310). */
    background-image: url(/files/images/main_site_background_image.png); /* Specifies an image to be used as the background for the body. */
    background-position: top center; /* Positions the background image at the top center of the body. */
    background-repeat: no-repeat; /* Prevents the background image from repeating. */
  }
  
  @media screen and (min-width: 1920px) { /* This rule applies if the screen width is at least 1920px. */
    body { /* Re-targets the <body> element in this rule block */
      background-size: 100% auto; /* Makes the background image stretch to 100% width, keeping its original aspect ratio for height. */
    }
  }

  .header { /* Defines the style for any element with the class 'header' */
    color: #ffffff; /* Sets the text color in the header to white (#ffffff). */
    border-radius: 10px; /* Rounds the corners of the header by 10px. */
    background: #2e2e39 url(/files/images/top_navigation_panel.png) no-repeat 0px 0px; /* Sets a dark background color with a top navigation panel image. */
    height: 136px; /* Defines the height of the header to be 136px. */
    text-align: left; /* Aligns the text in the header to the left side. */
  }

  .headerOptions { /* Defines the style for elements with the class 'headerOptions' */
    display: -webkit-box; /* Uses the old WebKit box layout for flexible layout in some older browsers. */
  }

  .headerReactiveText { /* Targets elements with the class 'headerReactiveText' */
    margin: 8px; /* Adds 8px of margin (space) around the element. */
  }

  .headerReactiveText a:link { /* Targets unvisited links inside elements with 'headerReactiveText' class */
    text-decoration: underline; /* Underlines the link text. */
  }

  .largeApplet { /* Defines the style for elements with the class 'largeApplet' */
    width: 100%; /* Sets the width of the element to 100% of its container's width. */
    background-color: #191b1e; /* Sets a dark background color. */
    color: #ffffff; /* Sets the text color to white. */
    border-radius: 10px; /* Rounds the corners of the element by 10px. */
    text-align: left; /* Aligns the text to the left. */
    padding: 20px; /* Adds 20px of padding inside the element around its content. */
    box-sizing: border-box; /* Ensures the padding is included in the element's total width and height calculation. */
  }

  .mediumApplet { /* Defines the style for elements with the class 'mediumApplet' */
    width: 50%; /* Sets the width to 50% of its container. */
    background-color: #191b1e; /* Sets the background to a dark color. */
    color: #ffffff; /* Sets the text color to white. */
    border-radius: 10px; /* Rounds the corners by 10px. */
    text-align: left; /* Aligns the text to the left. */
    padding: 20px; /* Adds 20px of padding inside the element. */
    box-sizing: border-box; /* Ensures padding is included in the element's total width and height. */
  }

  .longApplet { /* Defines the style for elements with the class 'longApplet' */
    width: 100%; /* Sets the width to 100% of the container. */
    background-color: #191b1e; /* Sets the background to a dark color. */
    color: #ffffff; /* Sets the text color to white. */
    border-radius: 10px; /* Rounds the corners by 10px. */
    text-align: left; /* Aligns text to the left. */
    padding: 10px; /* Adds 10px of padding inside the element. */
    box-sizing: border-box; /* Ensures padding is included in the element's total width and height. */
  }

  .smallApplet { /* Defines the style for elements with the class 'smallApplet' */
    width: 32%; /* Sets the width to 32% of its container. */
    background-color: #191b1e; /* Sets the background to a dark color. */
    color: #ffffff; /* Sets the text color to white. */
    border-radius: 10px; /* Rounds the corners by 10px. */
    text-align: left; /* Aligns the text to the left. */
    padding: 10px; /* Adds 10px of padding inside the element. */
    box-sizing: border-box; /* Ensures padding is included in the element's total width and height. */
  }

  .appletContainer { /* Defines the style for elements with the class 'appletContainer' */
    display: flex; /* Uses flexbox to arrange child elements in a row or column. */
    flex-direction: row; /* Aligns child elements in a row (horizontal alignment). */
    justify-content: space-between; /* Distributes space evenly between child elements. */
    overflow-wrap: anywhere; /* Allows long words or text to break and wrap into the next line, ensuring the container doesn't overflow. */
  }

  .page { /* Defines the style for elements with the class 'page' */
    margin: auto; /* Centers the page horizontally within its container. */
    width: 1100px; /* Sets the width of the page to 1100px. */
    text-align: center; /* Centers the text within the page. */
  }

  .navigationPanelOption { /* Defines the style for elements with the class 'navigationPanelOption' */
    max-width: 85px; /* Restricts the maximum width of the element to 85px. */
    overflow-wrap: anywhere; /* Allows long words to break and wrap to the next line if needed. */
    margin-right: 27px; /* Adds 27px of margin to the right of the element. */
    font-size: 13px; /* Sets the font size to 13px. */
    text-align: center; /* Centers the text within the element. */
    line-height: 1.4em; /* Sets the line height to 1.4 times the font size, providing spacing between lines of text. */
  }

  .navigationPanelOption img { /* Styles images within the navigation panel options */
    width: 75px; /* Sets the image width to 75px. */
    height: 75px; /* Sets the image height to 75px. */
  }

  a:link { /* Styles for links that haven't been visited yet */
    color: #fff; /* Sets the link color to white. */
    text-decoration: none; /* Removes the underline from the link. */
  }

  a:visited { /* Styles for links that have been visited by the user */
    color: #fff; /* Sets the visited link color to white. */
    text-decoration: none; /* Removes the underline from the visited link. */
  }

  a:hover { /* Styles for links when hovered over */
    text-decoration: underline; /* Underlines the link when hovered. */
  }

  .appletContainer a:hover { /* Styles for links within the 'appletContainer' class when hovered */
    text-decoration: none; /* Removes the underline when hovering over links inside the 'appletContainer'. */
  }

  h1 { /* Styles for <h1> header elements */
    font-size: 30px; /* Sets the font size of <h1> to 30px. */
    font-weight: inherit; /* Inherits the font weight from the parent element. */
    margin-top: 2px; /* Adds 2px of margin at the top of the <h1> element. */
    margin-bottom: 10px; /* Adds 10px of margin at the bottom of the <h1> element. */
  }

  h2 { /* Styles for <h2> header elements */
    font-size: 25px; /* Sets the font size of <h2> to 25px. */
    font-weight: inherit; /* Inherits the font weight from the parent element. */
    margin-top: 5px; /* Adds 5px of margin at the top of the <h2> element. */
    margin-bottom: 10px; /* Adds 10px of margin at the bottom of the <h2> element. */
  }

  oblique { /* Targets the <oblique> element */
    font-style: oblique; /* Applies an oblique (slanted) font style. */
  }

  .navigationButton, .navigationButtonDisabled { /* Defines styles for elements with either the 'navigationButton' or 'navigationButtonDisabled' class */
    border-radius: 10px; /* Rounds the corners of the button by 10px. */
    background-color: #191b1e; /* Sets a dark background color for the button. */
    color: white; /* Sets the text color to white. */
    width: 100px; /* Sets the width of the button to 100px. */
    height: 50px; /* Sets the height of the button to 50px. */
    cursor: pointer; /* Changes the mouse cursor to a pointer (hand icon) when hovering over the button. */
    border: none; /* Removes any border from the button. */
    font-size: 100%; /* Sets the font size to the default size of the user's browser. */
    margin-left: 200px; /* Adds 200px of space to the left of the button. */
    margin-right: 200px; /* Adds 200px of space to the right of the button. */
  }

  .navigationButtonDisabled { /* Specifically styles disabled navigation buttons */
    background-color: #191b1e99; /* Sets a transparent dark background color for the disabled button. */
    cursor: not-allowed; /* Changes the cursor to indicate the button is not clickable. */
  }

  .smallLineBreak { /* Defines an element used as a small line break */
    content: ""; /* Creates an empty content area. */
    margin: 2em; /* Adds 2em of space around the element. */
    display: block; /* Makes the element a block-level element, so it takes up the full width. */
    font-size: 24%; /* Sets the font size to 24% of the parent element's font size. */
  }

  .pfpLarge { /* Defines the style for large profile picture elements */
    width: 200px; /* Sets the width of the profile picture to 200px. */
    height: 200px; /* Sets the height of the profile picture to 200px. */
    background: #00000055; /* Sets a semi-transparent dark background color. */
    border-radius: 10px; /* Rounds the corners of the profile picture by 10px. */
    border: black; /* Applies a black border to the profile picture. */
    border-style: solid; /* Makes the border solid. */
    border-width: 5px; /* Sets the border width to 5px. */
  }

  .photographyPreview { /* Defines the style for photography preview elements */
    width: 100px; /* Sets the width of the preview image to 100px. */
    height: 100px; /* Sets the height of the preview image to 100px. */
    background: #00000055; /* Sets a semi-transparent dark background color. */
    border: black; /* Sets the border color to black. */
    border-style: solid; /* Makes the border solid. */
    border-width: 5px; /* Sets the border width to 5px. */
    margin: 0px; /* Removes any margin around the preview image. */
  }

  .username { /* Defines the style for elements with the class 'username' */
    font-size: 35px; /* Sets the font size to 35px. */
    overflow: hidden; /* Hides any text that overflows the element's boundary. */
  }

  input[type="text"] { /* Targets text input fields */
    border: 1px solid; /* Sets a 1px solid border around the text input field. */
    border-radius: 5px; /* Rounds the corners of the input field by 5px. */
    background: #131415; /* Sets a dark background color for the input field. */
    color: #ffffff; /* Sets the text color inside the input field to white. */
    height: 25px; /* Sets the height of the input field to 25px. */
  }

  input[type="password"] { /* Targets password input fields */
    border: 1px solid; /* Sets a 1px solid border around the password input field. */
    border-radius: 5px; /* Rounds the corners of the password field by 5px. */
    background: #131415; /* Sets a dark background color for the input field. */
    color: #ffffff; /* Sets the text color inside the password field to white. */
    height: 25px; /* Sets the height of the password field to 25px. */
  }

  input[type="email"] { /* Targets email input fields */
    border: 1px solid; /* Sets a 1px solid border around the email input field. */
    border-radius: 5px; /* Rounds the corners of the email field by 5px. */
    background: #131415; /* Sets a dark background color for the email field. */
    color: #ffffff; /* Sets the text color inside the email field to white. */
    height: 25px; /* Sets the height of the email field to 25px. */
  }

  input[type="submit"] { /* Targets submit button input fields */
    border: 1px solid; /* Sets a 1px solid border around the submit button. */
    border-radius: 5px; /* Rounds the corners of the submit button by 5px. */
    background: #131415; /* Sets a dark background color for the submit button. */
    color: #ffffff; /* Sets the text color of the button to white. */
    height: 30px; /* Sets the height of the button to 30px. */
    margin: 5px; /* Adds 5px of margin around the button. */
    cursor: pointer; /* Changes the cursor to a pointer (hand icon) when hovering over the button. */
  }

  textarea { /* Defines the style for <textarea> elements */
    width: 98.1%; /* Sets the width of the textarea to 98.1% of its container. */
    resize: none; /* Disables the ability to resize the textarea. */
    height: 150px; /* Sets the height of the textarea to 150px. */
    border: 1px solid; /* Sets a 1px solid border around the textarea. */
    border-radius: 5px; /* Rounds the corners of the textarea by 5px. */
    background: #131415; /* Sets a dark background color for the textarea. */
    color: #ffffff; /* Sets the text color inside the textarea to white. */
    font-family: Arial; /* Specifies that the font used inside the textarea is Arial. */
  }

  hr { /* Defines the style for <hr> (horizontal rule) elements */
    border: none; /* Removes the border from the horizontal rule. */
    border-top: 1px solid #fafbfc; /* Sets a solid 1px border at the top of the <hr> with a light color. */
  }

  .warningBanner { /* Defines the style for elements with the class 'warningBanner' */
    background: yellow; /* Sets the background color of the warning banner to yellow. */
    margin: 10px; /* Adds 10px of margin around the banner. */
    border-radius: 5px; /* Rounds the corners of the warning banner by 5px. */
  }

  .codeBlock { /* Defines the style for code block elements */
    background-color: #12100f; /* Sets a dark background color for the code block. */
    padding: 3px; /* Adds 3px of padding around the code block. */
    border-radius: 5px; /* Rounds the corners of the code block by 5px. */
  }

  .miniText { /* Defines the style for small text elements */
    font-size: 10px; /* Sets the font size to 10px. */
    line-height: normal !important; /* Sets the line height to normal and forces this rule to override others. */
  }

  <?php if ($_GET['rainbow'] == true): ?> /* PHP condition checks if 'rainbow' is set to true in the URL query parameter */
  @keyframes colorAnimation { /* Starts defining a CSS keyframes animation named 'colorAnimation' */
    0% { color: red; } /* At 0%, the color is red. */
    10% { color: orangered; } /* At 10%, the color is orangered. */
    20% { color: orange; } /* At 20%, the color is orange. */
    30% { color: yellow; } /* At 30%, the color is yellow. */
    40% { color: yellowgreen; } /* At 40%, the color is yellowgreen. */
    50% { color: green; } /* At 50%, the color is green. */
    60% { color: turquoise; } /* At 60%, the color is turquoise. */
    70% { color: #5582ff; } /* At 70%, the color is a shade of blue (#5582ff). */
    80% { color: blue; } /* At 80%, the color is blue. */
    90% { color: blueviolet; }
    100% { color: red; }
  }
  h1 {
    animation: colorAnimation 5s infinite;
  }
  <?php endif; ?>
</style>
