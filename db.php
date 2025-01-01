<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = file_get_contents('/etc/apache2/DBPASSWORD');
$db = 'forum';
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db);
      
if ($mysqli->connect_errno) {
	die("Could not connect: " . $mysqli->connecterrno);
	
}

return $mysqli;
?>
