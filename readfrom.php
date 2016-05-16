<?php

$from = 'assets';

switch ($_GET['from']) {
    case 'accessories':
    case 'accessory':
    case 'acc':
        $from = 'accessories';
        break;
    case 'consumables':
    case 'consumable':
    case 'con':
        $from = 'consumables';
        break;
    default:
        $from = 'assets';
}