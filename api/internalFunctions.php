<?php
function getPfpFromUsername($username) {
    $mysqli = require "/var/www/html/db.php";
    $sql = "SELECT pfp FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $pfp = $result->fetch_assoc();
    if (isset($pfp['pfp']) && $pfp['pfp'] > 100) {
        return 'https://assetdelivery.roblox.com/v1/asset/?id=' . htmlspecialchars($pfp['pfp']);
    } elseif ($pfp['pfp'] < 100) {
        return '/files/images/pfps/' . htmlspecialchars($pfp['pfp']) . '.png';
    } else {
        return '/files/images/pfps/error.png';
    }
}

function isUserModerated($userID) {
    $mysqli = require "/var/www/html/db.php";
    $sql = "SELECT * FROM moderation WHERE userID = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $moderation = $result->fetch_assoc();
        if ($moderation && strtotime($moderation['expires']) > time()) {
            return json_encode($moderation);
        }
    }

    return false;
}
