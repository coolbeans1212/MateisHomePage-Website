<?php
$mysqli = require_once __DIR__ . "/../db.php";
require_once __DIR__ . "/internalFunctions.php";

if (!isset($_GET['id'] || !is_numeric($_GET['id'])) {
    header("HTTP/1.1 400 Bad Request");
    die("Invalid user ID.");
}

function filterResult($result) {
    $allowedFields = array('id', 'username', 'date_created', 'admin', 'special', 'shortbio', 'bigdescription', 'pfp', 'website');
    $toReturn = array();
    foreach ($result as $parent => $child) {
        if(in_array($parent, $allowedFields)) {
            $toReturn[$parent] = $child;
        }
    }
    if (isset($toReturn['username'])) {
        $toReturn['pfp_url'] = getPfpFromUsername($toReturn['username']);
    } else {
        $toReturn['pfp_url'] = null; //imagine if ninja got a low taper fade
    }
    return $toReturn;
}
function arrayToPlaintext($array) { 
    $toReturn = "";
    foreach ($array as $parent => $child) {
        $toReturn .= $parent . ":" . $child . ";"; //Will return something like `key1:value1;key2:value2;
    }
    return $toReturn;
}
function returnUserInfo($result) {
    if ($_GET['type'] == 'json' || !$_GET['type']) {
        header('Content-Type: application/json');
        $json = json_encode($result);
        if ($json === false) {
            header("HTTP/1.1 500 Internal Server Error");
            die("JSON encoding failed.");
        }
        return $json;
    } elseif ($_GET['type'] == 'plaintext') {
        return arrayToPlaintext($result);
    } else {
        header("HTTP/1.1 418 I'm a teapot");
        die("Invalid type.");
    }
}

if ($_GET['id']) {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $result = $result->fetch_assoc();
    if(!$result) {
        header("HTTP/1.1 404 Not Found");
        die("User not found. :("); //pov: $up = new Exeption(); throw $up;
    }
    echo returnUserInfo(filterResult($result));
}
