<?php // Opening PHP tag: indicates that the code following it is written in PHP.

$date = date('F jS, Y'); // Calls the date() function to get the current date formatted as "Month Day, Year" (e.g., "January 31st, 2025") and stores it in the $date variable.

//figure out the quote that should be selected for the day
$DateInterval = date_diff(date_create('2000-1-1'), date_create(date('Y-m-d'))); // Creates two DateTime objects: one for the fixed date '2000-1-1' and one for the current date. Then calculates the difference between these two dates and stores it in the $DateInterval variable.
$DaysSince2000 = $DateInterval->days; // Retrieves the number of days between the two dates from the $DateInterval object and stores it in the $DaysSince2000 variable. This gives the number of days since January 1, 2000.

$awesomeSauceArray = json_decode(file_get_contents('/var/www/html/quotes.json')); // Reads the contents of the file "/var/www/html/quotes.json", which is expected to be a JSON-formatted string, decodes it into a PHP array, and stores the result in $awesomeSauceArray.

$quote = $awesomeSauceArray[$DaysSince2000 % count($awesomeSauceArray)]; // Uses modulo (%) to determine the index of the quote to display for today by dividing $DaysSince2000 by the number of quotes available in $awesomeSauceArray and getting the remainder. This ensures a new quote is selected daily, cycling through the available quotes.

if (!$_GET['type'] || $_GET['type'] == 'plaintext') { // Checks if the 'type' parameter is not provided in the URL query string or if it is set to 'plaintext'. If so, it enters this block.
    echo $quote; // Outputs the selected quote as plain text on the page.
} elseif ($_GET['type'] == 'json') { // Checks if the 'type' parameter in the URL query string is set to 'json'. If so, it enters this block.
    echo json_encode(array('date' => $date, 'quote' => $quote)); // Encodes an associative array containing the current date and quote into a JSON format and outputs it. The resulting JSON could look like: {"date":"January 31st, 2025","quote":"Your daily quote here"}.
} elseif ($_GET['type'] == 'complete') { // Checks if the 'type' parameter in the URL query string is set to 'complete'. If so, it enters this block.
    echo $date . '\'s quote is: \'' . $quote . '\''; // Outputs the current date followed by the quote in a complete sentence format like: "January 31st, 2025's quote is: 'Your daily quote here'".
} else { // If the 'type' parameter doesn't match any of the specified values ('plaintext', 'json', 'complete'), this block is executed.
    echo 'Invalid type specified.'; // Outputs an error message if the 'type' parameter is invalid or missing.
}
?> <!-- Closing PHP tag: ends the PHP code block. -->
