<?php

require 'required.php';

require 'dieifnotloggedin.php';

$q = $_GET['q'];
require 'readfrom.php';

if (is_empty($q)) {
    die(json_encode(['status' => 'OK', 'results' => []]));
}

$results;
if ($from == 'assets') {
    $results = $database->select($from, '*', ['OR' => ['name[~]' => $q, 'asset_tag[~]' => $q, 'serial[~]' => $q, 'order_number[~]' => $q]]);
} else {
    $results = $database->select($from, '*', ['OR' => ['name[~]' => $q, 'order_number[~]' => $q]]);
}

//var_dump($database->error());
//var_dump($results);

die(json_encode(['status' => 'OK', 'results' => $results]));