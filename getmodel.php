<?php

require 'required.php';
//require 'dieifnotloggedin.php';

$from = $_GET['from'];
require 'readfrom.php';

$id = $_GET['id'];
if (is_empty($id) || $id == 0 || $id == null) {
    $model = '0';
} else {
    if ($from == 'assets') {
        $model = $database->select($from, 'model_id', ['id' => $id])[0];
    } else {
        sendError("Command only valid for assets.");
    }

    if ($model == null) {
        $model = 0;
    }
}

$list = $database->select('models', ['id', 'name']);

die(json_encode(['status' => 'OK', 'model' => $model, 'list' => $list]));
