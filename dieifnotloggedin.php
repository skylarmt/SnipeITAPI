<?php
/**
 * Simple way to block people that aren't logged in.
 */
require_once 'required.php';

if ($_SESSION['loggedin'] !== true || is_empty($_SESSION['user'])) {
    sendError('You must be logged in to continue.', true);
}