<?php

return [
    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],
    ],

    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model' => \Mascame\Artificer\ArtificerUser::class,
        ],
    ],

    'passwords' => [
        'admin' => [
            'provider' => 'admin',
            'email' => 'artificer-login::emails.password',
            'table' => 'artificer_password_resets',
            'expire' => 60,
        ],
    ],
];
