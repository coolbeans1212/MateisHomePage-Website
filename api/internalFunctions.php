<?php
function getPfpFromUsername($username) { // Defines a function named 'getPfpFromUsername' that takes a username as an argument
    $mysqli = require "/var/www/html/db.php"; // Includes the database connection (db.php), storing the returned database connection in the $mysqli variable
    $sql = "SELECT pfp FROM users WHERE username = ?"; // Prepares an SQL query to fetch the 'pfp' (profile picture) column from the 'users' table where the 'username' matches
    $stmt = $mysqli->prepare($sql); // Prepares the SQL query for execution (prevents SQL injection)
    $stmt->bind_param('s', $username); // Binds the '$username' variable to the SQL query, ensuring it is treated as a string ('s' for string)
    $stmt->execute(); // Executes the prepared SQL query
    $result = $stmt->get_result(); // Fetches the result of the executed query and stores it in $result
    $pfp = $result->fetch_assoc(); // Fetches the result as an associative array and stores it in the $pfp variable
    
    if (isset($pfp['pfp']) && $pfp['pfp'] > 100) { // Checks if the 'pfp' field exists in the result and if its value is greater than 100
        return 'https://assetdelivery.roblox.com/v1/asset/?id=' . htmlspecialchars($pfp['pfp']); // If the 'pfp' is greater than 100, returns a URL for the Roblox profile picture (with the ID sanitized using htmlspecialchars)
    } elseif ($pfp['pfp'] < 100) { // Checks if the 'pfp' value is less than 100
        return '/files/images/pfps/' . htmlspecialchars($pfp['pfp']) . '.png'; // If the 'pfp' is less than 100, returns a path to a local image (with the value sanitized)
    } else { // If none of the above conditions are met (meaning 'pfp' is equal to 100)
        return '/files/images/pfps/error.png'; // Returns a default error image
    }
}
