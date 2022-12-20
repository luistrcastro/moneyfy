<?php

/*
 * This file is part of Laravel Optimus.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Optimus Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [
        'main' => ['prime'=> env('HASH_MAIN'), 'inverse'=> env('HASH_MAIN_INVERSE'), 'random'=> env('HASH_MAIN_RANDOM')],

        'alternative' => ['prime' => '1805598649', 'inverse'=> '1060443785', 'random' => '1884825897'],

        'Account' => ['prime' => env('HASH_ACCOUNT'), 'inverse' => env('HASH_ACCOUNT_INVERSE'), 'random' => env('HASH_ACCOUNT_RANDOM')],

        'Category' => ['prime' => env('HASH_CATEGORY'), 'inverse' => env('HASH_CATEGORY_INVERSE'), 'random' => env('HASH_CATEGORY_RANDOM')],

        'Transaction' => ['prime' => env('HASH_TRANSACTION'), 'inverse' => env('HASH_TRANSACTION_INVERSE'), 'random' => env('HASH_TRANSACTION_RANDOM')],

        'User' => ['prime' => env('HASH_USER'), 'inverse' => env('HASH_USER_INVERSE'), 'random' => env('HASH_USER_RANDOM')],
    ],

];
