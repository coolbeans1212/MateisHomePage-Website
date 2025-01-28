<style>
  body {
    margin: 6px 0px;
    padding: 0;
    font-family: Verdana, Arial, sans-serif;
    font-size: 15px;
    line-height: 1.9em;
    background-color: #001310;
    background-image: url(/files/images/main_site_background_image.png);
    background-position: top center;
    background-repeat: no-repeat;
    background-size: 100% auto;
  }
  .header {
    height: 106px;
    color: #ffffff;
    border-radius: 10px;
    background: #2e2e39 url(/files/images/top_navigation_panel.png) no-repeat 0px 0px;
    height: 136px;
    text-align: left;
  }
  .headerOptions {
    display: -webkit-box;
  }
  .headerReactiveText {
    margin: 8px;
  }
  .headerReactiveText a:link {
    text-decoration: underline;
  }
  .largeApplet {
    width: 100%;
    background-color: #191b1e;
    color: #ffffff;
    border-radius: 10px;
    text-align: left;
    padding: 20px;
    box-sizing: border-box;
  }
  .mediumApplet {
    width: 50%;
    background-color: #191b1e;
    color: #ffffff;
    border-radius: 10px;
    text-align: left;
    padding: 20px;
    box-sizing: border-box;
  }
  .longApplet {
    width: 100%;
    background-color: #191b1e;
    color: #ffffff;
    border-radius: 10px;
    text-align: left;
    padding: 10px;
    box-sizing: border-box;
  }
  .smallApplet {
    width: 32%;
    background-color: #191b1e;
    color: #ffffff;
    border-radius: 10px;
    text-align: left;
    padding: 10px;
    box-sizing: border-box;
  }
  .appletContainer {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    overflow-wrap: anywhere
  }
  .page {
    margin: auto;
    width: 1100px;
    text-align: center;
  }
  .navigationPanelOption {
    max-width: 85px;
    overflow-wrap: anywhere;
    margin-right: 27px;
    font-size: 13px;
    text-align: center;
    line-height: 1.4em;
  }
  .navigationPanelOption img {
    width: 75px;
    height: 75px;
  }
  a:link{
    color: #fff;
    text-decoration: none;
  }
  a:visited{
    color: #fff;
    text-decoration: none;
  }
  a:hover{
    text-decoration: underline;
  }
  .appletContainer a:hover{
    text-decoration: none;
  }
  h1 {
    font-size: 30px;
    font-weight: inherit;
    margin-top: 2px;
    margin-bottom: 10px;
  }
  h2 {
    font-size: 25px;
    font-weight: inherit;
    margin-top: 5px;
    margin-bottom: 10px;
  }
  oblique {
    font-style: oblique;
  }
  .navigationButton, .navigationButtonDisabled {
    border-radius: 10px;
    background-color: #191b1e;
    color: white;
    width: 100px;
    height: 50px;
    cursor: pointer;
    border: none;
    font-size: 100%;
    margin-left: 200px;
    margin-right: 200px;
  }
  .navigationButtonDisabled {
    background-color: #191b1e99;
    cursor: not-allowed;
  }
  .smallLineBreak {
    content: "";
    margin: 2em;
    display: block;
    font-size: 24%;
  }
  .pfpLarge {
    width: 200px;
    height: 200px;
    background: #00000055;
    border-radius: 10px;
    border: black;
    border-style: solid;
    border-width: 5px;
  }
  .photographyPreview {
    width: 100px;
    height: 100px;
    background: #00000055;
    border: black;
    border-style: solid;
    border-width: 5px;
    margin: 0px;
  }
  .username {
    font-size: 35px;
    overflow: hidden;
  }
  input[type="text"] {
    border: 1px solid;
    border-radius: 5px;
    background: #131415;
    color: #ffffff;
    height: 25px;
  }
  input[type="password"] {
    border: 1px solid;
    border-radius: 5px;
    background: #131415;
    color: #ffffff;
    height: 25px;
  }
  input[type="email"] {
    border: 1px solid;
    border-radius: 5px;
    background: #131415;
    color: #ffffff;
    height: 25px;
  }
  input[type="submit"] {
    border: 1px solid;
    border-radius: 5px;
    background: #131415;
    color: #ffffff;
    height: 30px;
    margin: 5px;
    cursor: pointer;
  }
  textarea {
    width: 98.1%; /* the magic number */
    resize: none;
    height: 150px;
    border: 1px solid;
    border-radius: 5px;
    background: #131415;
    color: #ffffff;
    font-family: Arial;
  }
  hr {
    border: none;
    border-top: 1px solid #fafbfc;
  }
  .warningBanner {
    background: yellow;
    margin: 10px;
    border-radius: 5px;
  }
  .codeBlock {
    background-color: #12100f;
    padding: 3px;
    border-radius: 5px;
  }
  .miniText {
    font-size: 10px;
    line-height: 1em !important;
  }
  <?php if ($_GET['rainbow'] == true): ?>
  @keyframes colorAnimation {
    0% { color: red; }
    10% { color: orangered; }
    20% { color: orange; }
    30% { color: yellow; }
    40% { color: yellowgreen; }
    50% { color: green; }
    60% { color: turquoise; }
    70% { color: #5582ff; }
    80% { color: blue; }
    90% { color: blueviolet; }
    100% { color: red; }
  }
  h1 {
    animation: colorAnimation 5s infinite;
  }
  <?php endif; ?>
</style>
