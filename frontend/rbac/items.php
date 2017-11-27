<?php
return [
    'user' => [
        'type' => 1,
        'description' => 'Viewer - has configurable access to view clubs, players, etc',
        'ruleName' => 'hasAccess',
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Admin - has access = user + adminPanel',
        'children' => [
            'user',
        ],
    ],
];
