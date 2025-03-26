<?php
header('Content-Type: application/json');
$message = ["message" => ''];
for ($i = rand(1, 100); $i > 0; $i--) {
    $message["message"] .= 'meow ';
}
echo json_encode($message);

?>
