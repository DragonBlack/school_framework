<?php
return [
    'defaultLang' => 'ru',
    'allowLanguages' => ['ru', 'en', 'uk'],
    'components' => [
        'db' => [
            'class' => 'framework\db\Db',
            'dbhost' => 'localhost',
            'dbname' => 'mvc',
            'dbuser' => 'root',
            'dbpass' => '',
        ],

        'authManager' => [
            'model' => 'models\User',
        ],

        'session' => [

        ],
    ],
];