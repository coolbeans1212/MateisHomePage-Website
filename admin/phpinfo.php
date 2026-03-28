<?php

session_set_cookie_params([
    'secure' => true,
    'httponly' => true,
    'samesite' => 'None'
]);
ini_set('session.cookie_domain', '.mateishome.page');
session_start();
$mysqli = require __DIR__ . "/../db.php";
if (isset($_SESSION["user_id"])) {
  $sql = "SELECT admin FROM users WHERE id = {$_SESSION["user_id"]}";
  $result = $mysqli->query($sql);
  $user = $result->fetch_assoc();
}

if ($user['admin']) {
    phpinfo();
} else{
    header("Location: /");
    die();
}
