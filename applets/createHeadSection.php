<?php

function createHeadSection($title = 'MateisHomePage', $og_title = 'Mateis\' super duper awesome website!', $og_description = 'My super duper awesome website made in the best programming language, PHP. PHP is objectively the programming language. Learn it. Now.') {
    echo '<meta charset="UTF-8">';
    echo '<link rel="icon" href="/favicon.ico" type="image/x-icon">';
    echo '<title>' . $title  . '</title>';
    echo '<meta content="' . $og_title . '" property="og:title" />';
    echo '<meta content="' . $og_description . '" property="og:description" />';
    echo '<meta content="https://mateishome.page" property="og:url" />';
    echo '<meta content="https://mateishome.page/welcome.gif" property="og:image" />';
    echo '<meta content="#24589E" data-react-helmet="true" name="theme-color" />';
    include_once __DIR__ . "/style.php";
}

?>