<?php
/**
 * Create/update an item.
 */
require 'required.php';
require 'dieifnotloggedin.php';

$from = $_POST['from'];
require 'readfrom.php';

$id = $_POST['id'];
if (is_empty($_POST['asset_tag']) && $from == 'assets') {
    sendError('Please fill in an asset tag.');
}

if (is_empty($id)) {
    // We need to create an item
    if ($from == 'assets') {
        $user_id = $database->select('users', 'id', ['username' => $_SESSION['user']])[0];
        $database->insert($from, ['name' => $_POST['name'], 'user_id' => $user_id, 'asset_tag' => $_POST['asset_tag'], 'rtd_location_id' => $_POST['location'], 'order_number' => $_POST['order_number'], 'status_id' => $_POST['status'], 'serial' => $_POST['serial'], 'model_id' => $_POST['model'], '#updated_at' => 'NOW()', '#created_at' => 'NOW()'/*, '_snipeit_hard_drive_secure__y_n_' => $_POST['hdd_secure']*/]);
    } else {
        $database->insert($from, ['name' => $_POST['name'], 'location_id' => $_POST['location'], 'qty' => $_POST['qty'], 'order_number' => $_POST['order_number'], '#updated_at' => 'NOW()', '#created_at' => 'NOW()']);
    }
} else {
    // Update an existing item by id
    if ($from == 'assets') {
        $database->update($from, ['name' => $_POST['name'], 'asset_tag' => $_POST['asset_tag'], 'rtd_location_id' => $_POST['location'], 'order_number' => $_POST['order_number'], 'status_id' => $_POST['status'], 'serial' => $_POST['serial'], 'model_id' => $_POST['model'], '#updated_at' => 'NOW()'/*, '_snipeit_hard_drive_secure__y_n_' => $_POST['hdd_secure']*/], ['id' => $id]);
    } else {
        $database->update($from, ['name' => $_POST['name'], 'location_id' => $_POST['location'], 'qty' => $_POST['qty'], 'order_number' => $_POST['order_number'], '#updated_at' => 'NOW()'], ['id' => $id]);
    }
}
sendOK();
