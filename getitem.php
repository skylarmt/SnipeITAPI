<?php
/**
 * Dump a database row for a given asset/accessory/consumable
 */
require 'required.php';
require 'dieifnotloggedin.php';

$from = $_GET['from'];
require 'readfrom.php';

$id = $_GET['id'];
if (is_empty($id)) {
    sendError('Missing item ID!');
}

$results = $database->select($from, '*', ['id' => $id])[0];
die(json_encode(['status' => 'OK', 'results' => $results]));