<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Set the appropriate redirect URL
$redirectURL = "../../login.php";

// Validate the URL before redirecting
if (filter_var($redirectURL, FILTER_VALIDATE_URL)) {
    // Clear the output buffer
    ob_clean();

    // Set the session cookie as HTTP-only
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), $_COOKIE[session_name()], 0, '/', '', true);
    }

    // Redirect after clearing the buffer
    header("Location: " . $redirectURL);
} else {
    // Handle invalid URL case
    echo "Invalid redirect URL.";
}
