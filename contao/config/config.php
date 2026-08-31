<?php

declare(strict_types=1);

$GLOBALS['tl_config']['theme_tags'] = [

];


/**
 * Available tags for Diversworld theme
 */
if (empty($GLOBALS['tl_config']['theme_tags'])) {
    $GLOBALS['tl_config']['theme_tags'] = [];
    $GLOBALS['tl_config']['theme_tags'][] = '-';
}

if (!empty($GLOBALS['tl_config']['theme_tags']) && \is_array($GLOBALS['tl_config']['theme_tags'])) {
    $GLOBALS['tl_config']['theme_tags'] = array_merge($GLOBALS['tl_config']['theme_tags'], [
        'DW01/01',
        'DW01/02',
        'DW02/01',
        'DW02/02',
        'DW02/03',
        'DW02/04',
        'DW02/05',
    ]);
}