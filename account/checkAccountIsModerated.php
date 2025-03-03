<?php
require_once __DIR__ . '/../db.php';
session_start();
$currentTime = date('Y-m-d H:i:s', time());
if (isset($_SESSION["user_id"])) {
    $sql = "SELECT id FROM users WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    $sql = 'SELECT * FROM moderation WHERE userID = ?'; // checks for moderation records under the user id
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $user['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) { //loops through all moderation records and check if they are still active
            if ($row['expires'] > $currentTime) {
                header("Location: /moderated.php");
            }
        }
    }
}