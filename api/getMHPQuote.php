<?php
$date = date('F jS, Y');
//figure out the quote that should be selected for the day
$DateInterval = date_diff(date_create('2000-1-1'), date_create(date('Y-m-d')));
$DaysSince2000 = $DateInterval->days; //php isnt playing ball
$awesomeSauceArray = json_decode(file_get_contents('/var/www/html/quotes.json'));
//echo teh awesome quote :D
$quote = $awesomeSauceArray[$DaysSince2000 % count($awesomeSauceArray)];

if (!$_GET['type'] || $_GET['type'] == 'plaintext') {
    echo $quote;
} elseif ($_GET['type'] == 'json') {
    echo json_encode(array('date' => $date, 'quote' => $quote));
} else {
    echo 'Invalid type specified.';
}
?>
