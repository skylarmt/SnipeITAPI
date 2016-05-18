<?php

require 'required.php';
require 'dieifnotloggedin.php';

$from = $_POST['from'];
require 'readfrom.php';

$id = $_POST['id'];
if (is_empty($id)) {
    sendError('Missing item ID!');
}
if ($from == 'assets') {
    $database->update($from, ['name' => $_POST['name'], 'rtd_location_id' => $_POST['location'], 'order_number' => $_POST['order_number'], 'status_id' => $_POST['status']], ['id' => $id]);
} else {
    $database->update($from, ['name' => $_POST['name'], 'location_id' => $_POST['location'], 'qty' => $_POST['qty'], 'order_number' => $_POST['order_number']], ['id' => $id]);
}

sendOK();
