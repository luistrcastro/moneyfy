<?php

return [
    'hashMap' => [
        'User' => 'User',
        'Category' => 'Category',
        'Transaction' => 'Transaction',
    ],
    'isEnabled' => env('HASH_PRIMARY_KEYS', true),
];
