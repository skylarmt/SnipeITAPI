<?php

ob_start(); // No worries about sending headers before/after content
session_start();

require 'vendor/autoload.php'; // Load database stuff from Composer
require 'database.php'; // Load database settings

define('JSON', true); // Don't touch this or Something Bad might happen.
header('Content-Type: application/json'); // Don't touch this either.

// Completely disable CORS stuff, everything is allowed.  You could change this
// if you know exactly what domain traffic is coming from.
header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Credentials: true');

/**
 * Check if a user exists in the database by username.
 * @param String $username
 */
function username_exists($username) {
    global $database;
    return $database->has('users', ['username' => $username]);
}

/**
 * Check if a user exists in the database by email.
 * @param String $username
 */
function email_exists($email) {
    global $database;
    return $database->has('users', ['email' => $email]);
}

/**
 * Checks the given credentials against the database.
 * Can use either email or username for identity.
 * @param string $username
 * @param string $password
 * @return boolean True if OK, else false
 */
function authenticate_user($username, $password) {
    global $database;
    $qf = 'username';
    if (!username_exists($username)) {
        return false;
    }
    $hash = $database->select('users', ['password'], [$qf => $username])[0]['password'];
    return (password_verify($password, $hash));
}

/**
 * Checks if a string or whatever is empty.
 * @param $str The thingy to check
 * @return boolean True if it's empty or whatever.
 */
function is_empty($str) {
    return (!isset($str) || $str == '' || $str == null);
}

/**
 * Send a generic OK message.
 * @param string $message Optional message text.
 * @param boolean $die End execution after sending message (default true).
 */
function sendOK($message = "", $die = true) {
    if (!is_empty($message) && JSON) {
        echo '{ "status": "OK", "message": "' . $message . '" }';
    } elseif (is_empty($message) && JSON) {
        echo '{ "status": "OK" }';
    } elseif (!is_empty($message) && !JSON) {
        echo "OK:$message";
    } else {
        echo "OK";
    }
    if ($die) {
        die();
    }
}

/**
 * Send an error message.
 * @param string $error Error text.
 * @param boolean $die End execution after sending error (default true).
 */
function sendError($error, $die = true) {
    if (JSON) {
        echo '{ "status": "ERROR", "message": "' . $error . '" }';
    } else {
        echo "Error: $error";
    }
    if ($die) {
        die();
    }
}
