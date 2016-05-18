<?php

require 'required.php';
//require 'dieifnotloggedin.php';

$from = $_GET['from'];
require 'readfrom.php';

$id = $_GET['id'];
if (is_empty($id) || $id == 0 || $id == null) {
    $loc = '0';
} else {
    if ($from == 'assets') {
        $loc = $database->select($from, 'rtd_location_id', ['id' => $id])[0];
    } else {
        $loc = $database->select($from, 'location_id', ['id' => $id])[0];
    }

    if ($loc == null) {
        $loc = 0;
    }
}

$list = $database->select('locations', ['id', 'name']);
array_unshift($list, ['id' => "0", name => "None/Other"]);

die(json_encode(['status' => 'OK', 'location' => $loc, 'list' => $list]));
