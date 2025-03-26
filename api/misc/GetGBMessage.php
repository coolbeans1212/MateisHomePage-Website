<?php
header('Content-Type: application/json');
$message = ["message" => ''];
for ($i = rand(1, 100); $i > 0; $i--) {
    $message["message"] .= 'meow ';
}
$message["message"] = trim($message["message"]);
echo json_encode($message);

?>
