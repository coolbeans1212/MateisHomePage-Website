<?php
$env = parse_ini_file(__DIR__ . '/../.env');
session_start();
$mysqli = require_once __DIR__ . "/../db.php";
require_once __DIR__ . "/../applets/createHeadSection.php";
if (isset($_SESSION["user_id"])) {
    $sql = "SELECT admin FROM users WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}

if (!$user['admin']) {
    header('Location: /');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php createHeadSection(); ?>
    </head>
    <body>
        <div class="page">
            <?php include_once __DIR__ . "/../applets/navigation_bar.php"; // :3 ?><br>
            <div class="largeApplet">
                <h1><oblique>send magic packet.</oblique></h1>
                <form method="POST">
                    <label for="mac">MAC Address:</label>
                    <input type="text" name="mac" id="mac" value="34:5A:60:0D:C2:AB"><br>
                    <label for="ip">Broadcast on:</label>
                    <input type="text" name="ip" id="ip" value="255.255.255.255"><br>
                    <label for="pin">Authorisation code:</label>
                    <input type="number" name="pin" id="pin" class="pinPassword" autoComplete="off"><br>
                    <input type="submit">
                </form>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if ($_POST['pin'] != $env['WAKEONLANPIN']) {
                            die("Incorrect pin.");
                        }
                        if (!extension_loaded('sockets')) {
                            die("ERROR: PHP sockets is unloaded.");
                        }
                        if (!array_search('udp', stream_get_transports())) {
                            die("ERROR: Transport UDP is unsupported.");
                        }
                        $mac = strtoupper(rtrim($_POST['mac']));
                        if ((!preg_match("/^([A-F0-9]{2}:){5}([0-9A-F]){2}$/",$mac)) || (strlen($mac) != 17)) {
                            die("ERROR: Invalid MAC address.");
                        }
                        $hardwareAddress = '';
                        foreach (explode(':', $mac) as $byte) {
                            $hardwareAddress .= chr(hexdec($byte));
                        }
                        $magicPacket = str_repeat(chr(0xFF), 6);
                        $magicPacket .= str_repeat($hardwareAddress, 16);
                        
                        $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
                        if (!$socket) {
                            die("ERROR: Socket could not be created: " . socket_strerror($socket_last_error()));
                        }
                        $socketResult = socket_set_option($socket, SOL_SOCKET, SO_BROADCAST, true);
                        if ($socketResult <= 0) {
                            die("ERROR: Socket could not be configured: " . socket_strerror($socketResult));
                        }
                        $socketData = socket_sendto($socket, $magicPacket, strlen($magicPacket), 0, $_POST['ip'], 9);
                        if (!$socketData) {
                            die("ERROR: Magic packet could not be sent to the socket.");
                        }
                        socket_close($socket);
                        ?>
                        Magic packet probably sent successfully. If you sent the magic packet to Matei's computer, <span id="boot1">the UEFI BIOS</span> will boot to <span id="boot2">rEFInd</span> in <span id="timer">10</span> seconds.
                        <script>
                            let timer = document.getElementById('timer');
                            let boot1 = document.getElementById('boot1');
                            let boot2 = document.getElementById('boot2');
                            let seconds = 10;
                            setInterval(function() {
                                if (seconds > 0) {
                                    seconds--;
                                    timer.innerText = seconds;
                                } else {
                                    if (boot1.innerText == 'the UEFI BIOS') {
                                        seconds = 20;
                                        timer.innerText = seconds;
                                        boot1.innerText = 'rEFInd';
                                        boot2.innerText = 'Microsoft Windows';
                                    } else {
                                        return 0;
                                    }
                                }
                            }, 1000);
                        </script>
                        <?php
                    }
                ?>
            </div>
        </div>
    </body>
</html>
