<?php
/**
 * Database configuration.  If running on the same machine as snipeit,
 * you can probably use the same settings here.
 */
$database = new medoo(
        [
    'database_type' => 'mysql',
    'database_name' => 'snipeit',
    'server' => 'localhost',
    'username' => 'snipeit',
    'password' => 'snipeit',
    'charset' => 'utf8'
        ]
);
