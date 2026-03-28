<?php
//ini_set('display_errors', 0); //so that php doesnt show my roblosecurity cookie
//ini_set('display_startup_errors', 0);
require_once __DIR__ . '/../db.php';

session_set_cookie_params([
    'secure' => true,
    'httponly' => true,
    'samesite' => 'None'
]);
ini_set('session.cookie_domain', '.mateishome.page');
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
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://assetdelivery.roblox.com/v1/asset/?id=' . $imageId);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_COOKIE, '.ROBLOSECURITY=' . trim(file_get_contents('/etc/apache2/keys/ROBLOX')) . ';');
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: */*']);
            
            $body = curl_exec($ch);
            curl_close($ch);

            if (ord($body[0]) == 0x1f && ord($body[1]) == 0x8b) { // gzipped?
                $body = gzinflate(substr($body, 10));
            }

            if (preg_match('/\/asset\/\?id=(\d+)/', $body, $matches)) {
                $pfp = $matches[1];
            } else {
                $pfp = $imageId;
            }
        }

        $stmt = $mysqli->prepare("UPDATE users SET pfp = ? WHERE username = ?");
        if (!$stmt) {
            error_log("Failed to prepare PFP update statement: " . $mysqli->error);
            return false;
        }

        $stmt->bind_param("ss", $pfp, $user['username']);
        return $stmt->execute();

    } catch (Exception $e) {
        error_log("General error while updating PFP: " . $e->getMessage());
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
