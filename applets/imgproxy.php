<?php
ini_set('display_errors', 0); //so that php doesnt show my roblosecurity cookie
ini_set('display_startup_errors', 0);

header('Content-Type: image/png');
$id = isset($_GET['id']) && preg_match('/^\d+$/', $_GET['id']) ? $_GET['id'] : '0'; //check if id is a number. if not, BOOM! its now 0
$LocalPfpPath = __DIR__ . '/../files/images/pfps/' . $id . '.png';
$ErrorPfpPath = __DIR__ . '/../files/images/pfps/error.png';
$logLocation = "/var/log/apache2/roblox.log";

if ($id > 500) {
    $cookieValue = trim(file_get_contents('/etc/apache2/keys/ROBLOX'));
    $ch = curl_init('https://assetdelivery.roblox.com/v1/asset/?id=' . $id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: */*']);
    curl_setopt($ch, CURLOPT_COOKIE, '.ROBLOSECURITY=' . $cookieValue);
    
    $body = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($body === false) {
        echo file_get_contents($ErrorPfpPath);
        error_log("cURL error: " . curl_error($ch) . "\n", 3, $logLocation);
        exit();
    }

    if (ord($body[0]) == 0x1f && ord($body[1]) == 0x8b) {
        $body = gzinflate(substr($body, 10));
    }

    if (json_decode($body) !== null) {
        echo file_get_contents($ErrorPfpPath);
        error_log($body . "\n", 3, $logLocation);
        exit();
    }

    if ($status != 200) {
        $imgInfo = getimagesizefromstring($body);
        if($imgInfo !== false) {
            echo $body;
        } else {
            echo file_get_contents($ErrorPfpPath);
        }
        error_log("ROBLOX returned status code: " . $status . " for ID " . $id . "\n", 3, $logLocation);
    }

    echo $body;
    exit();
} else {
    if (file_exists($LocalPfpPath)) {
        echo file_get_contents($LocalPfpPath);
        exit();
    } else {
        echo file_get_contents($ErrorPfpPath);
        exit();
    }
}
