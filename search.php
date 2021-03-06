<?php
/**
 * Search for a given term (q=) in a given category (from=) and spit out JSON.
 */
require 'required.php';

require 'dieifnotloggedin.php';

$q = $_GET['q'];
$from = $_GET['from'];
require 'readfrom.php';

if (is_empty($q)) {
    die(json_encode(['status' => 'OK', 'results' => []]));
}

$results;
// If you want to search through more/different fields, just add them.
if ($from == 'assets') {
    $results = $database->select($from, '*', ['OR' => ['name[~]' => $q, 'asset_tag[~]' => $q, 'serial[~]' => $q, 'order_number[~]' => $q]]);
} else {
    $results = $database->select($from, '*', ['OR' => ['name[~]' => $q, 'order_number[~]' => $q]]);
}

if ($results == false) {
    $results = [];
}

//var_dump($database->error());
//var_dump($results);

die(json_encode(['status' => 'OK', 'results' => $results]));
