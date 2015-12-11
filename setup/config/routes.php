<?php

use Loo\Routing\Routes;

return [
    // do not delete the default
    Routes::ROUTES => [
        'default' => [
            Routes::CONTROLLER => 'Index',
            Routes::ACTION => 'index',
        ],
    ],

    Routes::CONTROLLER_DIRECTORIES => [
        'nested' => 'Nested',
    ],
];
