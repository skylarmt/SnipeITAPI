<?php

require 'required.php';
//require 'dieifnotloggedin.php';

$from = $_GET['from'];
require 'readfrom.php';

$id = $_GET['id'];
if (is_empty($id) || $id == 0 || $id == null) {
    $status = '0';
} else {
    if ($from == 'assets') {
        $status = $database->select($from, 'status_id', ['id' => $id])[0];
    } else {
        sendError("Command only valid for assets.");
    }

    if ($status == null) {
        $status = 0;
    }
}

$list = $database->select('status_labels', ['id', 'name', 'notes']);
//array_unshift($list, ['id' => "0", name => "Other"]);

die(json_encode(['status' => 'OK', 'itemstatus' => $status, 'list' => $list]));