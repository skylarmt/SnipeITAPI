<?php

require 'required.php';

//$_POST = $_GET;

$user = $_POST['user'];
$pass = $_POST['pass'];

if (is_empty($user)) {
    sendError("Missing username.");
}

if (is_empty($pass)) {
    sendError("Missing password.");
}

if (authenticate_user($user, $pass)) {
    $_SESSION['user'] = $user;
    $_SESSION['loggedin'] = true;
    sendOK("Login successful.");
} else {
    sendError("Login incorrect, try again.");
}