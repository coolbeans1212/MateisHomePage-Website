<?php
ini_set('display_errors', 0); //so that php doesnt show my roblosecurity cookie
ini_set('display_startup_errors', 0);
require_once __DIR__ . "/../vendor/autoload.php";
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

header('Content-Type: image/png');
header('Cache-Control: public, max-age=604800'); //a week
$id = isset($_GET['id']) && preg_match('/^\d+$/', $_GET['id']) ? $_GET['id'] : '0'; //check if id is a number. if not, BOOM! its now 0
$LocalPfpPath = __DIR__ . '/../files/images/pfps/' . $id . '.png';
$ErrorPfpPath = __DIR__ . '/../files/images/pfps/error.png';
$RBLXCachePath = __DIR__ . '/../files/images/pfps/RBLX_Cache/';

function InvokeImageCaching($id, $image) {
    global $RBLXCachePath;
    if (!is_dir($RBLXCachePath)) {
        mkdir($RBLXCachePath, 0777, true);
    }
    if (function_exists('fastcgi_finish_request')) {
        fastcgi_finish_request();
    }
    $fileToWrite = fopen($RBLXCachePath . $id . '.png', 'w');
    if ($fileToWrite === false) {
        error_log("Failed to open file for writing: " . $RBLXCachePath . $id . '.png' . "\n", 3, "/var/log/apache2/roblox.log");
        return -1;
    }
    fwrite($RBLXCachePath . $id . '.png', $image);
}

if ($id > 500) {
    if (file_exists($RBLXCachePath . $id . '.png')) {
        echo file_get_contents($RBLXCachePath . $id . '.png');
        exit();
    }
    $client = new Client([
        'http_errors' => false,
        'headers' => [
            'Cookie' => '.ROBLOSECURITY=' . trim(file_get_contents('/etc/apache2/keys/ROBLOX')) . ';',
            'Accept' => '*/*',
        ],
        'allow_redirects' => true,
    ]);
    try {
        $response = $client->request('GET', 'https://assetdelivery.roblox.com/v1/asset/?id=' . $id);
        $body = (string)$response->getBody();

        if (ord($body[0]) == 0x1f && ord($body[1]) == 0x8b) { //check if body is gzipped (stolen from stackoverflow)
            $body = gzinflate(substr($body, 10));
        }

        if (json_decode($body) !== null) {
            echo file_get_contents($ErrorPfpPath);
            error_log($body . "\n", 3, "/var/log/apache2/roblox.log");
            exit();
        }

        $status = $response->getStatusCode();
        if ($status != 200) {
            $imgInfo = getimagesizefromstring($body);
            if($imgInfo !== false) {
                echo $body;
                InvokeImageCaching($id, $body);
                exit();
            } else {
                echo file_get_contents($ErrorPfpPath);
            }
            error_log("ROBLOX returned status code: " . $status . " for ID " . $id . "\n", 3, "/var/log/apache2/roblox.log");
        }

        echo $body;
        InvokeImageCaching($id, $body);
        exit();
    } catch (RequestException $e) {
        echo file_get_contents($ErrorPfpPath);
        error_log("Guzzle error: " . $e->getMessage() . "\n", 3, "/var/log/apache2/roblox.log");
        exit();
    }
} else {
    if (file_exists($LocalPfpPath)) {
        echo file_get_contents($LocalPfpPath);
        exit();
    } else {
        echo file_get_contents($ErrorPfpPath);
        exit();
    }
}
