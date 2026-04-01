<?php
$date = date('F jS, Y');
require_once __DIR__ . '/internalFunctions.php';
$quote = getMHPQuote();

if (!$_GET['type'] || $_GET['type'] == 'plaintext') {
    echo $quote;
} elseif ($_GET['type'] == 'json') {
    header('Content-Type: application/json');
    echo json_encode(array('date' => $date, 'quote' => $quote));
} elseif ($_GET['type'] == 'complete') {
    echo $date . '\'s quote is: \'' . $quote . '\'';
} else {
    echo 'Invalid type specified.';
}
?>
