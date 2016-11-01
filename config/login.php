<?php

return [

    'guard' => 'admin',

    'broker' => 'admin',

    'redirects' => [
        'login' => 'admin.home',
        'logout' => 'admin.login.show',
        'register' => 'admin.home',
        'reset-password' => 'admin.home',
    ],

    'views' => [
        'login' => 'artificer-login::login',
        'register' => 'artificer-login::register',
        'forgot-password' => 'artificer-login::passwords.email',
        'reset-password' => 'artificer-login::passwords.reset',
    ],
];
