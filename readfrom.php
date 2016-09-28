<?php
/**
 * Filter table info to sane choices.  You could add aliases if you like.
 * The app uses all of these variations because I'm lazy and just pass label text.
 */
switch ($from) {
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