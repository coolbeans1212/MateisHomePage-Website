<?php
require_once '/var/www/html/db.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: /account/login.php");
    exit();
}
$stmt = $mysqli->prepare("SELECT username FROM users WHERE id = ?");
if (!$stmt) {
    error_log("Failed to prepare statement: " . $mysqli->error);
    exit();
}

$stmt->bind_param("i", $_SESSION["user_id"]);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


function storeProfilePicture($imageId) {
    global $mysqli, $user;
    
    if (!is_numeric($imageId)) {
        return false;
    }

    try {
        if (isset($_GET['set']) && $_GET['set'] === 'true') {
            $pfp = filter_var($imageId, FILTER_SANITIZE_NUMBER_INT);
        } else { //the roblox api makes me want to sudo rm -rf --no-preserve-root
            $assetUrl = 'https://assetdelivery.roblox.com/v1/asset/?id=' . $imageId;
            $decalCompressed = @file_get_contents($assetUrl);
            
            if ($decalCompressed === false) {
                return false;
            }

            $decal = @gzdecode($decalCompressed) ?: $decalCompressed;
            
            if (preg_match('/\/asset\/\?id=(\d+)/', $decal, $matches)) {
                $pfp = $matches[1];
            } else {
                $pfp = $imageId;
            }
        }

        $stmt = $mysqli->prepare("UPDATE users SET pfp = ? WHERE username = ?");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ss", $pfp, $user['username']);
        return $stmt->execute();

    } catch (Exception $e) {
        error_log("Profile picture update error: " . $e->getMessage());
        return false;
    }
}

// Process the request and redirect
if (isset($_GET['image'])) {
    storeProfilePicture($_GET['image']);
}
if ($_GET['type'] == 'customStatus' && $_GET['status']) {
    $sql = "UPDATE users SET shortbio = ? WHERE username = ?";  //prepare statement
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($sql);
    if ( ! $stmt->prepare($sql)) {
        die("SQL Error: " . $mysqli->error);
    }
    $stmt->bind_param("ss", $_GET['status'], $user['username']); //bind paramaters ready to be executed
    $stmt->execute();
}

if ($_GET['type'] == 'description' && $_GET['description']) {
    $sql = "UPDATE users SET bigdescription = ? WHERE username = ?";  //prepare statement
    $stmt = $mysqli->stmt_init();
    $stmt->prepare($sql);
    if ( ! $stmt->prepare($sql)) {
        die("SQL Error: " . $mysqli->error);
    }
    $stmt->bind_param("ss", $_GET['description'], $user['username']); //bind paramaters ready to be executed
    $stmt->execute();
}

header("Location: /account/customise.php");
exit();
?>