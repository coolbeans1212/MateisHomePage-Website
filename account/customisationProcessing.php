<?php  // This opens the PHP code block

require_once '/var/www/html/db.php';  // Includes a PHP file that connects to the database; makes database functions available

session_start();  // Starts a new session or resumes the existing session. This is necessary for handling user sessions.

if (!isset($_SESSION["user_id"])) {  // Checks if the session variable "user_id" is not set, meaning the user is not logged in
    header("Location: /account/login.php");  // Redirects the user to the login page if they are not logged in
    exit();  // Stops further script execution, ensuring the redirection happens immediately
}

$stmt = $mysqli->prepare("SELECT username FROM users WHERE id = ?");  // Prepares a SQL query to fetch the username from the "users" table where the user's ID matches a placeholder
if (!$stmt) {  // Checks if the SQL query preparation failed
    error_log("Failed to prepare statement: " . $mysqli->error);  // Logs an error message if the query preparation fails
    exit();  // Stops the script execution if an error occurs in preparing the statement
}

$stmt->bind_param("i", $_SESSION["user_id"]);  // Binds the user ID from the session to the prepared SQL query as an integer
$stmt->execute();  // Executes the prepared SQL query
$result = $stmt->get_result();  // Gets the result set of the executed query
$user = $result->fetch_assoc();  // Fetches the associative array from the result (contains the username of the logged-in user)

function storeProfilePicture($imageId) {  // Defines a function called storeProfilePicture that accepts an imageId parameter
    global $mysqli, $user;  // Declares global variables $mysqli (for the database) and $user (for user information inside the function)

    if (!is_numeric($imageId)) {  // Checks if the $imageId is not a number (i.e., invalid input)
        return false;  // Returns false if the imageId is not numeric
    }

    try {  // Begins a try block for exception handling (to catch any errors during execution)
        if (isset($_GET['set']) && $_GET['set'] === 'true') {  // Checks if the URL parameter "set" exists and equals "true"
            $pfp = filter_var($imageId, FILTER_SANITIZE_NUMBER_INT);  // Sanitizes the imageId by removing anything that is not a number
        } else {  // If the "set" parameter is not present or not true, proceed with the alternative logic
            $assetUrl = 'https://assetdelivery.roblox.com/v1/asset/?id=' . $imageId;  // Builds the URL to fetch the asset (image) from the Roblox server
            $decalCompressed = @file_get_contents($assetUrl);  // Attempts to download the asset content (image) from the URL, suppressing errors with @

            if ($decalCompressed === false) {  // Checks if the asset download failed (i.e., $decalCompressed is false)
                return false;  // Returns false if the asset download failed
            }

            $decal = @gzdecode($decalCompressed) ?: $decalCompressed;  // Attempts to decode the compressed asset data, or uses the original data if decoding fails

            if (preg_match('/\/asset\/\?id=(\d+)/', $decal, $matches)) {  // Uses a regular expression to match the asset ID from the decoded content
                $pfp = $matches[1];  // Extracts the asset ID from the matched pattern
            } else {  // If the pattern matching fails
                $pfp = $imageId;  // Uses the original imageId as the profile picture ID
            }
        }

        $stmt = $mysqli->prepare("UPDATE users SET pfp = ? WHERE username = ?");  // Prepares an SQL query to update the user's profile picture (pfp) in the database
        if (!$stmt) {  // Checks if the SQL query preparation failed
            return false;  // Returns false if the statement preparation failed
        }

        $stmt->bind_param("ss", $pfp, $user['username']);  // Binds the sanitized profile picture ID and the username to the prepared SQL query
        return $stmt->execute();  // Executes the query to update the database with the new profile picture ID

    } catch (Exception $e) {  // Catches any exceptions that occur during the try block execution
        error_log("Profile picture update error: " . $e->getMessage());  // Logs the exception message in case of an error
        return false;  // Returns false if an exception occurs
    }
}

// Process the request and redirect
if (isset($_GET['image'])) {  // Checks if the URL parameter "image" is set
    storeProfilePicture($_GET['image']);  // Calls the storeProfilePicture function with the image ID from the URL
}

if ($_GET['type'] == 'customStatus' && $_GET['status']) {  // Checks if the URL parameter "type" is equal to "customStatus" and "status" is provided
    $sql = "UPDATE users SET shortbio = ? WHERE username = ?";  // Defines the SQL query to update the user's custom status (shortbio)
    $stmt = $mysqli->stmt_init();  // Initializes a new prepared statement
    $stmt->prepare($sql);  // Prepares the SQL query for execution
    if ( ! $stmt->prepare($sql)) {  // Checks if the statement preparation failed
        die("SQL Error: " . $mysqli->error);  // Exits the script and outputs an error message if the preparation fails
    }
    $stmt->bind_param("ss", $_GET['status'], $user['username']);  // Binds the status and username from the URL to the prepared query
    $stmt->execute();  // Executes the query to update the user's custom status in the database
}

if ($_GET['type'] == 'description' && $_GET['description']) {  // Checks if the URL parameter "type" is equal to "description" and "description" is provided
    $sql = "UPDATE users SET bigdescription = ? WHERE username = ?";  // Defines the SQL query to update the user's description (bigdescription)
    $stmt = $mysqli->stmt_init();  // Initializes a new prepared statement
    $stmt->prepare($sql);  // Prepares the SQL query for execution
    if ( ! $stmt->prepare($sql)) {  // Checks if the statement preparation failed
        die("SQL Error: " . $mysqli->error);  // Exits the script and outputs an error message if the preparation fails
    }
    $stmt->bind_param("ss", $_GET['description'], $user['username']);  // Binds the description and username from the URL to the prepared query
    $stmt->execute();  // Executes the query to update the user's description in the database
}

header("Location: /account/customise.php");  // Redirects the user to the "customise.php" page after processing
exit();  // Stops further script execution to ensure the redirection happens immediately

?>  // This closes the PHP code block
