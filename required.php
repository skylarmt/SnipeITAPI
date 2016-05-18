<?php

ob_start();
session_start();
require 'vendor/autoload.php';
require 'database.php';

define('JSON', true);
header('Content-Type: application/json');
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
//        if (!email_exists($username)) {
//            return false;
//        } else {
//            $qf = 'email';
//        }
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
