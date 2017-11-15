<?php

/*
 * =============================================================================
 *
 * Collabmed Solutions Ltd
 * Project: Collabmed Health Platform
 * Author: Samuel Okoth <sodhiambo@collabmed.com>
 *
 * =============================================================================
 */
return[
    'site-name' => [
        'description' => 'Site Name',
        'view' => 'text',
    ],
    'only_logo' => [
        'description' => 'Only logo to appear on print-out headers',
        'view' => 'checkbox',
        'hint' => 'Recomended if facility logo bears the facility name.'
    ],
    'site-description' => [
        'description' => 'Description',
        'view' => 'textarea',
    ],
    'real-time' => [
        'description' => 'Real Time Notifications',
        'view' => 'checkbox',
        'hint' => 'Send push notifications in real time?'
    ],
];
